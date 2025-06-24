<?php

/**
 * 管理画面処理
 *
 * 通常はユースケース毎やCRUD単位でコントローラを作成するが
 * アプリケーションが小さいので管理画面側の処理は全てAdminコントローラ
 * に記載する。保守や機能拡張時には機能分割を検討して下さい。
 *
 * @author Afrofair.inc
 */
class AdminController extends Controller {
    protected $auth_actions = array(
        'index', 'add', 'edit', 'delete',
        'desc', 'addDesc', 'editDesc', 'deleteDesc',
        'account', 'addAccount', 'editAccount', 'deleteAccount',
        'logout'
    );

    /**
     * 物件一覧
     *
     * @return void
     * @access public
     **/
    public function indexAction($params) {
        if ($this->session->isAuthenticated()) {
            //return $this->redirect('/login');
        }

        // 表示ページ
        $page = isset($params['page']) ? $params['page'] : 1;
        // 全件数
        $count = $this->db_manager->get('Building')->findCount();
        // 表示数
        $displayCount = PAGER_COUNT;
        // ページ数
        $pageNumber = ceil($count / $displayCount);

        $buildings = $this->db_manager->get('Building')->findPaginate($page, $displayCount);
        return $this->render(array(
                'buildings' => $buildings,
                'count' => $count,
                'page' => $page,
                'displayCount' => $displayCount,
                'pageNumber' => $pageNumber,
            ), null, 'admin_layout'
        );
    }

    /**
     * 物件追加
     *
     * @return void
     * @access public
     **/
    public function addAction() {

        // エラーを初期化
        $errors = array();

        if ($this->request->isPost()) {
            $data = $this->initializePost();
            $errors = $this->validate($data);

            if (count($errors) === 0) {
                $isSuccess = $this->db_manager->get('Building')->insert($data);
                if ($isSuccess) {
                    return $this->redirect('/admin');
                }
            }
        } else {
            $data = null;
        }

        return $this->render(array(
            'data' => $data, 'action' => 'add', 'errors' => $errors), 
            null, 'admin_layout'
        );
    }

    /**
     * 物件更新
     *
     * @param  string $params
     * @return void
     * @access public
     **/
    public function editAction($params = null) {

        $errors = array();

        if ($this->request->isPost()) {

            $data = $this->initializePost();
            $errors = $this->validate($data);

            if (count($errors) === 0) {
                $isSuccess = $this->db_manager->get('Building')->update($data['id'], $data);
                if ($isSuccess) {
                    $this->redirect('/admin');
                }
            } 
        } else {
            if (empty($params) || !isset($params['id'])) {
                $this->redirect('/admin');
            }
            $data = $this->db_manager->get('Building')->findById($params['id']);
            $data = $this->clearZero($data);
        }

        return $this->render(array(
                'data' => $data, 'action' => 'edit', 'errors' => $errors
            ), 'add', 'admin_layout'
        );
    }

    /**
     * ゼロのデータをクリアする
     *   TODO: なんでからで登録しようとするとデフォルトがNULLなのにゼロが入るのか
     *
     * @param  array $data 変換前
     * @return array $data 変換後
     * @author Afrofair Internet.
     **/
    private function clearZero($data) {
        if ($data['completed_date'] == '0000-00-00') {
            $data['completed_date'] = null;
        }
        if ($data['houses1'] == 0) {
            $data['houses1'] = null;
        }
        if ($data['houses2'] == 0) {
            $data['houses2'] = null;
        }
        if ($data['room_layout_size1'] == 0) {
            $data['room_layout_size1'] = null;
        }
        if ($data['room_layout_size2'] == 0) {
            $data['room_layout_size2'] = null;
        }

        return $data;
    }

    /**
     * 物件削除
     *
     * @param  string $params
     * @return void
     * @access public
     **/
    public function deleteAction($params = null) {
        if ($this->db_manager->get('Building')->remove($params['id'])) {
            $this->redirect("/admin");
        } else {
            $this->redirect('/admin');
        }
    }

