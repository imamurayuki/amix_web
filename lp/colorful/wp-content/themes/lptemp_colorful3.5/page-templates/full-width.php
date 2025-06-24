<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */




get_header(); ?>


	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->




<!--ホバーウィンドウ
    ================================================== -->



<?php
/* ホバーウィンドウの表示 */
$loop = new WP_Query( array( 'post_type' => 'hover', 'posts_per_page' => 1 ) );
while ( $loop->have_posts() ) : $loop->the_post();
?>


<div id="filter" onClick="hideWin();"></div>
<div id="subwin" >



<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>


<div class="custom-post-content">
    <?php the_content('続きを読む&raquo;'); ?>
</div>


<p>&nbsp;</p>
<p align="right"><a href="#" onClick="hideWin();">サブウィンドウを閉じる</a></p>



</div>

<?php endwhile; ?>







<?php get_footer(); ?>


<!--ホバーウィンドウ
    ================================================== -->
    
<script type="text/javascript">
function dispWin(){
document.getElementById('filter').style.display = 'block';
document.getElementById('subwin').style.display = 'block';
};

function hideWin(){
document.getElementById('filter').style.display = 'none';
document.getElementById('subwin').style.display = 'none';
};
</script>