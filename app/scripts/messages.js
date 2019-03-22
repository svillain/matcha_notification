function $_GET(param) {
		var vars = {};
		window.location.href.replace( location.hash, '' ).replace( 
			/[?&]+([^=&]+)=?([^&]*)?/gi,
			function( m, key, value ) {
				vars[key] = value !== undefined ? value : '';
			}
		);

		if ( param ) {
			return vars[param] ? vars[param] : null;	
		}
		return vars;
	}

function sendMessage() {
	content = $("#msg-text-input").val();
	newMessage = new FormData();
	newMessage.append("content", content);
	newMessage.append("action", "send");
	
	var xhr_msgSend = new XMLHttpRequest();
	xhr_msgSend.open("POST", "assets/messages.php");
	xhr_msgSend.send(newMessage);
	xhr_msgSend.onreadystatechange = function () {
			var DONE = 4;
			var OK = 200;
			if (xhr_msgSend.readyState === DONE) {
				if (xhr_msgSend.status === OK) {
					$("#msg-text-input").val("");
				}
			}
		}
}

function udpateChat() {
	name1	= '<span class="msg-name">';
	name2	= '</span>';

	img_from	= '<div class="msg-img" style="background-image: url(../img/hanou.jpg)"></div>';
	img_user1	= '<div class="msg-img" style="background-image: url(../img/pp-test.jpg)">';
	img_user2	= '</div>';

	msg_msg1	= '<span class="msg-msg">';
	msg_msg2	= '</span>';


	if ($(".messages").hasClass("app-screen-active")) {
		messagesInfo = new FormData();
		messagesInfo.append("partner", $_GET("messages"));
		messagesInfo.append("action", "update");
		var xhr_messages = new XMLHttpRequest();
		xhr_messages.open("POST", "assets/messages.php");
		xhr_messages.send(messagesInfo);
		xhr_messages.onreadystatechange = function () {
			var DONE = 4;
			var OK = 200;
			if (xhr_messages.readyState === DONE) {
				if (xhr_messages.status === OK) {
					var output = xhr_messages.responseText;
					output = JSON.parse(output)
					$(".msg-name").remove();
					$(".msg-img").remove();

					names = output[0];
					messages = output[1];
					for (i = 0; i < names.length; i++) {
						$("#messages_view").append(name1 + names[i] + name2);
						$("#messages_view").append(img_user1 + msg_msg1 + messages[i] + msg_msg2 + img_user2);
					}
				}
			}
		}
	}
}

// window.setInterval(function(){
	// udpateChat();
// }, 500);