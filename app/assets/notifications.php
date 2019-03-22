<?php

include("../../config/database.php");

function getUsername($id, $db) {
	$select	= $db->query("SELECT * FROM users WHERE iduser=$id");
	$select	= $select->fetchAll();
	return ($select[0]['username']);
}

/******* DB *******/
	$db		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
/******* -- *******/

?>