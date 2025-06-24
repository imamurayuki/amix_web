<?php
if (is_array($list) && !empty($list)) {
?>
<?php
foreach ($list as $i => $item) {
  $_attrs = $attrs_norequired;

  if ($is_required && $i == 0) {
    $_attrs .= ' required';
  }

  if (($is_single && is_array($value) && in_array($item, $value)) || $value === $item) {
    $_attrs .= ' checked';
  }
?>
<label><input type="<?= htmlspecialchars($type) ?>" <?= $_attrs ?> value="<?= htmlspecialchars($item); ?>"><?= htmlspecialchars($item) ?></label><br>
<?php
}
?><?= $suffix ?>
<?php
}
?>
