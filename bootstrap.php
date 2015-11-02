<?php

	require_once 'helpers/functions.php';

	$ipinfo = file_get_contents('http://ipinfo.io');

	$lat = null;
	$long = null;

	if ($ipinfo) {
		$ipinfo = json_decode($ipinfo);

		$lat = explode(',', $ipinfo->loc)[0];
		$long = explode(',', $ipinfo->loc)[1];
	}
