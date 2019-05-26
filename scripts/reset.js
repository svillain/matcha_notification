/* Open Modal */
password_btn = document.getElementById("passwordbtn");
password_btn.onclick = function() {
	document.getElementById("login-modal").style.visibility = "hidden";
	document.getElementById("login-modal").style.opacity = 0;
	document.getElementById("signup-modal").style.visibility = "hidden";
	document.getElementById("signup-modal").style.opacity = 0;
	document.getElementById("password-modal").style.visibility = "visible";
	document.getElementById("password-modal").style.opacity = 1;
};

var CheminComplet = document.location.href;

/* Close Modal */
password_close = document.getElementById("password-close");
password_close.onclick = function() {
	document.getElementById("password-modal").style.display = "none";
	document.getElementById("password-modal").style.opacity = 0;
};

/* Remove Label */
var PasswordInput = document.getElementById("PasswordInput");
PasswordInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("PasswordInputLabel").innerText = "";
	}
	else {
		document.getElementById("PasswordInputLabel").innerText = "Password";
	}
};

var logPasswordInputValid = document.getElementById("logPasswordInputValid");
logPasswordInputValid.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("logPasswordLabelValid").innerText = "";
	}
	else {
		document.getElementById("logPasswordLabelValid").innerText = "Password check";
	}
};

passwordSubmit = document.getElementById("passwordSubmit");
passwordSubmit.onclick = function() {
	login();
};

function login() {
	var password = document.getElementById("PasswordInput");
	var password_valid = document.getElementById("logPasswordInputValid");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "assets/reset.php", true);
	logData = new FormData();
	logData.append("password", password.value);
	logData.append("password_valid", password_valid.value);
	logData.append("chemin", CheminComplet);
	console.log(CheminComplet);
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
	}
}