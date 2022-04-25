<?php
/**
 * Sub Navigation Anchor Component
**/

    $subnav_title = get_sub_field('navigation_title');
    $subnav_id = 'anchor-'.str_replace(' ', '-', strtolower($subnav_title));
?>

<div id="<?php echo $subnav_id; ?>" class="dynamic-subnav-anchor-point"></div>