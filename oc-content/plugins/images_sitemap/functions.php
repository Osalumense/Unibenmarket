<?php

function images_sitemap_path() {
        return osc_base_path() . 'oc-content/uploads/';
    }

function add_new_imgsitemap()
{
	$deft = osc_get_preference('def_title', 'images_sitemap');
  $filename = osc_base_path() . 'imagesmap.xml';
  @unlink($filename);
  $xml  = '<?xml version="1.0" encoding="UTF-8"?>'. PHP_EOL;
  $xml  .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'. PHP_EOL;
  $xml  .= '  <url>' . PHP_EOL;
  $xml .= '    <loc>' . osc_base_url().'imagesmap.xml</loc>' . PHP_EOL;
  $dir = images_sitemap_path(); 
  $it = new RecursiveDirectoryIterator("$dir"); 
   foreach(new RecursiveIteratorIterator($it) as $fil) 
    { 
    if((stripos($fil, ".jpg")) || (stripos($fil, ".png")) or (stripos($fil, ".gif") )){
        $imag[] = preg_replace("#\\\#", "/", $fil); 
    } 
   }
  foreach ($imag as $im) {
  $img = strstr($im, 'oc-content/uploads/');
  $url = ''. osc_base_url(). ''.$img.'';
  $idr = intval(substr($url, strrpos($url, '/') + 1));
  $item_id = ModelIS::newInstance()->getItemFromRes($idr);
      $num = $item_id['fk_i_item_id'];
	$id = Item::NewInstance()->FindByPrimaryKey($num);
  $xml  .= '    <image:image>' . PHP_EOL;
  $xml .=  '      <image:loc>'. osc_base_url(). ''.$img.'</image:loc>' .PHP_EOL;
  if(!empty($id)){
	$xml .= '<image:title>'. $id['s_title'] .'</image:title>' . PHP_EOL;
	//$xml .= '<image:caption>'. var_export(substr($id['s_description'],0, 50), true).'</image:caption>' . PHP_EOL;
  } else {
	$xml .= '<image:title>'.$deft.'</image:title>' . PHP_EOL;
	//$xml .= '<image:caption></image:caption>' . PHP_EOL;
  }
  $xml  .= '    </image:image>' . PHP_EOL;
  }
  $xml .= '  </url>' . PHP_EOL;
  $xml .= '</urlset>' . PHP_EOL;
  file_put_contents($filename, $xml, FILE_APPEND);
  if(osc_get_preference('ping_engines', 'images_sitemap')== 1){
	images_map_ping_search_engines();
  }
}

function images_map_ping_search_engines()
{
    // GOOGLE
    osc_doRequest('http://www.google.com/webmasters/sitemaps/ping?sitemap=' . urlencode(osc_base_url() . 'imagesmap.xml'), array());
    // BING
    osc_doRequest('http://www.bing.com/webmaster/ping.aspx?siteMap=' . urlencode(osc_base_url() . 'imagesmap.xml'), array());
    // YAHOO!
    osc_doRequest('http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=' . osc_page_title() . '&url=' . urlencode(osc_base_url() . 'imagesmap.xml'), array());
}

$frequenty = osc_get_preference('refresh_set', 'images_sitemap');
if( $frequenty == 'weekly' ) {
    osc_add_hook('cron_weekly', 'add_new_imgsitemap');
    } else if ( $frequenty == 'daily' ) {
    osc_add_hook('cron_daily', 'add_new_imgsitemap');
    } else if ( $frequenty == 'hourly' ) {
    osc_add_hook('cron_hourly', 'add_new_imgsitemap');
}
?>