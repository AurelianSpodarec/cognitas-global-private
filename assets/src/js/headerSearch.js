$(document).ready(function () {
	//if ($(window).width() > 640) {
		$('.js-desktop-search').click(function(e) {
			e.preventDefault();
			e.stopPropagation();

			if($('.header-search-slideout').hasClass('search-active')) {
				$('.header-search-slideout').removeClass('search-active');
			} else {
				$('.header-search-slideout').addClass('search-active');
				setTimeout(function() {
					$('.msoSearchBox').focus();
				},400);
		 	}
		});

		$(document).click(function(){  
			$('.header-search-slideout').removeClass('search-active'); //hide the button
		});
	//}
});