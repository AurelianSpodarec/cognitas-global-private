<?php
	$component_title = get_sub_field('component_title');
	$background_colour = get_sub_field('background_colour');
	$testimonials = get_sub_field('testimonials');
	$button = get_sub_field('button');
	$testimonialCount = count($testimonials);
?>
<?php if (!empty($testimonials)) : ?>
	<section class="testimonials full-width-component limit-inner-div-content <?php echo $background_colour; ?>-bg<?php if($testimonialCount == 1) : echo ' single-slide'; endif; ?>">
		<div class="testimonials-content">
			<?php if(!empty($component_title)) : ?>
				<div class="component-title-wrapper">
					<h2 class="component-title"><?php echo $component_title; ?></h2>
				</div>
			<?php endif; ?>
			<div class="testimonials-slider-container">
				<div id="homepageTestimonialSlider" class="slider-holder">
					<div class="testimonials-slider js-testimonial-slider">
						<?php foreach ($testimonials as $testimonial) { ?>
							<div>
								<div class="testimonial-item">
									<div class="testimonial-detail">
										<div class="text-container">
											<div class="text"><?php echo $testimonial['text']; ?></div>
											<?php if (!empty($testimonial['author'])) { ?>
												<p class="name"><?php echo $testimonial['author']; ?></p>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php if (!empty($button)) : ?>
                <div class="button-holder">
                    <a href="<?php echo $button['url']; ?>" class="button fill-blue animate-button grow" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
                </div>
            <?php endif; ?> 
		</div>
	</section>
<?php endif; ?>