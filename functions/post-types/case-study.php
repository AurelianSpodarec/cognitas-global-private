<?php
function casestudy_init() {
  register_post_type('casestudy', [
    'labels' => [
      'name' => __('Case Studies', 'mso'),
      'singular_name' => __('Case Study', 'mso'),
      'all_items' => __('All Case Studies', 'mso'),
      'new_item' => __('New Case Study', 'mso'),
      'add_new' => __('Add New', 'mso'),
      'add_new_item' => __('Add New Case Study', 'mso'),
      'edit_item' => __('Edit Case Study', 'mso'),
      'view_item' => __('View Case Study', 'mso'),
      'search_items' => __('Search Case Studies', 'mso'),
      'not_found' => __('No Case Studies found', 'mso'),
      'not_found_in_trash' => __('No Case Studies found in trash', 'mso'),
      'parent_item_colon' => __('Parent Case Study', 'mso'),
      'menu_name' => __('Case Studies', 'mso'),
    ],
    'public' => true,
    'hierarchical' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'supports' => [ 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ],
    'has_archive' => true,
    'rewrite' => true,
    'query_var' => true,
    'menu_icon' => 'dashicons-screenoptions',
    'show_in_rest' => true,
    'rest_base' => 'casestudy',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
  ]);
}

add_action('init', 'casestudy_init');

function casestudy_updated_messages($messages) {
  global $post;

  $permalink = get_permalink($post);

  $messages['casestudy'] = [
    0 => '',
    1 => sprintf(__('Case Study updated. <a target="_blank" href="%s">View Case Study</a>', 'mso'), esc_url($permalink)),
    2 => __('Custom field updated.', 'mso'),
    3 => __('Custom field deleted.', 'mso'),
    4 => __('Case Study updated.', 'mso'),
    5 => isset($_GET['revision']) ? sprintf(__('Case Study restored to revision from %s', 'mso'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
    6 => sprintf(__('Case Study published. <a href="%s">View Case Study</a>', 'mso'), esc_url($permalink)),
    7 => __('Case Study saved.', 'mso'),
    8 => sprintf(__('Case Study submitted. <a target="_blank" href="%s">Preview Case Study</a>', 'mso'), esc_url(add_query_arg('preview', 'true', $permalink))),
    9 => sprintf(__('Case Study scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Case Study</a>', 'mso'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url($permalink)),
    10 => sprintf(__('Case Study draft updated. <a target="_blank" href="%s">Preview Case Study</a>', 'mso'), esc_url(add_query_arg('preview', 'true', $permalink))),
  ];

  return $messages;
}

add_filter('post_updated_messages', 'casestudy_updated_messages');
