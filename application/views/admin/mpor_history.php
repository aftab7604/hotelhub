<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Housekeeper History</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Housekeeper History Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Housekeeper History</div>
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
								
								if(isset($_POST['submit'])){
									$dateStart		= new DateTime($_POST['start_date']);
									$dateEnd		= new DateTime($_POST['end_date']);
									$dateDiff		= $dateStart->diff($dateEnd);
									$number_of_days	= ($dateDiff->d)+1;
									
									$start_date		= $_POST['start_date'];
									$end_date		= $_POST['end_date'];
									$type			= $_POST['type'];
									$emp_list		= $_POST['emp_list'];
									$room_list		= $_POST['room_list'];
									$room_type		= $_POST['room_type'];
								}else{
									$curr_date		= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
									$number_of_days	= '1';
									$start_date		= $end_date	= $curr_date;
									$type			= $emp_list	= $room_list = $room_type = 0;
								}
                             ?>
                             <!--manage form data-->
                            <form action="<?php echo base_url();?>mpor/history" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <h3 class="box-title"></h3>
                                    <div class="row">
                                    	<div class="col-md-2 p-l-5 p-r-0">
                                            <select class="form-control" name="type" id="mpor_type">
                                                <option value="0" <?php if($type == '0'){echo 'selected="selected"';}?>>Select filter by</option>
                                                <option value="1" <?php if($type == '1'){echo 'selected="selected"';}?>>By Employee</option>
                                                <option value="2" <?php if($type == '2'){echo 'selected="selected"';}?>>By Room</option>
                                                <option value="3" <?php if($type == '3'){echo 'selected="selected"';}?>>By Room Type</option>
                                            </select>
                                        </div>                                        
                                        <div class="col-md-3 p-l-5 p-r-0" id="emp_list" <?php if($type != 1){echo 'style="display:none;"';}?>>
                                            <select class="form-control" name="emp_list">
                                                <option value="0">-Select Any Employee-</option>
                                                <?php if(is_array($HK_employees)){
                                                    foreach($HK_employees as $all_hk){?>
                                                    <option value="<?php echo $all_hk->id;?>" <?php if($emp_list == $all_hk->id){echo 'selected="selected"';}?>><?php echo ucfirst($all_hk->username);?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-l-5 p-r-0" id="room_list" <?php if($type != 2){echo 'style="display:none;"';}?>>
                                            <select class="form-control" name="room_list">
                                                <option value="0">-Select Any Room#-</option>
                                                <?php if(is_array($rooms_info)){
													foreach($rooms_info as $rooms_no){?>
													<option value="<?php echo $rooms_no->room_no;?>" <?php if($room_list == $rooms_no->room_no){echo 'selected="selected"';}?>> Room #<?php echo $rooms_no->room_no. '-'.$rooms_no->room_type;?></option>
												<?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-l-5 p-r-0" id="room_type" <?php if($type != 3){echo 'style="display:none;"';}?>>
                                            <select class="form-control" name="room_type">
                                                <option value="0">-Select Room Type-</option>
                                                <?php if(is_array($rooms_type)){
													foreach($rooms_type as $roomsType){?>
													<option value="<?php echo $roomsType->room_type;?>" <?php if($room_type == $roomsType->room_type){echo 'selected="selected"';}?>><?php echo $roomsType->room_type;?></option>
												<?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-5 p-l-20 p-r-0">
                                        	<div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control" name="start_date" id="start_date" placeholder="yyyy-mm-dd" value="<?php echo $start_date;?>" required />
                                                <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                <input type="text" class="form-control" name="end_date" id="end_date" placeholder="yyyy-mm-dd" value="<?php echo $end_date;?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form><hr />
                            <?php if($type == 0){?>
                            	<div id="info-modal" class="modal fade bs-mpor-info" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myLargeModalLabel">Day breakout</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <table id="myTablePMP_info" class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Assign By</th>
                                                                <th>Employee</th>
                                                                <th>Room#</th>
                                                                <th>Checkout/Stayover</th>
                                                                <th>Requests</th>
                                                                <th>DND</th>
                                                                <th>Notes</th>
                                                                <th>Ticket</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="results"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="table-responsive">
                            	<table id="myTablePMP" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Total Rooms</th>
                                            <th>Checkouts</th>
                                            <th>Stayovers</th>
                                            <th>Occupied</th>
                                            <th>Vacant</th>
                                            <th>Out Of Order</th>
                                            <th>Full Info.</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
										<?php for($i=1; $i<=$number_of_days; $i++){if($i==1){$stop_date = $start_date;}else{
												$stop_date	= date('Y-m-d', strtotime($start_date . ' +1 day'));
												$start_date	= $stop_date;
											}
											$between	= " BETWEEN '".$stop_date." 00:00:00' AND '".$stop_date." 23:59:59' ";
											$stat_info	= admin_helper::getMPORSettingsINFO($hotel_id, $between);
										?>
                                            <tr>
                                                <td><?php echo date("l", strtotime($stop_date)).', '.$stop_date;?></td>
                                                <td><?php if(isset($stat_info[0])){echo $stat_info[0]->total_rooms;}else{echo '0';}?></td>
                                                <td><?php if(isset($stat_info[0])){echo $stat_info[0]->total_checkouts;}else{echo '0';}?></td>
                                                <td><?php if(isset($stat_info[0])){echo $stat_info[0]->total_stayovers;}else{echo '0';}?></td>
                                                <td><?php if(isset($stat_info[0])){echo $stat_info[0]->total_occupied;}else{echo '0';}?></td>
                                                <td><?php if(isset($stat_info[0])){echo $stat_info[0]->total_vacant;}else{echo '0';}?></td>
                                                <td><?php if(isset($stat_info[0])){echo $stat_info[0]->out_of_order;}else{echo '0';}?></td>
                                                <td><button type="button" data-toggle="modal" data-target=".bs-mpor-info" class="btn btn-warning waves-effect waves-light model_img img-responsive" onclick="getMporInfo('<?php echo $stop_date;?>');">Full Info</button></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }?>
                            
                            <?php if($type == 1){?>
								<div class="table-responsive">
                                    <table id="myTablePMP" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Employee</th>
                                                <th>Room Number</th>
                                                <th>Status</th>
                                                <th>Full Info.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 	
												if($emp_list > 0){$filter = " AND assign_to_id = '".$emp_list."' ";}else{$filter = " ";}
													$between	= " BETWEEN '".$start_date." 00:00:00' AND '".$end_date." 23:59:59' ";
													$stat_info	= admin_helper::getMPORINFO($hotel_id, $filter, $between);
													if(is_array($stat_info)){foreach($stat_info as $val){
														$assignToUser	= admin_helper::get_user_name($val->assign_to_id);
														$assignByUser	= admin_helper::get_user_name($val->created_by_id);
														$assignTo		= ucfirst($assignToUser[0]->username);
														$assignBy		= ucfirst($assignByUser[0]->username);
													?>
                                                        <tr>
                                                            <td><?php echo date("l, Y-m-d", strtotime($val->created_date));?></td>
                                                            <td><?php echo $assignTo;?></td>
                                                            <td><?php echo $val->assign_rooms;?></td>
                                                            <td><?php echo $val->status;?></td>
                                                			<td><button type="button" data-toggle="modal" data-target="#mpor_fullview_<?php echo $val->mpor_id;?>" class="btn btn-warning waves-effect waves-light model_img img-responsive"><i class="fa fa-eye"></i></button></td>
                                                        </tr>
                                                     	<div id="mpor_fullview_<?php echo $val->mpor_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" id="myModalLabel">MPOR Full View</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" id="" action="<?php echo base_url();?>" method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Assign By:</label> <?php echo $assignBy;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Assign To:</label> <?php echo $assignTo;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Room#:</label> <?php echo $val->assign_rooms;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Checkout/Stayover:</label> <?php echo $val->chk_stay;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Date/Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->created_date));?></div>
                                                                                <div class="col-md-6"><label class="control-label"></label> <?php #echo $val->priority;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Special Request:</label> <?php echo $val->sp_request;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->notes);?></div>
                                                                            </div>
                                                                            <?php if($val->is_dnd == 1){?><hr />
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Room Was DND</label></div>
                                                                                <div class="col-md-6"><?php if($val->dnd_filename != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->dnd_filename;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->is_ticket != ''){?><hr />
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Ticket was generated:</label> <a target="_blank" href="/ticket/ticket_info/<?php echo $val->is_ticket;?>"> View Ticket#<?php echo $val->is_ticket;?></a></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <hr />
                                                                            <?php if($val->status == 'Pending'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Pending</button></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->status == 'In-Progress'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service In-Progress</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Service Started at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->started_at));?></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->status == 'Completed'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Completed</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Service Started at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->started_at));?></div>
                                                                                <div class="col-md-6"><label class="control-label">Service Completed at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->completed_at));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Employee Signature:</label> <?php if($val->emp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->emp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->approved != '' && $val->approved == 'Approved'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Approved</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Room Inspected By:</label> <?php $inspected_by	= admin_helper::get_user_name($val->inspected_by); echo ucfirst($inspected_by[0]->username);?></div>
                                                                                <div class="col-md-6"><label class="control-label">Inspection Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->inspected_time));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Signature:</label> <?php if($val->insp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->insp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->insp_file_name != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->insp_file_name;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->inspected_notes);?></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->approved != '' && $val->approved == 'Re-Inspect'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Re-Inspect</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Room Inspected By:</label> <?php $inspected_by	= admin_helper::get_user_name($val->inspected_by); echo ucfirst($inspected_by[0]->username);?></div>
                                                                                <div class="col-md-6"><label class="control-label">Inspection Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->inspected_time));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Signature:</label> <?php if($val->insp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->insp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->insp_file_name != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->insp_file_name;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->inspected_notes);?></div>
                                                                            </div>
                                                                            <?php }?>                                                                          
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php }?>
                            
                            <?php if($type == 2){?>
								<div class="table-responsive">
                                    <table id="myTablePMP" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Room Number</th>
                                                <th>Employee</th>
                                                <th>Status</th>
                                                <th>Full Info.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 	
												if($emp_list > 0){$filter = " AND assign_rooms = '".$room_list."' ";}else{$filter = " ";}
													$between	= " BETWEEN '".$start_date." 00:00:00' AND '".$end_date." 23:59:59' ";
													$stat_info	= admin_helper::getMPORINFO($hotel_id, $filter, $between);
													if(is_array($stat_info)){foreach($stat_info as $val){
														$assignToUser	= admin_helper::get_user_name($val->assign_to_id);
														$assignByUser	= admin_helper::get_user_name($val->created_by_id);
														$assignTo		= ucfirst($assignToUser[0]->username);
														$assignBy		= ucfirst($assignByUser[0]->username);
													?>
                                                        <tr>
                                                            <td><?php echo date("l, Y-m-d", strtotime($val->created_date));?></td>
                                                            <td><?php echo $val->assign_rooms;?></td>
                                                            <td><?php echo $assignTo;?></td>
                                                            <td><?php echo $val->status;?></td>
                                                			<td><button type="button" data-toggle="modal" data-target="#mpor_fullview_<?php echo $val->mpor_id;?>" class="btn btn-warning waves-effect waves-light model_img img-responsive"><i class="fa fa-eye"></i></button></td>
                                                        </tr>
                                                        <div id="mpor_fullview_<?php echo $val->mpor_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" id="myModalLabel">MPOR Full View</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" id="" action="<?php echo base_url();?>" method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Assign By:</label> <?php echo $assignBy;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Assign To:</label> <?php echo $assignTo;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Room#:</label> <?php echo $val->assign_rooms;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Checkout/Stayover:</label> <?php echo $val->chk_stay;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Date/Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->created_date));?></div>
                                                                                <div class="col-md-6"><label class="control-label"></label> <?php #echo $val->priority;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Special Request:</label> <?php echo $val->sp_request;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->notes);?></div>
                                                                            </div>
                                                                            <?php if($val->is_dnd == 1){?><hr />
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Room Was DND</label></div>
                                                                                <div class="col-md-6"><?php if($val->dnd_filename != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->dnd_filename;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->is_ticket != ''){?><hr />
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Ticket was generated:</label> <a target="_blank" href="/ticket/ticket_info/<?php echo $val->is_ticket;?>"> View Ticket#<?php echo $val->is_ticket;?></a></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <hr />
                                                                            <?php if($val->status == 'Pending'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Pending</button></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->status == 'In-Progress'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service In-Progress</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Service Started at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->started_at));?></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->status == 'Completed'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Completed</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Service Started at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->started_at));?></div>
                                                                                <div class="col-md-6"><label class="control-label">Service Completed at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->completed_at));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Employee Signature:</label> <?php if($val->emp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->emp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->approved != '' && $val->approved == 'Approved'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Approved</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Room Inspected By:</label> <?php $inspected_by	= admin_helper::get_user_name($val->inspected_by); echo ucfirst($inspected_by[0]->username);?></div>
                                                                                <div class="col-md-6"><label class="control-label">Inspection Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->inspected_time));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Signature:</label> <?php if($val->insp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->insp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->insp_file_name != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->insp_file_name;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->inspected_notes);?></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->approved != '' && $val->approved == 'Re-Inspect'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Re-Inspect</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Room Inspected By:</label> <?php $inspected_by	= admin_helper::get_user_name($val->inspected_by); echo ucfirst($inspected_by[0]->username);?></div>
                                                                                <div class="col-md-6"><label class="control-label">Inspection Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->inspected_time));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Signature:</label> <?php if($val->insp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->insp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->insp_file_name != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->insp_file_name;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->inspected_notes);?></div>
                                                                            </div>
                                                                            <?php }?>                                                                          
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php }?>
                            
                            <?php if($type == 3){?>
								<div class="table-responsive">
                                    <table id="myTablePMP" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Room Type</th>
                                                <th>Room Number</th>
                                                <th>Employee</th>
                                                <th>Status</th>
                                                <th>Full Info.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
													$between	= " BETWEEN '".$start_date." 00:00:00' AND '".$end_date." 23:59:59' ";
													$stat_info	= admin_helper::getMPORINFOByRoomType($hotel_id, $room_type, $between);
													if(is_array($stat_info)){foreach($stat_info as $val){
														$assignToUser	= admin_helper::get_user_name($val->assign_to_id);
														$assignByUser	= admin_helper::get_user_name($val->created_by_id);
														$assignTo		= ucfirst($assignToUser[0]->username);
														$assignBy		= ucfirst($assignByUser[0]->username);
													?>
                                                        <tr>
                                                            <td><?php echo date("l, Y-m-d", strtotime($val->created_date));?></td>
                                                            <td><?php echo $val->room_type;?></td>
                                                            <td><?php echo $val->assign_rooms;?></td>
                                                            <td><?php echo $assignTo;?></td>
                                                            <td><?php echo $val->status;?></td>
                                                			<td><button type="button" data-toggle="modal" data-target="#mpor_fullview_<?php echo $val->mpor_id;?>" class="btn btn-warning waves-effect waves-light model_img img-responsive"><i class="fa fa-eye"></i></button></td>
                                                        </tr>
                                                        <div id="mpor_fullview_<?php echo $val->mpor_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" id="myModalLabel">MPOR Full View</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" id="" action="<?php echo base_url();?>" method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Assign By:</label> <?php echo $assignBy;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Assign To:</label> <?php echo $assignTo;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Room#:</label> <?php echo $val->assign_rooms;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Checkout/Stayover:</label> <?php echo $val->chk_stay;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Date/Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->created_date));?></div>
                                                                                <div class="col-md-6"><label class="control-label"></label> <?php #echo $val->priority;?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Special Request:</label> <?php echo $val->sp_request;?></div>
                                                                                <div class="col-md-6"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->notes);?></div>
                                                                            </div>
                                                                            <?php if($val->is_dnd == 1){?><hr />
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Room Was DND</label></div>
                                                                                <div class="col-md-6"><?php if($val->dnd_filename != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->dnd_filename;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->is_ticket != ''){?><hr />
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Ticket was generated:</label> <a target="_blank" href="/ticket/ticket_info/<?php echo $val->is_ticket;?>"> View Ticket#<?php echo $val->is_ticket;?></a></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <hr />
                                                                            <?php if($val->status == 'Pending'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Pending</button></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->status == 'In-Progress'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service In-Progress</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Service Started at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->started_at));?></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->status == 'Completed'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Completed</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Service Started at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->started_at));?></div>
                                                                                <div class="col-md-6"><label class="control-label">Service Completed at:</label> <?php echo date('Y-m-d h:i A', strtotime($val->completed_at));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Employee Signature:</label> <?php if($val->emp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->emp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->approved != '' && $val->approved == 'Approved'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Approved</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Room Inspected By:</label> <?php $inspected_by	= admin_helper::get_user_name($val->inspected_by); echo ucfirst($inspected_by[0]->username);?></div>
                                                                                <div class="col-md-6"><label class="control-label">Inspection Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->inspected_time));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Signature:</label> <?php if($val->insp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->insp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->insp_file_name != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->insp_file_name;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->inspected_notes);?></div>
                                                                            </div>
                                                                            <?php }?>
                                                                            <?php if($val->approved != '' && $val->approved == 'Re-Inspect'){?>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><button type="button" class="btn btn-danger waves-effect">Room Service Re-Inspect</button></div>
                                                                            </div>
                                                                            <div class="row m-t-30">
                                                                                <div class="col-md-6"><label class="control-label">Room Inspected By:</label> <?php $inspected_by	= admin_helper::get_user_name($val->inspected_by); echo ucfirst($inspected_by[0]->username);?></div>
                                                                                <div class="col-md-6"><label class="control-label">Inspection Time:</label> <?php echo date('Y-m-d h:i A', strtotime($val->inspected_time));?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6"><label class="control-label">Signature:</label> <?php if($val->insp_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->insp_signature;?>" width="120" height="" /><?php }?></div>
                                                                                <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->insp_file_name != ''){?><img src="<?php echo base_url();?>assets/images/mpor_images/<?php echo $val->insp_file_name;?>" width="120" height="" /><?php }?></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->inspected_notes);?></div>
                                                                            </div>
                                                                            <?php }?>                                                                          
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>