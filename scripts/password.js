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

/* Close Modal */
password_close = document.getElementById("password-close");
password_close.onclick = function() {
	document.getElementById("password-modal").style.visibility = "hidden";
	document.getElementById("password-modal").style.opacity = 0;
};

/* Remove Label */
var PasswordInput = document.getElementById("PasswordInput");
PasswordInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("PasswordInputLabel").innerText = "";
	} else {
		document.getElementById("PasswordInputLabel").innerText = "Email";
	}
};

pass_submit = document.getElementById("passwordSubmit");
pass_submit.onclick = function() {
	change_password();
};

function change_password() {
	var email = document.getElementById("PasswordInput");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "assets/password.php", true);
	passData = new FormData();
	passData.append("email", email.value);
	console.log(passData);
	xhttp.send(passData);

	xhttp.onreadystatechange = function() {
		if (this.readyState === 4) {
			if (this.status === 200) {
				var output = xhttp.responseText;
				if (output === "success") {
					document.getElementById("PasswordOutput").innerHTML = "Success";
					location.reload();
				}
				else if (output === "NoEmail") {
					document.getElementById("PasswordOutput").innerHTML = "Incorrect email";
				}
				else if (output === "activation") {
					document.getElementById("PasswordOutput").innerHTML = "Account unvalidated";
				}
			}
		}
	};
}