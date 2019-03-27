$(".head").click(function() {
	$("#nav-matchs").removeClass("active");
	$("#nav-messages").removeClass("active");
	$("#nav-suggestions").removeClass("active");
	$("#nav-notifications").removeClass("active");

	$("#info-pp").removeClass("sp-hidden");
	$("#info-matchs").addClass("sp-hidden");
	$("#info-messages").addClass("sp-hidden");
	$("#info-notifications").addClass("sp-hidden");
	$("#info-suggestions").addClass("sp-hidden");

	$(".app-screen-active").removeClass("app-screen-active");
	$(".settings").addClass("app-screen-active");
});

$("#nav-matchs").click(function() {
	$("#nav-matchs").addClass("active");
	$("#nav-messages").removeClass("active");
	$("#nav-suggestions").removeClass("active");
	$("#nav-notifications").removeClass("active");

	$("#info-pp").addClass("sp-hidden");
	$("#info-matchs").removeClass("sp-hidden");
	$("#info-messages").addClass("sp-hidden");
	$("#info-notifications").addClass("sp-hidden");
	$("#info-suggestions").addClass("sp-hidden");

	$(".app-screen-active").removeClass("app-screen-active");
	$(".game").addClass("app-screen-active");
});

$("#nav-messages").click(function() {
	$("#nav-messages").addClass("active");
	$("#nav-matchs").removeClass("active");
	$("#nav-suggestions").removeClass("active");
	$("#nav-notifications").removeClass("active");

	$("#info-pp").addClass("sp-hidden");
	$("#info-messages").removeClass("sp-hidden");
	$("#info-matchs").addClass("sp-hidden");
	$("#info-notifications").addClass("sp-hidden");
	$("#info-suggestions").addClass("sp-hidden");

	$(".app-screen-active").removeClass("app-screen-active");
	$(".messages").addClass("app-screen-active");

});

$("#nav-suggestions").click(function() {
	$("#nav-suggestions").addClass("active");
	$("#nav-matchs").removeClass("active");
	$("#nav-notifications").removeClass("active");
	$("#nav-messages").removeClass("active");

	$("#info-pp").addClass("sp-hidden");
	$("#info-suggestions").removeClass("sp-hidden");
	$("#info-matchs").addClass("sp-hidden");
	$("#info-notifications").addClass("sp-hidden");
	$("#info-messages").addClass("sp-hidden");

	$(".app-screen-active").removeClass("app-screen-active");
	$("#nav-suggestions").addClass("app-screen-active");
});

$("#nav-notifications").click(function() {
	$("#nav-notifications").addClass("active");
	$("#nav-matchs").removeClass("active");
	$("#nav-suggestions").removeClass("active");
	$("#nav-messages").removeClass("active");

	$("#info-pp").addClass("sp-hidden");
	$("#info-notifications").removeClass("sp-hidden");
	$("#info-matchs").addClass("sp-hidden");
	$("#info-messages").addClass("sp-hidden");
	$("#info-suggestions").addClass("sp-hidden");

	$(".app-screen-active").removeClass("app-screen-active");
	$("#nav-notifications").addClass("app-screen-active");
});
