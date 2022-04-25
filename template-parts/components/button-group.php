<?php
/**
 * Button Group
 *
 */

    $buttons = get_sub_field('buttons');
    $buttonCount = 1;
    $buttonClass = ' fill-blue';
?>

<?php if (!empty($buttons)) : ?>
    <section class="button-group full-width-component limit-inner-div-content">
        <div>
            <?php if(!empty($buttons)) : ?>
                <div class="button-holder">
                    <?php foreach ($buttons as $button) : ?>
                        <a href="<?php echo $button['button']['url']; ?>" class="button <?php echo $buttonClass; ?> animate-button grow" target="<?php echo $button['button']['target']; ?>"><?php echo $button['button']['title']; ?></a>
                        <?php if ($buttonCount === 1) :
                            $buttonClass = ' fill-pink';
                            $buttonCount = 2;
                        else :
                            $buttonClass = ' fill-blue';
                        endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>