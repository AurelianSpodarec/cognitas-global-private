var $post_type = '',$taxonomy = '';

//The function that updates the calendar and adjacent view area via AJAX
function updateCalendar($theDate,$post_type,$term_id,$taxonomy){

    $('.ricalendar').append('<span class="loader"></span>');
    var $view_type = $('.list_view_filter li.current').attr('data-view') ? $('.list_view_filter li.current').attr('data-view') : 'day';

    if($view_type == 'range'){
        $theDate = $('.date_range input[name="date_from"]').val() + ':' + $('.date_range input[name="date_to"]').val();
    }

    $.ajax({
        type: 'POST',
        url: $('.ricalendar').attr('data-ajax')+'/ricalendar/ricalendar-ajax-data.php',
        data: {
            date: $theDate,
            post_type: $post_type,
            term_id: $term_id,
            view_type: $view_type,
            taxonomy: $taxonomy 
        },
        success: function (data) {
            $('.ricalendar .loader').fadeOut(function(){
                $('.ricalendar').html(data);
                $('.ricalendar-list .list_header h2').html( $('.ricalendar .ricalendar-calendar .calendar_scroll span').html() );

                if($view_type == 'range'){
                    if($('.date_range input[name="date_from"]').val() == '' || $('.date_range input[name="date_to"]').val() == ''){
                        $('.ricalendar-list .list_header h2').html('Date Range');
                    } else {
                        if($('.date_range input[name="date_from"]').val() > $('.date_range input[name="date_to"]').val()){
                            $('.ricalendar-list .list_header h2').html('Invalid Date Range');
                        } else {

                            $theDate = $theDate.split(':');
                            $from = $theDate[0].split('-');
                            $to = $theDate[1].split('-');

                            var $title = $from[2]+'-'+$from[1]+'-'+$from[0];
                            $title += ' : ';
                            $title += $to[2]+'-'+$to[1]+'-'+$to[0];

                            $('.ricalendar-list .list_header h2').html($title);
                        }
                    }
                }

                $('.month_view table tbody tr').each(function(){
                    
                    if($(this).children('td[data-date]').length == 0){
                        $(this).remove();
                    }
                });
                setTimeout(function(){
                    if($('.ricalendar').find('td.has_item').length == 0){
                        $('.day_view,.week_view').html('<p class="no_events">No events to show for this month.</p>');
                    } else {
                        var todaysBlock = $('.ricalendar').find('td').children('.today');
                        todaysBlock.parent('td').trigger('click');
                    }
                    
                },500);
            });
        }
    });
}

//Initiate the calendar loading the current month
$(document).ready(function(){
	if($('.ricalendar').length){
        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth() + 1;
        $post_type = $('.ricalendar').attr('data-posttype');
        $taxonomy = $('.ricalendar').attr('data-taxonomy');
        updateCalendar(year+'-'+month,$post_type,'',$taxonomy);
	}
});

//Scroll through months in calendar
$(document).on('click','.ricalendar .previous_month:not(".disabled"),.ricalendar .next_month', function(e){
	e.preventDefault();
	var theDate = $(this).attr('data-date');
    var $term_id = $('.calendar_categories option:selected').val();
    updateCalendar(theDate,$post_type,$term_id,$taxonomy);
});
//Filter calendar by category
$(document).on('change','.ricalendar .calendar_categories', function(e){
    e.preventDefault();
    var theDate = $('.calendar_scroll span[data-current]').html();
    var $term_id = $('.calendar_categories option:selected').val();
    updateCalendar(theDate,$post_type,$term_id,$taxonomy);
});

