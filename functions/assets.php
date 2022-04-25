<?php
add_action('wp_enqueue_scripts', function () {
  // Scripts
  wp_deregister_script('jquery');
  wp_deregister_script('jquery-migrate');

  wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', null, '3.4.1', false );
  wp_enqueue_script( 'fancybox','https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js',array('jquery'),'3.5.7',false);
  wp_enqueue_script( 'jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.0.1.min.js', array('jquery'), '3.0.1', false );
  wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '3.0.1', false );
  wp_enqueue_script( 'masonry', get_template_directory_uri() . '/assets/src/js/masonry.min.js', array('jquery'), '1.0', false );
  wp_enqueue_script( 'mobileNav', get_template_directory_uri() . '/assets/src/js/mobileNav.js', array('jquery'), '1.3', true );
  wp_enqueue_script( 'left-tabbed-content', get_template_directory_uri() . '/assets/src/js/left-tabbed-content.js', array('jquery'), '1.1', true );
  wp_enqueue_script( 'accordion-component', get_template_directory_uri() . '/assets/src/js/accordion.js', array('jquery'), '1.2', false );
  wp_enqueue_script( 'image-gallery', get_template_directory_uri() . '/assets/src/js/image-gallery.js', array('jquery'), '1.1', false );
  wp_enqueue_script( 'share', get_template_directory_uri() . '/assets/src/js/share.js', array('jquery'), '1.1', false );
  wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/src/js/custom.js', array('jquery'), '1.6', false );
  wp_enqueue_script( 'news-list', get_template_directory_uri() . '/assets/src/js/news-list.js', array('jquery'), '1.1', false );
  wp_enqueue_script( 'news-list-ajax', get_template_directory_uri() . '/assets/src/js/news-list-ajax.js', array('jquery'), '1.0', false );
  wp_enqueue_script( 'case-study-list', get_template_directory_uri() . '/assets/src/js/case-study-list.js', array('jquery'), '1.0', false );
  wp_enqueue_script( 'case-study-list-ajax', get_template_directory_uri() . '/assets/src/js/case-study-list-ajax.js', array('jquery'), '1.0', false );
  wp_enqueue_script( 'popContent', get_template_directory_uri() . '/assets/src/js/popupContent.js', array('jquery'), '1.2', false );
  wp_enqueue_script( 'logo-slider', get_template_directory_uri() . '/assets/src/js/logo-slider.js', array('jquery'), '1.3', false );
  wp_enqueue_script( 'case-studies', get_template_directory_uri() . '/assets/src/js/case-studies.js', array('jquery'), '1.0', false );
  wp_enqueue_script( 'testimonials', get_template_directory_uri() . '/assets/src/js/testimonials.js', array('jquery'), '1.1', false );
  wp_enqueue_script( 'meet-the-team', get_template_directory_uri() . '/assets/src/js/meet-the-team.js', array('jquery'), '1.6', false );
  wp_enqueue_script( 'header-search', get_template_directory_uri() . '/assets/src/js/headerSearch.js', array('jquery'), '1.1', false );
  wp_enqueue_script( 'dynamic-subnav', get_template_directory_uri() . '/assets/src/js/dynamic-subnav.js', array('jquery'), '1.0', false );
    
    // Make AJAX available in Theme JS
    wp_localize_script( 'custom', 'ajaxadminurl', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));

  // Styles
  //wp_enqueue_style('main', get_template_directory_uri() . '/build/css/main.min.css', '', '20190909', 'all');
  wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', '', '20190909', 'all');
  wp_enqueue_style('animate-css', get_template_directory_uri() . '/assets/src/css/animate.css', '', '20200316', 'all');
  

}, 999);