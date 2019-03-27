<?php

session_start();

include("assets/userSettings.php");
include("assets/builders.php");

if (!isset($_SESSION["logged"])) {
	header('Location: ../');
}

if ($_COOKIE["lang"] == "French") {
	require "../langs/french.php";
} else {
	require "../langs/english.php";
}

require "../assets/langs.php";

function getDistance($addressFrom, $addressTo, $unit = ''){
    // Google API key
    $apiKey = 'AIzaSyDPCLFXc1koLt0x0gaF4AytsICwnuXbJ2M';
    
    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);
    
    // Geocoding API request with start address
    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $outputFrom = json_decode($geocodeFrom);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    // Geocoding API request with end address
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
    $outputTo = json_decode($geocodeTo);
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }
    
    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
    
    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;
    
    // Convert unit and return distance
    $unit = strtoupper($unit);
    if($unit == "K"){
        return round($miles * 1.609344, 2).' km';
    }elseif($unit == "M"){
        return round($miles * 1609.344, 2).' meters';
    }else{
        return round($miles, 2).' miles';
    }
}



$addressFrom = '77 rue de Rome 75017 Paris';
$addressTo   = 'VILLA JACOB Fondation Casip-cojasor, 32 Avenue Général Estienne, 06000 Nice';

// Get distance in km
$distance = getDistance($addressFrom, $addressTo, "K");
echo $distance;


?>

<!DOCTYPE HTML>
<html>
<head>
	<title><?php lang($meta["title"]); ?></title>
	<link rel="stylesheet" href="css/index.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
	<div class="side-menu">
		<div class="head">
			<?php
				buildPP($dbBuild);
			?>
			<!-- <div id="nav-pp" class="pp"></div> -->
			<span id="nav-username"><?php echo($_SESSION["logged"]); ?></span>

		</div>
		<div class="nav">
			<ul>
				<li id="nav-matchs" class="active">Matchs<hr class="active"></li>
				<li id="nav-messages">Messages<hr></li>
				<li id="nav-suggestions">Suggestions<hr></li>
				<li id="nav-notifications">Notifications<hr></li>
			</ul>
		</div>

		<!-- SETTINGS -->
		<div id="info-pp" class=" side-info sp-hidden">
			<span class="settings-label">Edit profile:</span>
			<div class="settings-box">
				<span class="settings-label">Username</span>
				<input id="settingsUsername" name="username" type="text" required placeholder=<?php echo($_SESSION["logged"]); ?>>
			</div>

			<div class="settings-box">
				<span class="settings-label">Password</span>
				<input id="settingsPassword" name="password" type="password" required placeholder="********">
			</div>

			<div class="settings-box">
				<span class="settings-label">Email</span>
				<input id="settingsEmail" name="email" type="text" required placeholder=<?php grabData($_SESSION["logged"], "email", $db) ?>>
			</div>

			<div class="settings-box">
				<span class="settings-label">First Name</span>
				<input id="settingsName" name="name" type="text" required placeholder=<?php grabData($_SESSION["logged"], "name", $db) ?>>
			</div>

			<div class="settings-box">
				<span class="settings-label">Last Name</span>
				<input id="settingsSurname" name="surname" type="text" required placeholder=<?php grabData($_SESSION["logged"], "surname", $db) ?>>
			</div>

			<div class="settings-box">
				<span class="settings-label">Age</span>
				<input id="settingsAge" name="age" type="number" required placeholder=<?php grabData($_SESSION["logged"], "age", $db) ?>>
			</div>

			<div class="settings-box">
				<span class="settings-label">Gender</span>
				<select id="settingsGender">
					<option value="man">Man</option>
					<option value="woman">Woman</option>
					<option value="other">Other</option>
				</select>
			</div>

			<div class="settings-box">
				<span class="settings-label">Attracted by</span>
				<select id="settingsAttracted">
					<option value="men">Men</option>
					<option value="women">Women</option>
					<option value="both">Both</option>
				</select>
			</div>

			<div class="settings-box">
			<span class="settings-label">Bio</span>
			<textarea id="settingsBio"><?php grabData($_SESSION["logged"], "bio", $db)?></textarea>
			</div>

			<div class="settings-box">
				<span class="settings-label" style="top:20px !important">Localisation</span>
				<input id="settingsLocalisation" name="localistation" type="text" required placeholder=<?php grabData($_SESSION["logged"], "localisation", $db) ?>>
    		</div>
			<button class="settings-update-button">Update Informations</button>

		</div>
		<!-- END SETTINGS -->

		<!-- MATCHS -->
		<div id="info-matchs" class="side-info matchs">
			<span>No Matchs</span>
		</div>
		<!-- END MATCHS -->

		<!-- MESSAGES  -->
		<div  id="info-messages" class=" side-info sp-hidden">
				<?php
					buildMessages($dbBuild);
				?>
		</div>
		<!-- END MESSAGES -->

		<!-- SUGGESTIONS -->
		<div  id="info-suggestions" class=" side-info sp-hidden">
			<span>No Suggestions</span>
		</div>
		<!-- END SUGGESTIONS -->

		<!-- NOTIFICATIONS -->
		<div  id="info-notifications" class=" side-info sp-hidden">
			<?php
				buildNotification($dbBuild);
			?>
		</div>
		<!-- END NOTIFICATIONS -->
		<input class="button_logout" type="button" onclick="location.href='http://localhost:8080/assets/logout.php';" value="LogOut" />
	</div>

	<!-- GAME -->
	<div class="game app-screen-active">
		<?php
			buildMatchs($dbBuild);
		?>
		<div class="controls">
			<div id="btn-dislike" class="btn-dislike"></div>
			<div id="btn-like" class="btn-like"></div>
		</div>
	</div>
	<!-- END GAME -->

	<!-- MESSAGES -->
	<div class="messages">
		<div id="messages_view" class="view">
			<div class="msg-input">
				<input id="msg-text-input" class="msg-text-input" placeholder="Type a message...">
				<button onclick="sendMessage()" class="msg-text-send">Send</button>
			</div>
		</div>
	</div>
	<!-- END MESSAGES -->

	<div class="settings">
		<?php
			buildSettingsCard($dbBuild);
		?>
		<div id="game-card-settings" class="view">
			<span class="name"><?php echo($_SESSION["logged"]); ?>, <?php grabData($_SESSION["logged"], "age", $db) ?></span>
		</div>		
		<input type="file" name="file" id="ppfile">
	</div>

	<script type="text/javascript" src="scripts/animations.js"></script>
	<script type="text/javascript" src="scripts/navigation.js"></script>
	<script type="text/javascript" src="scripts/messages.js"></script>
	<script type="text/javascript" src="scripts/settings.js"></script>
	<script type="text/javascript" src="scripts/uploader.js"></script>

<script>

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 48.896833, lng: 2.318512},
          zoom: 18,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPCLFXc1koLt0x0gaF4AytsICwnuXbJ2M&libraries=places&callback=initAutocomplete"
         async defer></script>

</body>
</html>