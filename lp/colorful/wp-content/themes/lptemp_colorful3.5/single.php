<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('jsnone'); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>



<!-- <div class="social_btn">
<div class="facebook">
<div class="fb-like" data-href="http://pocowan.com/mailmaga-afili/" data-send="false" data-width="450" data-show-faces="true" data-font="arial"></div>
</div>
<br>
<div class="facebook-follow">
<div class="fb-follow" data-href="https://www.facebook.com/profile.php?id=100001766604684" data-show-faces="true" data-font="arial" data-width="400"></div>
</div>
<br>
<div class="twitter">
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://pocowan.com/mailmaga-afili/" data-text="副業で1日30分のメルマガアフィリで 月5万円を稼ぐ方法を伝授します！" data-via="pocowan" data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<div class="twitter-follow">
<a href="https://twitter.com/pocowan" class="twitter-follow-button" data-show-count="false" data-lang="ja">@pocowanさんをフォロー</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<div class="hatebu"> 
  <a href="http://b.hatena.ne.jp/entry/http://pocowan.com/mailmaga-afili/" class="hatena-bookmark-button" data-hatena-bookmark-title="副業で1日30分のメルマガアフィリで 月5万円を稼ぐ方法を伝授します！" data-hatena-bookmark-layout="standard-balloon" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
    </div>
</div> -->



				<?php get_template_part( 'content', get_post_format() ); ?>




<!-- <div class="social_btn">
<div class="facebook">
<div class="fb-like" data-href="http://pocowan.com/mailmaga-afili/" data-send="false" data-width="450" data-show-faces="true" data-font="arial"></div>
</div>
<br>
<div class="facebook-follow">
<div class="fb-follow" data-href="https://www.facebook.com/profile.php?id=100001766604684" data-show-faces="true" data-font="arial" data-width="400"></div>
</div>
<br>
<div class="twitter">
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://pocowan.com/mailmaga-afili/" data-text="副業で1日30分のメルマガアフィリで 月5万円を稼ぐ方法を伝授します！" data-via="pocowan" data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<div class="twitter-follow">
<a href="https://twitter.com/pocowan" class="twitter-follow-button" data-show-count="false" data-lang="ja">@pocowanさんをフォロー</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<div class="hatebu"> 
  <a href="http://b.hatena.ne.jp/entry/http://pocowan.com/mailmaga-afili/" class="hatena-bookmark-button" data-hatena-bookmark-title="副業で1日30分のメルマガアフィリで 月5万円を稼ぐ方法を伝授します！" data-hatena-bookmark-layout="standard-balloon" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
    </div>
</div>-->


				<!--<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					 <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav> --> <!-- .nav-single -->

				<?php /* comments_template( '', true ); */ ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>