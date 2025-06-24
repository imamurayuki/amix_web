<?php

/**
 * 物件モデル
 *
 * @author Afrofair.inc 
 */
class BuildingRepository extends DbRepository {

    /**
     * 指定した物件IDの物件情報を1件取得
     *
     * @return void
     * @access public
     **/
    public function findById($id) {

        $sql = "SELECT * FROM building WHERE building.id = :id";
        $buildings = $this->fetch($sql, array(':id' => $id));

        // マークを連結する
        $sql = "SELECT value FROM marks WHERE building_id = :building_id";
        $marks = $this->fetchAll($sql, array(':building_id' => $id));
        $lists = array();
        foreach ($marks as $mark) {
            $lists[] = $mark['value'];
        }
        if (!empty($lists)) {
            $buildings['mark'] = $lists;
        }

        return $buildings;
    }

    public function findCount() {
        $sql = "SELECT count(id) FROM building";
        return  $this->fetchCount($sql);
    }

    
    /**
     * 物件を全件取得
     *
     * @return array
     * @access public
     **/
    public function findLists($isInterior = 0) {
        $sql =<<<SQL
SELECT
  a.id,
  a.name,
  a.link,
  b.created_at,
  b.id as building_detail_id,
  b.image_file1,
  a.is_interior
FROM
  building AS a
    INNER JOIN
  (SELECT
     building_detail.id, building_detail.building_id, building_detail.status,
     building_detail.image_file1, building_detail.description, building_detail.created_at
   FROM
     building_detail
   INNER JOIN (
     SELECT
       building_id, MAX(created_at) as max_created_at
     FROM
       building_detail
     WHERE
       status = 1
     GROUP BY
       building_id
   ) tmp
     ON (building_detail.building_id = tmp.building_id AND building_detail.created_at = tmp.max_created_at)
 ) AS b
   ON (a.id = b.building_id)
WHERE
  a.status = 1 AND a.is_interior = :is_interior
ORDER BY
  b.created_at DESC
SQL;
        $results = $this->fetchAll($sql, array('is_interior' => $isInterior));

        foreach ($results as $index => $row)  {
            // マークを連結する
            $sql = "SELECT value FROM marks WHERE building_id = :building_id";
            $marks = $this->fetchAll($sql, array(':building_id' => $row['id']));
            $lists = array();
            foreach ($marks as $mark) {
                $lists[] = $mark['value'];
            }
            if (!empty($lists)) {
                $results[$index]['mark'] = $lists;
            }
        }

        return $results;
    }

    public function findAllGroupByYear($year) {
        $sql =<<<SQL
SELECT
  a.id,
  a.name,
  a.link,
  b.created_at,
  b.id as building_detail_id,
  b.image_file1
FROM
  building AS a
    LEFT JOIN
  (SELECT
     building_detail.id, building_detail.building_id, building_detail.status,
     building_detail.image_file1, building_detail.description, building_detail.created_at
   FROM
     building_detail
   INNER JOIN (
     SELECT
       building_id, MAX(created_at) as max_created_at
     FROM
       building_detail
     WHERE
       status = 1
     GROUP BY
       building_id
   ) tmp
     ON (building_detail.building_id = tmp.building_id AND building_detail.created_at = tmp.max_created_at)
 ) AS b
   ON (a.id = b.building_id)
WHERE
  a.status = 2 AND
  DATE_FORMAT(a.completed_date, '%Y') = :year
ORDER BY
  b.created_at DESC
SQL;

        $results = $this->fetchAll($sql, array(':year' => $year));

        foreach ($results as $index => $row)  {
            // マークを連結する
            $sql = "SELECT value FROM marks WHERE building_id = :building_id";
            $marks = $this->fetchAll($sql, array(':building_id' => $row['id']));
            $lists = array();
            foreach ($marks as $mark) {
                $lists[] = $mark['value'];
            }
            if (!empty($lists)) {
                $results[$index]['mark'] = $lists;
            }
        }

        return $results;

    }

    /**
     * 登録されている物件情報の年度を全て取得
     *
     * @return array years
     * @access public
     **/
    public function findAllYear() {
        $sql =<<<SQL
SELECT 
  DATE_FORMAT(completed_date, '%Y') AS year
FROM building
WHERE
  status = 2 AND
  DATE_FORMAT(completed_date, '%Y') IS NOT NULL AND
  DATE_FORMAT(completed_date, '%Y') <> '0000'
GROUP BY
  year
ORDER BY
  year DESC
SQL;
        return $this->fetchAll($sql);
    }

    /**
     * 物件一欄表示
     *
     * @return void
     * @access //public
     **/
    public function findPaginate($page, $displayCount) {
        $params['page'] = $page;
        $params['displayCount'] = $displayCount;
        $params['order'] = 'created_at DESC';

        return $this->fetchPaginate('building', $params);
    }

