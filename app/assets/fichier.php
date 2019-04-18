<?php

include("../config/database.php");
session_start();

/******* DB *******/
$dbBuild		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
$dbBuild->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbBuild->query("USE matcha;");
/******* -- *******/

if (count($_POST) === 1 && isset($_POST['target'])) {
	echo $_POST['target'];
	$db			 	= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
	$DB_Username	= $db->quote($_POST['target']);
	echo $DB_Username;
	/*
	$select = $db->query("SELECT * FROM users WHERE email=$DB_Email");
	if ($select->rowCount() == 0) {
		$ERROR = $select[0]['email'];
	}*/

	if (!isset($ERROR)) {
		echo $ERROR;
	}
	echo $ERROR;
}