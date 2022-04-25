<?php
	global $theme_settings;

	$footer = current($theme_settings['footer']);
?>

<section class="msoHeaderBarContainer">
	<div class="msoNavBar">
		<div class="left-nav">
			<div class="topnavbar">
				<span><a href=""><?php echo $footer['footer_phone_number']; ?></a></span>
				<span><?php echo $footer['footer_email']; ?></span>
			</div>
			<div id="nav" class='menu-outer-container'>
				<?php 
					wp_nav_menu( array(
						'menu'     => 'Main Menu',
						'depth'     => '2',
						'menu_class'     => 'main-navigation-container'
					) );
				?>
				<?php get_template_part('template-parts/global/search'); ?>
			</div>
		</div>
		<a href='<?php echo get_home_url(); ?>' class="msoLogo">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/src/img/cognitas-logo.png">
		</a>
	</div>
</section>