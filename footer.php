<?php
	/**
	 * The template for displaying the footer
	 */
	global $theme_settings;

	$footer = current($theme_settings['footer']);
	$socials = $theme_settings['socials'];
	$accreditations = $theme_settings['accreditations'];
?>
        <footer class="l5-footer">

            <div class="l5-footer__main l5-container">
            <div class="l5-footer__inner l5-footer__main-inner">


                <div class="l5-footer__content">


                    <div class="">
                        <div class="l5-footer__content-company">

                          
                            
							<div class="l5-footer__contact-info">
                            <h3 class="l5-footer__links-header">Contact Us</h3>
                                <div>
                                <i class="l5-footer__icon fa fa-phone" aria-hidden="true"></i> 
                                    <a href="tel: <?php echo esc_attr($footer['footer_phone_number']); ?>">
                                        <?php echo esc_attr($footer['footer_phone_number']); ?>
                                    </a>
                                </div>
                                 
                                <div>
                                <i class="l5-footer__icon fa fa-envelope-o" aria-hidden="true"></i> 
                                    <a href="mailto: <?php echo esc_attr($footer['footer_email_address']);?>">
                                        <?php echo esc_attr($footer['footer_email_address']); ?>
                                    </a>
                                </div>
							</div>
                        </div>
                        
                    </div>

                    <div class="l5-footer__links-wrap">
                        <div class="l5-footer__links-col">
                            <h3 class="l5-footer__links-header">Quick Links</h3>
                            <?php wp_nav_menu( array( 'menu' => 'Footer Column 1' ) ); ?>
                        </div>
                    </div>

                    <div>
                    <div class="l5-footer__content-company-header">
                            <h3 class="l5-footer__links-header">Find Us</h3>
                            <div class="l5-footer__find-us">
                                <i class="l5-footer__icon fa fa-home" aria-hidden="true"></i>
                                <p class="l5-footer__content-company-desc"><?php echo $footer['footer_text']; ?></p>
                            </div>
                        </div>
                    </div>


                    

                </div> <!-- /l5-footer__ -->

            </div>
            </div> <!-- / l5-footer__main -->

            <div class="l5-footer__copyright l5-container">
            <div class="l5-footer__inner l5-footer__copyright-inner">
                
                <div class="l5-footer__copyright-content">
                 
                   
                    
                    <div class="l5-footer__social">
                        <div class="l5-footer__accreditation">
                            <?php if (!empty($accreditations)) : ?>
                                <ul class="l5-footer__accreditation-ul">
                                    <?php foreach ($accreditations as $accreditation) : ?>
                                        <?php $accreditation_image = wp_get_attachment_image_src($accreditation['image'], 'medium'); ?>
                                        <li class="l5-footer__accreditation__li">
                                            <?php if(!empty($accreditation['link'])) : ?>
                                                <a class="" href="<?php echo esc_url($accreditation['link']); ?>" target="_blank">
                                                    <img class="l5-footer__accreditation-img" src="<?php echo $accreditation_image[0]; ?>">
                                                </a>
                                            <?php else : ?>
                                                <img class="l5-footer__accreditation-img" src="<?php echo $accreditation_image[0]; ?>">
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($socials)) : ?>
                            <div class="l5-footer__social-items">

                                <?php foreach ($socials as $social) : ?>
                                    <a class="l5-footer__social-items-link" href="<?php echo esc_url($social['link']); ?>" target="_blank">
                                        <i class="l5-footer__social-items-icon fa <?php echo esc_attr($social['network']); ?>"></i>
                                    </a>
                                <?php endforeach; ?>

                            </div>
                        <?php endif; ?>
                        </div> <!-- /l5-footer__social -->
                        <div class=" ">
                            <?php wp_nav_menu( array('menu' => 'Footer Column 2') );?>
                        </div>

                        <div>
                            <p class="l5-footer__copyright-text">&copy; Cognitas Global Limited. All Rights Reserved <?php echo date("Y"); ?></p>
                        </div>

              

                </div>

            </div>
            </div> <!-- / lt-footer__copyright -->

        </footer>
		 

		<?php wp_footer(); ?>
	</main> <!-- Closes in footer, but you won't find the opening in header, but across different files, and this is also in wrong place, this shouldn't wrap footer... -->

</body>
</html>
