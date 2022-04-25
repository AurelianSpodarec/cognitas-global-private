<?php
// Fire all our initial functions at the start
add_action('after_setup_theme', function () {
  // launching operation cleanup
  add_action('init', 'cleanup_head');

  // remove pesky injected css for recent comments widget
  add_filter('wp_head', 'remove_wp_widget_recent_comments_style', 1);

  // clean up comment styles in the head
  add_action('wp_head', 'remove_recent_comments_style', 1);

  // clean up gallery output in wp
  add_filter('gallery_style', 'remove_gallery_style');

  // disable default dashboard widgets
  add_action('admin_menu', 'disable_default_dashboard_widgets');

  // disable emoji
  add_action('init', 'disable_wp_emoji');
}, 16);

if (!function_exists('cleanup_head')) :
  function cleanup_head() {
    // Remove category feeds
    remove_action('wp_head', 'feed_links_extra', 3);
    // Remove post and comment feeds
    remove_action('wp_head', 'feed_links', 2);
    // Remove EditURI link
    remove_action('wp_head', 'rsd_link');
    // Remove Windows live writer
    remove_action('wp_head', 'wlwmanifest_link');
    // Remove index link
    remove_action('wp_head', 'index_rel_link');
    // Remove previous link
    remove_action('wp_head', 'parent_post_rel_link', 10);
    // Remove start link
    remove_action('wp_head', 'start_post_rel_link', 10);
    // Remove links for adjacent posts
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    // Remove WP version
    remove_action('wp_head', 'wp_generator');
  }
endif;

if (!function_exists('remove_wp_widget_recent_comments_style')) :
  function remove_wp_widget_recent_comments_style() {
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style');
    }
  }
endif;

if (!function_exists('remove_recent_comments_style')) :
  function remove_recent_comments_style() {
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
      remove_action('wp_head', [ $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ]);
    }
  }
endif;

if (!function_exists('remove_gallery_style')) :
  function remove_gallery_style($css) {
    return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
  }
endif;

if (!function_exists('disable_default_dashboard_widgets')) :
  function disable_default_dashboard_widgets() {
    remove_meta_box('dashboard_right_now', 'dashboard', 'core'); // Right Now Widget
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core'); // Incoming Links Widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'core'); // Plugins Widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core'); // Quick Press Widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core'); // Recent Drafts Widget
    remove_meta_box('dashboard_primary', 'dashboard', 'core');  //
    remove_meta_box('dashboard_secondary', 'dashboard', 'core'); //
    remove_meta_box('yoast_db_widget', 'dashboard', 'normal'); // Yoast's SEO Plugin Widget
  }
endif;

if (!function_exists('disable_wp_emoji')) :
  function disable_wp_emoji() {
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('tiny_mce_plugins', 'disable_emoji_tinymce');
  }
endif;

if (!function_exists('disable_emoji_tinymce')) :
  function disable_emoji_tinymce($plugins) {
    if (is_array($plugins)) {
      return array_diff($plugins, [ 'wpemoji' ]);
    } else {
      return [];
    }
  }
endif;
