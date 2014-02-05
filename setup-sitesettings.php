<?php	
	global $bapi_all_options;	
	// handle if this is a post
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {				
		//bapi_wp_site_options();
		unset($_POST['submit']);		
		$postSitesettings = $_POST;
		//print_r($postSitesettings);
		
		/*foreach ($postSitesettings as $k => $v) {
			echo "[$k] => $v<br/>";
		}*/
		
		$sitesettings = json_encode($_POST);
		update_option('bapi_sitesettings',  $sitesettings);		
		echo '<div id="message" class="updated"><p><strong>Settings saved.</strong></p></div>';		
	}
	else {
		$sitesettings = $bapi_all_options['bapi_sitesettings'];
	}
/* we get BAPI */
getconfig();
?> 


<div class="wrap sitesettings-wrapper" style="display: none;">
<h1><a href="http://www.bookt.com" target="_blank"><img src="<?= plugins_url('/img/logo.png', __FILE__) ?>" /></a></h1>
<h2>InstaSite Plugin - Site Settings</h2>
<form method="post">

<h3>Search Result Display Modes</h3>
<table class="form-table">
<tr valign="top">
	<td scope="row">List View:</td>
	<td><input class="searchmode-listview-cbx" type="checkbox" checked="" />
	<input type="hidden" id="searchmode-listview" name="searchmode-listview" data-prevalue="BAPI.config().searchmodes.listview=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Photo View:</td>
	<td><input class="searchmode-photoview-cbx" type="checkbox" checked="" />
	<input type="hidden" id="searchmode-photoview" name="searchmode-photoview" data-prevalue="BAPI.config().searchmodes.photoview=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Wide Photo View:</td>
	<td><input class="searchmode-widephotoview-cbx" type="checkbox" checked="" />
	<input type="hidden" id="searchmode-widephotoview" name="searchmode-widephotoview" data-prevalue="BAPI.config().searchmodes.widephotoview=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Map View:</td>
	<td><input class="searchmode-mapview-cbx" type="checkbox" checked="" />
	<input type="hidden" id="searchmode-mapview" name="searchmode-mapview" data-prevalue="BAPI.config().searchmodes.mapview=" value="" />
	</td>	
</tr>
<!--<tr valign="top">
	<td scope="row">Hotel View:</td>
	<td><input class="searchmode-hotelview-cbx" type="checkbox" checked="" />
	<input type="hidden" id="searchmode-hotelview" name="searchmode-hotelview" data-prevalue="BAPI.config().searchmodes.hotelview=" value="" />
	</td>	
</tr>-->
</table>
<div class="clear"></div>

<h3>Search Result Settings</h3>
<table class="form-table">
<tr valign="top">
	<td scope="row">Availability Filtering:</td>
	<td><input class="showunavailunits-cbx" type="checkbox" checked="" />
	<input type="hidden" id="showunavailunits" name="showunavailunits" data-prevalue="BAPI.config().restrictavail=" value="" />
	</td>	
</tr>
<!--<tr valign="top">
	<td scope="row">Show Avg. Review Rating in Search Result:</td>
	<td><input id="" type="checkbox" name=""></td>
</tr>-->
<tr valign="top">
	<td scope="row">Default Search Sort Order Option:</td>
	<td>
		<select name="searchsort" id="searchsort">
		<option value="BAPI.config().sort='beds';">By Bedrooms</option>
		<option value="BAPI.config().sort='sleeps';">By Sleeps</option>
		<option value="BAPI.config().sort='category';">By Category</option>
		<option value="BAPI.config().sort='headline';">By Headline</option>
		<option value="BAPI.config().sort='location';">By City</option>
		<option value="BAPI.config().sort='minrate';">By Minimum Price</option>
		<option value="BAPI.config().sort='maxrate';">By Maximum Price</option>
		<option value="BAPI.config().sort='random';">Random</option>
		</select>
		<select name="searchsortorder" id="searchsortorder">
			<option value="BAPI.config().sortdesc=false;">Ascending</option>
			<option value="BAPI.config().sortdesc=true;">Descending</option>		
		</select>
	</td>
</tr>
</table>
<div class="clear"></div>

