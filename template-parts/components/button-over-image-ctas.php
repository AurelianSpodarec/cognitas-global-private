

<?php
/**
 * Button Over Image CTAs
 *
 */

    $call_to_actions = get_sub_field('call_to_actions');
    $buttonClass = ' fill-blue';
?>

<?php if(!empty($call_to_actions)) : ?>
    <section class="button-over-image-ctas full-width-component">
        <div class="button-over-image-ctas-container">
            <?php foreach ($call_to_actions as $call_to_action_item) : ?>
                <?php
                    $text = $call_to_action_item['text'];
                    $button = $call_to_action_item['button'];
                    $background_image = $call_to_action_item['background_image'];
                    $background_image_url = wp_get_attachment_image_src($background_image, 'full');
                ?>
                <div class="button-over-image-ctas-item" style="background-image: url(<?php echo $background_image_url[0]; ?>);">
                    <h2 class="button-over-image-ctas-title"><?php echo $text; ?></h2>
                    <div class="button-holder">
                        <a href="<?php echo $button['url']; ?>" class="button<?php echo $buttonClass; ?> animate-button grow" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
                    </div>
                </div>
                <?php $buttonClass = ' fill-pink'; ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>