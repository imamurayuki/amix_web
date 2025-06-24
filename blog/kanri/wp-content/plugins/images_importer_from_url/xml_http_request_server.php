<?php
header('Content-Type: text/javascript; charset=UTF-8');
require_once(dirname(__FILE__).'/../../../wp-load.php');
require_once(ABSPATH .'wp-admin/includes/image.php');
require(dirname(__FILE__).'/properties.php');

load_plugin_textdomain(IIFU_PROPERTIES::TEXT_DOMAIN,false,dirname(plugin_basename(__FILE__)).'/languages/');

function process_attachment($url){
	$post=array();
	$upload=wp_upload_bits(basename($url),0,'',null);

	if($upload['error']){
		return array('error'=>1,'msg'=>$upload['error']);
	}

	$headers=wp_get_http($url,$upload['file']);

	if(!$headers){
		@unlink($upload['file']);
		return array('error'=>2,'msg'=>__('Remote server did not respond',IIFU_PROPERTIES::TEXT_DOMAIN));
	}

	if($headers['response']!='200'){
		@unlink($upload['file']);
		$msg_base=__('Remote server returned error response %1$d %2$s',IIFU_PROPERTIES::TEXT_DOMAIN);
		$msg=sprintf($msg_base,esc_html($headers['response']),get_status_header_desc($headers['response']));
		return array('error'=>3,'msg'=>$msg);
	}

	$filesize=filesize($upload['file']);

	if(isset($headers['content-length'])&&$filesize!=$headers['content-length']){
		@unlink($upload['file']);
		return array('error'=>4,'msg'=>__('Remote file is incorrect size',IIFU_PROPERTIES::TEXT_DOMAIN));
	}

	if(0==$filesize){
		@unlink($upload['file']);
		return array('error'=>5,'msg'=>__('Zero size file downloaded',IIFU_PROPERTIES::TEXT_DOMAIN));
	}

	if(($info=wp_check_filetype($upload['file']))){
		$post['post_mime_type']=$info['type'];
	}else{
		return array('error'=>6,'msg'=>__('Invalid file type',IIFU_PROPERTIES::TEXT_DOMAIN));
	}

	$post['guid']=$upload['url'];
	$post_id=wp_insert_attachment($post,$upload['file']);

	wp_update_attachment_metadata($post_id,wp_generate_attachment_metadata($post_id,$upload['file']));

	return array('url'=>$upload['file'],'id'=>$post_id);
};

if(!isset($_POST[IIFU_PROPERTIES::NAME_OLD_IMAGE_URL])){
	header('HTTP/1.1 400 Bad Request');
	return;
}

$ret=process_attachment($_POST[IIFU_PROPERTIES::NAME_OLD_IMAGE_URL]);

if(isset($ret['error'])){
	header('HTTP/1.1 500 Internal Server Error');
	print $ret['msg'];
	return;
}

$olds=array($_POST[IIFU_PROPERTIES::NAME_OLD_IMAGE_URL],preg_replace('|^https?://[^/]+|','',$_POST[IIFU_PROPERTIES::NAME_OLD_IMAGE_URL]));
$new_url=preg_replace('|'.ABSPATH.'|',get_site_url().'/',$ret['url']);
$link_base='src="%s"';

$wpdb->hide_errors();
$wpdb->query('start transaction');

foreach($olds as $old_url){
	if(false===$wpdb->query($wpdb->prepare("update $wpdb->posts set post_content=replace(post_content,%s,%s)",sprintf($link_base,$old_url),sprintf($link_base,$new_url)))){
		$wpdb->query('rollback');

		header('HTTP/1.1 500 Internal Server Error');
		print __('Database Error.',IIFU_PROPERTIES::TEXT_DOMAIN).' | '.$wpdb->show_errors();
		return;
	}
}

$wpdb->query('commit');

header('HTTP/1.1 200 OK');
print $new_url;
