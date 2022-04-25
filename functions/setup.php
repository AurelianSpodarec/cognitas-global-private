<?php
/**
 * Theme setup
 */

add_action('after_setup_theme', function () {

  // Add WP Thumbnail Support.
  add_theme_support('post-thumbnails');

  // Add RSS Support.
  add_theme_support('automatic-feed-links');

  // Add Support for WP Controlled Title Tag.
  add_theme_support('title-tag');

  // Add Widgets Support.
  // add_theme_support('widgets');

  // Add HTML5 Support.
  add_theme_support('html5', [
    'comment-list',
    'comment-form',
    'search-form',
  ]);

  // Add Custom Header Support.
  add_theme_support('custom-logo', [
    'flex-width'  => true,
    'flex-height' => true,
    'uploads'     => true,
    'header-text' => false,
  ]);

  add_image_size('content-gallery', 1070, 713, true);
  add_image_size('texan-image', 555, 555, true); //Get it? Text and Image, Text 'n' Image, Texan Image... no? *sigh*
  add_image_size('homepage-header', 1815, 1083, true);
  add_image_size('full', 2048, 2048, false);
});