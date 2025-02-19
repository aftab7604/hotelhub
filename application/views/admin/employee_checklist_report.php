<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Preventive Maintenance</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Preventive Maintenance Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Preventive Maintenance <?php echo $quarterHTML;?></div>
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
                             ?><!--checklist-->
                            <div class="table-responsive">
                                <table id="myTablePMP_chk_rept" class="table table-striped">
                                    <thead>
                                        <tr><th colspan="4"></th>
                                            <th colspan="4" style="text-align: center;">ANNUAL SCHEDULE</th>
                                            <th colspan="4" style="text-align: center;">COMPLETION PERCENTAGE</th>
                                            <th colspan="4" style="text-align: center;">NUMBER OF FLAGS</th>
                                        </tr>
                                        <tr>
                                            <th>Rooms</th>
                                            <th>Rooms Type</th>
                                            <!--<th>Last PM</th>-->
                                            <!--<th>Completed</th>
                                            <th>% Complete</th>
                                            <th># of Flags</th>-->
                                            <th>Last Edit</th>
                                            <th>Last User</th>
                                            <!--<th class="info">Next PM</th>-->
                                            
                                            <th>Q1</th>
                                            <th>Q2</th>
                                            <th>Q3</th>
                                            <th>Q4</th>
                                            
                                            <th class="info">Q1</th>
                                            <th class="info">Q2</th>
                                            <th class="info">Q3</th>
                                            <th class="info">Q4</th>
                                            
                                            <th>Q1</th>
                                            <th>Q2</th>
                                            <th>Q3</th>
                                            <th>Q4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php if(is_array($rooms)){
											$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
											$user_id	= $this->session->userdata['logged_in']['id'];
											$curr_quarter	= $quarter;
											
											$current_month 	= date('m');
											$current_year 	= date('Y');
											if($current_month>=1 && $current_month<=3){
												@$prev_Q 	= strtotime('1-October-'.$current_year-1);
												$next_Q 	= strtotime('1-April-'.$current_year);
											}
											else if($current_month>=4 && $current_month<=6){
												$prev_Q 	= strtotime('1-January-'.$current_year);
												$next_Q 	= strtotime('1-July-'.$current_year);
											}
											else if($current_month>=7 && $current_month<=9){
												$prev_Q 	= strtotime('1-April-'.$current_year);
												$next_Q 	= strtotime('1-October-'.$current_year);
											}
											else if($current_month>=10 && $current_month<=12){
												$prev_Q 	= strtotime('1-July-'.$current_year);
												@$next_Q 	= strtotime('1-January-'.$current_year+1);
											}
											$next_Quarter_Will = date('d M, Y', $next_Q);
											$prev_Quarter_Wass = date('d M, Y', $prev_Q);
											
										foreach($rooms as $val){
											$room_report = $comp_total = $check_total = $flag_total = '';
											$room_report			= pm_report_helper::get_checklist_records($hotel_id, $val->room_no, $curr_quarter);
											$RoomTypeChecklists		= pm_report_helper::getCountOfRoomTypeChecklists($hotel_id, $val->room_type);
											$CompletedChecklists	= pm_report_helper::getCountOfCompletedChecklists($hotel_id, $val->room_no, $curr_quarter);
											$FlaggedChecklists		= pm_report_helper::getCountOfFlaggedChecklists($hotel_id, $val->room_no, $curr_quarter);
											
											$completed_in_Q1		= pm_report_helper::getCountOfCompletedChecklists($hotel_id, $val->room_no, '1st');
											$completed_in_Q2		= pm_report_helper::getCountOfCompletedChecklists($hotel_id, $val->room_no, '2nd');
											$completed_in_Q3		= pm_report_helper::getCountOfCompletedChecklists($hotel_id, $val->room_no, '3rd');
											$completed_in_Q4		= pm_report_helper::getCountOfCompletedChecklists($hotel_id, $val->room_no, '4th');
											
											$flagged_in_Q1			= pm_report_helper::getCountOfFlaggedChecklists($hotel_id, $val->room_no, '1st');
											$flagged_in_Q2			= pm_report_helper::getCountOfFlaggedChecklists($hotel_id, $val->room_no, '2nd');
											$flagged_in_Q3			= pm_report_helper::getCountOfFlaggedChecklists($hotel_id, $val->room_no, '3rd');
											$flagged_in_Q4			= pm_report_helper::getCountOfFlaggedChecklists($hotel_id, $val->room_no, '4th');
										?>
                                    	<tr>
                                        	<td><?php echo $val->room_no;?></td>
                                            <td><?php echo $val->room_type;?></td>
                                        <!--<td><?php echo $prev_Quarter_Wass;?></td>
                                            <td><?php if($CompletedChecklists){$comp_total = $CompletedChecklists[0]->total_compt_checklists;}else{$comp_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												echo $comp_total .' OF '.$check_total;?></td>
                                            <td><?php echo $perc = round((($comp_total / $check_total)*100) ,2); ?></td>
                                            <td><?php if($FlaggedChecklists){$flag_total = $FlaggedChecklists[0]->total_flag_checklists;}else{$flag_total = '0';} echo $flag_total;?></td>-->
                                            <td><?php if(!empty($room_report)){$created_date = $room_report[0]->created_date; echo $c_date = date("d M, Y", strtotime($created_date));}else{echo '&mdash;';}?></td>
                                            <td><?php if(!empty($room_report)){$username = admin_helper::get_user_name($room_report[0]->user_id);
												if($username){echo $username[0]->username;}else{echo '&mdash;';}}?></td>
                                            <!--<td class="info"><?php echo $next_Quarter_Will;?></td>-->
                                            
                                            <td><a href="checklist/<?php echo $val->room_no;?>/<?php echo $val->room_type;?>/1st">01 Jan, <?php echo date('Y');?></a></td>
                                            <td><a href="checklist/<?php echo $val->room_no;?>/<?php echo $val->room_type;?>/2nd">01 Apr, <?php echo date('Y');?></a></td>
                                            <td><a href="checklist/<?php echo $val->room_no;?>/<?php echo $val->room_type;?>/3rd">01 Jul, <?php echo date('Y');?></a></td>
                                            <td><a href="checklist/<?php echo $val->room_no;?>/<?php echo $val->room_type;?>/4th">01 Oct, <?php echo date('Y');?></a></td>
                                                                                        
                                             <td class="info"><?php if($completed_in_Q1){$comp_total = $completed_in_Q1[0]->total_compt_checklists;}else{$comp_total = '0';}
													if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
													if($check_total == 0){$perc = '0';}else{$perc = round((($comp_total / $check_total)*100) ,2);}echo $perc;?>%</td>
                                            <td class="info"><?php if($completed_in_Q2){$comp_total = $completed_in_Q2[0]->total_compt_checklists;}else{$comp_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												if($check_total == 0){$perc = '0';}else{$perc = round((($comp_total / $check_total)*100) ,2);}echo $perc;?>%</td>
                                            <td class="info"><?php if($completed_in_Q3){$comp_total = $completed_in_Q3[0]->total_compt_checklists;}else{$comp_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												if($check_total == 0){$perc = '0';}else{$perc = round((($comp_total / $check_total)*100) ,2);}echo $perc;?>%</td>
                                            <td class="info"><?php if($completed_in_Q4){$comp_total = $completed_in_Q4[0]->total_compt_checklists;}else{$comp_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												if($check_total == 0){$perc = '0';}else{$perc = round((($comp_total / $check_total)*100) ,2);}echo $perc;?>%</td>
                                            
                                            <td><?php if($flagged_in_Q1){$flag_total = $flagged_in_Q1[0]->total_flag_checklists;}else{$flag_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												echo $flag_total .' OF '.$check_total;?></td>
                                            <td><?php if($flagged_in_Q2){$flag_total = $flagged_in_Q2[0]->total_flag_checklists;}else{$flag_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												echo $flag_total .' OF '.$check_total;?></td>
                                            <td><?php if($flagged_in_Q3){$flag_total = $flagged_in_Q3[0]->total_flag_checklists;}else{$flag_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												echo $flag_total .' OF '.$check_total;?></td>
                                            <td><?php if($flagged_in_Q4){$flag_total = $flagged_in_Q4[0]->total_flag_checklists;}else{$flag_total = '0';}
												if($RoomTypeChecklists){$check_total = $RoomTypeChecklists[0]->total_checklists;}else{$check_total = '0';}
												echo $flag_total .' OF '.$check_total;?></td>
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<style>
.buttons-pdf{
	margin-left:10px !important;
}
</style>