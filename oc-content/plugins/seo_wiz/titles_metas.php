<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>

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
<h2 class="render-title">
  <?php _e('Titles & Metas',SEO_PLUGIN_FOLDER);?>
</h2>
<div class="wizards_tab" id="tabs">
  <ul>
    <li> <a href="#home">
      <?php _e('Homepage',SEO_PLUGIN_FOLDER);?>
      </a> </li>
    <li> <a href="#pages">
      <?php _e('Pages',SEO_PLUGIN_FOLDER);?>
      </a> </li>
  </ul>
  <div id="home">
    <?php include 'titles_metas_home.php'; ?>
  </div>
  <div id="pages">
    <?php include 'titles_metas_pages.php'; ?>
  </div>
  <address class="wizards_address">
	<span>&copy; 2015 <a target="_blank" title="osclasswizards" href="http://www.osclasswizards.com/">OsclassWizards</a>. All rights reserved.</span>
  </address>

</div>
<script type="text/javascript" src="<?php echo osc_plugin_url( SEO_PLUGIN_FOLDER.'/js/script.js' ).'script.js'; ?>"></script> 
