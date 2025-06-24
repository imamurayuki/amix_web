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
});
</script>
<h2>物件登録</h2>
<p><small><span class="required">*</span> 印の項目は必須です。</small></p>

<?php
if ($action == 'edit') {
    $action .= "/{$data['id']}";
}
?>
<form id="UserAddForm" method="post" action="<?php echo $base_url; ?>/admin/<?php echo $action; ?>">

 <input type="hidden" name="id" value="<?php echo Utils::textValue('id', $data) ?>" id="BuildingId" />

<table cellpadding="0" cellspacing="0" class="admin-row-table-01">
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
      <span class="required">*</span>&nbsp;<label for="BuildingName">計画名</label>
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
    <th class="col-head">
      <label for="BuildingType">タイプ</label>
    </th>
    <td class="col-input">
      <div class="renderOther">
        <span>
          <select name="type" id="BuildingType" style="width:150px;">
            <option value="0">選択して下さい</option>
            <?php foreach (Configure::read('type') as $k =>  $v): ?>
            <option value="<?php echo $k ?>" <?php echo Utils::optionValue('type', $k, $data) ?>><?php echo $v ?></option>
            <?php endforeach ?>
          </select> 
        </span>
        <span>
          <small>その他の時は<br />ご入力ください</small>
        </span>
        <span>
        <input name="type_other" type="text" maxlength="255" 
          value="<?php echo Utils::textValue('type_other', $data) ?>" id="TypeOther" />
        </span>
      </div>
      <?php echo $this->error($errors, 'type'); ?>
    </td>
  </tr>
  <tr>
    <th class="col-head">
      <label for="BuildingStructure">構造</label>
    </th>
    <td class="col-input">
      <div class="renderOther">
        <span>
          <select name="structure" id="BuildingStructure" style="width:150px;">
            <option value="0">選択して下さい</option>
            <?php foreach (Configure::read('structure') as $k =>  $v): ?>
            <option value="<?php echo $k ?>" <?php echo Utils::optionValue('structure', $k, $data) ?>><?php echo $v ?></option>
            <?php endforeach ?>
          </select> 
        </span>
        <span>
          <small>その他の時は<br />ご入力ください</small>
        </span>
        <span><input name="structure_other" type="text" maxlength="255" 
          value="<?php echo Utils::textValue('structure_other', $data) ?>" id="StructureOther" /></span>
      </div>
      <?php echo $this->error($errors, 'structure'); ?>
    </td>
  </tr>
  <tr>
    <th class="col-head">
      <label for="BuildingPurpose">用途</label>
    </th>
    <td class="col-input">
      <div class="renderOther">
        <span>
          <select name="purpose" id="BuildingPurpose" style="width:150px;">
            <option value="0">選択して下さい</option>
            <?php foreach (Configure::read('purpose') as $k =>  $v): ?>
            <option value="<?php echo $k ?>" <?php echo Utils::optionValue('purpose', $k, $data) ?>><?php echo $v ?></option>
            <?php endforeach ?>
          </select> 
        </span>
        <span><small>その他の時は<br />ご入力ください</small></span>
        <span>
          <input name="purpose_other" type="text" maxlength="255" 
            value="<?php echo Utils::textValue('purpose_other', $data) ?>" id="PurposeOther" /></span>
      </div>
      <?php echo $this->error($errors, 'purpose'); ?>
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
    <th class="col-head"><label for="BuildingExpectedDateOfCompleted">竣工予定</label></th>
    <td class="col-input">
      <small>例:2011年3月上旬</small>
      <input name="expected_date_of_completed" type="text" size="40" maxlength="255" 
        style="width:150px;" id="BuildingExpectedDateOfCompleted"
        value="<?php echo Utils::textValue('expected_date_of_completed', $data) ?>" />
      <small>予定</small>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingFormalName">正式名称</label></th>
    <td class="col-input">
      <input name="formal_name" type="text" size="40" maxlength="255" 
        style="width:150px;" id="BuildingFormalName"
        value="<?php echo Utils::textValue('formal_name', $data) ?>" />
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingOther">その他</label></th>
    <td class="col-input">
      <textarea name="other" rows="5" cols="100"><?php echo Utils::textValue('other', $data) ?></textarea>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingMark">表示マーク</label></th>
    <td class="col-input">
      <input type="hidden" value="0" name="mark" id="BuildingMark_">
      <input type="checkbox" value="1" name="mark[]" id="BuildingMark1"<?php echo Utils::checkValue('mark', 1, $data); ?>>
      <label for="BuildingMark1">満室御礼</label>
      <input type="checkbox" value="2" name="mark[]" id="BuildingMark2"<?php echo Utils::checkValue('mark', 2, $data); ?>>
      <label for="BuildingMark2">竣工</label>
      <input type="checkbox" value="4" name="mark[]" id="BuildingMark4"<?php echo Utils::checkValue('mark', 4, $data); ?>>
      <label for="BuildingMark4">内覧会あり</label>
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingLink">内覧会ページ</label></th>
    <td class="col-input">
      <input type="hidden" value="0" name="link" id="BuildingLink_">
      <input type="checkbox" value="1" name="link" id="BuildingLink"<?php echo Utils::checkValue('link', 1, $data); ?>>
      <label for="BuildingLink">リンク</label>
      <input name="link_url" type="text" size="40" maxlength="255" id="BuildingLinkUrl"
        value="<?php echo Utils::textValue('link_url', $data) ?>" />
    </td>
  </tr>
  <tr>
    <th class="col-head"><label for="BuildingOmpletedDate">引渡し日</label></th>
    <td class="col-input">
      <input name="completed_date" type="text" 
         value="<?php echo Utils::textValue('completed_date', $data) ?>" id="datepicker" />
<script type="text/javascript">
$( "#datepicker" ).datepicker( {
	closeText: '閉じる',
	prevText: '&#x3c;前',
	nextText: '次&#x3e;',
	currentText: '今日',
	monthNames: ['1月','2月','3月','4月','5月','6月',
	'7月','8月','9月','10月','11月','12月'],
	monthNamesShort: ['1月','2月','3月','4月','5月','6月',
	'7月','8月','9月','10月','11月','12月'],
	dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
	dayNamesShort: ['日','月','火','水','木','金','土'],
	dayNamesMin: ['日','月','火','水','木','金','土'],
	weekHeader: '週',
	dateFormat: 'yy-mm-dd',
	firstDay: 0,
	isRTL: false,
	showMonthAfterYear: true,
	yearSuffix: '年'
} );
</script>
      <?php echo $this->error($errors, 'completed_date'); ?>
    </td>
  </tr>
</table>

<div class="align-center">
  <input type="submit" class="btn-red button" value="登　録" />
  <a href="<?php echo $base_url ?>/admin" class="btn-green button">戻る</a>
</div>

</form>
<!-- end contentsBody -->

