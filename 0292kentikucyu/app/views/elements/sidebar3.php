      <div id="sideContents">
       <h2><a href="<?php echo SITE_URL ?>/build/0200kenchiku.html">アパート等建築</a></h2>
        <ul>
          <li class="big"><a href="<?php echo SITE_URL ?>/build/0212color_s.html">カラーアズSシリーズ</a></li>
          <li class="big"><a href="<?php echo SITE_URL ?>/build/0213color_h.html">カラーアズHシリーズ</a></li>
          <li class="big"><a href="<?php echo SITE_URL ?>/build/0220classic.html">クラシックシリーズ</a></li>
          <li class="big"><a href="<?php echo SITE_URL ?>/build/0230mokuzou.html">木造3階建て</a></li>
			<li class="big"><a href="<?php echo SITE_URL ?>/build/0240zyuusou.html">長屋建て</a></li>
        </ul>
		  
		  <ul> 
		   <li><a href="<?php echo SITE_URL ?>/blog/2557/" target="_blank">南欧風アパート</a></li>
			 <li><a href="<?php echo SITE_URL ?>/build/0200kenchiku_2-2_yutori.html">ゆとりの部屋</a></li>
			 <li><a href="<?php echo SITE_URL ?>/build/0295nekobus.html">ネコ共生型アパート</a></li>
			 <li><a href="<?php echo SITE_URL ?>/build/0200kenchiku_2-4_bouon.html">防音アパート</a></li>
			 <li><a href="<?php echo SITE_URL ?>/pdf/0200kenchiku_2-5.pdf" target="_blank">ワンランクアップ</a></li>
			 <li><a href="<?php echo SITE_URL ?>/blog/5925/" target="_blank">家と冒険</a></li>
			<li><a href="<?php echo SITE_URL ?>/blog/1560/" target="_blank">賃貸併用住宅</a></li>
           <li><a href="<?php echo SITE_URL ?>/build/0200kenchiku_3-1_hoiku.html">保育園建築</a></li>
			 <li><a href="<?php echo SITE_URL ?>/build/0200kenchiku_3-2_kaigo.html">介護施設</a></li>
			 <li><a href="<?php echo SITE_URL ?>/blog/3933/" target="_blank">オフィス・店舗</a></li>
			 <li><a href="<?php echo SITE_URL ?>/build/0296tekkotsu.html" target="_blank">トランクルーム</a></li>
			 <li><a href="<?php echo SITE_URL ?>/build/0296tekkotsu.html" target="_blank">鉄骨造</a></li>
			 <li><a href="<?php echo SITE_URL ?>/blog/5801/" target="_blank">J-耐震開口フレーム</a></li>
</ul>	  
        <ul>
          <li><a href="<?php echo SITE_URL ?>/build/0270option.html">オプション</a></li>
			<li><a href="<?php echo SITE_URL ?>/build/0270option.html">設備のグレードアップ</a></li>
          <li><a href="<?php echo SITE_URL ?>/build/0270option.html">アクセントクロス</a></li>
			<li><a href="<?php echo SITE_URL ?>/build/0297tatekae.html">アパートの建替え</a></li>
          <li><a href="<?php echo SITE_URL ?>/build/0280quality.html">クオリティ</a></li>
          <li><a href="<?php echo SITE_URL ?>/build/0290shokunin.html">職人の技</a></li>
          
        </ul>
        <ul class="pb0">
          <li><a href="<?php echo SITE_URL ?>/build/0291nairankai.html">内覧会のご案内</a></li>
          <li class="this"><a href="<?php echo $base_url ?>">ただいま建築中</a>
            <?php if (isset($listItem) && !empty($listItem)): ?>
              <ul class="sub">

                <?php foreach ($listItem as $item): ?>
                <?php
                   $newImage = Utils::getNewImage($item['created_at']);
                   echo ($item['id'] == $selected) ? '<li class="this">' : '<li>';
                ?>
                  <a href="<?php echo $base_url ?>/detail/<?php echo $item['id'] ?>"><?php echo Utils::truncate($item['name'], 20, '…') ?><?php if ($newImage): ?><span class="new">NEW</span><?php endif; ?></a></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
<li><a href="<?php echo SITE_URL ?>/build/0293kounyu.html">土地購入＋アパート経営</a></li>
        </ul>

        <ul>
          <li><a href="<?php echo SITE_URL ?>/0500faq.html#faqBuild">よくあるご質問</a></li>
        </ul>
      </div>
