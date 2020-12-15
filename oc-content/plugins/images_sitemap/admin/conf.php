<?php if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');
   $pluginAutor = osc_plugin_get_info('images_sitemap/index.php');
    if(Params::getParam('plugin_action')=='doneone') {
        add_new_imgsitemap();
	$time = microtime(true);
        osc_add_flash_ok_message(__('Your XML image sitemap generated correctly in '.substr($time - $_SERVER["REQUEST_TIME_FLOAT"], 0, -8).' sec', 'images_sitemap'), 'admin');
        header('Location: ' . osc_admin_render_plugin_url('images_sitemap/admin/conf.php'));   
    }
    $refresh_set = osc_get_preference('refresh_set', 'images_sitemap');
    if(Params::getParam('plugin_action')=='donetwo') {
        osc_set_preference('refresh_set',  Params::getParam("refresh_set") ? Params::getParam("refresh_set"):'', 'images_sitemap', 'STRING');
	osc_set_preference('ping_engines',  Params::getParam("ping_engines") ? Params::getParam("ping_engines") : '', 'images_sitemap', 'BOOLEAN');
        osc_add_flash_ok_message(__('Setting saved', 'images_sitemap'), 'admin');
        header('Location: ' . osc_admin_render_plugin_url('images_sitemap/admin/conf.php'));    
    }
?>
<link href="<?php echo osc_base_url(); ?>oc-content/plugins/images_sitemap/css/adminstyle.css" rel="stylesheet" type="text/css" />
<div id="paypalpluspro">
    <ul>
    <li class="title"><?php echo __('Images Sitemap', 'images_sitemap'); ?></li>
    <li class="current"><a href="#"><?php echo __('Configuration', 'images_sitemap'); ?></a></li>
    </ul>
</div>
<div id="settings_form" style="border: 1px solid #ccc; background: #eee; border-radius: 5px;">
            <fieldset style=" border: 1px solid #BBBBBB; border-radius: 3px 3px 3px 3px; margin: 20px; margin: 20px;">
                <legend style="-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; font-weight: 700; background: #2EB0E4; color: #FFFFFF; margin: auto;padding:5px;"><?php _e('Image Sitemap Options', 'images_sitemap'); ?></legend>
                <div style="padding: 20px;">
                <form name="images_map_form" id="images_map_form" action="<?php echo osc_admin_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="plugins" />
                    <input type="hidden" name="action" value="renderplugin" />
                    <input type="hidden" name="file" value="images_sitemap/admin/conf.php" />
                    <input type="hidden" name="plugin_action" value="doneone" />
                    <div class="form-horizontal">
                        <div class="form-row">
	<span class="help-box"><i class="fa fa-stethoscope fa-2x"></i>&nbsp;<strong style="font-size: 15px; color: black;"><?php _e("Looks at the status of your images map",'images_sitemap'); ?></strong></span>
	<h4><?php _e('Current Imagesmap Status', 'image_sitemap'); ?></h4>
	<?php
	if(file_exists(ABS_PATH.'/imagesmap.xml')){ ?>
	<?php $lastedit = date("d F Y h:i:s A", filemtime(ABS_PATH.'/imagesmap.xml')); ?>
	<h4><a href="<?php echo osc_base_url().'imagesmap.xml';?>" target="_blank"><?php echo osc_base_url().'imagesmap.xml';?></a> - (Open in New tab)</h4>
	<h4><?php _e('Generated On - ', 'images_sitemap');?><label style="color:green"><?php  echo $lastedit; ?></label></h4>
	<?php } else { ?>
	<h4 style="color:red"><?php _e('No Sitemap Generated', 'images_sitemap'); ?></h4>
	<?php } ?>
	    </div>
			<hr />
                    <div style="clear:both;"></div>
                    <input type="submit" style="float: right; margin: 20px;" id="save_changes" value="<?php echo osc_esc_html( __('Generate Sitemap') ); ?>" class="btn-red btn" />
                    </div>
                </form>
            </fieldset>
	    <fieldset style=" border: 1px solid #BBBBBB; border-radius: 3px 3px 3px 3px; margin: 20px; margin: 20px;">
                <div style="padding: 20px;">
                <form name="images_map_form" id="images_map_form" action="<?php echo osc_admin_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="plugins" />
                    <input type="hidden" name="action" value="renderplugin" />
                    <input type="hidden" name="file" value="images_sitemap/admin/conf.php" />
                    <input type="hidden" name="plugin_action" value="donetwo" />
                    <div class="form-horizontal">
                        <div class="form-row">
	              <span class="help-box"><i class="fa fa-wrench fa-2x"></i>&nbsp;<strong style="font-size: 15px; color: black;"><?php _e("Configure your images sitemap",'images_sitemap'); ?></strong></span>
			<h4><?php _e('Select the refresh rate of your imagesmap', 'republish_pro'); ?></h4>
			<div class="form-row">   
			<select id="refresh_set" name="refresh_set">
			   <option value="hourly" <?php if($refresh_set == 'hourly') {?>selected="selected"<?php } ?>><?php _e('Refresh once a hour', 'images_sitemap'); ?></option>
                           <option value="daily" <?php if($refresh_set == 'daily') {?>selected="selected"<?php } ?>><?php _e('Refresh once a day', 'images_sitemap'); ?></option>
                           <option value="weekly" <?php if($refresh_set == 'weekly') {?>selected="selected"<?php } ?>><?php _e('Refresh once a week', 'images_sitemap'); ?></option>
                        </select>
			
			</div>
			<div class="form-row">
			<input type="checkbox" <?php echo (osc_get_preference('ping_engines', 'images_sitemap') ? 'checked="true"' : ''); ?>  name="ping_engines"  value="1"/>
	                 <label  style="font-size: 13px; font-weight:bold; color: black;"><?php _e('Ping to the search engine each time the imagesmap is updated', 'images_sitemap'); ?></label>
			</div>
			<?php $conn   = getConnection();
                           $crondata = $conn->osc_dbFetchResults("SELECT * FROM %st_cron", DB_TABLE_PREFIX);
			       $array = osc_get_preference('refresh_set', 'images_sitemap');
			       if($array == 'hourly'){
				$next = $crondata[0]['d_next_exec'];
			       } else if($array == 'daily') {
				$next = $crondata[1]['d_next_exec'];
			       } else if($array == 'weekly') {
				$next = $crondata[2]['d_next_exec'];
			       } ?>
			<h4><?php _e('Next Update - ', 'images_sitemap');?><label style="color:green"><?php  echo $next; ?></label></h4>
			</div>
			<hr />
                    <div style="clear:both;"></div>
                    <input type="submit" style="float: right; margin: 20px;" id="save_changes" value="<?php echo osc_esc_html( __('Save changes') ); ?>" class="btn-red btn" />
                    </div>
                </form>
            </fieldset>
        </div>
        <div style="clear: both;"></div>
    </div>
<div id="settings_form" style="border: 1px solid #ccc; margin-top: 30px; padding: 5px; background: #CCCFD0; border-radius: 5px;">
            <?php echo $pluginAutor['plugin_name'] . ' - ' . __('Version','images_sitemap') . ' ' . $pluginAutor['version'] . ' - ' . __('Author','images_sitemap') . ': ' . $pluginAutor['author'] . ' - Copyright - &copy; ' . date('Y') . ' - ' . __('Support','images_sitemap') . ' :<a href='. $pluginAutor['plugin_uri'] .' target="blank" > ' . $pluginAutor['plugin_uri'] . '</a>' ; ?>
        </div>