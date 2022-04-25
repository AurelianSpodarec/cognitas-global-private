/* global videojs */

$(document).on('ready', function () {
  $('[data-fancybox]').fancybox({
    type: 'inline',
    infobar: false,
    buttons: false,
    slideShow: false,
    fullScreen: false,
    thumbs: false,
    autoFocus: false,
    backFocus: false,
    btnTpl: {
      close: '<button data-fancybox-close class="popup-close" title="{{CLOSE}}"></button>',
      smallBtn: '<button data-fancybox-close class="popup-close" title="{{CLOSE}}"></button>',
    },
    touch: false,
    afterShow: function (el, slide) {
      var video;
      var videoOptions;

      if ($('.video-js').length === 0) {
        return;
      }

      video = slide.$content.find('.video-js').attr('data-video');
      videoOptions = {
        controls: true,
        techOrder: ['youtube'],
        sources: [{
          type: 'video/youtube',
          src: video,
        }],
      };

      videojs('popup-video', videoOptions);
    },
  });
});
