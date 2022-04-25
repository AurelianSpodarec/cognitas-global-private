<?php
	$vacancy_previous_page = 357;
	$case_study_previous_page = 199;
	$news_previous_page = 416;
	$blog_previous_page = 967;

	if (is_singular('vacancies')) {
		$sidebar_label = get_the_title($vacancy_previous_page);
	}

	if (is_singular('casestudy')) {
		$sidebar_label = get_the_title($case_study_previous_page);
	}

	if (is_singular('post')) {
		$sidebar_label = get_the_title($news_previous_page);
	}

	if (is_singular('blog')) {
		if( has_term( 'headmaster', 'blog_category', $post->ID ) ) {
			$blog_previous_page = 967;
		} elseif ( has_term( 'head-of-prep', 'blog_category', $post->ID ) ) {
			$blog_previous_page = 969;
		} elseif ( has_term( 'head-of-senior', 'blog_category', $post->ID ) ) {
			$blog_previous_page = 971;
		} elseif ( has_term( 'inspiring-minds', 'blog_category', $post->ID ) ) {
			$blog_previous_page = 415;
		}
		$sidebar_label = get_the_title($blog_previous_page);
	}

	$sidebar_meta = is_singular('vacancies') ? 'Closing date: ' . get_field('closing_date') : null;

	$share_label = is_singular('post') || is_singular("blog") ? 'Share this article' : (is_singular('casestudy') ? 'Share this Case Study' : (is_singular('events') ? 'Share this event' : null));

	$back_link_id = is_singular('post') ? $news_previous_page : (is_singular('casestudy') ? $case_study_previous_page : (is_singular('blog') ? $blog_previous_page : (is_singular('events') ? 900 : (is_singular('alumni-news') ? 55 : null))));
	$back_link_label = is_singular('post') ? 'Back to news list' : (is_singular('blog') ? 'Back to article list' : (is_singular('events') ? 'Back to calendar list' : (is_singular('casestudy') ? 'Back to list' : null)));
?>

<aside class="sidebarNav">
	<div class="subnav-header"><?php echo $sidebar_label; ?></div>

  	<?php if (!empty($back_link_id)) : ?>
		<a class="sidebar-back" href="<?php the_permalink($back_link_id); ?>">
	  		<span><?php esc_attr_e("${back_link_label}"); ?></span>
		</a>
  	<?php endif; ?>

  	<div class="sidebar-block sidebar-share">
		<div class="title"><?php echo $share_label; ?></div>
		<ul>
	  		<li><a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
	  		<li><a class="js-share" href="//twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
		</ul>
  	</div>

  	<?php 
  		if(is_singular('events')){ 
			$location = get_post_meta( $post->ID, 'event_location', true );
			$startDate = get_post_meta( $post->ID, 'event_start_date', true );
			$time = get_post_meta( $post->ID, 'event_start_time', true );
			$venueName = get_post_meta( $post->ID, 'venue_name', true );
			$venuePhone = get_post_meta( $post->ID, 'venue_phone', true );
			$venueAddress = get_post_meta( $post->ID, 'venue_address', true );
			$venueLongitude = get_post_meta( $post->ID, 'venue_longitude', true );
			$venueLatitude = get_post_meta( $post->ID, 'venue_latitude', true );

			$start = 'All Day';
			if ( $time != 00) {
		  		$start = $time;
			} ?>

			<div class="sidebar-block sidebar-info">
	  			<div class="title">Date &amp; Time</div>
	  			<div class="date"><span class="icon fa fa-calendar"></span><?php echo date('l jS F Y',strtotime( $startDate )); ?></div>
	  			<div class="time"><span class="icon fa fa-clock-o"></span><?php echo $start; ?></div>
	  			<?php if ( strLen($location) ){ ?>
					<div class="location"><span class="icon fa fa-map-marker"></span><?php echo $location; ?></div>
	  			<?php } ?>
			</div>
  	<?php } ?>
</aside>