<?php
/**
 * Alternating Images and Text
 *
 * @field repeater 'two_column_content'
 */
	$reduce_image_sizes = get_sub_field('reduce_image_sizes');
    $two_column_content = get_sub_field('two_column_content');
?>
<?php if (!empty($two_column_content)) : ?>
	<section class="two_column_content">
        <div>
            <?php if ( have_rows( 'two_column_content' ) ) : ?>
                <div class="two_column_content-inner <?php echo $reduce_image_sizes; ?>">
                    <?php foreach ($two_column_content as $alternating_item) : ?>
                        <?php 
                            $alternating_layout = $alternating_item['column_style'];
                            $image = wp_get_attachment_image_src($alternating_item['image'], 'large' ); 
                        ?>
                        <div class="two_column_content-item <?php echo $alternating_layout; ?>">

                        <!-- If image doesn't exist, show video -->
                          
                            <div class="two_column_content-image">

                                <?php if(!empty($image[0])) : ?>
                                    <img src="<?php echo $image[0]; ?>">
                                <?php endif; ?>

                                <?php if(!empty($alternating_item['video'])) : ?>
                                    <video style="position: relative; z-index: 1; width: 100%;" autoplay loop muted>
                                        <source src="<?php echo $alternating_item['video']; ?>" type="video/mp4">
                                        <!-- <source src="mov_bbb.ogg" type="video/ogg"> -->
                                        Your browser does not support HTML video.
                                    </video>
                                <?php endif; ?>

                            </div>
                           

                        


                            <div class="two_column_content-text">
                                <?php if(!empty($alternating_item['title'])) : ?>
                                    <h3><?php echo $alternating_item['title']; ?></h3>
                                <?php endif; ?>
                                <div class="alternating-content">
                                    <?php echo $alternating_item['text']; ?>
                                </div>
                                <?php if (!empty($alternating_item['read_more_link'])) : ?>
                                    <a href="<?php echo $alternating_item['read_more_link']['url']; ?>" class="read-more" target="<?php echo $alternating_item['read_more_link']['target']; ?>"><?php echo $alternating_item['read_more_link']['title']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
	</section>
<?php endif; ?>
