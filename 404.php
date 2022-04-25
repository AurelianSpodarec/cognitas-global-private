<?php
/**
 * 404 template file
 */

  if ( has_post_thumbnail() && get_the_post_thumbnail_url(get_the_ID(),'full')  ) {
    $mainHeaderImage = get_the_post_thumbnail_url(get_the_ID(),'full');
  } else {
    global $theme_settings;
    $default_header_section = current($theme_settings['default_header_section']);
    $default_header_image = $default_header_section["default_header_image"];
    $mainHeaderImage = $default_header_image;
  }

?>

<?php get_header(); ?>

<main class="main">
	<div class="header-image-wrapper">
		<div class="header-imagebackground"<?php if (!empty($mainHeaderImage)) { ?> style="background-image: url('<?php echo $mainHeaderImage; ?>');"<?php } ?>></div>		
		<div class="msoHeaderContent">
			<h1 class="main-heading">404: Page Not Found</h1>
		</div>
	</div>
  	<div class="row content-row">
		<div class="main-content-container">
			<div class="main-container-1<?php if (is_front_page()) { echo ' home'; } ?>">
				<div class="row breadcrumb-row">
					<?php get_template_part('template-parts/global/breadcrumbs'); ?>
				</div>
				<div class="main-components">
          <section class="error-message">
            <h1 class="error404-heading">We are very sorry...</h1>
            <p clas="error404-subheading">The page you were looking for appears to have been moved, deleted or doesn't exist.<br>
              Try going back to where you were or head straight to our <a href="/">home page</a>.</p>
          </section>
				</div>
			</div>
		</div>
		
  	</div>

	<?php get_footer(); ?>
