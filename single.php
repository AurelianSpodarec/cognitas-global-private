<?php
/**
 * The default page template file
 */
?>

<?php 
	get_header();

	$page_title = get_the_title();
	$postImage = get_the_post_thumbnail_url(get_the_ID(),'full');

	if (is_singular('post')) {
		$page_title = 'News';
		$post_type = 'post';
	}

	if (is_singular('casestudy')) {
		$page_title = 'Case Studies';
		$post_type = 'casestudy';
	}

	global $theme_settings;
	$default_header_section = current($theme_settings['default_header_section']);
	
	if (empty($postImage)) :
		if (is_singular('post')) {
			$pageTitle = 'News';
			$default_header_image = $default_header_section["default_news_image"];
		} else if (is_singular('casestudy')) {
			$pageTitle = 'Case Study';
			$default_header_image = $default_header_section["default_case_study_image"];
		}
		$postImage = wp_get_attachment_image_url($default_header_image, 'full');
	endif;
?>
<main class="main">
	<div class="header-image-wrapper">
		<div class="header-imagebackground"<?php if (!empty($postImage)) { ?> style="background-image: url('<?php echo $postImage; ?>');"<?php } ?>></div>		
		<div class="msoHeaderContent">
			<h1 class="main-heading"><?php echo $page_title; ?></h1>
		</div>
	</div>
  	<div class="row content-row">
		<div class="main-content-container two-col<?php if (!is_singular('post')) { echo ' content-page-full-width-components'; } ?>">
			<?php if (is_singular('post')) { ?>
				<div class="side-container-1 single-sidebar-container animated fadeInUp delay-half-s">
					<div class="side-container-inner">
						<?php get_template_part('template-parts/global/single-sidebar'); ?>
					</div>
				</div>
			<?php } ?>
			<div class="main-container-1">
				<div class="row breadcrumb-row">
					<?php get_template_part('template-parts/global/breadcrumbs'); ?>
				</div>
				<div class="main-components">
                    <section class="single-page">
						<h1><?php the_title(); ?></h1>
                        <?php
                            $date_posted = get_the_date('l d F Y');
                        ?>

                        <?php if (!empty($page_meta)) : ?>
                            <div class="single-meta">
                                <p class="meta-info date">Date Posted: <?php echo $date_posted; ?></p>
                            </div>
						<?php endif; ?>
					</section>

					<?php if (have_rows('full_width_components')) : ?>
						<?php while (have_rows('full_width_components')) : the_row();
							$section_name = preg_replace('/_/', '-', get_row_layout());

							get_template_part("template-parts/components/{$section_name}");
						endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="lower-content-container">
			<div class="main-components">

				<?php
					//set list defaults
					$posts_per_page = 3;
					$currentID = get_the_ID();
	
					// list logic
					$listItems = new WP_Query( array (
						'post_type' => $post_type,
						'posts_per_page' => $posts_per_page,
						'post_status' => 'publish',
						'post__not_in' => array($currentID),
						'orderby' => 'date',
						'order' => 'DESC',
					) );
				?>
				<?php if ($listItems->have_posts()) : ?>
					<section class="related-articles full-width-component limit-inner-div-content">
						<div>
							<div class="component-title-wrapper">
								<h2 class="component-title">More <?php echo $page_title; ?></h2>
							</div>
							<div class="related-articles-list">
								<?php while ($listItems->have_posts()) : $listItems->the_post(); ?>
									<?php get_template_part('template-parts/partials/case-study-item'); ?>
								<?php endwhile;
								wp_reset_postdata(); ?>
							</div>
						</div>
					</section>
				<?php endif; ?>
			</div>
		</div>
		
  	</div>

	<?php get_footer(); ?>