<?php
	osc_add_filter('meta_title_filter', 'seo_meta_title_filter');
	osc_add_filter('meta_description_filter', 'seo_meta_description_filter');
	osc_add_filter('meta_keywords_filter', 'seo_meta_keywords_filter');
	
	function seo_meta_title_filter(){
		$location = Rewrite::newInstance()->get_location();
		$section  = Rewrite::newInstance()->get_section();
		$text = '';
		switch ($location) {
			case ('item'):
				switch ($section) {
					case 'item_add':    $text = __('Publish a listing'). seo_page_title_separator() . seo_page_title(); break;
					case 'item_edit':   $text = __('Edit your listing'). seo_page_title_separator() . seo_page_title(); break;
					case 'send_friend': $text = __('Send to a friend') . seo_page_title_separator() . osc_item_title(). seo_page_title_separator() . seo_page_title(); break;
					case 'contact':     $text = __('Contact seller') . seo_page_title_separator() . osc_item_title(); break;
					default:            
						$detail    = seo_get_row( osc_item_id() ) ;
						if(empty($detail['seo_item_meta_title'])){
							$text = osc_item_title() . ' ' . osc_item_city(). seo_page_title_separator() . seo_page_title();
						}
						else{
							$text = $detail['seo_item_meta_title'];
							$format = json_decode($detail['seo_item_meta_title_format']);
							if(!empty($format)){
								foreach($format as $value){
									if(!empty($value)){
										if(seo_format_value($value) != '')
										$text .= ' '.seo_format_value($value);
									}
								}
							}else{
								$text .= ' ';
							}
							
							$text .= seo_page_title_separator() . seo_page_title();
						}
					break;
				}
			break;
			case('page'):
				if(!osc_get_preference('seo_title_page_'.osc_static_page_id(), 'seo_plugin'))
					$text = osc_static_page_title(). seo_page_title_separator() . seo_page_title();
				else
					$text = osc_get_preference('seo_title_page_'.osc_static_page_id(), 'seo_plugin'). seo_page_title_separator() . seo_page_title();
			break;
			case('error'):
				$text = __('Error'). seo_page_title_separator() . seo_page_title();
			break;
			case('search'):
				$region   = osc_search_region();
				$city     = osc_search_city();
				$pattern  = osc_search_pattern();
				$category = osc_search_category_id();
				$s_page   = '';
				$i_page   = Params::getParam('iPage');
				if($i_page != '' && $i_page > 1) {
					$s_page = seo_page_title_separator() . __('page') . ' ' . $i_page;
				}
				$b_show_all = ($region == '' && $city == '' && $pattern == '' && empty($category));
				$b_category = (!empty($category));
				$b_pattern  = ($pattern != '');
				$b_city     = ($city != '');
				$b_region   = ($region != '');
				if($b_show_all) {
					$text = __('Show all listings') . seo_page_title_separator() . $s_page . seo_page_title();
				}
				$result = '';
				if($b_pattern) {
					$result .= $pattern . ' &raquo; ';
				}
				if($b_category && is_array($category) && count($category) > 0) {
					$cat = Category::newInstance()->findByPrimaryKey($category[0]);
					if( $cat ) {
						$result .= $cat['s_name'].' ';
					}
				}
				if($b_city) {
					$result .= $city . ' &raquo; ';
				} else if($b_region) {
					$result .= $region . ' &raquo; ';
				}
				$result = preg_replace('|\s?&raquo;\s$|', '', $result);
				if($result == '') {
					$result = __('Search results');
				}
				$text = '';
				if( osc_get_preference('seo_title_keyword') != '' ) {
					$text .= osc_get_preference('seo_title_keyword') . ' '. seo_page_title_separator() . seo_page_title();
				}
				$text .= $result . $s_page. seo_page_title_separator() . seo_page_title();
			break;
			case('login'):
				switch ($section) {
					case('recover'): $text = __('Recover your password'). seo_page_title_separator() . seo_page_title();
					default:         $text = __('Login'). seo_page_title_separator() . seo_page_title();
				}
			break;
			case('register'):
				$text = __('Create a new account'). seo_page_title_separator() . seo_page_title();
			break;
			case('user'):
				switch ($section) {
					case('dashboard'):       $text = __('Dashboard'). seo_page_title_separator() . seo_page_title(); break;
					case('items'):           $text = __('Manage my listings'). seo_page_title_separator() . seo_page_title(); break;
					case('alerts'):          $text = __('Manage my alerts'). seo_page_title_separator() . seo_page_title(); break;
					case('profile'):         $text = __('Update my profile'). seo_page_title_separator() . seo_page_title(); break;
					case('pub_profile'):     $text = __('Public profile') . seo_page_title_separator() . osc_user_name(). seo_page_title_separator() . seo_page_title(); break;
					case('change_email'):    $text = __('Change my email'). seo_page_title_separator() . seo_page_title(); break;
					case('change_username'): $text = __('Change my username'). seo_page_title_separator() . seo_page_title(); break;
					case('change_password'): $text = __('Change my password'). seo_page_title_separator() . seo_page_title(); break;
					case('forgot'):          $text = __('Recover my password'). seo_page_title_separator() . seo_page_title(); break;
				}
			break;
			case('contact'):
				if(!osc_get_preference('seo_title_page_contact', 'seo_plugin'))
					$text = __('Contact'). seo_page_title_separator() . seo_page_title();
				else
					$text = osc_get_preference('seo_title_page_contact', 'seo_plugin'). seo_page_title_separator() . seo_page_title();
			break;
			default:
				$text = seo_page_title();
			break;
		}

		return $text;
	}
	
	function seo_meta_description_filter( ) {
		$text = '';
		// home page
		if( osc_is_home_page() ) {
			if(!osc_get_preference('seo_metadesc_home', 'seo_plugin'))
				$text = osc_page_description();
			else
				$text = osc_get_preference('seo_metadesc_home', 'seo_plugin');
		}
		// static page
		if( osc_is_static_page() ) {
			if(!osc_get_preference('seo_metadesc_page_'.osc_static_page_id(), 'seo_plugin'))
				$text = osc_highlight(osc_static_page_text(), 140, '', '');
			else
				$text = osc_get_preference('seo_metadesc_page_'.osc_static_page_id(), 'seo_plugin');
		}
		//contact page
		if(osc_is_contact_page()){
			if(osc_get_preference('seo_metadesc_page_contact', 'seo_plugin'))
				$text = osc_get_preference('seo_metadesc_page_contact', 'seo_plugin');
		}
		
		// search
		if( osc_is_search_page() ) {

			if( osc_has_items() ) {
			$text = osc_item_category() . ' ' . osc_item_city() . ', ' . osc_highlight(osc_item_description(), 120);
			}
			osc_reset_items();
			
		}
		// listing
		if( osc_is_ad_page() ) {
			$detail    = seo_get_row( osc_item_id() ) ;
			if(empty($detail['seo_item_meta_description']))
				$text = osc_item_category() . ' ' . osc_item_city() . ', ' . osc_highlight(osc_item_description(), 120);
			else
				$text = $detail['seo_item_meta_description'];
		}
		return $text;
	}
	
	function seo_meta_keywords_filter() {
		$text = '';
		
		//home page
		if( osc_is_home_page() ) {
			if(osc_get_preference('seo_metakeywords_home', 'seo_plugin'))
				$text = osc_get_preference('seo_metakeywords_home', 'seo_plugin');
		}
		
		// static page
		if( osc_is_static_page() ) {
			if(osc_get_preference('seo_metakeywords_page_'.osc_static_page_id(), 'seo_plugin'))
				$text = osc_get_preference('seo_metakeywords_page_'.osc_static_page_id(), 'seo_plugin');
		}
		
		//contact page
		if(osc_is_contact_page()){
			if(osc_get_preference('seo_metakeywords_page_contact', 'seo_plugin'))
				$text = osc_get_preference('seo_metakeywords_page_contact', 'seo_plugin');
		}
		
		// search
		if( osc_is_search_page() ) {
			if( osc_has_items() ) {
				$keywords = array();
				$keywords[] = osc_item_category();
				if( osc_item_city() != '' ) {
					$keywords[] = osc_item_city();
					$keywords[] = sprintf('%s %s', osc_item_category(), osc_item_city());
				}
				if( osc_item_region() != '' ) {
					$keywords[] = osc_item_region();
					$keywords[] = sprintf('%s %s', osc_item_category(), osc_item_region());
				}
				if( (osc_item_city() != '') && (osc_item_region() != '') ) {
					$keywords[] = sprintf('%s %s %s', osc_item_category(), osc_item_region(), osc_item_city());
					$keywords[] = sprintf('%s %s', osc_item_region(), osc_item_city());
				}
				$text = implode(', ', $keywords);
			}
			osc_reset_items();
		}
		// listing
		if( osc_is_ad_page() ) {
			$detail    = seo_get_row( osc_item_id() ) ;
			if(empty($detail['seo_item_meta_keywords'])){
				$keywords = array();
				$keywords[] = osc_item_category();
				if( osc_item_city() != '' ) {
					$keywords[] = osc_item_city();
					$keywords[] = sprintf('%s %s', osc_item_category(), osc_item_city());
				}
				if( osc_item_region() != '' ) {
					$keywords[] = osc_item_region();
					$keywords[] = sprintf('%s %s', osc_item_category(), osc_item_region());
				}
				if( (osc_item_city() != '') && (osc_item_region() != '') ) {
					$keywords[] = sprintf('%s %s %s', osc_item_category(), osc_item_region(), osc_item_city());
					$keywords[] = sprintf('%s %s', osc_item_region(), osc_item_city());
				}
				$text = implode(', ', $keywords);
			}
			else
				$text = $detail['seo_item_meta_keywords'];
		}

		return $text;
	}
	