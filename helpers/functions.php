<?php

	function __($key) {
		return (isset($GLOBALS['locale'][$key])) ? $GLOBALS['locale'][$key] : $key;
	}

	function get_timezone_offset($remote_tz, $origin_tz = null) {
	    if($origin_tz === null) {
	        if(!is_string($origin_tz = date_default_timezone_get())) {
	            return false; // A UTC timestamp was returned -- bail out!
	        }
	    }
	    $origin_dtz = new DateTimeZone($origin_tz);
	    $remote_dtz = new DateTimeZone($remote_tz);
	    $origin_dt = new DateTime("now", $origin_dtz);
	    $remote_dt = new DateTime("now", $remote_dtz);
	    $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
	    return $offset;
	}
