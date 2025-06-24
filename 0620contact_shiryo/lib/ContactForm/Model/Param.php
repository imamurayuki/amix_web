<?php
namespace ContactForm\Model;

// 個別パラメータのバリデーション用
class Param {
  // パラメータ名
  public $name = '';

  // 値
  public $value = '';

  // タイプ
  public $type = '';

  // 複数の値リストで扱うかどうか
  public $multiple = false;

  // 入力ルール
  public $required = false;
  public $minLength = null;
  public $maxLength = null;
  public $pattern = null;
  public $accept = null;

  // エラーメッセージ
  private $error_messages = [];

  public function __construct($name = '', $options = [], $config = []) {
    // 名前設定
    $this->name = $name;

    // タイプ設定
    if (isset($options['type'])) {
      $this->type = $options['type'];
    }

    // エラーメッセージのリスト
    if (isset($config['error_messages'])) {
      $this->error_messages = $config['error_messages'];
    }

    // 複数の値リストで扱うかどうか
    if (isset($options['multiple'])) {
      $this->multiple = $options['multiple'];
    }

    // 各入力チェック設定
    if (isset($options['required'])) {
      $this->required = $options['required'];
    }

    if (isset($options['minLength'])) {
      $this->minLength = $options['minLength'];
    }

    if (isset($options['maxLength'])) {
      $this->maxLength = $options['maxLength'];
    }

    if (isset($options['pattern'])) {
      $this->pattern = $options['pattern'];
    }

    if (isset($options['accept'])) {
      $this->accept = $options['accept'];
    }
  }

  // 値をゲット
  public function get() {
    return $this->value;
  }

  // 値をセット
  public function set($value = '') {
    if ($this->multiple) {
      // 配列の場合
      if (!is_array($value)) {
        $value = [$value];
      }

      // 先頭と末尾の空白は除去
      $value = array_map(function($val){
        if (is_string($val)) {
          return trim($val);
        } else {
          return $val;
        }
      }, $value);
    } else {
      // 先頭と末尾の空白は除去
      if (is_string($value)) {
        $value = trim($value);
      }
    }

    $this->value = $value;
  }

  // バリデーション結果のエラーメッセージを取得
  public function getErrorMessage() {
    $name = $this->name;
    $value = $this->get();

    if ($this->required) {
      if ($this->type === 'file') {
        if ((is_array($value) && empty($value['size'])) && empty($value)) {
          return sprintf($this->error_messages['required'], $name);
        }
      } elseif (empty($value)) {
        return sprintf($this->error_messages['required'], $name);
      }
    }

    // ファイル形式の判定
    if ($this->type === 'file' && $this->accept && !empty($value['tmp_name'])) {
      $fileMime = explode('/', strtolower(mime_content_type($value['tmp_name'])));
      $fileExt = strtolower(substr($value['name'], strrpos($value['name'], '.')));

      // accept属性は"image/pdf"などのmimeの場合と、".pdf"などの拡張子の場合があり、それらがカンマ区切りになっている
      $accepts = explode(',', $this->accept);
      $isMatched = false;
      foreach ($accepts as $accept) {
        $accept = strtolower(trim($accept));

        if (preg_match('|.+/.+|', $accept)) {
          // mime判定の場合
          $acceptMime = explode('/', $accept);
          $isMatched = $isMatched || (($acceptMime[0] === '*' || $acceptMime[0] === $fileMime[0]) && ($acceptMime[1] === '*' || $acceptMime[1] === $fileMime[1]));
        } else {
          // 拡張子判定の場合
          $acceptExt = $accept;
          $isMatched = $isMatched || ($acceptExt === $fileExt);
        }

        // 適合したらループ抜け
        if ($isMatched) {
          break;
        }
      }

      if (!$isMatched) {
        // 入力形式エラーを返す
        return sprintf($this->error_messages['pattern'], $name);
      }
    }

    if ($this->multiple) {
      $values = $value;
    } else {
      $values = [$value];
    }

    foreach ($values as $value) {
      if (is_int($this->minLength) && mb_strlen($value) < $this->minLength) {
        return sprintf($this->error_messages['minLength'], $name, $this->minLength);
      }

      if (is_int($this->maxLength) && $this->maxLength < mb_strlen($value)) {
        return sprintf($this->error_messages['maxLength'], $name, $this->maxLength);
      }

      if (is_string($this->pattern) && !empty($this->pattern) && !preg_match($this->pattern, $value)) {
        return sprintf($this->error_messages['pattern'], $name);
      }
    }

    return '';
  }

  // バリデーションの成否を取得
  public function validate() {
    $error = $this->getErrorMessage();

    if (!empty($error)) {
      return $error;
    }

    return true;
  }
}
