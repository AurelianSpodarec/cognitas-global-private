
$(document).on('ready', function () {

    $('.tab-title-container .tablinks').click(function(e) {

        e.preventDefault();

        var tabToShow = $(this).data('tab-id');

        $('.tab-title-container .tablinks').removeClass('tab-title-active');
        $(this).addClass('tab-title-active');

        $('.tab-content-container .tabcontent').removeClass('tab-content-active');
        $('#'+tabToShow).addClass('tab-content-active');

    });
});

