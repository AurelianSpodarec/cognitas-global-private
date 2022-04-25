<?php

function get_field_link($links = [], $css_class = '', $default_label = '', $global_label = '') {
  // Don't print any markup if there are no items at this point.
  if (empty($links) || !is_array($links)) {
    return;
  }

  // Data validation
  $allowed_html_post = wp_kses_allowed_html('post');
  $allowed_html_custom = [
    'a' => [
      'href' => true,
      'rel' => true,
      'name' => true,
      'target' => true,
      'class' => true,
      'id' => true,
      'title' => true,
      'data-src' => true,
      'data-fancybox' => true,
    ],
    'i' => [
      'class' => true,
      'aria-hidden' => true,
    ],
    'br' => true,
    'div' => [
      'id' => true,
      'class' => true,
      'style' => true,
    ],
  ];

  $allowed_html = array_merge($allowed_html_post, $allowed_html_custom);

  // Buffer starts
  ob_start(); ?>


  <?php foreach ($links as $link) :

    $data = [
      'internal_page' => $link['internal_page'],
      'external_link' => $link['external_link'],
      'file' => $link['file'],
      'email' => 'mailto:' . $link['email'] . '?subject=' . $link['subject'],
      'url' => $data[ $link['acf_fc_layout'] ],
      'label' => $link['label'] ? ($global_label ? $global_label : $link['label']) : $default_label,
      'css_class' => !empty($css_class) ? $css_class : 'button button--arrow',
    ]; ?>

    <?php if ($link['acf_fc_layout'] === 'internal_page') : ?>
      <a class="<?php echo esc_attr($data['css_class']); ?>" href="<?php echo esc_url($data[ $link['acf_fc_layout'] ]); ?>">
        <span><?php echo wp_kses_post($data['label']); ?></span>
      </a>

    <?php elseif ($link['acf_fc_layout'] === 'external_link') : ?>
      <a class="<?php echo esc_attr($data['css_class']); ?>" href="<?php echo esc_url($data[ $link['acf_fc_layout'] ]); ?>" target="_blank">
        <span><?php echo wp_kses_post($data['label']); ?></span>
      </a>

    <?php elseif ($link['acf_fc_layout'] === 'file') : ?>
      <a class="<?php echo esc_attr($data['css_class']); ?>" href="<?php echo esc_url($data[ $link['acf_fc_layout'] ]); ?>">
        <span><?php echo wp_kses_post($data['label']); ?></span>
      </a>

    <?php elseif ($link['acf_fc_layout'] === 'email') : ?>
      <a class="<?php echo esc_attr($data['css_class']); ?>" href="<?php echo esc_attr($data[ $link['acf_fc_layout'] ]); ?>">
        <span><?php echo wp_kses_post($data['label']); ?></span>
      </a>

    <?php elseif ($link['acf_fc_layout'] === 'popup') :
      $target = sanitize_title('popup-' . $link['label']);
      $popup = current($link['popup']); ?>
      <a class="<?php echo esc_attr($data['css_class']); ?>" href="<?php echo esc_attr('#' . $target); ?>"
         data-src="<?php echo esc_attr('#' . $target); ?>"
         data-fancybox="link-popup">
        <span><?php echo wp_kses_post($data['label']); ?></span>
      </a>

      <div class="popup" id="<?php echo esc_attr($target); ?>" style="display: none;">
        <?php if (!empty($popup['title'])) : ?>
          <header class="popup-header">
            <h2 class="popup-title"><?php echo esc_html($popup['title']); ?></h2>
          </header>
        <?php endif; ?>
        <?php if (!empty($popup['image']) || !empty($popup['video'])) : ?>
          <div class="popup-media" style="background-image: url('<?php echo esc_url($popup['image']); ?>');">

            <?php if (!empty($popup['video']) && $popup['type'] === 'video') : ?>
              <div class="popup-itemWrapper">
                <video
                  id="popup-video"
                  class="video-js vjs-default-skin"
                  data-video="<?php echo esc_url($popup['video']); ?>"
                >
                </video>
              </div>
            <?php endif; ?>
          </div>

        <?php endif; ?>

        <?php if (!empty($popup['content'])) : ?>
          <div class="popup-content">
            <div class="content-typography">
              <?php echo wp_kses_post($popup['content']); ?>
            </div>

            <?php $heading = $popup['heading'];
            $show_file_extension = $popup['show_file_extension'];
            $downloads = $popup['downloads'];
            $is_popup = true; ?>

            <?php include(locate_template('template-parts/components/download.php')); ?>

          </div>
      <?php endif; ?>
      </div>
    <?php endif; ?>

  <?php endforeach;

  $result = ob_get_clean();

  // echo wp_kses($result, $allowed_html);
  echo $result;
}
