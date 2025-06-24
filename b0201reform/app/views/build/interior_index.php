<div id="mainContents">
<h2 class="subTitle">リフォーム事例</h2>
  <p class="mainText">アミックスでは、アパートやマンションのリフォーム工事を行っています。築年数が経過した物件でも、リフォームにより資産価値を高めることができます。こちらでは今までアミックスで施工したリフォームの実例をご紹介しています。どうぞご覧ください。</p>
  
  
  <div id="tabon" class="tab">
      <ul class="clearfix">
        <li><p><a href="<?php echo SITE_URL ?>/b0201reform"><span>リフォーム<br class="SP">事例［外観］</span></a></p></li>
        <li class="select"><p><a href="<?php echo SITE_URL ?>/b0201reform/interior"><span>リフォーム<br class="SP">事例［内装］</span></a></p></li>
        <li><p><a href="<?php echo SITE_URL ?>/b0201reform/other"><span>リフォーム<br class="SP">事例［その他］</span></a></p></li>
      </ul>
  </div>
  <div class="sumlist type2 htadj clearfix">
  
  	<div>
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
              <span class="read"><!--<?php echo date('Y/m/d', strtotime($item['created_at']))?>--><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
  </div>
  <div class="tab2">
      <ul class="clearfix">
        <li><p><a href="<?php echo SITE_URL ?>/b0201reform"><span>リフォーム<br class="SP">事例［外観］</span></a></p></li>
        <li class="select"><p><a href="<?php echo SITE_URL ?>/b0201reform/interior"><span>リフォーム<br class="SP">事例［内装］</span></a></p></li>
        <li><p><a href="<?php echo SITE_URL ?>/b0201reform/other"><span>リフォーム<br class="SP">事例［その他］</span></a></p></li>
      </ul>
  </div>

</div>
<!-- sidebarここから-->
<?php echo $_element ?>
<!-- sidebarここまで -->
