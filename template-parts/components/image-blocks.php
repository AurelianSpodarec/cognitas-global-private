<?php
/**
 * Image Blocks
 *
 */

    $imageBlocks = get_sub_field('image_blocks');
    $blockCount = 1;
    $imageBlockCount = count($imageBlocks);
    $imageCountClass = " layout-".$imageBlockCount;
?>

<?php if (!empty($imageBlocks)) : ?>
    <section class="image-blocks">
        <div class="image-block-items-container<?php echo $imageCountClass; ?>">
            <div class="left-container">
                <?php foreach ($imageBlocks as $imageBlock) : ?>
                    <?php $background_url = wp_get_attachment_image_src($imageBlock['image'], 'large'); ?>
                    
                        <div class="image-block-item scroll-animations animated mso-fade-up">
                            <div class="image-block-image" style="background-image: url(<?php echo $background_url[0]; ?>);"></div>
                            <div class="bgOverlay"></div>
                            <div class="image-block-content">
                                <div class="component-title-wrapper">
                                    <?php if (!empty($imageBlock['Subtitle'])) : ?>
                                        <p class="component-subtitle"><?php echo esc_attr($imageBlock['Subtitle']); ?></p>
                                    <?php endif; ?>
                                    <h2 class="component-title image-block-title"><?php echo esc_attr($imageBlock['title']); ?></h2>
                                </div>
                            </div>
                            <a target="<?php echo $imageBlock['button']['target']; ?>" href="<?php echo $imageBlock['button']['url']; ?>"></a>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>