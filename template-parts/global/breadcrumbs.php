<?php
	if ( function_exists('yoast_breadcrumb') ) {  
		if( is_singular( "events" ) ) { ?>
			<div class="breadcrumbs">
				<span xmlns:v="http://rdf.data-vocabulary.org/#">
					<span typeof="v:Breadcrumb">
						<a href="/" rel="v:url" property="v:title">Home</a> > 
						<span rel="v:child" typeof="v:Breadcrumb">
							<a href="/information/" rel="v:url" property="v:title">Information</a> > 
							<span rel="v:child" typeof="v:Breadcrumb">
								<a href="/information/calendar/" rel="v:url" property="v:title">Calendar</a> > 
								<span class="breadcrumb_last"><?php the_title(); ?></span>
							</span>
						</span>
					</span>
				</span>
			</div>
		<?php
		} elseif ( is_singular( "post" ) ) { ?>
			<div class="breadcrumbs">
				<span xmlns:v="http://rdf.data-vocabulary.org/#">
					<span typeof="v:Breadcrumb">
						<a href="/" rel="v:url" property="v:title">Home</a> > 
						<span rel="v:child" typeof="v:Breadcrumb">
							<span rel="v:child" typeof="v:Breadcrumb">
								<a href="/about-us/news/" rel="v:url" property="v:title">News</a> > 
								<span class="breadcrumb_last"><?php the_title(); ?></span>
							</span>
						</span>
					</span>
				</span>
			</div>
		<?php
		} elseif ( is_singular( "casestudy" ) ) { ?>
			<div class="breadcrumbs">
				<span xmlns:v="http://rdf.data-vocabulary.org/#">
					<span typeof="v:Breadcrumb">
						<a href="/" rel="v:url" property="v:title">Home</a> > 
						<span rel="v:child" typeof="v:Breadcrumb">
							<span rel="v:child" typeof="v:Breadcrumb">
								<a href="/case-studies/" rel="v:url" property="v:title">Case Studies</a> > 
								<span class="breadcrumb_last"><?php the_title(); ?></span>
							</span>
						</span>
					</span>
				</span>
			</div>
		<?php
		} elseif ( is_singular( "blog" ) ) { ?>
			<?php
				$blog_level_1 = '';
				$blog_level_2 = '';
				$blog_level_3 = '';
				if( has_term( 'headmaster', 'blog_category', $post->ID ) ) {
					$blog_level_1 = 967;
					$blog_level_2 = 66;
					$blog_level_3 = 90;
				} elseif ( has_term( 'head-of-prep', 'blog_category', $post->ID ) ) {
					$blog_level_1 = 969;
					$blog_level_2 = 94;
				} elseif ( has_term( 'head-of-senior', 'blog_category', $post->ID ) ) {
					$blog_level_1 = 971;
					$blog_level_2 = 96;
				} elseif ( has_term( 'inspiring-minds', 'blog_category', $post->ID ) ) {
					$blog_level_1 = 415;
					$blog_level_2 = 90;
				}
			?>
			<div class="breadcrumbs">
				<span xmlns:v="http://rdf.data-vocabulary.org/#">
					<span typeof="v:Breadcrumb">
						<a href="/" rel="v:url" property="v:title">Home</a> > 
						<?php if($blog_level_3 != '') : ?>
							<a href="<?php the_permalink($blog_level_3); ?>" rel="v:url" property="v:title"><?php echo get_the_title($blog_level_3); ?></a> > 
						<?php endif; ?>
						<span rel="v:child" typeof="v:Breadcrumb">
							<?php if($blog_level_2 != '') : ?>
								<a href="<?php the_permalink($blog_level_2); ?>" rel="v:url" property="v:title"><?php echo get_the_title($blog_level_2); ?></a> > 
							<?php endif; ?>
							<span rel="v:child" typeof="v:Breadcrumb">
								<?php if($blog_level_1 != '') : ?>
									<a href="<?php the_permalink($blog_level_1); ?>" rel="v:url" property="v:title"><?php echo get_the_title($blog_level_1); ?></a> > 
								<?php endif; ?>
								<span class="breadcrumb_last"><?php the_title(); ?></span>
							</span>
						</span>
					</span>
				</span>
			</div>
		<?php
		} else {
			yoast_breadcrumb('<div class="breadcrumbs">','</div>');
		}
	}
?>