<h3>Property Search Form Settings</h3>
<table class="form-table">
<tr valign="top">
	<td scope="row">Check-In Check-Out Mode:</td>
	<td><select name="checkinoutmode" id="checkinoutmode">
		<option value="BAPI.config().checkin.enabled=false; BAPI.config().checkout.enabled=false; BAPI.config().los.enabled=false;">Disabled</option>
		<option value="BAPI.config().checkin.enabled=true; BAPI.config().checkout.enabled=true; BAPI.config().los.enabled=false;">Check In Date Picker/Check Out DatePicker</option>
		<option value="BAPI.config().checkin.enabled=true; BAPI.config().checkout.enabled=false; BAPI.config().los.enabled=true;">Check In Date Picker/Length of Stay DropDown</option>
	    </select>
	</td>
</tr>
<tr valign="top">
	<td scope="row">Default Nights of Stay:</td>
	<td><select name="deflos" id="deflos">
		<option value="BAPI.config().los.defaultval=0; BAPI.config().los.minval=0;">Disabled</option>
	    </select>
	</td>	
</tr>
<!--<tr valign="top">
	<td scope="row">Default Check-In Date X # of days Out (0 means no default):</td>
	<td><input id="" type="numeric" name=""></td>
</tr>-->
<tr valign="top">
	<td scope="row">Category Search:</td>
	<td><input class="categorysearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="categorysearch" name="categorysearch" data-prevalue="BAPI.config().category.enabled=" value="" />
	</td>	
</tr>
<!--<tr valign="top">
	<td scope="row">Sleeps Search (Exact):</td>
	<td><input class="sleepsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="sleepsearch" name="sleepsearch" data-prevalue="BAPI.config().sleeps.enabled=" value="" />
	</td>	
</tr>-->
<tr valign="top">
	<td scope="row">Sleeps Search (Min):</td>
	<td><input class="minsleepsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="minsleepsearch" name="minsleepsearch" data-prevalue="BAPI.config().minsleeps={}; BAPI.config().minsleeps.enabled=" value="" />
	</td>	
</tr>
<tr valign="top" style="display:none">
	<td scope="row">Bedroom Search (Exact):</td>
	<td><input class="bedsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="bedsearch" name="bedsearch" data-prevalue="BAPI.config().beds.enabled=" value="BAPI.config().beds.enabled=false;" />
	</td>
</tr>
<tr valign="top">
	<td scope="row">Bedroom Search (Min):</td>
	<td><input class="minbedsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="minbedsearch" name="minbedsearch" data-prevalue="BAPI.config().minbeds={}; BAPI.config().minbeds.enabled=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Max Bedrooms In List:</td>
	<td><select name="maxbedsearch" id="maxbedsearch">
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,1);">1</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,2);">2</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,3);">3</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,4);">4</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,5);">5</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,6);">6</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,7);">7</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,8);">8</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,9);">9</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,10);">10</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,11);">11</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,12);">12</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,13);">13</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,14);">14</option>
		<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,15);">15</option>
	    </select>
	</td>	
</tr>
<!--<tr valign="top">
	<td scope="row">Amenity Search:</td>
	<td><input class="amenitysearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="amenitysearch" name="amenitysearch" data-prevalue="BAPI.config().amenity.enabled=" value="" />
	</td>
</tr>-->
<tr valign="top">
	<td scope="row">Development Search:</td>
	<td><input class="devsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="devsearch" name="devsearch" data-prevalue="BAPI.config().dev.enabled=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Number of Adults Search:</td>
	<td><input class="adultsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="adultsearch" name="adultsearch" data-prevalue="BAPI.config().adults.enabled=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Number of Children Search:</td>
	<td><input class="childsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="childsearch" name="childsearch" data-prevalue="BAPI.config().children.enabled=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Property Headline Search:</td>
	<td><input class="headlinesearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="headlinesearch" name="headlinesearch" data-prevalue="BAPI.config().headline.enabled=" value="" />
	</td>	
</tr>
<tr valign="top">
	<td scope="row">Max Rate Search:</td>
	<td><input class="maxratesearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="maxratesearch" name="maxratesearch" data-prevalue="BAPI.config().rate.enabled=" value="" />
	</td>
</tr>
<tr valign="top" style="display:none;" >
	<td scope="row">Include # of Rooms/Units Search:</td>
	<td><input class="roomsearch-cbx" type="checkbox" checked="" />
	<input type="hidden" id="roomsearch" name="roomsearch" data-prevalue="BAPI.config().rooms.enabled=" value="BAPI.config().rooms.enabled=false" />
