<style>
    .sticky-info {
        position: sticky;
        top: 70px; /* Adjust this value based on the header height */
        background-color: white;
        padding: 10px;
        z-index: 1000;
        border-bottom: 2px solid #ddd;
    }

    .buttons-pdf{
        margin-left:10px !important;
    }

</style>
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Room Breakout</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Room Breakout Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Room Breakout</div>
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
                            	//if($this->session->userdata['logged_in']['role'] == '4' && ($this->session->userdata['logged_in']['mngrInsptr'] == 'manager' || $this->session->userdata['logged_in']['mngrInsptr'] == 'inspector')){
									$assignedRooms	= array();
									$both_strings	= '';
									if(is_array($house_keeping_info)){foreach($house_keeping_info as $hk_info_val){
										$both_strings .= $hk_info_val->assign_rooms.',';
									}}
									$both_strings	= trim($both_strings,',');
									$assignedRooms	= explode(',', $both_strings);
                            	?>
								<form id="mpor1" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-body">
                                        <h3 class="box-title">Room Statistics</h3>
                                        <div class="row">
                                        	<div class="col-md-3">
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Rooms</label>
                                                    <div class="col-sm-6"><input type="text" readonly="readonly" class="form-control" name="total_rooms" value="<?php echo count($rooms_info);?>"></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Occupied</label>
                                                    <div class="col-sm-6"><input class="form-control" type="text" name="total_occupied" value="<?php if(is_array($settings)){echo $settings[0]->total_occupied;}else{echo '';}?>"></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Vacant</label>
                                                    <div class="col-sm-6"><input class="form-control" type="text" name="total_vacant" value="<?php if(is_array($settings)){echo $settings[0]->total_vacant;}else{echo '';}?>"></div>
                                                </div>
                                            </div>
                                        	<div class="col-md-3">
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Checkouts</label>
                                                    <div class="col-sm-6"><input class="form-control" id="total_checkouts" type="text" name="total_checkouts" value="<?php if(is_array($settings)){echo $settings[0]->total_checkouts;}else{echo '';}?>"></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Stayover</label>
                                                    <div class="col-sm-6"><input class="form-control" id="total_stayovers" type="text" name="total_stayovers" value="<?php if(is_array($settings)){echo $settings[0]->total_stayovers;}else{echo '';}?>"></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Out Of Order</label>
                                                    <div class="col-sm-6"><input class="form-control" type="text" name="out_of_order" value="<?php if(is_array($settings)){echo $settings[0]->out_of_order;}else{echo '';}?>"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"><!--<h3 class="box-title">Room Statistics</h3>-->
                                            	<div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Running Balance Checkouts</label>
                                                    <div class="col-sm-6"><input class="form-control <?php if(is_array($settings)){if($checkout_count >= $settings[0]->total_checkouts){echo 'bg-success';}else{echo 'bg-danger';}}?>" type="text" readonly="readonly" name="rb_checkouts" value="<?php echo $checkout_count;?>"></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Running Balance Stayover</label>
                                                    <div class="col-sm-6"><input class="form-control <?php if(is_array($settings)){if($stayover_count >= $settings[0]->total_stayovers){echo 'bg-success';}else{echo 'bg-danger';}}?>" type="text" readonly="readonly" name="rb_stayovers" value="<?php echo $stayover_count;?>"></div>
                                            </div>
                                            </div>
                                        	<div class="col-md-3">
                                                <h5 class="m-t-5">Default Stayover or Checkout?</h5>
                                                <div class="radio radio-success m-t-0 m-b-5">
                                                    <input type="hidden" name="action_page" value="room_breakout" />
                                                    <input class="chk_sty" name="default_chk_sty" value="stayover" 
													<?php if(is_array($settings)){if($settings[0]->default_chk_sty == 'stayover'){echo 'checked="checked"';}}else{echo 'checked="checked"';}?> type="radio">
                                                    <label>Stayover</label>
                                                </div>
                                                <div class="radio radio-success m-t-0 m-b-5">
                                                    <input class="chk_sty" name="default_chk_sty" value="checkout" <?php if(is_array($settings)){if($settings[0]->default_chk_sty == 'checkout'){echo 'checked="checked"';}}else{echo '';}?> type="radio">
                                                    <label>Checkout</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" onclick="saveData()" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                	</div>
                                </form><hr />
                                <form action="<?php echo base_url();?>index.php/mpor/add_mpor_data" id="mpor" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-body">
                                        <h3 class="box-title">Assign Rooms To Housekeeping</h3>
                                        <div class="row">
                                            <div class="col-md-3 p-l-5 p-r-0">
                                                <h5 class="m-t-5">Select Housekeeping</h5>
                                                <select class="form-control rooms_drop" name="assign_to" id="assign_to" required>
                                                    <option value="">-Select Housekeeping-</option>
                                                    <?php if(is_array($house_keeping)){
                                                        foreach($house_keeping as $hk_val){?>
                                                        <option value="<?php echo $hk_val->id;?>"><?php if($hk_val->manager_inspector != ''){echo $hk_val->username.' ('.ucfirst($hk_val->manager_inspector).')';}else{echo $hk_val->username;}?></option>
                                                        
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 p-l-5 p-r-0">
                                                <h5 class="m-t-5">Select Multiple Rooms</h5>
                                                <select class="selectpicker" multiple data-style="form-control" name="room_no[]" id="room_no" required>
                                                    <?php if(is_array($rooms_info)){
                                                        foreach($rooms_info as $val){if (in_array($val->room_no, $assignedRooms)){}else{?>
                                                        <option value="<?php echo $val->room_no;?>"> Room #<?php echo $val->room_no. '-'.$val->room_type;?></option>
                                                    <?php }}}?>
                                                </select>
                                            </div>
                                            <div class="col-md-1 p-l-5 p-r-0">
                                                <h5 class="m-t-5"><span id="show_count"></span></h5>
                                            </div>
                                            <div class="col-md-3 p-5">
                                                <h5 class="m-t-5">Initials</h5>
                                                <input type="text" id="initals" name="initals" class="form-control" placeholder="Initals" value="<?php echo $this->session->userdata['logged_in']['username'];?>" readonly="readonly">
                                            </div>
                                            <div class="col-md-2">
                                                <h5 class="m-t-5">&nbsp;</h5>
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                 </form>
                                <hr />
                                <div class="row">
                                	<div class="col-md-4"><h3 class="box-title">Todays Assigned Housekeeping</h3></div>
                                	<div class="col-md-4"></div>
                                	<div class="col-md-4">
                                    	<button type="button" class="btn btn-warning waves-effect waves-light delete_selected">Delete Selected</button>
                                    	<button type="button" class="btn btn-danger waves-effect waves-light delete" style="display:none;">Delete</button>
                                    	<button type="button" class="btn btn-info waves-effect waves-light canceldel"  style="display:none;">Cancel</button>
                                    </div>
                                </div>
                                
                                <br>
                                <div class="sticky-info">
                                    <label class="control-label" id="total_running_checkouts">Total Checkouts: </label><br>
                                    <label class="control-label" id="total_running_stayovers">Total Stayovers: </label><br>
                                    <label class="control-label" id="running_occupied_rooms">Total Occupied Rooms: </label>
                                </div> 
                                <br>
                                
                                <div class="table-responsive">
                                	<table id="myTable_room_breakout" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th id="hdn_tr" style="display:none;">&nbsp;</th>
                                                <th>Employee</th>
                                                <th>Room No.</th>
                                                <th>Checkout/Stayover</th>
                                                <th>Requests</th>
                                                <th>DND</th>
                                                <th>Notes</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                    
                                            <?php if(is_array($house_keeping_info)){
                                            foreach($house_keeping_info as $hk_info_val){?>
                                            	<div class="modal fade bs-mpor-notes-<?php echo $hk_info_val->mpor_id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myLargeModalLabel">Add Notes</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" id="add_notes_<?php echo $hk_info_val->mpor_id;?>" name="notes" rows="5" cols="60"><?php echo htmlspecialchars_decode($hk_info_val->notes);?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-success waves-effect" onclick="savempor(<?php echo $hk_info_val->mpor_id;?>);">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade bs-mpor-edit-<?php echo $hk_info_val->mpor_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:99999999999999999; top:100px;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myModalLabel">Edit Assign Room Information</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" action="" id="mpor_form_edit_<?php echo $hk_info_val->mpor_id;?>" method="post" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <label class="col-sm-5 p-l-0">Select Housekeeping:</label>
                                                                    <div class="col-sm-5 p-l-0 m-b-10">
                                                                        <select class="form-control" id="assign_to_edit_<?php echo $hk_info_val->mpor_id;?>" name="assign_to_edit_<?php echo $hk_info_val->mpor_id;?>" required>
                                                                            <option value="">-Select Housekeeping-</option>
                                                                            <?php if(is_array($house_keeping_all)){
                                                                                foreach($house_keeping_all as $hk_val){?>
                                                                                <option value="<?php echo $hk_val->id;?>" <?php if($hk_info_val->assign_to_id == $hk_val->id){echo 'selected="selected"';}?>><?php if($hk_val->manager_inspector != ''){echo $hk_val->username.' ('.ucfirst($hk_val->manager_inspector).')';}else{echo $hk_val->username;}?></option>
                                                                                
                                                                            <?php }}?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-5 p-l-0">Assign Room:</label>
                                                                    <div class="col-sm-5 p-l-0 m-b-10">
                                                                        <select class="form-control" id="room_no_edit_<?php echo $hk_info_val->mpor_id;?>" name="room_no_edit_<?php echo $hk_info_val->mpor_id;?>" required>
																	<?php if(is_array($rooms_info)){
                                                                          foreach($rooms_info as $val){if(in_array($val->room_no, $assignedRooms)){if($hk_info_val->assign_rooms==$val->room_no){?>
                                                                          		<option selected="selected" value="<?php echo $val->room_no;?>"> Room #<?php echo $val->room_no. '-'.$val->room_type;?></option>
																				<?php }}else{?>
                                                                                	<option value="<?php echo $val->room_no;?>"> Room #<?php echo $val->room_no. '-'.$val->room_type;?></option>
                                                                            <?php }}}?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-5 p-l-0">Checkouts/Stayover:</label>
                                                                    <div class="col-sm-5 p-l-0 m-b-10">
                                                                		<div class="radio radio-success m-t-0 m-b-5">
                                                                            <input class="chk_sty_edit" name="chk_sty_edit_<?php echo $hk_info_val->mpor_id;?>" <?php if('checkout' == $hk_info_val->chk_stay){echo 'checked';}?> value="checkout" type="radio">
                                                                            <label>Checkout</label>
                                                                        </div>
                                                                        <div class="radio radio-success m-b-0">
                                                                            <input class="chk_sty_edit" name="chk_sty_edit_<?php echo $hk_info_val->mpor_id;?>" <?php if('stayover' == $hk_info_val->chk_stay){echo 'checked';}?> value="stayover" type="radio">
                                                                            <label>Stayover</label>
                                                                        </div>
																	</div>
																</div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-5 p-l-0">Special Requests:</label>
                                                                    <div class="col-sm-5 p-l-0 m-b-10">
                                                                		<select class="form-control" id="req_edit_<?php echo $hk_info_val->mpor_id;?>" name="req_edit_<?php echo $hk_info_val->mpor_id;?>" required>
    <option value="">-Select Special Requests-</option>
    <option value="Late Check-Out"		<?php if('Late Check-Out' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Late Check-Out</option>
    <option value="Late Housekeeping Service" <?php if('Late Housekeeping Service' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Late Housekeeping Service</option>
    <option value="Extra Towels"		<?php if('Extra Towels' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Towels</option>
    <option value="Extra Hand Towels"	<?php if('Extra Hand Towels' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Hand Towels</option>
    <option value="Extra Wash Clothes"	<?php if('Extra Wash Clothes' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Wash Clothes</option>
    <option value="Extra Blankets"		<?php if('Extra Blankets' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Blankets</option>
    <option value="Extra Pillows"		<?php if('Extra Pillows' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Pillows</option>
    <option value="Extra Shampoo"		<?php if('Extra Shampoo' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Shampoo</option>
    <option value="Extra Conditioner"	<?php if('Extra Conditioner' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Conditioner</option>
    <option value="Extra Soap"			<?php if('Extra Soap' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Soap</option>
    <option value="Extra Lotion"		<?php if('Extra Lotion' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Lotion</option>
    <option value="Extra Coffee"		<?php if('Extra Coffee' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Coffee</option>
    <option value="Extra Cups"			<?php if('Extra Cups' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Cups</option>
    <option value="Extra Ice Bucket Liners" <?php if('Extra Ice Bucket Liners' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Ice Bucket Liners</option>
    <option value="Extra Laundry Bags"	<?php if('Extra Laundry Bags' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Laundry Bags</option>
    <option value="Extra Hangers"		<?php if('Extra Hangers' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Hangers</option>
    <option value="Rollaway"			<?php if('Rollaway' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Rollaway</option>
    <option value="Crib"				<?php if('Crib' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Crib</option>
</select>
																	</div>
																</div>
                                                                <div class="form-group clearfix">
                                                                    <label class="col-sm-12 p-l-0">Notes:</label>
                                                                    <div class="col-sm-12 p-l-0 m-b-10">
                                                                 		<textarea class="form-control" id="mpor_notes_edit_<?php echo $hk_info_val->mpor_id;?>" name="mpor_notes_edit_<?php echo $hk_info_val->mpor_id;?>" rows="5" cols="60"><?php echo htmlspecialchars_decode($hk_info_val->notes);?></textarea>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="form-group clearfix">
                                                                    <label class="col-sm-12 p-l-0">Attachment:</label>
                                                                    <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                                        <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                                        <input type="file" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                                    </div>
                                                                </div>-->
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success waves-effect" onclick="mpor_edit(<?php echo $hk_info_val->mpor_id;?>);">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <tr>
                                                    <td class="hdn_td" style="display:none;"><div class="checkbox checkbox-circle checkbox-success"><input id="del_<?php echo $hk_info_val->mpor_id;?>" type="checkbox" value="<?php echo $hk_info_val->mpor_id;?>"><label for="checkbox7"></label></div></td>
                                                    <td>
                                                        <?php if($hk_info_val->status == 'Pending' || ($hk_info_val->status == 'Completed' && $hk_info_val->approved == '')) { ?>
                                                            <select onchange="handleEmployeeChange(this)" id="<?php echo $hk_info_val->mpor_id;?>" class="form-control" name="assign_to_id" required>
                                                                <?php if(is_array($house_keeping)){
                                                                    foreach($house_keeping as $hk_val){?>
                                                                    <option value="<?php echo $hk_val->id;?>" <?php if($hk_info_val->assign_to_id == $hk_val->id){echo 'selected="selected"';}?>><?php if($hk_val->manager_inspector != ''){echo $hk_val->username.' ('.ucfirst($hk_val->manager_inspector).')';}else{echo $hk_val->username;}?></option>
                                                                <?php }}?>
                                                            </select>
                                                        <?php } else {
                                                            $username = admin_helper::get_user_name($hk_info_val->assign_to_id); 
                                                            echo ucfirst($username[0]->username);                                                            
                                                        }?>
                                                    </td>
                                                    <td><?php $room_types = admin_helper::get_room_type($hk_info_val->hotel_id, $hk_info_val->assign_rooms);echo $hk_info_val->assign_rooms .' ('.$room_types[0]->room_type.')'; ?></td>
                                                    <td><div class="radio radio-success m-t-0 m-b-5">
                                                            <input class="chk_sty" name="chk_sty_<?php echo $hk_info_val->mpor_id;?>" id="chk_sty_<?php echo $hk_info_val->mpor_id;?>" <?php if('checkout' == $hk_info_val->chk_stay){echo 'checked';}?> value="checkout" type="radio">
                                                            <label>Checkout</label>
                                                        </div>
                                                        <div class="radio radio-success m-b-0">
                                                            <input class="chk_sty" name="chk_sty_<?php echo $hk_info_val->mpor_id;?>" id="chk_sty_<?php echo $hk_info_val->mpor_id;?>" <?php if('stayover' == $hk_info_val->chk_stay){echo 'checked';}?> value="stayover" type="radio">
                                                            <label>Stayover</label>
                                                        </div>
                                                    </td>
                                                    <td>
<select class="form-control sp_request_drpdwn" name="req_<?php echo $hk_info_val->mpor_id;?>" id="req_<?php echo $hk_info_val->mpor_id;?>" required>
    <option value="">-Select Special Requests-</option>
    <option value="Late Check-Out"		<?php if('Late Check-Out' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Late Check-Out</option>
    <option value="Late Housekeeping Service" <?php if('Late Housekeeping Service' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Late Housekeeping Service</option>
    <option value="Extra Towels"		<?php if('Extra Towels' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Towels</option>
    <option value="Extra Hand Towels"	<?php if('Extra Hand Towels' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Hand Towels</option>
    <option value="Extra Wash Clothes"	<?php if('Extra Wash Clothes' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Wash Clothes</option>
    <option value="Extra Blankets"		<?php if('Extra Blankets' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Blankets</option>
    <option value="Extra Pillows"		<?php if('Extra Pillows' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Pillows</option>
    <option value="Extra Shampoo"		<?php if('Extra Shampoo' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Shampoo</option>
    <option value="Extra Conditioner"	<?php if('Extra Conditioner' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Conditioner</option>
    <option value="Extra Soap"			<?php if('Extra Soap' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Soap</option>
    <option value="Extra Lotion"		<?php if('Extra Lotion' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Lotion</option>
    <option value="Extra Coffee"		<?php if('Extra Coffee' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Coffee</option>
    <option value="Extra Cups"			<?php if('Extra Cups' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Cups</option>
    <option value="Extra Ice Bucket Liners" <?php if('Extra Ice Bucket Liners' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Ice Bucket Liners</option>
    <option value="Extra Laundry Bags"	<?php if('Extra Laundry Bags' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Laundry Bags</option>
    <option value="Extra Hangers"		<?php if('Extra Hangers' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Extra Hangers</option>
    <option value="Rollaway"			<?php if('Rollaway' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Rollaway</option>
    <option value="Crib"				<?php if('Crib' == $hk_info_val->sp_request){echo 'selected="selected"';}?>>Crib</option>
</select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control dnd_drpdwn" id="dnd_<?php echo $hk_info_val->mpor_id;?>" required>
                                                            <option value="0" <?php if('0' == $hk_info_val->is_dnd){echo 'selected="selected"';}?>>No</option>
                                                            <option value="1" <?php if('1' == $hk_info_val->is_dnd){echo 'selected="selected"';}?>>Yes</option>
                                                        </select>
                                                    </td>
                                                    <td><button type="button" data-toggle="modal" data-target=".bs-mpor-notes-<?php echo $hk_info_val->mpor_id;?>" class="btn btn-warning waves-effect waves-light model_img img-responsive">Add Notes<?php if($hk_info_val->notes){echo '**';}?></button></td>
                                                    <td><?php if($hk_info_val->status == 'Completed'){if($hk_info_val->approved == ''){echo 'Waiting for approval';}else{echo $hk_info_val->approved;}
														}else{echo $hk_info_val->status;}?></td>
                                                    <td><!--<button type="button" data-toggle="modal" data-target=".bs-mpor-edit-<?php echo $hk_info_val->mpor_id;?>" class="btn btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></button>-->
                                                        <a href="<?php echo base_url();?>mpor/edit_mpor/<?php echo $hk_info_val->mpor_id;?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></button></a>
                                                        <a href="<?php echo base_url();?>mpor/delete_mpor/<?php echo $hk_info_val->mpor_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
                                                </tr>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                            	</div>
                            <?php #} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>

    $(document).ready(function () {
        let totalCheckouts = $("input[name^='chk_sty_']:not([name^='chk_sty_edit_']):checked").filter(function () {
            return $(this).val() === "checkout";
        }).length;

        let totalStayovers = $("input[name^='chk_sty_']:not([name^='chk_sty_edit_']):checked").filter(function () {
            return $(this).val() === "stayover";
        }).length;

        let total_occupied_rooms = totalCheckouts + totalStayovers;
        $("#total_running_checkouts").text("Total Checkouts: " + totalCheckouts);
        $("#total_running_stayovers").text("Total Stayovers: " + totalStayovers);
        $("#running_occupied_rooms").text("Total Occupied Rooms: " + total_occupied_rooms);
    });

    $(document).on("change", "table .chk_sty[type='radio']", function () {
        let totalCheckouts = $("input[name^='chk_sty_']:not([name^='chk_sty_edit_']):checked").filter(function () {
            return $(this).val() === "checkout";
        }).length;

        let totalStayovers = $("input[name^='chk_sty_']:not([name^='chk_sty_edit_']):checked").filter(function () {
            return $(this).val() === "stayover";
        }).length;

        let selectedValue = $(this).val();

        if (selectedValue === "checkout") {
            toastr.warning("Total Checkouts are " + totalCheckouts);
        } else if (selectedValue === "stayover") {
            toastr.warning("Total Stayovers are " + totalStayovers);
        }
        // Update input fields
        $("#total_checkouts").val(totalCheckouts);
        $("#total_stayovers").val(totalStayovers);
        
        let total_occupied_rooms = totalCheckouts + totalStayovers;
        $("#total_running_checkouts").text("Total Checkouts: " + totalCheckouts);
        $("#total_running_stayovers").text("Total Stayovers: " + totalStayovers);
        $("#running_occupied_rooms").text("Total Occupied Rooms: " + total_occupied_rooms);
    });
   

    function saveData() {
        event.preventDefault();
        // Get form values
        var total_rooms = parseInt($("input[name='total_rooms']").val()) || 0;
        var total_occupied = parseInt($("input[name='total_occupied']").val()) || 0;
        var total_vacant = parseInt($("input[name='total_vacant']").val()) || 0;
        var total_checkouts = parseInt($("input[name='total_checkouts']").val()) || 0;
        var total_stayovers = parseInt($("input[name='total_stayovers']").val()) || 0;
        var out_of_order = $("input[name='out_of_order']").val();
        var default_chk_sty = $("input[name='default_chk_sty']:checked").val();

        // Validate total rooms condition
        if ((total_vacant + total_occupied) > total_rooms) {
            toastr.error("Occupied/Vacant rooms must be less than or equal to total rooms.");
            return;
        }

        // Validate checkouts and stayovers condition
        if ((total_checkouts + total_stayovers) > total_occupied) {
            toastr.error("Checkouts/Stayovers must less than occupied rooms.");
            return;
        }
        var formData = $("#mpor1").serialize(); // Serialize form data

        $.ajax({
            url: "<?php echo site_url('mpor/mpor_settings'); ?>",
            type: "POST",
            data: formData,
            beforeSend: function() {
                $('#loader_main').show(); // Show loader if you have one
            },
            success: function(response) {
                $('#loader_main').hide(); // Hide loader after success
                toastr.success("Room Breakout Settings has been added successfully.");
            },
            error: function(xhr, status, error) {
                $('#loader_main').hide();
                toastr.error("There is an error, Please try again.");
            }
        });
    }

    
</script> 