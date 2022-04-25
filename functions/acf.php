<?php

// ACF Cache
// add_filter('acf/settings/save_json', function ($path) {
//   $path = get_stylesheet_directory() . '/functions/acf';
//   return $path;
// });

// add_filter('acf/settings/load_json', function ($paths) {
//   unset($paths[0]);
//   $paths[] = get_stylesheet_directory() . '/functions/acf';
//   return $paths;
// });

// Options Pages for ACF
//For icons https://developer.wordpress.org/resource/dashicons/
if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title' => 'Site Settings',
    'menu_slug'  => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect'   => true,
  ]);
}
