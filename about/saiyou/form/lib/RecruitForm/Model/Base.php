<?php
namespace RecruitForm\Model;

require_once(__DIR__ . '/Param.php');
use RecruitForm\Model\Param;

// 受け付けデータのModel
class Base {
  // 必要パラメータの設定リスト
  private $interfaces = null;

  // 受け取ったデータ
  private $data;

  public function __construct($interfaces =[], $data = [], $config = []) {
    $this->interfaces = $interfaces;
    $this->initParams($config);
    $this->setData($data);
  }

  // 受け取ったデータをパラメータモデルにして個別のバリデーションを実行できるようにする
  private function initParams($config = []) {
    $this->data = [];

    foreach ($this->interfaces as $key => $options) {
      $this->data[$key] = new Param($options['label'], $options, $config);
    }
  }

  // データを一括セット
  public function setData($data = []) {
    foreach ($this->interfaces as $key => $options) {
      $this->set($key, isset($data[$key]) ? $data[$key] : '');
    }
  }

  // データを個別にセット
  public function set($name, $value = '') {
    $this->data[$name]->set($value);
  }

  // データを一括ゲット
  public function getData() {
    $data = [];

    foreach ($this->interfaces as $key => $options) {
      $data[$key] = $this->get($key);
    }

    return $data;
  }

  // データを個別にゲット
  public function get($name) {
    return isset($this->data[$name]) ? $this->data[$name]->get() : '';
  }

  // 設定を一括ゲット
  public function getInterfaces() {
    $data = [];

    foreach ($this->interfaces as $key => $options) {
      $data[$key] = $options;
    }

    return $data;
  }

  // バリデーション結果のエラーメッセージを一括ゲット
  public function getErrorMessages() {
    $data = [];

    foreach ($this->interfaces as $key => $options) {
      $errorMessage = $this->getErrorMessage($key);
      if (!empty($errorMessage)) {
        $data[$key] = $errorMessage;
      }
    }

    return $data;
  }

  // バリデーション結果のエラーメッセージを個別ゲット
  public function getErrorMessage($name) {
    return isset($this->data[$name]) ? $this->data[$name]->getErrorMessage() : '';
  }
}