    /**
     * 物件登録バリデーション
     *
     * @return void
     * @access private
     **/
    private function validate($data) {
        $errors = array();

        // 公開状況
        if (empty($data['status'])) {
            $errors['status'] = '公開状況を選択してください。';
        }
        // 計画名
        if (empty($data['name'])) {
            $errors['name'] = '計画名を入力してください。';
        }
        // タイプ
        if ($data['type'] == 4 && !strlen($data['type_other'])) {
            $errors['type'] = 'タイプがその他の時は文字を入力してください。';
        }
        // 構造
        if ($data['structure'] == 5 && !strlen($data['structure_other'])) {
            $errors['structure'] = '構造がその他の時は文字を入力してください。';
        }
        // 用途
        if ($data['purpose'] == 4 && !strlen($data['purpose_other'])) {
            $errors['purpose'] = '用途がその他の時は文字を入力してください。';
        }
        // 戸数(棟)
        if (strlen($data['houses1']) && !is_numeric($data['houses1'])) {
            $errors['houses1'] = '戸数(棟)は数値で入力してください。';
        }
        // 戸数(戸)
        if (strlen($data['houses2']) && !is_numeric($data['houses2'])) {
            $errors['houses2'] = '戸数(戸)は数値で入力してください。';
        }
        // 間取り
        if (strlen($data['room_layout_size1']) && !is_numeric($data['room_layout_size1'])) {
            $errors['room_layout_size1'] = '間取りの面積1は数値で入力してください。';
        }
        if (strlen($data['room_layout_size2']) && !is_numeric($data['room_layout_size2'])) {
            $errors['room_layout_size2'] = '間取りの面積2は数値で入力してください。';
        }
        // 引渡し日
        if (strlen($data['completed_date'])) {
            if (preg_match("|^\d{4}-\d{1,2}-\d{1,2}$|", trim($data['completed_date']))) {
                list($year, $month, $day) = explode('-', trim($data['completed_date']));
                if (!checkdate($month, $day, $year)) {
                    $errors['completed_date'] = '正しい日付を入力して下さい。';
                }
            } else {
                $errors['completed_date'] = '正しい日付を入力して下さい。';

            }
        }

        return $errors;
    }

    /**
     * 物件登録/更新時のPOSTデータの初期化を行う
     *
     * @return array POST値をすべて格納された$data変数
     * @access private
     **/
    private function initializePost() {
        $data['id']     = $this->request->getPost('id');
        $data['status'] = $this->request->getPost('status');
        $data['name']   = $this->request->getPost('name');
        $data['pref']   = $this->request->getPost('pref');
        $data['address1'] = $this->request->getPost('address1');
        $data['address2'] = $this->request->getPost('address2');
        $data['type'] = $this->request->getPost('type');
        // その他の時しか保存しない
        if ($this->request->getPost('type') == 4) {
            $data['type_other'] = $this->request->getPost('type_other');
        } else {
            $data['type_other'] = null;
        }
        $data['structure'] = $this->request->getPost('structure');
        // その他の時しか保存しない
        if ($this->request->getPost('structure') == 5) {
            $data['structure_other'] = $this->request->getPost('structure_other');
        } else {
            $data['structure_other'] = null;
        }
        $data['purpose'] = $this->request->getPost('purpose');
        // その他の時しか保存しない
        if ($this->request->getPost('purpose') == 4) {
            $data['purpose_other'] = $this->request->getPost('purpose_other');
        } else {
            $data['purpose_other'] = null;
        }
        $data['houses1'] = $this->request->getPost('houses1');
        $data['houses2'] = $this->request->getPost('houses2');
        $data['room_layout'] = $this->request->getPost('room_layout');
        $data['room_layout_size1'] = $this->request->getPost('room_layout_size1');
        $data['room_layout_size2'] = $this->request->getPost('room_layout_size2');
        $data['expected_date_of_completed'] = $this->request->getPost('expected_date_of_completed');
        $data['formal_name'] = $this->request->getPost('formal_name');
        $data['other'] = $this->request->getPost('other');
        $data['link'] = $this->request->getPost('link');
        $data['link_url'] = $this->request->getPost('link_url');
        $data['mark'] = $this->request->getPost('mark');
        $data['completed_date'] = $this->request->getPost('completed_date');

        return $data;
    }

