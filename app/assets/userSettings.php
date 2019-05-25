<?php

include("../config/database.php");

function grabData($username, $data ,$db) {
	$DB_USERNAME	= $db->quote($username);
	
	$myfile = fopen("./newfile.txt", "w") or die("Unable to open file!");
	$txt = $DB_USERNAME;
	fwrite($myfile, $txt);
	fclose($myfile);
	

	$select			= $db->query("SELECT * FROM users WHERE username=$DB_USERNAME");
	$select			= $select->fetchAll();
	//echo($select[0][$data]);

	if ($data != "localisation") {
		echo($select[0][$data]);
	}
	else {
		echo('"' . $select[0][$data] . '"');
	}
}

/******* DB *******/
	$db		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
/******* -- *******/


?>