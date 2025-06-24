<?php
namespace ContactForm;

// Modelの読み込み
require_once(__DIR__ . '/Model/Base.php');

use ContactForm\Model;

// フォーム
class Core {
  // 設定
  private $config = null;

  public function __construct($config) {
    $this->config = $config;
    $this->initSession();
    $this->process();
    $this->clearOldTempFile();
  }

  // セッション初期化
  private function initSession() {
    // セッション設定
    session_set_cookie_params(
      $this->config['session']['expires'], // lifetime
      null, // path
      null, // domain
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on', // secure
      true // httponly
    );

    // セッション開始
    session_start();
  }

  // CSRF対策トークンの作成と記憶
  private function updateToken() {
    // ランダム出力
    // PHPバージョンによって使用する関数が違う
    if (function_exists('random_bytes')) {
      $token = random_bytes(32);
    } else {
      $token = mcrypt_create_iv(32, MCRYPT_DEV_URANDAM);
    }

    // トークンを生成する
    $token = hash('sha256', $this->config['session']['token_prefix'] . bin2hex($token));

    // セッションに保存
    $_SESSION['token'] = $token;

    // 作成したトークンを返却
    return $token;
  }

  // CSRF対策トークンの判定
  private function validateToken($token) {
    return !isset($this->config['check_token']) || !$this->config['check_token'] || $this->getToken() === $token;
  }

  // CSRF対策トークンの取得
  private function getToken() {
    return $_SESSION['token'];
  }

  // 処理中のフォームのモード
  public function getMode() {
    // 確認ボタンを押した
    if (isset($_POST['confirm'])) {
      return 'confirm';
    }

    // 送信ボタンを押した
    if (isset($_POST['send'])) {
      return 'send';
    }

    // 上記以外は入力画面
    return 'index';
  }

  // テンプレートファイル名を取得
  public function getTemplateName() {
    $mode = $this->getMode();

    // 送信モードの時は、メールの後に完了画面を出すので変換
    if ($mode === 'send') {
      return 'complete';
    }

    return $mode;
  }

  // ファイルのパスを解決
  public function resolvePath($dir, $file) {
    return rtrim(ltrim($dir), " \n\r\t\v\x00/") . '/' . $file;
  }

  // テンプレートファイルパスを取得
  public function getTemplate($template = '') {
    if (empty($template)) {
      $template = $this->getTemplateName();
    }
    return $this->resolvePath($this->config['template_dir'], $template . '.php');
  }

  // テンプレート用のデータを取りまとめ
  public function getData() {
    $config = $this->config;

    // 入力設定とラベルを関連付け
    $interfaces = $config['model'];

    // POSTパラメータからモデル作成
    $model = new Model\Base($interfaces, array_merge([], $_POST, $_FILES), $config);

    // テンプレート用のデータ
    $data = [];
    $data['params'] = $model->getData();
    $data['errors'] = $model->getErrorMessages();
    $data['interfaces'] = $model->getInterfaces();

    foreach ($data['interfaces'] as $key => $options) {
      // HTMLの<input>のpattern属性はデリミター無しのため、設定から先頭と末尾の文字列を削除しておく
      if (isset($options['pattern'])) {
        $options['pattern'] = preg_replace("/^\/|\/([a-z]+)?$/", '', $options['pattern']);
      }

      $data['interfaces'][$key] = $options;
    }

    return $data;
  }

  // 汎用メール送信
  private function sendMailTo($data, $to, $subject, $template) {
    $config = $this->config['mail'];

    // メールテンプレートを読み込み
    $message = file_get_contents($template);

    // ショートコードを展開（[name]）
    $message = preg_replace_callback(
      '/\[.+?\]/',
      function ($match) use ($data) {
        $key = preg_replace('/^\[|\]$/', '', $match)[0];
        if (isset($data[$key])) {
          $value = $data[$key];
        } else {
          $value = '';
        }

        if ($key === 'agreement' && $value === '1') {
          return '[v]';
        }

        if ($key === 'remote_addr') {
          return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        }

        return $value;
      },
      $message
    );

    // 送信元ヘッダーを設定
    $headers = [
      'From' => $config['from'],
      'Content-Type' => 'text/plain; charset=UTF-8',
      'Content-Transfer-Encoding' => '8bit',
    ];

    $header_str = '';
    array_walk($headers, function($_val, $_key) use (&$header_str) {
      $_val = preg_split("/[\r\n]+/", trim($_val));
      $header_str .= sprintf("%s: %s\r\n", ($_key), trim($_val[0]));
    });

    // 送信して成否を返却
    return mb_send_mail(
      $to,
      $subject,
      $message,
      $header_str
    );
  }

  // 管理者宛メール送信
  public function sendMailAdmin($data) {
    $config = $this->config['mail'];
    return $this->sendMailTo(
      $data,
      $config['admin']['to'],
      $config['admin']['subject'],
      $config['admin']['template']
    );
  }

