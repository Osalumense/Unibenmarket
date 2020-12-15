<?php
/*
Plugin Name: SEO Wiz
Plugin URI: http://www.osclasswizards.com/
Description: SEO Wiz is a free SEO Osclass Plugin for SEO optimization developed by OsclassWizards.
Version: 1.0.0
Author: OsclassWizards
Author URI: http://www.osclasswizards.com/
Plugin update URI: seo-wiz
*/

    define( 'SEO_PLUGIN_PATH', dirname( __FILE__) . '/' ) ;
    define( 'SEO_PLUGIN_ITEM_META_TABLE', DB_TABLE_PREFIX . 't_seo_item_meta_fields' ) ;
    define( 'SEO_PLUGIN_FOLDER', 'seo_wiz' ) ;
	
	//functions
	require_once( SEO_PLUGIN_PATH . 'functions.php' ) ;
	
    if( !function_exists( 'seo_after_install' ) ) {
        function seo_after_install() {	

            $conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;

            $path = osc_plugin_resource( SEO_PLUGIN_FOLDER.'/struct.sql' ) ;
            $sql  = file_get_contents( $path ) ;
            $comm->importSQL( $sql ) ;
        }
    }

    if( !function_exists( 'seo_after_uninstall' ) ) {
        function seo_after_uninstall() {
            $conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;

            $comm->query( sprintf( 'DROP TABLE %s', SEO_PLUGIN_ITEM_META_TABLE ) ) ;

        }
    }
	
	function seo_configure(){
		osc_redirect_to(osc_admin_render_plugin_url(osc_plugin_folder(__FILE__)).'configure.php');
	}
	function seo_init_admin(){
		
		//scripts
		osc_enqueue_style('seoCSS', osc_plugin_url( SEO_PLUGIN_FOLDER.'/css/style.css' ).'style.css');
		
		//admin menu pages
		osc_add_admin_menu_page(__('SEO Wiz', SEO_PLUGIN_FOLDER),osc_admin_render_plugin_url(osc_plugin_folder(__FILE__).'configure.php'),'seo_dashboard');
		
		osc_add_admin_submenu_page('seo_dashboard',__('Configure Plugin', SEO_PLUGIN_FOLDER),osc_admin_render_plugin_url(osc_plugin_folder(__FILE__).'configure.php'),'configure');
		osc_add_admin_submenu_page('seo_dashboard',__('Titles & Metas', SEO_PLUGIN_FOLDER),osc_admin_render_plugin_url(osc_plugin_folder(__FILE__).'titles_metas.php'),'titles_metas');

		//form actions
		switch( Params::getParam('seo_action') ) {
			
			//configure page
			case('seo_configure'):
			$page_title_separator = Params::getParam('page_title_separator', false, false, false);
			osc_set_preference('page_title_separator', $page_title_separator, 'seo_plugin');
			
			osc_add_flash_ok_message(__('Saved correctly', SEO_PLUGIN_FOLDER), 'admin');
			osc_redirect_to(osc_admin_render_plugin_url( osc_plugin_folder(__FILE__).'configure.php'));
			break;
			
			//titles_metas_home
			case('titles_metas_home'):
			$seo_titles  = Params::getParam('seo_titles');

			if(!empty($seo_titles)){
				
				foreach($seo_titles as $key => $value)
				{
					osc_set_preference($key, trim($value), 'seo_plugin');
				}

			}
			osc_add_flash_ok_message(__('Saved correctly', SEO_PLUGIN_FOLDER), 'admin');
			osc_redirect_to(osc_admin_render_plugin_url( osc_plugin_folder(__FILE__).'titles_metas.php#home'));
			break;

			//titles_metas_pages
			case('titles_metas_pages'):
			$seo_titles  = Params::getParam('seo_titles');

			if(!empty($seo_titles)){
				
				foreach($seo_titles as $key => $value)
				{
					osc_set_preference($key, trim($value), 'seo_plugin');
				}

			}
			osc_add_flash_ok_message(__('Saved correctly', SEO_PLUGIN_FOLDER), 'admin');
			osc_redirect_to(osc_admin_render_plugin_url( osc_plugin_folder(__FILE__).'titles_metas.php#pages'));
			break;	

		}
   
	}
	
	if( !function_exists( 'seo_item_form' ) ) {
		function seo_item_form($catID = null) {
			$detail = array( 'seo_item_meta_title' => '', 'seo_item_meta_description' => '', 'seo_item_meta_keywords' => '' ) ;

			require_once( SEO_PLUGIN_PATH . 'item_meta_form.php' ) ;
			
		}
	}
	
	if( !function_exists( 'seo_item_edit' ) ) {
        function seo_item_edit($catID = null, $itemID = null) {
			$detail = array( 'seo_item_meta_title' => '', 'seo_item_meta_description' => '', 'seo_item_meta_keywords' => '' ) ;
            $row    = seo_get_row( $itemID ) ;
            if( $row ) {
                $detail = $row ;
            }

            require_once( SEO_PLUGIN_PATH . 'item_meta_form.php' ) ;
        }
    }
		
	if( !function_exists( 'seo_posted_item' ) ) {
        function seo_posted_item($item)  {

            $itemID = $item['pk_i_id'];
            $item_meta_title = Params::getParam( 'seo_item_meta_title' ) ;
            $item_meta_title_format = json_encode(Params::getParam( 'seo_item_meta_title_format' )) ;
            $item_meta_description = Params::getParam( 'seo_item_meta_description' ) ;
            $item_meta_keywords = Params::getParam( 'seo_item_meta_keywords' ) ;

            $conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;
			
            $values = array(
                'fk_i_item_id' => $itemID,
                'seo_item_meta_title'    => $item_meta_title,
                'seo_item_meta_title_format'    => $item_meta_title_format,
                'seo_item_meta_description'    => $item_meta_description,
                'seo_item_meta_keywords'    => $item_meta_keywords,
            ) ;
            $comm->insert( SEO_PLUGIN_ITEM_META_TABLE, $values ) ;
        }
    }
	
	if( !function_exists( 'seo_edited_item' ) ) {
        function seo_edited_item( $item ) {
            $itemID = $item['pk_i_id'];
            $item_meta_title = Params::getParam( 'seo_item_meta_title' ) ;
			$item_meta_title_format = json_encode(Params::getParam( 'seo_item_meta_title_format' )) ;
            $item_meta_description = Params::getParam( 'seo_item_meta_description' ) ;
            $item_meta_keywords = Params::getParam( 'seo_item_meta_keywords' ) ;
			
            $conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;

            $values = array(
                'fk_i_item_id' => $itemID,
                'seo_item_meta_title'    => $item_meta_title,
                'seo_item_meta_title_format'    => $item_meta_title_format,
                'seo_item_meta_description'    => $item_meta_description,
                'seo_item_meta_keywords'    => $item_meta_keywords,
            ) ;
            $run = $comm->replace( SEO_PLUGIN_ITEM_META_TABLE, $values ) ;
			if($run == false){
				$comm->insert( SEO_PLUGIN_ITEM_META_TABLE, $values ) ;
			}
        }
    }
	
	if( !function_exists( 'seo_delete_item' ) ) {
        function seo_delete_item($itemID) {
            $conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;

            $where = array(
                'fk_i_item_id' => $itemID
            ) ;
            $comm->delete( SEO_PLUGIN_ITEM_META_TABLE, $where ) ;
        }
    }
	
	// when the plugin is installed
	osc_register_plugin( osc_plugin_path(__FILE__), 'seo_after_install' ) ;
	// when the plugin is uninstalled
	osc_add_hook( osc_plugin_path(__FILE__). '_uninstall', 'seo_after_uninstall' ) ;

	//configure
	osc_add_hook(osc_plugin_path(__FILE__) . "_configure", 'seo_configure');
	
	//hooks
	osc_add_hook('init_admin', 'seo_init_admin');
	if(osc_is_admin_user_logged_in()){

		osc_add_hook('item_form', 'seo_item_form');
		osc_add_hook('item_edit', 'seo_item_edit');
		osc_add_hook('posted_item', 'seo_posted_item');
		osc_add_hook('edited_item', 'seo_edited_item');

	}
	osc_add_hook('delete_item', 'seo_delete_item');
	
	//filters
	require SEO_PLUGIN_PATH . 'filters.php';


  ?>
<?php
  
      function seo_wiz_menu() { ?>
<style>
</style>
<?php
    }
    osc_add_hook('admin_page_header','seo_wiz_menu',5);
?>
