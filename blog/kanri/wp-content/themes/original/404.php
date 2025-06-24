<?php get_header(); ?>
<?php include(TEMPLATEPATH . "/header_menu.php"); //ヘッダーメニューの読み込み?>

	<div id="main">
		<div class="sec detail clearfix">
		<div style="padding:20px;">
			<p style="margin-bottom:14px;font-weight:bold;">Not Found　お探しのページが見つかりません。</p>
			<p style="margin-bottom:14px;">
				弊社サイトをご利用いただき、誠にありがとうございます。<br>
				お客さまのお探しのページは、ご覧になっていたページからのリンクが無効になっているか、現在利用できない可能性がございます。<br><br>
				大変お手数ですが、<br>
				<a href="/">トップページ</a>もしくは<a href="/0010sitemap.html">サイトマップ</a>よりご覧になりたいページをお探しください。
			</p>
		</div>
		</div>
	</div>

	<div id="left">
<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
