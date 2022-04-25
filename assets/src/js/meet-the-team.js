$(document).ready(function () {

	$('.js-expand-details').click(function() {

        $(this).parent('.meet-the-team-items').find('.meet-the-team-item').removeClass('active-member');
        $(this).parent('.meet-the-team-items').find('.meet-the-team-text').removeClass('active');

        var clickedMember = $(this).data('team-member');
        $(this).addClass('active-member');

        $(this).parent('.meet-the-team-items').find('#'+clickedMember).addClass('active');

        if ($(window).width() < 640) {
            $('html, body').animate({
                scrollTop: $(this).parent('.meet-the-team-items').find('#'+clickedMember).offset().top - 80
            }, 1000);
        }
    });
});