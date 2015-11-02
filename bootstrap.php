<?php
	require_once 'helpers/functions.php';

	$ipinfo = json_decode(file_get_contents('http://ipinfo.io'));

	$lat = null;
	$long = null;

	if ($ipinfo) {
		$lat = explode(',', $ipinfo->loc)[0];
		$long = explode(',', $ipinfo->loc)[1];
	}
