<div id="sideContents">
  <h2><a href="<?php echo SITE_URL ?>/b0201reform">アミックスのリフォーム</a></h2>
	<?php if ($data['is_interior'] == 0): ?>
  <ul class="pd0">
    <li class="big this"><a href="<?php echo SITE_URL ?>/b0201reform">リフォーム事例［外観］</a>
      <?php if (isset($listItem) && !empty($listItem)): ?>
      <ul class="sub">
        <?php foreach ($listItem as $item): ?>
        <?php 
           $newImage = Utils::getNewImage($item['created_at']);
           echo ($item['id'] == $selected) ? '<li class="this">' : '<li>';
        ?>
          <a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo Utils::truncate($item['name'], 20, '…') ?></a><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></li>
          <?php endforeach; ?>
          </ul>
      <?php endif; ?>
    </li>
    <li class="big"><a href="<?php echo $base_url . '/interior' ?>">リフォーム事例［内装］</a>
  </ul>
<?php elseif ($data['is_interior'] == 1): ?>
  <ul class="pd0">
    <li class="big this"><a href="<?php echo $base_url . '/interior' ?>">リフォーム事例［内装］</a>
      <?php if (isset($listInteriorItem) && !empty($listInteriorItem)): ?>
      <ul class="sub">
        <?php foreach ($listInteriorItem as $item): ?>
        <?php $newImage = Utils::getNewImage($item['created_at']);
           echo ($item['id'] == $selected) ? '<li class="this">' : '<li>';
        ?>
        <a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo Utils::truncate($item['name'], 20, '…') ?></a><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></li>
        <?php endforeach; ?>
          </ul>
      <?php endif; ?>
    </li>
    <li class="big"><a href="<?php echo SITE_URL ?>/b0201reform">リフォーム事例［外観］</a>
  </ul>
<?php elseif ($data['is_interior'] == 2): ?>
  <ul class="pd0">
    <li class="big this"><a href="<?php echo $base_url . '/other' ?>">リフォーム事例［その他］</a>
      <?php if (isset($listOtherItem) && !empty($listOtherItem)): ?>
      <ul class="sub">
        <?php foreach ($listOtherItem as $item): ?>
        <?php $newImage = Utils::getNewImage($item['created_at']);
           echo ($item['id'] == $selected) ? '<li class="this">' : '<li>';
        ?>
        <a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo Utils::truncate($item['name'], 20, '…') ?></a><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></li>
        <?php endforeach; ?>
          </ul>
      <?php endif; ?>
    </li>
    <li class="big"><a href="<?php echo SITE_URL ?>/b0201reform">リフォーム事例［外観］</a>
    <li class="big"><a href="<?php echo SITE_URL ?>/b0201reform/interior">リフォーム事例［内観］</a>
  </ul>
  <ul>
    <li><a href="<?php echo SITE_URL ?>/0500faq.html#faqReform">よくあるご質問</a></li>
  </ul>
	<?php endif ?>
</div>
