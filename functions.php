<?php

	require_once('bapi-php/bapi.php');
	
	/* Converted a url to a physical file path */
	function get_local($url) {
		$urlParts = parse_url($url);
		return realpath($_SERVER['DOCUMENT_ROOT']) . $urlParts['path'];				
	}
	
	function get_relative($url) {
		$urlParts = parse_url($url);
		return $urlParts['path'];		
	}
	
	function get_adminurl($url) {
		$url = get_relative( plugins_url($url, __FILE__) );
		return str_replace("/wp-content/plugins","",$url);	
	}	
	
	/* BAPI Helpers */	
	function getbapiurl() {
		$bapi_baseurl = 'connect.bookt.com';
		if(get_option('bapi_baseurl')){
			$bapi_baseurl = get_option('bapi_baseurl');
		}
		if(empty($bapi_baseurl)){
			$bapi_baseurl = 'connect.bookt.com';
		}
		if (stripos($bapi_baseurl, "localhost", 0) === 0) {			
			return "http://" . $bapi_baseurl;
		}
		return "https://" . $bapi_baseurl;
	}

	function getbapilanguage() {
		$language = get_option('bapi_language');	
		if(empty($language)) {
			$language = "en-US";
		}
		return $language;	
	}
	
	function bapi_language_attributes($doctype) {
		return 'lang="'.getbapilanguage().'"';
	}

	function getbapijsurl($apiKey) {
		return getbapiurl() . "/js/bapi.js?apikey=" . $apiKey . "&language=" . getbapilanguage();
	}

	function getbapiapikey() {
		return get_option('api_key');
	}
	
	function getbapisolutiondata() {
		$wrapper = array();	
		$wrapper['site'] = getbapicontext();
		$wrapper['textdata'] = getbapitextdata();			
		return $wrapper;
	}	
	
	function getbapicontext() {	
		return json_decode(get_option('bapi_solutiondata'),TRUE); 		
	}
	
	function getbapitextdata() {
		return json_decode(get_option('bapi_textdata'),TRUE); 		
	}	
	
	/* Page Helpers */
	function getPageKeyForEntity($entity, $pkid) {
		return $entity . ':' . $pkid;
	}	
	
	function getPageForEntity($entity, $pkid, $parentid) {
		$pagekey = getPageKeyForEntity($entity, $pkid);
		$args = array('meta_key' => 'bapikey', 'meta_value' => $pagekey, 'child_of' => $parentid);
		return get_pages($args);		
	}
	
	/* Common include files needed for BAPI */
	function getconfig() {		
		//echo 'getconfig';
		//echo get_option('api_key');
		if(get_option('api_key')){
			$apiKey = get_option('api_key');
			$language = getbapilanguage();			
			
			$secureurl = '';
			if(get_option('bapi_secureurl')){
				$secureurl = get_option('bapi_secureurl');
			}
			$siteurl = get_option('home');
			if(get_option('bapi_site_cdn_domain')){
				$siteurl = get_option('bapi_site_cdn_domain');
			}
			$siteurl = str_replace("http://", "", $siteurl);
?>
<link rel="stylesheet" type="text/css" href="<?= get_relative(plugins_url('/css/jquery.ui/jquery-ui-1.10.2.min.css', __FILE__)) ?>" />

<script type="text/javascript" src="<?= get_relative(plugins_url('/js/jquery.1.9.1.min.js', __FILE__)) ?>" ></script>
<script type="text/javascript" src="<?= get_relative(plugins_url('/js/jquery-migrate-1.0.0.min.js', __FILE__)) ?>" ></script>		
<script type="text/javascript" src="<?= get_relative(plugins_url('/js/jquery-ui-1.10.2.min.js', __FILE__)) ?>" ></script>
<script type="text/javascript" src="<?= get_relative(plugins_url('/js/jquery-ui-i18n.min.js', __FILE__)) ?>" ></script>			

<script type="text/javascript" src="<?= getbapijsurl($apiKey) ?>"></script>
<script type="text/javascript" src="<?= get_relative(plugins_url('/bapi/bapi.ui.js', __FILE__)) ?>" ></script>		
<script type="text/javascript" src="<?= get_relative(plugins_url('bapi.textdata.php', __FILE__)) ?>" ></script>		
<script type="text/javascript" src="<?= get_relative(plugins_url('bapi.templates.php', __FILE__)) ?>" ></script>		
<script type="text/javascript">		
	BAPI.defaultOptions.baseURL = '<?= getbapiurl() ?>';
	BAPI.UI.loading.setLoadingImgUrl('<?= plugins_url("/img/loading.gif", __FILE__) ?>');
	BAPI.site.url =  '<?= $siteurl ?>';
	<?php if ($secureurl!='') { ?>
	BAPI.site.secureurl = '<?= $secureurl ?>';
	<?php } ?>
	BAPI.init('<?= $apiKey ?>');
	BAPI.UI.jsroot = '<?= plugins_url("/", __FILE__) ?>'
	$(document).ready(function () {
		BAPI.UI.init();
	});    
</script>

<?php			
		}
	}

	/* Slideshow */
	function bapi_get_slideshow($mode='raw'){
		$slide1 = get_option('bapi_slideshow_image1');
		$slide2 = get_option('bapi_slideshow_image2');
		$slide3 = get_option('bapi_slideshow_image3');
		$slide4 = get_option('bapi_slideshow_image4');
		$slide5 = get_option('bapi_slideshow_image5');
		$slide6 = get_option('bapi_slideshow_image6');
		$slide1cap = get_option('bapi_slideshow_caption1');
		$slide2cap = get_option('bapi_slideshow_caption2');
		$slide3cap = get_option('bapi_slideshow_caption3');
		$slide4cap = get_option('bapi_slideshow_caption4');
		$slide5cap = get_option('bapi_slideshow_caption5');
		$slide6cap = get_option('bapi_slideshow_caption6');
		$slideshow = array();
		$i = 0;
		if(strlen($slide1)>0){
			$slideshow[$i] = array("url"=>$slide1,"caption"=>$slide1cap,"thumb"=>plugins_url('thumbs/timthumb.php?src='.urlencode($slide1).'&h=80', __FILE__));
			$i++;
		}
		if(strlen($slide2)>0){
			$slideshow[$i] = array("url"=>$slide2,"caption"=>$slide2cap,"thumb"=>plugins_url('thumbs/timthumb.php?src='.urlencode($slide2).'&h=80', __FILE__));
			$i++;
		}
		if(strlen($slide3)>0){
			$slideshow[$i] = array("url"=>$slide3,"caption"=>$slide3cap,"thumb"=>plugins_url('thumbs/timthumb.php?src='.urlencode($slide3).'&h=80', __FILE__));
			$i++;
		}
		if(strlen($slide4)>0){
			$slideshow[$i] = array("url"=>$slide4,"caption"=>$slide4cap,"thumb"=>plugins_url('thumbs/timthumb.php?src='.urlencode($slide4).'&h=80', __FILE__));
			$i++;
		}
		if(strlen($slide5)>0){
			$slideshow[$i] = array("url"=>$slide5,"caption"=>$slide5cap,"thumb"=>plugins_url('thumbs/timthumb.php?src='.urlencode($slide5).'&h=80', __FILE__));
			$i++;
		}
		if(strlen($slide6)>0){
			$slideshow[$i] = array("url"=>$slide6,"caption"=>$slide6cap,"thumb"=>plugins_url('thumbs/timthumb.php?src='.urlencode($slide6).'&h=80', __FILE__));
			$i++;
		}
		if($mode=='raw'){
			return $slideshow;
		}
		if($mode=='json'){
			$json = json_encode($slideshow);
			?>
			<script>
				var slides_json = '<?= $json ?>';
			</script>	
			<?php
			return true;
		}
		if($mode=='divs'){
			foreach($slideshow as $sl){
				?>
				<div>
					<a href=""><img src="<?= $sl['url'] ?>" title="<?= $sl['caption'] ?>" /></a>
				</div>
				<?php
			}
			return true;
		}
	}
	
	/* CDN Support */
	function home_url_cdn( $path = '', $scheme = null ) {
		return get_home_url_cdn( null, $path, $scheme );
	}

	function get_home_url_cdn( $blog_id = null, $path = '', $scheme = null ) {	
		$cdn_url = get_option('home');
		if(get_option('bapi_site_cdn_domain')&&!is_admin()){
			$cdn_url = get_option('bapi_site_cdn_domain');
		}
		$home_url = str_replace(get_option('home'),$cdn_url,$path);
		//echo $home_url; 
		
		return $home_url;
	}
	
	function add_server_name_meta(){
		$sn = gethostname();
		echo '<meta name="SERVERNAME" content="'.$sn.'" />'."\n";
	}
	
	function bapi_redirect_fix($redirect_url, $requested_url) {
		$cdn_domain = parse_url(get_option('bapi_site_cdn_domain'));
		$redirect = parse_url($redirect_url);
		if($redirect['scheme']!='https') {
			$redirect_url = $redirect['scheme'].'://'.$cdn_domain['host'];
			$redirect_url .= $redirect['path'];
			if ( !empty($redirect['query']) ) {
				$redirect_url .= '?' . $redirect['query'];
			}
			return $redirect_url; 
		}
		return $redirect_url;
	}
	
	function bapi_getmeta(){
		$pid = get_the_ID();
		
		$metak = get_post_meta($pid,'bapi_meta_keywords',true);
		$metak = str_replace('"', "", $metak);
		$metak = str_replace("'", "", $metak);
		
		$metad = get_post_meta($pid,'bapi_meta_description',true);
		$metad = str_replace('"', "", $metad);
		$metad = str_replace("'", "", $metad);
		
		?><meta name="KEYWORDS" content="<?= $metak ?>" /><?= "\n" ?><meta name="DESCRIPTION" content="<?= $metad ?>" /><?= "\n" ?><?php
	}
	
	function getBAPIObj() {
		return new BAPI(get_option('api_key'), get_option('bapi_language'), get_option('bapi_baseurl'));
	}		
?>