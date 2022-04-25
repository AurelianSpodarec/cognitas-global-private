<?php
  $summary_text = get_field('summary');
  $category = get_the_category();

  if(has_post_thumbnail()) {
    $thumbnail = get_the_post_thumbnail_url('','large');
  } else {
    global $theme_settings;
    $default_header_section = current($theme_settings['default_header_section']);
    $default_header_image = $default_header_section["default_news_image"];
    $thumbnail = wp_get_attachment_image_url($default_header_image, 'large');
  };
?>

<div class="news-item">
  <div class="news-image" style="background-image: url('<?php echo $thumbnail; ?>');"></div>
  <div class="news-content">
      <h3><?php the_title(); ?></h3>
      <p><?php echo $summary_text; ?></p>
      <span class="news-link">Read more</span>
  </div>
  <a class="news-container-link" href="<?php the_permalink(); ?>"></a>
	
  <div class="news-item__sizer"></div>
  <div class="news-item__gutter"></div>
</div>
