<?php
if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');
?>
<div class="credit-osclasswizards"> <a href="http://www.osclasswizards.com/" target="_blank" class="wizard_logo"> <img src="<?php echo osc_plugin_url( SEO_PLUGIN_FOLDER.'/img/logo.png' ).'logo.png'; ?>" alt="Premium osclass themes" /> </a>
  <div class="follow">
    <ul>
      <li>Follow us:</li>
      <li><a href="https://www.facebook.com/osclasswizards" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
      <li><a href="https://twitter.com/osclasswizards" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a></li>
      <li><a href="https://plus.google.com/112391938966018193484" target="_blank" title="google plus"><i class="fa fa-google-plus"></i></a></li>
    </ul>
  </div>
  <div class="donate">
    <form name="_xclick" action="https://www.paypal.com/in/cgi-bin/webscr" method="post" class="nocsrf">
      <input type="hidden" name="cmd" value="_donations">
      <input type="hidden" name="business" value="webgig.sagar@gmail.com">
      <input type="hidden" name="item_name" value="OsclassWizards SEO Plugin">
      <input type="hidden" name="currency_code" value="USD">
      <input type="hidden" name="lc" value="US" />
      <div id="flashmessage" >
        <p>
          <select name="amount" class="select-box-medium">
            <option value="10" selected>10$</option>
            <option value="5">5$</option>
            <option value="">
            <?php _e('Custom', SEO_PLUGIN_FOLDER); ?>
            </option>
          </select>
          <input type="submit" class="btn btn-mini" name="submit" value="<?php echo osc_esc_html(__('Donate', SEO_PLUGIN_FOLDER)); ?>">
        </p>
      </div>
    </form>
  </div>
</div>
<h2 class="render-title"><?php _e('Configure SEO Plugin', SEO_PLUGIN_FOLDER); ?></h2>
<form action="<?php echo osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'configure.php'); ?>" method="post" class="nocsrf">
<h3 class="render-title"><?php _e('Title Separator', SEO_PLUGIN_FOLDER); ?></h3>
<input type="hidden" name="seo_action" value="seo_configure" />
    <fieldset>
        <div class="form-horizontal">
			<div class="form-row">
                <div id="title_separators">
			  
				<?php $value = (osc_get_preference('page_title_separator', 'seo_plugin'))? osc_get_preference('page_title_separator', 'seo_plugin'): ''; ?>
				  <input id="vline" type="radio" name="page_title_separator" value="|" <?php if($value == "|") echo 'checked="checked"'; ?>>
				  <label for="vline">|</label>
				  
				  <input id="comma" type="radio" name="page_title_separator" value="," <?php if($value == ",") echo 'checked="checked"'; ?>>
				  <label for="comma">,</label>

				  <input id="ndash" type="radio" name="page_title_separator" value="–"  <?php if($value == "–") echo 'checked="checked"'; ?>>
				  <label for="ndash">–</label>

				  <input id="mdash" type="radio" name="page_title_separator" value="—" <?php if($value == "—") echo 'checked="checked"'; ?>>
				  <label for="mdash">—</label>

				  <input id="middot" type="radio" name="page_title_separator" value="." <?php if($value == ".") echo 'checked="checked"'; ?>>
				  <label for="middot">.</label>
				  
				  <input id="bull" type="radio" name="page_title_separator" value="•" <?php if($value == "•") echo 'checked="checked"'; ?>>
				  <label for="bull">•</label>

				  <input id="mstar" type="radio" name="page_title_separator" value="✭" <?php if($value == "✭") echo 'checked="checked"'; ?>>
				  <label for="mstar">✭</label>

				  <input id="tilde" type="radio" name="page_title_separator" value="«" <?php if($value == "«") echo 'checked="checked"'; ?>>
				  <label for="tilde">«</label>
				  
				  <input id="laquo" type="radio" name="page_title_separator" value="»" <?php if($value == "»") echo 'checked="checked"'; ?>>
				  <label for="laquo">»</label>
				  
				  <input id="lt" type="radio" name="page_title_separator" value="<" <?php if($value == "<") echo 'checked="checked"'; ?>>
				  <label for="lt">&lt;</label>

				  <input id="gt" type="radio" name="page_title_separator" value=">" <?php if($value == ">") echo 'checked="checked"'; ?>>
				  <label for="gt">&gt;</label>
				  
				  <input id="space" type="radio" name="page_title_separator" value="" <?php if($value == "") echo 'checked="checked"'; ?>>
				  <label for="space">&nbsp;</label>

				</div>
            </div>
		</div>
    </fieldset>

	<div class="form-actions">
		<input type="submit" value="<?php _e('Save changes', SEO_PLUGIN_FOLDER); ?>" class="btn btn-submit">
	</div>
</form>
  <address class="wizards_address">
	<span>&copy; 2015 <a target="_blank" title="osclasswizards" href="http://www.osclasswizards.com/">OsclassWizards</a>. All rights reserved.</span>
  
  </address>
<script type="text/javascript" src="<?php echo osc_plugin_url( SEO_PLUGIN_FOLDER.'/js/script.js' ).'script.js'; ?>"></script> 
