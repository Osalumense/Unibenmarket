<?php
/*
  Plugin Name: Google Image Sitemap
  Plugin URI: http://daemon-soft.com/
  Description: This plugin create Seo friendly Images Sitemap.
  Version: 1.0.1
  Author: Malefol7
  Author URI: http://daemon-soft.com/
  Author Email: malefol7@gmail.com
  Short Name: images_sitemap
  Plugin update URI: google-image-sitemap
 */

require_once 'functions.php';
require_once 'ModelIS.php';

function images_sitemap_install() {
   osc_set_preference('version',  '100', 'images_sitemap', 'INTEGER');
   osc_set_preference('ping_engines',  '1', 'images_sitemap', 'INTEGER');
   osc_set_preference('refresh_set',  'daily', 'images_sitemap', 'STRING');
   osc_set_preference('def_title',  '', 'images_sitemap', 'STRING');
}

function images_sitemap_uninstall() {
      	osc_delete_preference('version', 'images_sitemap');
	osc_delete_preference('ping_engines', 'images_sitemap');
	osc_delete_preference('refresh_set', 'images_sitemap');
        osc_delete_preference('def_title','images_sitemap');
}

function images_sitemap_title($title){
  $file = explode('/', Params::getParam('file'));
  if($file[0] == 'images_sitemap'){
    $title = '<i class="fa fa-sitemap" fa-lg></i>&nbsp;Google Images Sitemap';
  }
  return $title;
   }
  
osc_add_filter('custom_plugin_title', 'images_sitemap_title');


function images_sitemap_font(){
	echo '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />';
	}
	
osc_add_hook('admin_footer', 'images_sitemap_font');

function image_sitemap_admin(){
   echo '<h3><a href="#">Image Sitemap Options</a></h3>
        <ul>
            <li><a style="color:#2EB0E4;font-weight:bold" href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'admin/conf.php') . '">&raquo; ' . __('Configure', 'image_sitemap') . '</a></li>
        </ul>';
}

function image_sitemap_admin_menu(){
    osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/admin/conf.php') ;
}    

//osc_add_hook('init','image_sitemap_redirect_con');

osc_register_plugin(osc_plugin_path(__FILE__), '') ;

osc_add_hook(osc_plugin_path(__FILE__) . '_configure', 'image_sitemap_admin_menu');

osc_register_plugin(osc_plugin_path(__FILE__), 'image_sitemap_install');

osc_add_hook(osc_plugin_path(__FILE__). '_uninstall', 'image_sitemap_uninstall');
      
osc_add_hook('admin_menu', 'image_sitemap_admin');
?>