<?php
if (is_array($list) && !empty($list)) {
?>
<ul class="recruitForm__inputList">
<?php
foreach ($list as $i => $item) {
  $_attrs = $attrs_norequired;

  if ($is_required && $i == 0) {
    $_attrs .= ' required';
  }

  if (($is_multiple && is_array($value) && in_array($item, $value)) || (!$is_multiple && $value === $item)) {
    $_attrs .= ' checked';
  }
?>
<li><label><input type="<?= htmlspecialchars($type) ?>" <?= $_attrs ?> value="<?= htmlspecialchars($item); ?>"><?= htmlspecialchars($item) ?></label></li>
<?php
}
?>
</ul><?= $suffix ?>
<?php
}
?>
