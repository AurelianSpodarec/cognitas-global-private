
$(document).ready(function () {
    var $container = $('.js-news-container');
    var $monthSelect = $('.js-select-month');
    var $yearSelect = $('.js-select-year');
    var $yearOptions = $('.js-select-year > option');
    var date = new Date();

    /*$yearOptions.each(function () {
    var value = $(this).val().split('/')[3];

    $(this).val(value);
    });*/

    //$monthSelect.val(date.getMonth() + 1);
    //$yearSelect.val(date.getFullYear());

    $container.masonry({
    itemSelector: '.news-item',
    percentPosition: true,
    columnWidth: '.news-item__sizer',
    gutter: '.news-item__gutter',
    });
});