</tr>
<tr valign="top">
	<td scope="row">Location Search:</td>
	<td>
		<select name="locsearch" id="locsearch">
		<option value="BAPI.config().city.enabled=false; BAPI.config().location.enabled=false;">Disabled</option>
		<option value="BAPI.config().city.enabled=true; BAPI.config().location.enabled=false; BAPI.config().city.autocomplete=false;">City Drop Down List</option>
		<option value="BAPI.config().city.enabled=true; BAPI.config().location.enabled=false; BAPI.config().city.autocomplete=true;">City Autocomplete</option>
		<option value="BAPI.config().city.enabled=false; BAPI.config().location.enabled=true; BAPI.config().location.autocomplete=false;">Market Area Drop Down List</option>
		<option value="BAPI.config().city.enabled=false; BAPI.config().location.enabled=true; BAPI.config().location.autocomplete=true;">Market Area Autocomplete</option>
		</select>
	</td>
</tr>	
</table>
<div class="clear"></div>

<h3>Property Detail Screen Settings</h3>
<table class="form-table">
<tr valign="top">
	<td scope="row">Availability Calendar:</td>
	<td><select name="propdetail-availcal" id="propdetail-availcal">
		<option value="BAPI.config().displayavailcalendar=false;  BAPI.config().availcalendarmonths=0;">Disabled</option>
		<option value="BAPI.config().displayavailcalendar=true;  BAPI.config().availcalendarmonths=3;">Show 3 Months</option>
		<option value="BAPI.config().displayavailcalendar=true;  BAPI.config().availcalendarmonths=6;">Show 6 Months</option>
		<option value="BAPI.config().displayavailcalendar=true;  BAPI.config().availcalendarmonths=9;">Show 9 Months</option>
		<option value="BAPI.config().displayavailcalendar=true;  BAPI.config().availcalendarmonths=12;">Show 12 Months</option>
		<option value="BAPI.config().displayavailcalendar=true;  BAPI.config().availcalendarmonths=15;">Show 15 Months</option>
		<option value="BAPI.config().displayavailcalendar=true;  BAPI.config().availcalendarmonths=18;">Show 18 Months</option>
	    </select>
	</td>	
</tr>
<tr valign="top" style="display:none">
	<td scope="row">Show Split Days in Availability Calendars:</td>
	<td><input id="" type="checkbox" name=""></td>
</tr>
<tr valign="top">
	<td scope="row">Display Property Review Tab:</td>
	<td><input class="propdetail-reviewtab-cbx" type="checkbox" checked="" />
	<input type="hidden" id="propdetail-reviewtab" name="propdetail-reviewtab" data-prevalue="BAPI.config().hasreviews=" value="" />
	</td>	
</tr>
</table>

<?php submit_button(); ?>
</form>
</div>
<script type="text/javascript" src="<?= get_relative(plugins_url('/js/jquery.ibutton.min.js', __FILE__)) ?>" ></script>
<link type="text/css" href="<?= get_relative(plugins_url('/css/jquery.ibutton.min.css', __FILE__)) ?>" rel="stylesheet" media="all" />
<?php //var_dump(BAPISync::getSolutionData()); ?>

<script type="text/javascript">
<?php
$bapiSolutionData = BAPISync::getSolutionData();
$bapiSolutionDataConfig = $bapiSolutionData["ConfigObj"];
$maxratesearch = ($bapiSolutionDataConfig["rate"]["enabled"]) ? 'true' : 'false';
$amenitysearch = ($bapiSolutionDataConfig["amenity"]["enabled"]) ? 'true' : 'false';
$devsearch = ($bapiSolutionDataConfig["dev"]["enabled"]) ? 'true' : 'false';
$adultsearch = ($bapiSolutionDataConfig["adults"]["enabled"]) ? 'true' : 'false';
$adultsearch = ($bapiSolutionDataConfig["adults"]["enabled"]) ? 'true' : 'false';
$childsearch = ($bapiSolutionDataConfig["children"]["enabled"]) ? 'true' : 'false';
$headlinesearch = ($bapiSolutionDataConfig["headline"]["enabled"]) ? 'true' : 'false';
$propdetailavailcal = ($bapiSolutionDataConfig["displayavailcalendar"]) ? 'true' : 'false';
$availcalendarmonths = $bapiSolutionDataConfig["availcalendarmonths"];
$propdetailreviewtab = ($bapiSolutionDataConfig["hasreviews"]) ? 'true' : 'false';
$checkin = ($bapiSolutionDataConfig["checkin"]["enabled"]) ? 'true' : 'false';
$checkout = ($bapiSolutionDataConfig["checkout"]["enabled"]) ? 'true' : 'false';
$los = ($bapiSolutionDataConfig["los"]["enabled"]) ? 'true' : 'false';
$losdefaultval = $bapiSolutionDataConfig["los"]["defaultval"];
$losminval = $bapiSolutionDataConfig["los"]["minval"];
$categorysearch = ($bapiSolutionDataConfig["category"]["enabled"]) ? 'true' : 'false';
$minsleepsearch = ($bapiSolutionDataConfig["sleeps"]["enabled"]) ? 'true' : 'false';
$minbedsearch = ($bapiSolutionDataConfig["beds"]["enabled"]) ? 'true' : 'false';
$maxbedsearch = $bapiSolutionDataConfig["beds"]["maxval"];
$roomsearch = ($bapiSolutionDataConfig["rooms"]["enabled"]) ? 'true' : 'false';
$city = ($bapiSolutionDataConfig["city"]["enabled"]) ? 'true' : 'false';
$location = ($bapiSolutionDataConfig["location"]["enabled"]) ? 'true' : 'false';

