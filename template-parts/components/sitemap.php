<?php
/**
 * Sitemap
 *
 *
 * @styles _sitemap.scss
 */
$exclude_pages = get_sub_field('exclude_pages');

$exclude = '';
if (!empty($exclude_pages)) {
  $exclude = implode(', ', $exclude_pages);
}
?>

<section class="sitemap">
  <div class="wrapper">
    <div class="content-typography sitemap-wrapper">
      <ul class="sitemap-list">
      <?php echo wp_list_pages([
        'title_li' => false,
        'sort_column' => 'menu_order',
        'exclude' => $exclude,
        'depth' => '2',
      ]); ?>
    </ul>
    </div>
  </div>
</section>
