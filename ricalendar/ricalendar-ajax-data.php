<?php


//Look for numbers in the comments for places to check that may need editing. Anything else can be ignored (left untouched).
//This is a complicated (messy is probably a better word) yet simple calendar - so we just want to ensure it's easy to update and follow.

/* IGNORE */$date = date('Y-m');$custom_date = $_POST['date'];if(isset($custom_date)){$date = $custom_date;}$date = date('Y-m-1', strtotime($date));
/* IGNORE */$leap_year = date('L', strtotime($date));$theyear = date('Y', strtotime($date));$themonth = date('m', strtotime($date));
/* IGNORE */$prev_month = date('Y-m', strtotime('-1 months', strtotime($date)));$next_month = date('Y-m', strtotime('+1 months', strtotime($date)));
/* IGNORE */$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );require_once( $parse_uri[0] . 'wp-load.php' );
/* IGNORE */$the_category=$_POST['term_id']; $view_type=$_POST['view_type']; $posttype=$_POST['post_type']; $taxonomy=$_POST['taxonomy'];

if($view_type !== 'range'):

/*
1 1 1
1 1 1
1 1 1 - YOU CAN ADJUST THE DATA THAT GETS PULLED HERE
*/
$query = array(
'meta_query' => array(
	array(
		'meta_key'		=> 'ics_start_date',
		'meta_value'	=> '%'.$theyear.'-'.$themonth.'%',
		'meta_compare'	=> 'LIKE',
	)
),
'post_type'		=> $posttype,
'showposts'		=> -1,
'meta_key'		=> 'ics_start_date',
'orderby'  		=> 'meta_value_num',
'order' 		=> 'ASC'
);

if(!empty($the_category)):
	$tax_query = array('relation' => 'AND');
	$tax_query[] = 
	array(
		'taxonomy' => $taxonomy,
		'field'    => 'term_id',
		'terms'    => $the_category
	);
	$query['tax_query'] = $tax_query;
endif;


$loop = new WP_Query($query);
/* 1 1 1 1 1 1 1 1 1 1 1 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
HERE WE JUST LOOP THROUGH EACH EVENT WITHIN THIS MONTH+YEAR
AND OBTAIN THE DATA WE WANT AND STORE IT IN $days_array
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
/* IGNORE */$days_array = array();
/* IGNORE */while ( $loop->have_posts() ) : $loop->the_post();
/* IGNORE */$theID = $post->ID;

/*
2 2 2
2 2 2
2 2 2 - ENSURE THE DATE FIELDS BELOW MATCH A DATE FIELD FOR THE POSTS */
$theDay = intval(date('j', strtotime(get_post_meta( $theID, 'ics_start_date',true)) ));
$eventMonth = intval(date('n', strtotime(get_post_meta( $theID, 'ics_start_date',true)) ));
$eventYear = intval(date('Y', strtotime(get_post_meta( $theID, 'ics_start_date',true)) ));
$eventDayOfWeek = intval(date('N', strtotime(get_post_meta( $theID, 'ics_start_date', true)) ));
if(!empty(get_post_meta( $theID, 'ics_end_date',true))):
	$eventEndDate = date('Y-m-d', strtotime(get_post_meta( $theID, 'ics_end_date',true) ));
else:
	//Set the end date to the start date
	$eventEndDate = date('Y-m-d', strtotime(get_post_meta( $theID, 'ics_start_date',true) ));
endif;
$eventStartHour= date('G', strtotime(get_post_meta( $theID, 'ics_start_time',true) ));
$eventStartTime= date('H:i', strtotime(get_post_meta( $theID, 'ics_start_time',true) ));
if(!empty(get_post_meta( $theID, 'ics_end_time',true))):
	$eventEndTime= date('g:ia', strtotime(get_post_meta( $theID, 'ics_end_time', true) ));
else:
	$eventEndTime='';
endif;


$eventAllDay = get_post_meta( $theID, 'ics_allday', true);

$eventStr2Time = strtotime(date('Y-m-d', strtotime(get_post_meta( $theID, 'ics_start_date',true))).' '.$eventStartTime.':00');

if(!empty($taxonomy)):
	$post_cats = get_the_terms($theID,$taxonomy);

	$filter = '';

	if(!empty($post_cats)):
	foreach($post_cats as $cat):
		$filter .= $cat->name.' | ';
	endforeach;
	endif;
	$filter = rtrim($filter, '| ');
endif;

$title = get_post_meta( $theID, 'ics_summary', true );

/* 2 2 2 2 2 2 2 2 2 2 2 2 */

