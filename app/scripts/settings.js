$(".settings-update-button").click(function() {
	var username	= $("#settingsUsername");
	var password	= $("#settingsPassword");
	var email		= $("#settingsEmail");
	var name		= $("#settingsName");
	var surname		= $("#settingsSurname");
	var gender		= $("#settingsGender option:selected").text();
	var attraction	= $("#settingsAttracted option:selected").text();
	var bio			= $("#settingsBio").val();
	var age			= $("#settingsAge");
	var local		= $("#settingsLocalisation");

	var username	= (username.val() === "") ? username.attr("placeholder") : username.val();
	var password	= (password.val() === "") ? password.attr("placeholder") : password.val();
	var email		= (email.val() === "") ? email.attr("placeholder") : email.val();
	var name		= (name.val() === "") ? name.attr("placeholder") : name.val();
	var surname		= (surname.val() === "") ? surname.attr("placeholder") : surname.val();
	var age			= (age.val() === "") ? age.attr("placeholder") : age.val();
	var age			= (/^\d+$/.test(age)) ? age : $("#settingsAge").attr("placeholder");
	var local		= (local.val() === "") ? local.attr("placeholder") : local.val();

	settings = new FormData();
	settings.append("ctx", "update");
	settings.append("username", username);
	settings.append("password", password);
	settings.append("email", email);
	settings.append("name", name);
	settings.append("surname", surname);
	settings.append("gender", gender);
	settings.append("attraction", attraction);
	settings.append("bio", bio);
	settings.append("age", age);
	settings.append("local", local);

	var xhr_settings = new XMLHttpRequest();
	xhr_settings.open("POST", "assets/updateSettings.php");
	xhr_settings.send(settings);
	xhr_settings.onreadystatechange = function () {
		var DONE 	= 4;
		var OK		= 200;
		if (xhr_settings.readyState === DONE && xhr_settings.status === OK) {
			$(".settings-update-button").html("Informations Updated");
			window.setTimeout(function(){
				$(".settings-update-button").html("Update Informations");
			}, 2000);
		} 
	}
});