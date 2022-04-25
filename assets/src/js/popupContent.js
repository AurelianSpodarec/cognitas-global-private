$(document).ready(function () {

    $(document).on('click','a[href="#"]',function(e){e.preventDefault();});

    $('.popupContent-container--item-js').on('click',function(e){
        if( e.target.className.match('popupContent-container') ){
            if($(this).hasClass('active')){return false;}	
            $(this).addClass('active');
            $(this).closest('main').addClass('popup_enabled');
        }
    });

    $('.popupContent-container--item-js').on('click','.prev, .next', function(e){
        var container = $(this).closest('.popupContent-container--item-js');
        var thePrev = container.prevAll('.popupContent-container--item-js').first();
        var theNext = container.nextAll('.popupContent-container--item-js').first();
        var isPrev = $(this).hasClass('prev');
        var isNext = $(this).hasClass('next');

        container.removeClass('active');
        
        if(isPrev){
            if(thePrev.length) {
                thePrev.addClass('active');
            } else {
                $('.popupContent-container--item-js:last-child').addClass('active');
                
            }
        } else if(isNext){
            if(theNext.length) {
                theNext.addClass('active');
            } else {
                $('.popupContent-container--item-js:first-child').addClass('active');
            }
        }	
    });
});