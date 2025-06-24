<?php

/**
 * ユーティリティクラス
 *
 * @packaged default
 * @author Afrofair Internet.
 **/
class Utils {

    /**
     * プルダウンの選択値を設定する
     *
     * @param  string  $name   name属性値
     * @param  integer $value  選択値
     * @param  array   $data   POSTデータ
     * @return string selected
     * @access public
     **/
    public static function optionValue($name, $value, $data) {

        if (isset($data[$name]) && $data[$name] == $value) {
            return ' selected="selected"';
        } else {
            return '';
        }
    }

    /**
     * チェックボックスの選択値を設定する
     *
     * @param  string  $name   name属性値
     * @param  integer $value  選択値
     * @param  array   $data   POSTデータ
     * @return string checked
     * @access public
     **/
    public static function checkValue($name, $value, $data) {

        if (isset($data[$name])) {
            if (is_array($data[$name])) {
                foreach ($data[$name] as $selected) {
                    if ($selected == $value) {
                        return ' checked="checked"';
                    } 
                }
            } else {
                if ($data[$name] == $value) {
                    return ' checked="checked"';
                }
            }
        } 

        return '';
    }

    /**
     * チェックボックスの選択値を設定する
     *
     * @param  string  $name   name属性値
     * @param  array   $data   POSTデータ
     * @return string 入力値
     * @access public
     **/
    public static function textValue($name, $data) {
        if (isset($data[$name])) {
            return $data[$name];
        } else {
            return '';
        }
    }

    public static function image($id, $dir, $file, $type) {

        $file = self::getFilename($file, $type);

        if (!empty($file)) {
            if (file_exists(IMAGE_UPLOAD_DIR . "/{$dir}/{$id}/" . $file)) {
                return "/img/uploads/{$dir}/{$id}/" . $file;
            } 
        }
        if ($type == RESIZE_IMAGE_SMALL) {
            return '/img/uploads/' . RESIZE_IMAGE_SMALL_NO_IMAGE;
        }
        if ($type == RESIZE_IMAGE_MIDDLE) {
            return '/img/uploads/' . RESIZE_IMAGE_MIDDLE_NO_IMAGE;
        }
        return '';
    }

    public static function getFilename($file, $type) {
        if (strlen($file)) {
          $ext = pathinfo($file, PATHINFO_EXTENSION);
          $filename = basename($file, '.' . $ext);
          $file = $filename . '-' . $type . '.' . $ext;
          return $file;
        }
        return $file;
    }

    public static function isExistImage($id, $dir, $file, $type = 'NORMAL') {

        switch ($type) {
            case RESIZE_IMAGE_SMALL:
                $file = self::getFilename($file, RESIZE_IMAGE_SMALL);
                break;
            case RESIZE_IMAGE_MIDDLE:
                $file = self::getFilename($file, RESIZE_IMAGE_MIDDLE);
                break;
        }
        if (strlen($file) && file_exists(IMAGE_UPLOAD_DIR . "/{$dir}/{$id}/" . $file)) {
            return true;
        }
        return false;
    }

    public static function getNewImage($created = null) {

        if (!empty($created) && $created != '0000-00-00 00:00:00') {
            $current = strtotime($created);
            $before = strtotime('-1 month');
            if ($before <= $current) {
                return '/img/build/img_new.jpg';
            }
        } 
        return null;
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
    public static function truncate($text, $length = 80, $ending = '...') {
        if (mb_strlen($text, 'utf-8') <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length, 'utf-8');
        }
        return $truncate . $ending;
    }

    public static function getCrumb(array $crumbPath) {
        $html = ''; 
        $tmp= $crumbPath;
        foreach ($crumbPath as $path) {
            next($tmp);
            if ((current($tmp) !== false)) {
                $html .= "<li>";
                $html .= "<a href=\"{$path['url']}\">" . $path['name'] . '</a>';
            } else {
                $html .= '<li class="this">';
                if (isset($path['url'])) {
                    $html .= "<a href=\"{$path['url']}\">" . $path['name'] . '</a>';
                } else {
                    $html .= '<a href="#">' . $path['name'] . '</a>';
                }
            }
            $html .= "</li>";
        }
        return $html;
    }
}
