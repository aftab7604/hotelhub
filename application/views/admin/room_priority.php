<!--nestable CSS -->
<link href="<?php echo base_url();?>assets/plugins/bower_components/nestable/nestable.css" rel="stylesheet" type="text/css" />
     
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Room Priorities</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li><a href="<?php echo base_url().'mpor/manager_screen';?>">Inspector Central</a></li>
                <li class="active">Room Priorities Page</li>
                <li><a href="<?php echo base_url();?>mpor/pdf_room_priority"><button type="button" class="btn btn-success waves-effect">Download PDF</button></a></li>
            </ol>
        </div>
    </div>
    <?php
	$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
	$assignedRooms	= array();
	$both_strings	= '';
	if(is_array($house_keeping_info)){foreach($house_keeping_info as $hk_info_val){
		$both_strings .= $hk_info_val->assign_rooms.',';
	}}
	$both_strings	= trim($both_strings,',');
	$assignedRooms	= explode(',', $both_strings);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Room Priorities</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                    	<div class="panel-body p-t-10">
    						<form action="<?php echo base_url();?>mpor/mpor_settings" id="mpor1" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-body">
                                        <h3 class="box-title">Room Statistics</h3>
                                        <div class="row">
                                        	<div class="col-md-3">
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Rooms</label>
                                                    <div class="col-sm-2 control-label"><b><?php echo count($rooms_info);?></b></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Occupied</label>
                                                    <div class="col-sm-2 control-label"><b><?php if(is_array($settings)){echo $settings[0]->total_occupied;}else{echo '0';}?></b></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Vacant</label>
                                                    <div class="col-sm-2 control-label"><b><?php if(is_array($settings)){echo $settings[0]->total_vacant;}else{echo '0';}?></b></div>
                                                </div>
                                            </div>
                                        	<div class="col-md-3">
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Checkouts</label>
                                                    <div class="col-sm-2 control-label"><b><?php if(is_array($settings)){echo $settings[0]->total_checkouts;}else{echo '0';}?></b></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Total Stayover</label>
                                                    <div class="col-sm-2 control-label"><b><?php if(is_array($settings)){echo $settings[0]->total_stayovers;}else{echo '0';}?></b></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Out Of Order</label>
                                                    <div class="col-sm-2 control-label"><b><?php if(is_array($settings)){echo $settings[0]->out_of_order;}else{echo '0';}?></b></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="running_balance_results">
                                            	<div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Running Balance Checkouts</label>
                                                    <div class="col-sm-2 control-label"><b><?php echo $checkout_count;?></b></div>
                                                </div>
                                                <div class="form-group m-b-5">
                                                    <label class="col-sm-6 control-label">Running Balance Stayover</label>
                                                    <div class="col-sm-2 control-label"><b><?php echo $stayover_count;?></b></div>
                                            	</div>
                                            </div>
                                        	<div class="col-md-3">
                                                <h5 class="m-t-5">Default Stayover or Checkout?</h5>
                                                <div class="col-md-6 radio radio-success m-t-0 m-b-5">
                                                    <input type="hidden" name="action_page" value="room_priority" />
                                                    <input class="chk_sty" name="default_chk_sty" value="stayover" 
													<?php if(is_array($settings)){if($settings[0]->default_chk_sty == 'stayover'){echo 'checked="checked"';}}else{echo 'checked="checked"';}?> type="radio">
                                                    <label>Stayover</label>
                                                </div>
                                                <div class="col-md-6 radio radio-success m-t-0 m-b-5">
                                                    <input class="chk_sty" name="default_chk_sty" value="checkout" <?php if(is_array($settings)){if($settings[0]->default_chk_sty == 'checkout'){echo 'checked="checked"';}}?> type="radio">
                                                    <label>Checkout</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                	</div>
                                </form>
						</div>
                    </div>
            </div>
       </div>
   </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="white-box">
                    <h3 class="box-title">All Rooms</h3>
                    <div class="myadmin-dd dd" id="all_rooms">
                        <ol class="dd-list">
                        	<?php if(is_array($rooms_info)){
								foreach($rooms_info as $val){if (in_array($val->room_no, $assignedRooms)){}else{
									if(is_array($settings)){$default_chk_sty = $settings[0]->default_chk_sty;}else{$default_chk_sty = 'stayover';}?>
                                <li class="dd-item" data-id="<?php echo $val->room_no;?>">
                                    <div class="dd-handle">Room #<?php echo $val->room_no.'-'.$val->room_type.'-'.ucwords($default_chk_sty);?> - <span class="text-warning" id="room_<?php echo $val->room_no;?>">Not Assigned</span></div>
                                </li>
							<?php }}}?>
                        </ol>
                    </div>
                </div>
            </div>
            <!--
            SELECT * FROM mpor WHERE assign_rooms NOT IN ('116','117','118','119','120','121','122','123','124','125') AND is_active = '1' AND DATE(created_date) = '2018-06-28'
            -->
            <?php if(is_array($house_keeping_all)){
				foreach($house_keeping_all as $hk_val){
					$curr_date = gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
					$get_assign_rooms_data	= admin_helper::get_assign_rooms_data($hotel_id, $hk_val->id, $curr_date);
					$employee_rooms_list	= admin_helper::get_assigned_rooms_by_id($hotel_id, $hk_val->id, $curr_date);?>
                    
                	<div class="col-md-4 col-sm-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-5 col-sm-4 text-center">
                                    <a href="#"><img src="<?php echo base_url();?>assets/plugins/images/users/small_blank_user.jpg" alt="user" class="img-circle img-responsive"></a>
                                </div>
                                <div class="col-md-7 col-sm-4 pull-left" id="personal_info_<?php echo $hk_val->id;?>">
                                    <p><small>TOTAL ROOMS = </small><?php echo $get_assign_rooms_data[0]->total_rooms;?></p>
                                    <p><small>CHECKOUTS = </small><?php echo $get_assign_rooms_data[0]->total_checkouts;?></p>
                                    <p><small>STAYOVERS = </small><?php echo $get_assign_rooms_data[0]->total_stayovers;?></p>
                                </div>
                                <div class="col-md-12 col-sm-4">
                                    <h3 class="box-title m-b-0"><?php if($hk_val->manager_inspector != ''){echo $hk_val->username.' ('.ucfirst($hk_val->manager_inspector).')';}else{echo $hk_val->username;}?></h3> <small>Housekeeper</small>
                                    <!--<p><address><abbr title="Phone">P:</abbr> (123) 456-7890</address></p>-->
                                    <?php
									if(is_array($employee_rooms_list)){
										if(count($employee_rooms_list) > 0){
											echo '<div class="myadmin-dd dd" id="employee_'.$hk_val->id.'"><ol class="dd-list">';
											foreach($employee_rooms_list as $rooms_list){
												$get_Room_type = admin_helper::get_room_type($hotel_id, $rooms_list->assign_rooms);
												?>
                                            	<li class="dd-item" data-id="<?php echo $rooms_list->assign_rooms;?>">
													<div class="dd-handle">Room #<?php echo $rooms_list->assign_rooms.'-'.$get_Room_type[0]->room_type.'-'.ucwords($rooms_list->chk_stay).' - <span class="text-warning">'.$rooms_list->status.'</span>';?>
                                                    	<div class="pull-right" title="There are some notes for this room"><?php if($rooms_list->notes){echo '<span class="text-danger">**</span>';}?></div>
                                                    </div>
                                                </li>
									<?php }
											echo '</ol></div>';
									}else{echo '<div class="myadmin-dd dd" id="employee_'.$hk_val->id.'"><li class="dd-empty"><div class="dd-handle">Drag rooms here</div></li></div>';}}?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }}?>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var last_touched = '';
		var updateOutput = function(e){
			var list	 = e.length ? e : $(e.target),
			output		 = list.data('output');
			if (window.JSON) {
				var abc = window.JSON.stringify(list.nestable('serialize'));
				output.val(window.JSON.stringify(list.nestable('serialize')));
//console.log(output.val(window.JSON.stringify(list.nestable('serialize'))));
				
				if(last_touched != 'room'){
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url();?>mpor/pull_assigned_rooms_drag/',
						data: {'whichnest' : last_touched, 'output' : abc},
						async: false,
						success: function(result) {
						  var userID = last_touched.replace("user_id_", "");
						  if(result){$('#personal_info_'+userID).html(result);}
						  	//Get page total statistics
							$.ajax({
								type: 'POST',
								url: '<?php echo base_url();?>mpor/pull_priorityPage_stat/',
								success: function(results){if(results){$('#running_balance_results').html(results);}},
							});
							$('#employee_'+userID+' span').each(function(i, obj) {
								if($(this).text() == 'Not Assigned'){
									$(this).text('Assigned');
								}
							});
					  	},
					});
				}
			} else {output.val('JSON browser support required for this demo.');}
		};
		
		// activate Nestable for all rooms
		$('#all_rooms').nestable({group: 1,	maxDepth: 1}).on('change', function(){last_touched = 'room';}).on('change', updateOutput);
		updateOutput($('#all_rooms').data('output', $('#nestable-output')));
		
		// activate Nestable for list 2
		<?php if(is_array($house_keeping_all)){
			foreach($house_keeping_all as $hk_val){?>
				$('#employee_<?php echo $hk_val->id;?>').nestable({group: 1, maxDepth: 1}).on('change', function(){last_touched = 'user_id_<?php echo $hk_val->id;?>';}).on('change', updateOutput);
				updateOutput($('#employee_<?php echo $hk_val->id;?>').data('output', $('#nestable<?php echo $hk_val->id;?>-output')));
		<?php }}?>
		
	});
</script>