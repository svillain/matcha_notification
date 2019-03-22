/* Open Modal */
log_btn = document.getElementById("logbtn");
log_btn.onclick = function() {
	document.getElementById("login-modal").style.visibility = "visible";
	document.getElementById("login-modal").style.opacity = 1;
	document.getElementById("signup-modal").style.visibility = "hidden";
	document.getElementById("signup-modal").style.opacity = 0;
};


/* Close Modal */
log_close = document.getElementById("login-close");
log_close.onclick = function() {
	document.getElementById("login-modal").style.visibility = "hidden";
	document.getElementById("login-modal").style.opacity = 0;
};

/* Remove Label */
var logUserInput = document.getElementById("logUsernameInput");
logUserInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("logUsernameLabel").innerText = "";
	}
	else {
		document.getElementById("logUsernameLabel").innerText = "Username"
	}
};

var logPassInput = document.getElementById("logPasswordInput");
logPassInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("logPasswordLabel").innerText = "";
	}
	else {
		document.getElementById("logPasswordLabel").innerText = "Password"
	}
};

log_submit = document.getElementById("logSubmit");
log_submit.onclick = function() {
	login();
};

function login() {
	var username = document.getElementById("logUsernameInput");
	var password = document.getElementById("logPasswordInput");

		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "assets/login.php", true);
		logData = new FormData();
		logData.append("username", username.value);
		logData.append("password", password.value);
		xhttp.send(logData);

		xhttp.onreadystatechange = function() {
			if (this.readyState === 4) {
				if (this.status === 200) {
					var output = xhttp.responseText;
					if (output === "success") {
						document.getElementById("loginOutput").innerHTML = "Success";
						location.reload();
					}
					else if (output === "username") {
						document.getElementById("loginOutput").innerHTML = "Incorrect username";
					}
					else if (output === "password") {
						document.getElementById("loginOutput").innerHTML = "Incorrect password";
					}
					else if (output === "activation") {
						document.getElementById("loginOutput").innerHTML = "Please activate your account";
				}
			}
		}
	};
}