$(document).ready(function () {

	$( '.js-image-gallerySlider' ).each( function(index) {
		var $slider = $(this);

		$slider.on('init', function(event, slick, currentSlide, nextSlide) {
			$(this).parent('.image-gallery-slider-content').find('.slide-count').append('<span class="slick-counter">' + parseInt(slick.currentSlide + 1) + ' / ' + slick.slideCount + '</span>');
		});

		$slider.on('afterChange', function(event, slick, currentSlide, nextSlide){
			$(this).parent('.image-gallery-slider-content').find('.slide-count').find('.slick-counter').html(slick.currentSlide + 1 +' / '+slick.slideCount);
		});

		$slider.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			appendArrows: $(this).parent('.image-gallery-slider-content').find('.image-gallery-nav'),
			prevArrow: '<button type="button" class="slick-prev"></button>',
			nextArrow: '<button type="button" class="slick-next"></button>',
			dots: false,
			infinite: true,
			fade: false,
			swipe: true,
			autoplay: true,
			autoplaySpeed: 7000,
			pauseOnHover: true,
			focusOnSelect: true,
			responsive: [
				{
					breakpoint: 580,
					settings: {
					slidesToShow: 2,
					}
				},
				{
				  breakpoint: 1200,
				  settings: {
					slidesToShow: 3,
				  }
				},
			]
		});
	});
});