    /**
     * 物件記事一覧
     *
     * @param  array $params
     * @return void
     * @access public
     **/
    public function descAction($params) {
        $building_id = $params['id'];

        if (isset($params['id']) && !empty($params['id'])) {
            $data = $this->db_manager->get('BuildingDetail')->findAllByBuildingId($building_id);
            $build = $this->db_manager->get('Building')->findById($building_id);
        } else {
            $this->redirect('/admin');
        }
        return $this->render(array(
            'data' => $data, 'building_id' => $building_id,
            'build' => $build), null, 'admin_layout');
    }

    /**
     * 物件記事編集
     *
     * @return void
     * @access public
     **/
    public function editDescAction($params) {
        $errors = array();

        if ($this->request->isPost()) {
            $data = $this->initializeDescPost();
            $building_id = $params['b_id'];

            $errors = $this->validateDetail($data);
            if (count($errors) === 0) {
                $success = $this->db_manager->get('BuildingDetail')->update($data);
                if ($success) {
                    $this->redirect('/admin/desc/' . $building_id);
                }
            } 
        } else {
            $data = $this->db_manager->get('BuildingDetail')->findById($params['id']);
            $building_id = $params['b_id'];
        }

        return $this->render(array(
            'data' => $data, 'building_id' => $building_id,
            'action' => 'edit', 'errors' => $errors,
            ),
            'edit_desc', 'admin_layout'
        );
    }

    private function validateDetail($data) {
        $errors = array();

        // 公開状況
        if (empty($data['status'])) {
            $errors['status'] = '公開状況を選択してください。';
        }

        return $errors;
    }

    /**
     * 物件記事削除
     *
     * @return void
     * @access public
     **/
    public function deleteDescAction($params) {
        if ($this->db_manager->get('BuildingDetail')->remove($params['id'])) {
            $this->redirect("/admin/desc/{$params['b_id']}");
        }
    }

    /**
     * 物件記事追加
     *
     * @return void
     * @access public
     **/
    public function addDescAction($params) {
        $building_id = $params['id'];
        $errors = array();

        if ($this->request->isPost()) {
            $data = $this->initializeDescPost();
            $errors = $this->validateDetail($data);

            if (count($errors) === 0) {
                $isSuccess = $this->db_manager->get('BuildingDetail')->insert($data);
                if ($isSuccess) {
                    $this->redirect('/admin/desc/' . $data['building_id']);
                }
            }
        } else {
            $data['building_id'] = $building_id;
        }

        return $this->render(array(
            'data' => $data, 'action' => 'add', 'building_id' => $building_id, 'errors' => $errors),
            'edit_desc', 'admin_layout'
        );
    }

    /**
     * 物件記事のPOSTデータを初期化
     *
     * @return array POST値をすべて$data変数に格納したものを返す
     * @access private
     **/
    private function initializeDescPost() {
        $data['id']          = $this->request->getPost('id');
        $data['building_id'] = $this->request->getPost('building_id');
        $data['status']      = $this->request->getPost('status');
        $data['description'] = $this->request->getPost('description');
        // 画像ファイル
        $data['image_file1'] = $this->request->getPost('image_file1');
        $data['image_file2'] = $this->request->getPost('image_file2');
        $data['image_file3'] = $this->request->getPost('image_file3');
        // 削除フラグ
        $data['del_image1'] = $this->request->getPost('del_image1');
        $data['del_image2'] = $this->request->getPost('del_image2');
        $data['del_image3'] = $this->request->getPost('del_image3');

        return $data;
    }


