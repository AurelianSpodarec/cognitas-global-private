$(document).ready(function () {

    var $logoSlider = $('.logo-slider-js');

    if ($logoSlider.length === 0) {
        return false;
    };

    $logoSlider.slick({
        slidesToShow: 5,
        arrow: true,
        dots: false,
        infinite: true,
        swipe: true,
        autoplay: true,
        autoplaySpeed: 3500,
        pauseOnHover: true,
        // variableWidth: true,
        responsive: [
            {
                breakpoint: 580,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1300,
                settings: {
                    slidesToShow: 4,
                }
            },
        ]
    });
});