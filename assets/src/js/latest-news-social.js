(function ($) {
    /* global Swiper */
    $(document).ready(function () {  


        $('.js-news-social-goto').click(function() {
            $('.js-news-social-goto').removeClass('active');
            $(this).addClass('active');

            var slickIndexClicked = $(this).data('slick-index');
            $('.js-news-social').slick('slickGoTo', slickIndexClicked, false);
        });
    
        $('.js-news-social').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            infinite: false,
            fade: false,
            swipe: false,
            autoplay: false,
            nextArrow: '<button class="slick-next slick-arrow animate-button fill fill-secondary" aria-label="Next" type="button" aria-disabled="false"></button>',
            prevArrow: '<button class="slick-prev slick-arrow animate-button fill fill-secondary" aria-label="Previous" type="button" aria-disabled="false"></button>',             
        }).on('afterChange', function(event, slick, currentSlide){
            $('.js-news-social-goto').removeClass('active');
            $('[data-slick-index="' + currentSlide + '"]').addClass('active');
        });
                
        if ($('.js-news-social').length === 0) {
            return;
        }

    });
  }(jQuery));
  