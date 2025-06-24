<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<style type="text/css">
.ui-widget {
	font-size:12px;
}
.ui-widget-content .ui-state-default {
	font-weight:bold;
	color:#000;
}
</style>
<script type="text/javascript">
google.load("jquery", "1.4.4");
google.load("jqueryui", "1.8.7"); 
</script>
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
    $('.Interior').each(function() {
        var checked = $(this).attr('checked');
        if (checked) {
            isChecked = true;
        }
    });
    if (!isChecked) {
      $('#BuildingIsInterior0').attr('checked', 'checked');
    }
});
</script>
<h2>物件登録</h2>
<p><small><span class="required">*</span> 印の項目は必須です。</small></p>

<?php
if ($action == 'edit') {
   // $action .= "/{$data['id']}";
}

if ($action == 'edit') {
    $actionUrl = "{$action}/{$data['id']}";
}
else
{
	$actionUrl = $action;
}

//var_dump($action);
//var_dump($data);
///var_dump(Utils::isExistImage($data['id'], 'add', $data['image_file1']));
?>
<form id="UserAddForm" method="post" action="<?php echo $base_url; ?>/admin/<?php echo $actionUrl; ?>" enctype="multipart/form-data">

 <input type="hidden" name="id" value="<?php echo Utils::textValue('id', $data) ?>" id="BuildingId" />

