<?php

include("config/database.php");

if (count($_POST) === 2 && isset($_POST['password'], $_POST['password_valid'])) {
		//$db				= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
		//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$db->query("USE matcha;");
		//$DB_Hash	= $db->quote($_GET['hash']);

		//$select = $db->query("SELECT * FROM `users` WHERE hash=$DB_Hash");
		//if ($select->rowCount() != 0) {
		//	$select = $select->fetchAll();
			//if ($select[0]['activated'] == 0) {
			//	$db->query("UPDATE users SET activated=1 WHERE hash=$DB_Hash");
			//	@mkdir("../userphoto/" . $username);
		//		$error = "LOLLLLL";
			//}
			//else
			//	$error = "Your account has already been verified";
		//}
		//else
		//	$error = "This account does not exist";
    }

?>