(function ($) { 
    $(document).on('ready', function () {
        $('.footer-school-item').click(function() {
            var toggleDivID = $(this).data('footer-school');


            if ( $('#'+toggleDivID).hasClass( "school-active" ) ) {
                $('.footer-school-info-container').removeClass('area-active');
                $('.footer-school-info-item').removeClass('school-active');
                $('.footer-school-item').removeClass('active');
            } else {
                $('.footer-school-item').removeClass('active');
                $(this).addClass('active');
                $('.footer-school-info-container').addClass('area-active');
                $('.footer-school-info-item').removeClass('school-active');
                $('#'+toggleDivID).addClass('school-active');
            }
        });
    });
}(jQuery));