<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add Guest Welcome call</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Add Guest Welcome Call Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <!--Model 1-->
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:1009; top: 40px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Guest Welcome Call</h4>
				</div>
                <div class="modal-body">
                    <form action="" method="post" id="guest_call_form" enctype="multipart/form-data">
                    	<input type="hidden" id="t_rating" name="" value=""  />
                        <div class="row">
                        	<div class="col-lg-6"><label class="control-label">Arrival Date:</label> <?php 
							echo gmdate('m/d/Y', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
							//echo date("m/d/Y", strtotime($this->session->userdata['logged_in']['tz'].' hours', strtotime(gmdate("Y-m-d H:i:s A")))); ?></div>
                            <div class="col-lg-6"><label class="control-label">Created by:</label> <?php echo $this->session->userdata['logged_in']['username'];?></div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6"><label class="control-label">Check In Time:</label> <span id="t_time_in"></span></div>
                        	<div class="col-lg-6"><label class="control-label">Call Back Time:</label> <span id="t_call_back"></span></div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-lg-6"><label class="control-label">Room #:</label> <span id="room_num"></span></div>
                            <div class="col-lg-6"><label class="control-label">Room Type:</label> <span id="room_type"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><label class="control-label">Guest Name:</label> <span id="guest_name"></span></div>
                            <div class="col-lg-6"id="email_hdn"><input type="email" class="form-control" id="guest_email" name="guest_email" placeholder="Guest Email" value=""></div>
                            <div class="col-lg-3" id="rating_hdn">
                            	<select class="form-control" name="guest_rating" id="guest_rating">
                                    <option value="">-Rating-</option>
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="sec_2">
                        	<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                <h3 class="box-title m-b-0">Ticket Type</h3>
                                <div class="radio radio-success">
                                    <input type="radio" name="ticket_type" class="ticket_type" id="ticket_type_not_reg" value="not_req" checked="">
                                    <label for="ticket_type"> Ticket Not Required </label>
                                </div>
                                <div class="radio radio-success">
                                    <input type="radio" name="ticket_type" class="ticket_type" id="ticket_type_reg" value="no">
                                    <label for="ticket_type"> Regular </label>
                                </div>
                                <div class="radio radio-success">
                                    <input type="radio" name="ticket_type" class="ticket_type" id="ticket_type_ser" value="yes">
                                    <label for="ticket_type"> Service Recovery </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" id="dual">
                                <h3 class="box-title m-b-0">Create Dual Ticket?</h3>
                                <div class="radio radio-success">
                                    <input type="radio" name="dual_ticket" class="dual_ticket" id="dual_ticket_no" value="no" checked="">
                                    <label for="dual_ticket"> No </label>
                                </div>
                                <div class="radio radio-success">
                                    <input type="radio" name="dual_ticket" class="dual_ticket" id="dual_ticket_yes" value="yes">
                                    <label for="dual_ticket"> Yes </label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sec_3">
                            <div class="col-lg-6" id="ticket_1">
                            	<div class="row m-b-10">
                                    <div class="col-lg-12">
                                        <select class="form-control" name="dept_1" id="dept_1">
                                            <option value="">-Select Department-</option>
                                            <?php foreach($roles as $val){?>
                                                <option value="<?php echo $val->id; ?>"><?php echo $val->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-lg-12">
                                        <textarea class="form-control" rows="5" cols="5" name="pm_notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="ticket_2" style="display:none;">
                            	<div class="row m-b-10">
                                    <div class="col-lg-12">
                                        <select class="form-control" name="dept_2" id="dept_2">
                                            <option value="">-Select Department-</option>
                                            <?php foreach($roles as $val){?>
                                                <option value="<?php echo $val->id; ?>"><?php echo $val->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-lg-12">
                                        <textarea class="form-control" rows="5" cols="5" name="pm_notes_2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="error_div" id="popup_error"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light popup-btn" onclick="guestCallTicket();">GENERATE TICKET</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Add Guest Welcome call</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body p-t-10">
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
                         <!--Add arrivals form-->
                        <form action="<?php echo base_url();?>welcome_call/<?php if(is_array($arrivals)){echo 'update_arrivals_today';}else{echo 'add_arrivals_today';}?>" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <h3 class="box-title"></h3>
                                <div class="row">
                                    <div class="col-md-3 p-l-20">
										<?php if(is_array($arrivals)){foreach($arrivals as $arrivals_val){if($arrivals_val->arrivals > 0){?>
                                                <input type="text" id="arrivalsTodays" name="arrivalsTodays" class="form-control" placeholder="Number of arrivals " value="<?php echo $arrivals_val->arrivals;?>"> 
                                        <?php }}}else{?>
                                                <input type="text" id="arrivalsTodays" name="arrivalsTodays" class="form-control" placeholder="Number of arrivals today" value="0">
                                        <?php }?>
                                    </div>
                                    <div class="col-md-2">
                                    	<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                         
                        <?php if(is_array($arrivals)){foreach($arrivals as $arrivals_val){if($arrivals_val->arrivals > 0){
							$curr_date	 = gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
							//$curr_date	 = date("Y-m-d", strtotime($this->session->userdata['logged_in']['tz'].' hours', strtotime(gmdate("Y-m-d H:i:s A"))));							
							$today_calls = admin_helper::get_count_todays_welcome_calls($this->session->userdata['logged_in']['firm_id'], $curr_date);

							if($today_calls[0]->total_todays > 0){
								$rem_guests = ($arrivals_val->arrivals) - ($today_calls[0]->total_todays);
								$today_calls2= admin_helper::get_todays_welcome_calls($this->session->userdata['logged_in']['firm_id'], $curr_date);
								foreach($today_calls2 as $today_calls_val){?>
                        		<form action="" id="guest_call_update_<?php echo $today_calls_val->g_id;?>" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="box-title"></h3><hr>
                                        <div class="row">
                                            <div class="col-md-2 p-l-5 p-r-0">
                                                <select class="form-control rooms_drop" name="room_no" id="u_room_no_<?php echo $today_calls_val->g_id;?>" required>
                                                    <option value="">-Select Room#-</option>
                                                    <?php if(is_array($rooms_info)){
                                                        foreach($rooms_info as $val){?>
                                                        	<option value="<?php echo $val->room_no;?>" <?php if($val->room_no == $today_calls_val->room_no){echo 'selected';}?>><?php echo $val->room_no;?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 p-5">
                                                <input type="text" id="u_guest_name_<?php echo $today_calls_val->g_id;?>" name="guest_name" class="form-control" placeholder="Name" value="<?php echo $today_calls_val->guest_name;?>" required>
                                            </div>
                                            <div class="col-md-1 p-0 mytooltip tooltip-effect-5">
                                                <input type="text" id="u_time_in_<?php echo $today_calls_val->g_id;?>" name="time_in" class="form-control" placeholder="Check-In Time" value="<?php echo $today_calls_val->time_in;?>" required><span class="tooltip-content clearfix"><span class="tooltip-text">Format should like: 12:12 AM/pm</span></span>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <input type="text" id="u_call_back_<?php echo $today_calls_val->g_id;?>" name="call_back" class="form-control" placeholder="Call Back Time" value="<?php echo $today_calls_val->call_back;?>" required>
                                            </div>
                                            <div class="col-md-2 p-5">
                                                    <input type="text" id="u_initals_<?php echo $today_calls_val->g_id;?>" name="initals" class="form-control" placeholder="Initals" value="<?php echo $today_calls_val->initals;?>" readonly="readonly">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="radio radio-success" style="float:left;">
                                                    <input class="u_rat_cls" name="u_rating_<?php echo $today_calls_val->g_id;?>" <?php if('email' == $today_calls_val->call_type){echo 'checked';}?> value="email" type="radio">
                                                    <label>Email</label>
                                                </div>
                                                <div class="radio radio-success sec_rad">
                                                    <input class="u_rat_cls" name="u_rating_<?php echo $today_calls_val->g_id;?>" <?php if('rating' == $today_calls_val->call_type){echo 'checked';}?> value="rating" type="radio">
                                                    <label>Rating</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" id="u_<?php echo $today_calls_val->g_id;?>" class="btn btn-success guest_call_update"> <i class="fa fa-check"></i> Update</button>
                                            </div>
                                        </div>
                                        <div class="error_div" id="u_error_<?php echo $today_calls_val->g_id;?>"></div>
                                    </div>
                                </form>
                        	<?php }}else{$rem_guests = $arrivals_val->arrivals;}
							for($i=1; $i <=$rem_guests; $i++){?>
                        	<form action="" id="guest_call_<?php echo $i;?>" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <h3 class="box-title"></h3><hr>
                                    <div class="row">
                                        <div class="col-md-2 p-l-5 p-r-0">
                                            <select class="form-control rooms_drop" name="room_no" id="room_no_<?php echo $i;?>" required>
                                                <option value="">-Select Room#-</option>
                                                <?php if(is_array($rooms_info)){
                                                    foreach($rooms_info as $val){?>
                                                    <option value="<?php echo $val->room_no;?>"><?php echo $val->room_no;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 p-5">
                                            <input type="text" id="guest_name_<?php echo $i;?>" name="guest_name" class="form-control" placeholder="Name" value="" required>
                                        </div>
                                        <div class="col-md-1 p-0 mytooltip tooltip-effect-5">
                                            <input type="text" id="time_in_<?php echo $i;?>" name="time_in" class="form-control" placeholder="Check-In Time" value="" required>
                                            
                                			<span class="tooltip-content clearfix"><span class="tooltip-text">Format should like: 12:12 AM/pm</span> </span>
                                        </div>
                                        <div class="col-md-1 p-0">
                                            <input type="text" id="call_back_<?php echo $i;?>" name="call_back" class="form-control" placeholder="Call Back Time" value="" required>
                                        </div>
                                        <!--<div class="col-md-2 p-5">
                                            <select class="form-control" name="rating" id="rating_<?php echo $i;?>" required>
                                                <option value="">-Rating-</option>
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>-->
                                        <div class="col-md-2 p-5">
                                        	<input type="text" id="initals_<?php echo $i;?>" name="initals" class="form-control" placeholder="Initals" value="<?php echo $this->session->userdata['logged_in']['username'];?>" readonly="readonly">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="radio radio-success" style="float:left;">
                                                <input class="rat_cls" name="rating_<?php echo $i;?>" value="email" type="radio">
                                                <label>Email</label>
                                            </div>
                                            <div class="radio radio-success sec_rad">
                                                <input class="rat_cls" name="rating_<?php echo $i;?>" value="rating" type="radio">
                                                <label>Rating</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        	<!--<button type="button" id="<?php echo $i;?>" class="btn btn-success guest_call"> <i class="fa fa-check"></i> Save</button>-->
                                        </div>
                                    </div>
                                    <div class="error_div" id="error_<?php echo $i;?>"></div>
                                </div>
                        	</form>
                        <?php }
						}}}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.modal-backdrop{
	z-index:1002 !important;
}
.mytooltip {
    z-index: 1000;
}
.error_div{
	width:30%;
	color: red;
}
.sec_rad{float: left;width: 57%;position: relative;top: 15px;left: 9px;}
</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" ></script>