<?php
if($this->session->userdata['logged_in']['mngrInsptr'] == 'manager'){$sub_role = ' (Manager)';}else if($this->session->userdata['logged_in']['mngrInsptr'] == 'inspector'){$sub_role = ' (Inspector)';}else{$sub_role = '';}
if(isset($this->session->userdata['logged_in'])){
	$user_role = admin_helper::get_role_name($this->session->userdata['logged_in']['role']);
	$user_role_name = $user_role[0]->name;
}else{$user_role_name = '';}
?>
<div class="container-fluid">
    <div class="row bg-title">
        <!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title text-center">
            	Welcome back <?php #echo $this->session->userdata['logged_in']['first_name'].' '.$this->session->userdata['logged_in']['last_name'];?>
            </h4>
        </div>-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <h4 class="page-title text-center font-bold text-center">
            	<?php
					$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
					$user_id	= $this->session->userdata['logged_in']['id'];
					if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] == '8')){
						$user_info		= admin_helper::get_user_name($user_id);
						if($user_info[0]->multi_firms != ''){
						$multi_firms	= admin_helper::get_multiple_hotels($user_info[0]->multi_firms);
						
					?>
                	<div class="row"><div class="hidden-lg hidden-md col-sm-12 col-xs-12 text-center">
                        <select class="col-md-4 form-control select2x" id="single_hotel" required>
                            <?php if(is_array($multi_firms)){foreach($multi_firms as $multi_firm){?>
                            <option value="<?php echo $multi_firm->hotel_id; ?>" <?php if($multi_firm->hotel_id == $hotel_id){echo 'selected="selected"';} ?>><?php echo $multi_firm->hotel_name; ?></option>
                            <?php }} ?>
                        </select>
					</div></div>
					<?php }
					}else if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] != '1' && $this->session->userdata['logged_in']['role'] != '8')){
						$hotel_name = admin_helper::get_hotel_name($hotel_id);
						echo $hotel_name[0]->hotel_name;
					}
				?>
            </h4>
    		<div class="custom-translate" style="display: none;" id="google_translate_element"></div>
        </div><!--Y-m-d -->
        <!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
            	<li><marquee><?php #echo date("l, F d, Y");?></marquee></li>
            </ol>
        </div>-->
    </div>
    
    <!--Rooms-->
    <?php if($this->session->userdata['logged_in']['role'] != '1'){?>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box m-b-10 p-t-10 p-b-10">
                    <h3 class="box-title">Rooms</h3>
                    <!--<a target="_blank" href="<?php echo base_url();?>ticket/create_ticket"><button type="button" class="btn btn-warning waves-effect waves-lighte m-b-10">Create Service Ticket</button></a>-->
                    <div class="clear"></div>
                    <?php 
						$pnd_ticket_rooms = array();
						$pkup_ticket_rooms = array();
						if(is_array($pendingRoomsTik)){
							foreach($pendingRoomsTik as $pend_rooms_tickts){
								$pnd_ticket_rooms[] = $pend_rooms_tickts->pendingtickets;
							}
						}
						if(is_array($pickupRoomsTik)){
							foreach($pickupRoomsTik as $pkup_rooms_tickts){
								$pkup_ticket_rooms[] = $pkup_rooms_tickts->pickuptickets;
							}
						}
						$checklist_c = array();
						if(is_array($checklist)){
							foreach($checklist as $created_checklist){
								$checklist_c[] = $created_checklist->type;
							}
						}
						
						if(is_array($rooms)){
							foreach($rooms as $val){								
								$room_serviceR = admin_helper::get_room_serviceRec($this->session->userdata['logged_in']['firm_id'], $val->room_no);
								if($room_serviceR){
									$serviceR 		= $room_serviceR[0]->service_rec;
									$assign_to		= $room_serviceR[0]->assign_to_dept;
									$ticketStatus	= $room_serviceR[0]->ticket_status;
									$dept			= $room_serviceR[0]->dept_name;
								}else{$serviceR='';$ticketStatus='';}
								
								if(in_array($val->room_no, $pnd_ticket_rooms)){$button = 'danger';}
								else if(in_array($val->room_no, $pkup_ticket_rooms)){$button = 'yellow';}else{$button = 'success';}
								
								if(in_array($val->room_type, $checklist_c)){
                                    if($serviceR == 'yes' && $ticketStatus == '1'){?>
                                    	<a class="mytooltip" href="/pmp/checklist/<?php echo $val->room_no;?>/<?php echo $val->room_type;?>"><button style="margin-bottom:3px;" type="button" class="btn btn-danger waves-effect waves-light m-b-5" id="<?php echo $val->room_no;?>"><blink style="color:#FFF;"><?php echo $val->room_no;?></blink></button>
                                        <span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php if($room_serviceR[0]->guest_name){echo $room_serviceR[0]->guest_name.'!<br />';}echo $dept;?></span></span></span></a>
									<?php }
									elseif($serviceR == 'yes' && $ticketStatus == '2'){?>
                                    	<a class="mytooltip" href="/pmp/checklist/<?php echo $val->room_no;?>/<?php echo $val->room_type;?>"><button style="margin-bottom:3px;" type="button" class="btn btn-yellow waves-effect waves-light m-b-5" id="<?php echo $val->room_no;?>"><blink style="color:#000;"><?php echo $val->room_no;?></blink></button>
                                        <span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2"><?php if($room_serviceR[0]->guest_name){echo $room_serviceR[0]->guest_name.'!<br />';}echo $dept;?></span></span></span></a>
									<?php }
									else{?>
                                		<a href="/pmp/checklist/<?php echo $val->room_no;?>/<?php echo $val->room_type;?>"><button style="margin-bottom:3px;" type="button" class="btn btn-<?php echo $button;?> waves-effect waves-light m-b-5" id="<?php echo $val->room_no;?>"><?php echo $val->room_no;?></button></a>
								<?php }}
								else{?>
                                	<button type="button" class="btn btn-<?php echo $button;?> waves-effect waves-light m-b-5 checklistNotCreated" id="<?php echo $val->room_no;?>"><?php echo $val->room_no;?></button>
						<?php }}}?>
                </div>
            </div>
        </div>
    <?php }?>
    
    <!--Scrollor-->
    <?php if($this->session->userdata['logged_in']['role'] != '1'){?>
    <div class="row hidden">
    	<div class="col-md-12">
            <div class="white-box p-t-0 p-b-0">
                <div id="carousel">
                  	<div class="btn-bar hidden"><div id="buttons"><a id="prev" href="#"><</a><a id="next" href="#">></a></div></div>
                    <div id="slides">
                        <ul>
                            <?php 	$hotel_id		= $this->session->userdata['logged_in']['firm_id'];
									$CURRENT_DATE 	= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
							if(is_array($slide_types)){foreach($slide_types as $slides){
								$eachTypeOfSlides = admin_helper::getScrollsByTypes($hotel_id, $slides->scroll_type, $slides->filter_range, $CURRENT_DATE, $limit=3);
                                if(!empty($eachTypeOfSlides)){
									if($slides->scroll_type == 'top_PM' or $slides->scroll_type == 'top_Cleaned' or $slides->scroll_type == 'top_sales_tickets' or $slides->scroll_type == 'top_guest_recovery' or $slides->scroll_type == 'tickets_completed'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
											<?php foreach($eachTypeOfSlides as $eachType){?>
												<div class="col-md-4 col-sm-4">
													<div class="media">
														<div class="media-body">
															<h4 class="media-heading"><?php echo $eachType->guest_name;?><span class="sl-date"> room # <?php echo $eachType->room_no.' '.$eachType->room_type;?></span></h4>
															<div class="row">
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light">
                                                                <?php if($eachType->generated_by > 0){$user_name = admin_helper::get_user_name($eachType->generated_by); echo 'Generated By:'.$user_name[0]->username;}?></small></div>
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light">Assign To: <?php $dept_name = admin_helper::get_role_name($eachType->assign_to_dept); echo $dept_name[0]->name;?></small></div>
															</div>
														 </div>
													</div>
												</div>
											<?php }?>
										</div></li>
									<?php }
									if($slides->scroll_type == 'users_tickets_created' or $slides->scroll_type == 'users_tickets_closed'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
											<?php foreach($eachTypeOfSlides as $eachType){?>
												<div class="col-md-4 col-sm-4">
													<div class="media">
														<div class="media-body">
															<h4 class="media-heading"><?php if($eachType->total_Tickets > 0){$user_name = admin_helper::get_user_name($eachType->generated_by); echo $user_name[0]->username;}?></h4>
															<div class="row">
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light">Total Tickets: <?php echo $eachType->total_Tickets;?></small></div>
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light"></small></div>
															</div>
														 </div>
													</div>
												</div>
											<?php }?>
										</div></li>
									<?php }
									if($slides->scroll_type == 'percentage_of_pickup_tickets' or $slides->scroll_type == 'percentage_of_pending_tickets' or $slides->scroll_type == 'percentage_of_close_tickets'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
											<?php foreach($eachTypeOfSlides as $eachType){?>
												<div class="col-md-4 col-sm-4">
													<div class="media">
														<div class="media-body">
															<h4 class="media-heading"></h4>
															<div class="row">
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light">Percentage: 
																<?php echo $per = number_format(($eachType->TotalTypeTickets / $eachType->TotalTickets)*100, 2) .'%'; ?></small></div>
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light"><?php #echo $eachType->TotalTickets;?></small></div>
															</div>
														 </div>
													</div>
												</div>
											<?php }?>
										</div></li>
									<?php }
									if($slides->scroll_type == 'avg_tickets_completed_time' or $slides->scroll_type == 'avg_guest_recovery_completing_time'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
											<?php $Total_Rows = count($eachTypeOfSlides);$secondsSum = 0;
												foreach($eachTypeOfSlides as $eachType){
													$pickup_date	= new DateTime($eachType->pickup_date);
													$close_date		= new DateTime($eachType->close_date);
													$dateDiff		= $pickup_date->diff($close_date);
													$totalDiff		= $dateDiff->format("%H:%I:%S");
													$parts			= explode(':', $totalDiff);
													$secondsSum		+= ($parts[0] * 3600) + ($parts[1] * 60) + $parts[2];
													
													$Cal_Time		= $secondsSum / $Total_Rows;
													$AvgTimeMPOR 	= gmdate('H:i:s', $Cal_Time);
												}
											?>
                                            	<div class="col-md-4 col-sm-4"></div>
												<div class="col-md-4 col-sm-4">
													<div class="media">
														<div class="media-body">
															<h4 class="media-heading"></h4>
															<div class="row">
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light">Average Time: <?php echo $AvgTimeMPOR;?></small></div>
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light"></small></div>
															</div>
														 </div>
													</div>
												</div>
                                                <div class="col-md-4 col-sm-4"></div>
										</div></li>
									<?php }
									if($slides->scroll_type == 'top_MPOR'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
											<?php $allSec = array();
												foreach($eachTypeOfSlides as $rowCounter=>$eachType){
													$pickup_date	= new DateTime($eachType->started_at);
													$close_date		= new DateTime($eachType->completed_at);
													$dateDiff		= $pickup_date->diff($close_date);
													$totalDiff		= $dateDiff->format("%H:%I:%S");
													$parts			= explode(':', $totalDiff);
													$allSec[$rowCounter]		= ($parts[0] * 3600) + ($parts[1] * 60) + $parts[2];
												}
													asort($allSec, SORT_NUMERIC);
													$timeDiffArray 			 = array_slice($allSec, 0, 3, true);
													$arrayOfEachTypeOfSlides = (array)$eachTypeOfSlides;
													foreach($timeDiffArray as $i=>$postData){
														$timeDiffArray[$i] = (array)$arrayOfEachTypeOfSlides[$i];
														$timeDiffArray[$i]["timeDiff"]=$postData;
													}
												foreach($timeDiffArray as $MPOR_DATA){?>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4 class="media-heading"><?php if($MPOR_DATA['assign_to_id'] > 0){$user_name = admin_helper::get_user_name($MPOR_DATA['assign_to_id']); echo $user_name[0]->username;}?></h4>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light"><?php echo $MPOR_DATA['chk_stay'];?></small></div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light">Average Time: <?php echo gmdate('H:i:s', $MPOR_DATA["timeDiff"]);?></small></div>
                                                                </div>
                                                             </div>
                                                        </div>
                                                    </div>
                                               <?php }?>
										</div></li>
									<?php }
									if($slides->scroll_type == 'upcoming_events'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
											<?php foreach($eachTypeOfSlides as $eachType){?>
												<div class="col-md-4 col-sm-4">
													<div class="media">
														<div class="media-body">
															<h4 class="media-heading"><?php echo $eachType->title;?> <span class="sl-date"> <?php echo $eachType->event_start;?></span></h4>
															<div class="row">
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light"><?php if($eachType->location != ''){echo 'Location:'.$eachType->location;}?></small></div>
																<div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light"><?php if($eachType->description != ''){echo 'Description:'.$eachType->description;}?></small></div>
															</div>
														 </div>
													</div>
												</div>
											<?php }?>
										</div></li>
									<?php }
									if($slides->scroll_type == 'PM_completed/Flagged_Pie_Chart'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
												<div class="col-md-12 col-sm-12">
													<canvas id="pm_completed_flagged" height="170"></canvas>
												</div>
                                                <script>
													$(document).ready(function(){
														/*var pieData = [{
																value: <?php echo $eachTypeOfSlides[0]->total_completed;?>,
																color: "#32CD32",
																highlight: "#32CD32",
																label: "Completed",
																labelColor: 'white',
																labelFontSize: '11'
															},{
																value: <?php echo $eachTypeOfSlides[0]->total_flagged;?>,
																color: "#DC143C",
																highlight: "#DC143C",
																label: "Flagged",
																labelColor: 'white',
																labelFontSize: '11'
															}];
														var myPie = new Chart(document.getElementById("pm_completed_flagged").getContext("2d")).Pie(pieData,{
															segmentShowStroke : true,
															segmentStrokeColor : "#fff",
															segmentStrokeWidth : 0,
															animationSteps : 100,
															tooltipCornerRadius: 0,
															animationEasing : "easeOutBounce",
															animateRotate : true,
															animateScale : false,
															responsive: true
														});*/
													});
												</script>
										</div></li>
									<?php }
									if($slides->scroll_type == 'Pending/Picked_Up_And_Completed_Tickets_Pie_Chart'){?>
										<li class="slide"><h3 class="box-title m-b-0"><?php echo ucwords(str_replace("_", " ", $slides->scroll_type));?> <span class="sl-date"><?php echo $slides->filter_range;?></span></h3><div class="row">
												<div class="col-md-12 col-sm-12">
													<!--<canvas id="pending_picked_close_tkts" height="170"></canvas>-->
                                                    <div id="pending_picked_close_tkts" style="height:318px;"></div>
												</div>
                                                <script>
													$(document).ready(function(){
														/*$('#slides').css({'height': '350px'});
														Morris.Donut({
															element: 'pending_picked_close_tkts',
															data: [{
																label: "Pending",
																value: <?php echo $eachTypeOfSlides[0]->total_pending;?>,
															}, {
																label: "Picked",
																value: <?php echo $eachTypeOfSlides[0]->total_picked;?>,
															}, {
																label: "Closed",
																value: <?php echo $eachTypeOfSlides[0]->total_closed;?>,
															}],
															resize: true,
															colors: ['#ff7676', '#2cabe3', '#53e69d']
														});*/
													});
												</script>
										</div></li>
									<?php }
								}}}?>
                        </ul>
                    </div>
                 </div>
            </div>
        </div>
	</div>
    <?php }?>    
    <!--Tickets Stats-->
    <?php if($this->session->userdata['logged_in']['role'] != '1'){?>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row row-in">
                        <div class="col-lg-3 col-sm-6 row-in-br">
                            <ul class="col-in">
                                <li><span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span></li>
                                <li class="col-last p-0"><h3 class="counter text-right m-t-15"><?php echo $pendingTicket;?></h3></li>
                                <li class="col-middle">
                                    <h4><a href="<?php echo base_url();?>ticket/pending_tickets">Pending Tickets</a></h4>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </li>
                                <?php
								if(is_array($old_pendingTicket)){
									$T_id = $old_pendingTicket[0]->ticket_id;
									$C_date = gmdate('Y-m-d H:i:s A', strtotime($old_pendingTicket[0]->created_date));
								}else{
									$T_id = $C_date = '';
								}
								?>
                                <span class="text-center"><?php echo $C_date;?> <a href="<?php echo base_url();?>ticket/ticket_info/<?php echo $T_id;?>" target="_blank">View Ticket</a></span>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-sm-6 row-in-br b-r-none">
                            <ul class="col-in">
                                <li><span class="circle circle-md bg-yellow"><i class="ti-wallet"></i></span></li>
                                <li class="col-last p-0"><h3 class="counter text-right m-t-15"><?php echo $pickupTicket;?></h3></li>
                                <li class="col-middle">
                                    <h4><a href="<?php echo base_url();?>ticket/picked_tickets">Picked-up Tickets</a></h4>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </li>
                                <?php
								if(is_array($old_pickupTicket)){
									$T_id = $old_pickupTicket[0]->ticket_id;
									$C_date = gmdate('Y-m-d H:i:s A', strtotime($old_pickupTicket[0]->created_date));
								}else{
									$T_id = $C_date = '';
								}
								?>
                                <span class="text-center"><?php echo $C_date;?> <a href="<?php echo base_url();?>ticket/ticket_info/<?php echo $T_id;?>" target="_blank">View Ticket</a></span>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-sm-6 row-in-br">
                            <ul class="col-in">
                                <li><span class="circle circle-md bg-success"><i class=" ti-close"></i></span></li>
                                <li class="col-last p-0"><h3 class="counter text-right m-t-15"><?php echo $closeTicket;?></h3></li>
                                <li class="col-middle">
                                    <h4><a href="<?php echo base_url();?>ticket/closed_tickets">Closed Tickets</a></h4>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-sm-6 b-0">
                            <ul class="col-in">
                                <li><span class="circle circle-md bg-info"><i class="ti-archive"></i></span></li>
                                <li class="col-last p-0"><h3 class="counter text-right m-t-15"><?php echo $TotalTicket;?></h3></li>
                                <li class="col-middle">
                                    <h4>Total Tickets</h4>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    
    <!--Session Print-->
    <?php if($this->session->userdata['logged_in']['id'] == '6'){?>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">Dashboard Page</h3>
                <?php
                    if (isset($this->session->userdata['logged_in'])) {
						
						echo '<pre>';
						print_r($this->session->userdata['logged_in']);
												
						echo 'GMT: '.gmdate("Y-m-d H:i:s A") . "<br>";
						echo 'PST: '.$new_time = gmdate('Y-m-d H:i:s A', strtotime('+ 5 hours')) . " (+5 Hours)<br>";
						echo 'USA: '.$new_time = gmdate('Y-m-d H:i:s A', strtotime($this->session->userdata['logged_in']['tz'].' hours')) . "<br><hr><br>";
						
						echo 'PST: '.$new_time = date("Y-m-d H:i:s A", strtotime('+5 hours', strtotime(gmdate("Y-m-d H:i:s A")))) . " (+5 Hours)<br>";
						echo 'USA: '.$new_time = date("Y-m-d H:i:s A", strtotime($this->session->userdata['logged_in']['tz'].' hours', strtotime(gmdate("Y-m-d H:i:s A"))));
						echo '<br>TZ: '.$this->session->userdata['logged_in']['tz'];
						
                        //echo $username = ($this->session->userdata['logged_in']['username']).'<br>';
                        //echo $role = ($this->session->userdata['logged_in']['role']);
                    } else {
                        header("location: register");
                    }
                ?>
            </div>
        </div>
    </div>
    <?php }?>
    <!--service book-->
    <div class="row">
        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">SERVICE BOOK <span class="pull-right"><a target="_blank" href="<?php echo base_url();?>logbook"><button type="button" class="btn btn-danger waves-effect waves-light">Load More</button></a></span></h3>
                <div class="row minus-margin b-b">
                    <div class="col-sm-12 b-t b-r text-center">
                        <ul class="expense-box">
                            <li class="p-l-0" style="margin-left: -30px;"><i class="mdi mdi-comment-multiple-outline text-info"></i>
                                <div>
                                    <h2><?php echo str_pad($total_posts, 2, '0', STR_PAD_LEFT);?></h2>
                                    <h4>POSTS</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
				<?php if(is_array($logs_entry)){
                    foreach($logs_entry as $val){
                        $repDate = date("d M, Y", strtotime($val->added_date));
                        $repTime = date("h:i a", strtotime($val->added_date));
                        if($val->likes >0){$likeP = ' fa-thumbs-up';}else{$likeP = ' fa-thumbs-o-up';}
                        ?>
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $val->heading;?> <span class="sl-date">By <?php echo $val->user_name;?></span></h4> <?php echo htmlspecialchars_decode($val->message);?><br />
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <a href="javascript:;" onclick="likeParentLog(<?php echo $val->lead_id;?>);"><i class="fa<?php echo $likeP;?>"></i></a><?php if($val->likes >0){echo '('.$val->likes.')';}?>&nbsp;&nbsp;&nbsp;
                                        <!--<a href="javascript:;"><i class="fa fa-paperclip"></i></a>&nbsp;&nbsp;&nbsp;-->
                                        <?php if($val->file_name){?>
                                            <a class="image-popup-vertical-fit" href="<?php echo base_url();?>assets/images/logbook_images/<?php echo $val->file_name;?>"><i class="fa fa-paperclip"></i></a>&nbsp;&nbsp;&nbsp;
                                        <?php }?>
                                        <small class="text-muted font-light"><a href="javascript:;" onclick="getLeadId(<?php echo $val->lead_id;?>);" data-toggle="modal" data-target="#responsive-modal-reply">Reply</a></small>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12"><small class="text-muted font-light"><?php echo $repDate.' '.$repTime;?></small></div>
                                </div>
                             </div>
                        </div>
                <?php }}?>
            </div>
        </div>
        <div class="col-md-8">
        	<div class="white-box">
            	<h3 class="box-title">USER FOOTPRINTS <?php if($this->session->userdata['logged_in']['role'] == '2' || $this->session->userdata['logged_in']['role'] == '8'){?><span class="pull-right"><a target="_blank" href="<?php echo base_url();?>users/tracking"><button type="button" class="btn btn-danger waves-effect waves-light">Load More</button></a></span><?php }?></h3>
                <div class="row minus-margin b-b">
                    <div class="col-sm-12 col-sm-6  b-t b-r">
                        <ul class="expense-box">
                            <li><i class="fa fa-users text-info"></i>
                                <div>
                                    <h2><?php echo str_pad(count($total_users), 2, '0', STR_PAD_LEFT);?></h2>
                                    <h4>MEMBERS</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-sm-6  b-t">
                        <ul class="expense-box">
                            <li><i class="fa fa-power-off text-info"></i>
                                <div>
                                    <h2><?php echo str_pad($online_users, 2, '0', STR_PAD_LEFT);?></h2>
                                    <h4>ONLINE</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <table class="table table-hover m-b-0">
                    <tbody id="results">
                        <?php echo $user_tracking;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--<div class="col-md-8">
            <div class="white-box">
                <div id="calendar_info">
                	<?php 
						/*$hotel_id		= $this->session->userdata['logged_in']['firm_id'];
						$total_rooms	= count($rooms);
						$current_year 	= date('Y');
						if($quarter == '1st'){
							$start_date = strtotime('1-January-'.$current_year);
							$end_date	= strtotime('31-March-'.$current_year);
						}else if($quarter == '2nd'){
							$start_date = strtotime('1-April-'.$current_year);
							$end_date	= strtotime('30-June-'.$current_year);
						}else if($quarter == '3rd'){
							$start_date = strtotime('1-July-'.$current_year);
							$end_date	= strtotime('30-September-'.$current_year);
						}else if($quarter == '4th'){
							$start_date = strtotime('1-October-'.$current_year);
							$end_date	= strtotime('31-December-'.($current_year+1));
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
						
						//echo 'Each Room Completed %:<br>';
						if(is_array($rooms)){
							foreach($rooms as $val){
								$room_report = pm_report_helper::getRoomsCompleted($hotel_id, $val->room_no, $quarter);
								if(!empty($room_report)){$comp = $room_report[0]->completedRooms;}else{$comp =  '0';}
								
								$calPercentage = round((($comp / $total_rooms)*100),2);
								if($calPercentage >= $percentage_required){
									$comp_rooms++;
								}
								//echo 'Room no:'.$val->room_no.' --- '.$calPercentage.'%<br>';
							}
						}
						$rooms_rem = $total_rooms - $comp_rooms;
						echo 'Remaining Rooms('.$rooms_rem.') / Remaining Working Days('.$jj.')<br>';
						$Perdayrem = round(($rooms_rem / $jj),2);
						echo 'Current Rooms Required to complete Per Day: '.$Perdayrem.'<br>';*/									
						?>
                </div>
                <div id="calendar"></div>
            </div>
        </div>-->
    </div>
    <!--weather-->
    <!--http://erikflowers.github.io/weather-icons/
    https://openweathermap.org/weather-conditions-->
    <?php if($this->session->userdata['logged_in']['role'] != '1'){?>
		<?php
			$hotel_info = admin_helper::get_hotel_info($this->session->userdata['logged_in']['firm_id']);
			$zipcode = $hotel_info[0]->zipcode;
            $Weather = "http://api.openweathermap.org/data/2.5/weather?zip=".$zipcode.",us&appid=7f67418a50c37a8f2823fb415a5b1c60&units=imperial";
            $curl	 = curl_init($Weather);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, false);
            $WEATHER_DATA		= curl_exec($curl);
            $JSON_RESPONSE		= json_decode($WEATHER_DATA, true);
            $ICON_IMAGE			= $JSON_RESPONSE['weather'][0]['icon'];
            if	  ($ICON_IMAGE == '01d'){$ICON = 'wi wi-day-sunny';}		elseif($ICON_IMAGE == '01n'){$ICON = 'wi wi-night-clear';}
            elseif($ICON_IMAGE == '02d'){$ICON = 'wi wi-day-cloudy';}		elseif($ICON_IMAGE == '02n'){$ICON = 'wi wi-night-alt-cloudy';}
            elseif($ICON_IMAGE == '03d'){$ICON = 'wi wi-day-cloudy';}		elseif($ICON_IMAGE == '03n'){$ICON = 'wi wi-night-alt-cloudy';}
            elseif($ICON_IMAGE == '04d'){$ICON = 'wi wi-day-cloudy';}		elseif($ICON_IMAGE == '04n'){$ICON = 'wi wi-night-alt-cloudy';}
            elseif($ICON_IMAGE == '09d'){$ICON = 'wi wi-day-showers';}		elseif($ICON_IMAGE == '09n'){$ICON = 'wi wi-night-alt-showers';}
            elseif($ICON_IMAGE == '10d'){$ICON = 'wi wi-day-rain';}			elseif($ICON_IMAGE == '10n'){$ICON = 'wi wi-night-alt-rain';}
            elseif($ICON_IMAGE == '11d'){$ICON = 'wi wi-day-thunderstorm';}	elseif($ICON_IMAGE == '11n'){$ICON = 'wi wi-night-alt-thunderstorm';}
            elseif($ICON_IMAGE == '13d'){$ICON = 'wi wi-day-snow';}			elseif($ICON_IMAGE == '13n'){$ICON = 'wi wi-night-snow';}
            elseif($ICON_IMAGE == '50d'){$ICON = 'wi wi-day-fog';}			elseif($ICON_IMAGE == '50n'){$ICON = 'wi wi-night-fog';}
            else						{$ICON = 'wi wi-na';}
            
            /*$state_url 	= "http://maps.googleapis.com/maps/api/geocode/json?address=20678";
            $curl_1		= curl_init($state_url);
            curl_setopt($curl_1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_1, CURLOPT_POST, false);
            $STATE_DATA			= curl_exec($curl_1);
            $JSON_RESPONSE_STATE= json_decode($STATE_DATA, true);
            $JSON_RESPONSE_STATE['results'][0]['address_components'][3]['short_name']*/	
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title">Weather</h3>
                    <div class="weather-with-bg">
                        <div class="wt-top">
                            <div class="wt-img" style="background-image: url(../assets/plugins/images/weather-bg.jpg);">
                                <ul class="side-icon-text"><!--<img src="http://openweathermap.org/img/w/<?php #echo $JSON_RESPONSE['weather'][0]['icon'];?>.png" width="100" />-->
                                    <li><span class="di vm"> <i class="<?php echo $ICON;?>"></i></span>
                                        <div class="di vm">
                                            <h1 class="m-b-0"><?php echo round($JSON_RESPONSE['main']['temp']);?><!--<sup>o</sup>--><i class="wi wi-fahrenheit"></i></h1>
                                            <h4><?php echo $JSON_RESPONSE['weather'][0]['main'];?></h4>
                                        </div>
                                    </li>
                                </ul>
                                <div class="wt-city-text"><!--long_name-->
                                    <h1><?php #echo $JSON_RESPONSE['name'];?><!--,--> <?php echo $hotel_info[0]->city.', '.$hotel_info[0]->state;?></h1>
                                    <h4><?php echo date("l, d F Y");?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>

    <div class="chat_box side-menu hidden-xs hidden-sm">
        <div class="chat_header">
        	<p class="chat_heading" style="margin: 0 0 5px 0px;">Contacts <i class="ti-minus" style="float: right; padding-right: 10px; padding-top: 5px;"></i></p>
        </div>
        <hr style="margin: 0 0 0 0px;" />
        <div class="chat_content" id="sidebar-user-boxx">
            <ul class="chatonline style-none" id="ajax_sidebar" style="padding-left: 0px;">
                <?php if(is_array($chat_sidebar)){
                    foreach($chat_sidebar as $sidebar_chat){
                        if($sidebar_chat->type == 'private'){
                            if($this->session->userdata['logged_in']['id'] == $sidebar_chat->recipient_id){$user_id = $sidebar_chat->sender_id;}else{$user_id = $sidebar_chat->recipient_id;}
                            $user_info = admin_helper::get_user_name($user_id);
                            if($user_info[0]->logo != ''){
                                $user_logo	= base_url().'assets/images/user_profile_images/'.$user_info[0]->logo;
                            }else{
                                $user_logo	= base_url().DEFAULT_PROFILE_IMAGE;
                            }
							$unseen_messages = admin_helper::get_count_unseen_messages('single', $this->session->userdata['logged_in']['firm_id'], $sidebar_chat->r_id, $user_info[0]->id);
                ?>
                    <li id="sidebar-user-box" class="<?php echo $sidebar_chat->r_id; ?>" data-r_id="<?php echo $sidebar_chat->r_id; ?>" data-u_id="<?php echo $user_info[0]->id; ?>" data-chat_name="<?php echo $user_info[0]->first_name; ?>" data-g_id="0">
                        <img src="<?php echo $user_logo;?>" class="user_icon" alt="<?php echo $user_info[0]->first_name; ?>" />
                        <span id="slider-username"><?php echo $user_info[0]->first_name; ?></span>
                        <?php if($user_info[0]->is_online == '1'){ ?>
                            <i class="fa fa-circle m-r-5 text-success" style="font-size:9px;"></i>
                        <?php }else{?>
                            <i class="fa fa-circle m-r-5 text-muted" style="font-size:9px;"></i>
                        <?php }?>
                        <?php if($unseen_messages[0]->unseen > 0){?>
                            <span class="label label-rouded label-warning pull-right m-t-5"><?php echo $unseen_messages[0]->unseen;?></span>
                        <?php }?>
                    </li>
                <?php }else{
                        $group_info = admin_helper::group_info($sidebar_chat->group_id);
                        if($group_info[0]->group_image != ''){
                            $group_logo	= base_url().'assets/images/group_chat_images/'.$group_info[0]->group_image;
                        }else{
                            $group_logo	= base_url().DEFAULT_PROFILE_IMAGE;
                        }
						$unseen_messages	= admin_helper::get_count_unseen_messages('group', $hotel_id, $sidebar_chat->r_id, $this->session->userdata['logged_in']['id']);
                ?>
                    <li id="sidebar-user-box" class="<?php echo $sidebar_chat->r_id; ?>" data-r_id="<?php echo $sidebar_chat->r_id; ?>" data-u_id="0" data-chat_name="<?php echo $group_info[0]->group_name; ?>" data-g_id="<?php echo $sidebar_chat->group_id; ?>">
                        <img src="<?php echo $group_logo;?>" class="user_icon" alt="<?php echo $group_info[0]->group_name; ?>" />
                        <span id="slider-username"><?php echo $group_info[0]->group_name; ?></span>
                        <?php if($unseen_messages[0]->unseen > 0){?>
                            <span class="label label-rouded label-warning pull-right m-t-5"><?php echo $unseen_messages[0]->unseen;?></span>
                        <?php }?>
                    </li>
                <?php }?>
                <?php }}?>
            </ul>
		</div>
	</div>
</div>

<style>
.chat_box {
  background: #fff;/*//4b67a8 //00529b*/
  width: 25rem;
  position: fixed;
  bottom: 0;
  right: 1rem;
  border-radius: 0.5rem 0.5rem 0 0;
}
.chat_header {
  padding: 0.5rem;
  cursor: pointer;
  border-bottom: 1px solid #fff;
  background-color: #57c4c2;
}
.chat_heading,
.message_heading {
  font-weight: 500;
  font-size: 1rem;
  color: #fff;
}
.chat_content {
  height: 50rem;
  padding: 1rem;
}
.user {
  display: grid;
  grid-template-columns: 10% 80% 10%;
  align-items: center;
  cursor: pointer;
}
.user_icon {
  width: 2rem;
  border-radius: 50%;
}
.username {
  display: inline-block;
  font-weight: 500;
}
.fa-circle {
  font-size: 1rem;
  color: #52de97;
  justify-self: end;
}
.msg_box{
	position:fixed;
	bottom:-5px;
	width:250px;
	background:white;
	border-radius:5px 5px 0px 0px;
}

.msg_head{	
	background:#57c4c2;
	color:white;
	padding:8px;
	font-weight:bold;
	cursor:pointer;
	border-radius:5px 5px 0px 0px;
}
.msg_body{
	background:white;
	height:200px;
	font-size:12px;
	padding:15px;
	overflow:auto;
	overflow-x: hidden;
}
.msg_input{
	/*width:100%;*/
	width:80%;
	height: 55px;
	border: 1px solid white;
	border-top:1px solid #DDDDDD;
	-webkit-box-sizing: border-box; 
	-moz-box-sizing: border-box;   
	box-sizing: border-box;  
}
.close{
	float:right;
	cursor:pointer;
}
.minimize{
	float:right;
	cursor:pointer;
	padding-right:10px;
	padding-top: 4px;
}
.msg-left{
	position:relative;
	background:#e2e2e2;
	padding:5px;
	min-height:10px;
	margin-bottom:5px;
	margin-right:10px;
	border-radius:5px;
	word-break: break-all;
}
.msg-right{
	background:#d4e7fa;
	padding:5px;
	min-height:15px;
	margin-bottom:5px;
	position:relative;
	margin-left:10px;
	border-radius:5px;
	word-break: break-all;
}
/**** Slider Layout Popup *********/

#chat-sidebar {
     width: 250px;
     position: fixed;
     height: 100%;
     right: 0px;
     top: 0px;
     padding-top: 10px;
     padding-bottom: 10px;
     border: 1px solid #b2b2b2;
}
#sidebar-user-box {
     padding: 4px;
     font-size: 15px;
     font-family: Calibri;
     font-weight:bold;
     cursor:pointer;
}
/*#sidebar-user-box:hover {
     background-color:#999999 ;
}
#sidebar-user-box:after {
     content: ".";
     display: block;
     height: 0;
     clear: both;
     visibility: hidden;
}*/
#slider-username{
     line-height:30px;
     margin-left:5px;
	 color:#444141;
}
.chatonlineusers img {
    margin-right: 10px;
    float: left;
    width: 30px;
}
</style>
<script>
$(document).ready(function(){
	var arr = [];
	
	$(".chat_header").click(function() {
		$(".chat_content").slideToggle("slow");
	});
	
	$(document).on('click', '.msg_head', function() {
		var chatbox = $(this).parents().attr("rel");
		$('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
		return false;
	});
	
	$(document).on('click', '.close', function() {
		var chatbox = $(this).parents().parents().attr("rel");
		$('[rel="'+chatbox+'"]').hide();
		arr.splice($.inArray(chatbox, arr), 1);
		displayChatBox();
		return false;
	});
	
	$(document).on('click', '#sidebar-user-box', function() {
		var userID		= $(this).attr("class");
		var r_id		= $(this).data("r_id");
		var u_id		= $(this).data("u_id");
		var chat_name	= $(this).data("chat_name");
		var g_id		= $(this).data("g_id");		
		var username	= $(this).children().text();
		
		if ($.inArray(userID, arr) != -1){
			arr.splice($.inArray(userID, arr), 1);
		}
		
		arr.unshift(userID);
		
		var data_string = "r_id="+r_id;
		$.ajax({
			url:"<?php echo site_url("message/load_chat_dashboard") ?>",
			method: "POST",
			data: data_string,
			success:function(data){
				//var bottomCoord = $('.chat-list')[0].scrollHeight;
				//$('.chat-list').slimScroll({scrollTo: bottomCoord});
				
				chatPopup =  '<div class="msg_box" style="right:270px" rel="'+ userID+'">'+
					'<div class="msg_head">'+username +
					'<div class="close">x</div> <div class="minimize"><i class="ti-minus"></i></div></div>'+
					'<div class="msg_wrap"> <div class="msg_body msg_body_'+ userID+'">'+data+'<div class="msg_push"></div> </div>'+
					'<div class="msg_footer"><form enctype="multipart/form-data" id="sendmessage"><textarea class="msg_input" id="text_message" rows="4"></textarea></form></div></div></div></div>';
				$("body").append(chatPopup);
				displayChatBox();
				$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
				
				//Load New Messages every 3 seconds
				setInterval(function(){
					if(r_id != ''){
						if ($.inArray(userID, arr) != -1){
							var data_string = "r_id="+r_id;
							$.ajax({
								url:"<?php echo site_url("message/load_chat_dashboard") ?>",
								method: "POST",
								data: data_string,
								success:function(data){
									$(".msg_body_"+ userID).html(data);
									$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
								}
							});
						}
					}
				}, 3000);
			}
		});
	});
/*bottom: 15px;
position: absolute;
float: left;
right: 15px;*/
/*position: absolute;
bottom: 15px;
float: left;
right: 0px;*/
<!--<div class="fileupload btnn btn-infoo waves-effect waves-light"><span><i class="fa fa-paperclip"></i></span><input type="file" class="upload" id="file" name="file" value="" title="Upload File" />-->
<!--<span><i onclick="post_message();" class="fa fa-paper-plane-o"></i></span>-->
	$(document).on('keypress', 'textarea', function(e) {
        if (e.keyCode == 13 ) {
            var msg = $(this).val();
			$(this).val('');
			if(msg.trim().length != 0){
				var chatbox		= $(this).parents().parents().parents().parents().attr("rel");
				var chat_name	= $('.'+chatbox).data("chat_name");				
				var r_id		= $('.'+chatbox).data("r_id");
				var u_id		= $('.'+chatbox).data("u_id");
				var g_id		= $('.'+chatbox).data("g_id");
				
				post_message(r_id, u_id, g_id, chat_name, msg)
				$('<div class="msg-right">'+msg+'</div>').insertBefore('[rel="'+chatbox+'"] .msg_push');
				$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
			}
        }
    });
	
	function displayChatBox(){
	    i = 270 ; // start position		//270
		j = 260;  //next position
		
		$.each( arr, function( index, value ) {  
		   if(index < 4){
	         $('[rel="'+value+'"]').css("right",i);
			 $('[rel="'+value+'"]').show();
		     i = i+j;			 
		   }
		   else{
			 $('[rel="'+value+'"]').hide();
		   }
        });		
	}
	
	setInterval(function(){
		//var r_id	= $('#r_id').val();
		load_sidebar();
	}, 3000);
});
	
	/*function showMessageEmojies(){
		$('#text_message').emojiPicker({width:'200px', height: '200px', button: false});
		$('#text_message').emojiPicker('toggle');
	}*/
	
	//Send Message
	function post_message(r_id, res_id, g_id, res_name, text_message){
		var data_string		= "recipient_id="+res_id+"&r_id="+r_id+"&group_id="+g_id+"&recipient_name="+res_name+"&text_message="+text_message;
		$.ajax({
			url:"<?php echo site_url("message/send_message") ?>",
			method: "POST",
			data: data_string,
			success:function(data){}
		});
	}
	
	//Load Sidebar On New Message
	function load_sidebar(){
		$.ajax({
			url:"<?php echo site_url("message/load_left_sidebar_dashboard") ?>",
			method: "GET",
			success:function(data){
				$('#ajax_sidebar').html(data);
				$('.chatonline').slimScroll();
			}
		});
	}
	
	
        
</script>
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.emojipicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.emojis.js"></script>-->
<style>
blink {
	color:red;
	-webkit-animation: blink 1s step-end infinite;
	animation: blink 1s step-end infinite
}
@-webkit-keyframes blink {
	67% { opacity: 0 }
}

@keyframes blink {
	67% { opacity: 0 }
}
.btn-yellow{
	background: #FFFF00;
	border: 1px solid #FFFF00;
	color:#000;
}
.bg-yellow, .progress-bar-yellow {
    background-color: #FFFF00 !important;
}
.mytooltip{
	z-index:0;
}
.media {
    background-color: aliceblue;
}

/*carousel*/
#carousel {
	position: relative;
	width:100%;
	/*margin:0 auto;*/
}

#slides {
	overflow: hidden;
	position: relative;
	width: 100%;
	height: 200px;
	text-align: center;
	margin: 0 auto;
}

#slides ul {
	list-style: none;
	width:100%;
	height:200px;
	margin: 0;
	padding: 0;
	position: relative;
	text-align: center;
}

#slides li {
	width:100%;
	height:200px;
	float:left;
	text-align: center;
	position: relative;
}
/* Styling for prev and next buttons */
/*.btn-bar{
    max-width: 346px;
    margin: 0 auto;
    display: none;
    position: relative;
    top: 40px;
    width: 100%;
}
#buttons {
	padding:0 0 5px 0;
	float:right;
}
#buttons a {
	text-align:center;
	display:block;
	font-size:50px;
	float:left;
	outline:0;
	margin:0 60px;
	color:#b14943;
	text-decoration:none;
	display:block;
	padding:9px;
	width:35px;
}
a#prev:hover, a#next:hover {
	color:#FFF;
	text-shadow:.5px 0px #b14943;  
}*/
</style>