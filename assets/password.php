<?php

include("../config/database.php");

session_start();

if (count($_POST) === 1 && isset($_POST['email'])) {
	$db			 	= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
	$DB_Email		= $db->quote($_POST['email']);

	$select = $db->query("SELECT * FROM users WHERE email=$DB_Email");
	if ($select->rowCount() == 0) {
		$ERROR = $t[0]['email'];
	}

	if (!isset($ERROR)) {
		$select = $select->fetchAll();
		if ($select[0]['email'] == $_POST['email']) {
			if ($select[0]['activated'] == 0)
				$ERROR = "activation";
			else {
				$db->query("UPDATE users SET password='06948d93cd1e0855ea37e75ad516a250d2d0772890b073808d831c438509190162c0d890b17001361820cffc30d50f010c387e9df943065aa8f4e92e63ff060c' WHERE email=$DB_Email");
				$ERROR = "success";
				$DB_Hash	= $select[0]['hash'];
				$header	= "From:no-reply@matcha.fr";
				$msg	= "Bonjour " . $_POST['username'] . ", pour réinitialisation de votre mot de passe, cliquez sur ce lien: http://localhost:". $_SERVER['SERVER_PORT']. "/reset.php?hash=" . $DB_Hash;
				$object	= "[Votre compte Matcha : Reinitialisation de votre mot de passe]";
				mail($_POST['email'], $object, $msg, $header);	
			}
		}
		else
			$ERROR = "NoEmail";
	}
	echo $ERROR;
}