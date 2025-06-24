<?php get_header(); ?>
	<div id="main" class="category">

		<p class="backlink"><a href="/blog/">ブログトップへ戻る »</a></p>
		<div class="border"></div>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php
	//タイトル取得
	$title = the_title("", "", false );
	if(empty($title)) $title = "未タイトル";
?>
		<div class="sec clearfix">
			<h2><a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title); ?>"><?php echo esc_html($title); ?></a></h2>
			<span>投稿時間 : <?php the_time("Y年m月d日 H:i"); ?></span>
			<p><?php the_excerpt(); ?></p>
			<div class="more clearfix"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title); ?>">つづきを読む</a></div>
		</div>
		<div class="border"></div>
<?php endwhile; ?>
<?php if(function_exists("wp_pagenavi")){echo "<div class=\"pagenav\">";wp_pagenavi();echo "</div>";} //ページングを出力 ?>
<?php else: ?>
		<div class="sec clearfix">現在、該当記事はございません。</div>
<?php endif; ?>
<?php wp_reset_postdata(); //クエリを解除 ?>

	</div>

	<div id="left">
<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
