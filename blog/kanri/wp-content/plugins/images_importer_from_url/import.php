<?php
global $wpdb;

function iifu_check($url){
	$ret=wp_remote_head($url);

	if(is_wp_error($ret)){
		return -1;
	}

	return in_array(wp_remote_retrieve_response_code($ret),array(200,301,302))?0:1;
};

function iifu_error($paragraph,$path,$msg=null){
	if(!$msg){
		$msg=__('Sorry, an error occurred on the server. please re-send the URL.',IIFU_PROPERTIES::TEXT_DOMAIN);
	}

	printf($paragraph,sprintf('<strong class="%s">%s</strong>',IIFU_PROPERTIES::CLASS_CAUTION,$msg));
	print '<hr />'.PHP_EOL;

	require($path.'/form.php');
};

$old_url=trim($_POST[IIFU_PROPERTIES::NAME_OLD_SITE_URL]);

if(empty($old_url)||!preg_match('|^https?://.+?\..+$|',$old_url)){
	iifu_error($paragraph,$path,__('Send data was not in the correct URL. Please resubmit.',IIFU_PROPERTIES::TEXT_DOMAIN));
	return;
}

$old_url_base=preg_replace('|^(https?://.+?)/.*$|','$1',$old_url);
$root=$_SERVER['DOCUMENT_ROOT'];
$table_buff=array();

$wpdb->hide_errors();
$posts=$wpdb->get_results("select post_content from $wpdb->posts where post_content like '%src=\"%'");

foreach($posts as $p){
	$ret=preg_match_all('@<img .*?(src="((/|'.$old_url.').+?)").*?>@',$p->post_content,$matches);

	if(FALSE===$ret){
		iifu_error($paragraph,$path);
		return;
	}

	if($ret){
		foreach($matches[2] as $src){
			if(0===strpos($src,'/')){
				if(!file_exists($root.$src)){
					switch(iifu_check($old_url_base.$src)){
						case 0:
							$table_buff[$old_url_base.$src]=true;
							break;
						case -1:
							iifu_error($paragraph,$path);
							return;
						default:
							break;
					}
				}
			}else{
				switch(iifu_check($src)){
					case 0:
						$table_buff[$src]=true;
						break;
					case -1:
						iifu_error($paragraph,$path);
						return;
					default:
						break;
				}
			}
		}
	}
}

$cnt=count($table_buff);

if(!$cnt){
	printf($paragraph,sprintf('<strong>%s</strong>',__('Image URL of the old domain was not found.',IIFU_PROPERTIES::TEXT_DOMAIN)));
	return;
}

$start_button=__('Start',IIFU_PROPERTIES::TEXT_DOMAIN);
$button=sprintf('<input type="button" class="%s" value="%s" onclick="%s();" />',IIFU_PROPERTIES::CLASS_STAR_BUTTON,$start_button,IIFU_PROPERTIES::FUNC_XML_HTTP_REQUEST);
?>
<div id="<?php print IIFU_PROPERTIES::ID_IMAGES_OUTER; ?>">
<h2><?php printf(__('Found the image %d files. Click the %s button to begin the import.',IIFU_PROPERTIES::TEXT_DOMAIN),$cnt,$start_button); ?></h2>
<?php printf($paragraph,sprintf('%s&nbsp;&nbsp;%s',__('Please click the button on the right if there is no problem.',IIFU_PROPERTIES::TEXT_DOMAIN),$button)); ?>
<table id="<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?>">
<tbody>
<?php foreach($table_buff as $link=>$flag) : ?>
<tr class="<?php print IIFU_PROPERTIES::CLASS_IMAGE_URL; ?>">
<td class="<?php print IIFU_PROPERTIES::CLASS_IMAGE_TD; ?>"><img src="<?php print $link; ?>" /></td>
<td class="<?php print IIFU_PROPERTIES::CLASS_URL_TD; ?>">URL: <?php print $link; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php printf($paragraph,sprintf(__('Please click the %s button if there is no problem.&nbsp;&nbsp;%s',IIFU_PROPERTIES::TEXT_DOMAIN),$start_button,$button)); ?>
</div>
