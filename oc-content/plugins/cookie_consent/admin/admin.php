<?php
if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');

//Check if form is posted and save settings
if(Params::getParam('plugin_action')=='post_form') {
	$policylink	= Params::getParam('policylink');
	$color 		= Params::getParam('color');
	$position	= Params::getParam('position');
	osc_set_preference('PolicyLink', $policylink, 'cookie_consent', 'STRING');
	osc_set_preference('Color', $color=='dark'?'dark':'light', 'cookie_consent', 'STRING');
	osc_set_preference('Position', $position, 'cookie_consent', 'STRING');
    osc_reset_preferences();
    osc_add_flash_ok_message(__('cookie_consent settings saved', 'cookie_consent'), 'admin');
    osc_show_flash_message('admin');
} else {
	$policylink	= osc_get_preference('PolicyLink', 'cookie_consent');
	$color		= osc_get_preference('Color', 'cookie_consent');
	$position	= osc_get_preference('Position', 'cookie_consent');
}
?>

<div style="padding: 20px;">
    <h2 class="render-title"><?php _e('Cookie Consent Settings', 'cookie_consent'); ?></h2>
    <form name="cookie_consent" action="<?php echo osc_admin_base_url(true);?>" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="page" value="plugins" />
        <input type="hidden" name="action" value="renderplugin" />
        <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__);?>admin.php" />
        <input type="hidden" name="plugin_action" value="post_form" />
        <fieldset>		
            <div class="form-horizontal">
				<div class="form-row">
                    <div class="form-label" style="padding:0; width:230px;"><?php _e('Cookie / Privacy Policy URL', 'cookie_consent'); ?></div>
                    <div class="form-controls">
						<input type="text" <?php echo $policylink; ?> class="xlarge" style="margin-left:10px;width:30%" name="policylink" value="<?php echo $policylink; ?>" />
                    </div>
                </div>
				<div class="form-row">
					<div class="form-label" style="margin-right:10px;width:230px;"><?php _e('Color Scheme', 'cookie_consent'); ?></div>
					<div class="form-controls">
						<select name="color" id="ccolor">
							<option value="dark" <?php if($color=="dark") { echo 'selected="selected"';}; ?> >Dark</option>
							<option value="light" <?php if($color=="light") { echo 'selected="selected"';}; ?> >Light</option>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-label" style="margin-right:10px;width:230px;"><?php _e('Window Position', 'cookie_consent'); ?></div>
					<div class="form-controls">
						<select style="margin-left:10px;" name="position" id="position">
							<option value="top" <?php if($position=="top") { echo 'selected="selected"';}; ?> >Top</option>
							<option value="bottom" <?php if($position=="bottom") { echo 'selected="selected"';}; ?> >Bottom</option>
<!--	Not OK				<option value="inline" <?php if($position=="inline") { echo 'selected="selected"';}; ?> >Inline</option>	-->
							<option value="floating" <?php if($position=="floating") { echo 'selected="selected"';}; ?> >Float</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>				
				<div class="form-actions">
                    <button class="btn btn-submit" type="submit"><?php _e('Save', 'cookie_consent'); ?></button>
                </div>
            </div>
        </fieldset>
    </form>
</div>