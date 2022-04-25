<?php 
    function news_ajax_handler() {

      global $post;

      $offset = isset($_GET['offset']) ? intval($_GET['offset']) : null;
      $category = isset($_GET['category']) ? $_GET['category'] : null;
      $tags = isset($_GET['tags']) ? $_GET['tags'] : null;
      $pinned_exclude_list = isset($_GET['pinned_exclude_list']) ? $_GET['pinned_exclude_list'] : null;
      $post_type = isset($_GET['post_type']) ? sanitize_text_field(wp_unslash($_GET['post_type'])) : null;
      $posts_per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : null;
      $search = isset($_GET['search']) ? sanitize_text_field(wp_unslash($_GET['search'])) : '';
      $month = isset($_GET['month']) ? intval($_GET['month']) : null;
      $year = isset($_GET['year']) ? intval($_GET['year']) : null;

      // start buffer
      ob_start();

      /*if ($tags !== "") {
          $news_results = new WP_Query( array (
              'posts_per_page' => $posts_per_page,
              'post_status' => 'publish',
              'orderby' => 'date',
              'order' => 'DESC',
              'offset' => $offset,
              's' => !empty($search) ? $search : '',
              'tax_query' => array(
                  'relation' => 'AND',
                  array (
                      'taxonomy' => 'category',
                      'field' => 'term_id',
                      'terms' => $category,
                  ),
                  array(
                      'taxonomy' => 'post_tag',
                      'field' => 'term_taxonomy_id',
                      'terms' => $tagArray,
                  )
              )
          ) );
      } else {
          $news_results = new WP_Query( array (
              'posts_per_page' => $posts_per_page,
              'post_status' => 'publish',
              'orderby' => 'date',
              'order' => 'DESC',
              'offset' => $offset,
              's' => !empty($search) ? $search : '',
              'post__not_in' => $pinnedExcludeListArray,
              'tax_query' => array(
                  array (
                      'taxonomy' => 'category',
                      'field' => 'term_id',
                      'terms' => $category,
                  )
              )
          ) );
      }*/

      $news_results = new WP_Query( array (
        'posts_per_page' => $posts_per_page,
        'monthnum' => $month,
        'year' => $year,
        'offset' => $offset,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array (
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $category,
            )
        )
      ) );

      if ($news_results->have_posts()) {
        while ($news_results->have_posts()) : $news_results->the_post();
            get_template_part('template-parts/partials/news', 'item');
        endwhile;
      } else {
        echo '<div class="nothing-found"><h4>No results found</h3></div>';
      }
      echo ob_get_clean();
      exit;
    }

    add_action('wp_ajax_news_ajax_handler', 'news_ajax_handler');
    add_action('wp_ajax_nopriv_news_ajax_handler', 'news_ajax_handler');
?>