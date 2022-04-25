
$(document).ready(function () {
    var $container = $('.js-case-study-container');

    $container.masonry({
    itemSelector: '.case-study-list-item',
    percentPosition: true,
    columnWidth: '.case-study-list-item__sizer',
    gutter: '.case-study-list-item__gutter',
    });
});