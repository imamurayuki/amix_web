<div id="sideContents">
  <h2><a href="<?php echo SITE_URL ?>/build/b0201reform.html">アミックスのリフォーム</a></h2>
  <ul class="pd0">
    <li class="big this"><a href="<?php echo $base_url . '/interior' ?>">リフォーム事例［内装］</a>
      <?php if (isset($data) && !empty($data)): ?>
      <ul class="sub">
        <?php foreach ($data as $item): ?>
        <?php $newImage = Utils::getNewImage($item['created_at']); ?>
        <li><a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo Utils::truncate($item['name'], 20, '…') ?></a><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </li>
    <li class="big"><a href="<?php echo $base_url ?>">リフォーム事例［外観］</a>
    <li class="big"><a href="<?php echo $base_url . '/other' ?>">リフォーム事例［その他］</a>
  </ul>
  <ul>
    <li><a href="<?php echo SITE_URL ?>/0500faq.html#faqReform">よくあるご質問</a></li>
  </ul>
</div>


