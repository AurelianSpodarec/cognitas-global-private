<?php
/**
 * Logo Slider
 *
 */
    $componentTitle = get_sub_field('component_title');
    $logos = get_sub_field('logos');
?>

<?php if(!empty($logos)) : ?>

    
    <section class="logo-slider home-page-logo-slider full-width-component limit-inner-div-content">
        <?php if (!empty($componentTitle)) : ?>
            <div class="component-title-wrapper">
                <h2 class="component-title"><?php echo $componentTitle; ?></h2>
            </div>
        <?php endif ?>
        <div class="logo-slider-container logo-slider-js">
	        <?php foreach ($logos as $logo) : ?>
                <?php 
                    $logo_image = $logo['logo_image']; 
                    $logo_link = $logo['logo_link']; 
                ?>

                <?php if ( $logo_image ) { ?>
                    <div class="logo-slider-logo-holder">
                        <?php if ( $logo_link ) { ?>
                            <a href="<?php echo $logo_link['url']; ?>" <?php if ($logo_link['target'] != "") { ?>target="<?php echo $logo_link['target']; ?>"<?php } ?>>
                                <img src="<?php echo $logo_image['url']; ?>" alt="<?php echo $logo_image['alt']; ?>" />
                            </a>
                        <?php } else { ?>
                            <img src="<?php echo $logo_image['url']; ?>" alt="<?php echo $logo_image['alt']; ?>" />
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    </section>

<?php endif; ?>