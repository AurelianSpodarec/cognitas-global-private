<?php
/**
 * Single Video
**/
    $videoTitle = get_sub_field('video_title');
    $videoSubtitle = get_sub_field('video_subtitle');
    $videoDate = get_sub_field('video_date');
    $videoURL = get_sub_field('video_url');
    $videoImage = get_sub_field('video_image');
    $videoImageFull = $videoImage['sizes']['full'];
    $firstImageID = $videoImage['ID'];
?>

<?php if (!empty($videoURL)) : ?>
	<section class="single-video limit-inner-div-content scroll-animations animated mso-fade-up">
		<div class="single-video-wrapper">
            <div class="bgOverlay"></div>
            <div class="imagebg" style="background-image: url('<?php echo $videoImageFull; ?>');">
                <?php if (!empty($videoURL)) : ?>
                    <div class="play-button-icon"></div>
                <?php endif; ?>
            </div>
            <div class="wrapper">
                <div class="name"><?php echo $videoTitle; ?></div>
                <?php if (!empty($videoDate)) : ?>
                    <div class="date"><?php echo $videoDate; ?></div>
                <?php endif; ?>
                <div class="subtitle"><?php echo $videoSubtitle; ?></div>
            </div>
            <a data-fancybox="gallery_<?php echo $firstImageID; ?>" href="<?php echo $videoURL; ?>" class="image-video-slide-link" data-caption="<?php echo $videoTitle; ?>"></a>
        </div>

		<script>
			$('[data-fancybox="gallery_<?php echo $firstImageID; ?>"]').fancybox({
				backFocus : false
			});
		</script>

	</section>
<?php endif ?>