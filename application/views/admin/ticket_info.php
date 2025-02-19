<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ticket Information</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Ticket Information Page</li>
            </ol>
        </div>
    </div>
    
    <?php
	if(is_array($ticket_info)){
	foreach($ticket_info as $val){												
		$dept_name		= $val->dept_name;
		$ticket_id		= $val->ticketID;
		$ticket_type_id	= $val->ticketTypeID;
		$ticket_type	= $val->type_name;
		$generated_by	= 'Email Notification';
		if($val->generated_by > 0){
			$generatedBy	= admin_helper::get_user_name($val->generated_by);
			$generated_by	= $generatedBy[0]->username;
		}
		if($val->picked_by){
			$pickedBy		= admin_helper::get_user_name($val->picked_by);
			$picked_by		= $pickedBy[0]->username;
		}
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
		
		if($val->ticket_status == 1){$ticket_status = 'PENDING';}elseif($val->ticket_status == 2){$ticket_status = 'PICKED-UP';}else{$ticket_status = 'CLOSED';}
	?>
    <div id="pick_up_ticket-<?php echo $ticket_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:999999999; top:100px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Pick-Up Ticket - <?php echo $ticket_type.$ticket_id;?></h4>
                </div>
                <div class="modal-body">
                    <form class="" action="" id="pickup_form_<?php echo $ticket_id;?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-5 p-l-0">Estimated time of completion:</label>
                            <div class="col-sm-2 p-l-0">
                                <input class="form-control" type="number" min="1" name="time" id="time_<?php echo $ticket_id;?>" value="1" />
                            </div>
                            <div class="col-sm-3 p-l-0">
                                <select class="form-control" id="rem_period_<?php echo $ticket_id;?>" name="rem_period">
                                    <option value="minutes">Minutes</option>
                                    <option value="hours" selected="selected">Hours</option>
                                    <option value="days">Days</option>
                                    <option value="weeks">weeks</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 p-l-0">Notes:</label>
                            <div class="col-sm-12 p-l-0">
                                <textarea class="form-control" id="pickup_notes_<?php echo $ticket_id;?>" name="pickup_notes" rows="5" cols="60"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <label class="col-sm-12 p-l-0 m-t-10">Attachment:</label>
                            <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                <input type="file" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect" onclick="pickupTicket(<?php echo $ticket_id;?>);">Submit</button>
                    <!--<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>
    </div>
	<div id="TID_Model_<?php echo $ticket_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Close Ticket Notes</h4> </div>
                    <div class="modal-body">
                        <form class="" action="<?php echo base_url();?>ticket/ticket_closed" method="post" enctype="multipart/form-data">
                        <?php if($ticket_type_id == 3){?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Confirmation Number:</label>
                                        <input type="text" class="form-control" name="confirmation_num" placeholder="Confirmation Number" value="" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Check-in Associate (BTR):</label>
                                        <input type="text" class="form-control" name="chk_in_assoc" placeholder="Check-in Associate (BTR)" value="" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Company Name:</label>
                                        <input type="text" class="form-control" name="company" placeholder="Company Name" value="" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Room Number:</label>
                                        <select class="form-control" name="room_no" id="room_no" required="required">
                                            <option value="">Select Room Number</option>
                                            <?php foreach($room_info as $row){?>
                                                <option value="<?php echo $row->room_no;?>"><?php echo $row->room_no.' ('.$row->room_type.')';?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Arrival Date:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control datetimepicker1" id="close_tkt_arrival" name="arrival_date" placeholder="Arrival Date" required="required"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Departure Date:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control datetimepicker2" id="close_tkt_dept" name="dept_date" placeholder="Departure Date" required="required"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="hk_date_range_info" style="display:none;">
                                <div class="col-sm-12 m-b-20">
                                    <div class="form-group">
                                    <label class="control-label col-sm-12 p-l-0">Housekeepers in this date range:</label>
                                    <div id="spinner" class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-spin fa-refresh"></i></div>
                                    <span class="col-sm-12" id="hk_names"></span>
                                </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Home Phone Number:</label>
                                        <input type="text" class="form-control" name="phone_num" placeholder="Home Phone Number" value="" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Email:</label>
                                        <input type="text" class="form-control" name="email" placeholder="Email" value="" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Loyalty Member Level:</label>
                                        <input type="text" class="form-control" name="loyalty_level" placeholder="Loyalty Member Level" value="" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Loyalty Member Number:</label>
                                        <input type="text" class="form-control" name="loyalty_num" placeholder="Loyalty Member Number" value="" required="required" />
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        <div class="form-group">
                            <input type="hidden" name="ticket_id" value="<?php echo $ticket_id;?>" />
                            <input type="hidden" name="ticket_type_id" value="<?php echo $ticket_type_id;?>" />
                            <label for="notes" class="control-label">Notes:</label>
                            <textarea class="form-control" id="notes_<?php echo $ticket_id;?>" name="notes" rows="5" cols="60"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label">Compensation $:</label>
                            <input type="text" class="form-control" name="compensation" value="" />
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label">Guest Satisfaction:</label>
                            <div class="radio radio-success">
                                <input type="radio" name="gSatisfaction" value="smile">
                                <label for="servicerecovery"> <i class="fa fa-smile-o"></i> </label>
                            </div>
                            <div class="radio radio-success">
                                <input type="radio" name="gSatisfaction" value="normal" checked="">
                                <label for="servicerecovery"> <i class="fa fa-meh-o"></i> </label>
                            </div>
                            <div class="radio radio-success">
                                <input type="radio" name="gSatisfaction" value="sad">
                                <label for="servicerecovery"> <i class="fa fa-frown-o"></i> </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="fileupload btn btn-success waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Upload File</span><input type="file" name="file" class="upload"> </div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Save</button>
                            </div>
                        </div>
                    </form>
                </div>                                               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box printableArea">
                <h3><b>Ticket #<?php echo $ticket_type.$ticket_id;?> Generated by "<?php echo $generated_by;?>" Assigned To "<?php echo $dept_name;?>" Department</b>
                <?php echo $this->uri->segment(4);?>
                <span class="pull-right">
				<?php echo date("M d, Y h:i", strtotime($val->created_date));?></span></h3>
                <hr>
                <div class="row">
                	<div class="col-md-6"></div>
                    <div class="col-md-6 pull-right">
						<?php if($ticket_type_id == 1){?>
                            <button type="button" class="btn btn-danger waves-effect waves-light"><?php echo $ticket_status?></button>
                        <?php }else{if($val->service_rec == 'yes'){?>
                            <button type="button" class="btn btn-danger waves-effect waves-light"><blink style="color:#FFF;"><?php echo $ticket_status?></blink></button>
                        <?php }else{?>
                            <button type="button" class="btn btn-danger waves-effect waves-light"><?php echo $ticket_status?></button>
                        <?php }}?>
                    </div>
                </div>
                <hr>
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
                        <div class="col-md-6" id="replies_<?php echo $ticket_id;?>"><h3><b class="text-danger">REPLIES</b></h3><?php echo $replies;?></div>
                        <div class="col-md-6">
                            <?php if($val->ticket_filename !='' || $val->pickup_filename !='' || $val->close_filename !=''){?>
                                <h3><b class="text-danger">ATTACHMENT</b></h3>
                                <div class="popup-gallery_<?php echo $ticket_id;?> m-t-10" >
                                    <?php if($val->ticket_filename !=''){$images = explode(',', $val->ticket_filename);foreach($images as $image){?>
                                        <a class="m-r-10 m-t-10" title="Created by <?php echo $generated_by;?> on <?php echo date("m/d/Y", strtotime($val->created_date));?> at <?php echo date("h:i a", strtotime($val->created_date));?>" href="<?php echo base_url();?>assets/images/ticket_images/<?php echo $image;?>"><img src="<?php echo base_url();?>assets/images/ticket_images/<?php echo $image;?>" width="30.5%" /></a>
                                    <?php }} if($val->pickup_filename !=''){?>
                                        <a class="m-r-10 m-t-10" title="Picked by <?php echo $picked_by;?> on <?php echo date("m/d/Y", strtotime($val->pickup_date));?> at <?php echo date("h:i a", strtotime($val->pickup_date));?>" href="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->pickup_filename;?>"><img src="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->pickup_filename;?>" width="30.5%" /></a>
                                    <?php } if($val->close_filename !=''){?>
                                        <a class="m-r-10 m-t-10" title="Closed by <?php echo $picked_by;?> on <?php echo date("m/d/Y", strtotime($val->close_date));?> at <?php echo date("h:i a", strtotime($val->close_date));?>" href="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->close_filename;?>"><img src="<?php echo base_url();?>assets/images/ticket_images/<?php echo $val->close_filename;?>" width="30.5%" /></a>
                                    <?php }?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="row" id="replydiv_<?php echo $ticket_id;?>" style="display:none;">
                        <div class="col-md-12">
                            <form action="" id="messageForm_<?php echo $ticket_id;?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" name="ticket_num" value="<?php echo $ticket_id;?>" />
                                    <textarea class="form-control" id="edit_notes_<?php echo $ticket_id;?>" name="notes" rows="5" cols="60"></textarea>
                                </div>
                                <div class="form-group">
                                    <h3 class="box-title m-b-0">Attachments:</h3>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="file" multiple/> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists rem_file" data-dismiss="fileinput">Remove</a> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-defualt waves-effect" onclick="hidemessageBox(<?php echo $ticket_id;?>);">Cancel</button>
                                        <button type="button" class="btn btn-info waves-effect" onclick="SavemessageBox(<?php echo $ticket_id;?>);">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                    	<?php if($val->ticket_status != 3){?>
                        	<div class="col-md-4 text-center"><!--<button type="button" class="btn btn-success waves-effect" onclick="showmessageBox(<?php echo $ticket_id;?>);">Reply</button>--></div>
						<?php }?>
                        <?php if($val->ticket_status == 1){?>
                        	<div class="col-md-4 text-center"><button type="button" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#pick_up_ticket-<?php echo $ticket_id;?>">Pick-Up</button></div>
                        <?php }?>
                        <?php if($val->ticket_status == 2){?>
                        	<div class="col-md-4 text-center"><button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#TID_Model_<?php echo $ticket_id;?>">Close</button></div>
                        <?php }?>
                    </div>
            </div>
        </div>
    </div>
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
			if(window.location.href.split('/')[6]){
				if(window.location.href.split('/')[6] == 'pickup'){
					setTimeout(function(){
						$('#pick_up_ticket-'+window.location.href.split('/')[5]).modal('show');
					}, 2000);
				}
				if(window.location.href.split('/')[6] == 'reply'){
					showmessageBox(window.location.href.split('/')[5]);
				}
			}
		});
	</script>
    <?php }}?>
</div>
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
.indicator {
    width: 10px;
    height: 10px;
    display: inline-block;
    border-radius: 9999px;
    margin-right: 5px;
}
.label-success {
    background-color: #8ad919;
}
.label-danger {
    background-color: #F00;
}
</style>