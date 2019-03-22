<?php

include("../config/database.php");
session_start();

if (count($_POST) === 4 && isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['age'])) {
	$db				= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
	$DB_Username	= $db->quote($_POST['username']);
	$DB_Password	= $db->quote(hash('whirlpool', $_POST['password']));
	$DB_Email		= $db->quote($_POST['email']);
	$DB_Age			= $_POST['age'];
	$select = $db->query("SELECT * FROM users WHERE username=$DB_Username");
	if ($select->rowCount() != 0)
		$ERROR = "username";
	$select = $db->query("SELECT * FROM users WHERE email=$DB_Email");
	if ($select->rowCount() != 0)
		$ERROR = "email";
	if (!isset($ERROR)) {
		$vHash = hash('whirlpool', $_POST['username'] . rand(0, 1000));
		$db->query("INSERT INTO users set username=$DB_Username, password=$DB_Password, email=$DB_Email, age=$DB_Age, hash='$vHash'");
		$ERROR	= "success";
		$header	= "From:no-reply@matcha.fr";
		$msg	= "Bonjour " . $_POST['username'] . ", pour finaliser votre inscription, cliquez sur ce lien: http://localhost:". $_SERVER['SERVER_PORT']. "/verify.php?hash=" . $vHash;
		$object	= "[Votre compte Matcha]";
		mail($_POST['email'], $object, $msg, $header);

	}
	echo $ERROR;
	
}