/* IGNORE */if($eventMonth == $themonth && $eventYear == $theyear){

	
/*
3 3 3 
3 3 3
3 3 3
So update with the data we wish to obtain here (we can use this for either in the calendar or in data that links to the calendar)
*/
array_push($days_array,array(
	'theID'=>$theID,
	'title'=>$title,
	'filter'=>$filter,
	'day'=>$theDay,
	'month'=>$eventMonth,
	'year'=>$eventYear,
	'dayofweek'=>$eventDayOfWeek,
	'endDate'=>$eventEndDate,
	'startHour'=>$eventStartHour,
	'startTime'=>$eventStartTime,
	'endTime'=>$eventEndTime,
	'allday' => $eventAllDay,
	'eventStr2Time'=>$eventStr2Time,
	'link'=> true,
	'ics_location'=>get_template_directory_uri().'/template-parts/global/download-ics.php'
));
/* 3 3 3 3 3 3 3 3 3 3 3 3 3 3 */

/* IGNORE */}
/* IGNORE */endwhile; wp_reset_postdata();


function sortbystr2time($a, $b){
	return strnatcmp($a['eventStr2Time'], $b['eventStr2Time']);
} 
usort($days_array, 'sortbystr2time');


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// END OF CALENDAR PREPARATION




//The navigation and shows the currently selected month/year ?>
<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 ricalendar-calendar">


<div class="calendar_scroll">
<a href="#" class="previous_month fa fa-caret-left <?php if($prev_month < date('Y-m')){ echo 'disabled'; } ?>" data-date="<?= $prev_month; ?>" title="Previous"></a>
<span data-current="<?= date('Y-m', strtotime($date)); ?>"><?= date('F Y', strtotime($date)); ?></span>
<a href="#" data-date="<?= $next_month; ?>" class="next_month fa fa-caret-right" title="Next month"></a>
</div>

<?php //The Calendar Header ?>
<div class="ricalendar_table_container">
<table><thead><tr><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th><th>S</th></tr></thead><tbody>

<?php
$first = '';
//42 - 7x6 grid.... with CSS empty rows can collapse to 0px tall.
for ($x = 0; $x < 42; $x++) {
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	Just some code that creates the table filling it with the 
	relevant days in the relevant slot in the week
	(including leap years)
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	/* IGNORE */$dayofweek = date('w', strtotime($date));$cal_date = ($x + 1) - ($dayofweek + 6); $cal_class = ''; $cal_info = '';
	/* IGNORE */if($cal_date < 1 || ($cal_date > 28 && $leap_year == 0 && $themonth == 2) || ($cal_date > 29 && $leap_year == 1 && $themonth == 2)){$cal_date = '';}
	/* IGNORE */if(($themonth == 1 || $themonth == 3 || $themonth == 5 || $themonth == 7 || $themonth == 8  || $themonth == 10 || $themonth == 12) && $cal_date > 31){$cal_date = '';}
	/* IGNORE */if(($themonth == 4 || $themonth == 6 || $themonth == 9 || $themonth == 11) && $cal_date > 30){$cal_date = '';}
	/* IGNORE */if($x % 7 == 0){echo '<tr>';}
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/*
	So if the current day (slot) is not empty (is a day of the month not previous or next month) then lets get some data
	to put in */
	$dow = '';
	if($cal_date != ''):
		//If the current day is today, let's mark it so, otherwise just insert a plain span
/* IGNORE */if(date('Y-n-j') == date('Y-n-j', strtotime($theyear.'-'.$themonth.'-'.$cal_date))): $cal_info = '<span class="today">'.$cal_date.'</span>'; else: $cal_info = '<span>'.$cal_date.'</span>'; endif;
		//Loop through each day gathering the data for it...
		foreach($days_array as $day):
			//...and if the current data's date matches the calendars current date
			
			if($day['day'] == $cal_date):
				$dow = $day['dayofweek'];
				$cal_info .= '<i data-filter="'.$day['filter'].'" 
					data-startHour="'.$day['startHour'].'" 
					data-startTime="'. date('g:ia', strtotime($day['startTime'] )).'" 
					data-endTime="'. $day['endTime'].'"
					data-allday="'. $day['allday'].'" ';
				
				if($day['link'] === true):
					$cal_info .= 'data-calendarlink="yes"';
					$cal_info .= 'data-ics="'.$day['ics_location'].'"';

					$calStartDateTime = date('Y-m-d g:iA', strtotime($day['year'].'-'.$day['month'].'-'.$day['day'].' '.$day['startTime']));
					$calEndDateTime = $day['endDate'].' '.$day['endTime'];

					$cal_info .= 'data-startdatetime="'.$calStartDateTime.'"';
					$cal_info .= 'data-enddatetime="'.$calEndDateTime.'"';

				endif;
				$cal_info .= 'data-title="'.$day['title'].'"></i>';

				if($first == ''):
					$first = date('l jS F Y',strtotime($theyear.'-'.$themonth.'-'.$cal_date));
				endif;

				$cal_class = 'class="has_item"'; //Mark that this day has something going on in it
				
			endif;
		endforeach;
	endif;

	//Stick all that collected data in to the table row
	if(!empty($cal_info)):
	echo '<td '.$cal_class.'data-dayofweek="'.$dow.'" data-date="'.date('l jS F Y', strtotime($theyear.'-'.$themonth.'-'.$cal_date)).'">'.$cal_info.'</td>';
	else:
		echo '<td></td>';
	endif;
	if(($x + 1) % 7 == 0){echo '</tr>';}
}
?>
</tbody>
</table>
</div>

