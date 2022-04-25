
$(document).on('ready', function () {

    /*Home header video animation overlay sprite animation setup*/

    var theSubtitle = $('.home-header-image-wrapper .subtitle');
    var theSubtitleDelay = 6000;
    var frameCount = 0;
    var theDelay = 0;
    var elementID = 1;

    runSprite(elementID);

    function runSprite(elementID) {
        setTimeout(function () {
            video_sprite_animation(elementID, frameCount);
        }, theDelay);
    }

    function video_sprite_animation(elementID, frameCount) {

        var theElement = $('#sprite-animation-' + elementID);
        var theWidth = theElement.attr('data-width');
        var theHeight = theElement.attr('data-height');
        var theFrames = theElement.attr('data-frames');
        var theSpeed = theElement.attr('data-speed');
        var frameHeight = theHeight / theFrames;

        theElement.css({ width: theWidth, height: frameHeight, backgroundPosition: 'center ' + (frameCount * -1) + 'px' });
        frameCount += frameHeight;

        if (frameCount < (theHeight - frameHeight)) {
            setTimeout(function () {
                video_sprite_animation(elementID, frameCount);
            }, theSpeed);
        } else {
            theElement = $('#sprite-animation-' + elementID).addClass('fadeAway');
            elementID = +elementID + 1;
            runSprite(elementID);
        }
    }


    setTimeout(function () {
        theSubtitle.css("opacity", '1');
    }, theSubtitleDelay);

    //Close button closes Modal Box
    $('body').on('click', '.close', function () {
        $(this).closest('.active').removeClass('active');
        $(this).closest('main').removeClass('popup_enabled');
    });

    //Emergency/Notification Popup Box
    setTimeout(function () {
        if ($('.emergency_popup').html().match(/\w/g)) {
            $('.emergency_popup').addClass('active');
        }
    }, 5000);


    // Check if element is scrolled into view
    function isScrolledIntoView(elem) {
        var docViewTop = $(window).scrollTop() + 300;
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    // If element is scrolled into view, fade it in
    $(window).scroll(function () {
        $('.scroll-animations.animated.mso-fade-up').each(function () {
            if (isScrolledIntoView(this) === true) {
                $(this).addClass('fadeInUp');
            }
        });
        $('.scroll-animations.animated.mso-fade-in').each(function () {
            if (isScrolledIntoView(this) === true) {
                $(this).addClass('fadeIn');
            }
        });

        $('.animatedLogoVideo').each(function () {
            if (isScrolledIntoView(this) === true) {
                $(this)[0].play();
            }
        })
    });

    $('h1, h2, h3, h4, p, .textContent .big_image .content-typography, .blockquote,.quote-text,.download-item,.full-width-component')
        .not('.image-blocks h2, .numbered-timeline, .sixth_form_mask_container *, .news_item h2, .news_item p, .news_grid-row h2, .news_grid-row p, footer *, h3.search-itemTitle, .box-event h2, .box-event p,.sidebar_box *,.case-study-list-item *, .news-item *, .disable-scroll-animation')
        .addClass('animate_it');

    $('.bbb').addClass('animate_it-bbb')
    //Like animate on view but select the parent element and watch the children appear one at a time
    var include = '.image-blocks,.content-typography ul,.content-typography ol,.full-width-component,.numbered-timeline-item';
    $(include).addClass('staggered deactive');
});

function staggerBoxes() {

    var scrollMiddle = $(window).scrollTop() + 30;

    $('.staggered.deactive').each(function () {
        var tSpeed = 0;
        $(this).children().each(function () {
            $(this).css({ transition: 'all 0.75s ease ' + tSpeed + 's' });
            tSpeed += 0.33;
        });

        startAnimation = $(this).offset().top - ($(window).height() - 30);

        if ($(window).scrollTop() > startAnimation) {
            $(this).removeClass('deactive').addClass('active');
        }
    });
}

function animateOnView($init) {
    $('.animate_it').each(function () {
        var theScroll = $(document).scrollTop() + $(window).innerHeight();
        var thePos = $(this).offset().top;

        if ($init == true) {
            var scrollDelay = 0;
        } else {
            var scrollDelay = $(window).height() / 4;
        }

        if (thePos < (theScroll - scrollDelay)) {
            $(this).removeClass('deactive').addClass('active');
        }

        if (thePos >= (theScroll - scrollDelay) && $init == true) {
            $(this).addClass('deactive');
        }
    });
}
animateOnView(true);

function animateOnViewHHH($init) {
    $('.animate_it-bbb').each(function () {
        var theScroll = $(document).scrollTop() + $(window).innerHeight();
        var thePos = $(this).offset().top;

        if ($init == true) {
            var scrollDelay = 0;
        } else {
            var scrollDelay = $(window).height() / 4;
        }

        if (thePos < (theScroll - scrollDelay)) {
            $(this).removeClass('deactive').addClass('active');
        }

        if (thePos >= (theScroll - scrollDelay) && $init == true) {
            $(this).addClass('deactive');
        }
    });
}
animateOnViewHHH(true);

//Initiate functions that run on scroll, load and resize.
$(window).on('scroll load resize', function () {
    animateOnView();
    animateOnViewHHH()
    staggerBoxes();
});


$(document).click(function () {
    $('.header-search-slideout').removeClass('search-active'); //hide the button
});