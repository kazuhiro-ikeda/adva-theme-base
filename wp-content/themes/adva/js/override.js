$(function(){

	var topBtn = $('#btn_top');
	topBtn.hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 300) {
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
	topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
	});

	$(window).scroll(function(){
		if ($(window).scrollTop() > 100) {
			$('header.normal').addClass('fixed');
			$('.nav_drawer').addClass('fixed');
		} else {
			$('header.normal').removeClass('fixed');
			$('.nav_drawer').removeClass('fixed');
		}
	});

	$(window).scroll(function () {
		var s = $(this).scrollTop();
		var a = 200;
		var b = $( "footer" ).offset();
		var c = b.top;
		if (s > a && s <= ( c-$(window).height() ) ) {
			$( ".cv_case" ).fadeIn( "slow" );
		} else if( s <= a || s > ( c - $(window).height() ) ) {
			$( ".cv_case" ).fadeOut( "slow" );
		}
	});

});
