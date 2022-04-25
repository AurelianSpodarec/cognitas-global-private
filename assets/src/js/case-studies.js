$(document).ready(function () {
	var $caseStudiesSlider = $('.js-case-studies-slider');

	if ($caseStudiesSlider.length === 0) {
		return false;
	};

	$caseStudiesSlider.slick({
		slidesToShow: 3,
		slidesToScroll: 3,
		arrows: false,
		dots: true,
		infinite: true,
		swipe: true,
		autoplay: true,
		autoplaySpeed: 7000,
		pauseOnHover: true,
		responsive: [
			{
		      breakpoint: 580,
		      settings: {
		        slidesToShow: 1,
				slidesToScroll: 1,
		      }
		    },
		]
	});
});