$showunavailunits = ($bapiSolutionData["BizRules"]["Search By Availability"]) ? 'true' : 'false';
$searchsort = $bapiSolutionData["BizRules"]["Search Sort Order Option"];

/*		ByCategory = 0
            ByBedrooms = 1
            ByPriceLoHi = 2
            ByPriceHiLo = 3
            ByLocation = 4
            ByRandom = 5
            ByHeadline = 6
            ByImages = 7*/
            

	
	if (!empty($sitesettings)) {
		echo 'var settings=' . stripslashes($sitesettings) . ';';
	} else {
		
		echo '
		
		var locsearch = "BAPI.config().city.enabled=false; BAPI.config().location.enabled=false;";
		if('.$city.' && '.$location.'==false )
		{
			locsearch = "BAPI.config().city.enabled=true; BAPI.config().location.enabled=false; BAPI.config().city.autocomplete=false;";
		}
		if('.$city.'==false && '.$location.')
		{
			locsearch = "BAPI.config().city.enabled=false; BAPI.config().location.enabled=true; BAPI.config().location.autocomplete=false;";
		}
		var thesearchsort = "'.$searchsort.'";
		
		if(thesearchsort==0){
			thesearchsort = "BAPI.config().sort=\'category\';"
		}else{
			if(thesearchsort==1){
				thesearchsort = "BAPI.config().sort=\'beds\';"
			}else{
				if(thesearchsort==2){
					thesearchsort = "BAPI.config().sort=\'minrate\';"
				}else{
					if(thesearchsort==3){
						thesearchsort = "BAPI.config().sort=\'maxrate\';"
					}else{
						if(thesearchsort==4){
							thesearchsort = "BAPI.config().sort=\'location\';"
						}else{
							if(thesearchsort==5){
								thesearchsort = "BAPI.config().sort=\'random\';"
							}else{
								if(thesearchsort==6){
									thesearchsort = "BAPI.config().sort=\'headline\';"
								}else{
									thesearchsort = "BAPI.config().sort=\'random\';"
								}
							}
						}
					}
				}
			}
		}
		
		
		var settings={
			"maxratesearch": "BAPI.config().rate.enabled='.$maxratesearch.';",
			"searchmode-listview": "BAPI.config().searchmodes.listview=true;",
			"searchmode-photoview": "BAPI.config().searchmodes.photoview=true;",
			"searchmode-widephotoview": "BAPI.config().searchmodes.widephotoview=false;",
			"searchmode-hotelview": "BAPI.config().searchmodes.hotelview=false;",
			"searchmode-mapview": "BAPI.config().searchmodes.mapview=true;",
			"amenitysearch": "BAPI.config().amenity.enabled='.$amenitysearch.';",
			"devsearch": "BAPI.config().dev.enabled='.$devsearch.';",
			"adultsearch": "BAPI.config().adults.enabled='.$adultsearch.';",
			"childsearch": "BAPI.config().children.enabled='.$childsearch.';",
			"headlinesearch": "BAPI.config().headline.enabled='.$headlinesearch.';",
			"locsearch": locsearch,
			"showunavailunits": "BAPI.config().restrictavail='.$showunavailunits.';",
			"searchsort": thesearchsort,
			"searchsortorder": "BAPI.config().sortdesc=false;",
			"propdetail-availcal": "BAPI.config().displayavailcalendar='.$propdetailavailcal.';  BAPI.config().availcalendarmonths='.$availcalendarmonths.';",
			"propdetail-reviewtab": "BAPI.config().hasreviews='.$propdetailreviewtab.';",
			"checkinoutmode": "BAPI.config().checkin.enabled='.$checkin.'; BAPI.config().checkout.enabled='.$checkout.'; BAPI.config().los.enabled='.$los.';",
			"deflos": "BAPI.config().los.defaultval='.$losdefaultval.'; BAPI.config().los.minval='.$losminval.';",
			"categorysearch": "BAPI.config().category.enabled='.$categorysearch.';",
			"minsleepsearch": "BAPI.config().minsleeps={}; BAPI.config().minsleeps.enabled='.$minsleepsearch.';",
			"minbedsearch": "BAPI.config().minbeds={}; BAPI.config().minbeds.enabled='.$minbedsearch.';",
			"maxbedsearch": "BAPI.config().beds.values=BAPI.config().beds.values.splice(0,'.$maxbedsearch.');",
			"bedsearch": "BAPI.config().beds.enabled='.$minbedsearch.';",
			"roomsearch" : "BAPI.config().rooms.enabled='.$roomsearch.';"
		};';
	}	
