<?php
// Vacancies Post Type
add_action( 'init', function() {
    register_post_type('Vacancies', [
        'labels' => [
        'name' => __('Vacancies'),
        'singular_name' => __('Vacancy'),
        'all_items' => __('All Vacancies'),
        'new_item' => __('New Vacancy'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Vacancy'),
        'edit_item' => __('Edit Vacancy'),
        'view_item' => __('View Vacancy'),
        'search_items' => __('Search Vacancy'),
        'not_found' => __('No vacancy found'),
        'not_found_in_trash' => __('No vacancy found in trash'),
        'parent_item_colon' => __('Parent vacancies'),
        'menu_name' => __('Vacancies'),
        ],
        'public' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'supports' => ['title'],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-businessman',
        'show_in_rest' => true,
        'rest_base' => 'vacancies',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);
});

add_filter( 'post_updated_messages', function ($messages ) {
    global $post;
    $permalink = get_permalink($post);
    $messages['Vacancies'] = [
      0 => '',
      1 => sprintf(__('Vacancies updated. <a target="_blank" href="%s">View vacancies</a>'), esc_url($permalink)),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Vacancies updated.'),
      5 => isset($_GET['revision']) ? sprintf(__('Vacancies restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
      6 => sprintf(__('Vacancies published. <a href="%s">View vacancies</a>'), esc_url($permalink)),
      7 => __('Vacancies saved.'),
      8 => sprintf(__('Vacancies submitted. <a target="_blank" href="%s">Preview vacancies</a>'), esc_url(add_query_arg('preview', 'true', $permalink))),
      9 => sprintf(__('Vacancies scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview vacancies</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url($permalink)),
      10 => sprintf(__('Vacancies draft updated. <a target="_blank" href="%s">Preview vacancies</a>'), esc_url(add_query_arg('preview', 'true', $permalink))),
    ];
    return $messages;
});
