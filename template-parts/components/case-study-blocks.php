<?php
    $case_studies = get_sub_field('case_studies');
?>
<?php if (!empty($case_studies)) : ?>
	<section class="case-study-blocks">
		<div class="case-study-blocks-content">
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
	</section>
<?php endif; ?>