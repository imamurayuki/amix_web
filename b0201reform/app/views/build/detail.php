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
?>

    <div id="mainContents">
	<h2 class="subTitle">リフォーム事例</h2>
      <p class="mainText">アミックスでは、アパートやマンションのリフォーム工事を行っています。築年数が経過した物件でも、リフォームにより資産価値を高めることができます。こちらでは今までアミックスで施工したリフォームの実例をご紹介しています。どうぞご覧ください。</p>


      <div id="tabon" class="tab">
          <ul class="clearfix">
            <li<?php echo $data['is_interior'] == 0 ? ' class="select"' : '' ?>><p><a href="<?php echo SITE_URL ?>/b0201reform"><span>リフォーム<br class="SP">事例［外観］</span></a></p></li>
			<li<?php echo $data['is_interior'] == 1 ? ' class="select"' : '' ?>><p><a href="<?php echo SITE_URL ?>/b0201reform/interior"><span>リフォーム<br class="SP">事例［内装］</span></a></p></li>
			<li<?php echo $data['is_interior'] == 2 ? ' class="select"' : '' ?>><p><a href="<?php echo SITE_URL ?>/b0201reform/other"><span>リフォーム<br class="SP">事例［その他］</span></a></p></li>
          </ul>
      </div>

      <h3 class="subTitle"><?php echo $this->escape($this->truncate($data['name'], 32, '…')) ?></h3>
      <div class="summry2">
        <h4>■物件詳細</h4>
        <div class="box clearfix">
          <div class="left">
          	<?php
        $image1 = $base_url . Utils::image($data['id'], 'add', $data['image_file1'], RESIZE_IMAGE_LARGE);
        ?>
         <img src="<?php echo $image1; ?>" width="300" height="200" alt="所在地" />
          </div>
          <div class="right">
            <dl>
              <dt>所在地</dt>
              <dd><?php echo $this->escape($data['pref']) . $this->escape($data['address1']) . $this->escape($data['address2']) ?></dd>
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
              <dt>築　年</dt>
              <dd><?php echo $this->escape($data['expected_date_of_completed']) ?></dd>
            </dl>
            <dl>
              <dt>工　事</dt>
              <dd><?php echo nl2br($data['other']) ?></dd>
            </dl>
        	</div>
        </div>
      </div>

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
      <div class="reform2">
          <div id="itemBox03">
              <div class="buildDetail">
                  <div class="info">
                      <p class="buildDay"><!--<?php echo date('Y/m/d', strtotime($item['created_at'])) ?>--><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></p>
                      <p class="buildText"><?php echo $item['description']; ?></p>
                  </div>
                  <div class="reform2picturearea">
                      <ul class="pictures">
                          <li>
                          <p class="picture">
                          <a title="" <?php if (Utils::isExistImage($item['id'], 'details', $item['image_file2'])):  ?>class="cboxElement" rel="large_image" href="<?php echo $base_url ?>/img/uploads/details/<?php echo $item['id'] . '/' . $item['image_file2'] ?>"<?php endif; ?>><span class="infoList_photo"><img src="<?php echo $image2; ?>" width="270" height="180" alt="所在地" /></span></a>
                          </p>
                          <p class="clickPicture"><span class="clickleft">before</span><span class="clickright">画像クリックで拡大</span></p>
                          </li>
                      </ul>
                      <ul class="pictures2">
                          <li>
                          <p class="picture">
                          <a title="" <?php if (Utils::isExistImage($item['id'], 'details', $item['image_file1'])):  ?>class="cboxElement" rel="large_image" href="<?php echo $base_url ?>/img/uploads/details/<?php echo $item['id'] . '/' . $item['image_file1'] ?>"<?php endif; ?>><span class="infoList_photo"><img src="<?php echo $image1; ?>" width="270" height="180" alt="所在地" /></span></a>
                          </p>
                          <p class="clickPicture"><span class="clickleft">after</span><span  class="clickright">画像クリックで拡大</span></p>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>


      <div class="tab2">
          <ul class="clearfix">
            <li<?php echo $data['is_interior'] == 0 ? ' class="select"' : '' ?>><p><a href="<?php echo SITE_URL ?>/b0201reform"><span>リフォーム<br class="SP">事例［外観］</span></a></p></li>
            <li<?php echo $data['is_interior'] == 1 ? ' class="select"' : '' ?>><p><a href="<?php echo SITE_URL ?>/b0201reform/interior"><span>リフォーム<br class="SP">事例［内装］</span></a></p></li>
            <li<?php echo $data['is_interior'] == 2 ? ' class="select"' : '' ?>><p><a href="<?php echo SITE_URL ?>/b0201reform/toher"><span>リフォーム<br class="SP">事例［その他］</span></a></p></li>
          </ul>
      </div>


    </div>


<!-- sidebarここから-->
<?php echo $_element ?>
<!-- sidebarここまで -->
