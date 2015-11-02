<?php

	require_once '../../bootstrap.php';

	header('Content-type: application/json');

	$action = (isset($_GET['action'])) ? filter_var($_GET['action'], FILTER_SANITIZE_STRING) : null;

	if (is_null($action)) {
		http_response_code(405);
		echo json_encode(['success' => false, 'error' => 'Invalid action. Please try again later']);
		exit();
	}

	$api_lat			= (isset($_GET['lat'])) ? filter_var($_GET['lat'], FILTER_SANITIZE_NUMBER_FLOAT) : $lat;
	$api_long			= (isset($_GET['long'])) ? filter_var($_GET['long'], FILTER_SANITIZE_NUMBER_FLOAT) : $long;
	$timezone_offset	= (isset($_GET['gmt'])) ? filter_var($_GET['gmt'], FILTER_SANITIZE_NUMBER_FLOAT) : -300;
	$day				= (isset($_GET['d'])) ? filter_var($_GET['d'], FILTER_SANITIZE_NUMBER_FLOAT) : date('d');
	$month				= (isset($_GET['m'])) ? filter_var($_GET['m'], FILTER_SANITIZE_NUMBER_FLOAT) : date('m');
	$year				= (isset($_GET['Y'])) ? filter_var($_GET['Y'], FILTER_SANITIZE_NUMBER_FLOAT) : date('Y');
	$school 			= (isset($_GET['school'])) ? filter_var($_GET['school'], FILTER_SANITIZE_NUMBER_FLOAT) : 0;

	$prayer_times = json_decode(file_get_contents("http://praytime.info/getprayertimes.php?lat=$lat&lon=$long&gmt=$timezone_offset&d=$day&m=$month&y=$year&school=$school"));

	if ($prayer_times) {
		echo json_encode(['success' => true, 'data' => $prayer_times]);
	} else {
		echo json_encode(['success' => false, 'error' => 'Unable to get prayer times at the moment. Please try again later']);
	}

