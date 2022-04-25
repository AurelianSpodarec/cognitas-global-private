<?php 
/* Returns a list of pages that match a queried template file name
 *  $template (required) is the template file name (E.G. template-my-page.php)
 *  $args (optional) uses the same arguments as get_pages() as seen in the return below:
 *  https://codex.wordpress.org/Function_Reference/get_pages
 *  $args = array(
    'sort_order' => 'asc',
    'sort_column' => 'post_title',
    'hierarchical' => 1,
    'exclude' => '',
    'include' => '',
    'meta_key' => '',
    'meta_value' => '',
    'authors' => '',
    'child_of' => 0,
    'parent' => -1,
    'exclude_tree' => '',
    'number' => '',
    'offset' => 0,
    'post_type' => 'page',
    'post_status' => 'publish'
   ); 
 */
function get_pages_by_template( $template = '', $args = array() ) {
  if ( empty($template) ) return false;
  if ( strpos($template, '.php') !== (strlen($template) - 4) )  $template .= '.php';
  $args['meta_key'] = '_wp_page_template';
  $args['meta_value'] = $template;
  return get_pages($args);
}