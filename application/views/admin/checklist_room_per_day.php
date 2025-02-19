<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Checklist room/day</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Checklist room/day Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Checklist room/day</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="white-box"><!--Errors-->
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
								$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
                             ?>
                             <!--manage form data-->
                            <div class="table-responsive">
                                <?php 									
									
									
								
									$total_rooms	= count($rooms);
									$current_year 	= date('Y');
									if($quarter == '1st'){
										$start_date = strtotime('1-January-'.$current_year);
										$end_date = strtotime('31-March-'.$current_year);
									}else if($quarter == '2nd'){
										$start_date = strtotime('1-April-'.$current_year);
										$end_date = strtotime('30-June-'.$current_year);
									}else if($quarter == '3rd'){
										$start_date = strtotime('1-July-'.$current_year);
										$end_date = strtotime('30-September-'.$current_year);
									}else if($quarter == '4th'){
										$start_date = strtotime('1-October-'.$current_year);
										$end_date = strtotime('31-December-'.($current_year+1));
									}
									
									$weekWorkingDays = array("Monday","Tuesday","Wednesday","Thursday","Friday");
									
									$period = floor((($end_date) - ($start_date))/(24*60*60));
									$j=0;
									for($i = 0; $i < $period; $i++){
										if(in_array(date('l',strtotime("$start_date +$i day")),$weekWorkingDays)){
											$j++;
										}       
									}
									$total = $i+1;
									
									$start_date_rem = strtotime(date('d-F-Y'));
									$period_rem = floor((($end_date) - ($start_date_rem))/(24*60*60));
									$jj=0;
									
									for($x = 0; $x < $period_rem; $x++){
										$date_sec = date('Y-m-d', strtotime("+$x days"));
										if(in_array(date('l', strtotime($date_sec)),$weekWorkingDays)){
											$jj++;
										}       
									}
									
									
									
									
									$percentage_required = $comp_per[0]->percentage;
									$calPercentage = 0;
									$comp_rooms = 0;
									
									echo 'Each Room Completed %:<br>';
									if(is_array($rooms)){
										foreach($rooms as $val){
											$room_report = pm_report_helper::getRoomsCompleted($hotel_id, $val->room_no, $quarter);
											if(!empty($room_report)){$comp = $room_report[0]->completedRooms;}else{$comp =  '0';}
											
											$calPercentage = round((($comp / $total_rooms)*100),2);
											if($calPercentage >= $percentage_required){
												$comp_rooms++;
											}
											
											echo 'Room no:'.$val->room_no.' --- '.$calPercentage.'%<br>';
										}
									}
									$rooms_rem = $total_rooms - $comp_rooms;
									
									echo '<br> <hr>';
									echo 'Current Quarter: '.$quarter.'<br>';
									echo 'Total Rooms: '.$total_rooms.'<br>';
									echo 'Percentage Of Considering Room Complete: '.$percentage_required.'<br>';
									echo 'Total Days: '.$total.'<br>';
									echo 'Working Days: '.$j.'<br>';
									echo 'Working Days Remaining: '.$jj.'<br>';
									echo 'Rooms Remaining: '.$rooms_rem.'<br>';
									echo 'Rooms Completed in this Quater: '.$comp_rooms.'<br>';
									
									echo '<br> <hr>';
									echo 'Overall Status'.'<br>';
									echo 'Total Rooms / Working Days<br>';
									$Perday = round(($total_rooms / $j),2);
									echo 'Rooms Per Day in this Quarter: '.$Perday.'<br>';
									
									echo '<br> <hr>';
									echo 'Todays Status'.'<br>';
									echo 'Remaining Rooms / Remaining Working Days<br>';
									$Perdayrem = round(($rooms_rem / $jj),2);
									echo 'Current Rooms Required to complete Per Day: '.$Perdayrem.'<br>';
									
									
									/*SELECT COUNT(*) FROM `checklist_emp_record` WHERE `hotel_id` ='9' AND `room_no` = '117' AND `quarter` LIKE '2nd'*/
									/*https://www.codediesel.com/browser/adding-actions-to-gmail-using-schemas/*/
									
									?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>