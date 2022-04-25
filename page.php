<?php
/**
 * The default page template file
 */

	get_header();

	$page_title = get_the_title();
	$page_title_override = get_field('page_title_override');
	$page_summary = get_field('page_summary');
	$summary_image = get_field('summary_image');
	$show_left_sidebar = get_field('show_left_sidebar');
	$show_right_sidebar = get_field('show_right_sidebar');

	if( $show_left_sidebar == true && $show_right_sidebar == true){
		$containerAreaClassnames = ' three-col';
	} else if ($show_left_sidebar == true || $show_right_sidebar == true) {
		$containerAreaClassnames = ' two-col';
	} else {
		$containerAreaClassnames = ' one-col content-page-full-width-components';
	}

	if ( has_post_thumbnail() && get_the_post_thumbnail_url(get_the_ID(),'full')  ) {
		$mainHeaderImage = get_the_post_thumbnail_url(get_the_ID(),'full');
	} else {
		global $theme_settings;
		$default_header_section = current($theme_settings['default_header_section']);
		$default_header_image = $default_header_section["default_header_image"];
		$mainHeaderImage = $default_header_image;
	}

	if(!empty($page_title_override)) {
		$page_title = $page_title_override;
	}
	if(!empty($summary_image)) {
		$summary_image = wp_get_attachment_image_src($summary_image, 'large');
	}
?>

<main class="main">

    <!-- HEADER - duplicate -->
	<div class="header-image-wrapper">
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
	</div>

  	<div class="row content-row">
		<div class="main-content-container<?php echo $containerAreaClassnames; ?>">
			<?php if( $show_left_sidebar == true) : ?>
				<div class="side-container-1 animated fadeInUp delay-half-s">
					<div class="side-container-inner">
						<?php get_template_part('template-parts/global/secondary-nav'); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="main-container-1<?php if (is_front_page()) { echo ' home'; } ?>">
				<div class="row breadcrumb-row">
					<?php get_template_part('template-parts/global/breadcrumbs'); ?>
				</div>
				<div class="main-components">
					<?php if (have_rows('full_width_components')) : ?>
						<?php while (have_rows('full_width_components')) : the_row();
							$section_name = preg_replace('/_/', '-', get_row_layout());

							get_template_part("template-parts/components/{$section_name}");
						endwhile; ?>
					<?php endif; ?>
					<?php /*if (have_rows('components')) : ?>
						<?php while (have_rows('components')) : the_row();
							$section_name = preg_replace('/_/', '-', get_row_layout());

							get_template_part("template-parts/components/{$section_name}");
						endwhile; ?>
					<?php endif;*/ ?>
				</div>
			</div>
			<?php if( $show_right_sidebar == true) : ?>
				<div class="side-container-2 animated fadeInUp delay-half-s">
					<div class="side-container-inner">
						<?php get_template_part('template-parts/global/side-container-2'); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>		
  	</div>

	<?php get_footer(); ?>