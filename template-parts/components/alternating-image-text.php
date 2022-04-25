<?php
/**
 * Alternating Images and Text
 *
 * @field repeater 'alternating_image_text'
 */
	$component_title = get_sub_field('component_title');
	$alternating_image_text = get_sub_field('alternating_image_text');
?>
<?php if (!empty($alternating_image_text)) : ?>
	<section class="alternating_image_text full-width-component limit-inner-div-content">
        <div>
            <?php if(!empty($component_title)) : ?>
                <div class="component-title-wrapper">
                    <h2 class="component-title"><?php echo $component_title; ?></h2>
                </div>
            <?php endif; ?>
            <?php if ( have_rows( 'alternating_image_text' ) ) : ?>
                <div class="alternating_image_text-inner">
                    <?php foreach ($alternating_image_text as $alternating_item) : ?>
                        <?php $image = wp_get_attachment_image_src($alternating_item['image'], 'large' ); ?>
                        <div class="alternating_image_text-item">
                            <div class="alternating_image_text-image">
                                <img src="<?php echo $image[0]; ?>">
                            </div>
                            <div class="alternating_image_text-text">
                                <h3><?php echo $alternating_item['title']; ?></h3>
                                <div class="alternating-content">
                                    <?php echo $alternating_item['text']; ?>
                                </div>
                                <?php if (!empty($alternating_item['read_more_link'])) : ?>
                                    <a href="<?php echo $alternating_item['read_more_link']['url']; ?>" class="read-more" target="<?php echo $alternating_item['read_more_link']['target']; ?>"><?php echo $alternating_item['read_more_link']['title']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
	</section>
<?php endif; ?>
