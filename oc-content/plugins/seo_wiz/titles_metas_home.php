
  <form action="<?php echo osc_admin_render_plugin_url(osc_plugin_folder(__FILE__).'titles_metas.php');?>" method="post">
		<input type="hidden" name="seo_action" value="titles_metas_home" />
        <label><?php _e('Meta Title',SEO_PLUGIN_FOLDER);?>:</label>
		<input name="seo_titles[seo_title_home]" placeholder="" type="text" value="<?php echo osc_get_preference('seo_title_home', 'seo_plugin');?>" title="<?php _e('The title is what appears on search engines result page (SERP) as the title. ', SEO_PLUGIN_FOLDER);?>" >
		<br><br>
        <label><?php echo osc_esc_html(__('Meta Description',SEO_PLUGIN_FOLDER)); ?>:</label>
        <textarea cols="" name="seo_titles[seo_metadesc_home]" rows="" title="<?php _e('The description is what appears on search engines result page (SERP) as a short description under the title and the link. This also tells the search engine what your page or site is about.', SEO_PLUGIN_FOLDER);?>"><?php echo osc_get_preference('seo_metadesc_home', 'seo_plugin');?></textarea>
		<br><br>
        <label><?php echo osc_esc_html(__('Meta Keywords',SEO_PLUGIN_FOLDER)); ?>:</label> 
        <textarea cols="" name="seo_titles[seo_metakeywords_home]" rows="" title="<?php _e('The keywords help to tell search engines what the topic of the page is.', SEO_PLUGIN_FOLDER);?>"><?php echo osc_get_preference('seo_metakeywords_home', 'seo_plugin');?></textarea><br>
		
        <div class="form-actions">
            <input class="btn btn-submit" id="button" type="submit" value="<?php echo osc_esc_html(__('Save changes',SEO_PLUGIN_FOLDER)); ?>">
        </div>
    </form>