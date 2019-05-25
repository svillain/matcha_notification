<?php

include("../../config/database.php");
session_start();

if (count($_POST) === 1 && isset($_POST['target'])) {
	$db			 	= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
	$DB_Username	= $db->quote($_POST['target']);

	$select = $db->query("SELECT * FROM users WHERE username=$DB_Username");
	if ($select->rowCount() == 0) {
		$ERROR = $t[0]['username'];
		//$myfile = fopen("./newfile.txt", "w") or die("Unable to open file!");
		//$txt = "graou";
		//fwrite($myfile, $txt);
	}

	if (!isset($ERROR)) {
		$select = $select->fetchAll();
		$print_username = $select[0]['username'];

		//$myfile = fopen("./newfile.txt", "w") or die("Unable to open file!");
		//$txt = trim(json_encode($select), '[]');
		//fwrite($myfile, $txt);
		$select_json = trim(json_encode($select), '[]');
		//$myfile = fopen("./newfile.txt", "w") or die("Unable to open file!");
		//$txt = $select_json;
		//fwrite($myfile, $txt);
		//fclose($myfile); trim(json_encode($select), '[]')
	}
	//fclose($myfile);
}