  // ユーザー宛メール送信
  public function sendMailUser($data) {
    $config = $this->config['mail'];
    return $this->sendMailTo(
      $data,
      $data['email'],
      $config['user']['subject'],
      $config['user']['template']
    );
  }

  // メール送信
  public function sendMail($data) {
    return $this->sendMailAdmin($data) && $this->sendMailUser($data);
  }

  // 古い一時ファイルを削除
  public function clearOldTempFile() {
    $config = $this->config['upload'];
    $expires = time() - $config['expires'];
    $dir = $config['temp_dir'];
    foreach (glob($this->resolvePath($dir, '[!.]*.*')) as $file) {
      if ($expires > filemtime($file)) {
        unlink($file);
      }
    }
  }

  // アップロードファイルの一時保存
  public function saveFileTempAll() {
    $interfaces = $this->config['model'];

    $tempFileNames = [];
    foreach ($interfaces as $name => $model) {
      if ($model['type'] === 'file') {
        $tempFileNames[$name] = $this->saveFileTemp($name);
      }
    }

    return $tempFileNames;
  }

  // ファイル名に含まれる.や/を変換
  public function convertFileName($filename, $mimetype = '') {
    if (!empty($mimetype)) {
      $ext = explode('/', $mimetype)[1];
    } else {
      preg_match('/[.]([^.]+?)$/', $filename, $matches);
      $ext = preg_replace('/\//', '_', $matches[1]);
    }
    $basename = preg_replace('/\.\//', '_', basename($filename, '.' . $ext));
    return sprintf('%s.%s', $basename, $ext);
  }

  // アップロードファイルの一時保存
  public function saveFileTemp($name) {
    // ファイルアップロードされていない場合は何もせず終了
    if (!isset($_FILES[$name]) || $_FILES[$name]['error'] === UPLOAD_ERR_NO_FILE) {
      return;
    }

    $fileinfo = $_FILES[$name];

    // アップロードエラー時
    if (($fileinfo['error'] !== UPLOAD_ERR_OK && $fileinfo['error'] !== UPLOAD_ERR_NO_FILE) || !is_uploaded_file($fileinfo['tmp_name'])) {
      $this->render('uploadError', $this->getData());
      exit();
    }

    $temp_dir = $this->config['upload']['temp_dir'];

    // オリジナルのファイル名
    $originalFileName = $fileinfo['name'];

    // 一時ファイルのファイル名を作成
    if (function_exists('random_bytes')) {
      $uniq = bin2hex(random_bytes(8));
    } else {
      $uniq = bin2hex(mcrypt_create_iv(8, MCRYPT_DEV_URANDAM));
    }
    $tempFileName = $this->convertFileName($uniq, mime_content_type($fileinfo['tmp_name']));
    $tempFilePath = $this->resolvePath($temp_dir, $tempFileName);

    // アップ先が無い場合は作成
    if (!file_exists($temp_dir) || !is_dir($temp_dir)) {
      mkdir($temp_dir, 0700);
    }

    // 一時ファイルの保存先に移動
    $results = move_uploaded_file($fileinfo['tmp_name'], $tempFilePath);

    // ファイル移動エラー時
    if (!$results) {
      $this->render('uploadError', $this->getData());
      exit();
    }

    return [
      'name'         => $originalFileName,
      'tempFileName' => $tempFileName,
    ];
  }

  // アップロードファイルの保存
  public function saveFileAll($id, $data) {
    $interfaces = $this->config['model'];

    $filenames = [];
    foreach ($interfaces as $name => $model) {
      if ($model['type'] === 'file' && !empty($data[$name])) {
        $filenames[$name] = $this->saveFile($id, $name, $data[$name]);
      }
    }

    return $filenames;
  }

  // アップロードファイルの保存
  public function saveFile($id, $name, $tempFileName) {
    // 一時ファイルのパス
    $tempFileName = $this->convertFileName($tempFileName);
    $tempFilePath = $this->resolvePath($this->config['upload']['temp_dir'], $tempFileName);

    // 一時ファイルが見つからない場合は終了
    if (!file_exists($tempFilePath)) {
      return;
    }

    // idに合わせてディレクトリ作成
    $dir = $this->resolvePath($this->config['upload']['dir'], $id);
    if (!file_exists($dir) || !is_dir($dir)) {
      if (!mkdir($dir, 0777, true)) {
        return;
      }
    }

    // 最終のファイル名
    $lastFileName = $this->convertFileName(sprintf('%03d_%s', $id, $name), mime_content_type($tempFilePath));
    $lastFilePath = $this->resolvePath($dir, $lastFileName);

    // ファイル移動
    if (rename($tempFilePath, $lastFilePath)) {
      return $lastFileName;
    }
  }

  // レンダリング処理
  public function render($templateName = '', $data = []) {
    // トークン更新
    $data['token'] = $this->updateToken();

    // テンプレートを読み込んでレンダリング
    $template = $this->getTemplate($templateName);
    include_once($template);
  }

