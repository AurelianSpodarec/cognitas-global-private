<?php
/**
 * Text over image
 *
 */

    $show_scroll_animation = get_sub_field('show_scroll_animation');
    $text = get_sub_field('text');
    $text_position = get_sub_field('text_position');
    $background_image = get_sub_field('background_image');
    $background_image_url = wp_get_attachment_image_src($background_image, 'full');
?>

<section class="text-over-image full-width-component<?php if(!$show_scroll_animation) { echo ' disable-scroll-animation'; } ?><?php if(empty($background_image)) { echo ' no-image-assigned'; } ?>">
    <div class="text-over-image-background<?php echo ' text-'.$text_position; ?><?php if(empty($text)) : echo ' hide-blue-bg'; endif; ?>" style="background-image: url(<?php echo $background_image_url[0]; ?>);">
        <?php if(!empty($text)) : ?>    
            <h2 class="text-over-image-title"><?php echo $text; ?></h2>
        <?php endif; ?>
    </div>
</section>