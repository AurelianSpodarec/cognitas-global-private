<?php
/**
 * The default page template file
 */

	get_header(); 

	$page_title = get_the_title();
	$page_title_override = get_field('page_title_override');
	$page_summary = get_field('page_summary');
	$summary_image = get_field('summary_image');
	$mainHeaderImage = '';

	if ( has_post_thumbnail() && get_the_post_thumbnail_url(get_the_ID(),'full')  ) {
		$mainHeaderImage = get_the_post_thumbnail_url(get_the_ID(),'full');
	}

	if(!empty($page_title_override)) {
		$page_title = $page_title_override;
	}
	if(!empty($summary_image)) {
		$summary_image = wp_get_attachment_image_src($summary_image, 'large');
	}
?>

<main class="main">


	<div class="header-image-wrapper home-header-image-wrapper">
		<div class="header-imagebackground"<?php if (!empty($mainHeaderImage)) { ?> style="background-image: url('<?php echo $mainHeaderImage; ?>');"<?php } ?>></div>		
		<div class="msoHeaderContent">
			<h1 class="main-heading"><?php echo $page_title; ?></h1>
			<?php if(!empty($page_summary)) : ?>
				<p class="subtitle"><?php echo $page_summary; ?></p>
			<?php endif; ?>
			<?php if(!empty($summary_image)) : ?>
				<img class="summary-image" src="<?php echo $summary_image[0]; ?>">
			<?php endif; ?>
        </div>
        


		<!-- header animation -->
		<div id="header-animation"> </div>
		<script src="/wp-content/themes/cognitas/header-animation/lottie.js"></script>
		<script type="text/javascript">
			var animation = lottie.loadAnimation({
				container: document.getElementById('header-animation'),
				renderer: 'svg',
				loop: true,
				autoplay: true,
				path: '/wp-content/themes/cognitas/header-animation/data.json'
			})
		</script>
    </div>
    
    
  	<div class="row home-row">
		<div class="home full-width-content">
			<?php if (have_rows('full_width_components')) : ?>
				<?php while (have_rows('full_width_components')) : the_row();
					$section_name = preg_replace('/_/', '-', get_row_layout());

					get_template_part("template-parts/components/{$section_name}");
				endwhile; ?>
			<?php endif; ?>
    	</div>
  	</div>

	<?php get_footer(); ?>