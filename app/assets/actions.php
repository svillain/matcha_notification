<?php

include("../../config/database.php");

session_start();

function like($db, $user, $target) {
	$user	= $db->quote($user);
	$target	= $db->quote($target);

	// Get user ID
	$userID	= $db->query("SELECT * FROM users WHERE username = $user");
	$userID = $userID->fetchAll();
	$userID = $userID[0]["iduser"];

	// Get target ID
	$targetID	= $db->query("SELECT * FROM users WHERE username = $target");
	$targetID	= $targetID->fetchAll();
	$targetID	= $targetID[0]["iduser"];

	// Check if target already liked user
	$checkQuery	= $db->query("SELECT * FROM matchs WHERE id_user1 = $targetID AND id_user2 = $userID");
	if ($checkQuery->rowCount() != 0) {
		echo ("You have a match with $target !");
	}
	// If not, like user
	else {
		$query		= $db->query("INSERT INTO matchs SET id_user1 = $userID, id_user2 = $targetID");
		$contain 	= $db->quote("liked you");
		$query 		= $db->query("INSERT INTO notification SET from_user_id = $userID, to_user_id = $targetID, notification_content = $contain");
	}
	echo "$user liked $target";
}

function dislike() {
	// Do nothing, just pass
}

function view() {

}

function message () {

}

/******* DB *******/
$db		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query("USE matcha;");
/******* -- *******/

$action = $_POST["action"];
$user	= $_SESSION["logged"];

if ($action == "like") {
	like($db, $user, $_POST["target"]);
}

?>