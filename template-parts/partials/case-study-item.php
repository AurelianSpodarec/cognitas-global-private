<?php
	$summary_text = get_field('summary');

	if(has_post_thumbnail()) {
		$thumbnail = get_the_post_thumbnail_url('','large');
	  } else {
		global $theme_settings;
		$default_header_section = current($theme_settings['default_header_section']);
		$default_header_image = $default_header_section["default_case_study_image"];
		$thumbnail = wp_get_attachment_image_url($default_header_image, 'large');
	  };

?>

<div class="case-studies-item case-study-list-item">
    <div class="case-study-image" style="background-image: url('<?php echo $thumbnail; ?>');"></div>
    <div class="case-study-content">
        <h4><?php the_title(); ?></h4>
        <p><?php echo $summary_text; ?></p>
        <span class="case-study-link">Read more</span>
	</div>
    <a class="case-study-container-link" href="<?php the_permalink(); ?>"></a>
	
	<div class="case-study-list-item__sizer"></div>
  	<div class="case-study-list-item__gutter"></div>
</div>