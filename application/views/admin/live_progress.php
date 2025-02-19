<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Live Progress</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Live Progress Page</li>
            </ol>
        </div>
    </div>
    
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Live Progress</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                    	<div class="panel-body p-t-10">
                             <?php
								if($this->session->flashdata('flash_data') != ""){
									echo '<div class="alert alert-success alert-dismissable">';
									echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
									echo $this->session->flashdata('flash_data');
									echo '</div>';
								}
								if ($this->session->flashdata('flash_data_danger') != ""){
									echo '<div style=" margin: 10px;" class="alert alert-danger alert-dismissable">';
									echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
									echo $this->session->flashdata('flash_data_danger');
									echo '</div>';
								}
								$assignedRooms	= array();
								$both_strings	= '';
								if(is_array($house_keeping_info)){foreach($house_keeping_info as $hk_info_val){
									$both_strings .= $hk_info_val->assign_rooms.',';
								}}
								$both_strings	= trim($both_strings,',');
								$assignedRooms	= explode(',', $both_strings);
								?>
                            <!--<h3 class="box-title">Todays Assigned Housekeeping</h3>-->
                            <div class="table-responsive">
                            <table id="myTableMPOR" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Room No.</th>
                                        <th>Employee</th>
                                        <th>Checkout/Stayover</th>
                                        <th>Status</th>
                                        <th>Started</th>
                                        <th>Finished</th>
                                        <th>Timer</th>
                                        <th>GAP</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php if(is_array($house_keeping_info)){
                                    foreach($house_keeping_info as $key => $hk_info_val){
										$room_types			= admin_helper::get_room_type($hk_info_val->hotel_id, $hk_info_val->assign_rooms);
										
										/*$latest_completed	= admin_helper::get_latest_completed($completedRoom[0]->hotel_id, $completedRoom[0]->assign_to_id, 'Completed', $completedRoom[0]->started_at, $current_date);*/
									?>
										<tr>
											<td><?php echo $hk_info_val->assign_rooms.' ('.$room_types[0]->room_type.')'; ?></td>
											<td><?php $username = admin_helper::get_user_name($hk_info_val->assign_to_id);echo ucfirst($username[0]->username);?></td>
											<td><?php echo ucfirst($hk_info_val->chk_stay);?></td>
											<td id="status_<?php echo $hk_info_val->mpor_id;?>">
											</td>
											<td id="startedTime_<?php echo $hk_info_val->mpor_id; ?>"></td>
											<td id="completedTime_<?php echo $hk_info_val->mpor_id; ?>"></td>
											<td><time id="timerValue_<?php echo $hk_info_val->mpor_id;?>"></time>
                                            </td>
											<td><time id="timerValueeee_<?php echo $hk_info_val->mpor_id;?>"></time>
											</td>
										</tr>
										<?php 
										
										
										/*$current_date   = gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
										$fulldate 		= gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
										$inProgressRoom = admin_helper::get_hk_emp_status($hk_info_val->hotel_id, $hk_info_val->assign_to_id, 'In-Progress', $current_date);
										
										if(is_array($inProgressRoom) && !empty($inProgressRoom)){
											$room_types 		= admin_helper::get_room_type($inProgressRoom[0]->hotel_id, $inProgressRoom[0]->assign_rooms);
											$latest_completed	= admin_helper::get_latest_completed($inProgressRoom[0]->hotel_id, $inProgressRoom[0]->assign_to_id, 'Completed', $inProgressRoom[0]->started_at, $current_date);
											if(is_array($latest_completed) && !empty($latest_completed)){
												$dateStart = new DateTime($latest_completed[0]->completed_at);
												$dateEnd   = new DateTime($inProgressRoom[0]->started_at);																	
												$dateDiff  = $dateStart->diff($dateEnd);
												$gap = $dateDiff->format("%H:%I:%S");
											}else{$gap = '&mdash;';}
											?>
											<tr>
                                                <td><?php echo $inProgressRoom[0]->assign_rooms.' ('.$room_types[0]->room_type.')'; ?></td>
                                                <td><?php $username = admin_helper::get_user_name($inProgressRoom[0]->assign_to_id);echo ucfirst($username[0]->username);?></td>
                                                <td><?php echo ucfirst($inProgressRoom[0]->chk_stay);?></td>
                                                <td><?php echo ucfirst($inProgressRoom[0]->status);?></td>
                                                <td><?php if($inProgressRoom[0]->started_at != '0000-00-00 00:00:00'){$started_date = date_create($inProgressRoom[0]->started_at);echo date_format($started_date,"H:i A");}else{echo '&mdash;';}?></td>
                                                <td><?php if($inProgressRoom[0]->completed_at != '0000-00-00 00:00:00'){$complet_date = date_create($inProgressRoom[0]->completed_at);echo date_format($complet_date,"H:i A");}else{echo '&mdash;';}?></td>
                                                <td><time id="timerValue_<?php echo $inProgressRoom[0]->mpor_id;?>"></time>
													<?php
                                                        $dateStart = new DateTime($inProgressRoom[0]->started_at);
                                                        $dateEnd   = new DateTime($fulldate);																	
                                                        $dateDiff  = $dateStart->diff($dateEnd);
                                                        $started_time = $dateDiff->format("%H:%I:%S");
                                                        $started_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $started_time);
                                                        sscanf($started_time, "%d:%d:%d", $hours, $minutes, $seconds);
                                                        $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                                                    ?>
                                                    <script>
                                                        $('#timerValue_'+<?php echo $inProgressRoom[0]->mpor_id;?>).timer({
                                                            seconds: <?php echo $time_seconds;?>,
                                                            format: '%H:%M:%S',
                                                        });
                                                    </script>
                                                </td>
                                                <td><?php echo $gap;?></td>
                                            </tr>
									<?php }else{
										$completedRoom = admin_helper::get_hk_emp_status($hk_info_val->hotel_id, $hk_info_val->assign_to_id, 'Completed', $current_date);
											if(is_array($completedRoom) && !empty($completedRoom)){
												$room_types			= admin_helper::get_room_type($completedRoom[0]->hotel_id, $completedRoom[0]->assign_rooms);
												$latest_completed	= admin_helper::get_latest_completed($completedRoom[0]->hotel_id, $completedRoom[0]->assign_to_id, 'Completed', $completedRoom[0]->started_at, $current_date);
												?>
                                                <tr>
                                                    <td><?php echo $completedRoom[0]->assign_rooms.' ('.$room_types[0]->room_type.')'; ?></td>
                                                    <td><?php $username = admin_helper::get_user_name($completedRoom[0]->assign_to_id);echo ucfirst($username[0]->username);?></td>
                                                    <td><?php echo ucfirst($completedRoom[0]->chk_stay);?></td>
                                                    <td><?php echo ucfirst($completedRoom[0]->status);?></td>
                                                    <td><?php if($completedRoom[0]->started_at != '0000-00-00 00:00:00'){$started_date = date_create($completedRoom[0]->started_at);echo date_format($started_date,"H:i A");}else{echo '&mdash;';}?></td>
                                                    <td><?php if($completedRoom[0]->completed_at != '0000-00-00 00:00:00'){$complet_date = date_create($completedRoom[0]->completed_at);echo date_format($complet_date,"H:i A");}else{echo '&mdash;';}?></td>
                                                    <td><time id="timerValue_<?php echo $completedRoom[0]->mpor_id;?>"></time>
														<?php 
                                                            $dateStart = new DateTime($completedRoom[0]->started_at);
                                                            $dateEnd   = new DateTime($completedRoom[0]->completed_at);																	
                                                            $dateDiff  = $dateStart->diff($dateEnd);
                                                            print $dateDiff->format("%H:%I:%S");
                                                        ?>
                                                    </td>
                                                    <td><time id="timerValueeee_<?php echo $hk_info_val->mpor_id;?>"></time>
                                                    	<?php
															if(isset($house_keeping_info[$key+1]) && $house_keeping_info[$key+1]->status == 'Completed' && $hk_info_val->status == 'Completed'){
																$dateStart_gap	= new DateTime($hk_info_val->completed_at);
																$dateEnd_gap	= new DateTime($house_keeping_info[$key+1]->started_at);
																$dateDiff_gap	= $dateStart_gap->diff($dateEnd_gap);
																echo $gap		= $dateDiff_gap->format("%H:%I:%S");
															}
															else if(isset($house_keeping_info[$key+1]) && $house_keeping_info[$key+1]->status == 'In-Progress' && $hk_info_val->status == 'Completed'){
																$dateStart_gap	= new DateTime($hk_info_val->completed_at);
																$dateEnd_gap	= new DateTime($house_keeping_info[$key+1]->started_at);																														
																$dateDiff_gap	= $dateStart_gap->diff($dateEnd_gap);
																echo $gap		= $dateDiff_gap->format("%H:%I:%S");
															}
															else if(isset($house_keeping_info[$key+1]) && $house_keeping_info[$key+1]->status == 'Pending' && $hk_info_val->status == 'Completed'){
																$dateStart		= new DateTime($hk_info_val->completed_at);
																$dateEnd		= new DateTime(gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'].' hours')));						
																$dateDiff		= $dateStart->diff($dateEnd);
																$started_time	= $dateDiff->format("%H:%I:%S");
																$started_time	= preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $started_time);
																sscanf($started_time, "%d:%d:%d", $hours, $minutes, $seconds);
																$time_seconds	= $hours * 3600 + $minutes * 60 + $seconds;
														?>
														<script> //https://github.com/walmik/timer.jquery////http://jquerytimer.com/
                                                            $('#timerValueeee_'+<?php echo $hk_info_val->mpor_id;?>).timer({
                                                                seconds: <?php echo $time_seconds;?>,
                                                                format: '%H:%M:%S',
                                                            });
                                                        </script>
                                                        <?php }else{echo '&mdash;';}?>
                                                    </td>
                                                </tr>
										<?php }else{*/?>
                                        	<!--<tr><td></td><td></td><td class="text-center"><?php #$username = admin_helper::get_user_name($hk_info_val->assign_to_id);echo ucfirst($username[0]->username);?> is idle since morning</td><td></td><td></td><td></td><td></td><td></td></tr>-->
										<?php /*}}*/?>
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