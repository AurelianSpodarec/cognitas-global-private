<?php
/**
 * Image Gallery Slider
**/
    $componentTitle = get_sub_field('component_title');
	$gallery_slides = get_sub_field('gallery_items');
	$firstImageID = $gallery_slides[0]['image'];
?>

<?php if (!empty($gallery_slides)) : ?>
	<section class="image-gallery-slider full-width-component">
		<?php if (!empty($componentTitle)) : ?>
			<div class="component-title-wrapper">
				<h2 class="component-title"><?php echo $componentTitle; ?></h2>
			</div>
		<?php endif ?>
		<div class="image-gallery-slider-wrapper">
			<div class="image-gallery-slider-content">
				<div class="image-gallery-slider-slides js-image-gallerySlider">
					<?php while(the_repeater_field('gallery_items')): 
						$image = wp_get_attachment_image_src(get_sub_field('image'), 'large' );
						$imagefull = wp_get_attachment_image_src(get_sub_field('image'), 'full' );
						$title = get_sub_field('title');
					?>
						<div class="slide js--image-gallery-slide">
							<div class="slide-inner">
								<div class="imagebg" style="background-image: url('<?php echo $image[0]; ?>');"></div>
								<a data-fancybox="gallery_<?php echo $firstImageID; ?>" href="<?php echo $imagefull[0]; ?>" class="image-gallery-slide-link" data-caption="<?php echo $title; ?>"></a>
							</div>
						</div>
	    			<?php endwhile; ?>
				</div>
				<div class="image-gallery-nav">
					<span class="slide-count"></span>
				</div>
			</div>
		</div>

		<script>
			$('[data-fancybox="gallery_<?php echo $firstImageID; ?>"]').fancybox({
				backFocus : false
			});
		</script>

	</section>
<?php endif ?>