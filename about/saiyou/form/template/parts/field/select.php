<select <?= $attrs ?>>
  <option></option>
<?php foreach ($list as $i => $item) { ?>
  <option<?= ($value == $item) ? ' selected' : '' ?>><?= htmlspecialchars($item); ?></option>
<?php } ?>
</select><?= $suffix ?>
