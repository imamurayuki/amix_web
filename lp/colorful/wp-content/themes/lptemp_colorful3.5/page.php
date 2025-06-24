<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */



$post = get_post($post);
if( get_field('countdown_method', $post->ID) === 'access' || get_field('countdown_method', $post->ID) === 'date' ) {
	get_header();
} else {
	get_header('jsnone');
}
?>
<?php if( get_field('free', $post->ID) ) { the_field('free', $post->ID); } ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php /* comments_template( '', true ); */ ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
if( get_field('hoverwindow_text', $post->ID) ) {
	get_template_part('hover');
}
?>

<?php
if( get_field('countdown_method', $post->ID) === 'access' || get_field('countdown_method', $post->ID) === 'date' ) {
	get_footer();
} else {
	get_footer();
}
?>