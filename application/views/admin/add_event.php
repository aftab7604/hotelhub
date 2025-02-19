<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add New Event</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Add New Event Page</li>
            </ol>
        </div>
    </div>
	<?php
		function getWeeks($date, $rollover){
			$cut 	= substr($date, 0, 8);
			$daylen = 86400;
	
			$timestamp 	= strtotime($date);
			$first 		= strtotime($cut . "00");
			$elapsed 	= ($timestamp - $first) / $daylen;
			$weeks 		= 1;
	
			for ($i = 1; $i <= $elapsed; $i++)
			{
				$dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
				$daytimestamp = strtotime($dayfind);
				$day = strtolower(date("l", $daytimestamp));
				if($day == strtolower($rollover))  $weeks ++;
			}
			return $weeks;
		}
		function dayNumber($date){
			$t 			= date('d-m-Y', strtotime($date));
			$dayNumber 	= strtolower(date("d", strtotime($t)));
			$return 	= floor(($dayNumber - 1) / 7) + 1;
			return $return;
		}

		$hotel_id		= $this->session->userdata['logged_in']['firm_id'];
		$current_date	= gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$curr_month		= gmdate('F', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$curr_month_num	= gmdate('n', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$curr_day		= gmdate('d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$curr_day_full	= gmdate('l', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
		$curr_week_num	= dayNumber($current_date);
		$weeks			= array('1' =>'first', '2' =>'second', '3' =>'third', '4' =>'fourth', '5' =>'last', '6' =>'sixth');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Add New Event</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
                        <!--Errors divs-->
                        <?php
							if($this->session->flashdata('flash_data') != "") {
								echo '<div class="alert alert-success alert-dismissable">';
								echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
								echo $this->session->flashdata('flash_data');
								echo '</div>';
							}
							if ($this->session->flashdata('flash_data_danger') != "") {
								echo '<div style=" margin: 10px;" class="alert alert-danger alert-dismissable">';
								echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
								echo $this->session->flashdata('flash_data_danger');
								echo '</div>';
							}
                        ?>
                        <!--Add hotel form-->
                        <form action="<?php echo base_url();?>event/save_event_info" method="post" enctype="multipart/form-data">
                        	<div class="modal fade bs-pending-ticket" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                    <h4 class="modal-title" id="myLargeModalLabel"><b>Select Repeat Pattern</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-right">Occurs</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="form-group">
                                <select class="form-control" id="cus_occur" name="cus_occur">
                                    <option value="daily" selected="selected"	>Daily</option>
                                    <option value="weekly"						>Weekly</option>
                                    <option value="sameDayMonth"				>The same day each month</option>
                                    <option value="sameWeekMonth"				>The same week each month</option>
                                    <option value="sameDayYear"					>The same day each year</option>
                                    <option value="sameWeekYear"				>The same week each year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    
                    <div class="row" id="cus_daily">
                        <div class="col-md-2">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-right">Every</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                        	<div class="form-group">
                                <input type="text" id="cus_daily_days" name="cus_daily_days" class="form-control" placeholder="Days" value="1">
                            </div>
                        </div>
                        <div class="col-md-2 p-l-0">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-left">days</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cus_weekly" style="display:none;">
                        <div class="col-md-2">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-right">Every</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                        	<div class="form-group">
                                <input type="text" id="cus_weekly_days" name="cus_weekly_days" class="form-control" placeholder="Days" value="1">
                            </div>
                        </div>
                        <div class="col-md-8">
                        	<div class="row">
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label pull-left">weeks on</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-l-0">
                                    <div class="form-group m-b-0">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" class="chk" id="cus_weekly_mon" name="cus_weekly_dayName" value="Monday" <?php if($curr_day_full == 'Monday'){echo 'checked="checked"';}?>>
                                            <label for="cus_weekly_mon">Mon</label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" class="chk" id="cus_weekly_fri" name="cus_weekly_dayName" value="Friday" <?php if($curr_day_full == 'Friday'){echo 'checked="checked"';}?>>
                                            <label for="cus_weekly_fri">Fri</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 p-l-0">
                                    <div class="form-group m-b-0">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" class="chk" id="cus_weekly_tue" name="cus_weekly_dayName" value="Tuesday" <?php if($curr_day_full == 'Tuesday'){echo 'checked="checked"';}?>>
                                            <label for="cus_weekly_tue">Tue</label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" class="chk" id="cus_weekly_sat" name="cus_weekly_dayName" value="Saturday" <?php if($curr_day_full == 'Saturday'){echo 'checked="checked"';}?>>
                                            <label for="cus_weekly_sat">Sat</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 p-l-0">
                                    <div class="form-group m-b-0">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" class="chk" id="cus_weekly_wed" name="cus_weekly_dayName" value="Wednesday" <?php if($curr_day_full == 'Wednesday'){echo 'checked="checked"';}?>>
                                            <label for="cus_weekly_wed">Wed</label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" class="chk" id="cus_weekly_sun" name="cus_weekly_dayName" value="Sunday" <?php if($curr_day_full == 'Sunday'){echo 'checked="checked"';}?>>
                                            <label for="cus_weekly_sun">Sun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 p-l-0">
                                    <div class="form-group m-b-0">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" class="chk" id="cus_weekly_thu" name="cus_weekly_dayName" value="Thursday" <?php if($curr_day_full == 'Thursday'){echo 'checked="checked"';}?>>
                                            <label for="cus_weekly_thu">Thu</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cus_sameDayMonth" style="display:none;">
                        <div class="col-md-2">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-right">Day</label>
                            </div>
                        </div>
                        <div class="col-md-2 p-r-0">
                        	<div class="form-group">
                                <input type="text" id="cus_sameDayMonth_days" name="cus_sameDayMonth_days" class="form-control" placeholder="Days" value="<?php echo $curr_day;?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group m-t-10">
                                <label class="control-label pull-left">of every</label>
                            </div>
                        </div>
                        <div class="col-md-2 p-l-0">
                        	<div class="form-group">
                                <input type="text" id="cus_sameDayMonth_months" name="cus_sameDayMonth_months" class="form-control" placeholder="Months" value="1">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group m-t-10">
                                <label class="control-label pull-left">months</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" id="cus_sameWeekMonth" style="display:none;">
                        <div class="col-md-2">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-right">Every</label>
                            </div>
                        </div>
                        <div class="col-md-2 p-r-0">
                        	<div class="form-group">
                                <input type="text" id="cus_sameWeekMonth_months" name="cus_sameWeekMonth_months" class="form-control" placeholder="Months" value="1">
                            </div>
                        </div>
                        <div class="col-md-2 p-r-0">
                            <div class="form-group">
                                <label class="control-label pull-left">months on the</label>
                            </div>
                        </div>
                        <div class="col-md-2 p-l-0 p-r-0">
                        	<div class="form-group">
                                <select class="form-control" id="cus_sameWeekMonth_weekNum" name="cus_sameWeekMonth_weekNum">
                                    <option value="first" 	<?php if($weeks[$curr_week_num] == 'first')	{echo 'selected="selected"';}?>		>first</option>
                                    <option value="second"	<?php if($weeks[$curr_week_num] == 'second'){echo 'selected="selected"';}?>		>second</option>
                                    <option value="third"	<?php if($weeks[$curr_week_num] == 'third')	{echo 'selected="selected"';}?>		>third</option>
                                    <option value="fourth"	<?php if($weeks[$curr_week_num] == 'fourth'){echo 'selected="selected"';}?>		>fourth</option>
                                    <option value="last"	<?php if($weeks[$curr_week_num] == 'last')	{echo 'selected="selected"';}?>		>last</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" id="cus_sameWeekMonth_dayName" name="cus_sameWeekMonth_dayName">
                                    <option value="Sunday"		<?php if($curr_day_full == 'Sunday')	{echo 'selected="selected"';}?>		>Sunday</option>
                                    <option value="Monday"		<?php if($curr_day_full == 'Monday')	{echo 'selected="selected"';}?> 	>Monday</option>
                                    <option value="Tuesday"		<?php if($curr_day_full == 'Tuesday')	{echo 'selected="selected"';}?>		>Tuesday</option>
                                    <option value="Wednesday"	<?php if($curr_day_full == 'Wednesday')	{echo 'selected="selected"';}?>		>Wednesday</option>
                                    <option value="Thursday"	<?php if($curr_day_full == 'Thursday')	{echo 'selected="selected"';}?>		>Thursday</option>
                                    <option value="Friday"		<?php if($curr_day_full == 'Friday')	{echo 'selected="selected"';}?>		>Friday</option>
                                    <option value="Saturday"	<?php if($curr_day_full == 'Saturday')	{echo 'selected="selected"';}?>		>Saturday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cus_sameDayYear" style="display:none;">
                        <div class="col-md-2">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-right">On</label>
                            </div>
                        </div>
                        <div class="col-md-3 p-l-0">
                        	<div class="form-group">
                                <select class="form-control" id="cus_sameDayYear_monthsName" name="cus_sameDayYear_monthsName">
                                    <option value="January"		<?php if($curr_month == 'January')	{echo 'selected="selected"';}?>		>January</option>
                                    <option value="February"	<?php if($curr_month == 'February')	{echo 'selected="selected"';}?>		>February</option>
                                    <option value="March"		<?php if($curr_month == 'March')	{echo 'selected="selected"';}?>		>March</option>
                                    <option value="April"		<?php if($curr_month == 'April')	{echo 'selected="selected"';}?>		>April</option>
                                    <option value="May" 		<?php if($curr_month == 'May')		{echo 'selected="selected"';}?>		>May</option>
                                    <option value="June" 		<?php if($curr_month == 'June')		{echo 'selected="selected"';}?>		>June</option>
                                    <option value="July" 		<?php if($curr_month == 'July')		{echo 'selected="selected"';}?>		>July</option>
                                    <option value="August" 		<?php if($curr_month == 'August')	{echo 'selected="selected"';}?>		>August</option>
                                    <option value="September" 	<?php if($curr_month == 'September'){echo 'selected="selected"';}?>		>September</option>
                                    <option value="October" 	<?php if($curr_month == 'October')	{echo 'selected="selected"';}?>		>October</option>
                                    <option value="November" 	<?php if($curr_month == 'November')	{echo 'selected="selected"';}?>		>November</option>
                                    <option value="December" 	<?php if($curr_month == 'December')	{echo 'selected="selected"';}?>		>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                        	<div class="form-group">
                                <input type="text" id="cus_sameDayYear_days" name="cus_sameDayYear_days" class="form-control" placeholder="Days" value="<?php echo $curr_day; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cus_sameWeekYear" style="display:none;">
                        <div class="col-md-2">
                        	<div class="form-group m-b-0 m-t-10">
                            	<label class="control-label pull-right">On the</label>
                            </div>
                        </div>
                        <div class="col-md-2 p-l-0 p-r-0">
                        	<div class="form-group">
                                <select class="form-control" id="cus_sameWeekYear_weekNum" name="cus_sameWeekYear_weekNum">
                                    <option value="first" 	<?php if($weeks[$curr_week_num] == 'first')	{echo 'selected="selected"';}?>		>first</option>
                                    <option value="second"	<?php if($weeks[$curr_week_num] == 'second'){echo 'selected="selected"';}?>		>second</option>
                                    <option value="third"	<?php if($weeks[$curr_week_num] == 'third')	{echo 'selected="selected"';}?>		>third</option>
                                    <option value="fourth"	<?php if($weeks[$curr_week_num] == 'fourth'){echo 'selected="selected"';}?>		>fourth</option>
                                    <option value="last"	<?php if($weeks[$curr_week_num] == 'last')	{echo 'selected="selected"';}?>		>last</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 p-r-0">
                            <div class="form-group">
                                <select class="form-control" id="cus_sameWeekYear_dayName" name="cus_sameWeekYear_dayName">
                                    <option value="Sunday"		<?php if($curr_day_full == 'Sunday')	{echo 'selected="selected"';}?>		>Sunday</option>
                                    <option value="Monday"		<?php if($curr_day_full == 'Monday')	{echo 'selected="selected"';}?> 	>Monday</option>
                                    <option value="Tuesday"		<?php if($curr_day_full == 'Tuesday')	{echo 'selected="selected"';}?>		>Tuesday</option>
                                    <option value="Wednesday"	<?php if($curr_day_full == 'Wednesday')	{echo 'selected="selected"';}?>		>Wednesday</option>
                                    <option value="Thursday"	<?php if($curr_day_full == 'Thursday')	{echo 'selected="selected"';}?>		>Thursday</option>
                                    <option value="Friday"		<?php if($curr_day_full == 'Friday')	{echo 'selected="selected"';}?>		>Friday</option>
                                    <option value="Saturday"	<?php if($curr_day_full == 'Saturday')	{echo 'selected="selected"';}?>		>Saturday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group m-t-10">
                                <label class="control-label pull-left">of</label>
                            </div>
                        </div>
                        <div class="col-md-3 p-l-0">
                        	<div class="form-group">
                                <select class="form-control" id="cus_sameWeekYear_monthsName" name="cus_sameWeekYear_monthsName">
                                    <option value="January"		<?php if($curr_month == 'January')	{echo 'selected="selected"';}?>		>January</option>
                                    <option value="February"	<?php if($curr_month == 'February')	{echo 'selected="selected"';}?>		>February</option>
                                    <option value="March"		<?php if($curr_month == 'March')	{echo 'selected="selected"';}?>		>March</option>
                                    <option value="April"		<?php if($curr_month == 'April')	{echo 'selected="selected"';}?>		>April</option>
                                    <option value="May" 		<?php if($curr_month == 'May')		{echo 'selected="selected"';}?>		>May</option>
                                    <option value="June" 		<?php if($curr_month == 'June')		{echo 'selected="selected"';}?>		>June</option>
                                    <option value="July" 		<?php if($curr_month == 'July')		{echo 'selected="selected"';}?>		>July</option>
                                    <option value="August" 		<?php if($curr_month == 'August')	{echo 'selected="selected"';}?>		>August</option>
                                    <option value="September" 	<?php if($curr_month == 'September'){echo 'selected="selected"';}?>		>September</option>
                                    <option value="October" 	<?php if($curr_month == 'October')	{echo 'selected="selected"';}?>		>October</option>
                                    <option value="November" 	<?php if($curr_month == 'November')	{echo 'selected="selected"';}?>		>November</option>
                                    <option value="December" 	<?php if($curr_month == 'December')	{echo 'selected="selected"';}?>		>December</option>
                                </select>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect text-left" onclick="get_custom_repeat();">Save</button>
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Event Title</label>
                                            <input type="text" id="event_title" name="event_title" class="form-control" placeholder="Add a title for the event" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-l-0">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Start</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="event_start_date" name="event_start_date" placeholder="Event Start Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 p-l-0">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp; </label>
                                            <select style="padding:0px;" class="form-control" id="event_start_time" name="event_start_time">
                                                <option value="12:00 AM">12:00 AM</option>
                                                <option value="12:30 AM">12:30 AM</option>
                                                <option value="01:00 AM">01:00 AM</option>
                                                <option value="01:30 AM">01:30 AM</option>
                                                <option value="02:00 AM">02:00 AM</option>
                                                <option value="02:30 AM">02:30 AM</option>
                                                <option value="03:00 AM">03:00 AM</option>
                                                <option value="03:30 AM">03:30 AM</option>
                                                <option value="04:00 AM">04:00 AM</option>
                                                <option value="04:30 AM">04:30 AM</option>
                                                <option value="05:00 AM">05:00 AM</option>
                                                <option value="05:30 AM">05:30 AM</option>
                                                <option value="06:00 AM">06:00 AM</option>
                                                <option value="06:30 AM">06:30 AM</option>
                                                <option value="07:00 AM">07:00 AM</option>
                                                <option value="07:30 AM">07:30 AM</option>
                                                <option value="08:00 AM">08:00 AM</option>
                                                <option value="08:30 AM">08:30 AM</option>
                                                <option value="09:00 AM" selected="selected">09:00 AM</option>
                                                <option value="09:30 AM">09:30 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="10:30 AM">10:30 AM</option>
                                                <option value="11:00 AM">11:00 AM</option>
                                                <option value="11:30 AM">11:30 AM</option>
                                                <option value="12:00 AM">12:00 PM</option>
                                                <option value="12:30 AM">12:30 PM</option>
                                                <option value="01:00 AM">01:00 PM</option>
                                                <option value="01:30 PM">01:30 PM</option>
                                                <option value="02:00 PM">02:00 PM</option>
                                                <option value="02:30 PM">02:30 PM</option>
                                                <option value="03:00 PM">03:00 PM</option>
                                                <option value="03:30 PM">03:30 PM</option>
                                                <option value="04:00 PM">04:00 PM</option>
                                                <option value="04:30 PM">04:30 PM</option>
                                                <option value="05:00 PM">05:00 PM</option>
                                                <option value="05:30 PM">05:30 PM</option>
                                                <option value="06:00 PM">06:00 PM</option>
                                                <option value="06:30 PM">06:30 PM</option>
                                                <option value="07:00 PM">07:00 PM</option>
                                                <option value="07:30 PM">07:30 PM</option>
                                                <option value="08:00 PM">08:00 PM</option>
                                                <option value="08:30 PM">08:30 PM</option>
                                                <option value="09:00 PM">09:00 PM</option>
                                                <option value="09:30 PM">09:30 PM</option>
                                                <option value="10:00 PM">10:00 PM</option>
                                                <option value="10:30 PM">10:30 PM</option>
                                                <option value="11:00 PM">11:00 PM</option>
                                                <option value="11:30 PM">11:30 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-3">
                                        <div class="form-group has-errorr">
                                            <div class="example">
                                            	<label class="control-label">Event Time</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="event_start_time" id="event_start_time" placeholder="09:30 am" value="" />
                                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                    <input type="text" class="form-control" name="event_end_time" id="event_end_time" placeholder="11:30 am" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="col-md-2 p-l-0">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">End</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="event_end_date" name="event_end_date" placeholder="Event End Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 p-l-0">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp; </label>
                                            <select style="padding:0px;" class="form-control" id="event_end_time" name="event_end_time">
                                                <option value="12:00 AM">12:00 AM</option>
                                                <option value="12:30 AM">12:30 AM</option>
                                                <option value="01:00 AM">01:00 AM</option>
                                                <option value="01:30 AM">01:30 AM</option>
                                                <option value="02:00 AM">02:00 AM</option>
                                                <option value="02:30 AM">02:30 AM</option>
                                                <option value="03:00 AM">03:00 AM</option>
                                                <option value="03:30 AM">03:30 AM</option>
                                                <option value="04:00 AM">04:00 AM</option>
                                                <option value="04:30 AM">04:30 AM</option>
                                                <option value="05:00 AM">05:00 AM</option>
                                                <option value="05:30 AM">05:30 AM</option>
                                                <option value="06:00 AM">06:00 AM</option>
                                                <option value="06:30 AM">06:30 AM</option>
                                                <option value="07:00 AM">07:00 AM</option>
                                                <option value="07:30 AM">07:30 AM</option>
                                                <option value="08:00 AM">08:00 AM</option>
                                                <option value="08:30 AM">08:30 AM</option>
                                                <option value="09:00 AM">09:00 AM</option>
                                                <option value="09:30 AM">09:30 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="10:30 AM">10:30 AM</option>
                                                <option value="11:00 AM" selected="selected">11:00 AM</option>
                                                <option value="11:30 AM">11:30 AM</option>
                                                <option value="12:00 AM">12:00 PM</option>
                                                <option value="12:30 AM">12:30 PM</option>
                                                <option value="01:00 AM">01:00 PM</option>
                                                <option value="01:30 PM">01:30 PM</option>
                                                <option value="02:00 PM">02:00 PM</option>
                                                <option value="02:30 PM">02:30 PM</option>
                                                <option value="03:00 PM">03:00 PM</option>
                                                <option value="03:30 PM">03:30 PM</option>
                                                <option value="04:00 PM">04:00 PM</option>
                                                <option value="04:30 PM">04:30 PM</option>
                                                <option value="05:00 PM">05:00 PM</option>
                                                <option value="05:30 PM">05:30 PM</option>
                                                <option value="06:00 PM">06:00 PM</option>
                                                <option value="06:30 PM">06:30 PM</option>
                                                <option value="07:00 PM">07:00 PM</option>
                                                <option value="07:30 PM">07:30 PM</option>
                                                <option value="08:00 PM">08:00 PM</option>
                                                <option value="08:30 PM">08:30 PM</option>
                                                <option value="09:00 PM">09:00 PM</option>
                                                <option value="09:30 PM">09:30 PM</option>
                                                <option value="10:00 PM">10:00 PM</option>
                                                <option value="10:30 PM">10:30 PM</option>
                                                <option value="11:00 PM">11:00 PM</option>
                                                <option value="11:30 PM">11:30 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 p-l-0">
                                    	<div class="form-group">
                                            <label class="control-label">&nbsp; </label>
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" id="all_day" name="all_day" value="all_day">
                                                <label for="all_day">All Day</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Event Location</label>
                                            <input type="text" id="event_location" name="event_location" class="form-control" placeholder="Add a Location" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-l-0">
                                        <div class="form-group">
                                            <label class="control-label">Assign To</label>
                                            <select class="form-control" id="assign_to_dp_ur" name="assign_to_dp_ur" required>
                                                <option value="">-Assign To-</option>
                                                <option value="all_users">All Users</option>
                                                <option value="all_depts">All Departments</option>
                                                <option value="user">Selected Users</option>
                                                <option value="dept">Selected Departments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="display:none;" id="user_drp">
                                        <div class="form-group">
                                            <label class="control-label">Users</label>
                                            <select class="selectpicker" multiple data-style="form-control" name="select_users_drp[]" id="select_users_drp">
												<?php foreach($users as $user_val){?>
                                                    <option value="<?php echo $user_val->id;?>"><?php echo $user_val->username;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="display:none;" id="dept_drp">
                                        <div class="form-group">
                                            <label class="control-label">Department</label>
                                            <select class="selectpicker" multiple data-style="form-control" name="select_dept_drp[]" id="select_dept_drp">
												<?php foreach($depts as $dept_val){?>
                                                    <option value="<?php echo $dept_val->id;?>"><?php echo $dept_val->name;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-l-0">
                                        <div class="form-group">
                                            <label class="control-label">Priority</label>
                                            <select class="form-control" name="className">
                                            	<option value='bg-success'>Success</option>
                                            	<option value='bg-purple'>Purple</option>
                                            	<option value='bg-danger'>Danger</option>
                                            	<option value='bg-primary'>Primary</option>
                                            	<option value='bg-inverse'>Blue</option>
                                            	<option value='bg-info'>Info</option>
                                            	<option value='bg-warning'>Warning</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-b-10">
                                	<div class="col-md-2">
                                        <div class="form-group m-b-0">
                                            <label class="control-label">Repeat</label>
                                            <select class="form-control" id="repeat_event" name="repeat_event">
                                                <option value="never">Never</option>
                                                <option value="daily">Every day</option>
                                                <option value="every_fullday">Every <?php echo $curr_day_full;?></option>
                                                <option value="every_workday">Every Workday</option>
                                                <option value="dayOfEveryMonth">Day <?php echo $curr_day;?> of every month</option>
                                                <option value="every_noOfday">Every <?php echo $weeks[$curr_week_num].' '.$curr_day_full;?></option>
                                                <option value="everyYear">Every <?php echo $curr_month.' '.$curr_day; ?></option>
                                                <option value="custom" data-toggle="modal" data-target=".bs-pending-ticket" data-backdrop="static" data-keyboard="false">Custom...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                    		<div class="col-md-5">
                                            	<div class="form-group m-b-0">
                                            		<label class="control-label">Reminder</label>
                                                    <select class="selectpicker" multiple data-style="form-control" id="reminder" name="reminder[]">
                                                        <option value="email" selected="selected">Email</option>
                                                        <option value="noti">Notification</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            	<div class="form-group m-b-0">
                                            		<label class="control-label"> &nbsp;</label>
                                                    <input class="form-control" type="number" min="1" id="rem_number" name="rem_number" value="1" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            	<div class="form-group m-b-0">
                                            		<label class="control-label"> &nbsp;</label>
                                                    <select class="form-control" id="rem_period" name="rem_period">
                                                    <option value="minutes" selected="selected">Minutes</option>
                                                    <option value="hours">Hours</option>
                                                    <option value="days">Days</option>
                                                    <option value="weeks">weeks</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="row">
                                	<div class="col-md-12">
                                        <small id="custom_message"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control" name="event_desc" id="event_desc" rows="7"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 p-l-0">Attachment:</label>
                                            <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                <input name="file" multiple="" type="file"> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?php echo base_url();?>"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>