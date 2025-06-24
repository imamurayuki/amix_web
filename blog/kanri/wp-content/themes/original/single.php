<?php get_header(); ?>
<?php
//タイトル取得
$title = the_title("", "", false );
if(empty($title)) $title = "未タイトル";
?>
	<div id="main">
		<p class="movelink"><?php previous_post_link("%link | ", "« 前の記事"); ?><a href="/blog/">ブログトップ</a><?php next_post_link(" | %link", "次の記事 »"); ?></p>
		<div class="border"></div>

<?php if(have_posts()) : the_post(); ?>
		<div class="sec detail clearfix">
			<h2><?php echo esc_html($title); ?></h2>
			<span>投稿時間 : <?php the_time("Y年m月d日 H:i"); ?></span>
			<p><?php the_content(); ?></p>
		</div>
<?php else: ?>
		<div class="sec clearfix">現在、該当記事はございません。</div>
<?php endif; ?>

		<div class="border mb15"></div>
		<p class="movelink"><?php previous_post_link("%link | ", "« 前の記事"); ?><a href="/blog/">ブログトップ</a><?php next_post_link(" | %link", "次の記事 »"); ?></p>
		<div class="border mb0"></div>
	</div>

	<div id="left">
<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
