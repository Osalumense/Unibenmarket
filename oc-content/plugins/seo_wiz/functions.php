<?php 

	function seo_get_row($itemID) {
        $conn = DBConnectionClass::newInstance() ;
        $c_db = $conn->getOsclassDb() ;
        $comm = new DBCommandClass( $c_db ) ;

        $comm->select() ;
        $comm->from( SEO_PLUGIN_ITEM_META_TABLE ) ;
        $comm->where( 'fk_i_item_id', $itemID ) ;
        $rs = $comm->get() ;

        if( $rs === false ) {
            return false ;
        }

        if( $rs->numRows() != 1 ) {
            return false ;
        }

        return $detail = $rs->row() ;
    }
	
	function seo_url($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return substr($string, 0, 25).'...';
	}	
	
	//separaters
	function seo_seperaters_select($name=NULL, $value=NULL){
?>

<select name="<?php echo $name;?>" class="separaters_symbol">
  <option value="" <?php if($value == NULL) echo 'selected="selected"'; ?>>
  <?php _e( 'none', SEO_PLUGIN_FOLDER ) ; ?>
  </option>
  <option value="|" <?php if($value == "|") echo 'selected="selected"'; ?>>|</option>
  <option value="," <?php if($value == ",") echo 'selected="selected"'; ?>>,</option>
  <option value="–" <?php if($value == "–") echo 'selected="selected"'; ?>>–</option>
  <option value="—" <?php if($value == "—") echo 'selected="selected"'; ?>>—</option>
  <option value="." <?php if($value == ".") echo 'selected="selected"'; ?>>.</option>
  <option value="•" <?php if($value == "•") echo 'selected="selected"'; ?>>•</option>
  <option value="✭" <?php if($value == "✭") echo 'selected="selected"'; ?>>✭</option>
  <option value="«" <?php if($value == "«") echo 'selected="selected"'; ?>>«</option>
  <option value="»" <?php if($value == "»") echo 'selected="selected"'; ?>>»</option>
  <option value="<?php echo htmlspecialchars("&lt;");?>" <?php if($value == "&lt;") echo 'selected="selected"'; ?>>&lt;</option>
  <option value="<?php echo htmlspecialchars("&gt;");?>" <?php if($value == "&gt;") echo 'selected="selected"'; ?>>&gt;</option>
</select>
<?php
	}
	
	function seo_address_select($name=NULL, $value=NULL){
?>
<select name="<?php echo $name;?>"  class="separaters_location">
  <option value="" <?php if($value == NULL) echo 'selected="selected"'; ?>>
  <?php _e( 'none', SEO_PLUGIN_FOLDER ) ; ?>
  </option>
  <option value="country" <?php if($value == "country") echo 'selected="selected"'; ?>>
  <?php _e( 'country', SEO_PLUGIN_FOLDER ) ; ?>
  </option>
  <option value="region" <?php if($value == "region") echo 'selected="selected"'; ?>>
  <?php _e( 'region', SEO_PLUGIN_FOLDER ) ; ?>
  </option>
  <option value="city" <?php if($value == "city") echo 'selected="selected"'; ?>>
  <?php _e( 'city', SEO_PLUGIN_FOLDER ) ; ?>
  </option>
</select>
<?php
	}
	
	function seo_format_value($value){
		switch($value){
			case 'country':
			return osc_item_country();
			break;
			
			case 'region':
			return osc_item_region();
			break;
			
			case 'city':
			return osc_item_city();
			break;
			
			default:
			return $value;
			break;
		}
	}
	
	function seo_page_title(){
		if(!osc_get_preference('seo_title_home', 'seo_plugin'))
			return osc_page_title();
		else
			return osc_get_preference('seo_title_home', 'seo_plugin');
	}
	
	function seo_page_title_separator(){
		return ' '.osc_get_preference('page_title_separator', 'seo_plugin').' ';
	}
