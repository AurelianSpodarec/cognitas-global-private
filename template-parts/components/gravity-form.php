<?php
/**
 * Gravity Form Component
*/

    $component_title = get_sub_field('form_title');
    $form_id = get_sub_field('form_id');

?>

<section class="gravity-form-component">
	<div class="gravity-form-wrapper wrapper">
            <div class="gravity-form-content">
			<?php if(!empty($component_title)) : ?>
				<div class="component-title-wrapper">
					<h2 class="component-title"><?php echo $component_title; ?></h2>
				</div>
			<?php endif; ?>
            <?php echo do_shortcode('[gravityform id='.$form_id.' title=false description=false ajax=true]'); ?>
        </div>
    </div>
</section>