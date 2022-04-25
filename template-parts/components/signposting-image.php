<?php
/**
 * Signposting /  image
 *
 */

    $signposting_title = get_sub_field('signposting_title');
    $signposting_link = get_sub_field('signposting_link');
    $signposting_image = get_sub_field('signposting_image');
    $signposting_image_url = wp_get_attachment_image_src($signposting_image, 'full');
?>

<?php if(!empty($signposting_image)) : ?>
    <section class="signposting-image">
        <div class="signposting-image-background">
            <img src="<?php echo $signposting_image_url[0]; ?>">
            <?php if(!empty($signposting_title)) : ?>
                <h2 class="signposting-image-title"><?php echo $signposting_title; ?></h2>
            <?php endif; ?>
            <?php if(!empty($signposting_link)) : ?>
                <a href="<?php echo $signposting_link['url']; ?>" target="<?php echo $signposting_link['url']; ?>"></a>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>