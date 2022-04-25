<?php
/**
 * Text Content
 *
 * @field wysiwyg 'content'
 */
	global $theme_settings;
	
	$content = get_sub_field('content');
?>

<section class="textContent">
	<div class="textContent-wrapper">
		<div class="content-typography">
			<?php if (!empty($content)) : ?>
				<?php echo $content; ?>
			<?php endif; ?>
		</div>
	</div>
</section>