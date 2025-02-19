
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Update Room Breakout</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Room Breakout Update Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> Update Room Breakout</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                    <!--Errors-->
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
						    $assignedRooms	= array();
							$both_strings	= '';
							if(is_array($house_keeping_info)){foreach($house_keeping_info as $hk_info_val){
								$both_strings .= $hk_info_val->assign_rooms.',';
							}}
							$both_strings	= trim($both_strings,',');
							$assignedRooms	= explode(',', $both_strings);
						 ?>
                         <!--Forms-->
                         
                        <form action="<?php echo base_url();?>mpor/edit_mpor_info" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Select Housekeeping:</label>
                                            <select class="form-control" name="assign_to_id" required>
                                                <option value="">-Select Housekeeping-</option>
												<?php if(is_array($house_keeping_all)){
                                                    foreach($house_keeping_all as $hk_val){?>
                                                    <option value="<?php echo $hk_val->id;?>" <?php if($mpor_data[0]->assign_to_id == $hk_val->id){echo 'selected="selected"';}?>><?php if($hk_val->manager_inspector != ''){echo $hk_val->username.' ('.ucfirst($hk_val->manager_inspector).')';}else{echo $hk_val->username;}?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Assign Room:</label>
                                            <select class="form-control" name="assign_rooms">
												<?php if(is_array($rooms_info)){foreach($rooms_info as $val){
													if(in_array($val->room_no, $assignedRooms)){if($mpor_data[0]->assign_rooms==$val->room_no){?>
                                                    <option selected="selected" value="<?php echo $val->room_no;?>"> Room #<?php echo $val->room_no. '-'.$val->room_type;?></option>
                                                    <?php }}else{?>
                                                        <option value="<?php echo $val->room_no;?>"> Room #<?php echo $val->room_no. '-'.$val->room_type;?></option>
                                                <?php }}}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Checkouts/Stayover:</label>
                                            <select class="form-control" name="chk_stay">
                                            	<option value="checkout" <?php if($mpor_data[0]->chk_stay == 'checkout'){echo 'selected="selected"';}?>>Checkout</option>
                                            	<option value="stayover" <?php if($mpor_data[0]->chk_stay == 'stayover'){echo 'selected="selected"';}?>>Stayover</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Special Requests:</label>
                                            <select class="form-control" name="sp_request" required>
                                                <option value="">-Select Special Requests-</option>
                                                <option value="Late Check-Out"		<?php if('Late Check-Out' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Late Check-Out</option>
                                                <option value="Late Housekeeping Service" <?php if('Late Housekeeping Service' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Late Housekeeping Service</option>
                                                <option value="Extra Towels"		<?php if('Extra Towels' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Towels</option>
                                                <option value="Extra Hand Towels"	<?php if('Extra Hand Towels' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Hand Towels</option>
                                                <option value="Extra Wash Clothes"	<?php if('Extra Wash Clothes' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Wash Clothes</option>
                                                <option value="Extra Blankets"		<?php if('Extra Blankets' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Blankets</option>
                                                <option value="Extra Pillows"		<?php if('Extra Pillows' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Pillows</option>
                                                <option value="Extra Shampoo"		<?php if('Extra Shampoo' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Shampoo</option>
                                                <option value="Extra Conditioner"	<?php if('Extra Conditioner' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Conditioner</option>
                                                <option value="Extra Soap"			<?php if('Extra Soap' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Soap</option>
                                                <option value="Extra Lotion"		<?php if('Extra Lotion' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Lotion</option>
                                                <option value="Extra Coffee"		<?php if('Extra Coffee' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Coffee</option>
                                                <option value="Extra Cups"			<?php if('Extra Cups' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Cups</option>
                                                <option value="Extra Ice Bucket Liners" <?php if('Extra Ice Bucket Liners' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Ice Bucket Liners</option>
                                                <option value="Extra Laundry Bags"	<?php if('Extra Laundry Bags' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Laundry Bags</option>
                                                <option value="Extra Hangers"		<?php if('Extra Hangers' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Extra Hangers</option>
                                                <option value="Rollaway"			<?php if('Rollaway' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Rollaway</option>
                                                <option value="Crib"				<?php if('Crib' == $mpor_data[0]->sp_request){echo 'selected="selected"';}?>>Crib</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">DND:</label>
                                            <select class="form-control" name="is_dnd">
                                            	<option value="1" <?php if($mpor_data[0]->is_dnd == 1){echo 'selected="selected"';}?>>Yes</option>
                                            	<option value="0" <?php if($mpor_data[0]->is_dnd == 0){echo 'selected="selected"';}?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Notes:</label>
                                            <textarea class="form-control" name="notes" rows="5" cols="60"><?php echo htmlspecialchars_decode($mpor_data[0]->notes);?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                            	<input type="hidden" name="mpor_id" value="<?php echo $this->uri->segment(3);?>" />
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Update</button>
                                <a href="<?php echo base_url();?>mpor/room_breakout"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>