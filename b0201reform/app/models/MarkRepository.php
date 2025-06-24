<?php

class MarkRepository extends DbRepository {

    public function insert($building_id, $value) {

        $sql = "INSERT INTO marks (building_id, value) VALUES (:building_id, :value)";

        $success = $this->execute($sql, array(
            ':building_id' => $building_id,
            ':value' => $value,
        ));

        return $success;
    }
}
