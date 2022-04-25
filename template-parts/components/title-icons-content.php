<?php
/**
 * Title - Icons - Content
 *
 */

    $component_title = get_sub_field('component_title');
    $component_subtitle = get_sub_field('component_subtitle');
    $icons = get_sub_field('icons');
    $component_content = get_sub_field('component_bottom_content');
?>

<?php if (!empty($icons)) : ?>
    <section class="title-icons-content full-width-component limit-inner-div-content">
        <div>
            <div class="component-title-wrapper">
                <h2 class="component-title"><?php echo $component_title; ?></h2>
                <?php if(!empty($component_subtitle)) : ?>
                    <p class="component-subtitle"><?php echo $component_subtitle; ?></p>
                <?php endif; ?>
            </div>
            <div class="icon-items-container">
                <?php foreach ($icons as $icon) : ?>
                    <?php $icon_image_url = wp_get_attachment_image_src($icon['icon'], 'full'); ?>
                    <div class="icon-item">
                        <div class="icon-image-container">
                            <img class="icon-image" src="<?php echo $icon_image_url[0];?>">
                        </div>
                        <p class="icon-title"><?php echo $icon['text']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if(!empty($component_content)) : ?>
                <div class="component-content">
                    <?php echo $component_content; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>