    /**
     * 物件追加
     *
     * @param  $array $data
     * @return boolean 
     * @access public
     **/
    public function insert($data) {

        try {
            $this->begin();

			if ($data['completed_date'] == '') {
				$data['completed_date'] = null;
			}
			if ($data['houses1'] == '') {
				$data['houses1'] = null;
			}
			if ($data['houses2'] == '') {
				$data['houses2'] = null;
			}

            $sql = "
                INSERT INTO building (status, name, pref, address1, address2, 
                    type, type_other, structure, structure_other, purpose, purpose_other, 
                    houses1, houses2, room_layout, room_layout_size1, room_layout_size2, 
                    expected_date_of_completed, formal_name, other, link, completed_date, comment, is_interior, created_at)
                    VALUES (:status, :name, :pref, :address1, :address2,
                        :type, :type_other, :structure, :structure_other, :purpose, :purpose_other,
                        :houses1, :houses2, :room_layout, :room_layout_size1, :room_layout_size2,
                        :expected_date_of_completed, :formal_name, :other, :link, :completed_date, :comment, :is_interior, :created_at
                    )
            ";
            // 物件登録
             $this->execute($sql, array(
                ':status'                     => $data['status'],
                ':name'                       => $data['name'],
                ':pref'                       => $data['pref'],
                ':address1'                   => $data['address1'],
                ':address2'                   => $data['address2'],
                ':type'                       => $data['type'],
                ':type_other'                 => $data['type_other'],
                ':structure'                  => $data['structure'],
                ':structure_other'            => $data['structure_other'],
                ':purpose'                    => $data['purpose'],
                ':purpose_other'              => $data['purpose_other'],
                ':houses1'                    => $data['houses1'],
                ':houses2'                    => $data['houses2'],
                ':room_layout'                => $data['room_layout'],
                ':room_layout_size1'          => $data['room_layout_size1'],
                ':room_layout_size2'          => $data['room_layout_size2'],
                ':expected_date_of_completed' => $data['expected_date_of_completed'],
                ':formal_name'                => $data['formal_name'],
                ':other'                      => $data['other'],
                ':link'                       => $data['link'],
                ':completed_date'             => date('Y-m-d H:i:s', strtotime('now')),
                ':comment'                    => $data['comment'],
                ':is_interior'                => $data['is_interior'],
                ':created_at'                 => date('Y-m-d H:i:s', strtotime('now')),
            ));
            $id = $this->lastInsertId();

            // 表示マーク登録
            if (!empty($data['mark'])) {
                foreach ($data['mark'] as $mark) {
                    $sql = "INSERT INTO marks (building_id, value) VALUES (:building_id, :value)";
                    $this->execute($sql, array(
                        ':building_id' => $id,
                        ':value' => $mark,
                    ));
                }
            }

            // ディレクトリ
            if (is_dir(IMAGE_UPLOAD_DIR) && is_dir(IMAGE_UPLOAD_DIR . '/add')) {
                $path = IMAGE_UPLOAD_DIR . '/add/' . $id;
                if (!is_dir($path)) {
                    mkdir($path, 0777);
                }
                if (is_dir($path)) {
                    // アップロードファイル保存
                    $ext = $this->getExt($_FILES["image1"]['type']);
                    if (is_uploaded_file($_FILES["image1"]['tmp_name'])) {
                        move_uploaded_file($_FILES["image1"]['tmp_name'], $path . "/image1.{$ext}");
                    }

                    // サムネイル作成
                    $resizer = new ResizeImage();
                    
                    $ext = $this->getExt($_FILES["image1"]['type']);
                    $original = $path . "/image1.{$ext}";
                    if (file_exists($original)) {
                        $middle = $resizer->dispResizeImgPath($original, 300, 200);
                        $sql = "UPDATE building SET 
                                    image_file1 = :image_file1
                                WHERE
                                  id = :id";
                        $this->execute($sql, array(
                            ":image_file1" => basename($original),
                            ':id' => $id,
                        ));
                    }
                }
            }

            $this->commit();
            return true;
        } catch (PDOException $e) {
            $this->rollback();
            return false;
        }
    }

