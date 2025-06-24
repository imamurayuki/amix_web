<?php
/*
Plugin Name: Images importer from URL
Plugin URI: http://dwm.me/archives/3490
Description: This plugin imports images from old url. Used for when your domain was changed.
Version: 1.0
Author: Tom
Author URI: http://dwm.me/
Text Domain: images_importer_from_url
Domain Path: /languages/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/***********************************************************
Indicator GIF by http://mentalized.net/activity-indicators/
***********************************************************/

if(is_admin()){
	require(dirname(__FILE__).'/properties.php');

	load_plugin_textdomain(IIFU_PROPERTIES::TEXT_DOMAIN,false,dirname(plugin_basename(__FILE__)).'/languages/');

	wp_enqueue_style(IIFU_PROPERTIES::TEXT_DOMAIN,plugins_url('/css.php',__FILE__));
	wp_enqueue_script(IIFU_PROPERTIES::TEXT_DOMAIN,plugins_url('/js.php',__FILE__),array(),false,true);

	function iifu_sub_sub(){
		$path=dirname(__FILE__);
		$paragraph='<p>%s</p>'.PHP_EOL;
		$plugin_site=sprintf('<a href="%s" target="_blank">%s</a>',IIFU_PROPERTIES::PLUGIN_URL,IIFU_PROPERTIES::PLUGIN_URL);

		printf('<h1>%s</h1>'.PHP_EOL,IIFU_PROPERTIES::PLUGIN_NAME);
		printf($paragraph, __('extract the image file of the page that was imported from MT2 format. and it save to "wp-content/uploads/".',IIFU_PROPERTIES::TEXT_DOMAIN));
		printf($paragraph,__('Image URLs in the page will automatically rewrite to URL of the file that has been saved.',IIFU_PROPERTIES::TEXT_DOMAIN));
		printf($paragraph,sprintf(__('Please see the %s is detailed explanation.',IIFU_PROPERTIES::TEXT_DOMAIN),$plugin_site));
		print '<hr />'.PHP_EOL;

		if(!empty($_POST)){
			require($path.'/import.php');
			return;
		}

		require($path.'/form.php');
	}

	function iifu_sub(){
		add_options_page(
			IIFU_PROPERTIES::PLUGIN_NAME,
			__('Imports images from URL',IIFU_PROPERTIES::TEXT_DOMAIN),
			'manage_options',
			__FILE__,
			iifu_sub_sub
		);
	}

	add_action('admin_menu',iifu_sub);
}