<div class="calendar_categories_container">
	<?php if(!empty($taxonomy)): ?>
	<select class="calendar_categories">
		<option value="">Filter Calendar</option>
		<?php 
		$cat_list = get_terms( array(
			'taxonomy' => $taxonomy,
			'hide_empty' => false
		));
		foreach($cat_list as $cat):
		$selected = '';
		if($cat->term_id == $the_category):
			$selected = 'selected';
		endif; ?>
			<option <?= $selected; ?> value="<?= $cat->term_id; ?>"><?= $cat->name; ?></option>
		<?php endforeach; ?>
	</select>
	<?php endif; ?>
</div>

</div>

<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 ricalendar-list">
	
	<div class="list_header">
		
		<h2></h2>
		
		<ul class="filter list_view_filter">
			<li <?php if($view_type == 'day'): echo 'class="current"'; endif; ?> data-view="day">Day</li>
			<li <?php if($view_type == 'week'): echo 'class="current"'; endif; ?> data-view="week">Week</li>
			<li <?php if($view_type == 'month'): echo 'class="current"'; endif; ?> data-view="month">Month</li>
			<li <?php if($view_type == 'range'): echo 'class="current"'; endif; ?> data-view="range">Date Range</li>
		</ul>
	</div>
	
	<?php if($view_type == 'day'): ?>
		<div class="day_view"></div>

	<?php elseif($view_type == 'week'): ?>
		<div class="week_view"></div>
	
		<?php elseif($view_type == 'month'):
		//Share some of the table styling with week view ?>
		<style>
			.col-md-5.col-lg-5.ricalendar-calendar,
			.col-md-7.col-lg-7.ricalendar-list {
				width: 100%;
				max-width: 100%;
				flex-basis: 100%;
				margin: 0;
			}
			

			.col-md-5.col-lg-5.ricalendar-calendar
			.ricalendar_table_container,
			.col-md-5.col-lg-5.ricalendar-calendar
			.calendar_categories_container{
				display: none;
			}


		</style>


		<div class="month_view">

			<?php //The Calendar Header ?>
			<table><thead><tr><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th><th>S</th></tr></thead><tbody>

			<?php
			$first = '';
			//42 - 7x6 grid.... with CSS empty rows can collapse to 0px tall.
			for ($x = 0; $x < 42; $x++) {
				/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
				Just some code that creates the table filling it with the 
				relevant days in the relevant slot in the week
				(including leap years)
				* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
				/* IGNORE */$dayofweek = date('w', strtotime($date));$cal_date = ($x + 1) - ($dayofweek + 6); $cal_class = ''; $cal_info = '';
				/* IGNORE */if($cal_date < 1 || ($cal_date > 28 && $leap_year == 0 && $themonth == 2) || ($cal_date > 29 && $leap_year == 1 && $themonth == 2)){$cal_date = '';}
				/* IGNORE */if(($themonth == 1 || $themonth == 3 || $themonth == 5 || $themonth == 7 || $themonth == 8  || $themonth == 10 || $themonth == 12) && $cal_date > 31){$cal_date = '';}
				/* IGNORE */if(($themonth == 4 || $themonth == 6 || $themonth == 9 || $themonth == 11) && $cal_date > 30){$cal_date = '';}
				/* IGNORE */if($x % 7 == 0){echo '<tr>';}
				/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

				/*
				So if the current day (slot) is not empty (is a day of the month not previous or next month) then lets get some data
				to put in */
				$dow = '';
				if($cal_date != ''):
					//If the current day is today, let's mark it so, otherwise just insert a plain span
					/* IGNORE */if(date('Y-n-j') == date('Y-n-j', strtotime($theyear.'-'.$themonth.'-'.$cal_date))): $cal_info = '<span class="today">'.$cal_date.'</span>'; else: $cal_info = '<span>'.$cal_date.'</span>'; endif;
					//Loop through each day gathering the data for it...
					foreach($days_array as $day):
						//...and if the current data's date matches the calendars current date
						
						if($day['day'] == $cal_date):
							$dow = $day['dayofweek'];
							

							if($day['allday'] == 'TRUE'):
								$time = 'All Day';
							elseif(!empty($day['startTime']) && empty($day['endTime'])):
								$time = date('g:ia', strtotime($day['startTime'] ));
							elseif(!empty($day['startTime']) && !empty($day['endTime'])):
								$time = date('g:ia', strtotime($day['startTime'] )).'-'.$day['endTime'];
							endif;


							if($day['link'] === true):
								$calStartDateTime = date('Y-m-d g:iA', strtotime($day['year'].'-'.$day['month'].'-'.$day['day'].' '.$day['startTime']));
								$calEndDateTime = date('Y-m-d g:iA', strtotime($day['endDate'].' '.$day['endTime']));
								
								/*
								$cal_info .= '
								<form method="post" action="'. get_template_directory_uri().'/template-parts/global/download-ics.php">
								<input type="hidden" name="summary" value="'.$day['title'].'">
								<input type="hidden" name="date_start" value="'.$calStartDateTime.'">
								<input type="hidden" name="date_end" value="'.$calEndDateTime.'">
								<input type="submit" class="downloadButton" value="Add to Calendar">
								</form>';
								*/

							endif;

							$cal_info .= '<p>';
							$cal_info .= '<span>'.$time.'</span> <strong>'.$day['title'].'</strong>';
							$cal_info .= '</p>';

							if($first == ''):
								$first = date('l jS F Y',strtotime($theyear.'-'.$themonth.'-'.$cal_date));
							endif;

							$cal_class = 'class="has_item"'; //Mark that this day has something going on in it
							
						endif;
					endforeach;
				endif;

				//Stick all that collected data in to the table row
				if(!empty($cal_info)):
				echo '<td '.$cal_class.'data-dayofweek="'.$dow.'" data-date="'.date('l jS F Y', strtotime($theyear.'-'.$themonth.'-'.$cal_date)).'"><div>'.$cal_info.'</div></td>';
				else:
					echo '<td></td>';
				endif;
				if(($x + 1) % 7 == 0){echo '</tr>';}
			}
			?>
			</tbody>
			</table>
		</div>
	<?php endif; ?>
