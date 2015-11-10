<?php
	require_once 'vendor/autoload.php';
	require_once 'helpers/functions.php';

	use GeoIp2\Database\Reader;

	$reader = new Reader(__DIR__ . '/resources/db/GeoLite2-City.mmdb');

	$ip = ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') ? '69.70.139.242' : $_SERVER['REMOTE_ADDR'];

	$record = $reader->city($ip);

	$lat = $record->location->latitude;
	$long = $record->location->longitude;
