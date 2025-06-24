		<ul class="bt PC">
			<li><a href="/" target="_blank"><img src="/blog/common/img/bt01.jpg" alt="アミックス公式ホームページ"></a></li>
			<li><a href="../../../../../0620contact_shiryo/" target="_blank"><img src="/blog/common/img/bt02.jpg" alt="お問い合わせ・資料請求"></a></li>
		</ul>
		<div class="entries">
			<h3>カテゴリー</h3>
			<ul>
				<li><a href="/blog/category/nairankai/">内覧会</a></li>
				<li><a href="/blog/category/seminar/">セミナー</a></li>
				<li><a href="/blog/category/business/">事業紹介</a></li>
				<li><a href="/blog/category/other/">その他</a></li>
			</ul>
		</div>
		<div class="entries">
			<h3>最近のエントリー</h3>
			<ul>
<?php wp_get_archives("&type=postbypost&limit=10"); ?>
			</ul>
		</div>
		<div class="entries">
			<h3>月別エントリー</h3>
			<ul>
<?php $yArchives = get_archives_array(array("period" => "yearly")); ?>
<?php if($yArchives): ?>
<?php foreach($yArchives as $yArchive): ?>
				<li>
					<p><a class="year" href="javascript:void(0);"><span>[＋]</span> <?php echo $yArchive->year; ?>年(<?php echo $yArchive->posts; ?>)</a></p>
					<ul>
<?php $mArchives = get_archives_array(array("year" => $yArchive->year)); ?>
<?php foreach($mArchives as $mArchive): ?>
<li><a href="<?php echo get_month_link($mArchive->year, $mArchive->month); ?>"><?php echo $mArchive->month; ?>月(<?php echo $mArchive->posts; ?>)</a></li>
<?php endforeach; ?>
					</ul>
				</li>
<?php endforeach; ?>
<?php endif; ?>
			</ul>
		</div>

		<div class="borderbottom"></div>
		<ul class="bt SP clearfix">
			<li><a href="https://www.amix.co.jp/" target="_blank"><img src="/blog/common/img/sp_bt01.png" alt="アミックス公式ホームページ"></a></li>
			<li><a href="../../../../../0620contact_shiryo/" target="_blank"><img src="/blog/common/img/sp_bt02.png" alt="お問い合わせ・資料請求"></a></li>
		</ul>
		<div class="border"></div>
		<div class="profile mb20">
			<h3>プロフィール</h3>
<p><strong>末永 照雄</strong>  〈 Teruo Suenaga 〉</p>
<p>株式会社アミックス 代表取締役 社長<br>
昭和31年8月2日生まれ<br>
上智大学卒業後、アミックスを設立。<br>
趣味はジョギングと水泳。</p>
<p>公益財団法人 日本賃貸住宅管理協会 元会長<br>
全国賃貸管理ビジネス協会 理事<br>
suenagateruo@amix.co.jp</p>
		</div>
		<div class="border mb0"></div>
		<div class="close"><a href="#" onClick="window.close(); return false;">blogページを閉じる</a></div>
