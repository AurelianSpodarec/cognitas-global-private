<?php
/**
 * Download
 *
 * @field textarea 'heading'
 * @field true/false 'show_file_extension'
 * @field flexible 'downloads'
 */

global $downloadsShown;

$downloadsShown = true;
$heading = !empty($heading) || $is_popup ? $heading : get_sub_field('heading');
$show_file_extension = !empty($show_file_extension) ? $show_file_extension : get_sub_field('show_file_extension');
$downloads = !empty($downloads) ? $downloads : get_sub_field('downloads');
?>

<section class="download hide-header">
  <?php if (!empty($downloads)) : ?>
    <div class="download-list wrapper">
      <div class="download-theader">
        <div class="download-name">Name</div>
        <div class="download-download">Download</div>
      </div>
      <?php foreach ($downloads as $download) :
        $layout = $download['acf_fc_layout'];
        $pathinfo = $layout === 'file' ? pathinfo($download['file']) : null;
        $extension = $layout === 'file' ? $pathinfo['extension'] : ($layout === 'email' ? 'EMAIL' : 'WEBPAGE');
        $data = [
          'internal_page' => $download['internal_page'],
          'external_link' => $download['external_link'],
          'file' => $download['file'],
          'email' => 'mailto:' . $download['email'] . '?subject=' . $download['subject'],
        ]; ?>
        <div class="download-item">
          <div class="download-info">
            <?php if (!empty($download['label'])) : ?>
              <a class="download-title" href="<?php echo esc_attr($data[ $layout ]); ?>" target="_blank">
                <span class="download-title"><?php echo wp_kses_post($download['label']); ?></span>
              </a>
            <?php endif; ?>

            <?php if (!empty($show_file_extension)) : ?>
              <span class="download-extension"><?php echo esc_attr($extension); ?></span>
            <?php endif; ?>
          </div>

          <?php if (!empty($download[ $layout ])) : ?>
            <a class="download-link" href="<?php echo esc_attr($data[ $layout ]); ?>" target="_blank">
              <span class="download-icon"></span>
            </a>
          <?php endif; ?>

        </div>
      <?php endforeach; ?>

    </div>
  <?php endif; ?>
</section>
