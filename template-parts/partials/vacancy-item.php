<?php
    $jobType = get_field('job_type');
    $summary_text = get_field('summary');
    $closing_date = str_replace("/","-",get_field('closing_date'));
    $closing_date = date( 'd/m/Y g:ia', strtotime( $closing_date ) );
    $interview_date = str_replace("/","-",get_field('interview_date'));
?>

<div class="vacancy-item">
    <a href="<?php echo get_post_permalink('', '', true); ?>">
        <?php the_title('<h2>', '</h2>'); ?>

        <div class="type"><?php echo $jobType; ?></div>

        <div class="date">
            <span class="month-year">Closing Date: <?php echo $closing_date; ?></span>
        </div>

        <?php if (!empty($interview_date)) : ?>
            <?php $interview_date = date( 'd/m/Y', strtotime( $interview_date ) ); ?>
            <div class="date interview">
                <span class="month-year">Interview Date: <?php echo $interview_date; ?></span>
            </div>
        <?php endif; ?>

        <?php if ( strLen($summary_text) > 0 ) { ?>
            <div class="summary_text">
                <?php echo $summary_text; ?>
            </div>
        <?php } ?>

        <div class="find-out-more">
            Full Vacancy <span class="fa fa-chevron-right icon"></span>
        </div>
    </a>

</div>