    public function loginAction() {

        if ($this->session->isAuthenticated()) {
            return $this->redirect('/admin');
        }

        $errors = array();

        if ($this->request->isPost()) {
            // CSRF対策
            $token = $this->request->getPost('_token');
            if (!$this->checkCsrfToken('admin/login', $token)) {
                return $this->redirect('/admin/login');
            }
            $name = $this->request->getPost('name');
            $password = $this->request->getPost('password');

            if (!strlen($name)) {
                $errors['name'] = 'ユーザIDを入力して下さい。';
            }
            if (!strlen($password)) {
                $errors['password'] = 'パスワードを入力して下さい。';
            }
            if (count($errors) == 0) {
                $User = $this->db_manager->get('User');
                $user = $User->fetchByUserName($name);
                if (!$user || $user['password'] !== $User->hashPassword($password)) {
                    $errors['password'] = 'ユーザIDもしくはパスワードが<br />違います。';
                } else {
                    $this->session->setAuthenticated(true);
                    $this->session->set('user', $user);

                    return $this->redirect('/admin');
                }
            }
        } else {
            $name = null;
            $password = null;
        }
        return $this->render(array(
            'name' => $name, 'password' => $password, 'errors' => $errors,
            '_token' => $this->generateCsrfToken('admin/login'),
        ), 'login', 'admin_layout');
    }

    public function logoutAction() {
        $this->session->clear();
        $this->session->setAuthenticated(false);
        return $this->redirect('/admin/login');
    }

    public function accountAction() {
        $users = $this->db_manager->get('User')->fetchAll('SELECT * FROM user');
        $errors = $this->session->get('errors');
        if (!empty($errors)) {
            $this->session->remove('errors');
        }
        return $this->render(array('users' => $users, 'errors' => $errors), 
            'account', 'admin_layout');
    }

    public function addAccountAction() {

        $errors = array();
        if ($this->request->isPost()) {
            $name = $this->request->getPost('name');
            $password = $this->request->getPost('password');

            $errors = $this->validateUser($name, $password);
            if (count($errors) === 0) {
                $this->db_manager->get('User')->insert($name, $password);
                return $this->redirect('/admin/users');
            }
        } else {
            $name = null;
            $password = null;
        }
        // IDはなし
        $id = null;

        return $this->render(array(
            'errors' => $errors, 'action' => 'users/add',
            'id' => $id, 'name' => $name, 'password' => $password),
            'edit_account', 'admin_layout');
    }

    public function editAccountAction($params) {
        $id = $params['id'];
        $errors = array();

        if ($this->request->isPost()) {
            $name = $this->request->getPost('name');
            $password = $this->request->getPost('password');
            $errors = $this->validateUser($name, $password, true);
            if (count($errors) === 0) {
                $this->db_manager->get('User')->update($id, $name, $password);
                return $this->redirect('/admin/users');
            }
        } else {
            $user = $this->db_manager->get('User')->fetchById($id);
            $name = $user['name'];
            $password = null;
        }

        return $this->render(array(
            'errors' => $errors, 'action' => 'users/edit',
            'id' => $id, 'name' => $name, 'password' => $password),
            'edit_account', 'admin_layout');

    }

    public function deleteAccountAction($params) {

        $User = $this->db_manager->get('User');
        if ($User->isOnlyOne()) {
            $errors['delete'] = '全てのユーザアカウントを削除することは出来ません。';
            $this->session->set('errors', $errors);
        } else {
            $User->remove($params['id']);
        } 
        return $this->redirect('/admin/users');
    }

    private function validateUser($name, $password, $isEdit = false) {
        // ユーザ名
        if (!strlen($name)) {
            $errors['name'] = 'ユーザIDを入力してください';
        } else if (!preg_match('/^\w{3,20}$/', $name)) {
            $errors['name'] = 'ユーザIDは半角英数字およびアンダースコアを3 ～ 20 文字以内で入力してください';
        } else if (!$isEdit && !$this->db_manager->get('User')->isUniqueUserName($name)) {
            $errors['name'] = 'ユーザIDは既に使用されています';
        }
        // パスワード
        if (!strlen($password)) {
            $errors['password'] = 'パスワードを入力してください';
        } else if (4 > strlen($password) || strlen($password) > 30) {
            $errors['password'] = 'パスワードは4 ～ 30 文字以内で入力してください';
        }

        return $errors;
    }


}
