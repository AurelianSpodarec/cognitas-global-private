$(document).ready(function () {
  var $slider = $('.js-homepage-slider');
  var $scrollBottom = $('.js-scrollBottom');

  $scrollBottom.on('click', function (e) {
    e.preventDefault();

    $('body, html').animate({ scrollTop: $('.main-components').offset().top - 66 }, 'slow');
  });

  if ($slider.length > 0) {
    $slider.slick({
      slidesToShow: 1,
      arrows: false,
      dots: false,
      infinite: true,
      fade: true,
      swipe: false,
      autoplay: true,
      autoplaySpeed: 7000,
      pauseOnHover: false,
      pauseOnFocus: false
    });
  }
});

//Initiate Hidden Boxed Projects
$(window).on('load',function(){
  $('.box-projects').each(function(){
    var scrollBottom = $(window).scrollTop() + $(window).height();
    if( $(this).offset().top > scrollBottom){
      $(this).addClass('inactive');
    }
  });
});

function deferProjects(){
	var scrollBottom = $(window).scrollTop() + ($(window).height() / 1.25);
	$('.box-projects').each(function(){
		if( $(this).offset().top < scrollBottom){
			$(this).removeClass('inactive');
		}
	});
}

$(window).on('scroll load resize',function(){
  deferProjects();
});