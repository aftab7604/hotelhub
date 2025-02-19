<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Closed Tickets</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Closed Tickets Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none; z-index:99999999999999999;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Closed Tickets</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="white-box">
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
                             <!--Table display closed ticket data-->
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                        	<th class="hidden">&nbsp;</th>
                                            <th>Ticket #</th>
                                            <th>Guest Name</th>
                                            <th>Service Recovery</th>
                                            <th>In-house/Future</th>
                                            <th>Room#</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php if(is_array($closedTickets)){
										foreach($closedTickets as $ind => $val){
											$disabled 		= 'disabled';
											$dept_name		= $val->dept_name;
											$ticket_id		= $val->ticketID;
											$ticket_type_id	= $val->ticketTypeID;
											$ticket_type	= $val->type_name;
											$generated_by	= 'Email Notification';
											if($val->generated_by > 0){
												$generatedBy	= admin_helper::get_user_name($val->generated_by);
												$generated_by	= $generatedBy[0]->username;
											}
											
											$pickedBy		= admin_helper::get_user_name($val->picked_by);
											$picked_by		= $pickedBy[0]->username;
											$reply_notes	= admin_helper::get_ticket_notes_replies($ticket_id);
											$replies		= '';
											
											$estimatedTimeCal = strtotime($val->pickup_date.' +'.$val->pickup_comp_time);
											$estimatedTime	= date('Y-m-d H:i:s', $estimatedTimeCal);
											
											$head = '<div class="chat-box"><ul class="chat-list slimscrolll p-0">';
											$foot = '</ul></div>';
											if(!empty($reply_notes) && isset($reply_notes)){
												foreach($reply_notes as $reply){
													$repDate = date("m-d-Y", strtotime($reply->added_date));
													$repTime = date("h:i a", strtotime($reply->added_date));
													$replies .= '<li class="m-b-10"><div class="chat-body"><div class="chat-text"><h4>'.$reply->added_by.'</h4><p>'.htmlspecialchars_decode($reply->message).'</p><b>'.$repDate.' '.$repTime.'</b></div></div></li>';
												}
											}else{
												$replies .= '<li class="m-b-10 hidden"><div class="chat-body"><div class="chat-text"><h4>No, Replies yet!</h4></div></div></li>';
											}
											$replies = $head.$replies.$foot;
										?>
                                        <div id="view_eyes-<?php echo $ticket_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:999999999; top:100px;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myModalLabel">Who view these messages</h4>
                                                        </div>
                                                        <div class="modal-body" id="bird_eye_<?php echo $ticket_id;?>">
                                                        	<div class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-spin fa-refresh"></i> fa-refresh</div>
                                                        </div>
                                                        <div class="modal-footer m-t-20">
                                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="modal fade bs-pending-ticket-<?php echo $ticket_id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none; z-index:1042;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" id="myLargeModalLabel"><b>Department</b> - <?php echo $dept_name;?></h4>
                                                        <h4 class="modal-title" id="myLargeModalLabel"><b>TICKET TYPE</b> - <?php echo $ticket_type;?></h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h4 class="modal-title" id="myLargeModalLabel"><b>TICKET #</b> - <?php echo $ticket_type.$ticket_id;?></h4>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php if($ticket_type_id == 1){?>
                                                                    <button type="button" class="btn btn-danger waves-effect waves-light">CLOSED</button>
                                                                <?php }else{if($val->service_rec == 'yes'){?>
                                                                    <button type="button" class="btn btn-danger waves-effect waves-light"><blink style="color:#FFF;">CLOSED</blink></button>
                                                                <?php }else{?>
                                                                    <button type="button" class="btn btn-danger waves-effect waves-light">CLOSED</button>
                                                                <?php }}?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6"><b>Created At:</b> <?php echo date("m/d/Y h:i", strtotime($val->created_date));?></div>
                                                            <div class="col-md-6"><b>Created By:</b> <?php echo $generated_by;?></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6"><b>Picked At:</b> <?php echo date("m/d/Y h:i", strtotime($val->pickup_date));?></div>
                                                            <div class="col-md-6"><b>Picked By:</b> <?php echo $picked_by;?></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6"><b>Closed At:</b> <?php echo date("m/d/Y h:i", strtotime($val->close_date));?></div>
                                                            <div class="col-md-6"><b>Estimate To Complete:</b> <?php echo $val->pickup_comp_time;?></div>
                                                        </div>
                                                        <hr />
                                                        <?php 
                                                        if($ticket_type_id == 1){?>
                                                        <?php if($val->guest_type == 'In-House'){?>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Room Number:</b> <?php echo $val->room_no;?></div>
                                                                <div class="col-md-6"><b>Room Type:</b> <?php echo $val->room_type;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Guest Name:</b> <?php echo $val->guest_name;?></div>
                                                                <div class="col-md-4"><b>Email:</b> <?php echo $val->guest_email;?></div>
                                                                <div class="col-md-4"><b>Phone:</b> <?php echo $val->guest_phone;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>ARRIVAL DATE:</b> <?php echo date("m/d/Y", strtotime($val->arrival_date));?></div>
                                                                <div class="col-md-6"><b>DEPARTURE DATE:</b> <?php echo date("m/d/Y", strtotime($val->depart_date));?></div>
                                                            </div>
                                                        <?php }elseif($val->guest_type == 'Not In-House'){
                                                            if($val->future_reservation == 'yes'){?>
                                                                <div class="row">
                                                                    <div class="col-md-6"><b>Room Type:</b> <?php echo $val->room_type;?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                            <?php }?>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Guest Name:</b> <?php echo $val->guest_name;?></div>
                                                                <div class="col-md-4"><b>Email:</b> <?php echo $val->guest_email;?></div>
                                                                <div class="col-md-4"><b>Phone:</b> <?php echo $val->guest_phone;?></div>
                                                            </div>
                                                            <?php if($val->future_reservation == 'yes'){?>
                                                                <div class="row">
                                                                    <div class="col-md-6"><b>ARRIVAL DATE:</b><?php echo date("m/d/Y", strtotime($val->arrival_date));?></div>
                                                                    <div class="col-md-6"><b>DEPARTURE DATE:</b> <?php echo date("m/d/Y", strtotime($val->depart_date));?></div>
                                                                </div>
                                                            <?php }?>
                                                        <?php }else{?>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Standard Guest:</b></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                        <?php }?>
                                                        <?php if($val->assign_to_dept == 3){?>
                                                            <h3><b class="text-danger">FRONT DESK</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Notes:</b> <?php echo $val->fd_notes;?></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                        <?php }?>
                                                        <?php if($val->assign_to_dept == 4){?>
                                                            <h3><b class="text-danger">HOUSEKEEPING</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Notes:</b> <?php echo $val->hk_notes;?></div>
                                                                <div class="col-md-6"><b>Service:</b> <?php echo $val->hk_service;?></div>
                                                            </div>
                                                        <?php }?>
                                                        <?php if($val->assign_to_dept == 5){?>
                                                            <h3><b class="text-danger">FOOD & BEVERAGE</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Service:</b> <?php echo ucwords($val->food_service);?></div>
                                                                <div class="col-md-6"><b>Name of group:</b> <?php echo ucwords($val->food_group);?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Notes:</b> <?php echo $val->food_notes;?></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                        <?php }?>
                                                        <?php if($val->assign_to_dept == 6){?>
                                                            <h3><b class="text-danger">SALES</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Company:</b> <?php echo $val->sales_company;?></div>
                                                                <div class="col-md-6"><b>Email:</b> <?php echo $val->sales_mail;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Primary Phone:</b> <?php echo $val->sales_phone;?></div>
                                                                <div class="col-md-6"><b>Secondary Phone:</b> <?php echo $val->sales_phone;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Call Time:</b> <?php echo $val->sales_callTime;?></div>
                                                                <div class="col-md-6"><b>Bring to hotel from:</b> <?php echo $val->brings_hotel;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Urgent Request:</b> <?php echo $val->urgent_request;?></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Budget $$:</b> <?php echo $val->guest_budget;?></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                            <?php if($val->guest_room_needed == 'yes'){?>
                                                                <h3><b>GUEST ROOMS NEEDED</b></h3>
                                                                <div class="row">
                                                                    <div class="col-md-4"><b>ARRIVAL DATE:</b><?php echo date("m/d/Y", strtotime($val->guest_arrival_date));?></div>
                                                                    <div class="col-md-4"><b>DEPARTURE DATE:</b> <?php echo date("m/d/Y", strtotime($val->guest_depart_date));?></div>
                                                                    <div class="col-md-4"><b>No. of Guest Rooms:</b> <?php echo $val->guest_rooms;?></div>
                                                                </div>
                                                            <?php }else{?>
                                                                <div class="row">
                                                                    <div class="col-md-6"><b>ARRIVAL DATE:</b><?php echo date("m/d/Y", strtotime($val->guest_arrival_date));?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                            <?php }?>
                                                            <?php if($val->meeting_room_needed == 'yes'){?>
                                                                <h3><b>MEETING ROOMS NEEDED</b></h3>
                                                                <div class="row">
                                                                    <div class="col-md-6"><b>No. of People for meetings:</b> <?php echo $val->peoples;?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                            <?php }?>
                                                            <?php if($val->food_needed == 'yes'){?>
                                                                <h3><b>FOOD NEEDED</b></h3>
                                                                <div class="row">
                                                                    <div class="col-md-6"><b>Food Needed:</b> <?php echo $val->food_needed;?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                            <?php }?>
                                                            <?php if($val->return_guest == 'yes'){?>
                                                                <h3><b>RETURNED GUEST</b></h3>
                                                                <div class="row">
                                                                    <div class="col-md-6"><b>Returned Guest:</b> <?php echo $val->return_guest;?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                            <?php }?>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Notes:</b> <?php echo $val->sales_notes;?></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                        <?php }?>
                                                        <?php if($val->assign_to_dept == 7){?>
                                                            <h3><b class="text-danger">MAINTENANCE</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Service:</b> <?php echo ucwords($val->maint_service);?></div>
                                                                <div class="col-md-6"><b>Needs:</b> <?php echo ucwords($val->maint_explain);?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Notes:</b> <?php echo $val->maint_notes;?></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                        <?php }?>
                                                        <?php if($val->assign_to_dept == 2){?>
                                                            <h3><b class="text-danger">MANAGER ON DUTY</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Service:</b> <?php echo ucwords($val->mangr_duty_concern);?></div>
                                                                <div class="col-md-6"><b>Needs:</b> <?php echo ucwords($val->mangr_explain);?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><b>Notes:</b> <?php echo $val->mangr_notes;?></div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                        <?php }?>
                                                        <?php }
                                                        if($ticket_type_id == 2){?>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Guest Name:</b> <?php echo $val->guest_name;?></div>
                                                                <div class="col-md-4"><b>Room Number:</b> <?php echo $val->room_no;?></div>
                                                                <div class="col-md-4"><b>Room Type:</b> <?php echo $val->room_type;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Service Ticket:</b> <?php echo ucwords($val->service_rec);?></div>
                                                                <div class="col-md-4"><b>Guest Type:</b> <?php echo $val->guest_type;?></div>
                                                                <div class="col-md-4"><b>Notes:</b> <?php echo ucwords($val->ticket_notes);?></div>
                                                            </div>
                                                        <?php }
                                                        if($ticket_type_id == 3){?>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Guest Name:</b> <?php echo $val->guest_name;?></div>
                                                                <div class="col-md-4"><b>Response / Review Date:</b> <?php echo date("d M, Y", strtotime($val->created_date));?></div>
                                                                <div class="col-md-4"><b>GSS Intent to Recommend:</b> <?php echo $val->ratting;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Notes:</b> <?php echo ucwords($val->ticket_notes);?></div>
                                                                <div class="col-md-4"><b>Guest Type:</b> <?php echo $val->guest_type;?></div>
                                                                <div class="col-md-4"></div>
                                                            </div>
                                                        <?php }
                                                        if($ticket_type_id == 4){?>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Category:</b> <?php $cat_name = admin_helper::get_category_name($val->cat_id); echo $cat_name[0]->cat_name;?></div>
                                                                <div class="col-md-4"><b>Item Name:</b> <?php $subcat_name = admin_helper::get_subcategory_name($val->item_id); echo $subcat_name[0]->subcat_name;?></div>
                                                                <div class="col-md-4"><b>Quarter:</b> <?php echo $val->quarter;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Service Ticket:</b> <?php echo ucwords($val->service_rec);?></div>
                                                                <div class="col-md-4"><b>Room Number:</b> <?php echo $val->room_no;?></div>
                                                                <div class="col-md-4"><b>Room Type:</b> <?php echo $val->room_type;?></div>
                                                            </div>
                                                            <?php if($val->pmp_status == 'complete'){?>
                                                                <div class="row">
                                                                    <div class="col-md-4"><b>PMP Status:</b> Completed</div>
                                                                    <div class="col-md-4"><b>Item Rate/Condition:</b> <?php echo ucwords($val->item_ratting);?></div>
                                                                    <?php if($val->repair_req == 'yes'){?>
                                                                        <div class="col-md-4"><b>Speficially Repaired:</b> <?php echo ucwords($val->spsfic_req);?></div>
                                                                    <?php }else{?>
                                                                        <div class="col-md-4"></div>
                                                                    <?php }?>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4"><b>Notes:</b> <?php echo ucwords($val->ticket_notes);?></div>
                                                                    <div class="col-md-4"></div>
                                                                    <div class="col-md-4"></div>
                                                                </div>
                                                            <?php }else{?>
                                                                <div class="row">
                                                                    <div class="col-md-4"><b>PMP Status:</b> Flagged</div>
                                                                    <div class="col-md-4"><b>Flagged Type 01:</b> <?php echo ucwords($val->flag_type);?></div>
                                                                    <div class="col-md-4"><b>Flagged Type 02:</b> <?php echo ucwords($val->flag_type_2);?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <?php if($val->vendor_req == 'yes'){?>
                                                                        <div class="col-md-4"><b>Vendor Required:</b> <?php echo ucwords($val->vendor_req);?></div>
                                                                    <?php }else{?>
                                                                        <div class="col-md-4"><b>Vendor Required:</b> No</div>
                                                                    <?php }?>
                                                                    <div class="col-md-4"><b>Notes:</b> <?php echo ucwords($val->ticket_notes);?></div>
                                                                    <div class="col-md-4"></div>
                                                                </div>
                                                            <?php }?>
                                                        <?php }
                                                        if($ticket_type_id == 5){?>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Room Number:</b> <?php echo $val->room_no;?></div>
                                                                <div class="col-md-4"><b>Room Type:</b> <?php echo $val->room_type;?></div>
                                                                <div class="col-md-4"><b>Maintinance Service:</b> <?php echo ucwords($val->qk_maint_service);?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Service Ticket:</b> <?php echo ucwords($val->service_rec);?></div>
                                                                <div class="col-md-4"><b>Guest Type:</b> <?php echo $val->guest_type;?></div>
                                                                <div class="col-md-4"><b>Notes:</b> <?php echo ucwords($val->ticket_notes);?></div>
                                                            </div>
                                                        <?php }
                                                        if($ticket_type_id == 6){?>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Service Ticket:</b> <?php echo ucwords($val->service_rec);?></div>
                                                                <div class="col-md-4"><b>Ticket Category:</b> <?php echo ucwords($val->ticket_cat);?></div>
                                                                <div class="col-md-4"><b>Ticket Sub Category:</b> <?php echo ucwords($val->ticket_subcat);?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Sub Cat Value:</b> <?php echo $val->ticket_subcat_data;?></div>
                                                                <div class="col-md-4"><b>No Of Tasks:</b> <?php echo $val->no_of_task;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Task Started Date:</b> <?php echo $val->task_start_date;?></div>
                                                                <div class="col-md-4"><b>Task Ended Date:</b> <?php echo $val->task_end_date;?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><b>Ticket Description:</b> <?php echo ucwords($val->ticket_description);?></div>
                                                                <div class="col-md-4"><b>Notes:</b> <?php echo ucwords($val->ticket_notes);?></div>
                                                            </div>
														<?php }?>
														<?php if($val->pickup_notes !=''){?>
                                                            <h3><b class="text-danger">PICKUP NOTES</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-8"><?php echo htmlspecialchars_decode($val->pickup_notes);?></div>
                                                                <div class="col-md-4"></div>
                                                            </div>
                                                        <?php }?>
														<?php if($val->close_notes !=''){?>
                                                            <h3><b class="text-danger">CLOSE TICKET NOTES</b></h3>
                                                            <div class="row">
                                                                <div class="col-md-8"><?php echo htmlspecialchars_decode($val->close_notes);?></div>
                                                                <div class="col-md-4"></div>
                                                            </div>
                                                        <?php }?>
                                                        <div class="row">
                                                            <div class="col-md-6" id="replies_<?php echo $ticket_id;?>"><b class="text-danger">REPLIES</b> <i class="fa fa-eye eyes" style="color:#4c85e0;" onclick="getViewsNames(<?php echo $ticket_id;?>)" data-toggle="modal" data-target="#view_eyes-<?php echo $ticket_id;?>"></i><?php echo $replies;?></div>
                                                            <div class="col-md-6">
                                                                <?php if($val->ticket_filename !='' || $val->pickup_filename !='' || $val->close_filename !=''){?>
                                                                    <h3><b class="text-danger">ATTACHMENT</b></h3>
                                                                    <div class="popup-gallery_<?php echo $ticket_id;?> m-t-10">
                                                                        <div class="row">                                                                       
                                                                        <?php if($val->ticket_filename !=''){$images = explode(',', $val->ticket_filename);$con=1; foreach($images as $image){?>
                                                                            <div class="col-md-6">
                                                                                <i class="fa fa-paper-plane-o plane_<?php echo $ticket_id;?>" onclick="tagImages(<?php echo $ticket_id;?>, <?php echo $con;?>);"></i>
                                                                                <input type="checkbox" class="hidden chk_tag imageNo_<?php echo $ticket_id;?> tagImage_<?php echo $ticket_id;?>_<?php echo $con;?>" id="<?php echo $ticket_id.'_'.$con;?>" value="1" />
                                                                                <a class="m-r-10 m-t-10" title="Created by <?php echo $generated_by;?> on <?php echo date("m/d/Y", strtotime($val->created_date));?> at <?php echo date("h:i a", strtotime($val->created_date));?>" href="<?php echo base_url();?>assets/images/ticket_images/<?php echo $image;?>"><img src="<?php echo base_url();?>assets/images/ticket_images/<?php echo $image;?>" width="70%" id="image_<?php echo $ticket_id;?>_<?php echo $con;?>" /></a>
                                                                            </div>
                                                                        <?php if($con%2 == 0){echo '</div><div class="row">';}?>
                                                                        <?php $con++;}} if($val->pickup_filename !=''){?>
                                                                            <div class="col-md-6">
                                                                                <i class="fa fa-paper-plane-o plane_<?php echo $ticket_id;?>" onclick="tagImages(<?php echo $ticket_id;?>, <?php echo $con;?>);"></i>
                                                                                <input type="checkbox" class="hidden chk_tag imageNo_<?php echo $ticket_id;?> tagImage_<?php echo $ticket_id;?>_<?php echo $con;?>" id="<?php echo $ticket_id.'_'.$con;?>" value="1" />
                                                                                <a class="m-r-10 m-t-10" title="Picked by <?php echo $picked_by;?> on <?php echo date("m/d/Y", strtotime($val->pickup_date));?> at <?php echo date("h:i a", strtotime($val->pickup_date));?>" href="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->pickup_filename;?>"><img src="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->pickup_filename;?>" width="70%" id="image_<?php echo $ticket_id;?>_<?php echo $con;?>" /></a>
                                                                            </div>
                                                                        <?php }
																		if($val->close_filename !=''){?>
                                                                            <div class="col-md-6">
                                                                                <i class="fa fa-paper-plane-o plane_<?php echo $ticket_id;?>" onclick="tagImages(<?php echo $ticket_id;?>, <?php echo $con;?>);"></i>
                                                                                <input type="checkbox" class="hidden chk_tag imageNo_<?php echo $ticket_id;?> tagImage_<?php echo $ticket_id;?>_<?php echo $con;?>" id="<?php echo $ticket_id.'_'.$con;?>" value="1" />
                                                                                <a class="m-r-10 m-t-10" title="Picked by <?php echo $picked_by;?> on <?php echo date("m/d/Y", strtotime($val->close_date));?> at <?php echo date("h:i a", strtotime($val->close_date));?>" href="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->close_filename;?>"><img src="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->close_filename;?>" width="70%" id="image_<?php echo $ticket_id;?>_<?php echo $con;?>" /></a>
                                                                            </div>
                                                                        <?php }?>
                                                                        </div>
                                                                     </div>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                        <hr class="m-b-10">
                                                        <div class="row" id="quickReplyDiv_<?php echo $ticket_id;?>" style="display:none;">
                                                            <div class="col-md-12">
                                                                <form action="" id="quickMessageForm_<?php echo $ticket_id;?>" method="post" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <h3><b class="text-danger">Tagged Images</b></h3>
                                                                        <ul class="dp-table taggedImages_<?php echo $ticket_id;?>"></ul>
                                                                    </div>
                                                                        <input type="hidden" name="ticket_num" value="<?php echo $ticket_id;?>" />
                                                                        <input type="hidden" id="qmajax_<?php echo $ticket_id;?>" name="notes" value="" />
                                                                        
                                                                    <div class="row send-chat-box">
                                                                        <div class="col-sm-8 p-r-0">
                                                                            <textarea class="quick_message" placeholder="Try to mention me, by typing @john" name="quick_message" id="quick_message_<?php echo $ticket_id;?>" rows="5" cols="60"></textarea>
                                                                        </div>
                                                                        <div class="col-xs-4 m-t-10">
                                                                            <a href="javascript:;" onclick="showEmojies(<?php echo $ticket_id;?>);" class="cst-icon" data-toggle="tooltip" title="Insert Emojis" data-original-title="Insert Emojis"><i class="ti-face-smile"></i></a>
                                                                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="fa fa-paperclip"></i></span><input type="file" class="upload" id="file_<?php echo $ticket_id;?>" name="file" value="" title="Upload File" /></div>
                                                                            <button type="button"class="btn btn-success btn-circlee waves-effect" onclick="SaveQuickmessageBox(<?php echo $ticket_id;?>);" title="Send Message"><i class="fa fa-paper-plane-o"></i></button>
                                                                            <button type="button" class="btn btn-danger waves-effect" onclick="hideQuickmessageBox(<?php echo $ticket_id;?>);" title="Cancle Message"><i class="fa fa-times"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="action_bar_<?php echo $ticket_id;?>">
                                                            <div class="col-md-4 text-center"><button type="button" class="btn btn-success waves-effect" onclick="showmessageBox(<?php echo $ticket_id;?>);">Reply</button></div>
                                                            <div class="col-md-8"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <ul class="pager m-0">
															<?php if($ind==0){?>
                                                                <li class="previous disabled"><a href="javascript:;">&larr; Previous</a></li>
                                                            <?php }else{?>
                                                                <li class="previous">
                                                                	<a href="javascript:;" data-dismiss="modal" onclick="popToLoadID('.bs-pending-ticket-<?php echo $closedTickets[$ind-1]->ticketID;?>');">&larr; Previous</a>
                                                                    <!--<button type="button" data-dismiss="modal" data-toggle="modal" data-target=".bs-pending-ticket-<?php echo $closedTickets[$ind-1]->ticketID;?>" class="btn btn-default waves-effect waves-light model_img img-responsive">&larr; Previous</button>-->
                                                                    </li>
                                                            <?php }if($ind==(count($closedTickets)-1)){?>
                                                                <li class="next disabled"><a href="javascript:;">Next &rarr;</a></li>
                                                            <?php }else{?>
                                                                <li class="next">
                                                                	<a href="javascript:;" data-dismiss="modal" onclick="popToLoadID('.bs-pending-ticket-<?php echo $closedTickets[$ind+1]->ticketID;?>');">Next &rarr;</a>
                                                                    <!--<button type="button" data-dismiss="modal" data-toggle="modal" data-target=".bs-pending-ticket-<?php echo $closedTickets[$ind+1]->ticketID;?>" class="btn btn-default waves-effect waves-light model_img img-responsive">Next &rarr;</button>-->
                                                                    </li>
                                                            <?php }?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tr>
                                        	<td class="hidden"><?php echo $ticket_id;?></td>
                                            <td><?php echo $ticket_type.$ticket_id;?></td>
                                            <td><?php echo $val->guest_name;?></td>
                                            <td><?php echo ucwords($val->service_rec);?></td>
                                            <td><?php echo $val->guest_type;?></td>
                                            <td><?php echo $val->room_no;?></td>
                                            <td>Closed</td>
                                            <td><button type="button" onclick="loadpopupModal(<?php echo $ticket_id;?>)" data-toggle="modal" data-target=".bs-pending-ticket-<?php echo $ticket_id;?>" class="btn btn-warning waves-effect waves-light model_img img-responsive">View</button></td>
                                        </tr>
										<script>
											$(document).ready(function(){
												$('.popup-gallery_<?php echo $ticket_id;?>').magnificPopup({
													delegate: 'a',
													type: 'image',
													tLoading: 'Loading image #%curr%...',
													mainClass: 'mfp-img-mobile',
													gallery: {
														enabled: true,
														navigateByImgClick: true,
														preload: [0,1] // Will preload 0 - before current, and 1 after the current image
													},
													image: {
														tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
														titleSrc: function(item) {
															//return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';																								
															return item.el.attr('title');
														}
													}
												});
												<!--mentions-->
												$('textarea#quick_message_<?php echo $ticket_id;?>').mentionsInput({
														onDataRequest:function (mode, query, callback){
															var path = '<?=site_url()?>users/all_hotel_users_for_mentions/'+query;
															$.getJSON(path, function(responseData) {console.log(responseData);
																responseData = _.filter(responseData, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
																callback.call(this, responseData);
															});
														}
													});
											});
										</script>
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
.mfp-img{
	background-color:#222222;
}
.mfp-title{
	opacity:0.7;
}
#emojiPickerWrap {margin:10px 0 0 0;}
.emojiPicker{
	top:271px !important;
}
.eyes{
	cursor:pointer;
}
</style>