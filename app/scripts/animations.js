$('#btn-like').click(function() {
	likeAnimation();
	target = $("#game-card:first").children().text();
	target = target.substring(0, target.indexOf(","));
	likeAction = new FormData();
	likeAction.append("target", target);
	likeAction.append("action", "like");
	
	var xhr_like = new XMLHttpRequest();
	xhr_like.open("POST", "assets/actions.php");
	xhr_like.send(likeAction);
	xhr_like.onreadystatechange = function () {
			var DONE = 4;
			var OK = 200;
			if (xhr_like.readyState === DONE) {
				if (xhr_like.status === OK) {
					console.log(xhr_like.responseText);
				}
			}
		}
});

$('#btn-dislike').click(function() {
	dislikeAnimation();
});

function likeAnimation() {
	$('#game-card').animate({
		deg: 90,
		left: "+=100%"},
	{
		duration: 900,
		step: function(now) {
			now = -50.003761199993235 + now;
			$(this).css({ transform: 'rotate(' + now + 'deg) translate(-50%, -50%)' });
		}
	});
	$('#game-card').fadeOut(function() {
		$(this).remove();
		$('#game-card:first').fadeIn("slow");
	});
}

function dislikeAnimation() {
	$('#game-card').animate({
		deg: 90,
		left: "-=100%",
		display: "hidden"},
	{
		duration: 900,
		step: function(now) {
			now = 50.001967135504856 - now;
			$(this).css({ transform: 'rotate(-' + now + 'deg) translate(-50%, -50%)' });
		}
	});
	$('#game-card').fadeOut(function() {
		$(this).remove();
		$('#game-card:first').fadeIn("slow");
	});
}

$(document).keydown(function(e) {
	switch(e.which) {
		case 37: // left
			dislikeAnimation();

		case 39: // right
			likeAnimation();

		default:
			return;
	}
	e.preventDefault();
});