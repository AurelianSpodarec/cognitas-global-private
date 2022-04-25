$(document).ready(function () {
    
    if ( $( ".dynamic-subnav-anchor-point" ).length ) {

        if(window.location.hash) {
            var hash = window.location.hash.substring(1);
            var scrollToID = 'anchor-'+hash;

            setTimeout(function(){
                scrollDynamicContent(scrollToID);
            },500);
        }
    
        /*var $scrollToSubNavAnchor = $('.js-dynamic-subnav');
    
        $scrollToSubNavAnchor.on('click', function (e) {
            e.preventDefault();

            var scrollToID = $(this).data('dynamic-subnav-id');

            scrollDynamicContent(scrollToID);
        });*/

        function scrollDynamicContent(scrollToID) {
            
            var mainNavHeight = 116;
            if ($(window).width() < 640) {
                mainNavHeight = 90;
            }
            var offsetHeight = mainNavHeight;

            console.log(scrollToID);
        
            $('body, html').animate({ scrollTop: $('#'+scrollToID).offset().top - offsetHeight }, 'slow');
        }

        /*$(window).scroll(function(e){
            var mainNavHeight = 66;
            var marginTopHeight = 100;
            if ($(window).width() < 1200) {
                mainNavHeight = 66;
                marginTopHeight = 66;
            }
            var headerHeight = $('.header-image-wrapper').outerHeight();

            var snapHeight = headerHeight + marginTopHeight - mainNavHeight;
        
            var $el = $('.dynamic-subnav'); 
            var isPositionFixed = ($el.css('position') == 'fixed');
            
            if ($(this).scrollTop() > snapHeight && !isPositionFixed){ 
                $el.css({'position': 'fixed', 'top': mainNavHeight}); 
            }
            if ($(this).scrollTop() < snapHeight && isPositionFixed){
                $el.css({'position': 'absolute', 'top': '0px'}); 
            } 
        });*/
    }
});