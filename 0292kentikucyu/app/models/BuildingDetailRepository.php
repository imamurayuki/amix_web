<?php

/**
 * 物件記事モデル
 *
 * @author Afrofair Internet.
 **/
class BuildingDetailRepository extends DbRepository {

    /**
     * 物件記事IDに該当する物件記事を1件取得する
     *
     * @param  integer $id 物件ID
     * @return array 物件記事
     * @access public
     **/
    public function findById($id) {
        $sql = "SELECT * FROM building_detail WHERE id = :id";

        return $this->fetch($sql, array(':id' => $id));
    }

    /**
     * 物件IDに該当する物件記事を取得する
     *
     * @param  integer $id 物件ID
     * @return array 物件記事
     * @access public
     **/
    public function findAllByBuildingId($id) {
        $sql = "SELECT * FROM building_detail WHERE building_id = :id ORDER BY created_at DESC";

        return $this->fetchAll($sql, array(':id' => $id));
    }

    public function findAllByBuildingIdAndStatus($id) {
        $sql = "SELECT * FROM building_detail WHERE 
                    building_id = :id AND status = 1 ORDER BY created_at DESC";
        return $this->fetchAll($sql, array(':id' => $id));
    }

    /**
     * 物件記事を登録する
     *
     * @param  array $data POSTデータ
     * @return boolean 
     * @access public
     **/
    public function insert($data) {

        try {
            $this->begin();

            $sql = "INSERT INTO building_detail (building_id, status, description, created_at) 
                    VALUES (:building_id, :status, :description, :created_at)";
            $this->execute($sql, array(
                ':building_id' => $data['building_id'],
                ':status'      => $data['status'],
                ':description' => $data['description'],
                ':created_at'  => date('Y-m-d H:i:s', strtotime('now')),
            ));
            $id = $this->lastInsertId();

            // ディレクトリ
            if (is_dir(IMAGE_UPLOAD_DIR) && is_dir(IMAGE_UPLOAD_DIR . '/details')) {
                $path = IMAGE_UPLOAD_DIR . '/details/' . $id;
                if (!is_dir($path)) {
                    mkdir($path, 0777);
                }
                if (is_dir($path)) {
                    // アップロードファイル保存
                    for ($i = 1; $i <= 3; $i++) {
                        $ext = $this->getExt($_FILES["image{$i}"]['type']);
                        if (is_uploaded_file($_FILES["image{$i}"]['tmp_name'])) {
                            move_uploaded_file($_FILES["image{$i}"]['tmp_name'], $path . "/image{$i}.{$ext}");
                        }
                    }
                    // サムネイル作成
                    $resizer = new ResizeImage();
                    for ($i = 1; $i <= 3; $i++) {
                        $ext = $this->getExt($_FILES["image{$i}"]['type']);
                        $original = $path . "/image{$i}.{$ext}";
                        if (file_exists($original)) {
                            $small = $resizer->dispResizeImgPath($original, 135, 122);
                            $middle = $resizer->dispResizeImgPath($original, 240, 220);
                            $sql = "UPDATE building_detail SET 
                                        image_file{$i} = :image_file{$i}
                                    WHERE
                                      id = :id";
                            $this->execute($sql, array(
                                ":image_file{$i}" => basename($original),
                                ':id' => $id,
                            ));
                        }
                    }
                }
            }
            $this->commit();
            return true;
        } catch (Exception $e) {
            $this->rollback();
            return false;
        }
    }


    /**
     * 物件記事を更新する
     *
     * @param  array $data 更新データ
     * @return boolean
     * @access public
     **/
    public function update($data) {
         
        var_dump($data);


        try {
            $sql = "UPDATE building_detail SET
                      status = :status,
                      description =  :description
                    WHERE
                      id = :id
            ";
            $this->execute($sql, array(
                ':status'      => $data['status'],
                ':description' => $data['description'],
                ':id' => $data['id'],
            ));
            // ディレクトリ
            if (is_dir(IMAGE_UPLOAD_DIR) && is_dir(IMAGE_UPLOAD_DIR . '/details')) {
                $path = IMAGE_UPLOAD_DIR . '/details/' . $data['id'];
                if (is_dir($path)) {
                    // アップロードファイル保存
                    for ($i = 1; $i <= 3; $i++) {
                        if (is_uploaded_file($_FILES["image{$i}"]['tmp_name'])) {
                            $ext = $this->getExt($_FILES["image{$i}"]['type']);
                            // 既にファイルが存在していたら削除
                            if (file_exists($path . "/image{$i}.{$ext}")) {
                                unlink($path . "/image{$i}.{$ext}");
                                unlink($path . "/image{$i}-" . RESIZE_IMAGE_SMALL . ".{$ext}");
                                unlink($path . "/image{$i}-" . RESIZE_IMAGE_MIDDLE . ".{$ext}");
                            }
                            move_uploaded_file($_FILES["image{$i}"]['tmp_name'], 
                                $path . "/image{$i}.{$ext}");

                            // サムネイル作成
                            $resizer = new ResizeImage();
                            $original = $path . "/image{$i}.{$ext}";
                            $filename = null;
                            if (file_exists($original)) {
                                $small = $resizer->dispResizeImgPath($original, 135, 122);
                                $middle = $resizer->dispResizeImgPath($original, 240, 220);
                                $filename = basename($original);
                                $sql = "UPDATE building_detail SET 
                                            image_file{$i} = :image_file{$i}
                                        WHERE
                                          id = :id";
                                $this->execute($sql, array(
                                    ":image_file{$i}" => $filename,
                                    ':id' => $data['id'],
                                ));
                            }
                        } else { 
                            // ファイル削除処理
                            if ($data["del_image{$i}"] == 1) {
                                $filename = $data["image_file{$i}"];
                                if (file_exists($path . '/' . $filename)) {
                                    unlink($path . "/" . $filename);
                                    unlink($path . "/" . Utils::getFilename($filename, 
                                                         RESIZE_IMAGE_SMALL));
                                    unlink($path . "/" . Utils::getFilename($filename,
                                                         RESIZE_IMAGE_MIDDLE));
                                }
                                $sql = "UPDATE building_detail SET 
                                            image_file{$i} = :image_file{$i}
                                        WHERE
                                          id = :id";
                                $this->execute($sql, array(
                                    ":image_file{$i}" => null,
                                    ':id' => $data['id'],
                                ));
                            }
                        }
                    }
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 物件記事を削除する
     *
     * @param  integer $id 
     * @return 
     * @access public
     **/
    public function remove($id) {
        try {
            $sql = "
                DELETE FROM building_detail WHERE id = :id
            ";
            $this->execute($sql, array(
                ':id' => $id
            ));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
