<link rel="stylesheet" type="text/css" href="<?php echo $base_url ?>/css/colorbox/colorbox.css" />
<script type="text/javascript" src="<?php echo $base_url ?>/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(function() {
    var w = $(window).width();
    var x = 667;
    if (w > x) {
    	$("a[rel='large_image']").colorbox();
    }
});
</script>
<?php
// プルダウン値
$types = Configure::read('type');
$structures = Configure::read('structure');
$purposes = Configure::read('purpose');

$uri = parse_url($_SERVER['REQUEST_URI']);
$selectedTag = 'default';
if (isset($uri['query']) && isset($uri['query']['list'])) {
	$selectedTag = 'print';
}
?>

    <!--contentsここから-->
      <div id="mainContents">
        <p class="mainText">弊社で建築中の物件を写真でご紹介しています。オーナー様の物件が完成していく様子をどうぞご覧ください。今後も順次物件を追加する予定です。どうぞご期待ください。</p>
        <div class="tab">
          <ul class="clearfix">
			<li<?php echo ($selectedTag == 'default') ? ' class="select"' : '' ?>>
              <p><a href="<?php echo $base_url ?>"><span>ただいま<br class="SP">建築中</span></a></p>
            </li>
            <li<?php echo ($selectedTag == 'print') ? ' class="select"' : '' ?>>
              <p><a href="<?php echo $base_url ?>/?list=print"><span>掲載一覧</span></a></p>
            </li>
          </ul>
        </div>

        <h3 class="subTitle"><?php echo $this->escape($this->truncate($data['name'], 32, '…')) ?></h3>
        <div class="summry">
          <h4>■物件詳細</h4>
          <div class="box clearfix">
            <div class="left">
              <dl>
                <dt>所在地</dt>
                <dd><?php echo $this->escape($data['pref']) . $this->escape($data['address1']) . $this->escape($data['address2']) ?></dd>
              </dl>
              <dl>
                <dt>構　造</dt>
                <dd>
                  <?php echo (!empty($data['structure']) ? $this->escape($structures[$data['structure']]) : '&nbsp;'); ?>
                  <?php if ($data['structure'] == 5 && $data['structure_other']): ?>
                  <?php echo $this->escape($data['structure_other']); ?>
                  <?php endif; ?>
                </dd>
              </dl>
              <dl>
                <dt>戸　数</dt>
                <dd>
                  <?php
                  if (!empty($data['houses1'])) {
                      echo $data['houses1'] . '棟';
                  }
                  if (!empty($data['houses2'])) {
                      echo !empty($data['houses1']) ? ' ' : '';
                      echo $data['houses2'] . '戸';
                  }
                  ?>
              </dd>
              </dl>
              <dl>
                <dt>用　途</dt>
                <dd>
                  <?php echo (!empty($data['purpose']) ? $this->escape($purposes[$data['purpose']]) : '&nbsp;');?>
                  <?php if ($data['purpose'] == 4 && $data['purpose_other']): ?>
                  <?php echo $this->escape($data['purpose_other']); ?>
                  <?php endif; ?>
                </dd>
              </dl>
              <dl>
                <dt>間取り</dt>
                <dd>
                  <?php
                  if (!empty($data['room_layout'])) {
                      echo $data['room_layout'];
                      if (!empty($data['room_layout_size1']) || !empty($data['room_layout_size2'])) {
                          echo '（';
                          if (!empty($data['room_layout_size1'])) {
                              echo $data['room_layout_size1'] . '㎡～';
                          }
                          if (!empty($data['room_layout_size2'])) {
                              if (empty($data['room_layout_size1'])) {
                                  echo '～';
                              }
                              echo $data['room_layout_size2'] . '㎡';
                          }
                          echo '）';
                      }
                  } ?>
                </dd>
              </dl>
              <dl>
                <dt>竣　工</dt>
                <dd><?php echo $this->escape($data['expected_date_of_completed']) ?>予定</dd>
              </dl>
            </div>

            <div class="right">
              <dl>
                <dt>タイプ</dt>
                <dd>
                  <?php echo (!empty($data['type']) ? $this->escape($types[$data['type']]) : '&nbsp;'); ?>
                  <?php if ($data['type'] == 4 && $data['type_other']): ?>
                  <?php echo $this->escape($data['type_other']); ?>
                  <?php endif; ?>
                </dd>
              </dl>
              <dl>
                <dt>名　称</dt>
                <dd><?php echo $this->escape($data['formal_name']) ?></dd>
              </dl>
              <dl>
                <dt>その他</dt>
                <dd><?php echo nl2br($data['other']) ?>
                  <?php if (!empty($data['link'])): ?>
                  <br>
                  <a href="<?php echo $this->escape($data['link_url']) ?>"><img src="../img/nairan_syousai.jpg" alt="内覧会詳細はこちら"></a>
                  <?php endif; ?>
                </dd>
              </dl>
              <?php if (isset($data['mark']) && count($data['mark']) > 0): ?>
                <?php foreach ($data['mark'] as $mark): ?>
                  <?php if ($mark == 1): ?>
                  <span class="mark1">満室御礼</span>
                  <?php endif ?>
                  <?php if ($mark == 2): ?>
                  <span class="mark2">竣工</span>
                  <?php endif ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </div><!--rightここまで-->
          </div><!--box clearfixここまで-->
          </div><!--summryここまで-->

          <?php if (isset($data['detail']) && count($data['detail'])): ?>
          <?php foreach ($data['detail'] as $item): ?>
          <?php
          $image1 = $base_url . Utils::image($item['id'], 'details',
              $item['image_file1'], RESIZE_IMAGE_MIDDLE);
          $image2 = $base_url . Utils::image($item['id'], 'details',
              $item['image_file2'], RESIZE_IMAGE_MIDDLE);
          $image3 = $base_url . Utils::image($item['id'], 'details',
              $item['image_file3'], RESIZE_IMAGE_MIDDLE);
          $newImage = Utils::getNewImage($item['created_at']);
          ?>
        <div class="kenchiku2">
          <div id="itemBox03">
            <div class="buildDetail">
              <div class="info">
                <p class="buildDay">
                    <?php echo date('Y/m/d', strtotime($item['created_at'])) ?>
                    <?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?>
                </p>
                <p class="buildText"><?php echo $item['description']; ?></p>
              </div>
              <ul class="pictures">

                <?php if (Utils::isExistImage($item['id'], 'details', $item['image_file1'])): ?>
                <li>
                  <p class="picture">
                   <a class="cboxElement" title="" rel="large_image" href="<?php echo $base_url ?>/img/uploads/details/<?php echo $item['id'] . '/' . $item['image_file1'] ?>"><img src="<?php echo $image1; ?>" width="240" height="220" alt="" /></a>
                  </p>
                  <p class="clickPicture">画像クリックで拡大</p>
                </li>
                <?php endif; ?>
                <?php if (Utils::isExistImage($item['id'], 'details', $item['image_file2'])): ?>
                <li>
                  <p class="picture">
                   <a class="cboxElement" title="" rel="large_image" href="<?php echo $base_url ?>/img/uploads/details/<?php echo $item['id'] . '/' . $item['image_file2'] ?>"><img src="<?php echo $image2; ?>" width="240" height="220" alt="" /></a>
                  </p>
                  <p class="clickPicture">画像クリックで拡大</p>
                </li>
                <?php endif; ?>
                <?php if (Utils::isExistImage($item['id'], 'details', $item['image_file3'])): ?>
                <li>
                  <p class="picture">
                   <a class="cboxElement" title="" rel="large_image" href="<?php echo $base_url ?>/img/uploads/details/<?php echo $item['id'] . '/' . $item['image_file3'] ?>"><img src="<?php echo $image3; ?>" width="240" height="220" alt="" /></a>
                  </p>
                  <p class="clickPicture">画像クリックで拡大</p>
                </li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <div class="tab2">
          <ul class="clearfix">
			<li<?php echo ($selectedTag == 'default') ? ' class="select"' : '' ?>>
              <p><a href="<?php echo $base_url ?>"><span>ただいま<br class="SP">建築中</span></a></p>
            </li>
            <li<?php echo ($selectedTag == 'print') ? ' class="select"' : '' ?>>
              <p><a href="<?php echo $base_url ?>/?list=print"><span>掲載一覧</span></a></p>
            </li>
          </ul>
        </div>

      </div>

      <!-- sidebarここから-->
      <?php echo $_element ?>
      <!-- sidebarここまで -->




















