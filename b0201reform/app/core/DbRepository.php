<?php

/**
 * DbRepository.
 *
 * @author Katsuhiro Ogawa <fivestar@nequal.jp>
 */
abstract class DbRepository
{
    protected $con;

    /**
     * コンストラクタ
     *
     * @param PDO $con
     */
    public function __construct($con)
    {
        $this->setConnection($con);
    }

    /**
     * コネクションを設定
     *
     * @param PDO $con
     */
    public function setConnection($con)
    {
        $this->con = $con;
    }

    /**
     * トランザクション開始
     *
     * @return void
     * @access public
     **/
    public function begin() {
        $this->con->beginTransaction();
    }

    /**
     * トランザクション コミット
     *
     * @return void
     * @access public
     **/
    public function commit() {
        $this->con->commit();
    }

    /**
     * トランザクション ロールバック
     *
     * @return void
     * @access public
     **/
    public function rollback() {
        $this->con->rollback();
    }

    public function lastInsertId() {
        return $this->con->lastInsertId();
    }

    /**
     * クエリを実行
     *
     * @param string $sql
     * @param array $params
     * @return PDOStatement $stmt
     */
    public function execute($sql, $params = array())
    {
        $stmt = $this->con->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    /**
     * クエリを実行し、結果を1行取得
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetch($sql, $params = array())
    {
        return $this->execute($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * クエリを実行し、結果をすべて取得
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchAll($sql, $params = array())
    {
        return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchList($sql, $key, $value, $params = array()) {
        $results = $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchCount($sql, $params = array()) {
        return $this->execute($sql, $params)->fetchColumn();
    }

    /**
     * ページャ用クエリ生成
     *   単一テーブルのみ
     * @param  string $table テーブル名
     * @param  mixed  $params パラメータ(条件やソート等)
     * @return array
     * @access public
     **/
    public function fetchPaginate($table, array $params) {

        // ページ数
        $page = (isset($params['page'])) ? $params['page'] : 1; 
        // 表示件数
        $displayCount = (isset($params['displayCount'])) ? $params['displayCount'] : 15;
        // テーブル
        $sql = "SELECT * FROM {$table}"; 
        // WHERE句生成
        if (isset($params['conditions']) && !empty($params['conditions'])) {
            $sql .= " WHERE";
            foreach ($params['conditions'] as $k => $v) {
                $sql .= " {$k} = :{$k}";
            }
        }
        // ORDER BY句生生
        if (isset($params['order']) & !empty($params['order'])) {
            $sql .= " ORDER BY {$params['order']}";
        }
        // LIMIT句生成
        $sql .= " LIMIT " . $displayCount * ($page - 1) . ", {$displayCount}";
        // データバインド
        $bindValues = array();
        if (isset($params['conditions']) && !empty($params['conditions'])) {
            foreach ($params['conditions'] as $k => $v) {
                $bindValues[":{$k}"] = $v;
            }
        }
        return  $this->execute($sql, $bindValues)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * undocumented function
     *
     * @return void
     * @access //public
     **/
    protected function getExt($mine_type) {
        switch ($mine_type) {
            case 'image/gif':
                return 'gif';
            case 'image/png':
                return 'png';
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                return 'jpg';
        }
    }
}
