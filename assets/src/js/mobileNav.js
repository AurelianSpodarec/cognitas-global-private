$(document).ready(function () {

    //   $(window).on('load resize scroll',function(){
    //     if ($(document).scrollTop() > 44) {
    //       $('.header-mobile').addClass('user-has-scrolled');
    //     } else {
    //       $('.header-mobile').removeClass('user-has-scrolled');
    //     }
    //   });

    var MobileNav = {
        show: function () {
            $('.js-mobileNav').slideDown('0.5', function () {
                $(this).addClass('header-mobileNav--isActive');
            });

            $('.header-search-slideout').removeClass('search-active');

            $("body").disableScroll();
            $('body').addClass('openedMenu');

            $('.js-menuToggle .nav-icon').addClass('collapsed');
            $('.mobile-menu-outer-container').addClass('menu-active');
        },

        hide: function () {
            $('.js-mobileNav').slideUp('0.5', function () {
                $(this).removeClass('header-mobileNav--isActive');
            });

            $("body").enableScroll();
            $('body').removeClass('openedMenu');

            $('.js-menuToggle .nav-icon').removeClass('collapsed');
            $('.mobile-menu-outer-container').removeClass('menu-active');
        },

        toggle: function () {
            return $('.js-mobileNav').hasClass('header-mobileNav--isActive') ? this.hide() : this.show();
        },

        subnavtoggle: function ($target) {
            var $list = $target.children('.sub-menu');

            //$target.toggleClass('mobileNav-item--isOpened');

            if (!$target.hasClass('mobileNav-subMenuItem')) {
                $list.slideToggle(250);
            }
        },

        openAncestor: function () {
            var $target = $('.current_page_parent');

            var $child = $target.find('.sub-menu');

            if ($child.length === 0) {
                return;
            }

            this.subnavtoggle($target);
        },

        init: function () {
            var self = this;

            var $parentNode = $('.sub-menu').parent();
            $parentNode.prepend('<button class="mobileNav-childToggle"></button>');

            $('.js-menuToggle').on('click', function () {
                self.toggle();
            });

            $('.mobileNav-childToggle').on('click', function (e) {
                e.preventDefault();

                self.subnavtoggle(($(e.target).parent()));
            });

            //self.openAncestor();
        },
    };

    return MobileNav.init();
});


$(document).ready(function () {

    $.fn.disableScroll = function () {
        window.oldScrollPos = $(window).scrollTop();

        $(window).on('scroll.scrolldisabler', function (event) {
            $(window).scrollTop(window.oldScrollPos);
            event.preventDefault();
        });
    };

    $.fn.enableScroll = function () {
        $(window).off('scroll.scrolldisabler');
    };
});
