<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 $post = get_post($post);
  // ページ幅
 if( get_field('pwidth', $post->ID) ) {
  $pwidth = get_field('pwidth', $post->ID);
 } else {
  $pwidth = 900;
 }
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if( get_field('sp_enable', $post->ID) === 'on' ) : ?>
<meta name="viewport" content="width=device-width" />
<?php else : ?>
<meta name="viewport" content="width=<?php echo $pwidth + 100; ?>" />
<?php endif; ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.smoothScroll.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('a[href^="#"]').SmoothScroll({
		duration : 2000
	});
});
</script>
<?php wp_head(); ?>
<?php if( wp_is_mobile() ) : ?><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fontello.css" type="text/css" media="all" /><?php endif; ?>
<?php if( get_field('sp_enable', $post->ID) === 'on' ) : ?><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/sp.css" type="text/css" media="all" /><?php endif; ?>

<?php
 // フォント
 switch( get_field('font_family', $post->ID) ) {
   case 1:
     $font = '"ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","メイリオ",Meiryo, Osaka,"ＭＳ Ｐゴシック","MS PGothic",sans-serif';
     break;
   case 2:
     $font = '"ヒラギノ明朝 Pro W3","ＭＳ Ｐ明朝",serif';
     break;
   case 3:
     $font = '"メイリオ",Meiryo,"ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","ＭＳ Ｐゴシック",sans-serif';
     break;
   case 4:
     $font = '"ヒラギノ丸ゴ Pro W4","ヒラギノ丸ゴ Pro","Hiragino Maru Gothic Pro","ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","HG丸ｺﾞｼｯｸM-PRO","HGMaruGothicMPRO"';
     break;
   case 5:
     $font = '"游ゴシック体","Yu Gothic",YuGothic,"ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","メイリオ",Meiryo,Arial,Sans-Serif';
     break;
   case 6:
     $font = '"游明朝",YuMincho,"Hiragino Mincho ProN","Hiragino Mincho Pro","ＭＳ 明朝",serif';
     break;
   default:
     $font = '"Open Sans",Helvetica,Arial,sans-serif';
     break;
 }
 // フォントサイズ
 if( get_field('fontsize', $post->ID) ) {
  $fontsize = get_field('fontsize', $post->ID);
 } else {
  $fontsize = 16;
 }
 // 行間
 if( get_field('lineheight', $post->ID) ) {
  $lineheight = get_field('lineheight', $post->ID);
 } else {
  $lineheight = 2.3;
 }
 // 背景色反映
 if( get_field('background_color', $post->ID) ) {
  $background_color = get_field('background_color', $post->ID);
 } else {
  $background_color = '#FFF';
 }
 if( get_field('background_repeat', $post->ID) ) {
  $background_image = get_field('background_image', $post->ID);
 } else {
  $background_image = '';
 }
 if( get_field('background_repeat', $post->ID) ) {
  $background_repeat = get_field('background_repeat', $post->ID);
 } else {
  $background_repeat = 'repeat';
 }
 if( get_field('background_attachment', $post->ID) ) {
  $background_attachment = get_field('background_attachment', $post->ID);
 } else {
  $background_attachment = 'scroll';
 }
 if( get_field('background_position', $post->ID) ) {
  $background_position = get_field('background_position', $post->ID);
 } else {
  $background_position = 'left';
 }
 // 記事背景色反映
 if( get_field('content_bgcolor', $post->ID) ) {
  $content_bgcolor = get_field('content_bgcolor', $post->ID);
 } else {
  $content_bgcolor = '#FFF';
 }
 if( get_field('content_bgrepeat', $post->ID) ) {
  $content_bgrepeat = get_field('content_bgrepeat', $post->ID);
 } else {
  $content_bgrepeat = 'repeat';
 }
 if( get_field('content_bgattachment', $post->ID) ) {
  $content_bgattachment = get_field('content_bgattachment', $post->ID);
 } else {
  $content_bgattachment = 'scroll';
 }
 if( get_field('content_bgposition', $post->ID) ) {
  $content_bgposition = get_field('content_bgposition', $post->ID);
 } else {
  $content_bgposition = 'left';
 }
