<?php
// inputなどの入力欄を出力
function echo_field($data, $name, $suffix = '') {
  $interface = $data['interfaces'][$name];
  $type = $interface['type'];
  $is_required = isset($interface['required']) && $interface['required'];
  $is_multiple = isset($interface['multiple']) && $interface['multiple'];
  $is_single = isset($interface['single']) && $interface['single'];
  $field_name = $is_multiple ? $name . '[]' : $name;
  $value = $data['params'][$name];
  $list = isset($interface['list']) ? $interface['list'] : [];

  // 属性関係
  $attrs = [sprintf('name="%s"', htmlspecialchars($field_name))];
  $attrs_norequired = [sprintf('name="%s"', htmlspecialchars($field_name))];
  foreach ([
    'minLength',
    'maxLength',
    'pattern',
    'accept',
    'required',
    'placeholder',
    'autocomplete',
    'class',
  ] as $attr) {
    if (isset($interface[$attr]) && $interface[$attr] !== false) {
      $attr_name = $attr;
      $attr_value = $interface[$attr];
      if ($attr_value === true) {
        $attr_str = sprintf('%s', htmlspecialchars($attr_name));
      } else {
        if ($attr_name === 'maxLength' && $type === 'textarea') {
          $attr_str = sprintf('%s="%s"', htmlspecialchars('data-' . $attr_name), htmlspecialchars($attr_value));
        } else {
          $attr_str = sprintf('%s="%s"', htmlspecialchars($attr_name), htmlspecialchars($attr_value));
        }
      }

      $attrs[] = $attr_str;

      if ($attr !== 'required') {
        $attrs_norequired[] = $attr_str;
      }
    }
  }

  $attrs = implode(' ', $attrs);
  $attrs_norequired = implode(' ', $attrs_norequired);

  // 種類別に出力
  $template_dir = __DIR__ . '/../parts/field/';
  if ($type === 'select') {
    include($template_dir . 'select.php');
  } elseif ($type === 'textarea') {
    include($template_dir . 'textarea.php');
  } elseif ($type === 'radio' || $type === 'checkbox') {
    include($template_dir . 'radio_checkbox.php');
  } elseif ($type === 'file') {
    include($template_dir . 'file.php');
  } else {
    // 汎用input（主にテキスト系）
    include($template_dir . 'text.php');
  }

  // エラーメッセージ
  if (isset($data['errors'][$name])) {
    include($template_dir . 'error.php');
  }
}
