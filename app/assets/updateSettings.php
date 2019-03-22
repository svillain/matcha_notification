<?php

include("../../config/database.php");

session_start();

function updateSettings($username, $password, $email, $name, $surname, $gender, $attraction, $bio, $age, $local, $db) {
	if ($password == "********") {
		$pwd = -1;
	}
	else {
		$password = hash("whirlpool", $password);
	}

	$username	= $db->quote($username);
	$password	= $db->quote($password);
	$email		= $db->quote($email);
	$name		= $db->quote($name);
	$surname	= $db->quote($surname);
	$gender		= $db->quote($gender);
	$attraction	= $db->quote($attraction);
	$bio		= $db->quote($bio);
	$user		= $db->quote($_SESSION["logged"]);
	$age		= $db->quote($age);
	$local		= $db->quote($local);

	$db->query("UPDATE users
		SET username = $username, email = $email, name = $name, surname = $surname, gender = $gender, attraction = $attraction, bio = $bio, age = $age, localisation = $local
		WHERE username = $user");

	if ($pwd != -1) {
		$db->query("UPDATE users SET password = $password WHERE username = $user");
	}
}

/******* DB *******/
$db		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query("USE matcha;");
/******* -- *******/

$username	= $_POST["username"];
$password	= $_POST["password"];
$email 		= $_POST["email"];
$name		= $_POST["name"];
$surname	= $_POST["surname"];
$gender		= $_POST["gender"];
$attraction	= $_POST["attraction"];
$bio		= $_POST["bio"];
$age		= $_POST["age"];
$local		= $_POST["local"];

if ($_POST["ctx"] == "update") {
	updateSettings(
		$username,
		$password,
		$email,
		$name, 
		$surname,
		$gender,
		$attraction,
		$bio,
		$age,
		$local,
		$db);
}

?>