?>
<style type="text/css">
	body {
		font-size:<?php echo $fontsize; ?>px;
		font-family:<?php echo $font; ?>;
		background-color:<?php echo $background_color; ?>;
		<?php if( get_field('background_image', $post->ID) ) : ?>
		background-image:url('<?php echo $background_image; ?>');
		background-repeat:<?php echo $background_repeat; ?>;
		background-attachment:<?php echo $background_attachment; ?>;
		background-position:<?php echo $background_position; ?>;
		<?php endif; ?>
	}
	.site {
		width:<?php echo $pwidth - 60; ?>px;
		background-color:<?php echo $content_bgcolor; ?>;
		<?php if( get_field('content_bgimage', $post->ID) ) : ?>
		background-image:url('<?php the_field('content_bgimage', $post->ID); ?>');
		background-repeat:<?php echo $content_bgrepeat; ?>;
		background-attachment:<?php echo $content_bgattachment; ?>;
		background-position:<?php echo $content_bgposition; ?>;
		<?php endif; ?>
	}
	.site p {
		line-height:<?php echo $lineheight; ?>;
	}
	.entry-content,
	.content-width {
		width:<?php echo $pwidth - 100; ?>px;
	}
	img.wide,
	table.wide,
	table.head-w,
	table.head-b,
	table.obi,
	table.obi-b,
	table.gra-blue,
	table.gra-red,
	table.gra-green,
	table.gra-purple,
	table.gra-gray,
	table.gra-yellow,
	table.fab-blue,
	table.fab-red,
	table.fab-green,
	table.fab-purple,
	table.fab-gray{
		width:<?php echo $pwidth; ?>px;
	}

	table.shikaku img,
	table.shikaku tbody img,
	table.shikaku tr img,
	table.shikaku td img {
		max-width: <?php echo $pwidth - 150; ?>px;
	}

	table.marukaku img,
	table.marukaku tbody img,
	table.marukaku tr img,
	table.marukaku td img {
		max-width: <?php echo $pwidth - 150; ?>px;
	}

	table.pressed img,
	table.pressed tbody img,
	table.pressed tr img,
	table.pressed td img {
		max-width: <?php echo $pwidth - 150; ?>px;
	}

	table.pressed-fiber img,
	table.pressed-fiber tbody img,
	table.pressed-fiber tr img,
	table.pressed-fiber td img {
		max-width: <?php echo $pwidth - 150; ?>px;
	}

	table.tableshadow img,
	table.tableshadow tbody img,
	table.tableshadow tr img,
	table.tableshadow td img {
		max-width: <?php echo $pwidth - 150; ?>px;
	}

	table.wide img,
	table.wide tbody img,
	table.wide tr img,
	table.wide td img  {
		max-width: <?php echo $pwidth - 110; ?>px;
	}

	img.wide {
		max-width: <?php echo $pwidth; ?>px;
	}
</style>

<?php if( get_field('sp_enable', $post->ID) !== 'on' && get_field('sp_fontsize', $post->ID) === 'on' && wp_is_mobile() ) : ?>
<style type="text/css">
body {
 font-size:32px !important;
}
</style>
<?php endif; ?>

<?php if( get_field('shadow_enable', $post->ID) !== 'off' ) : ?>
<style type="text/css">
	.site {
		box-shadow: 0 0 10px rgba(0,0,0,0.25);
		-moz-box-shadow: 0 0 10px rgba(0,0,0,0.25);
		-webkit-box-shadow: 0 0 10px rgba(0,0,0,0.25);
	}
</style>
<?php endif; ?>

<?php if( get_field('countdown_design', $post->ID) === 'design1' ) : ?>
<style type="text/css">
	.navbar .navbar-inner {
		background-color:<?php the_field('countdown_bgcolor', $post->ID); ?>;
	}
	.navbar .brand {
		color:<?php the_field('countdown_fontcolor', $post->ID); ?>;
	}
</style>
<?php endif; ?>
<?php if( get_field('countdown_design', $post->ID) === 'design2' ) : ?>
<style type="text/css">
	.navbar {
		margin-bottom: 80px;
	}
	.navbar .navbar-inner {
		height: 80px;
	}
</style>
<?php endif; ?>

<?php if( get_field('countdown_indesign', $post->ID) === 'design1' ) : ?>
<style type="text/css">
	.navbar-nofix {
		margin-bottom: 0;
	}
	.navbar-nofix .navbar-inner {
		background-color:<?php the_field('countdown_inbgcolor', $post->ID); ?>;
		height: 60px;
	}
	.navbar-nofix .brand {
		color:<?php the_field('countdown_infontcolor', $post->ID); ?>;
	}
</style>
<?php endif; ?>
<?php if( get_field('countdown_indesign', $post->ID) === 'design2' ) : ?>
<style type="text/css">
	.navbar-nofix {
		margin-bottom: 0;
	}
	.navbar-nofix .navbar-inner {
		background-color: #fff;
		padding: 10px 0;
	}
</style>
<?php endif; ?>
<?php if( get_field('countdown_design', $post->ID) === 'design2' || get_field('countdown_indesign', $post->ID) === 'design2' ) : ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/countdown/assets/countdown/jquery.countdown.css" />
<?php endif; ?>

<!-- フォーム入力設定
    ================================================== -->
  <script type="text/javascript">
