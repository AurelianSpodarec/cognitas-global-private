<?php
/**
 * Accordion
 *
 * @field repeater 'accordions'
 */
$accordions = get_sub_field('accordions');

?>

<?php if (!empty($accordions)) : ?>
  <section class="accordion">
    <?php if ( have_rows( 'accordions' ) ) : ?>
      <?php while ( have_rows( 'accordions' ) ) : the_row(); ?>

        <div class="accordion-item">
          <a class="accordion-link" href="<?php echo esc_attr('#' . sanitize_title($accordion['title'])); ?>">
            <h5 class="accordion-title">
              <span><?php the_sub_field( 'title' ); ?>
            </h5>
          </a>
          <div class="accordion-content content-typography" aria-hidden="true">
            <?php the_sub_field( 'accordion_content' ); ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
<?php endif; ?>
