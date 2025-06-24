<div id="sideContents">
  <div id="sideBtn">
    <p id="contact01"><a href="<?php echo SITE_URL ?>/0620contact_shiryo/index.php">アパート建築・土地活用資料請求はこちら 0120-441-432</a></p>
  </div>

  <h2 id="reformNaviTop"><a href="<?php echo SITE_URL ?>/build/b0201reform.html">アミックスリフォーム</a></h2>
  <ul id="reformNavi" class="sideNavi">
    <li id="sideNavi01_f">
      <a href="<?php echo $base_url ?>">アミックスリフォーム事例</a>
      <?php if (isset($data) && !empty($data)): ?>
      <ul class="innerNavi">
        <?php foreach ($data as $item): ?>
        <?php $newImage = Utils::getNewImage($item['created_at']); ?>
        <li><a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo Utils::truncate($item['name'], 20, '…') ?></a><?php if ($newImage): ?>&nbsp;<img src="<?php echo $base_url . $newImage ?>" width="24" height="13" /><?php endif; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
      <?php if (!empty($years)): ?>
      <ul class="innerNavi2">
        <?php foreach ($years as $year): ?>
        <li><a href="<?php echo $base_url . "/list/{$year['year']}" ?>">・<?php echo $year['year'] ?>年リフォーム</a></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </li>
    <li id="sideNavi12"><a href="<?php echo SITE_URL ?>/0500faq.html#faqReform">よくあるご質問</a></li>
  </ul>
</div>
