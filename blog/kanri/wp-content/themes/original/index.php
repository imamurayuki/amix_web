<?php get_header(); ?>
	<div id="main">

<?php
$paged = get_query_var("paged") ? get_query_var("paged") : 1;
$args = array(
	"paged" => $paged,
	"posts_per_page" => 10
);
$the_query = new WP_Query($args);
?>
<?php if($the_query->have_posts()): ?>
<?php while($the_query->have_posts()):$the_query->the_post(); ?>
<?php
	//タイトル取得
	$title = the_title("", "", false );
	if(empty($title)) $title = "未タイトル";

	$pc_content = get_the_content("", true); //moreタグは削除
	$sp_content = get_the_content("", true); //moreタグは削除
//	$post_content = apply_filters("the_content", get_the_content("", true)); //moreタグは削除
	$pattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
	preg_match_all($pattern, $sp_content, $matches);
	//記事中の画像を削除
	foreach($matches[0] as $val){
		$sp_content = str_replace($val, "", $sp_content);
	}
	//記事中の画像を取得
	$sp_photo = $matches[2][0];

	//最後の記事にのみ、classに「mb0」を追加
	$class = ($the_query->current_post + 1 === $wp_query->post_count) ? " mb0": "";

?>
		<div class="sec clearfix">
			<h2><a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title); ?>"><?php echo esc_html($title); ?></a></h2>
			<span>投稿時間 : <?php the_time("Y年m月d日 H:i"); ?></span>
			<div class="PC"><p class="txt"><?php echo nl2br($pc_content); ?></p></div>
			<div class="SP">
				<p class="txt"><?php echo mb_strimwidth(strip_tags($sp_content), 0, 100, "…", "UTF-8"); ?></p>
				<p class="img" style="padding-bottom:20px;"><?php if($sp_photo): ?><img src="<?php echo esc_url($sp_photo); ?>"><?php endif; ?></p>
			</div>
			<div class="more clearfix"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title); ?>">つづきを読む</a></div>
		</div>
		<div class="border<?php echo $class; ?>"></div>
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
