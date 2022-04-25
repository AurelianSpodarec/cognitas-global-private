<?php

add_action('rest_api_init', 'rest_api_custom_params');
/**
 * Add the necessary filter to each post type
 */
if (!function_exists('rest_api_custom_params')) {
  function rest_api_custom_params() {
    foreach (get_post_types([ 'show_in_rest' => true ], 'objects') as $post_type) {
      add_filter('rest_' . $post_type->name . '_query', 'rest_api_add_custom_param', 10, 2);
    }

    add_filter('rest_events_query', function ($args, $request) {
      $today = date('Y-m-d');

      $args['post_status'] = [ 'publish', 'future' ];

      if (!$args['meta_query']['eventByDate'] && !$request['event_category']) {
        $args['meta_query']['relation'] = 'AND';
        $args['meta_query']['startDateClause']['key'] = 'event_start_date';
        $args['meta_query']['startDateClause']['value'] = $today;
        $args['meta_query']['startDateClause']['compare'] = '>=';
        $args['orderby'] = ['startDateClause' => 'ASC'];
      }

      return $args;
    }, 10, 2);

  }
}

/**
 * Add the custom parameter
 */
if (!function_exists('rest_api_add_custom_param')) {
  function rest_api_add_custom_param($args, $request) {
    if (empty($request['monthnum']) && empty($request['year']) && empty($request['meta_query'])) {
      return $args;
    }

    if ((int) $request['monthnum']) {
      $args['monthnum'] = $request['monthnum'];
    }

    if ((int) $request['year']) {
      $args['year'] = $request['year'];
    }

    if ($request['meta_query']) {
      $args['meta_query'] = $request['meta_query'];
    }
    return $args;
  }
}

/**
 * Add custom data to posts result
 */
add_filter('rest_prepare_post', function ($data, $post, $context) {
  if ($context !== 'view' || is_wp_error($data)) {
    $data->data['formated_date'] = date('d.m.Y', strtotime($data->data['date']));
    $data->data['short_description'] = get_field('short_description');
    $data->data['thumbnail_url'] = wp_get_attachment_image_src($data->data['featured_media'], 'news-feed-thumbnail')[0];
    $data->data['thumbnail_placeholder_url'] = wp_get_attachment_image_src(854, 'news-feed-thumbnail')[0];

    return $data;
  }
}, 12, 3);

/**
 * Add custom data to staff result
 */
add_filter('rest_prepare_staff', function ($data, $post, $context) {
  if ($context !== 'view' || is_wp_error($data)) {
    $previous_post = get_adjacent_post(true, '', false, 'staff_category');
    $next_post = get_adjacent_post(true, '', true, 'staff_category');

    $data->data['content'] = get_the_content();
    $data->data['position'] = get_field('position');
    $data->data['thumbnail_url'] = wp_get_attachment_image_src($data->data['featured_media'], 'staff-thumbnail')[0];
    $data->data['thumbnail_modal_url'] = wp_get_attachment_image_src($data->data['featured_media'], 'staff-modal-thumbnail')[0];
    $data->data['pagination']['previous'] = esc_attr(sanitize_title($previous_post->post_title));
    $data->data['pagination']['next'] = esc_attr(sanitize_title($next_post->post_title));

    return $data;
  }
}, 12, 3);


/**
 * Add custom data to pa result
 */
add_filter('rest_prepare_pa', function ($data, $post, $context) {
  if ($context !== 'view' || is_wp_error($data)) {
    $previous_post = get_adjacent_post(true, '', false, 'pa_category');
    $next_post = get_adjacent_post(true, '', true, 'pa_category');

    $data->data['content'] = get_the_content();
    $data->data['position'] = get_field('position');
    $data->data['thumbnail_url'] = wp_get_attachment_image_src($data->data['featured_media'], 'pa-thumbnail')[0];
    $data->data['thumbnail_modal_url'] = wp_get_attachment_image_src($data->data['featured_media'], 'pa-modal-thumbnail')[0];
    $data->data['pagination']['previous'] = esc_attr(sanitize_title($previous_post->post_title));
    $data->data['pagination']['next'] = esc_attr(sanitize_title($next_post->post_title));

    return $data;
  }
}, 12, 3);

/**
 * Add custom data to image result
 */
add_filter('rest_prepare_image', function ($data, $post, $context) {
  if ($context !== 'view' || is_wp_error($data)) {
    $data->data['thumbnail_url'] = wp_get_attachment_image_src($data->data['featured_media'], 'staff-thumbnail')[0];

    return $data;
  }
}, 12, 3);

/**
 * Add custom data to events result
 */
add_filter('rest_prepare_events', function ($data, $post, $context) {
  if ($context !== 'view' || is_wp_error($data)) {
    $start_date = get_post_meta(get_the_ID(), 'event_start_date', true);
    $start_time = get_post_meta(get_the_ID(), 'event_start_time', true);
    $formated_date = DateTime::createFromFormat('Y-m-d', $start_date);

    $data->data['formated_date'] = $formated_date->format('d.m.Y');
    $data->data['formated_time'] = $start_time;
    $data->data['venue'] = get_post_meta(get_the_ID(), 'venue_name', true);
    $data->data['summary'] = get_post_meta(get_the_ID(), 'event_summary', true);

    return $data;
  }
}, 12, 3);


?>