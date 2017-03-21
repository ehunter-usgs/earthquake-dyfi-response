<?php

  // Geocode using ESRI ArcGIS
  // Use authentication keys from $ini
 
  function geocode($client_id,$client_secret) {
	$tokenResult = json_decode(file_get_contents(
		'https://www.arcgis.com/sharing/rest/oauth2/token/' .
		'?grant_type=client_credentials&expiration=15' .
		'&client_id=' . $client_id .
		'&client_secret=' . $client_secret
		), true);
	$token = $tokenResult['access_token'];
	$geocodeResult = json_decode(file_get_contents(
		'https://geocode.arcgis.com/arcgis/rest/services/World/' .
		'GeocodeServer/find?f=json&forStorage=true' .
		'&token=' . $token .
		'&text=' . urlencode($mapAddress)
	), true);

	$geocodeLocation = $geocodeResult['locations'][0];
	if ($geocodeLocation) {
		$geocodeLat = $geocodeLocation['feature']['geometry']['y'];
		$geocodeLon = $geocodeLocation['feature']['geometry']['x'];
		$_POST['ciim_mapLat'] = $geocodeLat;
		$_POST['ciim_mapLon'] = $geocodeLon;
	}
}
 
