
$(function () {
	$('.drawer_button').click(function () {
		$(this).toggleClass('active');
		$('.nav_drawer').toggleClass('active');
		$('.drawer_bg').fadeToggle();
		$('#drawer').toggleClass('open');
	})
	$('.drawer_bg').click(function () {
		$(this).fadeOut();
		$('.drawer_button').removeClass('active');
		$('#drawer').removeClass('open');
	});
})
