<?php

/**
 * 部件管理-ただいま建設中
 *
 * @afrofair
 */
class BuildingsApplication extends Application
{
    //protected $login_action = array('account', 'signin');
    protected $login_action = array('admin', 'login');

    public function getRootDir()
    {
        return dirname(__FILE__);
    }

    public function getImageDir() {
        return dirname(dirname(__FILE__)) . '/img';
    }

    public function getUploadImageDir() {
        return $this->getImageDir() . '/uploads';
    }

    protected function registerRoutes()
    {
        return array(
            //--------------------------------------------------------
			// [frontend] 外観:トップページ
            //--------------------------------------------------------
            '/' => array('controller' => 'build', 'action' => 'index'),
            //--------------------------------------------------------
			// [frontend] 内装:トップページ
            //--------------------------------------------------------
            '/interior' => array('controller' => 'build', 'action' => 'interiorIndex'),
            //--------------------------------------------------------
			// [frontend] その他:トップページ
            //--------------------------------------------------------
            '/other' => array('controller' => 'build', 'action' => 'otherIndex'),
            '/other/' => array('controller' => 'build', 'action' => 'otherIndex'),

            //--------------------------------------------------------
            // [frontend] 物件一覧
            //--------------------------------------------------------
            '/list/:year' => array('controller' => 'build', 'action' => 'list'),
            '/detail/:id' => array('controller' => 'build', 'action' => 'detail'),
            //--------------------------------------------------------
            // [admin] 物件管理
            //--------------------------------------------------------
            '/admin' => array('controller' => 'admin', 'action' => 'index'),
            '/admin/' => array('controller' => 'admin', 'action' => 'index'),
            '/admin/index/:page' => array('controller' => 'admin', 'action' => 'index'),
            '/admin/add' => array('controller' => 'admin', 'action' => 'add'),
            '/admin/edit' => array('controller' => 'admin', 'action' => 'edit'),
            '/admin/edit/:id' => array('controller' => 'admin', 'action' => 'edit'),
            '/admin/delete' => array('controller' => 'admin', 'action' => 'delete'),
            '/admin/delete/:id' => array('controller' => 'admin', 'action' => 'delete'),
            //--------------------------------------------------------
            // [admin] 物件説明管理
            //--------------------------------------------------------
            '/admin/desc'            => array('controller' => 'admin', 'action' => 'desc'),
            '/admin/desc/:id'        => array('controller' => 'admin', 'action' => 'desc'),
            '/admin/desc/add/:id'    => array('controller' => 'admin', 'action' => 'addDesc'),
            '/admin/desc/edit/:id'   => array('controller' => 'admin', 'action' => 'editDesc'),
            '/admin/desc/edit/:b_id/:id'  => array('controller' => 'admin', 'action' => 'editDesc'),
            '/admin/desc/delete/:b_id/:id' => array('controller' => 'admin', 'action' => 'deleteDesc'),
            //--------------------------------------------------------
            // [admin] ログイン認証
            //--------------------------------------------------------
            '/admin/login'     => array('controller' => 'admin', 'action' => 'login'),
            '/admin/logout'    => array('controller' => 'admin', 'action' => 'logout'),
            //--------------------------------------------------------
            // [admin] ユーザ管理   
            //--------------------------------------------------------
            '/admin/users'            => array('controller' => 'admin', 'action' => 'account'),
            '/admin/users/index'      => array('controller' => 'admin', 'action' => 'account'),
            '/admin/users/add'        => array('controller' => 'admin', 'action' => 'addAccount'),
            '/admin/users/edit'   => array('controller' => 'admin', 'action' => 'editAccount'),
            '/admin/users/edit/:id'   => array('controller' => 'admin', 'action' => 'editAccount'),
            '/admin/users/delete' => array('controller' => 'admin', 'action' => 'deleteAccount'),
            '/admin/users/delete/:id' => array('controller' => 'admin', 'action' => 'deleteAccount'),
        );
    }

    protected function configure()
    {
        $this->db_manager->connect('master', array(
            'dsn'      => 'mysql:dbname=reform;host=localhost',
            'user'     => 'reformuser',
            'password' => 'amix19092002',
        ));
    }
}
