<?php
/**
 * Blockquote
 *
 * @field textarea 'text'
 */
	$quote = get_sub_field('quote');
?>

<?php if (!empty($quote)) : ?>
  	<section class="blockquote">
  		<div class="blockquote-container">
			<div class="flex-content-container">
                <div class='content-container'>
                    <div class="quote-text">"<?php echo wp_kses_post($quote); ?>"</div>
                </div>
			</div>
		</div>
  	</section>
<?php endif; ?>