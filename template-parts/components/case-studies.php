<?php
	$component_title = get_sub_field('component_title');
	$component_summary = get_sub_field('component_summary');
	$component_background_colour = get_sub_field('component_background_colour');
    $case_studies = get_sub_field('case_studies');
?>
<?php if (!empty($case_studies)) : ?>
	<section class="case-studies full-width-component limit-inner-div-content <?php echo $component_background_colour;?>-bg">
		<div class="case-studies-content">
            <div class="component-title-wrapper">
                <h2 class="component-title"><?php echo $component_title; ?></h2>
                <?php if(!empty($component_summary)) : ?>
                    <p class="component-summary"><?php echo $component_summary; ?></p>
                <?php endif; ?>
            </div>
            <div class="case-studies-slider-container">
                <div id="caseStudiesSlider" class="slider-holder">
                    <div class="case-studies-slider js-case-studies-slider">
                        <?php foreach ($case_studies as $case_study) {
                            $post = $case_study;
                            setup_postdata( $case_study );

                            if(has_post_thumbnail()) {
                                $thumbnail = get_the_post_thumbnail_url('','large');
                            } else {
                                global $theme_settings;
                                $default_header_section = current($theme_settings['default_header_section']);
                                $default_header_image = $default_header_section["default_case_study_image"];
                                $thumbnail = wp_get_attachment_image_url($default_header_image, 'large');
                            };
                            $summary_text = get_field('summary');
                        ?>
                            <div class="case-studies-item">
                                <div class="case-study-image" style="background-image: url('<?php echo $thumbnail; ?>');"></div>
                                <div class="case-study-content">
                                    <h4><?php the_title(); ?></h4>
                                    <p><?php echo $summary_text; ?></p>
                                    <span class="case-study-link">Read more</span>
                                </div>
                                <a class="case-study-container-link" href="<?php the_permalink(); ?>"></a>
                            </div>
                        <?php 
                            }
                            wp_reset_postdata(); 
                        ?>
                    </div>
                </div>
            </div>
		</div>
	</section>
<?php endif; ?>