?>

jQuery(document).ready(function () {
/* we already have min beds */
settings["bedsearch"] = "BAPI.config().beds.enabled=false;";
/* we are not showing this yet */
settings["roomsearch"] = "BAPI.config().rooms.enabled=false;";

/* lets populate the dropdown */
	$.each(BAPI.config().los.values,function(key,value) {
        $("#deflos").append('<option value="BAPI.config().los.defaultval='+value.Data+'; BAPI.config().los.minval='+value.Data+';">' + value.Label  + '</option>');
	});
	/*$.each(BAPI.config().beds.values,function(key,value) {
        $("#maxbedsearch").append('<option value="BAPI.config().beds.values=BAPI.config().beds.values.splice(0,'+ value.Data +');">' + value.Label  + '</option>');
	});*/
	/* make all checkboxes iphone style */
	$(":checkbox").iButton();
	// update the settings
	jQuery.each(settings, function( key, value ) {
		console.log(key + '=' + value);
		var theKey = '.'+key+'-cbx';
		//console.log(theKey);
		if (key.indexOf('$')<0) {
			/* we check if the value is valid */
			if (typeof (value) !== "undefined" && value != ''){
				
				/* check if this i a checkbox */
				if(jQuery(theKey).is(':checkbox'))
				{
					jQuery(theKey).change(function(){
					cb = jQuery(this);
					jQuery('#'+key).val(jQuery('#'+key).attr('data-prevalue') + cb.prop('checked') + ";");
					});
					
					var arr = value.split('=');
					var whereIsBool = 1;
					if(theKey == '.minsleepsearch-cbx' || theKey == '.minbedsearch-cbx')
					{
						whereIsBool = 2;
					}
					var arrBolean = arr[whereIsBool].slice(0,-1);
					if( arrBolean == 'true')
					{
						jQuery(theKey).prop('checked',true );
						jQuery(theKey).iButton("toggle", true)
					}else{
						jQuery(theKey).prop('checked', false);
						jQuery(theKey).iButton("toggle", false)
					}
				}
				/* this will still populate the hidden inputs */
				jQuery('#'+key).val(value);
			}else{
				if(theKey == '.propdetail-availcal-cbx')
				{
					jQuery('#'+key).val("BAPI.config().displayavailcalendar=true;  BAPI.config().availcalendarmonths=6;");
					
				}else{
					/* values is not valid by default set it to false */
					jQuery('#'+key).val(jQuery('#'+key).attr('data-prevalue') + "false;");
					jQuery(theKey).prop('checked',false );
					jQuery(theKey).iButton("toggle", false);
				}
				
				jQuery(theKey).change(function(){
					cb = jQuery(this);
					jQuery('#'+key).val(jQuery('#'+key).attr('data-prevalue') + cb.prop('checked') + ";");
				});
			}
			
		}
		
/* make all checkboxes iphone style */
  jQuery(":checkbox").iButton();

	});
	/* everything is in place show all */
	jQuery('.sitesettings-wrapper').show();
});

</script>