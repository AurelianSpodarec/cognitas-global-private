<?php
// Blog Post Type
add_action( 'init', function() {
    register_post_type('Blog', [
        'labels' => [
        'name' => __('Blog'),
        'singular_name' => __('Blog'),
        'all_items' => __('All Blog Items'),
        'new_item' => __('New Blog Item'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Blog Item'),
        'edit_item' => __('Edit Blog Item'),
        'view_item' => __('View Blog Item'),
        'search_items' => __('Search Blog Items'),
        'not_found' => __('No Blog Items found'),
        'not_found_in_trash' => __('No Blog Items found in trash'),
        'parent_item_colon' => __('Parent Blog Item'),
        'menu_name' => __('Blog'),
        ],
        'public' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'supports' => [ 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-welcome-write-blog',
        'show_in_rest' => true,
        'rest_base' => 'blog', 
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);
});

add_filter( 'post_updated_messages', function ($messages ) {
    global $post;
    $permalink = get_permalink($post);
    $messages['Blog'] = [
      0 => '',
      1 => sprintf(__('Blog Item updated. <a target="_blank" href="%s">View Blog Items</a>'), esc_url($permalink)),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Blog Item updated.'),
      5 => isset($_GET['revision']) ? sprintf(__('Blog Items restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
      6 => sprintf(__('Blog Item published. <a href="%s">View Blog Items</a>'), esc_url($permalink)),
      7 => __('Blog Item saved.'),
      8 => sprintf(__('Blog Item submitted. <a target="_blank" href="%s">Preview Blog Item</a>'), esc_url(add_query_arg('preview', 'true', $permalink))),
      9 => sprintf(__('Blog Item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Blog Item</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url($permalink)),
      10 => sprintf(__('Blog Item draft updated. <a target="_blank" href="%s">Preview Blog Item</a>'), esc_url(add_query_arg('preview', 'true', $permalink))),
    ];
    return $messages;
});
