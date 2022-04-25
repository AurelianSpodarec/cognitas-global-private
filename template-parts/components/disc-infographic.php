<?php
	$component_title = get_sub_field('component_title');
	$component_summary = get_sub_field('component_summary');
    $disc_infographic_items = get_sub_field('disc_infographic_items');
?>

<?php if (!empty($disc_infographic_items)) : ?>
	<section class="disc-infographic full-width-component limit-inner-div-content">
		<div class="disc-infographic-content">
            <div class="component-title-wrapper">
                <h2 class="component-title"><?php echo $component_title; ?></h2>
                <?php if(!empty($component_summary)) : ?>
                    <p class="component-summary"><?php echo $component_summary; ?></p>
                <?php endif; ?>
            </div>
            <div class="disc-infographic-items">
                <?php foreach ($disc_infographic_items as $disc_infographic_item) {
                    $disc_infographic_title = $disc_infographic_item['disc_infographic_title'];
                    $disc_infographic_content = $disc_infographic_item['disc_infographic_content'];
                    $disc_infographic_image = wp_get_attachment_image_src($disc_infographic_item['image'], 'full' );
                ?>
                    <div class="disc-infographic-item">
                        <img class="disc-image" src="<?php echo $disc_infographic_image[0]; ?>">
                        <span class="line"></span>
                        <span class="disc"></span>
                        <div class="disc-infographic-inner">
                            <h3 class="disc-infographic-inner__title"><?php echo $disc_infographic_title; ?></h3>
                            <p class="disc-infographic-inner__desc"><?php echo $disc_infographic_content; ?></p>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
		</div>
	</section>
<?php endif; ?>