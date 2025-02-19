<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pending Tickets</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Pending Tickets Page</li>
            </ol>
        </div>
    </div>
    <!--<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.0/css/all.css" crossorigin="anonymous">-->
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Pending Tickets</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="white-box">
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
    						<div style="display:none; z-index:9999999999999999999999999999999999999;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                        	<th class="hidden">&nbsp;</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Ticket #</th>
                                            <th>Room#</th>
                                            <th>Created By</th>
                                            <th>Department</th>
                                            <th>Timer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php if(is_array($pendingTickets)){
											foreach($pendingTickets as $ind => $val){												
												$dept_name		= $val->dept_name;
												$ticket_id		= $val->ticketID;
												$ticket_type_id	= $val->ticketTypeID;
												$ticket_type	= $val->type_name;
												if($val->generated_by >0){
													$generatedBy	= admin_helper::get_user_name($val->generated_by);
													$generated_by	= $generatedBy[0]->username;
												}else{$generated_by	= '--';}
												$reply_notes	= admin_helper::get_ticket_notes_replies($ticket_id);
												$replies		= ''; 
												
												$head = '<div class="chat-box"><ul class="chat-list slimscrolll p-0">';
												$foot = '</ul></div>';
												if(!empty($reply_notes) && isset($reply_notes)){
													foreach($reply_notes as $reply){
														$repDate = date("m-d-Y", strtotime($reply->added_date));
														$repTime = date("h:i a", strtotime($reply->added_date));
                                                        $replies .= '<li class="m-b-10"><div class="chat-body"><div class="chat-text"><h4>'.$reply->added_by.'</h4><p>'.htmlspecialchars_decode($reply->message).'</p><b>'.$repDate.' '.$repTime.'</b></div></div></li>';
													}//#4c85e0
												}else{
													$replies .= '<li class="m-b-10 hidden"><div class="chat-body"><div class="chat-text"><h4>No, Replies yet!</h4></div></div></li>';
												}
												$replies = $head.$replies.$foot;
											?>
                                            <!--<div id="myModalUpdate-<?php echo $ticket_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:99999999999999999; top:100px;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myModalLabel">Update Pick-Up Ticket</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" action="" id="update_pickup_form_<?php echo $ticket_id;?>" method="post" enctype="multipart/form-data">
                                                            	<input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $ticket_id;?>" />
                                                                <div class="form-group clear">
                                                                    <label class="col-sm-5 p-l-0 m-b-5">Department:</label>
                                                                    <div class="col-sm-5 p-l-0 m-b-5">
                                                                    	<select class="form-control" name="assign_to_dept" id="assign_to_dept" required="">
                                                                            <option value="">Select Any Department</option>
                                                                            <option value="2" <?php if($val->assign_to_dept == 2){echo 'selected="selected"';}?>>MANAGER ON DUTY</option>
                                                                            <option value="3" <?php if($val->assign_to_dept == 3){echo 'selected="selected"';}?>>FRONT DESK</option>
                                                                            <option value="4" <?php if($val->assign_to_dept == 4){echo 'selected="selected"';}?>>HOUSEKEEPING</option>
                                                                            <option value="5" <?php if($val->assign_to_dept == 5){echo 'selected="selected"';}?>>FOOD &amp; BEVERAGE</option>
                                                                            <option value="6" <?php if($val->assign_to_dept == 6){echo 'selected="selected"';}?>>SALES</option>
                                                                            <option value="7" <?php if($val->assign_to_dept == 7){echo 'selected="selected"';}?>>MAINTENANCE</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php if($val->special_ticket == 0 or $val->special_ticket == 2){?>
																<?php if($val->houseGuest == 'yes'){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Room Number:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestRoomNumber" id="guestRoomNumber" value="<?php echo $val->guestRoomNumber;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Room Type:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestRoomType" id="guestRoomType" value="<?php echo $val->guestRoomType;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Guest Name:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestName" id="guestName" value="<?php echo $val->guestName;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Email:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestEmail" id="guestEmail" value="<?php echo $val->guestEmail;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Phone:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestNumber" id="guestNumber" value="<?php echo $val->guestNumber;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">ARRIVAL DATE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="arrivalDate" id="arrivalDate" value="<?php echo date("m/d/Y", strtotime($val->arrivalDate));?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">DEPARTURE DATE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="departDate" id="departDate" value="<?php echo date("m/d/Y", strtotime($val->departDate));?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }elseif($val->houseGuest == 'no'){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Guest Name:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestName" id="guestName" value="<?php echo $val->guestName;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Email:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestEmail" id="guestEmail" value="<?php echo $val->guestEmail;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Phone:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestNumber" id="guestNumber" value="<?php echo $val->guestNumber;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php if($val->furtherReservation == 'yes'){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">Future Reservation:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Room Type:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestRoomType" id="guestRoomType" value="<?php echo $val->guestRoomType;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">ARRIVAL DATE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="arrivalDate" id="arrivalDate" value="<?php echo date("m/d/Y", strtotime($val->arrivalDate));?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">DEPARTURE DATE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="departDate" id="departDate" value="<?php echo date("m/d/Y", strtotime($val->departDate));?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
																<?php }else{?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">Standard Guest:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                <?php }?>
																<?php if($val->assign_to_dept == 2){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">MANAGER ON DUTY</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Service:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="mangrDutyConcern" id="mangrDutyConcern" value="<?php echo ucwords($val->mangrDutyConcern);?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Needs:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="mangrExpalin" id="mangrExpalin" value="<?php echo ucwords($val->mangrExpalin);?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Notes:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="mingrNotes" id="mingrNotes" value="<?php echo $val->mingrNotes;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if($val->assign_to_dept == 3){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">FRONT DESK:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">NOTES:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="frontDeskNotes" id="frontDeskNotes" value="<?php echo $val->frontDeskNotes;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
																<?php if($val->assign_to_dept == 4){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">HOUSEKEEPING:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">SERVICE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="houseKeepingSer" id="houseKeepingSer" value="<?php echo $val->houseKeepingSer;?>" />
                                                                        </div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">NOTES:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="houseKeepingNotes" id="houseKeepingNotes" value="<?php echo $val->houseKeepingNotes;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if($val->assign_to_dept == 5){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">FOOD &amp; BEVERAGE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">SERVICE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="foodsService" id="foodsService" value="<?php echo ucwords($val->foodsService);?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">GROUP:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="nameOfGroup" id="nameOfGroup" value="<?php echo ucwords($val->nameOfGroup);?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">NOTES:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="foodGuestNotes" id="foodGuestNotes" value="<?php echo $val->foodGuestNotes;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                            	<?php if($val->assign_to_dept == 6){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">SALES:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Company:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="saleCompany" id="saleCompany" value="<?php echo $val->saleCompany;?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Email:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="salesMail" id="salesMail" value="<?php echo $val->salesMail;?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Primary Phone:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="salesPhone" id="salesPhone" value="<?php echo $val->salesPhone;?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Secondary Phone:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="salesPhone2" id="salesPhone2" value="<?php echo $val->salesPhone2;?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Call Time:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                        	<select class="form-control" name="salesCallTime" id="salesCallTime" required="">
                                                                                <option value="">BEST TIME FOR CALL</option>
                                                                                <option value="morning" <?php if($val->salesCallTime == 'morning'){echo 'selected="selected"';}?>>Morning</option>
                                                                                <option value="afternoon" <?php if($val->salesCallTime == 'afternoon'){echo 'selected="selected"';}?>>Afternoon</option>
                                                                                <option value="evening" <?php if($val->salesCallTime == 'evening'){echo 'selected="selected"';}?>>Evening</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Bring to hotel from:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="bringsHotel" id="bringsHotel" value="<?php echo $val->bringsHotel;?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Urgent Request:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                        	<select class="form-control" name="urgentRequest" id="urgentRequest" required="">
                                                                                <option value="yes" <?php if($val->urgentRequest== 'yes'){echo 'selected="selected"';}?>>Yes</option>
                                                                                <option value="no" <?php if($val->urgentRequest == 'no'){echo 'selected="selected"';}?>>No</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            		<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Budget $$:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestBudget" id="guestBudget" value="<?php echo $val->guestBudget;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php if($val->guestRoomNeed == 'yes'){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">GUEST ROOMS NEEDED:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">ARRIVAL DATE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestarivalDate" id="guestarivalDate" value="<?php echo date("m/d/Y", strtotime($val->guestarivalDate));?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">DEPARTURE DATE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestDepartDate" id="guestDepartDate" value="<?php echo date("m/d/Y", strtotime($val->guestDepartDate));?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">No. of Guest Rooms:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestRooms" id="guestRooms" value="<?php echo $val->guestRooms;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }else{?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">ARRIVAL DATE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="guestarivalDate" id="guestarivalDate" value="<?php echo date("m/d/Y", strtotime($val->guestarivalDate));?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if($val->meetingRoomNeeded == 'yes'){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">MEETING ROOMS NEEDED:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">No. of People for meetings:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="peoples" id="peoples" value="<?php echo $val->peoples;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if($val->foodNeed == 'yes'){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">FOOD AND BEVERAGE NEEDED:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Food Needed:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="foodNeed" id="foodNeed" value="<?php echo $val->foodNeed;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if($val->returnGuest == 'yes'){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">RETURNED NEEDED:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Returned Guest:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="returnGuest" id="returnGuest" value="<?php echo $val->returnGuest;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Notes:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="saleNotes" id="saleNotes" value="<?php echo $val->saleNotes;?>" />
                                                                        </div>
                                                                    </div>
																<?php }?>
                                                                <?php if($val->assign_to_dept == 7){?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5 underline">MAINTENANCE:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Service:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="maintServ" id="maintServ" value="<?php echo ucwords($val->maintServ);?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Needs:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="maintExplain" id="maintExplain" value="<?php echo ucwords($val->maintExplain);?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Notes:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <input type="text" class="form-control" name="mainnotes" id="mainnotes" value="<?php echo $val->mainnotes;?>" />
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
																<?php }
																	elseif($val->special_ticket == 5){
																		if($val->assign_to_dept == 2){?>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5 underline">MANAGER ON DUTY</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                            </div>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5">Notes:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5">
                                                                                    <input type="text" class="form-control" name="mingrNotes" id="mingrNotes" value="<?php echo $val->mingrNotes;?>" />
                                                                                </div>
                                                                            </div>
                                                                        <?php }
																		if($val->assign_to_dept == 3){?>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5 underline">FRONT DESK:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                            </div>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5">NOTES:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5">
                                                                                    <input type="text" class="form-control" name="frontDeskNotes" id="frontDeskNotes" value="<?php echo $val->frontDeskNotes;?>" />
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                        if($val->assign_to_dept == 4){?>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5 underline">HOUSEKEEPING:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                            </div>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5">NOTES:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5">
                                                                                    <input type="text" class="form-control" name="houseKeepingNotes" id="houseKeepingNotes" value="<?php echo $val->houseKeepingNotes;?>" />
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                        if($val->assign_to_dept == 5){?>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5 underline">FOOD &amp; BEVERAGE:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                            </div>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5">NOTES:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5">
                                                                                    <input type="text" class="form-control" name="foodGuestNotes" id="foodGuestNotes" value="<?php echo $val->foodGuestNotes;?>" />
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                        if($val->assign_to_dept == 6){?>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5 underline">SALES:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                            </div>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5">Notes:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5">
                                                                                    <input type="text" class="form-control" name="saleNotes" id="saleNotes" value="<?php echo $val->saleNotes;?>" />
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                        if($val->assign_to_dept == 7){?>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5 underline">MAINTENANCE:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                            </div>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5">Notes:</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5">
                                                                                    <input type="text" class="form-control" name="mainnotes" id="mainnotes" value="<?php echo $val->mainnotes;?>" />
                                                                                </div>
                                                                            </div>
                                                                        <?php }
																		?>
                                                                        <div class="form-group clear">
                                                                            <label class="col-sm-5 p-l-0 m-b-5 underline">MAINTENANCE:</label>
                                                                            <div class="col-sm-5 p-l-0 m-b-5"></div>
                                                                        </div>
                                                                        <div class="form-group clear">
                                                                            <label class="col-sm-5 p-l-0 m-b-5">Service:</label>
                                                                            <div class="col-sm-5 p-l-0 m-b-5">
                                                                                <input type="text" class="form-control" name="maintServ" id="maintServ" value="<?php echo ucwords($val->maintServ);?>" />
                                                                            </div>
                                                                        </div>
                                                                    <?php
																	}
																	else{?>
                                                                	<div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Category:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <?php $cat_name = admin_helper::get_category_name($val->cat_id); echo $cat_name[0]->cat_name;?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Item Name:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                           <?php $subcat_name = admin_helper::get_subcategory_name($val->item_id); echo $subcat_name[0]->subcat_name;?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Quarter:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <?php echo $val->quarter;?>
                                                                        </div>
                                                                    </div>
                                                                	<hr />
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">STATUS</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                        	<select class="form-control" name="pm_status" id="pm_status" required="">
                                                                                <option value="complete" <?php if($val->pm_status == 'complete'){echo 'selected="selected"';}?>>Complete</option>
                                                                                <option value="flag" <?php if($val->pm_status == 'flag'){echo 'selected="selected"';}?>>Flagged</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
																	<?php if($val->pm_status == 'complete'){?>
                                                                        <div class="form-group clear">
                                                                            <label class="col-sm-5 p-l-0 m-b-5">Were repairs necessary?</label>
                                                                            <div class="col-sm-5 p-l-0 m-b-5">
                                                                                <input type="text" class="form-control" name="repair_req" id="repair_req" value="<?php echo $val->repair_req;?>" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group clear">
                                                                            <label class="col-sm-5 p-l-0 m-b-5">What condition would you rate this item?</label>
                                                                            <div class="col-sm-5 p-l-0 m-b-5">
                                                                            	<select class="form-control" name="ratting" id="ratting" required="">
                                                                                    <option value="new" <?php if($val->ratting== 'new'){echo 'selected="selected"';}?>>NEW</option>
                                                                                    <option value="great" <?php if($val->ratting == 'great'){echo 'selected="selected"';}?>>GREAT</option>
                                                                                    <option value="fair" <?php if($val->ratting == 'fair'){echo 'selected="selected"';}?>>FAIR</option>
                                                                                    <option value="poor" <?php if($val->ratting == 'poor'){echo 'selected="selected"';}?>>POOR</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <?php if($val->repair_req == 'yes'){?>
                                                                            <div class="form-group clear">
                                                                                <label class="col-sm-5 p-l-0 m-b-5">What was speficially repaired?</label>
                                                                                <div class="col-sm-5 p-l-0 m-b-5">
                                                                                    <input type="text" class="form-control" name="spsfic_req" id="spsfic_req" value="<?php echo $val->spsfic_req;?>" />
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                    <?php }else{?>
                                                                        <div class="form-group clear">
                                                                            <label class="col-sm-5 p-l-0 m-b-5">Flagged Type:</label>
                                                                            <div class="col-sm-5 p-l-0 m-b-5">
                                                                            	<select class="form-control" name="flage_type" id="flage_type" required="">
                                                                                    <option value="paint" <?php if($val->flage_type == 'paint'){echo 'selected="selected"';}?>>PAINT</option>
                                                                                    <option value="repair" <?php if($val->flage_type == 'repair'){echo 'selected="selected"';}?>>REPAIR</option>
                                                                                    <option value="replace" <?php if($val->flage_type == 'replace'){echo 'selected="selected"';}?>>REPLACE</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group clear">
                                                                            <label class="col-sm-5 p-l-0 m-b-5">Flagged Type 02:</label>
                                                                            <div class="col-sm-5 p-l-0 m-b-5">
                                                                            	<select class="form-control" name="flage_type_2" id="flage_type_2" required="">
                                                                                    <option value="slight" <?php if($val->flage_type_2 == 'slight'){echo 'selected="selected"';}?>>SLIGHT</option>
                                                                                    <option value="moderate" <?php if($val->flage_type_2 == 'moderate'){echo 'selected="selected"';}?>>MODERATE</option>
                                                                                    <option value="severe" <?php if($val->flage_type_2 == 'severe'){echo 'selected="selected"';}?>>SEVERE</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group clear">
                                                                            <label class="col-sm-5 p-l-0 m-b-5">Outside Vendor Required?</label>
                                                                            <div class="col-sm-5 p-l-0 m-b-5">
                                                                            	<select class="form-control" name="vendor_req" id="vendor_req" required="">
                                                                                    <option value="yes" <?php if($val->vendor_req== 'yes'){echo 'selected="selected"';}?>>Yes</option>
                                                                                    <option value="no" <?php if($val->vendor_req == 'no'){echo 'selected="selected"';}?>>No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    <?php }?>
                                                                    <div class="form-group clear">
                                                                        <label class="col-sm-5 p-l-0 m-b-5">Notes:</label>
                                                                        <div class="col-sm-5 p-l-0 m-b-5">
                                                                            <textarea class="form-control" rows="5" cols="5" name="pm_notes"><?php echo htmlspecialchars_decode($val->pm_notes);?></textarea>
                                                                        </div>
                                                                    </div>
                                                            	<?php }?>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer clear">
                                                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-info waves-effect" onclick="updatePickupTicket(<?php echo $ticket_id;?>);">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
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
                                            <div id="pick_up_ticket-<?php echo $ticket_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:999999999; top:100px;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myModalLabel">Pick-Up Ticket - <?php echo $ticket_type.$ticket_id;?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" action="" id="pickup_form_<?php echo $ticket_id;?>" method="post" enctype="multipart/form-data">
                                                                <!--<div class="form-group">
                                                                    <label class="col-sm-5 p-l-0">Estimated time of completion:</label>
                                                                    <div class="col-sm-5 p-l-0">
                                                                        <select class="form-control" name="time" id="time_<?php echo $ticket_id;?>" required>
                                                                            <option value="">Select completion Time</option>
                                                                            <optgroup label="Minutes">
                                                                                <option value="5 minute">5 Minutes</option>
                                                                                <option value="10 minute">10 Minutes</option>
                                                                                <option value="15 minute">15 Minutes</option>
                                                                                <option value="20 minute">20 Minutes</option>
                                                                                <option value="25 minute">25 Minutes</option>
                                                                                <option value="30 minute">30 Minutes</option>
                                                                                <option value="35 minute">35 Minutes</option>
                                                                                <option value="40 minute">40 Minutes</option>
                                                                                <option value="45 minute">45 Minutes</option>
                                                                                <option value="50 minute">50 Minutes</option>
                                                                                <option value="55 minute">55 Minutes</option>
                                                                            </optgroup>
                                                                            <optgroup label="Hours">
                                                                                <option value="1 hour">1 Hour</option>
                                                                                <option value="2 hour">2 Hours</option>
                                                                                <option value="3 hour">3 Hours</option>
                                                                                <option value="4 hour">4 Hours</option>
                                                                            </optgroup>
                                                                            <optgroup label="Days">
                                                                                <option value="1 day">1 Day</option>
                                                                                <option value="2 day">2 Days</option>
                                                                                <option value="3 day">3 Days</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>-->
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
                                                                 		<textarea class="form-control notes" id="pickup_notes_<?php echo $ticket_id;?>" name="pickup_notes" rows="5" cols="60"></textarea>
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
                                                                		<button type="button" class="btn btn-danger waves-effect waves-light">PENDING</button>
                                                                    <?php }else{if($val->service_rec == 'yes'){?>
                                                                    	<button type="button" class="btn btn-danger waves-effect waves-light"><blink style="color:#FFF;">PENDING</blink></button>
                                                                    <?php }else{?>
                                                                		<button type="button" class="btn btn-danger waves-effect waves-light">PENDING</button>
                                                                    <?php }}?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                        	<div class="row">
        														<div class="col-md-6"><b>Date Created:</b> <?php echo date("m/d/Y", strtotime($val->created_date));?></div>
        														<div class="col-md-6"><b>Created By:</b> <?php echo $generated_by;?></div>
                                                            </div>
                                                            <div class="row">
        														<div class="col-md-6"><b>Time Created:</b> <?php echo date("h:i", strtotime($val->created_date));?></div>
        														<div class="col-md-6"></div>
                                                            </div>
                                                            <div class="row">
        														<div class="col-md-6"><b>Time Elasped:</b> <span id="get_started__<?php echo $ticket_id;?>" class="get_started_<?php echo $ticket_id;?>"><?php echo "<script> showElapsdTimeElapsed('".$val->created_date."', '".$ticket_id."');</script>";?></span></div>
        														<div class="col-md-6"></div>
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
                                                            <div class="row">
                                                                <div class="col-md-6" id="replies_<?php echo $ticket_id;?>"><b class="text-danger">REPLIES</b> <i class="fa fa-eye eyes" style="color:#4c85e0;" onclick="getViewsNames(<?php echo $ticket_id;?>)" data-toggle="modal" data-target="#view_eyes-<?php echo $ticket_id;?>"></i></h3><?php echo $replies;?></div>
                                                                <div class="col-md-6">
                                                                    <?php if($val->ticket_filename !=''){?>
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
																			<?php $con++;}}?>
                                                                            </div>
                                                                    	</div>
                                                                    <?php }?>
                                                                </div>
                                                            </div>
                                                            <hr class="m-b-0">
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
                                                            <!--<div class="row" id="replydiv_<?php echo $ticket_id;?>" style="display:none;">
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
                                                            </div>-->
                                                            <input type="text" style="font-size:0px; border:0px none;" id="ticket_url_<?php echo $ticket_id;?>" value="<?php echo base_url();?>ticket/ticket_info/<?php echo $ticket_id;?>" />
                                                            <div class="row" id="action_bar_<?php echo $ticket_id;?>">
                                                                <div class="col-md-4 text-center"><button type="button" class="btn btn-success waves-effect" onclick="showmessageBox(<?php echo $ticket_id;?>);">Reply</button></div>
                                                                <!--<div class="col-md-4"><a href="mailto:admin@hotelgss.com?Subject=Share this ticket&body=http://www.hotelgss.com/ticket/ticket_info/<?php echo $ticket_id;?>" target="_top"><button type="button" class="btn btn-info waves-effect pull-left">Copy Link or Share Ticket</button></a></div>-->
                                                                <div class="col-md-4 text-center"><button type="button" class="btn btn-info waves-effect" onclick="copy_ticket_url(<?php echo $ticket_id;?>);">Copy Ticket Link</button></div>
                                                                <?php if($ticket_type_id != 3){?>
                                                                <!--<div class="col-md-2"><button type="button" class="btn btn-defualt waves-effect pull-right" data-toggle="modal" data-target="#myModalUpdate-<?php echo $ticket_id;?>">Update</button></div>-->
                                                                <?php }?>
                                                                <div class="col-md-4 text-center"><button type="button" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#pick_up_ticket-<?php echo $ticket_id;?>">Pick-Up</button></div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <ul class="pager m-0">
															<?php if($ind==0){?>
                                                                <li class="previous disabled"><a href="javascript:;">&larr; Previous</a></li>
                                                            <?php }else{?>
                                                                <li class="previous"><a href="javascript:;" data-dismiss="modal" onclick="popToLoadID('.bs-pending-ticket-<?php echo $pendingTickets[$ind-1]->ticketID;?>');">&larr; Previous</a></li>
                                                            <?php }if($ind==(count($pendingTickets)-1)){?>
                                                                <li class="next disabled"><a href="javascript:;">Next &rarr;</a></li>
                                                            <?php }else{?>
                                                                <li class="next"><a href="javascript:;" data-dismiss="modal" onclick="popToLoadID('.bs-pending-ticket-<?php echo $pendingTickets[$ind+1]->ticketID;?>');">Next &rarr;</a></li>
                                                            <?php }?>
                                                        </ul>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                        		<td class="hidden"><?php echo $ticket_id;?></td>
                                                <td><?php if($val->service_rec == 'yes'){?><blink><span class="indicator label-danger"></span></blink><?php }echo date("m-d-y", strtotime($val->created_date));?></td>
                                                <td><?php echo date("h:i a", strtotime($val->created_date));?></td>
                                                <td><?php echo $ticket_type.$ticket_id;?></td>
                                                <td><?php echo $val->room_no;?></td>
                                                <td><?php echo $generated_by;?></td>
                                                <td><?php echo $dept_name;?></td>
                                                <td id="get_started_<?php echo $ticket_id;?>" class="get_started_<?php echo $ticket_id;?>"><?php echo "<script> showElapsdTimeElapsed('".$val->created_date."', '".$ticket_id."');</script>";?></td>
                                                <td><button type="button" onclick="loadpopupModal(<?php echo $ticket_id;?>)" data-toggle="modal" data-target=".bs-pending-ticket-<?php echo $ticket_id;?>" class="btn btn-warning waves-effect waves-light model_img img-responsive">View</button>
                                                <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#pick_up_ticket-<?php echo $ticket_id;?>">Pick-up</button></td>
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
.underline{
	text-decoration: underline;
}
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