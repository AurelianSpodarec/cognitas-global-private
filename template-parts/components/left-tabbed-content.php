<?php
/**
 * Left Tabbed Content
 *
 */

    $component_image = get_sub_field('image');
    $component_image_url = wp_get_attachment_image_src($component_image, 'large');
    $component_title = get_sub_field('title');
    $component_subtitle = get_sub_field('subtitle');
    $left_bullets = get_sub_field('left_side_bullet_points');
    $right_bullets = get_sub_field('right_side_bullet_points');
    $text_under_bullets = get_sub_field('text_under_bullets');
    $tabbed_content = get_sub_field('tabbed_content');
    $video_url = get_sub_field('video_url');
    $video_image = get_sub_field('video_image');
    $video_image_url = wp_get_attachment_image_src($video_image, 'large');
    $buttons = get_sub_field('buttons');
?>

<?php if (!empty($component_title)) : ?>
    <section class="left-tabbed-content full-width-component limit-inner-div-content">
        <div>
            <div class="top-section">
                <div class="left-image">
                    <img src="<?php echo $component_image_url[0]; ?>">
                </div>
                <div class="component-title-wrapper">
                    <h2 class="component-title"><?php echo $component_title; ?></h2>
                    <p class="component-subtitle"><?php echo $component_subtitle; ?></p>
                    <div class="bullets-container">
                        <ul class="bullets-column styled-bullets">
                            <?php foreach ($left_bullets as $bullet) : ?>
                                <li class="bullet-item"><?php echo $bullet['bullet_point']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <ul class="bullets-column styled-bullets">
                            <?php foreach ($right_bullets as $bullet) : ?>
                                <li class="bullet-item"><?php echo $bullet['bullet_point']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if(!empty($text_under_bullets)) : ?>
                        <p class="text-under-bullets"><?php echo $text_under_bullets; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if(!empty($tabbed_content)) : ?>
                <div class="tabbed-content-container">
                    <div class="tab-title-container">
                        <?php $tabCount = 1; ?>
                        <?php foreach ($tabbed_content as $tab) : ?>
                            <?php $safeID = strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $tab['tab_title']))); ?>
                            <a class="tablinks<?php if($tabCount == 1) { echo ' tab-title-active'; } ?>" data-tab-id="<?php echo $safeID; ?>"><?php echo $tab['tab_title']; ?></a>
                            <?php $tabCount++; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="tab-content-container">
                    <?php $tabCount = 1; ?>
                        <?php foreach ($tabbed_content as $tab) : ?>
                            <?php $safeID = strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $tab['tab_title']))); ?>
                            <div id="<?php echo $safeID; ?>" class="tabcontent<?php if($tabCount == 1) { echo ' tab-content-active'; } ?>">
                                <h3><?php echo $tab['tab_title']; ?></h3>
                                <?php echo $tab['tab_content']; ?>
                                <?php if (!empty($tab['read_more_link'])) : ?>
                                    <a href="<?php echo $tab['read_more_link']['url']; ?>" class="tab-read-more">Read more</a>
                                <?php endif; ?>
                            </div>
                            <?php $tabCount++; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="video-container">
                        <?php if(!empty($video_url)) : ?>
                        <a data-fancybox="" href="<?php echo $video_url; ?>" class="tabbed-video" style="background-image: url(<?php echo $video_image_url[0]; ?>);">
                            <div class="play-button-icon"></div>
                        </a>
                        <?php else : ?>
                            <span class="tabbed-video" style="background-image: url(<?php echo $video_image_url[0]; ?>);"></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($buttons)) : ?>
                <div class="left-tabbed-content-button button-holder">
                    <?php $buttonClass = ' fill-pink'; ?>
                    <?php foreach ($buttons as $button) : ?>
                        <a href="<?php echo $button['button']['url']; ?>" class="button <?php echo $buttonClass; ?> animate-button grow" target="<?php echo $button['button']['target']; ?>"><?php echo $button['button']['title']; ?></a>
                        <?php $buttonClass = ' fill-blue'; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>                                     
        </div>
    </section>
<?php endif; ?>