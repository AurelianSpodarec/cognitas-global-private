(function ($) { 
    $(document).ready(function () {
        var Accordion = {
            $item: $('.accordion-item'),
            $link: $('.accordion-link'),
            $content: $('.accordion-content'),
        
            toggle: function () {
                this.$link.on('click', function (e) {
                    var $item = $(this).parent(this.$item);
                    var $content = $(this).next(this.$content);
            
                    e.preventDefault();
            
                    $item.toggleClass('accordion-item--active');
                    
                    $content.slideToggle('fast', function () {
                        if ($(this).attr('aria-hidden') === 'true') {
                            $(this).attr('aria-hidden', 'false');
                        } else {
                            $(this).attr('aria-hidden', 'true');
                        }
                    });
                });
            },
        
            init: function () {
                this.toggle();
            },
        };

        $('.js-jump-to-anchor').click(function(e) {
            e.preventDefault();
            var thisAnchorName = $(this).data('subsection-anchor');
            var thisScrollPoint = $(this).parents('.accordion-content').find(".subsection-content[data-subsection-content='"+thisAnchorName+"']");

            $('html, body').animate({
                scrollTop: thisScrollPoint.offset().top
            }, 2000);
        });
    
        return Accordion.init();
    });
}(jQuery));