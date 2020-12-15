<div class="seo_wizards_meta">
  <div class="logo_wizard"> <a href="http://www.osclasswizards.com/" target="_blank"> <img src="<?php echo osc_plugin_url( SEO_PLUGIN_FOLDER.'/img/logo.png' ).'logo.png'; ?>" alt="Premium osclass themes" /> </a> </div>
  <div class="cat_list_wiz">
    <h2>
      <?php _e('SEO Title and Meta Description', SEO_PLUGIN_FOLDER); ?>
    </h2>
    <div class="form-group">
      <label class="form-label" for="seo_item_meta_title">
        <?php _e( 'Snippet Preview', SEO_PLUGIN_FOLDER ) ; ?>
        : </label>
      <div class="form-controls" id="seo_snippet_preview"> <a class="preview_title" id="preview_title"><?php echo $detail['seo_item_meta_title'] ; ?></a> <span class="preview_url"><?php echo str_replace('http://','', osc_base_url()) .seo_url($detail['seo_item_meta_title']);?></span>
        <p class="preview_desc"><?php echo $detail['seo_item_meta_description'] ; ?></p>
      </div>
    </div>
    <div class="form-group" id="seo_item_meta">
      <div class="form-control-list">
        <label for="seo_item_meta_title">
          <?php _e( 'Meta Title', SEO_PLUGIN_FOLDER ) ; ?>
          : </label>
        <input id="seo_item_meta_title" type="text" name="seo_item_meta_title" value="<?php echo $detail['seo_item_meta_title'] ; ?>" title="<?php _e('The title is what appears on search engines result page (SERP) as the title. ', SEO_PLUGIN_FOLDER);?>" />
        <span id="seo-title">
        <?php _e('Preferably under 55 characters.', SEO_PLUGIN_FOLDER);?>
        </span> </div>
      <div class="form-control-list">
        <label>
          <?php _e( 'Format', SEO_PLUGIN_FOLDER ) ; ?>
          : </label>
        <div class="format_example">
          <?php _e( 'title', SEO_PLUGIN_FOLDER ) ; ?>
          |
          <?php _e( 'city', SEO_PLUGIN_FOLDER ) ; ?>
          |
          <?php _e( 'region', SEO_PLUGIN_FOLDER ) ; ?>
          |
          <?php _e( 'country', SEO_PLUGIN_FOLDER ) ; ?>
        </div>
        <div class="seprator_list">
          <?php _e( 'title', SEO_PLUGIN_FOLDER ) ; ?>
          <?php 
		if(!empty($detail['seo_item_meta_title_format'])){
			$format =json_decode($detail['seo_item_meta_title_format']);
		}else{
			$format = array_fill(0, 6, '');
		}
		?>
          <?php seo_seperaters_select('seo_item_meta_title_format[]', $format[0]);?>
          <?php seo_address_select('seo_item_meta_title_format[]', $format[1]);?>
          <?php seo_seperaters_select('seo_item_meta_title_format[]', $format[2]);?>
          <?php seo_address_select('seo_item_meta_title_format[]', $format[3]);?>
          <?php seo_seperaters_select('seo_item_meta_title_format[]', $format[4]);?>
          <?php seo_address_select('seo_item_meta_title_format[]', $format[5]);?>
        </div>
      </div>
      <div class="form-control-list">
        <label for="seo_item_meta_description">
          <?php _e( 'Meta Description', SEO_PLUGIN_FOLDER ) ; ?>
          : </label>
        <textarea id="seo_item_meta_description" name="seo_item_meta_description" title="<?php _e('The description is what appears on search engines result page (SERP) as a short description under the title and the link. This also tells the search engine what your page or site is about.', SEO_PLUGIN_FOLDER);?>"><?php echo $detail['seo_item_meta_description'] ; ?></textarea>
        <span id="seo-description">
        <?php _e('Preferably under 155 characters.', SEO_PLUGIN_FOLDER);?>
        </span> </div>
      <div class="form-control-list">
        <label for="seo_item_meta_keywords">
          <?php _e( 'Meta Keywords', SEO_PLUGIN_FOLDER ) ; ?>
          : </label>
        <textarea placeholder="keyword1, keyword2" id="seo_item_meta_keywords" name="seo_item_meta_keywords" title="<?php _e('The keywords help to tell search engines what the topic of the page is.', SEO_PLUGIN_FOLDER);?>"><?php echo $detail['seo_item_meta_keywords'] ; ?></textarea>
        <span id="sep_wiz">
        <?php _e('Separate keywords with commas.', SEO_PLUGIN_FOLDER);?>
        </span> </div>
    </div>
  </div>
  <address class="wizards_address">
  <span>&copy; 2015 <a target="_blank" title="Premium Osclass Themes - OsclassWizards" title="Premium Osclass Themes - OsclassWizards" href="http://www.osclasswizards.com/">OsclassWizards</a>. All rights reserved.</span>
  </address>
</div>
<script type="text/javascript" src="<?php echo osc_plugin_url( SEO_PLUGIN_FOLDER.'/js/script.js' ).'script.js'; ?>"></script> 
