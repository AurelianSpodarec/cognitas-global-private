/* global wp_paths */

/*(function ($) {
  var pageNumber = 1;
  var postType;
  var perPage;
  var search;
  var sendData;
  var month;
  var year;
  var $loadMoreEntries = $('.js-load-entries');
  var $container = $('.js-entries-container');
  var $dateSelect = $('.js-select-date');
  var $monthSelect = $('.js-select-month');
  var $yearSelect = $('.js-select-year');

  $dateSelect.on('change', function (e) {
    month = $monthSelect.val();
    year = $yearSelect.val();

    e.preventDefault();

    postType = $container.attr('data-post-type');
    perPage = $container.attr('data-per-page');
    category = $container.attr('data-category');
    sendData = {
      action: 'ajax_handler',
      post_type: postType,
      per_page: perPage,
      month: month,
      year: year,
      category: category
    };

    $.ajax({
      url: ajaxnews.ajaxurl,
      type: 'GET',
      data: sendData,
      dataType: 'html',
      cache: false,
      timeout: 10000,
      beforeSend: function () {
        pageNumber = 1;

        $container.empty();
        $loadMoreEntries.hide();
      },
      error: function () {
        $loadMoreEntries.remove();
      },
      success: function (data, textStatus, jqXHR) {
        var htmlData = $.parseHTML(jqXHR.responseText);

        $container.append(htmlData);

        if (postType === 'post' || postType === 'alumni-news') {
          $container.masonry('reloadItems');
          $container.masonry('layout');
        }
      },
      complete: function () {
        var dataCount = $container.find('.news-item').size();
        pageNumber = 1;

        $container.attr('data-month', month)
                  .attr('data-year', year)
                  .attr('data-category', category);

        if (dataCount >= perPage) {
          $loadMoreEntries.show();
        }
      }
    });
  });

  $loadMoreEntries.on('click', function (e) {
    month = $container.attr('data-month');
    year = $container.attr('data-year');
    category = $container.attr('data-category');

    e.preventDefault();

    postType = $container.data('post-type');
    perPage = $container.data('per-page');
    search = $container.data('search');
    sendData = {
      action: 'ajax_handler',
      offset: pageNumber * perPage,
      post_type: postType,
      per_page: perPage,
      search: postType ? null : search,
      month: month,
      year: year,
      category: category,
    };

    $.ajax({
      url: ajaxnews.ajaxurl,
      type: 'GET',
      data: sendData,
      dataType: 'html',
      cache: false,
      timeout: 10000,
      beforeSend: function () {
        $loadMoreEntries.hide();
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $loadMoreEntries.remove();
      },
      success: function (data, textStatus, jqXHR) {
        var htmlData = $.parseHTML(jqXHR.responseText);

        $container.append(htmlData);

        nextPageNumber = parseInt(pageNumber + 1);

        checkNextNewsPage(perPage, nextPageNumber, category, $loadMoreEntries);

        if (postType === 'post' || postType === 'alumni-news') {
          $container.masonry('reloadItems');
          $container.masonry('layout');
        }
      },
      complete: function () {
        pageNumber += 1;
      }
    });

    return false;
  }); 

  function checkNextNewsPage(perPage, pageNumber, category, trigger) {
    var data = {};

    if (category !== 'default') {
      sendData = {
        action: 'ajax_handler',
        offset: pageNumber * perPage,
        post_type: postType,
        per_page: perPage,
        search: postType ? null : search,
        month: month,
        year: year,
        category: category,
      };
    } else {
      sendData = {
        per_page: perPage,
        page: pageNumber,
      };
    }

    $.ajax({
      url: ajaxnews.ajaxurl,
      type: 'GET',
      data: sendData,
      dataType: 'html',
      cache: false,
      timeout: 10000,

      success: function (posts) {
        if (posts !== '<div data-nothing><h4>Nothing found</h3></div>') {
          trigger.show();
        }
      },
      complete: function () {
        
      }
    });
  }

}(jQuery));*/
