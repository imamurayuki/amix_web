<h2>ユーザ登録登録</h2>
<p><small><span class="required">*</span> 印の項目は必須です。</small></p>
<?php
if ($action == 'users/edit') {
    $action .= "/{$id}";
}
?>
<form id="UserAddForm" method="post" action="<?php echo $base_url; ?>/admin/<?php echo $action; ?>">
 <input type="hidden" name="id" value="<?php echo $id ?>" id="UserId" />

<table cellpadding="0" cellspacing="0" class="admin-row-table-01">
  <tr>
  <tr>
    <th class="col-head" style="width:15%;">
      <span class="required">*</span>&nbsp;<label for="UserId">ID</label>
    </th>
    <td class="col-input">
      <input name="name" type="text" size="80" maxlength="255" style="width:120px;"
         value="<?php echo $name ?>" id="UserName" />
      <?php echo $this->error($errors, 'name'); ?>
    </td>
  </tr>
  <tr>
    <th class="col-head">
      <span class="required">*</span>&nbsp;<label for="UserPassword">パスワード</label>
    </th>
    <td class="col-input">
      <input name="password" type="text" size="12" maxlength="255" style="width:120px;"
        value="<?php echo $password ?>" id="UserPassword" />
      <?php echo $this->error($errors, 'password'); ?>
    </td>
  </tr>
</table>

<div class="align-center">
  <input type="submit" class="btn-red button" value="登　録" />
  <a href="<?php echo $base_url ?>/admin/users" class="btn-green button">戻る</a>
</div>

</form>
<!-- end contentsBody -->

