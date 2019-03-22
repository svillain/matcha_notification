<?php

session_start();

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
	<link rel="stylesheet" href="css/index.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/navbar.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/modals/login.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/modals/signup.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- NAVBAR -->
	<div id="navbar" class="nav-header">
		<a href="index.php">
			<span class="logo">Matcha</span>
		</a>
		<nav>
			<ul>
				<li><a id="logbtn" class="button nav-login"><?php lang($nav["login"]); ?></a></li>
			</ul>
		</nav>
	</div>
	<!-- NAVBAR END -->

	<!-- CENTER -->
	<div class="index-container">
		<h2 class="title"><?php lang($index["title"]); ?></h2>
		<a id="signbtn" class="button"><?php lang($nav["signup"]); ?></a>
	</div>
	<!-- CENTER END -->

	<!-- LOG IN -->
	<div class="login-modal" id="login-modal">
		<h1><?php lang($modLog["title"]); ?></h1>
		<h1 id="login-close" class="close">X<h1>
		<h2><?php lang($modLog["sub"]); ?></h2>
		<form>
			<div class="group">
				<input id="logUsernameInput" type="text" required></span>
				<label id="logUsernameLabel"><?php lang($modLog["label1"]); ?></label>
			</div>
			<div class="group">
				<input id="logPasswordInput" type="password" required></span>
				<label id="logPasswordLabel"><?php lang($modLog["label2"]); ?></label>
			</div>
		<button id="logSubmit" type="button" class="button"><?php lang($modLog["submit"]); ?></button>
		<span id="loginOutput"></span>
		</form>
	</div>
	<!-- LOG IN END -->

	<!-- SIGN UP -->
	<div class="signup-modal" id="signup-modal">
		<h1><?php lang($modSign["title"]); ?></h1>
		<h1 id="signup-close" class="close">X</h1>
		<h2><?php lang($modSign["sub"]); ?></h2>
		<form>
			<div class="group">
				<input id="signUsernameInput" type="text" required></span>
				<label id="signUsernameLabel"><?php lang($modSign["label1"]); ?></label>
			</div>
			<div class="group">
				<input id="signPasswordInput" type="password" required></span>
				<label id="signPasswordLabel"><?php lang($modSign["label2"]); ?></label>
			</div>
			<div class="group">
				<input id="signEmailInput" type="email" required></span>
				<label id="signEmailLabel"><?php lang($modSign["label3"]); ?></label>
			</div>
			<div class="group">
				<input id="signAgeInput" type="number" required></span>
				<label id="signAgeLabel"><?php lang($modSign["label4"]); ?></label>
			</div>
			<button id="signSubmit" type="button" class="button"><?php lang($modSign["submit"]); ?></button>
			<span id="signupOutput"></span>
		</form>
	</div>
	<!-- SIGN UP END -->
</body>
<script type="text/javascript" src="scripts/login.js"></script>
<script type="text/javascript" src="scripts/signup.js"></script>
</html>