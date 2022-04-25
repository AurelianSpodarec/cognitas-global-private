$(document).ready(function () {
	var $testimonialSlider = $('.js-testimonial-slider');

	if ($testimonialSlider.length === 0) {
		return false;
	};

	$testimonialSlider.slick({
		slidesToShow: 1,
		arrows: false,
		dots: true,
		infinite: true,
		swipe: true,
		autoplay: true,
		autoplaySpeed: 7000,
		pauseOnHover: true,
	});
});