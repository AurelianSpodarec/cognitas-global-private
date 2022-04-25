<?php
	$component_title = get_sub_field('component_title');
	$component_summary = get_sub_field('component_summary');
	$component_style = get_sub_field('component_style');
    $timeline_items = get_sub_field('timeline_items');
    $timeline_counter = 1;
?>

<?php if (!empty($timeline_items)) : ?>
	<section class="numbered-timeline bbb full-width-component limit-inner-div-content <?php echo $component_style; ?>-container">
		<div class="numbered-timeline-content">
            <div class="component-title-wrapper">
                <h2 class="component-title"><?php echo $component_title; ?></h2>
                <?php if(!empty($component_summary)) : ?>
                    <p class="component-summary"><?php echo $component_summary; ?></p>
                <?php endif; ?>
            </div>
            <div class="numbered-timeline-items <?php echo $component_style; ?>-style">
                <?php foreach ($timeline_items as $timeline_item) {
                    $timeline_title = $timeline_item['timeline_title'];
                    $timeline_content = $timeline_item['timeline_content'];
                ?>
                    <div class="numbered-timeline-item">
                        <span class="line"></span>
                        <span class="line2"></span>
                        <span class="number"><?php echo $timeline_counter; ?></span>
                        <div class="numbered-timeline-inner">
                            <h3 class="l5-timeline__title"><?php echo $timeline_title; ?></h3>
                            <p class="l5-timeline__desc"><?php echo $timeline_content; ?></p>
                        </div>
                    </div>
                <?php 
                    $timeline_counter++;
                    }
                ?>
            </div>
		</div>
	</section>
<?php endif; ?>