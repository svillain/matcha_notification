<?php

function lang($var) {
	echo $var;
}

function updateLanguage($lang) {
	setcookie("lang", $lang, time() + (86400 * 365), "/");
	header("Location: ../");
}

$lang = $_GET['lang'];
if (isset($lang)) {
	updateLanguage($lang);
}

?>