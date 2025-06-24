<?php

class Configure {

    /**
     * 設定値
     *
     * @var array 
     **/
    protected static $_config = array();

    /**
     * コンストラクタ
     *
     * @return void
     * @access public
     **/
    public function __construct() {
        if (is_null($_config)) {
            self::$_config = array();
        }
    }

    /**
     * 設定値を書き込む
     *
     * $param  mixed $key
     * $param  mixed $value
     * @return void
     * @access public
     **/
    public static function write($key, $value) {

        self::$_config[$key] = $value;
    }

    /**
     * 設定値を読み込む
     *
     * $param  mixed $key
     * @return mixed
     * @access public
     **/
    public static function read($key) {

        if (array_key_exists($key, self::$_config)) {
            return self::$_config[$key];
        }
        return null;
    }
}