  // CSVファイルからIDを取得
  public function getIdFromCSV() {
    $file = $this->config['csv'];

    if (!file_exists($file)) {
      // ファイルが無い場合は初期値として1を返す
      return 1;
    } else {
      if ($handle = fopen($file, 'r')) {
        $id = 0;
  
        // 既存のCSVを読み取ってID作成
        while ($row = fgetcsv($handle)) {
          ++$id;
        }

        fclose($handle);
        return $id;
      }
    }
  }

  // レンダリング処理
  public function saveCSV($id, $data = []) {
    $file = $this->config['csv'];
    $settings = $this->config['csv_template'];

    // ヘッダー行と、キー配列の作成
    $headers = [];
    $keys = [];
    foreach ($settings as $label => $value) {
      $headers[] = $label;
    }

    // ファイルが無い場合は作成
    if (!file_exists($file)) {
      touch($file);
      if ($handle = fopen($file, 'a')) {
        // Excelで文字化けしないようにBOMをつける
        fwrite($handle, pack('C*', 0xEF, 0xBB, 0xBF));
        // ヘッダー行を書き込む
        fputcsv($handle, $headers);
        fclose($handle);
      } else {
        return false;
      }
    } else {
      // ファイルが存在する場合はヘッダー行のみを書き換える
      if ($handle = fopen($file, 'r+')) {
        // ヘッダー行終端のポインター位置を取得
        fgetcsv($handle);
        $cursor = ftell($handle);

        // 既存のデータを読み込み
        $current_rows = fread($handle, filesize($file) - $cursor);

        // ファイルをいったん空にして先頭に戻る
        ftruncate($handle, 0);
        rewind($handle);

        // Excelで文字化けしないようにBOMをつける
        fwrite($handle, pack('C*', 0xEF, 0xBB, 0xBF));
        // ヘッダー行を書き込む
        fputcsv($handle, $headers);

        // 既存のデータを再書き込み
        fwrite($handle, $current_rows);

        fclose($handle);
      } else {
        return false;
      }
    }

    if ($handle = fopen($file, 'a')) {
      // 書き込みデータを作成
      $values = [];
      foreach ($settings as $label => $value) {
        if (is_array($value)) {
          if (isset($value['date'])) {
            $values[] = date($value['date']);
          } else {
            $values[] = $value['value'];
          }
        } else {
          $key = $value;
          $value = $data[$key];
          $interface = $this->config['model'][$key];
          if (is_array($value)) {
            $value = implode(',', $value);
          }
          if (isset($interface['boolean']) && $interface['boolean']) {
            if (!empty($value)) {
              $value = 'TRUE';
            } else {
              $value = 'FALSE';
            }
          }
          if (isset($interface['replace'])) {
            $value = isset($interface['replace'][$value]) ? $interface['replace'][$value] : '';
          }
          $values[] = $value;
        }
      }

      // 書き込み
      fputcsv($handle, $values);
      fclose($handle);
    } else {
      return false;
    }

    return true;
  }

  public function process() {
    // 処理モード
    $mode = $this->getMode();

    // テンプレート用データを取りまとめ
    $data = $this->getData();

    // カテゴリーのグルーピング
    foreach ($this->config['collection'] as $collection_name => $model_names) {
      $collection = [];
      foreach ($model_names as $model_name) {
        if (isset($data['params'][$model_name]) && !empty($data['params'][$model_name])) {
          $collection[] = $data['params'][$model_name];
        }
      }
      $data['params'][$collection_name] = implode(',', $collection);
    }

    if (empty($data['params']['categories'])) {
      $data['errors']['categories'] = sprintf($this->config['error_messages']['required'], 'お問い合わせのカテゴリ');
    }

    // メールアドレスチェック
    if ($data['params']['email'] !== $data['params']['confirm_email']) {
      $data['errors']['confirm_email'] = sprintf($this->config['error_messages']['confirm_email'], 'メールアドレス');
    }

    if ($mode === 'index') {
      // Modelの都合上、未入力エラーが含まれているのでクリア
      unset($data['errors']);

      // レンダリング
      $this->render('index', $data);
    } else {
      // 入力画面以外はトークンチェックを最初に行う
      if (!$this->validateToken($_POST['token'])) {
        // トークンエラー画面
        $this->render('tokenError', $data);
      } else {
        // 成功時
        if (count($data['errors'])) {
          // 入力画面（入力エラー表示）
          $this->render('index', $data);
        } else if ($mode === 'confirm') {
          // 確認画面
          $this->render('confirm', $data);
        } else if ($mode === 'send') {
          // ファイルとCSVデータを保存
          $id = $this->getIdFromCSV();
          $this->saveCSV($id, $data['params']);

          // メール送信
          if ($this->sendMail($data['params'])) {
            // 完了画面
            $this->render('complete', $data);
          } else {
            // メールエラー画面
            $this->render('mailError', $data);
          }
        }
      }
    }
  }
}
