<?php

function blog_category_init() {
  register_taxonomy('blog_category', [ 'blog' ], [
    'hierarchical' => true,
    'public' => true,
    'show_in_nav_menus' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => true,
    'capabilities' => [
      'manage_terms'  => 'edit_posts',
      'edit_terms'    => 'edit_posts',
      'delete_terms'  => 'edit_posts',
      'assign_terms'  => 'edit_posts',
    ],
    'labels' => [
      'name' => __('Categories', 'pennthorpe'),
      'singular_name' => _x('Blog category', 'taxonomy general name', 'pennthorpe'),
      'search_items' => __('Search blog categories', 'pennthorpe'),
      'popular_items' => __('Popular blog categories', 'pennthorpe'),
      'all_items' => __('All blog categories', 'pennthorpe'),
      'parent_item' => __('Parent blog category', 'pennthorpe'),
      'parent_item_colon' => __('Parent blog category:', 'pennthorpe'),
      'edit_item' => __('Edit blog category', 'pennthorpe'),
      'update_item' => __('Update blog category', 'pennthorpe'),
      'add_new_item' => __('New blog category', 'pennthorpe'),
      'new_item_name' => __('New blog category', 'pennthorpe'),
      'separate_items_with_commas' => __('Separate blog categories with commas', 'pennthorpe'),
      'add_or_remove_items' => __('Add or remove blog categories', 'pennthorpe'),
      'choose_from_most_used' => __('Choose from the most used blog categories', 'pennthorpe'),
      'not_found' => __('No blog categories found.', 'pennthorpe'),
      'menu_name' => __('Categories', 'pennthorpe'),
    ],
    'show_in_rest' => true,
    'rest_base' => 'blog_category',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
  ]);

}
add_action('init', 'blog_category_init');
