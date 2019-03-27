/* Open Modal */
sign_btn = document.getElementById("signbtn");
sign_btn.onclick = function() {
	document.getElementById("signup-modal").style.visibility = "visible";
	document.getElementById("signup-modal").style.opacity = 1;
	document.getElementById("login-modal").style.visibility = "hidden";
	document.getElementById("login-modal").style.opacity = 0;
};


/* Close Modal */
sign_close = document.getElementById("signup-close");
sign_close.onclick = function() {
	document.getElementById("signup-modal").style.visibility = "hidden";
	document.getElementById("signup-modal").style.opacity = 0;
};

/* Remove Label */
var signUserInput = document.getElementById("signUsernameInput");
signUserInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("signUsernameLabel").innerText = "";
	} else {
		document.getElementById("signUsernameLabel").innerText = "Username"
	}
};

var signPassInput = document.getElementById("signPasswordInput");
signPassInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("signPasswordLabel").innerText = "";
	} else {
		document.getElementById("signPasswordLabel").innerText = "Password"
	}
};

var signMailInput = document.getElementById("signEmailInput");
signMailInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("signEmailLabel").innerText = "";
	} else {
		document.getElementById("signEmailLabel").innerText = "E-Mail"
	}
};

var signAgeInput = document.getElementById("signAgeInput");
signAgeInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("signAgeLabel").innerText = "";
	} else {
		document.getElementById("signAgeLabel").innerText = "Age"
	}
};

var signNameInput = document.getElementById("signNameInput");
signNameInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("signNameLabel").innerText = "";
	} else {
		document.getElementById("signNameLabel").innerText = "Name"
	}
};

var signSurnameInput = document.getElementById("signSurnameInput");
signSurnameInput.onkeyup = function() {
	if (this.value != "") {
		document.getElementById("signSurnameLabel").innerText = "";
	} else {
		document.getElementById("signSurnameLabel").innerText = "Surname"
	}
};

sign_submit = document.getElementById("signSubmit");
sign_submit.onclick = function() {
	register();
};

function badValue(username, email, password, age, name, surname, toast_ok, toast_error) {
	if (!username || !username.value.length) {
		if (toast_error) {
			toast_error.innerHTML = "Nom d'utilisateur invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	} else if (!email || !email.value.length || email.value.indexOf('@') === -1) {
		if (toast_error) {
			toast_error.innerHTML = "Email invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	} else if (!password || !password.value.length) {
		if (toast_error) {
			toast_error.innerHTML = "Mot de passe invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	} else if (!age || !age.value.length) {
		if (toast_error) {
			toast_error.innerHTML = "Age invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	}
	else if (!name || !name.value.length) {
		if (toast_error) {
			toast_error.innerHTML = "Name invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	}
	else if (!surname || !surname.value.length) {
		if (toast_error) {
			toast_error.innerHTML = "Surname invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	}
	return (0);
}

function badValueUP(username, password, toast_error) {
	if (!username || !username.value.length) {
		if (toast_error) {
			toast_error.innerHTML = "Nom d'utilisateur invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	} else if (!password || !password.value.length) {
		if (toast_error) {
			toast_error.innerHTML = "Mot de passe invalide";
			toast_error.className = "show";
			setTimeout(function() {
				toast_error.className = toast_error.className.replace("show", "");
			}, 3000);
		}
		return (1);
	}
	return (0);
}

function register() {
	var username = document.getElementById("signUsernameInput");
	var password = document.getElementById("signPasswordInput");
	var email = document.getElementById("signEmailInput");
	var age = document.getElementById("signAgeInput");
	var name = document.getElementById("signNameInput");
	var surname = document.getElementById("signSurnameInput");


	var toast_error = document.getElementById("toast_error");
	var toast_ok = document.getElementById("toast_ok");

	if (!badValue(username, email, password, age, name, surname, toast_ok, toast_error)) {
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "assets/signup.php", true);
		signData = new FormData();
		signData.append("username", username.value);
		signData.append("password", password.value);
		signData.append("email", email.value);
		signData.append("age", age.value);
		signData.append("name", name.value);
		signData.append("surname", name.value);
		xhttp.send(signData);

		xhttp.onreadystatechange = function() {
			if (this.readyState === 4) {
				if (this.status === 200) {
					var output = xhttp.responseText;
					console.log(output);
					if (output === "success") {
						document.getElementById("signupOutput").innerHTML = "Your account has been registered, please check your email";
					}
					else if (output === "username") {
						document.getElementById("signupOutput").innerHTML = "Username is unavailable";
					}
					else if (output === "email") {
						document.getElementById("signupOutput").innerHTML = "Email is unavailable";
					}
				}
			}
		};
	}
}