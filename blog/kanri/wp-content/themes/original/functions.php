<?php

###################################################
# 更新情報非表示設定                              #
###################################################
$a = "";
//WP本体のバージョンアップを非表示
add_filter("pre_site_transient_update_core", create_function($a, "return null;"));
//プラグインのバージョンアップを非表示
remove_action("load-update-core.php", "wp_update_plugins");
add_filter("pre_site_transient_update_plugins", create_function($a, "return null;"));


###################################################
# 管理バーにログアウトを追加                      #
###################################################
function add_new_item_in_admin_bar(){

	global $wp_admin_bar;

	$wp_admin_bar->add_menu(array(
		"id"    => "new_item_in_admin_bar",
		"title" => __("ログアウト"),
		"href"  => wp_logout_url()
	));

}
add_action("wp_before_admin_bar_render", "add_new_item_in_admin_bar");


###################################################
# 不要タグの出力制御                              #
###################################################
if(has_action('wp_head', '_admin_bar_bump_cb' )) remove_action('wp_head', '_admin_bar_bump_cb');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'index_rel_link' );
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
remove_action('wp_head', 'start_post_rel_link', 10, 0 );


###################################################
# 不要なメニューを非表示にする                    #
###################################################
function delete_unnecessary_menus(){

	global $menu;

	//管理者以外「level_10」の場合
	if(!current_user_can("level_10")){

//		unset($menu[2]); //ダッシュボード
		unset($menu[4]); //メニューの線1
//		unset($menu[5]); //投稿
//		unset($menu[10]); //メディア
		unset($menu[15]); //リンク
		unset($menu[20]); //ページ
		unset($menu[25]); //コメント
		unset($menu[59]); //メニューの線2
		unset($menu[60]); //テーマ
		unset($menu[65]); //プラグイン
//		unset($menu[70]); //プロフィール
		unset($menu[75]); //ツール
		unset($menu[80]); //設定
		unset($menu[90]); //メニューの線3

	}

}
add_action("admin_menu", "delete_unnecessary_menus");


##########################################################
# 「wp_title」で入る余分な半角スペースを削除             #
##########################################################
function my_title_fix($title, $sep, $seplocation){
	if(!$sep) $title = str_replace(" " . $sep . " ", $sep, $title);
	return $title;
}
add_filter("wp_title", "my_title_fix", 10, 3);


###################################################
# 「wp_title」の日付けアーカイブ不具合対応        #
###################################################
function wp_title_add_date($title, $sep, $seplocation){

	if(is_year()){
		$title = get_the_time("Y") . "年";
	}else if(is_month()) {
		$title = get_the_time("Y") . "年" . get_the_time("n") . "月";
	}else if(is_day()) {
		$title = get_the_time("Y") . "年" . get_the_time("n") . "月" . get_the_time("d") . "日";
	}else if(is_attachment()){
		$title = $title;
	}else if(is_tag()) {
		$title = $title;
	}

	if(!empty($sep)){
		if($seplocation == "right"){
			$title .= $sep;
		}else{
			$title = $sep . $title;
		}
	}

	return $title;

}
add_filter("wp_title", "wp_title_add_date", 10, 3);


##########################################################
# タイトルタグを取得                                     #
##########################################################
function get_title_tag(){

	global $post;

	$title = "";
	if(is_single()){
		//投稿ページ
		$title = get_the_title();
	}elseif(is_page()){
		//固定ページ
		$title = get_post_meta($post->ID, "page_title", TRUE);
	}elseif(is_category()){
		//カテゴリーページ
		$cat = get_the_category();
		$cat = $cat[0];
		$cat_name = $cat->name;
		if($cat_name) $title = $cat_name . "の記事一覧";
	}elseif(is_archive()){
		//カスタム投稿タイプ取得
		$post_type = get_query_var("post_type");
		$object = get_post_type_object($post_type);
		$title = $object->label;
	}elseif(is_404()){
		$title = "お探しのページが見つかりませんでした";
	}else{
		$title = "";
	}

	return $title;

}
add_action("init", "get_title_tag");
add_filter("wp_title", "my_title_fix", 10, 3);


