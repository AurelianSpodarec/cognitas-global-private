<?php
if (!function_exists('theme_pagination')) :
  function theme_pagination() {
    global $wpdb, $wp_query;

    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;

    if ($numposts <= $posts_per_page) {
      return;
    }

    if (empty($paged) || $paged === 0) {
      $paged = 1;
    }

    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;

    if ($start_page <= 0) {
      $start_page = 1;
    }

    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) !== $pages_to_show_minus_1) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }

    if ($end_page > $max_page) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }

    if ($start_page <= 0) {
      $start_page = 1;
    }

    echo '<nav class="pagination"><ul class="pagination-list">';

    if ($start_page >= 2 && $pages_to_show < $max_page) {
      $first_page_text = __('First');
      echo '<li class="pagination-item pagination-item--first"><a href="' . esc_html(get_pagenum_link()) . '" title="' . esc_html($first_page_text) . '">' . esc_html($first_page_text) . '</a></li>';
    }

    if (get_previous_posts_link()) {
      echo '<li class="pagination-item pagination-item--previous">';
      previous_posts_link(__('Previous'));
      echo '</li>';
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
      if ($i === $paged) {
        echo '<li class="pagination-item pagination-item--current"> ' . esc_html($i) . ' </li>';
      } else {
        echo '<li class="pagination-item"><a href="' . esc_html(get_pagenum_link($i)) . '">' . esc_html($i) . '</a></li>';
      }
    }

    if (get_next_posts_link()) {
      echo '<li class="pagination-item pagination-item--next">';
      next_posts_link(__('Next'), 0);
      echo '</li>';
    }

    if ($end_page < $max_page) {
      $last_page_text = __('Last');
      echo '<li class="pagination-item pagination-item--last"><a href="' . esc_html(get_pagenum_link($max_page)) . '" title="' . esc_html($last_page_text) . '">' . esc_html($last_page_text) . '</a></li>';
    }

    echo '</ul></nav>';
  }
endif;
