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
    public function findLists() {
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
  a.status = 1
ORDER BY
  b.created_at DESC
SQL;
        $results = $this->fetchAll($sql, array());

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
  a.completed_date,
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
  a.status <> 3 AND
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
  status <> 3 AND
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
                    expected_date_of_completed, formal_name, other, link, link_url, completed_date, created_at)
                    VALUES (:status, :name, :pref, :address1, :address2,
                        :type, :type_other, :structure, :structure_other, :purpose, :purpose_other,
                        :houses1, :houses2, :room_layout, :room_layout_size1, :room_layout_size2,
                        :expected_date_of_completed, :formal_name, :other, :link, :link_url, :completed_date, :created_at
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
                ':link_url'                   => $data['link_url'],
                ':completed_date'             => $data['completed_date'],
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
                    link_url           = :link_url,
                    completed_date     = :completed_date
                WHERE
                    id = :id
            ";
            $this->execute($sql, array(
                ':id'                         => $id,
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
                ':link_url'                   => $data['link_url'],
                ':completed_date'             => $data['completed_date'],
            ));



            // 関連テーブルを登録しなおす
        	$sql = "SELECT * FROM marks WHERE building_id = :id";
        	$mark = $this->fetch($sql, array(':id' => $id));
			if ($mark) {
				$sql = 'DELETE FROM marks WHERE building_id = :building_id';
				$this->execute($sql, array(':building_id' => $id));
			}

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

            $this->commit();
            return true;
        } catch (PDOException $e) {
            $this->rollback();
			var_dump($e);
			die();

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