    /**
     * 物件を更新する
     *
     * @param  integer $id
     * @param  array   $parameters
     * @return void
     * @access public
     **/
    public function update($id, $data = null) {

        try {
            $this->begin();

			if ($data['completed_date'] == '') {
				$data['completed_date'] = null;
			}
			if ($data['houses1'] == '') {
				$data['houses1'] = null;
			}
			if ($data['houses2'] == '') {
				$data['houses2'] = null;
			}

            $sql = "
                UPDATE building SET 
                    image_file1        = :image_file1,
                    status             = :status,
                    name               = :name,
                    pref               = :pref,
                    address1           = :address1,
                    address2           = :address2, 
                    type               = :type,
                    type_other         = :type_other,
                    structure          = :structure,
                    structure_other    = :structure_other,
                    purpose            = :purpose,
                    purpose_other      = :purpose_other,
                    houses1            = :houses1,
                    houses2            = :houses2,
                    room_layout        = :room_layout,
                    room_layout_size1  = :room_layout_size1,
                    room_layout_size2  = :room_layout_size2, 
                    expected_date_of_completed = :expected_date_of_completed,
                    formal_name        = :formal_name,
                    other              = :other,
                    link               = :link,
                    comment            = :comment,
                    is_interior        = :is_interior
                WHERE
                    id = :id 
            ";
            $this->execute($sql, array(
                ':id'                         => $id,
                ':image_file1'                => $data['image_file1'],
                ':status'                     => $data['status'],
                ':name'                       => $data['name'],
                ':pref'                       => $data['pref'],
                ':address1'                   => $data['address1'],
                ':address2'                   => $data['address2'],
                ':type'                       => $data['type'],
                ':type_other'                 => $data['type_other'],
                ':structure'                  => $data['structure'],
                ':structure_other'            => $data['structure_other'],
                ':purpose'                    => $data['purpose'],
                ':purpose_other'              => $data['purpose_other'],
                ':houses1'                    => $data['houses1'],
                ':houses2'                    => $data['houses2'],
                ':room_layout'                => $data['room_layout'],
                ':room_layout_size1'          => $data['room_layout_size1'],
                ':room_layout_size2'          => $data['room_layout_size2'],
                ':expected_date_of_completed' => $data['expected_date_of_completed'],
                ':formal_name'                => $data['formal_name'],
                ':other'                      => $data['other'],
                ':link'                       => $data['link'],
                ':comment'                    => $data['comment'],
                ':is_interior'                => $data['is_interior'],
            ));

            // 関連テーブルを登録しなおす
            $sql = 'DELETE FROM marks WHERE building_id = :building_id';
            $this->execute($sql, array(':building_id' => $id));

            // 表示マーク登録
            if (!empty($data['mark'])) {
                foreach ($data['mark'] as $mark) {
                    $sql = "INSERT INTO marks (building_id, value) VALUES (:building_id, :value)";
                    $this->execute($sql, array(
                        ':building_id' => $id,
                        ':value' => $mark,
                    ));
                }
            }

            // ディレクトリ
            if (is_dir(IMAGE_UPLOAD_DIR) && is_dir(IMAGE_UPLOAD_DIR . '/add')) {
                $path = IMAGE_UPLOAD_DIR . '/add/' . $data['id'];
                if (!is_dir($path)) {
                    mkdir($path, 0777);
                }
                if (is_dir($path)) {
                    // アップロードファイル保存
                    if (is_uploaded_file($_FILES["image1"]['tmp_name'])) {
                        $ext = $this->getExt($_FILES["image1"]['type']);
                        // 既にファイルが存在していたら削除
                        if (file_exists($path . "/image1.{$ext}")) {
                            unlink($path . "/image1.{$ext}");
                            unlink($path . "/image1-" . RESIZE_IMAGE_LARGE . ".{$ext}");
                        }
                        move_uploaded_file($_FILES["image1"]['tmp_name'], 
                            $path . "/image1.{$ext}");

                        // サムネイル作成
                        $resizer = new ResizeImage();
                        $original = $path . "/image1.{$ext}";
                        $filename = null;
                        if (file_exists($original)) {
                            $middle = $resizer->dispResizeImgPath($original, 300, 200);
                            $filename = basename($original);
                            $sql = "UPDATE building SET 
                                        image_file1 = :image_file1
                                    WHERE
                                      id = :id";
                            $this->execute($sql, array(
                                ":image_file1" => $filename,
                                ':id' => $data['id'],
                            ));
                        }
                    } else { 
                        // ファイル削除処理
                        if ($data["del_image1"] == 1) {
                            $filename = $data["image_file1"];
                            if (file_exists($path . '/' . $filename)) {
                                unlink($path . "/" . $filename);
                                unlink($path . "/" . Utils::getFilename($filename,
                                                     RESIZE_IMAGE_LARGE));
                            }
                            $sql = "UPDATE building SET 
                                        image_file1 = :image_file1
                                    WHERE
                                      id = :id";
                            $this->execute($sql, array(
                                ":image_file1" => null,
                                ':id' => $data['id'],
                            ));
                        }
                    }
                }
            }

            $this->commit();
            return true;
        } catch (PDOException $e) {
            $this->rollback();
            return false;
        }
    }

    /**
     * 物件を削除する
     *
     * @param  integer $id 
     * @return 
     * @access public
     **/
    public function remove($id) {
        $sql = "
            DELETE FROM building WHERE id = :id
        ";
        $stmt = $this->execute($sql, array(
            ':id' => $id
        ));
    }
}
