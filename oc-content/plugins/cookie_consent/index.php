<?php
/*
Plugin Name: Cookie Consent
Plugin URI: http://market.osclass.org/
Description: Cookie Policy Message based on Open Source project: <a href="https://silktide.com/tools/cookie-consent/">"Cookie Consent"</a>
Version: 1.2.3
Author: SmaRTeY
Author URI: 
Author Email: Osclass forums
Short Name: CookieConsent
Plugin update URI: cookie-consent
*/

function cookie_consent() {
	$theme = osc_get_preference('Color', 'cookie_consent').'-'.osc_get_preference('Position', 'cookie_consent');
	?><script> var ccp = "<?php echo osc_base_url();?>"; </script><?php
	echo '<script type="text/javascript">window.cookieconsent_options = {"message":"'.__('Message', 'cookie_consent').'","dismiss":"'.__('ButtonText', 'cookie_consent').'","learnMore":"'.__('MoreInfo', 'cookie_consent').'","link":"'.osc_get_preference('PolicyLink', 'cookie_consent').'","theme":"'.$theme.'"};</script>';
}

function cookie_consent_install() {
	osc_set_preference('PolicyLink', 'http://www.cookielaw.org/the-cookie-law', 'cookie_consent', 'STRING');
	osc_set_preference('Color', 'dark', 'cookie_consent', 'STRING');
	osc_set_preference('Position', 'bottom', 'cookie_consent', 'STRING');
}

function cookie_consent_uninstall() {
	osc_delete_preference('PolicyLink', 'cookie_consent');
	osc_delete_preference('Color', 'cookie_consent');
	osc_delete_preference('Position', 'cookie_consent');
}

function cookie_consent_config() {
	osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/admin/admin.php');
}

function load_ccs() {
	osc_register_script('cookieconsent.min.js', osc_base_url().'oc-content/plugins/cookie_consent/js/cookie_consent.min.js');
	osc_enqueue_script('cookieconsent.min.js');
}

//(Un)install hooks	
osc_register_plugin(osc_plugin_path(__FILE__), 'cookie_consent_install');
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'cookie_consent_uninstall');
osc_add_hook(osc_plugin_path(__FILE__) . '_configure', 'cookie_consent_config');
//plugin hooks
osc_add_hook('before_html', 'load_ccs');
osc_add_hook('header','cookie_consent');
?>