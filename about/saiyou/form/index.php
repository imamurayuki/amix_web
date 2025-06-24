<?php

// 明示的に文字エンコードを設定
ini_set('default_charset', 'UTF-8');
mb_language('ja');
mb_internal_encoding('UTF-8');

// 設定読み込み
require_once(__DIR__ . '/config/config.php');

// ブラウザキャッシュ抑制
if (isset($config['check_token']) && $config['check_token']) {
  header('Cache-Control: no-store');
  header('Pragma: no-cache');
}

// デバッグモードの場合はエラーを表示する
if (isset($config['debug']) && $config['debug']) {
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);
}

// フォーム読み込み
require_once(__DIR__ . '/lib/RecruitForm/Core.php');
use RecruitForm\Core;

// main
$form = new Core($config);