</div>









<?php else: //$view_type !== 'range'


/** DATE RANGE VIEW (CUSTOM) */
$date_range = explode(':',$_POST['date']);
$from = $date_range[0];
$to = $date_range[1];

$query = array(
	'meta_query' => array(
		array(
			'key'		=> 'ics_start_date',
			'value'	=> array($from,$to ),
			'compare'	=> 'BETWEEN',
		)
	),
	'post_type'		=> $posttype,
	'showposts'		=> -1,
	'meta_key'		=> 'ics_start_date',
	'meta_type'		=> 'DATE',
	'orderby'  		=> 'meta_value',
	'order' 		=> 'ASC'
	);
	
	if(!empty($the_category)):
		$tax_query = array('relation' => 'AND');
		$tax_query[] = 
		array(
			'taxonomy' => $taxonomy,
			'field'    => 'term_id',
			'terms'    => $the_category
		);
		$query['tax_query'] = $tax_query;
	endif;

	$loop = new WP_Query($query);
?>

<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 ricalendar-calendar">
	<div class="date_range">
		
		<h2>Select a date range</h2>
		
		<p>
		<label>From:</label>
		<input name="date_from" type="date" min="<?= date('Y-m-d'); ?>" value="<?= $from; ?>" />
		</p>

		<p>
		<label>To:</label>
		<input name="date_to" type="date" min="<?= date('Y-m-d'); ?>" value="<?= $to; ?>" />
		</p>
	</div>
	<div class="calendar_categories_container">
	<?php if(!empty($taxonomy)): ?>
		<select class="calendar_categories">
			<option value="">Filter Calendar</option>
			<?php 
			$cat_list = get_terms( array(
				'taxonomy' => $taxonomy,
				'hide_empty' => false,
			));
			
			foreach($cat_list as $cat):
			$selected = '';
			if($cat->term_id == $the_category):
				$selected = 'selected';
			endif; ?>
				<option <?= $selected; ?> value="<?= $cat->term_id; ?>"><?= $cat->name; ?></option>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
	</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 ricalendar-list">	
	<div class="list_header">
		<h2></h2>
		<ul class="filter list_view_filter">
			<li data-view="day">Day</li>
			<li data-view="week">Week</li>
			<li data-view="month">Month</li>
			<li class="current" data-view="range">Date Range</li>
		</ul>
	</div>
	
	<div class="range_view">
