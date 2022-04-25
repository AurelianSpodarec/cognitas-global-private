<?php

add_action('login_enqueue_scripts', function () {
  ?>
  <style>
    .login #login h1 a {
      background-image: url('<?php echo esc_url(wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full')); ?>');
      background-size: contain;
      width: auto;
      max-height: 200px;
    }
  </style>
  <?php
});

add_filter('login_headerurl', function () {
  $site_url = home_url();

  return ($site_url);
});

// Allow to use background image in div
add_filter('safe_style_css', function ($styles) {
  $styles[] = 'background-image';

  return $styles;
});

// Remove standard wordpress menus that are not needed
add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
});

// Change the posts menu to "News"
add_action('admin_menu', function () {
  global $menu;
  global $submenu;
  $menu[5][0] = 'News';
  $submenu['edit.php'][5][0] = 'News';
  $submenu['edit.php'][10][0] = 'Add News';
});

add_action('init', function () {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
});

// Move pages to top of admin menu
add_action('admin_menu', function () {
  global $menu;
  $menu[6] = $menu[5];
  $menu[5] = $menu[20];
  unset($menu[20]);
});

// Add job opportunities links to breadcrumbs
add_filter('wpseo_breadcrumb_links', function ($links) {
  global $post;

  if (is_singular('vacancy')) {
    $secondary[] = [
      'url' => get_permalink(918),
      'text' => get_the_title(918),
    ];

    array_splice($links, 1, -2, $secondary);
  }

  return $links;
});


// Remove Youtube suggested videos
add_filter('oembed_result', function ($html, $url, $args) {
  $url_string = parse_url($url, PHP_URL_QUERY);
  parse_str($url_string, $id);

  if (isset($id['v'])) {
    return '<iframe width="' . $args['width'] . '" height="' . $args['height'] . '" src="//www.youtube.com/embed/' . $id['v'] . '?rel=0" frameborder="0" allowfullscreen></iframe>';
  }

  return $html;
},10,3);



// adding custom colours for text in tinymce
function dmw_custom_palette( $init ) {

$custom_colours = '"181b25", "Default", "0033a0", "Blue", "c5aa7e", "Gold" ';    

$init['textcolor_map'] = '['.$custom_colours.']';
 
return $init;

}

add_filter('tiny_mce_before_init', 'dmw_custom_palette');

add_filter('acf/load_value/key=field_595b637246ca4', 'default_download_repeater_rows', 20, 3);

function default_download_repeater_rows($value, $post_id, $field) {

  var_dump($value);
  exit;
  
  // If the value of this field has never been set then it will === false;
  if ($value !== false) {
    // the value is not false, so it has already been saved
    // do not regenerate this field
    return $value;
  }
  
  // get all editors
  // only get the user ID because this is what 
  // ACF needs to store for a user type field
  $args = array(
    'role' => 'editor',
    'fields' => 'ID'
  );
  $users = get_users($args);
  // make sure we got some users
  if (!$users) {
    // if not then no need to continue
    return $value;
  }
  
  // generate rows of the repeater
  
  // initialize array
  $value = array();
  
  foreach ($users as $user) {
    // add a row to the value for this user
    $value[] = array(
      // the first field is the user field
      // use the field key
      'field_567890' => $user,
      // the second field is a number field, but could be anything
      'field_876543' => 100 // assuming number field and default value
    );
  }
  
    
  // return the generated repeater
  return $value;
}