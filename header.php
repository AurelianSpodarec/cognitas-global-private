<?php
/**
 * The template for displaying the header
 */

	/* Because cookies have to be set at the header stage, call the function, create the cookie and save the output to a variable.
	echo the variable at the desired place */
	$popup = emergency_popup();
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  	<meta charset="<?php bloginfo('charset'); ?>">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">  
      
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
      
	<?php /*
	404 - No favicon found?
	<link rel="Shortcut Icon" href="<?= get_template_directory_uri(); ?>/assets/src/img/favicon.ico" type="image/x-icon" />
	*/ ?>

	<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCRWjxgWbX91cwQSUPUFy6qErxNj4KqvOk&libraries=places"></script>
  	<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
  	<script>
		window.addEventListener("load", function() {
			window.cookieconsent.initialise({
				"palette": {
					"popup": {
						"background": "#00b4ff",
						"text": "#fff",
						"link": "#fff"
					},
					"button": {
						"background": "#fff",
						"text": "#00b4ff"
					}
				},
				"content": {
					"href": "/terms"
				},
				"position": "bottom cc-right"
			})
		});
	</script>

  	<script type="text/javascript">
  		// first, create the object that contains
    	// configuration variables
    	MTIConfig = {};

    	// next, add a variable that will control
    	// whether or not FOUT will be prevented
    	MTIConfig.EnableCustomFOUTHandler = true // true = prevent FOUT
   	</script>
  	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-template_directory="<?= bloginfo('template_directory'); ?>">

	<div class="emergency_popup">
		<?= $popup; ?>
	</div>

	<?php
 		global $theme_settings;
		$socials = $theme_settings['socials'];
	?>
    
   
    <!-- START HEADER -->
	<header class="header-mobile  l5-header"> 

		<div class="header-inner  js-stickyHeader">
			<div class="msoIcon">
				<a href='<?php echo get_home_url(); ?>' class="logo">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/src/img/logos/cognita/cognitas_web_logo-white.png">
				</a>
			</div>

			<div class="header-mobile-right">
				<nav class="mainmenu">
					<?php 
						wp_nav_menu( array(
							'menu'     => 'Main Menu',
							'container'     => 'Desktop Navigation',
							'menu_class'     => 'mainNav',
						) );
					?>
				</nav>

				<div class="header-search js-desktop-search">
					<a href="/?s="><i class="fa fa-search"></i></a>
				</div>
				<div class="header-button-holder">
					<?php echo do_shortcode('[gtranslate]'); ?>
				</div>

				<div class="nav-icon-container js-menuToggle">
					<span class="nav-text">MENU</span>
					<div class="nav-icon">
						<div></div>
					</div>
				</div>
			</div>
        </div>
        <!-- /END HEADER -->



		<div class="header-search-slideout">
			<form action="<?php echo esc_url(home_url('/')); ?>" method="GET">
				<input type="search" name="s" id="text" class="msoSearchBox" value="" autocomplete="off" placeholder="SEARCH">
				<button type="submit" class="msoSearchBtn"><i class="fa fa-search"></i></button>
			</form>
		</div>

		<div class='header-mobileNav js-mobileNav'>
			<div class="mobileNav-container">
				<?php 
					wp_nav_menu( array(
						'menu'     => 'Main Menu',
						'container'     => 'Mobile Navigation',
						'menu_class'     => 'mobileNav',
					) );
				?>
			</div>
		</div>
	</header>