<table cellpadding="0" cellspacing="0" class="admin-row-table-01">
  <tr>
    <th class="col-head" style="width:15%";>物件画像</th>
    <td class="col-input">
      <small>記事の物件画像として使われます。</small><br />
      <input type="file" name="image1" />
      <?php
      if ($action == 'edit' && Utils::isExistImage($data['id'], 'add', $data['image_file1'])) {
          $imageUrl =  $base_url . Utils::image($data['id'], 'add',
              $data['image_file1'], RESIZE_IMAGE_LARGE);
          echo "<p style=\"margin:0;padding:0;\"><img src=\"{$imageUrl}\" /></p>";
          echo "<input type=\"hidden\" value=\"{$data['image_file1']}\" name=\"image_file1\" />";
          echo '<input type="checkbox" value="1" name="del_image1" id="del_image1"/>';
          echo '<label for="del_image1">このファイルを削除する</label>';
      }
      ?>
    </td>
  </tr>
  <tr>
    <th class="col-head" style="width:15%;">
      <span class="required">*</span>&nbsp;<label for="BuildingStatus">公開状況</label>
    </th>
    <td class="col-input">
      <input type="radio" name="status" value="1" id="Status1" class="Status"
        <?php echo isset($data['status']) && $data['status'] == 1 ? 'checked="checked"' : ''; ?>/>
      <label for="Status1">トップ</label>
      <input type="radio" name="status" value="2" id="Status2" class="Status"
        <?php echo isset($data['status']) && $data['status'] == 2 ? 'checked="checked"' : ''; ?>/>
      <label for="Status2">過去フォルダ</label>
      <input type="radio" name="status" value="3" id="Status3" class="Status"
        <?php echo isset($data['status']) && $data['status'] == 3 ? 'checked="checked"' : ''; ?>/>
      <label for="Status3">非公開</label>
      <?php echo $this->error($errors, 'status'); ?>
    </td>
  </tr>
  <tr>
    <th class="col-head" style="width:15%;">
      <span class="required">*</span>&nbsp;<label for="BuildingName">物件名</label>
    </th>
    <td class="col-input">
      <input name="name" type="text" size="80" maxlength="255" 
         value="<?php echo Utils::textValue('name', $data) ?>" id="Name" />
      <?php echo $this->error($errors, 'name'); ?>
    </td>
  </tr>
  <tr>
    <th class="col-head">
      <label for="BuildingPref">所在地</label>
    </th>
    <td class="col-input">
      <div class="tableClear">
        <span>
          <table>
            <tr>
              <td class="title"><small>都道府県名</small></td>
            </tr>
            <tr>
              <td><input name="pref" type="text" size="12" maxlength="255" style="width:80px;"
                value="<?php echo Utils::textValue('pref', $data) ?>" id="BuildingPref" /></td>
            </tr>
          </table>
        </span>
        <span>
          <table>
            <tr>
              <td class="title"><small>市区町村</small></td>
            </tr>
            <tr>
              <td><input name="address1" type="text" size="12" maxlength="255" id="BuildingAddress1" style="width:220px;"
                 value="<?php echo Utils::textValue('address1', $data) ?>"  /></td>
            </tr>
          </table>
        </span>
        <span>
          <table>
            <tr>
              <td class="title"><small>丁目・番地</small></td>
            </tr>
            <tr>
              <td><input name="address2" type="text" size="12" maxlength="255" style="width:220px;"
                  value="<?php echo Utils::textValue('address2', $data) ?>" id="BuildingAddress2" />
              </td>
            </tr>
          </table>
        </span>
      </div>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingHouse1">戸数</label></th>
    <td class="col-input">
      <input name="houses1" type="text" size="40" maxlength="255" 
        value="<?php echo Utils::textValue('houses1', $data) ?>" id="BuildingHouse1" />
      <small>棟</small>
      <input name="houses2" type="text" size="40" maxlength="255" 
        value="<?php echo Utils::textValue('houses2', $data) ?>" id="BuildingHouse2" />
      <small>戸</small>
      <?php echo $this->error($errors, 'houses1'); ?>
      <?php echo $this->error($errors, 'houses2'); ?>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingRoomLayout">間取り</label></th>
    <td class="col-input">
      <small>例:1K 2LDK等</small>
      <input name="room_layout" type="text" size="40" maxlength="255" style="width:150px;"
        value="<?php echo Utils::textValue('room_layout', $data) ?>" id="BuildingRoomLayout" />
      <input name="room_layout_size1" type="text" size="40" maxlength="255" style="width:80px;"
        value="<?php echo Utils::textValue('room_layout_size1', $data) ?>" id="BuildingRoomLayoutSize1" /><small>㎡ ～</small><input name="room_layout_size2" type="text" size="40" maxlength="255"  style="width:80px;"
        value="<?php echo Utils::textValue('room_layout_size2', $data) ?>" id="BuildingRoomLayoutSize2" /><small>㎡</small>
      <?php echo $this->error($errors, 'room_layout_size1'); ?>
      <?php echo $this->error($errors, 'room_layout_size2'); ?>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingExpectedDateOfCompleted">築年</label></th>
    <td class="col-input">
      <small>例:2011年3月</small>
      <input name="expected_date_of_completed" type="text" size="40" maxlength="255" 
        style="width:150px;" id="BuildingExpectedDateOfCompleted"
        value="<?php echo Utils::textValue('expected_date_of_completed', $data) ?>" />
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingOther">工事</label></th>
    <td class="col-input">
      <textarea name="other" rows="5" cols="100"><?php echo Utils::textValue('other', $data) ?></textarea>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingLink">内覧会ページ</label></th>
    <td class="col-input">
      <input type="hidden" value="0" name="link" id="BuildingLink_">
      <input type="checkbox" value="1" name="link" id="BuildingLink"<?php echo Utils::checkValue('link', 1, $data); ?>>
      <label for="BuildingLink">リンク</label>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingComment">コメント</label></th>
    <td class="col-input">
      <textarea name="comment" rows="5" cols="100"><?php echo Utils::textValue('comment', $data) ?></textarea>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingIsInterior">外観・内装フラグ</label></th>
    <td class="col-input">
      <input type="radio" name="is_interior" value="0" id="BuildingIsInterior0" class="Interior"
		<?php echo isset($data['is_interior']) &&
		   ($data == null || $data['is_interior'] != 1) ? 'checked="checked"' : ''; ?>/>
      <label for="BuildingIsInterior0">外観</label>
      <input type="radio" name="is_interior" value="1" id="BuildingIsInterior1" class="Interior"
		<?php echo isset($data['is_interior']) &&
			$data['is_interior'] == 1 ? 'checked="checked"' : ''; ?>/>
      <label for="BuildingIsInterior1">内装</label>
      <input type="radio" name="is_interior" value="2" id="BuildingIsInterior2" class="Interior"
		<?php echo isset($data['is_interior']) &&
			$data['is_interior'] == 2 ? 'checked="checked"' : ''; ?>/>
      <label for="BuildingIsInterior2">その他</label>

      <?php echo $this->error($errors, 'is_interior'); ?>
    </td>
  </tr>
</table>

<div class="align-center">
  <input type="submit" class="btn-red button" value="登　録" />
  <a href="<?php echo $base_url ?>/admin" class="btn-green button">戻る</a>
</div>

</form>
<!-- end contentsBody -->

