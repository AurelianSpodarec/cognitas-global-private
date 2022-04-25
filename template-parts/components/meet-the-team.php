<?php
/**
 * Meet the Team Component
 * 
**/

    $componentTitle = get_sub_field('component_title');
    $team_members_rows = get_sub_field('team_members_row');
?>

<?php if (!empty($team_members_rows)) : ?>
	<section class="meet-the-team">
        <div>
            <?php if (!empty($componentTitle)) : ?>
                <div class="component-title-wrapper">
                    <h2 class="component-title"><?php echo $componentTitle; ?></h2>
                </div>
            <?php endif ?>
            
            <?php foreach ($team_members_rows as &$team_members_row) : ?>
                <?php $meet_the_team = $team_members_row['team_members']; ?>
                <?php $team_member_count = 1; ?>
                
                <div class="meet-the-team-items">
                    <?php foreach ($meet_the_team as &$meet_the_team_item) :
                        $imagefull = wp_get_attachment_image_src($meet_the_team_item['background_image'], 'large' );
                        $name = $meet_the_team_item['name'];
                        $job_title = $meet_the_team_item['title'];
                        $content = $meet_the_team_item['content'];
                    ?>
                        <div class="meet-the-team-item js-expand-details" data-team-member="hidden-content-<?php echo $team_member_count; ?>">
                            <div class="meet-the-team-bg" style="background-image: url('<?php echo $imagefull[0]; ?>');"></div>
                            <div class="meet-the-team-inner">
                                <div class="content">
                                    <div class="name"><?php echo $name; ?></div>
                                    <div class="title"><?php echo $job_title; ?></div>
                                </div>
                            </div>
                        </div>
                        <?php $team_member_count++; ?>
                    <?php endforeach; ?>
                    
                    <div class="meet-the-team-details">
                        <?php $team_member_count = 1; ?>
                        <?php foreach ($meet_the_team as &$meet_the_team_item) :
                            $imagefull = wp_get_attachment_image_src($meet_the_team_item['background_image'], 'large' );
                            $name = $meet_the_team_item['name'];
                            $job_title = $meet_the_team_item['title'];
                            $content = $meet_the_team_item['content'];
                        ?>
                            <div class="meet-the-team-text" id="hidden-content-<?php echo $team_member_count; ?>">
                                <!-- <div class="name"><?php echo $name; ?></div>
                                <div class="title"><?php echo $job_title; ?></div> -->
                                <?php echo $content; ?>
                            </div>
                            <?php $team_member_count++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
	</section>
<?php endif ?>