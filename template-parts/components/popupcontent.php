<?php
/**
 * Popup Content
 *
 */
    $section_title = get_sub_field('section_title');
    $content = get_sub_field('content');
    $popupContainerCount = 1;
?>


<section class="popupContent">   
    <h2 class="component-title scroll-animations animated mso-fade-up"><?= $section_title; ?></h2> 
    <div class="popupContent-container">
    <?php 
        if(count($content) > 1):
            $nav = '<a href="#" class="prev fa fa-chevron-left"></a><a href="#" class="next fa fa-chevron-right"></a>';
        endif;

        foreach ($content as $c): ?>

            <?php if ($c['click_event'] == 'popup') : ?>
                <div id="popup-container-<?php echo $popupContainerCount; ?>" class="popupContent-container--item popupContent-container--item-js" style="background-image: url(<?= $c['image']['url']; ?>);">
                    
                    <p class="popupContent-container--title"><?= $c['title']; ?></p>
                    <div class="popup">
                        <a href="#" class="close"></a>
                        <div class="content">
                            <h2><?= $c['title']; ?> <?= $c['sub_title'] ? '<strong class="msomce_red">'.$c['sub_title'].'</strong>' : '';  ?></h2>
                            <?= $c['content']; ?>
                        </div>
                        <?php echo $nav; ?>
                    </div>

                </div>
                <?php $popupContainerCount++; ?>
            <?php else : ?>
                <a href="<?= $c['link']['url']; ?>" target="<?= $c['link']['target']; ?>" class="popupContent-container--item" style="background-image: url(<?= $c['image']['url']; ?>);">
                    <p class="popupContent-container--title"><?= $c['title']; ?></p>
                </a>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>

</section>