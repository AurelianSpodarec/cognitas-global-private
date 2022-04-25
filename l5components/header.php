
<!-- Should be a dynamic component - right now its spread all over the files duplicating the code and hard to maintain-->
<div class="header-image-wrapper">
    <div class="header-imagebackground" style="background-image: url('<?php the_sub_field('background_image'); ?>');"></div>

    <div class="msoHeaderContent">
        <h1 class="main-heading"><?php the_title(); ?></h1>
        <?php if(!empty($page_summary)) : ?>
            <p class="subtitle"><?php the_sub_field('subtitle'); ?></p>
        <?php endif; ?>
        <?php if(!empty($summary_image)) : ?>
            <!-- <img class="summary-image" src="<?php echo $summary_image[0]; ?>"> -->
        <?php endif; ?>
    </div>

</div>