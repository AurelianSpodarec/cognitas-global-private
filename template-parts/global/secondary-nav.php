<aside class="msoSideNavigation hidden-xs hidden-sm">
	<?php 
		/*wp_nav_menu( array(
  			'menu'     => 'Main Menu',
  			'sub_menu' => false,
  			'container' => '',
  			'menu_class' => 'nav navbar-nav'
		) );*/

		wp_nav_menu( array(
			'menu'     => 'Main Menu',
			'container'     => 'Side Navigation',
			'menu_class'     => 'sideNav',
		) );
	?>
</aside>