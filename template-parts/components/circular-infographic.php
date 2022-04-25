<?php
	$component_title = get_sub_field('component_title');
	$component_summary = get_sub_field('component_summary');
    $circular_infographic_items = get_sub_field('circular_infographic_items');
    $central_image = wp_get_attachment_image_src(get_sub_field('central_image'), 'full' );
?>

<?php if (!empty($circular_infographic_items)) : ?>
	<section class="circular-infographic full-width-component limit-inner-div-content">
		<div class="circular-infographic-content">
            <div class="component-title-wrapper">
                <h2 class="component-title"><?php echo $component_title; ?></h2>
                <?php if(!empty($component_summary)) : ?>
                    <p class="component-summary"><?php echo $component_summary; ?></p>
                <?php endif; ?>
            </div>
            <div class="circle-container-outer">
                <div class="central-image">
                    <img src="<?php echo $central_image[0]; ?>">
                </div>
                <div class="circle-container">
                    <?php foreach ($circular_infographic_items as $circular_infographic_item) {
                        $circular_infographic_title = $circular_infographic_item['circular_infographic_title'];
                        $circular_infographic_content = $circular_infographic_item['circular_infographic_content'];
                    ?>
                        <div class="circular-infographic-item">
                            <div class="circular-infographic-inner">
                                <h3><?php echo $circular_infographic_title; ?></h3>
                                <p><?php echo $circular_infographic_content; ?></p>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
		</div>
	</section>
<?php endif; ?>