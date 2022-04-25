$(document).ready(function () {
    var $slider = $('.twitter-carousel-slider-js');
  
    if ($slider.length === 0) {
      return;
    }
  
    $slider.slick({
      slidesToShow: 1,
      arrows: true,
      dots: false,
      infinite: true,
      fade: false,
      swipe: true,
      autoplay: true,
      autoplaySpeed: 7000,
      pauseOnHover: false,
      pauseOnFocus: false
    });
  });