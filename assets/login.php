<?php

include("../config/database.php");

session_start();

if (count($_POST) === 2 && isset($_POST['username'], $_POST['password'])) {
	$db			 = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
	$DB_Username	= $db->quote($_POST['username']);
	$DB_Password	= $db->quote(hash('whirlpool', $_POST['password']));

	$select = $db->query("SELECT * FROM users WHERE username=$DB_Username");
	if ($select->rowCount() == 0) {
		$ERROR = $t[0]['username'];
	}

	if (!isset($ERROR)) {
		$select = $select->fetchAll();
		if ($select[0]['username'] == $_POST['username'] && $select[0]['password'] == hash('whirlpool', $_POST['password'])) {
			if ($select[0]['activated'] == 0)
				$ERROR = "activation";
			else {
				$_SESSION['logged'] = $_POST['username'];
				$_SESSION['userID'] = $select[0]['iduser'];
				$ERROR = "success";
			}
		}
		else
			$ERROR = "password";
	}
	echo $ERROR;
}