<?php
$emergency = new WP_Query([
  'post_type' => 'emergency',
  'posts_per_page' => 4,
]);

$last_modified = $emergency->posts[0]->post_modified;
$count = $emergency->post_count;
$list_class = $count === 1 ? 'emergency-list emergency-list--single' : 'emergency-list';
?>

<?php if ($emergency->have_posts()) : ?>
  <div id="emergency" class="emergency popup" data-last-modified="<?php echo esc_attr($last_modified); ?>">
    <header class="popup-header">
      <h2 class="popup-title"><?php echo esc_html('Important Notice'); ?></h2>
    </header>

    <div class="<?php echo esc_attr($list_class); ?>">

      <?php while ($emergency->have_posts()) : $emergency->the_post();
        $link = get_field('link'); ?>
        <div class="emergency-item">
          <h3 class="emergency-title"><?php the_title(); ?></h2>
          <div class="emergency-excerpt"><?php the_content(); ?></div>

          <?php if (!empty($link)) : ?>
            <a
              class="button button--arrow" href="<?php echo esc_url($link['link']); ?>"
              target="<?php echo esc_attr($link['target']); ?>"
            >
                <span><?php echo esc_html($link['title']); ?></span>
            </a>
          <?php endif; ?>

          <div class="emergency-background">
            <svg>
              <use xlink:href="#main-rightBackground"></use>
            </svg>
          </div>
        </div>
      <?php endwhile; ?>

    </div>
  </div>
<?php endif; ?>
