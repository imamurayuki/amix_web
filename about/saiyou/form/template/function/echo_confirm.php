<?php
// inputなどの入力欄の確認テキストを出力
function echo_confirm($data, $name, $suffix = '') {
  $interface = $data['interfaces'][$name];
  $type = $interface['type'];
  $is_multiple = isset($interface['multiple']) && $interface['multiple'];
  $field_name = $is_multiple ? $name . '[]' : $name;
  $value = $data['params'][$name];

  // 種類別に出力
  $template_dir = __DIR__ . '/../parts/confirm/';
  if ($type === 'file') {
    include($template_dir . 'file.php');
  } else {
    // 汎用input（主にテキスト系）
    include($template_dir . 'text.php');
  }
}
