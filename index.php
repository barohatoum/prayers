<?php require_once 'bootstrap.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<title>Chi'a Prayer Times</title>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900">
	<link rel="stylesheet" type="text/css" href="assets/css/app.css">

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="assets/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="assets/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="assets/favicons/favicon-194x194.png" sizes="194x194">
	<link rel="icon" type="image/png" href="assets/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="assets/favicons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="assets/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="assets/favicons/manifest.json">
	<link rel="mask-icon" href="assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="assets/favicons/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="Prayer Times">
	<meta name="application-name" content="Prayer Times">
	<meta name="msapplication-TileColor" content="#fbbf00">
	<meta name="msapplication-TileImage" content="assets/favicons/mstile-144x144.png">
	<meta name="msapplication-config" content="assets/favicons/browserconfig.xml">
	<meta name="theme-color" content="#fbbf00">
</head>
<body>

	<header class="pt-header">
		<a href="#" class="uk-navbar-toggle pt-nav-toggle" data-uk-offcanvas="{ target: '#pt-navigation' }"></a>
		<div class="uk-navbar-flip">
			<div class="uk-navbar-content">
				<label class="pt-next-prayer-time"><?= __('Next prayer:'); ?><span id="pt-next-prayer-time-countdown">00:00:00</span></label>
			</div>
		</div>
		<div class="uk-navbar-content uk-navbar-center">
			<img src="assets/images/prayer-times-logo-round.jpg" class="pt-logo" />
		</div>
	</header>

	<main class="uk-container uk-container-center pt-main">
		<h1 class="page-title">Islamic prayer times</h1>
		<section class="prayer-times">
			<div>
				<h2 class="pt-label">Imsaak</h2>
				<label id="imsaak-time" class="pt-time"></label>
				<label id="imsaak-ago" class="pt-time-ago"></label>
			</div>
			<div>
				<h2 class="pt-label">Farj</h2>
				<label id="fajr-time" class="pt-time"></label>
				<label id="fajr-ago" class="pt-time-ago"></label>
			</div>
			<div>
				<h2 class="pt-label">Sunrise</h2>
				<label id="sunrise-time" class="pt-time"></label>
				<label id="sunrise-ago" class="pt-time-ago"></label>
			</div>
			<div>
				<h2 class="pt-label">Dhuhr</h2>
				<label id="dhuhr-time" class="pt-time"></label>
				<label id="dhuhr-ago" class="pt-time-ago"></label>
			</div>
			<div>
				<h2 class="pt-label">Asr</h2>
				<label id="asr-time" class="pt-time"></label>
				<label id="asr-ago" class="pt-time-ago"></label>
			</div>
			<div>
				<h2 class="pt-label">Sunset</h2>
				<label id="sunset-time" class="pt-time"></label>
				<label id="sunset-ago" class="pt-time-ago"></label>
			</div>
			<div>
				<h2 class="pt-label">Maghrib</h2>
				<label id="maghrib-time" class="pt-time"></label>
				<label id="maghrib-ago" class="pt-time-ago"></label>
			</div>
			<div>
				<h2 class="pt-label">Isha</h2>
				<label id="isha-time" class="pt-time"></label>
				<label id="isha-ago" class="pt-time-ago"></label>
			</div>
		</section>
	</main>


	<nav id="pt-navigation" class="uk-offcanvas pt-navigation">
		<div class="uk-offcanvas-bar">
			<div class="uk-panel">
				Created by Ibrahim Hatoum.
				Thanks to praytime.info for the API
			</div>
		</div>
	</nav>

	<section class="app-loading-screen">
		<div class="app-loading-text">
			<?= __('Loading...'); ?>
		</div>
	</section>

	<script type="text/javascript" src="assets/js/vendor/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/uikit.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/jquery.countdown.min.js"></script>
	<script type="text/javascript">

		$(function() {
			'use strict';

			var POSITION = function() {
				this.lat = 0;
				this.long = 0;
			};

			var position = new POSITION();

			if (navigator.geolocation) {
				navigator.geolocation.watchPosition(onSuccess, onError);
			} else {
				position.lat = <?= $lat; ?>;
				position.long = <?= $long; ?>;

				getPrayerTimes(position);
			}

			$(document).ajaxStop(function() {
				$('.app-loading-screen').fadeOut();
			});

			function onSuccess(geoposition) {
				position.lat = geoposition.coords.latitude;
				position.long = geoposition.coords.longitude;

				getPrayerTimes(position);
			}

			function onError(error) {
				switch(error.code) {
					case error.PERMISSION_DENIED:
						alert("User denied the request for Geolocation.");
						break;
			        case error.POSITION_UNAVAILABLE:
			            alert("Location information is unavailable.");
			            break;
			        case error.TIMEOUT:
			            alert("The request to get user location timed out.");
			            break;
			        case error.UNKNOWN_ERROR:
			            alert("An unknown error occurred.");
			            break;
			    }
			}

			function getPrayerTimes(position) {
				var day				= moment().date();
				var month			= moment().month() + 1;
				var year			= moment().year();
				var timezone_offset	= moment().utcOffset();
				var school			= 0; // Leva Research Institute, Qom, Iran

				var options = {
					action 	: 'get-prayer-times',
					lat		: position.lat,
					lon		: position.long,
					gmt		: timezone_offset,
					d		: day,
					m		: month,
					y		: year,
					school	: school
				};

				$.getJSON('api/v1/', options).done(function(response) {
					if (response.success) {
						var times = response.data;

						$('#imsaak-time').html(times.Imsaak);
						$('#fajr-time').html(times.Fajr);
						$('#sunrise-time').html(times.Sunrise);
						$('#dhuhr-time').html(times.Dhuhr);
						$('#asr-time').html(times.Asr);
						$('#sunset-time').html(times.Sunset);
						$('#maghrib-time').html(times.Maghrib);
						$('#isha-time').html(times.Isha);

						$('#imsaak-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Imsaak).fromNow());
						$('#fajr-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Fajr).fromNow());
						$('#sunrise-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Sunrise).fromNow());
						$('#dhuhr-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Dhuhr).fromNow());
						$('#asr-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Asr).fromNow());
						$('#sunset-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Sunset).fromNow());
						$('#maghrib-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Maghrib).fromNow());
						$('#isha-ago').html(moment(year + '-' + month + '-' + day + ' ' + times.Isha).fromNow());

						var next_azan;
						for (var i in times) {
							if (moment(year + '-' + month + '-' + day + ' ' + times[i]).hours() > moment().hours()) {
								next_azan = times[i];
							}
						}

						if (next_azan !== undefined) {
							$('#pt-next-prayer-time-countdown').countdown(year + '-' + month + '-' + day + ' ' + next_azan, function(event) {
								$(this).html(event.strftime('%H:%M:%S'));
							});
						}

					} else {
						alert(response.error);
					}
				});
			}
		});
	</script>
</body>
</html>
