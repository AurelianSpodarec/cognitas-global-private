<?php
/**
 * Author: benbodhi
 * https://wordpress.org/plugins/svg-support/
 */

add_filter('upload_mimes', function ($mimes = []) {
  global $svg_options;

  if (empty($svg_options['restrict']) || current_user_can('administrator')) {
    // allow SVG file upload
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
  } else {
    return $mimes;
  }
});

add_action('admin_init', function () {

  ob_start();

  add_action('shutdown', function () {

    $final = '';
    $ob_levels = ob_get_level();

    for ($i = 0; $i < $ob_levels; $i++) {
      $final .= ob_get_clean();
    }

    echo apply_filters('final_output', $final);
  }, 0);

  add_filter('final_output', function ($content) {

    $content = str_replace(
      '<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
      '<# } else if ( \'svg+xml\' === data.subtype ) { #>
        <img class="details-image" src="{{ data.url }}" draggable="false" />
        <# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
      $content
    );

    $content = str_replace(
      '<# } else if ( \'image\' === data.type && data.sizes ) { #>',
      '<# } else if ( \'svg+xml\' === data.subtype ) { #>
        <div class="centered">
          <img src="{{ data.url }}" class="thumbnail" draggable="false" />
        </div>
        <# } else if ( \'image\' === data.type && data.sizes ) { #>',
      $content
    );

    return $content;
  });
});
