<?php

session_start();

include("../../config/database.php");

function getUsername($id, $db) {
	$select	= $db->query("SELECT * FROM users WHERE iduser=$id");
	$select	= $select->fetchAll();
	return ($select[0]['username']);
}

function getMessages($file, $db) {
	$content = fopen("../messages/" . $file, "r");
	if ($content) {
		$sender		= array("sender");
		$message	= array("message");
		// $picture	= array("path");
		while (($line = fgets($content)) !== false) {
			$id		= explode(' ', trim($line));
			$id		= substr($id[0], 0, -1);
			$msg	= explode(' ', trim($line));
			array_splice($msg, 0, 1);
			array_push($message, implode(' ', $msg));
			array_push($sender, getUsername($id, $db));
		}
	}
	array_splice($sender, 0, 1);
	array_splice($message, 0, 1);
	$msgInfos = array($sender, $message);
	// array_splice($path, 0, 1);
	echo(json_encode($msgInfos));
}

function getMessageFile($user, $partner, $db) {
	$user		= $db->quote($user);
	$select 	= $db->query("SELECT * FROM users WHERE username=$user");
	$select 	= $select->fetchAll();
	$user		= $select[0]["iduser"];

	$file1		= $user . "-" . $partner;
	$file2		= $partner . "-" . $user;

	if (file_exists("../messages/" . $file1)) {
		getMessages($file1, $db);
	}

	else if (file_exists("../messages/" . $file2)) {
		getMessages($file2, $db);
	}
}

function sendMessage($user, $content, $db) {
	$user		= $db->quote($user);
	$select 	= $db->query("SELECT * FROM users WHERE username=$user");
	$select 	= $select->fetchAll();
	$user		= $select[0]["iduser"];

	$conversation = "../messages/1-2";
	$f = fopen($conversation, "a");
	$data = "\n" . $user . ": " . $content;
	fwrite($f, $data);
}

/******* DB *******/
	$db		= new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE matcha;");
/******* -- *******/

$action = $_POST["action"];

// if ($action == "update") {
	getMessageFile($_SESSION['logged'], $_POST["partner"], $db);
// }

if ($action == "send") {
	sendMessage($_SESSION['logged'], $_POST["content"], $db);
}

?>