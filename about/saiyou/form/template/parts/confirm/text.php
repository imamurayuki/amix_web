<?php
if (is_array($value)) {
  $values = $value;
} else {
  $values = [$value];
}

$value_text = implode(', ', array_map(function($item){ return nl2br(htmlspecialchars($item)); }, $values));
if ($value_text) {
  $value_text .= $suffix;
}
?>
<?= $value_text ?>
<?php
foreach ($values as $item) {
?>
<input type="hidden" name="<?= htmlspecialchars($field_name) ?>" value="<?= htmlspecialchars($item) ?>">
<?php
}