##########################################################
# ディスクリプションを取得                               #
##########################################################
function get_description_tag(){

	global $post;

	$description = "";
	if(is_single()){
		//投稿ページ
		$description = get_the_title();
	}elseif(is_page()){
		//固定ページ
		$description = get_post_meta($post->ID, "description", TRUE);
	}elseif(is_category()){
		//カテゴリーページ
		$cat = get_the_category();
		$cat = $cat[0];
		$cat_name = $cat->name;
		if($cat_name) $description = $cat_name . "の記事一覧です";
	}elseif(is_archive()){
		//カスタム投稿タイプ取得
		$post_type = get_query_var("post_type");
		$object = get_post_type_object($post_type);
		$description = $object->label . "。";
	}elseif(is_404()){
		$description = "お探しのページが見つかりませんでした。";
	}else{
		$description = "";
	}

	return $description;

}
add_action("init", "get_description_tag");
add_filter("wp_title", "my_title_fix", 10, 3);


###################################################
# 投稿画像一覧取得関数                            #
###################################################
function catch_that_image(){

	global $post, $posts;
	$first_img = "";
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];
	
	return $first_img;

}


###################################################
# the_excerpt()の末尾の出力文字を変更             #
###################################################
function new_excerpt_more($more){
	return "…";
}
add_filter("excerpt_more", "new_excerpt_more");


###################################################
# the_excerpt()の出力文字数を変更                 #
###################################################
function new_excerpt_mblength($length){
	return 200;
}
add_filter("excerpt_mblength", "new_excerpt_mblength");


###################################################
# moreタグの「#～～」を削除                       #
###################################################
function custom_content_more_link($output){
	$output = preg_replace("/#more-[\d]+/i", "", $output);
	return $output;
}
add_filter("the_content_more_link", "custom_content_more_link");


###################################################
# <img>タグからwidthとheightを削除                #
###################################################
function remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	return $html;
}
add_filter("the_content", "remove_width_attribute", 10 );


###################################################
# 月別アーカイブの出力関数                        #
###################################################
/**
* @function get_archives_array
* @param post_type(string) / period(string) / year(Y) / limit(int)
* @return array
*/
if(!function_exists('get_archives_array')){
    function get_archives_array($args = ''){
        global $wpdb, $wp_locale;

        $defaults = array(
            'post_type' => '',
            'period'  => 'monthly',
            'year' => '',
            'limit' => ''
        );
        $args = wp_parse_args($args, $defaults);
        extract($args, EXTR_SKIP);

        if($post_type == ''){
            $post_type = 'post';
        }elseif($post_type == 'any'){
            $post_types = get_post_types(array('public'=>true, '_builtin'=>false, 'show_ui'=>true));
            $post_type_ary = array();
            foreach($post_types as $post_type){
                $post_type_obj = get_post_type_object($post_type);
                if(!$post_type_obj){
                    continue;
                }

                if($post_type_obj->has_archive === true){
                    $slug = $post_type_obj->rewrite['slug'];
                }else{
                    $slug = $post_type_obj->has_archive;
                }

                array_push($post_type_ary, $slug);
            }

            $post_type = join("', '", $post_type_ary); 
        }else{
            if(!post_type_exists($post_type)){
                return false;
            }
        }
        if($period == ''){
            $period = 'monthly';
        }
        if($year != ''){
            $year = intval($year);
            $year = " AND DATE_FORMAT(post_date, '%Y') = ".$year;
        }
        if($limit != ''){
            $limit = absint($limit);
            $limit = ' LIMIT '.$limit;
        }

        $where  = "WHERE post_type IN ('".$post_type."') AND post_status = 'publish'{$year}";
        $join   = "";
        $where  = apply_filters('getarchivesary_where', $where, $args);
        $join   = apply_filters('getarchivesary_join' , $join , $args);

        if($period == 'monthly'){
                $query = "SELECT YEAR(post_date) AS 'year', MONTH(post_date) AS 'month', count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC $limit";
        }elseif($period == 'yearly'){
            $query = "SELECT YEAR(post_date) AS 'year', count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date DESC $limit";
        }

        $key = md5($query);
        $cache = wp_cache_get('get_archives_array', 'general');
        if(!isset($cache[$key])){
            $arcresults = $wpdb->get_results($query);
            $cache[$key] = $arcresults;
            wp_cache_set('get_archives_array', $cache, 'general');
        }else{
            $arcresults = $cache[$key];
        }
        if($arcresults){
            $output = (array)$arcresults;
        }

        if(empty($output)){
            return false;
        }

        return $output;
    }
}

?>
