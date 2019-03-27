$(document).on('change', '#ppfile', function() {
	var proprety	= document.getElementById("ppfile").files[0];
	var image_name	= proprety.name;
	var image_ext	= image_name.split(".").pop().toLowerCase();
	var image_size	= proprety.size;

	var newPP	= new FormData();
	newPP.append("file", proprety);

	var xhr_ppUpload = new XMLHttpRequest();
	xhr_ppUpload.open("POST", "assets/uploader.php");
	xhr_ppUpload.send(newPP);
	xhr_ppUpload.onreadystatechange = function () {
		var DONE 	= 4;
		var OK		= 200;
		if (xhr_ppUpload.readyState === DONE && xhr_ppUpload.status === OK) {
			var output = xhr_ppUpload.responseText;
			$('#game-card-settings').css("background-image", "url(" + output + ")");  
		} 
	}
});

$('#game-card-settings').click(function() {
	$("#ppfile").trigger("click");
});