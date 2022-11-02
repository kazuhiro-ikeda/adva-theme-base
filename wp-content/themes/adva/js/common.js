$(function () {
	//画面幅が375pxより小さい場合、viewportを再設定
	$(window).on('load', function () {
		var w = $(window).width();
		if (w <= 375) {
			$('meta[name=viewport]').attr('content', 'width=375');
		} else {
			$('meta[name=viewport]').attr('content', 'width=device-width');
		}
	});


	//PCで電話リンクを押せなくする
	var ua = navigator.userAgent.toLowerCase();
	var isMobile = /iphone/.test(ua) || /android(.+)?mobile/.test(ua);
	if (!isMobile) {
		$('a[href^="tel:"]').on('click', function (e) {
			e.preventDefault();
		});
	}

	//スムーススクロール
	var w = $(window).width();
	if (w >= 767) {
		//PC用のオフセット
		offsetY = 0;
	} else {
		//スマホ用のオフセット
		offsetY = 0;
	}
	var time = 500;

	$('a[href^="#"]').click(function () {
		var target = $(this.hash);
		if (!target.length) return;
		var targetY = target.offset().top + offsetY;
		$('html,body').animate({
			scrollTop: targetY
		}, time, 'swing');
		window.history.pushState(null, null, this.hash);
		return false;
	});

	$(window).scroll(function () {
		var scrollTop = $(window).scrollTop();

		//ヘッダー追従
		scrollHeight = $(document).height();
		scrollPosition = $(window).height() + $(window).scrollTop();
		if (scrollTop > 300 ) {
			$('#header, #js-pageTop').addClass('fixed');
		} else {
			$('#header, #js-pageTop').removeClass('fixed');
		}
	});



	//スマホ向け（750px以下のとき）
	var mql = window.matchMedia('screen and (max-width: 750px)');
	function checkBreakPoint(mql) {
		if (mql.matches) {
			//ハンバーガーメニュー
			var gnav = $('#g-nav');
			var sp_btn = $('#sp-btn');
			var sp_btn_link = $('#sp-btn button');
			var header = $('#header');
			var html = $('html');
			var body = $('body');
			function change_sp_nav() {
				if (sp_btn.hasClass('active')) {
					gnav.removeClass('active').fadeOut();
					sp_btn.removeClass('active');
					html.removeClass('active');
					body.removeClass('active');
					header.removeClass('nav-open');
				} else {
					gnav.addClass('active').fadeIn();
					sp_btn.addClass('active');
					html.addClass('active');
					body.addClass('active');
					header.addClass('nav-open');
				}
				return false;
			}

			sp_btn.on('click', function () {
				change_sp_nav();
				return false;
			});


			//メニューが開いている時は背景固定（SP）
			var scrollpos;
			var state = false;

			$('#sp-btn').on('click', function () {
				if (state == false) {
					scrollpos = $('html').scrollTop();
					$('body').addClass('scroll-prevent').css('top', -scrollpos);
					state = true;
				} else {
					$('body').removeClass('scroll-prevent').css('top', '0');
					$('html').scrollTop(scrollpos);
					state = false;
				}
			});

		}
	}

	// ブレイクポイントの瞬間に発火
	mql.addListener(checkBreakPoint);
	// 初回チェック
	checkBreakPoint(mql);



});


//ofi
objectFitImages('.ofi');
