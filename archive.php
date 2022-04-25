<?php
$p = get_post_type();
$site_url = get_site_url().'/news/';
if($p == 'post'):
    header('Location: '.$site_url.'/news/');
elseif($p == 'projects'):
    global $theme_settings;
    $back_to_page = $theme_settings['back_to_links'][0]['projects_link'];
    header('Location: '.get_the_permalink($back_to_page->ID));
endif;
?>