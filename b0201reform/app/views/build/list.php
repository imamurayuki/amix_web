<?php echo $_element ?>

<div id="mainContents">
<h1 class="reformTitle"><?php echo $selectedYear ?>年リフォーム</h1>
  <p class="mainText03">これまで行ったリフォーム事例について詳細をご紹介いたします。アミックスでは、オーナー様のご予算やご希望をお伺いしたうえで最適なリフォーム案をご提案しています。</p>
    
  <?php $i = 0; foreach ($data as $item): ?>
    <?php
        $image = $base_url . Utils::image($item['building_detail_id'], 'details', 
            $item['image_file1'], RESIZE_IMAGE_SMALL);
        $newImage = Utils::getNewImage($item['created_at']);
    ?>
    <?php if ($i % LIST_ROW_NUMBER == 0): ?>
      <?php 
      if ($i !== 0) {
         echo '</div></div>';
      } ?>
      <div class="kenchiku2">
        <div id="itemBox03">
          <dl class="buildList">
            <dt><a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><img src="<?php echo $image ?>" /></a></dt>
            <dd class="buildName">
            <a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo $this->truncate($item['name'], 15, '…') ?></a>&nbsp;<?php if ($newImage): ?><img src="<?php echo $base_url . $newImage ?>" width="24" height="13" /><?php endif; ?></dd>
            <dd class="buildDay"><?php echo date('Y/m/d', strtotime($item['created_at']))?></dd>
          </dl>
    <?php else: ?>
      <?php
      if (($i % LIST_ROW_NUMBER) == (LIST_ROW_NUMBER - 1)) {
          $last = ' last';
      } else {
          $last = '';
      } ?>
          <dl class="buildList<?php echo $last ?>" >
            <dt><a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><img src="<?php echo $image ?>" /></a></dt>
            <dd class="buildName">
            <a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo $this->truncate($item['name'], 15, '…') ?></a>&nbsp;<?php if ($newImage): ?><img src="<?php echo $base_url . $newImage ?>" width="24" height="13" /><?php endif; ?></dd>
            <dd class="buildDay"><?php echo date('Y/m/d', strtotime($item['created_at'])) ?></dd>
          </dl>
    <?php endif; $i++; ?>
 <?php endforeach; ?>

  <?php if (count($data) > 0): ?>
  </div></div>
  <?php endif ?>
  
  <div id="pageNavi">
    <ul class="btn btn01">
      <li><a href="#pageTop"><span>このページのトップへ</span></a></li>
    </ul>
  </div>
</div>
