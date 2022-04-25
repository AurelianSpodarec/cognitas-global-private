<?php
/**
 * The default page template file
 */

	get_header(); 
	$header_button = get_field('header_button');
	$show_left_sidebar = get_field('show_left_sidebar');
	$show_right_sidebar = get_field('show_right_sidebar');
	$submenu = wp_nav_menu( array(
			'menu'     => 'Main Menu',
			'sub_menu' => true,
			'echo' => false
	) );

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

	global $wp_query;
  
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$total_pages = $wp_query->max_num_pages;
	$resultscount = $wp_query->found_posts;
?>

<main class="main">
	<div class="header-image-wrapper">
		<div class="header-imagebackground"<?php if (!empty($mainHeaderImage)) { ?> style="background-image: url('<?php echo $mainHeaderImage; ?>');"<?php } ?>></div>		
		<div class="msoHeaderContent">
			<h1 class="main-heading">Search</h1>
		</div>
	</div>
  	<div class="row content-row">
		<div class="main-content-container<?php echo $containerAreaClassnames; ?>">
			<div class="main-container-1<?php if (is_front_page()) { echo ' home'; } ?>">
				<div class="row breadcrumb-row">
					<?php get_template_part('template-parts/global/breadcrumbs'); ?>
				</div>
				<div class="main-components">
					<section class="search-wrapper">
						<div class="wrapper">
							<p class="search-result-caption">Use the search bar below to find what you are looking for.</p>
							<form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
								<input class="search-formInput" type="text" placeholder="Search..." name="s" autocomplete="off">
								<button type="submit" class="search-formSubmit">
									<i class="fa fa-search" aria-hidden="true"></i>
									</button>
							</form>

							<?php if (have_posts()) : ?>
								<div class="search-inner">
									<?php if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { ?>
										<p class="search-result-total">Your search returned <?php echo $resultscount; ?> result<?php if($resultscount > 1) { echo 's'; } ?>.</p>
									<?php } ?>
									<div class="search-list">
										<?php while (have_posts()) : the_post(); ?>
											<article class="search-item">
												<h3 class="search-itemTitle">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													<?php if (get_the_content()) : ?>
														<p class="search-itemExcerpt"><?php echo wp_kses_post(wp_trim_words(get_the_content(), 30, '...')); ?></p>
													<?php endif; ?>
												</h3>
											</article>
										<?php endwhile; ?>
									</div>
								</div>
							<?php else : ?>
								<h2 class="search-query"><?php echo esc_attr('Nothing Found'); ?></h2>
								<div class="search-nothingFound">
									<p><?php echo esc_attr('Sorry, but nothing matched your search criteria. Please try again with some different keywords.'); ?></p>
								</div>
							<?php endif; ?>

							<?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
								<div class="search-pager">
									<div class="search-pagerLink search-pagerLink--previous">
										<?php previous_posts_link('Back'); ?>
									</div>
									<div class="search-pagerLink search-pagerLink--number">
										<?php echo esc_attr('Page ' . $paged . ' of ' . $total_pages); ?>
									</div>
									<div class="search-pagerLink search-pagerLink--next">
										<?php next_posts_link('Next'); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</section>
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