<?php

/**
 * UserRepository.
 *
 */
class UserRepository extends DbRepository
{
    public function insert($name, $password)
    {
        $password = $this->hashPassword($password);

        $sql = "
            INSERT INTO user(name, password, created_at)
                VALUES(:name, :password, :created_at)
        ";

        $stmt = $this->execute($sql, array(
            ':name'  => $name,
            ':password'   => $password,
            ':created_at' => date('Y-m-d H:i:s', strtotime('now')),
        ));
    }

    public function update($id, $name, $password)
    {
        $password = $this->hashPassword($password);

        $sql = "
            UPDATE  user SET 
               name = :name,
               password = :password, 
               created_at = :created_at
            WHERE id = :id
        ";

        $stmt = $this->execute($sql, array(
            ':name'  => $name,
            ':password'   => $password,
            ':created_at' => date('Y-m-d H:i:s', strtotime('now')),
            ':id' => $id
        ));
    }

    public function remove($id) {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->execute($sql, array(':id' => $id));
    }

    public function hashPassword($password)
    {
        return sha1($password . 'SecretKey');
    }

    public function fetchByUserName($name)
    {
        $sql = "SELECT * FROM user WHERE name = :name";

        return $this->fetch($sql, array(':name' => $name));
    }

    public function fetchById($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";

        return $this->fetch($sql, array(':id' => $id));
    }

    public function isUniqueUserName($name)
    {
        $sql = "SELECT COUNT(id) as count FROM user WHERE name = :name";

        $row = $this->fetch($sql, array(':name' => $name));
        if ($row['count'] === '0') {
            return true;
        }

        return false;
    }

    public function isOnlyOne() {
        $sql = "SELECT COUNT(id) as count FROM user";
        $row = $this->fetch($sql);
        if ($row['count'] === '1') {
            return true;
        }
        return false;
    }
}
