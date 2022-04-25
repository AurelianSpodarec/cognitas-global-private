/*$(document).ready(function () {
  var StickyHeader = {
    scrollPosition: function () {
      return $(window).scrollTop();
    },

    headerPosition: function () {
      return $('.header').offset().top;
    },

    fix: function () {
      $('body').addClass('stickyHeader');
    },

    unfix: function () {
      $('body').removeClass('stickyHeader');
    },

    expand: function () {
      $('.js-stickyHeader').addClass('shrinkHeader');
    },

    shrink: function () {
      $('.js-stickyHeader').removeClass('shrinkHeader');
    },

    handler: function () {

      if( $(window).width() > 768){
        var headerHeight = $('.hero').height();
        var navBarHeight = $('.header-inner').height();

        if ( this.scrollPosition() > (headerHeight-navBarHeight) )  {
          this.fix();
        } else {
          this.unfix();
        }

        if ((this.scrollPosition() ) > headerHeight ) {
          this.expand();
        } else {
          this.shrink();
        }
      } else {
        if ((this.scrollPosition()) > this.headerPosition()) {
          this.fix();
        } else {
          this.unfix();
        }

        if ((this.scrollPosition() - 50) > this.headerPosition()) {
          this.expand();
        } else {
          this.shrink();
        }
      }
    },

    init: function () {
      var self = this;

      $(window).on('scroll', function () {
        self.handler();
      });

      $(window).on('load', function () {
        self.handler();
      });
    },
  };

  return StickyHeader.init();
});*/