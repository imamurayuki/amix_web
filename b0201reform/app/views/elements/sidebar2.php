<div id="sideContents">
  <div id="sideBtn">
    <p id="contact01"><a href="<?php echo SITE_URL ?>/0620contact_shiryo/">アパート建築・土地活用資料請求はこちら 0120-441-432</a></p>
  </div>

  <h2 id="reformNaviTop"><a href="<?php echo SITE_URL ?>/build/b0201reform.html">アミックスリフォーム</a></h2>
  <ul id="reformNavi" class="sideNavi">
    <li id="sideNavi01">
      <a href="<?echo echo $base_url ?>">アミックスリフォーム事例</a>
      <?php 
      if (isset($years) && !empty($years)) {
          echo '<ul class="innerNavi2">';
          foreach ($years as $year) {
              $url = $base_url . '/list/' . $year['year'];
              if ($year['year'] == $selectedYear) {
                  echo '<li class="this">' . "<a href=\"{$url}\">・{$year['year']}年リフォーム</a></li>";
                  echo '<ul class="innerNavi3">';
                  foreach ($data as $item) {
                     $newImage = Utils::getNewImage($item['created_at']);
                     $name = Utils::truncate($item['name'], 15, '…');
                     if (!is_null($newImage)) {
                         $imageUrl = $base_url . $newImage;
                         $html =<<<EOL
                     <li><a href="{$base_url}/detail/{$item['id']}">{$name}</a>
                       &nbsp;<img src="{$imageUrl}" width="24" height="13" />
                     </li>
EOL;
                     } else {
                         $html =<<<EOL
                     <li><a href="{$base_url}/detail/{$item['id']}">{$name}</a></li>
EOL;
                     }
                     echo $html;
                  }
                  echo '</ul>';
              } else {
                  echo '<li>' . "<a href=\"{$url}\">・{$year['year']}年リフォーム</a></li>";
              }
          }
          echo '</ul>';
      } ?>
    </li>
    <li id="sideNavi12"><a href="<?php echo SITE_URL ?>/0500faq.html#faqReform">よくあるご質問</a></li>
  </ul>
</div>
