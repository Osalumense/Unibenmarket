
<div id="page-accordion">
  <?php
        osc_reset_static_pages();
        while( osc_has_static_pages() ) { ?>
  <h3><strong><?php echo osc_static_page_title(); ?></strong></h3>
  <form action="<?php echo osc_admin_render_plugin_url(osc_plugin_folder(__FILE__).'titles_metas.php');?>" method="post" enctype="multipart/form-data" class="nocsrf">
    <input type="hidden" name="seo_action" value="titles_metas_pages" />
    <fieldset>
      <label><?php echo osc_esc_html(__('Meta Title',SEO_PLUGIN_FOLDER)); ?>:</label>
      <input placeholder="" type="text" name="seo_titles[seo_title_page_<?php echo osc_static_page_id(); ?>]" value="<?php echo osc_get_preference('seo_title_page_'.osc_static_page_id(), 'seo_plugin');?>" title="<?php _e('The title is what appears on search engines result page (SERP) as the title. ', SEO_PLUGIN_FOLDER);?>"  />
      <br>
      <br>
      <label><?php echo osc_esc_html(__('Meta Description',SEO_PLUGIN_FOLDER)); ?>:</label>
      <textarea cols="" rows="" name="seo_titles[seo_metadesc_page_<?php echo osc_static_page_id(); ?>]" title="<?php _e('The description is what appears on search engines result page (SERP) as a short description under the title and the link. This also tells the search engine what your page or site is about.', SEO_PLUGIN_FOLDER);?>"><?php echo osc_get_preference('seo_metadesc_page_'.osc_static_page_id(), 'seo_plugin');?></textarea>
      <br>
      <br>
      <label><?php echo osc_esc_html(__('Meta Keywords',SEO_PLUGIN_FOLDER)); ?>:</label>
      <textarea cols="" rows="" name="seo_titles[seo_metakeywords_page_<?php echo osc_static_page_id(); ?>]" title="<?php _e('The keywords help to tell search engines what the topic of the page is.', SEO_PLUGIN_FOLDER);?>"><?php echo osc_get_preference('seo_metakeywords_page_'.osc_static_page_id(), 'seo_plugin');?></textarea>
      <br>
      <div class="form-actions">
        <input id="button" type="submit" value="<?php echo osc_esc_html(__('Save changes',SEO_PLUGIN_FOLDER)); ?>" class="btn btn-submit">
      </div>
    </fieldset>
  </form>
  <?php
			}
		?>
  <h3><strong>
    <?php _e('Contact', SEO_PLUGIN_FOLDER); ?>
    </strong></h3>
  <form action="<?php echo osc_admin_render_plugin_url(osc_plugin_folder(__FILE__).'titles_metas.php');?>" method="post" enctype="multipart/form-data" class="nocsrf">
    <input type="hidden" name="seo_action" value="titles_metas_pages" />
    <fieldset>
      <label><?php echo osc_esc_html(__('Meta Title',SEO_PLUGIN_FOLDER)); ?>:</label>
      <input placeholder="" type="text" name="seo_titles[seo_title_page_contact]" value="<?php echo osc_get_preference('seo_title_page_contact', 'seo_plugin');?>" title="<?php _e('The title is what appears on search engines result page (SERP) as the title. ', SEO_PLUGIN_FOLDER);?>" />
      <br>
      <br>
      <label><?php echo osc_esc_html(__('Meta Description',SEO_PLUGIN_FOLDER)); ?>:</label>
      <textarea cols="" rows="" name="seo_titles[seo_metadesc_page_contact]" title="<?php _e('The description is what appears on search engines result page (SERP) as a short description under the title and the link. This also tells the search engine what your page or site is about.', SEO_PLUGIN_FOLDER);?>"><?php echo osc_get_preference('seo_metadesc_page_contact', 'seo_plugin');?></textarea>
      <br>
      <br>
      <label><?php echo osc_esc_html(__('Meta Keywords',SEO_PLUGIN_FOLDER)); ?>:</label>
      <textarea cols="" rows="" name="seo_titles[seo_metakeywords_page_contact]" title="<?php _e('The keywords help to tell search engines what the topic of the page is.', SEO_PLUGIN_FOLDER);?>"><?php echo osc_get_preference('seo_metakeywords_page_contact', 'seo_plugin');?></textarea>
      <br>
      <div class="form-actions">
        <input id="button" type="submit" value="<?php echo osc_esc_html(__('Save changes',SEO_PLUGIN_FOLDER)); ?>" class="btn btn-submit">
      </div>
    </fieldset>
  </form>
</div>
<script type="text/javascript" src="<?php echo osc_plugin_url( SEO_PLUGIN_FOLDER.'/js/script.js' ).'script.js'; ?>"></script> 
