<?php
    $where_to_next_image_and_button = get_field('where_to_next_image_and_button');
    $where_to_next_links = get_field('where_to_next_links');
    $image_links = get_field('image_links');
?>

<div class="side-container-2-inner">
    <?php if( $where_to_next_image_and_button == true || !empty($where_to_next_links) ) : ?>
        <div class="where-to-next-container">
            <div class="where-to-next-title">Where to next?</div>
            <?php if( $where_to_next_image_and_button == true ) : ?>
                <?php 
                    $where_to_next_image = get_field('where_to_next_image');
                    $thisImage = wp_get_attachment_image_src($where_to_next_image,'large');
                    $where_to_next_button = get_field('where_to_next_button');
                ?>
                <div class="where-to-next-image-button" style="background-image: url('<?php echo $thisImage[0]; ?>');">
                    <a href="<?php echo $where_to_next_button['url']; ?>" target="<?php echo $where_to_next_button['target']; ?>" class="header-button animate-button fill fill-secondary"><?php echo $where_to_next_button['title']; ?></a>
                </div>
            <?php endif; ?>
            <?php if (!empty($where_to_next_links)) : ?>
                <ul class="where-to-next-links">
                    <?php foreach ($where_to_next_links as $next_link) : ?>
                        <li>
                            <a href="<?php echo $next_link['link']['url']; ?>" target="<?php echo $next_link['link']['target']; ?>">
                                <span><?php echo $next_link['link']['title']; ?></span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($image_links)) : ?>
        <div class="side-container-images">
            <?php foreach ($image_links as $image_link) : ?>
                <div class="side-container-image-item">
                    <?php if (!empty($image_link['link'])) : ?>
                        <a href="<?php echo $image_link['link']['url']; ?>" target="<?php echo $image_link['link']['target']; ?>">
                            <img src="<?php echo $image_link["image"]["sizes"]["large"]; ?>">
                        </a>
                    <?php else : ?>
                        <img src="<?php echo $image_link["image"]["sizes"]["large"]; ?>">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
</div>