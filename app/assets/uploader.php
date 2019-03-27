<?php

include("../../config/database.php");
session_start();

/******* DB *******/
$db		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query("USE matcha;");
/******* -- *******/

if ($_FILES["file"]["name"] != '') {
	$file	= explode(".", $_FILES["file"]["name"]);
	$ext	= end($file);
	$name	= rand(100, 900) . "." . $ext;
	$loc	= "../../tmp/uploads/" . $name;
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $loc)) {
		$DB_PATH = $db->quote($name);
		$DB_USER = $db->quote($_SESSION["logged"]);
		$select = $db->query("UPDATE users
			SET path_photo1 = $DB_PATH
			WHERE username = $DB_USER");
		echo ("../tmp/uploads/" . $name);
	}
}

?>
