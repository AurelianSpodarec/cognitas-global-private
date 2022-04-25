<?php
/**
 * Title - Content - Buttons
 *
 */

    $component_title = get_sub_field('component_title');
    $component_subtitle = get_sub_field('component_subtitle');
    $component_content = get_sub_field('content');
    $buttons = get_sub_field('buttons');
?>

<?php if (!empty($component_title)) : ?>
    <section class="title-content-buttons full-width-component limit-inner-div-content">
        <div>
            <div class="component-title-wrapper">
                <?php if(!empty($component_title)) : ?>
                    <h2 class="component-title"><?php echo $component_title; ?></h2>
                <?php endif; ?>
                <?php if(!empty($component_subtitle)) : ?>
                    <p class="component-subtitle"><?php echo $component_subtitle; ?></p>
                <?php endif; ?>
            </div>
            <?php if(!empty($component_content)) : ?>
                <div class="component-content">
                    <?php echo $component_content; ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($buttons)) : ?>
                <div class="button-holder">
                    <?php $buttonClass = ' fill-pink'; ?>
                    <?php foreach ($buttons as $button) : ?>
                        <a href="<?php echo $button['button']['url']; ?>" class="button <?php echo $buttonClass; ?> animate-button grow" target="<?php echo $button['button']['target']; ?>"><?php echo $button['button']['title']; ?></a>
                        <?php $buttonClass = ' fill-blue'; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>