<?php 
if ( $loop->have_posts() ):
$theDate = '';
while ( $loop->have_posts() ):
	$loop->the_post();
	$theID = $post->ID;

	$theDay = intval(date('j', strtotime(get_post_meta( $theID, 'ics_start_date',true)) ));
	$eventMonth = intval(date('n', strtotime(get_post_meta( $theID, 'ics_start_date',true)) ));
	$eventYear = intval(date('Y', strtotime(get_post_meta( $theID, 'ics_start_date',true)) ));
	$eventDayOfWeek = intval(date('N', strtotime(get_post_meta( $theID, 'ics_start_date',true)) ));

	$eventEndDate = date('d m y', strtotime(get_post_meta( $theID, 'ics_end_date',true) ));
	$eventStartHour= date('G', strtotime(get_post_meta( $theID, 'ics_start_time',true) ));
	$eventStartTime= date('H:i', strtotime(get_post_meta( $theID, 'ics_start_time',true) ));

	if(!empty(get_post_meta( $theID, 'ics_end_time',true))):
		$eventEndTime= date('g:ia', strtotime(get_post_meta( $theID, 'ics_end_time',true) ));
	else:
		$eventEndTime='';
	endif;

	$eventAllDay = get_post_meta( $theID, 'ics_allday', true);

	$eventStr2Time = strtotime(date('Y-m-d', strtotime(get_post_meta( $theID, 'ics_start_date',true))).' '.$eventStartTime.':00');
	$post_cats = get_the_terms($theID,$taxonomy);

	$filter = '';
	if(!empty($post_cats)):
	foreach($post_cats as $cat):
		$filter .= $cat->name.' | ';
	endforeach;
	endif;
	$filter = rtrim($filter, '| ');
	

	$data = array(
		'theID'=>$theID,
		'title'=>get_the_title($theID),
		'filter'=>$filter,
		'day'=>$theDay,
		'month'=>$eventMonth,
		'year'=>$eventYear,
		'dayofweek'=>$eventDayOfWeek,
		'endDate'=>$eventEndDate,
		'startHour'=>$eventStartHour,
		'startTime'=>$eventStartTime,
		'endTime'=>$eventEndTime,
		'allday' => $eventAllDay,
		'eventStr2Time'=>$eventStr2Time,
		'link'=> true,
		'ics_location'=>get_template_directory_uri().'/template-parts/global/download-ics.php'
	);

	$time = $data['startTime'];

	if(!empty($data['endTime'])){
		$time .= ' - '. $data['endTime'];
	}

	if(get_post_meta( $theID, 'ics_allday',true) == 'TRUE'){
		$time = 'All Day Event';
	}

if($theDate != date('l jS F Y', strtotime( get_post_meta( $theID, 'ics_start_date',true) ))):
	$theDate = date('l jS F Y', strtotime( get_post_meta( $theID, 'ics_start_date',true) ));
	echo "<h3>${theDate}</h3>";
endif;
?>
<div class="event_row">
	<?= date('l jS F Y', strtotime( get_post_meta( $theID, 'ics_start_date',true) )); ?>
	<span><?= $time; ?></span>
	<strong><?= $data['title']; ?></strong>
	<?= $data['filter']; ?>

	<?php if($data['link'] === true):
    $calStartDateTime = date('Y-m-d g:iA', strtotime($data['year'].'-'.$data['month'].'-'.$data['day'].' '.$data['startTime']));
    $calEndDateTime = date('Y-m-d g:iA', strtotime($data['endDate'].' '.$data['endTime']));
								
    $cal_info .= '
    <form method="post" action="'. get_template_directory_uri().'/template-parts/global/download-ics.php">
    <input type="hidden" name="summary" value="'.$data['title'].'">
    <input type="hidden" name="date_start" value="'.$calStartDateTime.'">
    <input type="hidden" name="date_end" value="'.$calEndDateTime.'">
    <input type="submit" class="downloadButton" value="Add to Calendar">
    </form>';

    endif; ?>
</div>

<?php endwhile; wp_reset_postdata();

else: ?>

<div class="event_row no_events">No events to show for this date range.</div>

<?php endif; ?>
	</div>
</div>


<?php endif; ?>