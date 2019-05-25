<?php

include("../config/database.php");
session_start();

/******* DB *******/
$dbBuild		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
$dbBuild->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbBuild->query("USE matcha;");
/******* -- *******/

function buildMessages($db) {
	$username	= $db->quote($_SESSION["logged"]);
	$select		= $db->query("SELECT * FROM users WHERE username=$username");
	$select 	= $select->fetchAll();
	$user		= $select[0]["iduser"];

	$select		= $db->query("SELECT * FROM users WHERE activated=1");
	$select		= $select->fetchAll();

	$ret		= 0;

	foreach ($select as $key => $value) {
		$file1 = $user . "-" . $value["iduser"];
		$file2 = $value["iduser"] . "-" . $user;
		if (file_exists("messages/" . $file1)) {
			$html .= '<div class="conversation-box">';
			$html .= '<div class="photo">No Photo</div>';
			$html .= '<span class="name">' . $value["username"] . '</span>';
			$html .= '<span class="lastMessage">coucou ca va ?</span>';
			$html .= '</div>';
			$ret = 1;
		}
		else if (file_exists("messages/" . $file2)) {
			$html .= '<div class="conversation-box">';
			$html .= '<div class="photo">No Photo</div>';
			$html .= '<span class="name">' . $value["username"] . '</span>';
			$html .= '<span class="lastMessage">coucou ca va ?</span>';
			$html .= '</div>';
			$ret = 1;
		}
	}
	if ($ret == 1) {
		echo $html;
	}
	else {
		echo "<span>No Messages</span>";
	}
	return $ret;
}

function buildPP($db) {
	$username	= $db->quote($_SESSION["logged"]);
	$select		= $db->query("SELECT * FROM users WHERE username = $username AND path_photo1 IS NOT NULL");

	if ($select->rowCount != 0) {
		$html = '<div id="nav-pp" class="pp" style="background-image: url(../img/hanou.jpg)"></div>';
	}
	else {
		$html = '<div id="nav-pp" class="pp" style="background-image: url(../img/no-pp.png)"></div>';
	}
	echo $html;
}

function buildSettingsCard($db) {
	$username	= $db->quote($_SESSION["logged"]);
	$select		= $db->query("SELECT * FROM users WHERE username = $username AND path_photo1 IS NOT NULL");

	if ($select->rowCount != 0) {
		$html = '<div id="game-card" class="view" style="background-image: url(../img/hanou.jpg)">';
	}
	else {
		$html = '<div id="game-card" class="view" style="background-image: url(../img/no-pp.png)">';
	}

	echo $html;
}


function buildMatchs($db) {
	$USER_DB	= $db->quote($_SESSION["logged"]);
	$select		= $db->query("SELECT * FROM users");
	$user		= $db->query("SELECT * FROM users WHERE username = $USER_DB");
	$user		= $user->fetchAll();
	$userid		= $user[0]["iduser"];
	$first		= 0;


	foreach ($select as $key => $value) {
		if ($value["iduser"] != $userid) {
			$filter = True;
			if ($value["attraction"] == $user["attraction"]) {
				$filter = False;
			}

			if ($value["attraction"] == "Both" && $user["attraction"] == "Both") {
				$filter = True;
			}

			if ($filter) {
				if ($first == 0) {
					echo '<div id="game-card" class="view" style="background-image: url(' . $value["path_photo1"] . ')">' .
					'<span class="name">' . $value["username"] . ', '. $value["age"] . '</span>
					</div>';

					echo '<div class="signup-modal" id="signup-modal">
					<h1>Profil de '. $value["username"] . '</h1>
					</br>
					<div class="group">
					<label id="signUsernameLabel">Nom : '. $value["name"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Prenom : '. $value["surname"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Age : '. $value["age"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Localisation : '. $value["localisation"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Gender : '. $value["username"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Attraction : '. $value["username"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Bio : '. $value["username"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Interest : '. $value["username"] . '</label>
					</div>
					</br>
					<button id="fake_account" type="button" class="button">Signaler comme faux compte</button>
					</br></br>
					<button id="blocked" type="button" class="button">Bloquer ce compte</button>	
					</div>';

					$first = 1;
				}
				else {
					echo '<div id="game-card" class="view" style="display: none; background-image: url(' . $value["path_photo1"] . ')">' .
					'<span class="name">' . $value["username"] . ', '. $value["age"] . '</span>
					</div>';

					echo '<div class="signup-modal" id="signup-modal">
					<h1>Profil de '. $value["username"] . '</h1>
					</br>
					<div class="group">
					<label id="signUsernameLabel">Nom : '. $value["name"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Prenom : '. $value["surname"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Age : '. $value["age"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Localisation : '. $value["localisation"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Gender : '. $value["username"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Attraction : '. $value["username"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Bio : '. $value["username"] . '</label>
					</div>
					</br>
					<div class="group">
						<label id="signUsernameLabel">Interest : '. $value["username"] . '</label>
					</div>
					</br>
					<button id="fake_account" type="button" class="button">Signaler comme faux compte</button>
					</br></br>
					<button id="blocked" type="button" class="button">Bloquer ce compte</button>	
					</div>';
				}
			}
		}
	}
}

function buildNotification($db) {
	$DB_USERNAME	= $db->quote($_SESSION["logged"]);
	$id				= $db->query("SELECT * FROM users WHERE username=$DB_USERNAME");
	$id 			= $id->fetchAll();
	$id 			= $id[0]["iduser"];
	$select			= $db->query("SELECT * FROM notification WHERE to_user_id=$id AND seen=0");
	$select			= $select->fetchAll();

	foreach ($select as $key => $value) {
		if ($value["to_user_id"] == $id) {
			$From_who = $value["from_user_id"];
			$Username_from			= $db->query("SELECT * FROM users WHERE iduser=$From_who");
			$Username_from 			= $Username_from->fetchAll();
			$Username_from 			= $Username_from[0]["username"];
			echo '<div id="new_notification" class="my_notification" style="color: blue !important">' . '<span>' . $Username_from . ' '. $value["notification_content"] . '</span></div>';
		}
		else {
			echo '<span>No Notifications</span>';
		}
	}
}

?>