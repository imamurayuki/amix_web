<script type="text/javascript" src="<?php echo $base_url ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function() {
    var isChecked = false;
    $('.Status').each(function() {
        var checked = $(this).attr('checked');
        if (checked) {
            isChecked = true;
        }
    });
    if (!isChecked) {
      $('#Status1').attr('checked', 'checked');
    }
});
CKEDITOR.config.toolbar = [
['Source']
,['Bold','Italic','Underline','Strike','-','Subscript','Superscript']
,['FontSize']
,['TextColor','BGColor', 'Smiley']
,['JustifyLeft','JustifyCenter','JustifyRight']
,['Link','Unlink']
];
CKEDITOR.config.resize_enabled = false;
CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
</script>
<h2><?php echo ($action == 'add') ? '新規記事' : '記事編集' ?></h2>
<p><small><span class="required">*</span> 印の項目は必須です。</small></p>

<?php
if ($action == 'edit') {
    $actionUrl = $base_url . '/admin/desc/' . $action . '/' . $building_id . '/' . $data['id'];
} else {
    $actionUrl = $base_url . '/admin/desc/' . $action . '/' . $building_id;
}
?>
<form id="ModifyForm" method="post" action="<?php echo $actionUrl; ?>" enctype="multipart/form-data">

 <input type="hidden" name="id" value="<?php echo Utils::textValue('id', $data) ?>" id="BuildingDetailId" />
 <input type="hidden" name="building_id" value="<?php echo Utils::textValue('building_id', $data) ?>" id="BuildingDetailBuildingId" />

<table cellpadding="0" cellspacing="0" class="admin-row-table-01">
  <tr>
    <th class="col-head" style="width:15%;">
      <span class="required">*</span>&nbsp;<label for="BuildingStatus">公開状況</label>
    </th>
    <td class="col-input">
      <input type="radio" name="status" value="1" id="Status1" class="Status"
        <?php echo isset($data['status']) && $data['status'] == 1 ? 'checked="checked"' : ''; ?>/>
      <label for="Status1">公開</label>
      <input type="radio" name="status" value="2" id="Status2" class="Status"
        <?php echo isset($data['status']) && $data['status'] == 2 ? 'checked="checked"' : ''; ?>/>
      <label for="Status2">非公開</label>
      <?php echo $this->error($errors, 'status') ?>
    </td>
  </tr>
  <tr>
    <th class="col-head" style="width:15%;">画像1</th>
    <td class="col-input">
      <small>一覧への表示は「画像1」が使われます。</small><br />
      <input type="file" name="image1" />
      <?php
      if ($action == 'edit' && Utils::isExistImage($data['id'], 'details', $data['image_file1'])) {
          $imageUrl =  $base_url . Utils::image($data['id'], 'details',
              $data['image_file1'], RESIZE_IMAGE_SMALL);
          echo "<p style=\"margin:0;padding:0;\"><img src=\"{$imageUrl}\" /></p>";
          echo "<input type=\"hidden\" value=\"{$data['image_file1']}\" name=\"image_file1\" />";
          echo '<input type="checkbox" value="1" name="del_image1" id="del_image1"/>';
          echo '<label for="del_image1">このファイルを削除する</label>';
      }
      ?>
    </td>
  </tr>
  <tr>
    <th class="col-head" style="width:15%;">画像2</th>
    <td class="col-input">
      <input type="file" name="image2" />
      <?php
      if ($action == 'edit' && Utils::isExistImage($data['id'], 'details', $data['image_file2'])) {
          $imageUrl =  $base_url . Utils::image($data['id'], 'details',
              $data['image_file2'], RESIZE_IMAGE_SMALL);
          echo "<p style=\"margin:0;padding:0;\"><img src=\"{$imageUrl}\" /></p>";
          echo "<input type=\"hidden\" value=\"{$data['image_file2']}\" name=\"image_file2\" />";
          echo '<input type="checkbox" value="1" name="del_image2" id="del_image2"/>';
          echo '<label for="del_image2">このファイルを削除する</label>';
      }
      ?>
    </td>
  </tr>
  <tr>
    <th class="col-head" style="width:15%;">画像3</th>
    <td class="col-input">
      <input type="file" name="image3" />
      <?php
      if ($action == 'edit' && Utils::isExistImage($data['id'], 'details', $data['image_file3'])) {
          $imageUrl =  $base_url . Utils::image($data['id'], 'details',
              $data['image_file3'], RESIZE_IMAGE_SMALL);
          echo "<p style=\"margin:0;padding:0;\"><img src=\"{$imageUrl}\" /></p>";
          echo "<input type=\"hidden\" value=\"{$data['image_file3']}\" name=\"image_file3\" />";
          echo '<input type="checkbox" value="1" name="del_image3" id="del_image3"/>';
          echo '<label for="del_image3">このファイルを削除する</label>';
      }
      ?>
    </td>
  </tr>
  <tr>
    <th class="col-head">
      <label for="DetailDescription">説明</label>
    </th>
    <td class="col-input">
      <textarea class="ckeditor" name="description" rows="5" cols="100"><?php echo Utils::textValue('description', $data) ?></textarea>
    </td>
  </tr>
</table>

<div class="align-center">
  <input type="submit" class="btn-red button" value="投　稿" />
  <a href="<?php echo $base_url ?>/admin/desc/<?php echo $building_id; ?>" class="btn-green button">戻る</a>
</div>

</form>
<!-- end contentsBody -->

