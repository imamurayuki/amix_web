<?php
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	/* 背景色設定無効化
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );*/

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'twentytwelve-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'twentytwelve-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );








/**
 *  Install Add-ons
 *  
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *  
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme/plugin as outlined in the terms and conditions.
 *  For more information, please read:
 *  - http://www.advancedcustomfields.com/terms-conditions/
 *  - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
 */ 

include_once('advanced-custom-fields/acf.php');

// Add-ons 
// include_once('add-ons/acf-repeater/acf-repeater.php');
// include_once('add-ons/acf-gallery/acf-gallery.php');
// include_once('add-ons/acf-flexible-content/acf-flexible-content.php');
// include_once( 'add-ons/acf-options-page/acf-options-page.php' );


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_custom_01',
		'title' => 'ホバーウィンドウ＆カウントダウン設定',
		'fields' => array (
			array (
				'key' => 'field_5405cf867fb82',
				'label' => 'カウントダウン方法',
				'name' => 'countdown_method',
				'type' => 'radio',
				'choices' => array (
					'date' => '日時指定方式',
					'access' => 'アクセス後カウント方式',
					'off' => 'カウントダウンOFF',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'off',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5271039dc054d',
				'label' => 'カウントダウン 名前 (例　終了まであと)',
				'name' => 'countdown_name',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5405cf867fb82',
							'operator' => '!=',
							'value' => 'off',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5271040ac054e',
				'label' => 'カウントダウン 日にち',
				'name' => 'countdown_date',
				'type' => 'date_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5405cf867fb82',
							'operator' => '==',
							'value' => 'date',
						),
					),
					'allorany' => 'all',
				),
				'date_format' => 'yy/mm/dd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_5271d86cb1b83',
				'label' => 'カウントダウン 時間 (例 00:00:00)',
				'name' => 'countdown_time',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5405cf867fb82',
							'operator' => '==',
							'value' => 'date',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '00:00:00',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5405d11305ff0',
				'label' => 'サイトアクセス後カウントダウン時間(例 : 1日＝24時間　30分＝0.5時間)　小数点第1位まで',
				'name' => 'cookie_expires',
				'type' => 'number',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5405cf867fb82',
							'operator' => '==',
							'value' => 'access',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 6,
				'placeholder' => '',
				'prepend' => '',
				'append' => '時間',
				'min' => 0,
				'max' => '',
				'step' => 0.1,
			),
			array (
				'key' => 'field_52a06738b6927',
				'label' => 'カウントダウン終了後にジャンプするURL (http://〜)',
				'name' => 'countdown_url',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5405cf867fb82',
							'operator' => '!=',
							'value' => 'off',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5506c852ef504',
				'label' => 'LP上部にカウントダウンを固定表示',
				'name' => 'countdown_top',
				'type' => 'radio',
				'choices' => array (
					'on' => 'ON',
					'off' => 'OFF',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'on',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_540c1d3591a3f',
				'label' => '⌊　LP上部カウントダウンデザイン',
				'name' => 'countdown_design',
				'type' => 'select',
				'choices' => array (
					'none' => 'デザイン設定なし(黒字・白背景)',
					'design1' => 'パターン1（色設定）',
					'design2' => 'パターン2（指定デザイン）',
				),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5506c852ef504',
							'operator' => '==',
							'value' => 'on',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_540c1df5a8a5b',
				'label' => 'カウントダウン文字色',
				'name' => 'countdown_fontcolor',
				'type' => 'color_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5506c852ef504',
							'operator' => '==',
							'value' => 'on',
						),
						array (
							'field' => 'field_540c1d3591a3f',
							'operator' => '==',
							'value' => 'design1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '#333333',
			),
			array (
				'key' => 'field_540c1ece674d5',
				'label' => 'カウントダウン背景色',
				'name' => 'countdown_bgcolor',
				'type' => 'color_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5506c852ef504',
							'operator' => '==',
							'value' => 'on',
						),
						array (
							'field' => 'field_540c1d3591a3f',
							'operator' => '==',
							'value' => 'design1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '#ffffff',
			),
			array (
				'key' => 'field_5506c9ce85fed',
				'label' => 'ページ内カウントダウンデザイン(カスタムボタンより選択して設置できます)',
				'name' => 'countdown_indesign',
				'type' => 'select',
				'choices' => array (
					'none' => 'デザイン設定なし(黒字・白背景)',
					'design1' => 'パターン1（色設定）',
					'design2' => 'パターン2（指定デザイン）',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5506e7c1e4c58',
				'label' => 'ページ内カウントダウン文字色',
				'name' => 'countdown_infontcolor',
				'type' => 'color_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5506c9ce85fed',
							'operator' => '==',
							'value' => 'design1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '#333333',
			),
			array (
				'key' => 'field_5506e7c5e4c59',
				'label' => 'ページ内カウントダウン背景色',
				'name' => 'countdown_inbgcolor',
				'type' => 'color_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5506c9ce85fed',
							'operator' => '==',
							'value' => 'design1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '#ffffff',
			),
			array (
				'key' => 'field_5506c84bef503',
				'label' => 'ホバーウィンドウ文章',
				'name' => 'hoverwindow_text',
				'type' => 'post_object',
				'post_type' => array (
					0 => 'hover',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 1,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_custom_02',
		'title' => '背景設定',
		'fields' => array (
			array (
				'key' => 'field_527e52ab2655f',
				'label' => '背景色',
				'name' => 'background_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_5280272096d8a',
				'label' => '背景画像',
				'name' => 'background_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5280c13062d73',
				'label' => '背景画像繰り返し',
				'name' => 'background_repeat',
				'type' => 'radio',
				'choices' => array (
					'repeat' => '繰り返す',
					'repeat-x' => '横方向に繰り返す',
					'repeat-y' => '縦方向に繰り返す',
					'no-repeat' => '繰り返さない',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5280c1b762d74',
				'label' => '背景画像固定',
				'name' => 'background_attachment',
				'type' => 'radio',
				'choices' => array (
					'fixed' => '固定する',
					'scroll' => '固定しない',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5281b5102285d',
				'label' => '背景画像の配置',
				'name' => 'background_position',
				'type' => 'radio',
				'choices' => array (
					'right' => '右よせ',
					'center' => '中央',
					'left' => '左よせ',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));
	register_field_group(array (
		'id' => 'acf_custom_03',
		'title' => '記事背景設定',
		'fields' => array (
			array (
				'key' => 'field_529f3e24429b3',
				'label' => '背景色',
				'name' => 'content_bgcolor',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_529f3eb2429b4',
				'label' => '背景画像',
				'name' => 'content_bgimage',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_529f3eee429b5',
				'label' => '背景画像繰り返し',
				'name' => 'content_bgrepeat',
				'type' => 'radio',
				'choices' => array (
					'repeat' => '繰り返す',
					'repeat-x' => '横方向に繰り返す',
					'repeat-y' => '縦方向に繰り返す',
					'no-repeat' => '繰り返さない',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_529f3f4d429b6',
				'label' => '背景画像固定',
				'name' => 'content_bgattachment',
				'type' => 'radio',
				'choices' => array (
					'fixed' => '固定する',
					'scroll' => '固定しない',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_529f3fa4a8275',
				'label' => '背景画像の配置',
				'name' => 'content_bgposition',
				'type' => 'radio',
				'choices' => array (
					'right' => '右よせ',
					'center' => '中央',
					'left' => '左よせ',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_544681784a831',
				'label' => '影の設定',
				'name' => 'shadow_enable',
				'type' => 'radio',
				'choices' => array (
					'on' => 'ON',
					'off' => 'OFF',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'on',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 2,
	));
	register_field_group(array (
		'id' => 'acf_custom_04',
		'title' => '応用設定',
		'fields' => array (
			array (
				'key' => 'field_52a1badb995f6',
				'label' => 'ヘッダー画像 (こちらの編集ページには表示されないので、実際のページをご確認ください。)',
				'name' => 'topheader_image',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_536f2913d4a69',
				'label' => 'スマホ最適化(レスポンシブ対応)',
				'name' => 'sp_enable',
				'type' => 'radio',
				'choices' => array (
					'on' => 'ON',
					'off' => 'OFF',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'off',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_539463ad5fd3e',
				'label' => 'スマホでのアクセス時にページをジャンプさせる場合のURL (http://〜)',
				'name' => 'sp_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5458c5de6075b',
				'label' => 'スマホ表示時に通常文字サイズのみ拡大(上記のスマホ最適化がOFFの時のみ適応)',
				'name' => 'sp_fontsize',
				'type' => 'radio',
				'choices' => array (
					'on' => 'ON',
					'off' => 'OFF',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'off',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_552363b4c2c47',
				'label' => 'ページ幅設定 (こちらの編集ページには適応されないので、実際のページをご確認ください。)',
				'name' => 'pwidth',
				'type' => 'number',
				'default_value' => 900,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_5581775c3c0de',
				'label' => 'フォント設定 (こちらの編集ページには適応されないので、実際のページをご確認ください。)',
				'name' => 'font_family',
				'type' => 'select',
				'choices' => array (
					'0' => '設定なし',
					'1' => 'ゴシック体',
					'2' => '明朝体',
					'3' => 'メイリオ',
					'4' => '丸ゴシック体',
					'5' => '游ゴシック体',
					'6' => '游明朝体',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_52a0676cb6928',
				'label' => 'フォントサイズ設定 (こちらの編集ページには適応されないので、実際のページをご確認ください。)',
				'name' => 'fontsize',
				'type' => 'number',
				'default_value' => 16,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_55234ec35bd19',
				'label' => '行間設定 (こちらの編集ページには適応されないので、実際のページをご確認ください。)',
				'name' => 'lineheight',
				'type' => 'number',
				'default_value' => 2.3,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => 0.1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 3,
	));
	register_field_group(array (
		'id' => 'acf_custom_05',
		'title' => 'プログラム入力(body内)',
		'fields' => array (
			array (
				'key' => 'field_537b3735aec0f',
				'label' => 'スクリプト系のプログラムを記入する場合などに活用できます。(&lt;script&gt;〜〜&lt;/script&gt;など)',
				'name' => 'free',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 5,
	));
	register_field_group(array (
		'id' => 'acf_custom_06',
		'title' => 'プログラム入力(head内)',
		'fields' => array (
			array (
				'key' => 'field_5444ae8cc40e8',
				'label' => 'Google Analyticsのコードを記入する場合などに活用できます。',
				'name' => 'gacode',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 6,
	));
	register_field_group(array (
		'id' => 'acf_custom_07',
		'title' => 'メニュー設定',
		'fields' => array (
			array (
				'key' => 'field_5458b5d7e8dc9',
				'label' => 'メニュー表示',
				'name' => 'menu_enable',
				'type' => 'radio',
				'choices' => array (
					'on' => 'ON',
					'off' => 'OFF',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'off',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5458b647c69c9',
				'label' => 'メニュー名',
				'name' => 'menu_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5458b6f97fdcf',
				'label' => 'メニューデザイン',
				'name' => 'menu_design',
				'type' => 'select',
				'choices' => array (
					'design1' => 'パターン1(黒)',
					'design2' => 'パターン2(白)',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 4,
	));
}



/* カスタム投稿タイプの追加 */
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'hover', /* post-type */
		array(
			'labels' => array(
			'name' => __( 'ホバーウィンドウ' ),
			'singular_name' => __( 'ホバーウィンドウ' )
		),
		'public' => true,
		'menu_position' =>5,
    	)
	);
}

// TinyMCE Advanced
include_once('tinymce-advanced/tinymce-advanced.php');
include_once('ab_tinymce_init_setting/ab_tinymce_init_setting.php');

add_editor_style(‘editor-style.css’);

if(is_admin() && current_user_can('edit_posts') &&
current_user_can('edit_pages') && get_user_option('rich_editing') == 'true') {
	add_filter('mce_external_plugins', 'my_mce_external_plugins');
	add_filter('mce_buttons_3', 'my_mce_buttons');
}
function my_mce_buttons($buttons) {
	// 追加したい要素の名前を定義(separatorは区切り)
	array_push($buttons, "taglist", "fontlist");
	return $buttons;
}
function my_mce_external_plugins($plugin_array) {
	// プラグインファイルのurl
	$plugin_array['addquicktags'] = get_template_directory_uri().'/tinymce/editor_plugin.js';
	$plugin_array['jpfonts'] = get_template_directory_uri().'/tinymce/font.js';
	return $plugin_array;
}

function inner_countdown($atts) {
	$html = '<div class="navbar navbar-inverse navbar-nofix" onMouseOver="dispWin();">';
	$html .= '<div class="navbar-inner" >';
	$html .= '<div class="brand">';
	$html .= '<p>' . get_field('countdown_name', $post->ID) . '　<span class="CDT"></span></p>';
	$html .= '</div></div></div>';
	return $html;
}
add_shortcode('innerCountdown', 'inner_countdown');


###################################################
# 不要なメニューを非表示にする                    #
###################################################
function delete_unnecessary_menus(){

	global $menu;

	//管理者以外「level_10」の場合
	if(!current_user_can("level_10")){
		unset($menu[5]); //投稿
	}

}
add_action("admin_menu", "delete_unnecessary_menus");
