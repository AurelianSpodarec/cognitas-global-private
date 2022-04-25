<?php
    $infographic_desktop_image = get_sub_field('infographic_desktop_image');
    $infographic_mobile_image = get_sub_field('infographic_mobile_image');

    $infographic_desktop_image_url = wp_get_attachment_image_src($infographic_desktop_image, 'full');
    $infographic_mobile_image_url = wp_get_attachment_image_src($infographic_mobile_image, 'large');
?>

<?php if (!empty($infographic_desktop_image_url)) : ?>
	<section class="infographics full-width-component limit-inner-div-content">
		<div class="infographics-content">
            <img class="infographic-desktop" src="<?php echo $infographic_desktop_image_url[0]; ?>">
            <img class="infographic-mobile" src="<?php echo $infographic_mobile_image_url[0]; ?>">
		</div>
	</section>
<?php endif; ?>