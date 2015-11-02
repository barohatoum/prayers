<?php

	function __($key) {
		return (isset($GLOBALS['locale'][$key])) ? $GLOBALS['locale'][$key] : $key;
	}
