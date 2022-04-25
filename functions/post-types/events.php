<?php
// Events Post Type
add_action( 'init', function() {
    register_post_type('Events', [
        'labels' => [
            'name' => __('Events'),
            'singular_name' => __('Events'),
            'all_items' => __('All Events Items'),
            'new_item' => __('New Events Item'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Events Item'),
            'edit_item' => __('Edit Events Item'),
            'view_item' => __('View Events Item'),
            'search_items' => __('Search Events Items'),
            'not_found' => __('No Events Items found'),
            'not_found_in_trash' => __('No Events Items found in trash'),
            'parent_item_colon' => __('Parent Events Item'),
            'menu_name' => __('Events'),
        ],

        'public' => false,
        'hierarchical' => false,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_in_menu' => true,
        'supports' => array('title'),
        'has_archive' => false,
        'rewrite' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_rest' => true,
        'rest_base' => 'social_posts',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        
    ]);
    flush_rewrite_rules();
    register_taxonomy('event-category', [ strtolower(preg_replace('/\s/','_','Events')) ], [
        'hierarchical' => true,
        'public' => false,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => false,
        'rewrite' => false,
        'capabilities' => [
        'manage_terms'  => 'edit_posts',
        'edit_terms'    => 'edit_posts',
        'delete_terms'  => 'edit_posts',
        'assign_terms'  => 'edit_posts',
        ],
        'labels' => [
            'name' => __('Categories', 'pennthorpe'),
            'singular_name' => _x('Events category', 'taxonomy general name', 'pennthorpe'),
            'search_items' => __('Search event categories', 'pennthorpe'),
            'popular_items' => __('Popular event categories', 'pennthorpe'),
            'all_items' => __('All event categories', 'pennthorpe'),
            'parent_item' => __('Parent event category', 'pennthorpe'),
            'parent_item_colon' => __('Parent event category:', 'pennthorpe'),
            'edit_item' => __('Edit event category', 'pennthorpe'),
            'update_item' => __('Update event category', 'pennthorpe'),
            'add_new_item' => __('New event category', 'pennthorpe'),
            'new_item_name' => __('New event category', 'pennthorpe'),
            'separate_items_with_commas' => __('Separate event categories with commas', 'pennthorpe'),
            'add_or_remove_items' => __('Add or remove event categories', 'pennthorpe'),
            'choose_from_most_used' => __('Choose from the most used event categories', 'pennthorpe'),
            'not_found' => __('No event categories found.', 'pennthorpe'),
            'menu_name' => __('Categories', 'pennthorpe'),
        ],
        'show_in_rest' => true,
        'rest_base' => 'event-category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    ]);
});