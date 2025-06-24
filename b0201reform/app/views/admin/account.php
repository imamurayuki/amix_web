<h2>ユーザ一覧</h2>

<?php
if (isset($errors) && !empty($errors)) {
    echo '<div style="margin-bottom: 20px;">';
    foreach ($errors as $error) {
        echo '<p class="error-message">' . $error . '</p>';
    }
    echo '</div>';
}
?>
<!-- pagination -->
<table cellpadding="0" cellspacing="0" class="admin-col-table-01" id="TableUsers">
  <tr>
    <th>No</th>
    <th>アカウント名</th>
    <th>作成日付</th>
    <th>操作</th>
  </tr>
  <?php if (!empty($users)): ?>
  <?php $i = 0; foreach ($users as $user): ?>
  <tr<?php echo ($i++ % 2 == 0) ? ' class="altrow"' : ''; ?>>
  <td><?php echo $this->escape($user['id']); ?></td>
  <td><?php echo $this->escape($user['name']); ?></td>
    <td><?php echo date('Y年m月d日', strtotime($user['created_at'])) ?></td>
    <td class="operation-button">
      <a href="<?php echo $base_url ?>/admin/users/edit/<?php echo $user['id'] ?>" class="btn-blue01-s button01-s">編集</a>
      <a href="<?php echo $base_url ?>/admin/users/delete/<?php echo $user['id'] ?>" class="btn-gray-s button-s" 
         onclick="return confirm(&#039;admin を本当に削除してもいいですか？&#039;);">削除</a>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php endif; ?>
</table>

<div class="align-center">
  <a href="<?php echo $base_url ?>/admin/users/add" class="btn-red button">新規登録</a>
</div>
