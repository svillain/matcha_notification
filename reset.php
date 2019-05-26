<?php
include ("assets/reset.php");

if (isset($_SESSION["logged"])) {
	header('Location: app/');
}

if ($_COOKIE["lang"] == "French") {
	require "langs/french.php";
} else {
	require "langs/english.php";
}

require "assets/langs.php";

?>

<!DOCTYPE HTML>
<html>
<head>
	<title><?php lang($meta["title"]); ?></title>
	<link rel="stylesheet" href="css/verify.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/navbar.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/modals/login.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/modals/reset.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- NAVBAR -->
	<div id="navbar" class="nav-header">
		<a href="index.php">
			<span class="logo">Matcha</span>
		</a>
	</div>
	<!-- NAVBAR END -->

	<!-- CENTER -->
	<div class="index-container">
		<!--<h2 class="title">< ?php echo $error; ?></h2>
		<a id="logbtn" class="button">< ?php lang($nav["login"]); ?></a>  < ?php lang($modPassword["submit"]); ?>   -->
	</div>
	<!-- CENTER END -->

	<!-- Password -->
	<div class="password-modal" id="password-modal">
		<h1><?php lang($modPassword["title"]); ?></h1>
		<!--<h1 id="password-close" class="close">X<h1>-->
		<h2><?php lang($modPassword["sub"]); ?></h2>
		<form>
			<div class="group">
				<input id="PasswordInput" type="password" required></span>
				<label id="PasswordInputLabel"><?php lang($modLog["label2"]); ?></label>
			</div>
			<div class="group">
				<input id="logPasswordInputValid" type="password" required></span>
				<label id="logPasswordLabelValid"><?php lang($modLog["label2"]); ?></label>
			</div>
		<button id="passwordSubmit" type="button" class="button">Change password</button>
		<span id="PasswordOutput"></span>
		</form>
	</div>
	<!-- Password END -->

	<!-- LOG IN 
	<div class="login-modal" id="login-modal">
		<h1>< ?php lang($modLog["title"]); ?></h1>
		<h1 id="login-close" class="close">X<h1>
		<h2>< ?php lang($modLog["sub"]); ?></h2>
		<form>
			<div class="group">
				<input id="logUsernameInput" type="text" required></span>
				<label id="logUsernameLabel">< ?php lang($modLog["label1"]); ?></label>
			</div>
			<div class="group">
				<input id="logPasswordInput" type="password" required></span>
				<label id="logPasswordLabel">< ?php lang($modLog["label2"]); ?></label>
			</div>
		<button id="logSubmit" type="button" class="button">< ?php lang($modLog["submit"]); ?></button>
		<span id="loginOutput"></span>
		</form>scripts/login.js
	</div>-->
	<!-- LOG IN END -->
</body>
<script type="text/javascript" src="scripts/reset.js"></script>
</html>