$(function(){
	$(".focus").focus(function(){
		if(this.value == "メールアドレスを入力"){
			$(this).val("").css("color","#000000");
		} else if(this.value == "名前を入力") {
			$(this).val("").css("color","#000000");}
	});

	$(".focus").blur(function(){
		if(this.value == ""){
			if(this.name == "d[0]"){
				$(this).val("メールアドレスを入力").css("color","#969696");
			} else {
				$(this).val("名前を入力").css("color","#969696");
				}
							
			}
	});

	$(window).bind("load resize", function(){
		if( $(window).width() > <?php echo $pwidth; ?> ) {
			$(".full-width").each(function(){
				$(this).height( $(this).height() );
				if( !$(this).find('.absolute')[0] ) {
					$(this).html( '<div class="absolute"><div class="content-width">' + $(this).html() + '</div></div>' );
					$(this).find('.absolute').css( 'backgroundColor', $(this).find('.content-width').children().eq(0).css('backgroundColor') );
					$(this).find('.absolute').css( 'backgroundImage', $(this).find('.content-width').children().eq(0).css('backgroundImage') );
					$(this).find('.absolute').css( 'backgroundPosition', $(this).find('.content-width').children().eq(0).css('backgroundPosition') );
				}
				$(this).find('.absolute').width( $(window).width() );
				$(this).find('.content-width').children().eq(0).css('backgroundColor','');
				$(this).find('.content-width').children().eq(0).css('backgroundImage','');
				$(this).find('.content-width').children().eq(0).css('backgroundPosition','');
			});
		}
	});
});
</script>

<?php if( get_field('sp_enable', $post->ID) === 'on' ) : ?>
<script type="text/javascript">
$(function(){
	$("img.wide").each(function(){
		$(this).parent().height( $(this).height() );
		$(this).bind("load", function(){
			$(this).parent().height( $(this).height() );
		});
	});
	if( $(".head-image").width() < 1100 ) {
		$(".head-image").height( $(".head-image").height() * $(".head-image").width() / 1100 );
	}
});
</script>
<?php endif; ?>

<?php if( get_field('sp_url', $post->ID) != '' ) : ?>
<script type="text/javascript">
if ( ((navigator.userAgent.indexOf('iPhone') > 0 &&
	navigator.userAgent.indexOf('iPad') == -1) ||
	navigator.userAgent.indexOf('iPod') > 0 ||
	navigator.userAgent.indexOf('Android') > 0) ) {
	location.href = '<?php the_field('sp_url', $post->ID); ?>';
}
</script>
<?php endif; ?>

<?php if( get_field('gacode', $post->ID) ) { the_field('gacode', $post->ID); } ?>
</head>

<body <?php body_class(); ?>>


<?php if( get_field('menu_enable', $post->ID) === 'on' ) : ?>
<?php
$menu_object = wp_get_nav_menu_object( get_field('menu_name', $post->ID) );
$menu_items = wp_get_nav_menu_items($menu_object->term_id);
if( get_field('menu_design', $post->ID) === 'design2' ) {
	$menu_class = 'fixed_menu2';
	$menu_btn = 'menu_btn2';
} else {
	$menu_class = 'fixed_menu1';
	$menu_btn = 'menu_btn1';
}
?>
<style type="text/css">
.navbar .navbar-inner {
	margin-top: 50px;
}
</style>
<?php if( wp_is_mobile() && get_field('sp_enable', $post->ID) === 'on' ) : ?>
<script type="text/javascript">
$(function(){
	$('nav.fixed_menu1 ul').hide();
	$('nav.fixed_menu2 ul').hide();
	$('.menu_btn1').click(function(){
		$('nav.fixed_menu1 ul').slideToggle();
	});
	$('.menu_btn2').click(function(){
		$('nav.fixed_menu2 ul').slideToggle();
	});
});
</script>
<?php endif; ?>
<div class="menu_box"></div>
<?php if( wp_is_mobile() ) : ?><div class="<?php echo $menu_btn; ?>"><i class="icon-th-list"></i></div><?php endif; ?>
<nav class="<?php echo $menu_class; ?>">
<ul>
<?php foreach( (array)$menu_items as $key => $menu_item ) : ?>
<li><a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
<?php endforeach; ?>
</ul>
</nav>
<?php endif; ?>


<!-- カウントダウン部分　ここに追加
    ================================================== -->

<?php if( get_field('countdown_top', $post->ID) === 'off' ) : ?>
<style type="text/css">
.navbar-fixed-top {
	display: none;
}
</style>
<?php endif; ?>
<div class="navbar navbar-inverse navbar-fixed-top" onMouseOver="dispWin();">
      <div class="navbar-inner" >
      
      <div class="brand">
	<!-- カウントダウンはここに追加 -->
    <p><?php echo get_field('countdown_name', $post->ID); ?>　<span id="CDT"></span></p>
	<!-- カウントダウンはここまで -->

      </div>

      </div>

</div>

<!-- カウントダウンここまで
    ================================================== -->

<?php $header_image = get_header_image(); ?>
<?php if( get_field('topheader_image', $post->ID) ) : ?>
<?php $image = wp_get_attachment_image_src( get_field('topheader_image', $post->ID), 'full' ); ?>
<div class="head-image" style="width:100%;height:<?php echo $image[2]; ?>px;background:url(<?php echo $image[0]; ?>) no-repeat center top;"></div>
<?php elseif( !empty($header_image) ): ?>
<div class="head-image" style="width:100%;height:<?php echo get_custom_header()->height; ?>px;background:url(<?php echo $header_image; ?>) no-repeat center top;"></div>
<?php endif; ?>


<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
	</header><!-- #masthead -->

	<div id="main" class="wrapper">