$(document).on('ready', function () {

    if( $('.news-list__list').length ) {
  
      var pageNumber = 1;
      var perPage;
      var search;
      var sendData;
      var $loadMoreEntries = $('.js-load-entries');
      var $loadMoreEntriesContainer = $('.load-more-container');
      var $categoryTrigger = $('.js-category-item');
      var $searchTrigger = $('#js-list-search');
      var $searchInput = $('#listing-search-term');
      var $tagTrigger = $('.js-tag-item');
      var $container = $('.js-entries-container');
      var $dateSelect = $('.js-select-date');
      var $monthSelect = $('.js-select-month');
      var $yearSelect = $('.js-select-year');
  
      // load more button
      $loadMoreEntries.on('click', function (e) {
        e.preventDefault();
  
        loadResults();
        
        return false;
      }); 
  
      /*// change of date filter
      $dateSelect.on('change', function (e) {
  
        pageNumber = 0;
        
        $container.attr('data-page-num', 1);
        $container.attr('data-month', $monthSelect.val());
        $container.attr('data-year', $yearSelect.val());
  
        $container.empty();
  
        loadResults();
        
        return false;
      });
  
      // change of category
      $categoryTrigger.on('change', function (e) {
          pageNumber = 0;
        
          $container.attr('data-page-num', 1);
          $container.attr('data-category', $categoryTrigger.val());
  
          $container.empty();
  
          loadResults();
      });
  
      // on search
      $searchTrigger.submit(function( e ) {
          e.preventDefault();
  
          pageNumber = 0;
        
          $container.attr('data-page-num', 1);
  
          clearExcludeList();
  
          $container.empty();
  
          loadResults();
      });*/
  
      // change of tag
      /*$tagTrigger.click(function(e) {
  
          pageNumber = 0;
          $container.attr('data-page-num', 1);
  
          tagList = $container.attr('data-tag-list');
          tagValue = $(this).data("tag-id");
  
          if ($(this).prop('checked')) {
  
            // convert list to array then add selected value
            tagArray = JSON.parse("[" + tagList + "]");
            tagArray.push(tagValue);
  
            $container.attr('data-tag-list', tagArray);
          } else {
  
            // convert list to array then remove selected value
            tagArray = JSON.parse("[" + tagList + "]");
            tagArray = arrayRemove(tagArray, tagValue);
  
            $container.attr('data-tag-list', tagArray);
          }
  
          clearExcludeList();
  
          $container.empty();
  
          loadResults();
      });*/
  
      function checkNextNewsPage(perPage, pageNumber, category, tags, month, year, trigger) {
        var data = {};
  
        sendData = {
          action: 'news_ajax_handler',
          offset: pageNumber * perPage,
          per_page: perPage,
          search: search,
          category: category,
          tags: tags,
          month: month,
          year: year,
        };
  
        $.ajax({
          url: ajaxadminurl.ajaxurl,
          type: 'GET',
          data: sendData,
          dataType: 'html',
          cache: false,
          timeout: 10000,
          success: function (posts) {
            if (posts !== '<div class="nothing-found"><h4>No results found</h3></div>') {
              trigger.show();
            }
          },
          complete: function () {
            
          }
        });
      } 
  
      function loadResults() {
  
        category = $container.attr('data-category');
        tags = $container.attr('data-tag-list');
        perPage = $container.data('per-page');
        search = $searchInput.val();
        month = $monthSelect.val();
        year = $yearSelect.val();
  
        sendData = {
          action: 'news_ajax_handler',
          offset: pageNumber * perPage,
          per_page: perPage,
          search: search,
          category: category,
          tags: tags,
          month: month,
          year: year,
        };
  
        $.ajax({
          url: ajaxadminurl.ajaxurl,
          type: 'GET',
          data: sendData,
          dataType: 'html',
          cache: false,
          timeout: 10000,
          beforeSend: function () {
            $loadMoreEntriesContainer.hide();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $loadMoreEntriesContainer.remove();
          },
          success: function (data, textStatus, jqXHR) {
            var htmlData = $.parseHTML(jqXHR.responseText);
  
            $container.append(htmlData);
  
            $container.masonry('reloadItems');
            $container.masonry('layout');
  
            nextPageNumber = parseInt(pageNumber + 1);
  
            checkNextNewsPage(perPage, nextPageNumber, category, tags, month, year, $loadMoreEntriesContainer);
  
          },
          complete: function () {
            pageNumber += 1;
          }
        });
      }
  
      /*function arrayRemove(arr, value) {
  
         return arr.filter(function(ele){
             return ele != value;
         });
      }
  
      function clearExcludeList() {
        $container.attr('data-pinned-exclude-list', '');
      }*/
  
    }
  
});