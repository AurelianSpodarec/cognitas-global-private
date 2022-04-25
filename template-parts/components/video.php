<?php
/**
 * Video
 */
$video = get_sub_field('video_url');
?>

<?php if (!empty($video)) : ?>
  <section class="video_container yellow-stripey">
    <div class="video-embed <?php if( is_front_page() ){ echo 'homepage'; } ;?>">
      <?php if( preg_match('/youtube/',$video) ):
        $v_url = preg_replace('/watch\?v=/','embed/',$video);
        $v_url .= '?playsinline=1&origin='.get_site_url();

      elseif( preg_match('/vimeo/',$video) ):
        $find = 'https:\/\/(www\.)?vimeo.com\/';
        $replace = 'https://player.vimeo.com/video/';
        $v_url = preg_replace('/'.$find.'/',$replace,$video);
        $v_url .= '?playsinline=1';
      endif;
      $v_url .= '&rel=0';
      ?>

      <iframe class="video" src="<?= $v_url; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
  </section>
<?php endif; ?>