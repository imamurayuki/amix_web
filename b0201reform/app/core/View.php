<?php
 
/**
 * View.
 *
 * @author Katsuhiro Ogawa <fivestar@nequal.jp>
 */
class View
{
    protected $base_dir;
    protected $defaults;
    protected $layout_variables = array();

    /**
     * コンストラクタ
     *
     * @param string $base_dir
     * @param array $defaults
     */
    public function __construct($base_dir, $defaults = array())
    {
        $this->base_dir = $base_dir;
        $this->defaults = $defaults;
    }

    /**
     * レイアウトに渡す変数を指定
     *
     * @param string $name
     * @param mixed $value
     */
    public function setLayoutVar($name, $value)
    {
        $this->layout_variables[$name] = $value;
    }

    /**
     * ビューファイルをレンダリング
     *
     * @param string $_path
     * @param array $_variables
     * @param mixed $_layout
     * @return string
     */
    public function render($_path, $_variables = array(), $_layout = false)
    {
        $_file = $this->base_dir . '/' . $_path . '.php';

        extract(array_merge($this->defaults, $_variables));

        ob_start();
        ob_implicit_flush(0);

        require $_file;

        $content = ob_get_clean();

        if ($_layout) {
            $content = $this->render($_layout,
                array_merge($this->layout_variables, array(
                    '_content' => $content,
                )
            ));
        }

        return $content;
    }

    /**
     * 指定された値をHTMLエスケープする
     *
     * @param string $string
     * @return string
     */
    public function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * バリデーションエラーを表示する
     *
     * @param array $errors エラー配列
     * @param string $name name属性
     * @return error message
     * @access public
     **/
    public function error($errors, $name) {
        if (isset($errors[$name])) {
            return '<div class="error-message">' . $errors[$name] . '</div>';
        } 
    }

    /**
     * トランケート
     *
     * @param string $text 文字列
     * @param integer $length 文字長
     * @param string $ending 最終文字
     * @return 文字をカットして表示
     * @access public
     **/
    public function truncate($text, $length = 80, $ending = '...') {
        if (mb_strlen($text, 'utf-8') <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length, 'utf-8');
        }
        return $truncate . $ending;
    }
}
