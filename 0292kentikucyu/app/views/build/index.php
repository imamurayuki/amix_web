    <!--contentsここから-->
      <div id="mainContents">
		  <a class="button bt" href="https://amix.co.jp/under-construction/">» 「ただいま建築中」がリニューアルしました。<br>
ぜひ、あたらしいページもご覧ください。</a>
		<p class="mainText">弊社で建築中の物件を写真でご紹介しています。オーナー様の物件が完成していく様子をどうぞご覧ください。<br>今後も順次物件を追加する予定です。どうぞご期待ください。</p>
        
<?php
$uri = parse_url($_SERVER['REQUEST_URI']);
$selectedTag = 'default';
if (isset($uri['query']) && !empty($uri['query']) && $uri['query'] == 'list=print') {
	$selectedTag = 'print';
}
?>
        
        <div id="tabon" class="tab">
            <ul class="clearfix">
			  <li<?php echo ($selectedTag == 'default') ? ' class="select"' : '' ?>>
				<p><a href="<?php echo $base_url ?>"><span>ただいま<br class="SP">建築中</span></a></p>
			  </li>
			  <li<?php echo ($selectedTag == 'print') ? ' class="select"' : '' ?>>
				<p><a href="<?php echo $base_url ?>/?list=print"><span>掲載一覧</span></a></p>
			  </li>
            </ul>
        </div>

        <div class="sumlist type2 htadj clearfix">
			<div<?php echo ($selectedTag == 'default') ?
				' style="display:block;"' : ' style="display:none;"' ?>>
            <ul>
            <?php foreach ($data as $item): ?>
              <?php
                  $image = $base_url . Utils::image($item['building_detail_id'], 'details', 
                      $item['image_file1'], RESIZE_IMAGE_SMALL);
                  $newImage = Utils::getNewImage($item['created_at']);
              ?>
              <li>
                <a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>">
                  <img src="<?php echo $image ?>" alt="" />
                  <span class="icon"><?php echo $this->truncate($item['name'], 15, '…') ?></span>
                  <span class="read"><?php echo date('Y/m/d', strtotime($item['created_at']))?><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></span>
                  
                  <?php if (!empty($item['mark']) || $item['link'] == 1): ?>
                    <p class="clearfix">
                    <?php foreach ($item['mark'] as $mark): ?>
                      <?php if ($mark == 1): ?>
                      <span class="mark1">満室御礼</span>
                      <?php endif ?>
                      <?php if ($mark == 2): ?>
                      <span class="mark2">竣工</span>
                      <?php endif ?>
                      <?php if ($mark == 4): ?>
                      <span class="mark4">内覧会あり</span>
                      <?php endif ?>
                    <?php endforeach ?>
                    </p>
                  <?php endif ?>
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
          </div>

		  <div<?php echo ($selectedTag == 'print') ?
			' style="display:block"' : ' style="display:none"' ?>>
        		<p class="pasttxt">過去の建築物件はこちらから閲覧いただけます。</p>
<?php
if (isset($years) && !empty($years)) {
  echo '<ul class="pastlist">';
  foreach ($years as $year) {
    $url = $base_url . '/list/' . $year['year'];
    echo '<li>' . "<a href=\"{$url}\">≫{$year['year']}年竣工</a></li>";
  }
  echo '</ul>';
} ?>
          </div>

        </div>
        
        <div id="tabon" class="tab2">
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
  