//Load day or week data (depending on selected view type) based on the date just clicked on
$(document).on('click','.ricalendar-calendar table tr td.has_item', function(){
    
    //DAY VIEW
    if( $('.list_view_filter li.current').is('[data-view="day"]') || $('.list_view_filter li.current').length < 1){
        //Change the title in the list to the selected date
        
        $('.ricalendar-list .list_header h2').html( $(this).attr('data-date') );
        

        //Switch selected dates
	    $('.ricalendar table tr td').removeClass('selected')
        $(this).addClass('selected');

        //Remove all data from the day slots
        $('.day_view table td:nth-child(2)').removeClass('active').html('');

        //Loop through each info element, obtain the data and populate the day list
        $('.day_view').html('');
        $(this).children('i').each(function(){
            $('.no_events').remove();
            var startTime = $(this).attr('data-starttime');
            var endTime = $(this).attr('data-endtime');
            var filter = $(this).attr('data-filter');
            var title = $(this).attr('data-title');
            var allday = $(this).attr('data-allday');
            var theTime = startTime;
            var title_class= '';

            var calStartDateTime = $(this).attr('data-startdatetime');
            var calEndDateTime = $(this).attr('data-enddatetime');
            var event_link = $(this).attr('data-calendarlink');
            if(event_link == 'yes'){
                event_link = '<form method="post" action="'+$(this).attr('data-ics')+'">';
                event_link += '<input type="hidden" name="summary" value="'+title+'">';
                event_link += '<input type="hidden" name="date_start" value="'+calStartDateTime+'">';
                event_link += '<input type="hidden" name="date_end" value="'+calEndDateTime+'">';
                event_link += '<input type="submit" class="downloadButton" value="Add to Calendar">';
                event_link += '</form>';
            } else {
                event_link = '';
            }
            

            if(endTime.length > 0){
                theTime += ' - '+ endTime;
            }

            if(allday == 'TRUE'){
                theTime = 'All Day Event';
            }

            if(title.length > 50){
               title_class = ' style="font-size:100%;"';
            }

            $('.day_view').append('<div class="event_row"><span>'+theTime+'</span> '+event_link+' <strong'+title_class+'>'+title+'</strong>'+filter+'</div>');
        });
    }



    //WEEK VIEW
    if( $('.list_view_filter li.current').is('[data-view="week"]') ){
    
        //Switch selected dates
	    $('.ricalendar table tr td').removeClass('selected')
        $(this).siblings('.has_item').addBack().addClass('selected');

        var $firstDay = $('.has_item.selected').siblings('td[data-date]').addBack().first().attr('data-date');
        var $lastDay = $('.has_item.selected').siblings('td[data-date]').addBack().last().attr('data-date');

        var $title = $firstDay+' - '+ $lastDay;
        $('.ricalendar-list .list_header h2').html($title);

        //Remove all data from the day slots
        $('.week_view').html('');

        //Loop through each info element, obtain the data and populate the day list
        $('.ricalendar td.has_item.selected').siblings('td.has_item').addBack().each(function(){
            var nthColumn = parseInt($(this).attr('data-dayofweek'))*1 + (1*1);
            var theDate =  $(this).attr('data-date');
            $('.week_view').append('<h3>'+theDate+'</h3>');
            $(this).children('i').each(function(){
                $('.no_events').remove();
                var startTime = $(this).attr('data-starttime');
                var endTime = $(this).attr('data-endtime');
                var filter = $(this).attr('data-filter');
                var title = $(this).attr('data-title');
                var allday = $(this).attr('data-allday');
                var theTime = startTime;
                var title_class= '';
                

                var calStartDateTime = $(this).attr('data-startdatetime');
                var calEndDateTime = $(this).attr('data-enddatetime');
                var event_link = $(this).attr('data-calendarlink');
                if(event_link == 'yes'){
                   event_link = '<form method="post" action="'+$(this).attr('data-ics')+'">';
                   event_link += '<input type="hidden" name="summary" value="'+title+'">';
                   event_link += '<input type="hidden" name="date_start" value="'+calStartDateTime+'">';
                   event_link += '<input type="hidden" name="date_end" value="'+calEndDateTime+'">';
                   event_link += '<input type="submit" class="downloadButton" value="Add to Calendar">';
                   event_link += '</form>';
                } else {
                    event_link = '';
                }

                if(endTime.length > 0){
                    theTime += ' - '+ endTime;
                }

                if(allday == 'TRUE'){
                    theTime = 'All Day Event';
                }

                if(title.length > 50){
                title_class = ' style="font-size:100%;"';
                }
                $('.week_view').append('<div class="event_row"><span>'+theTime+'</span> '+event_link+'<strong'+title_class+'>'+title+'</strong>'+filter+'</div>');
            });
        });
    }

    //MONTH OR LIST VIEW - just updates the date title
    if( $('.list_view_filter li.current').is('[data-view="month"]') ){
        var $theDate = $('.ricalendar-calendar .calendar_scroll span[data-current]').attr('data-current');
        $theDate = $theDate.split('-');
        var $title = new Date(Date.UTC($theDate[0], ($theDate[1] - 1), 28, 0, 0, 0));
        $title = $title.toLocaleDateString('en-GB', { year: 'numeric', month: 'long'});

        //Switch selected dates
	    $('.ricalendar table tr td').removeClass('selected')        
        $('.ricalendar-list .list_header h2').html($title);
    }

    //Scroll to the first event of the day
    if($('.ricalendar-list table td.active,.ricalendar-list table td.has_item').length){
        var $firstEventTop = $('.ricalendar-list table td.active:first,.ricalendar-list table td.has_item:first').position().top - 10;
        $('.day_view,.week_view').delay(100).animate({scrollTop: $firstEventTop});
    }
});


//Load a new view type (day, week, month or list views)
$(document).on('click','.filter.list_view_filter li', function(){
    //If we are clicking the view type already active then just cancel the click
    if($(this).hasClass('current')){return false;}
    $(this).addClass('current').siblings().removeClass('current');
    var $theDate = $('.ricalendar-calendar .calendar_scroll span[data-current]').attr('data-current');
    var $term_id = $('.calendar_categories option:selected').val();
    updateCalendar($theDate,$post_type,$term_id,$taxonomy);
});

//in the week view stick the initials of the days-of-the-week to the top of the scrolling box
document.addEventListener('scroll',function(e){
        var $elm = $(e.target);
        if( $elm.is('.week_view')){
            $('.ricalendar-list .week_view thead').css({top: $('.week_view').scrollTop() });
        }
    },
    true
);

//Reset to day view if the screen size is below 690 (the limit of which the other views fit on a screen)

$(window).on('load resize', function(){
    if(window.innerWidth < 768){
        $('ul.list_view_filter li[data-view="day"]').not('.current').trigger('click');
    }
});





//Custom Date Range feature
$(document).on('input','.date_range input[name="date_from"]',function(){
    $('.date_range input[name="date_to"]').attr('min',$(this).val());
    if($('.date_range input[name="date_to"]').val() < $(this).val()){
        $('.date_range input[name="date_to"]').val('');
    }
});

$(document).on('input','.date_range input',function(){
    var $fromDate = $('.date_range input[name="date_from"]').val();
    var $toDate = $('.date_range input[name="date_to"]').val();

    if($fromDate != '' && $toDate != ''){
        var $term_id = $('.calendar_categories option:selected').val();
        updateCalendar($fromDate+':'+$toDate,$post_type,$term_id,$taxonomy);
    }
});