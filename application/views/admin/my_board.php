<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">My Board</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">My Board Page</li>
            </ol>
        </div>
    </div>
    <!--dribbble-->
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row" id="page_name">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">My Board</div>
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
								if(isset($_POST['submit'])){
									if($_POST['employee'] == 0){$employee = '0';}else{$employee 	= $_POST['employee'];}
								}else{
									$employee	= '';
								}
								?>
                                <?php if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] == '2' || $this->session->userdata['logged_in']['role'] == '8')){?>
                                    <form action="" id="board" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-body">
                                            <h3 class="box-title">Filters</h3>
                                            <div class="row">
                                                <div class="col-md-2 p-l-5 p-r-0">
                                                    <select class="form-control" name="employee" id="employee">
                                                        <option value="0">-All Housekeepers-</option>
                                                        <?php if(is_array($housekeepers)){
                                                            foreach($housekeepers as $all_hk){?>
                                                            <option value="<?php echo $all_hk->id;?>" <?php if($employee == $all_hk->id){echo 'selected="selected"';}?>><?php if($all_hk->manager_inspector != ''){echo $all_hk->username.' ('.ucfirst($all_hk->manager_inspector).')';}else{echo $all_hk->username;}?></option>
                                                        <?php }}?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2"><button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button></div>
                                                <div class="col-md-5"></div>
                                            </div>
                                        </div>
                                     </form><hr />
                                <?php }?>
                            <!--<h3 class="box-title">Todays Assigned Housekeeping</h3>-->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Room No.</th>
                                            <th>Assign To</th>
                                            <th>Status</th>
                                            <th>VIP</th>
                                            <th>Request</th>
                                            <th>Notes</th>
                                            <th>DND</th>
                                            <th>Time</th>
                                            <th>Service Ticket</th>
                                            <th>Attachment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($mpor_assign)){
                                            foreach($mpor_assign as $key => $mpor_assigned){
												$START_HTML = '';
												$room_types = admin_helper::get_room_type($mpor_assigned->hotel_id, $mpor_assigned->assign_rooms);?>
                                                <div id="esig-modal-<?php echo $mpor_assigned->mpor_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:100999999999999999; top: 30px;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Authorize completion of room</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url();?>mpor/update_mpor_room_started_info/" method="post" id="esig_completed_<?php echo $mpor_assigned->mpor_id;?>" enctype="multipart/form-data">
                                                                    <input type="hidden" name="mpor_id" value="<?php echo $mpor_assigned->mpor_id;?>" />
                                                                    <input type="hidden" name="method_type" value="completed" />
                                                                    <input type="hidden" name="img_data" id="img_data_<?php echo $mpor_assigned->mpor_id;?>" value="" />
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                        	<div id="signArea_<?php echo $mpor_assigned->mpor_id;?>">
                                                                                <h2 class="tag-ingo">Put signature below*</h2>
                                                                                <div class="sig sigWrapper" style="height:auto;width: 54%;">
                                                                                    <div class="typed"></div>
                                                                                    <canvas class="sign-pad" id="sign-pad_<?php echo $mpor_assigned->mpor_id;?>" width="300" height="100"></canvas>
                                                                                </div>
                                                                                <div class="checkbox checkbox-success">
                                                                                    <input id="terms_<?php echo $mpor_assigned->mpor_id;?>" type="checkbox" name="terms" value="1">
                                                                                    <label><?php echo htmlspecialchars_decode($settings[0]->terms_conditions_hk);?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                	<input id="sigE_<?php echo $mpor_assigned->mpor_id;?>" type="hidden" name="Esignatures" value="" />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="btnSaveSign_<?php echo $mpor_assigned->mpor_id;?>" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Accept terms and condition - Complete room</button>
                                                                <button type="button" id="btnClearSign_<?php echo $mpor_assigned->mpor_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
													$(document).ready(function() {
														$('#signArea_'+<?php echo $mpor_assigned->mpor_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
													});
													$("#btnSaveSign_"+<?php echo $mpor_assigned->mpor_id;?>).click(function(e){
														$('#loader_main').show();
														html2canvas([document.getElementById('sign-pad_'+<?php echo $mpor_assigned->mpor_id;?>)], {
															onrendered: function (canvas) {
																var canvas_img_data = canvas.toDataURL('image/png');
																var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");//alert(canvas_img_data);
																if(img_data == 'iVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAABj0lEQVR4nO3XsQnDQBBFQfXfnYJTMTrQuQGDlUkPz8DPN3qw2wKI2J4+AOAuwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvI+Bqs8zzNzB7ddV2/gzXnXMdxrH3fzcwe2RhjzTnvBWuM8fjBZva/ux0sL6GZvWG3XkKAtxIsIEOwgAzBAjIEC8gQLCBDsIAMwQIyPk4Cq9nMNq3PAAAAAElFTkSuQmCC'){
																	alert('E-Signatures are required');
																	$('#loader_main').hide();
																	return false;
																}
																var terms = $('#terms_'+<?php echo $mpor_assigned->mpor_id;?>).prop('checked');
																if(terms == false){
																	alert('Please check Terms and Conditions');
																	$('#loader_main').hide();
																	return false;
																}
																else{
																	/*var data_string = "mpor_id=<?php echo $mpor_assigned->mpor_id;?>&Esignatures="+img_data+"&method_type=completed";
																	$.ajax({
																		url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
																		type: "POST",
																		data: data_string,
																		success: function(data){alert('updated');
																			//location.reload();
																		}
																	});*/
																	$('#img_data_'+<?php echo $mpor_assigned->mpor_id;?>).val(img_data);
																	$('#esig_completed_'+<?php echo $mpor_assigned->mpor_id;?>).submit();
																	$('#loader_main').hide();
																}
															}
														});
													});
													$("#btnClearSign_"+<?php echo $mpor_assigned->mpor_id;?>).click(function(e){
														$('#signArea_'+<?php echo $mpor_assigned->mpor_id;?>).signaturePad().clearCanvas();
													});
												</script>
                                                <div id="dnd-modal-<?php echo $mpor_assigned->mpor_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:100999999999999999; top: 30px;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">DND</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post" id="mpor_dnd_<?php echo $mpor_assigned->mpor_id;?>" enctype="multipart/form-data">
                                                                    <input type="hidden" name="mpor_id" value="<?php echo $mpor_assigned->mpor_id;?>" />
                                                                    <input type="hidden" name="method_type" value="dnd" />
                                                                    <div class="row">
                                                                        <div class="col-lg-6"><label class="control-label">Todays Date:</label> <?php echo gmdate('m/d/Y', strtotime($this->session->userdata['logged_in']['tz'].' hours'));?></div>
                                                                        <div class="col-lg-6"><label class="control-label">Created by:</label> <?php echo $this->session->userdata['logged_in']['username'];?></div>
                                                                    </div>
                                                                    <div class="row m-b-10">
                                                                        <div class="col-lg-6"><label class="control-label">Room #:</label> <span id="room_num"><?php echo $mpor_assigned->assign_rooms;?></span></div>
                                                                        <div class="col-lg-6"><label class="control-label">Room Type:</label> <span id="room_type"><?php echo $room_types[0]->room_type;?></span></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                                            <h3 class="box-title m-b-0">Attachment</h3>
                                                                            <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                                                <input class="upload" name="file" accept="image/*;capture=camera" type="file">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12"></div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-danger waves-effect waves-light popup-btn" onclick="mpor_dnd(<?php echo $mpor_assigned->mpor_id;?>);">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="gen-ticket-modal-<?php echo $mpor_assigned->mpor_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:100999999999999999; top: 30px;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">MPOR Generate Ticket</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post" id="mpor_gen_ticket_<?php echo $mpor_assigned->mpor_id;?>" enctype="multipart/form-data">
                                                                    <input type="hidden" id="mpor_id_<?php echo $mpor_assigned->mpor_id;?>" name="mpor_id" value="<?php echo $mpor_assigned->mpor_id;?>" />
                                                                    <input type="hidden" id="room_no_<?php echo $mpor_assigned->mpor_id;?>" name="room_no" value="<?php echo $mpor_assigned->assign_rooms;?>" />
                                                                    <input type="hidden" id="room_type_<?php echo $mpor_assigned->mpor_id;?>" name="room_type" value="<?php echo $room_types[0]->room_type;?>" />
                                                                    <div class="row">
                                                                        <div class="col-lg-6"><label class="control-label">Todays Date:</label> <?php echo gmdate('m/d/Y', strtotime($this->session->userdata['logged_in']['tz'].' hours'));?></div>
                                                                        <div class="col-lg-6"><label class="control-label">Created by:</label> <?php echo $this->session->userdata['logged_in']['username'];?></div>
                                                                    </div>
                                                                    <div class="row m-b-10">
                                                                        <div class="col-lg-6"><label class="control-label">Room #:</label> <span id="room_num"><?php echo $mpor_assigned->assign_rooms;?></span></div>
                                                                        <div class="col-lg-6"><label class="control-label">Room Type:</label> <span id="room_type"><?php echo $room_types[0]->room_type;?></span></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                                            <h3 class="box-title m-b-0">Ticket Type</h3>
                                                                            <div class="radio radio-success">
                                                                                <input type="radio" name="ticket_type" class="ticket_type" value="no" checked="checked">
                                                                                <label for="ticket_type"> Regular </label>
                                                                            </div>
                                                                            <div class="radio radio-success">
                                                                                <input type="radio" name="ticket_type" class="ticket_type" value="yes">
                                                                                <label for="ticket_type"> Service Recovery </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                                            <h3 class="box-title m-b-0">Department</h3>
                                                                            <select class="form-control" name="dept" id="dept_<?php echo $mpor_assigned->mpor_id;?>">
                                                                                <option value="">-Select Department-</option>
                                                                                <?php foreach($roles as $val){?>
                                                                                    <option value="<?php echo $val->id; ?>"><?php echo $val->name;?></option>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-b-10">
                                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                                            <h3 class="box-title m-b-0">Maintenence</h3>
                                                                            <select class="form-control" id="maintenence_<?php echo $mpor_assigned->mpor_id;?>" name="maintenence">
                                                                                <option>Standard</option>
                                                                                <option>Ptac</option>
                                                                                <option>Tv</option>
                                                                                <option>Lighting</option>
                                                                                <option>Phone</option>
                                                                                <option>Plumbing</option>
                                                                                <option>Electrical</option>
                                                                                <option>Wall/cleaning damange</option>
                                                                                <option>Locks</option>
                                                                                <option>Guest safety</option>
                                                                                <option>Public area</option>
                                                                                <option>Public restroom</option>
                                                                                <option>Kitchen</option>
                                                                                <option>Meeting room</option>
                                                                                <option>Exterior</option>
                                                                                <option>Swimming pool</option>
                                                                                <option>Fitness center</option>
                                                                                <option>Electrical room</option>
                                                                                <option>Boiler room</option>
                                                                                <option>Office</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12"></div>
                                                                    </div>
                                                                    <div class="row m-b-10">
                                                                        <div class="col-lg-12">
                                                                            <textarea class="form-control" rows="5" cols="5" id="notes_<?php echo $mpor_assigned->mpor_id;?>" name="notes"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-12 p-l-0">Attachment:</label>
                                                                        <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                                            <input type="file" accept="image/*;capture=camera" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                                        </div>
                                                                    </div>
                        											<div class="error_div m-t-10" id="popup_error_<?php echo $mpor_assigned->mpor_id;?>"></div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-danger waves-effect waves-light popup-btn" onclick="mpor_gen_ticket(<?php echo $mpor_assigned->mpor_id;?>);">GENERATE TICKET</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                                                
                                                <?php
													$curr_date				= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
													$get_assign_rooms_data	= admin_helper::get_assign_rooms_data($mpor_assigned->hotel_id, $mpor_assigned->assign_to_id, $curr_date);
													$percentage = ($get_assign_rooms_data[0]->total_completed / $get_assign_rooms_data[0]->total_rooms)*100;

                                                    //Calculate projected time
                                                    $projected_time = '';
                                                    $chk_stay = $mpor_assigned->chk_stay;
                                                    if ($settings && !empty($settings[0]->goal_time)) {
                                                        $goal_times = json_decode($settings[0]->goal_time, true);
                                            
                                                        if (isset($goal_times[$chk_stay][$room_types[0]->room_type])) {
                                                            // Extract goal time (format: "01:05 Hours:Minutes")
                                                            list($hours, $minutes) = sscanf($goal_times[$chk_stay][$room_types[0]->room_type], "%d:%d");

                                                            // Get started_at time
                                                            $started_at = new DateTime($mpor_assign[$key]->started_at);                           

                                                            // Add goal time
                                                            $started_at->modify("+$hours hours +$minutes minutes");

                                                            // Update the value
                                                            $projected_time = $started_at->format('h:i A'); 
                                                        }                                                       
                                                    }

                                                    $started_time = date('h:i A', strtotime($mpor_assign[$key]->started_at));                                                  
                                                    
																									
                                                    $START_HTML .= '<div class="row"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 b-r left_swal"><h2>MyBoard Metrics</h2>';
                                                    $START_HTML .= '<p><strong>MyStart-</strong> <span class="text-danger">'.$started_time.'</span></p>';
													$START_HTML .= '<h5 style="font-weight: normal; text-decoration: underline;">TOTAL ROOMS COMPLETE</h5>';
                                                    $START_HTML .= '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">'.$percentage.'%</div></div>';
                                                    $START_HTML .= '<div class="card"><ul class="list-group list-group-flush"><li class="list-group-item">TOTAL: '.$get_assign_rooms_data[0]->total_completed.'/'.$get_assign_rooms_data[0]->total_rooms.'</li><li class="list-group-item">CHECK-OUT: '.$get_assign_rooms_data[0]->total_checkouts_completed.'/'.$get_assign_rooms_data[0]->total_checkouts.'</li><li class="list-group-item">STAYOVER: '.$get_assign_rooms_data[0]->total_stayovers_completed.'/'.$get_assign_rooms_data[0]->total_stayovers.'</li></ul></div>';
													$START_HTML .= '<p><strong>MyProjected Finish-</strong> ' . (!empty($projected_time) ? $projected_time : 'Set goal for ' . $chk_stay.' '. $room_types[0]->room_type . ' room type.') . '</p>';

                                                    $START_HTML .= '<p><strong>Variance-</strong> <span class="text-danger" id="variance_'.$mpor_assigned->mpor_id.'" class="variance_'.$mpor_assigned->mpor_id.'"></span></p>';

                                                    $START_HTML .= '<p><strong>MyLive Clock-</strong> <span id="mylive_clock_'.$mpor_assigned->mpor_id.'" class="mylive_clock_'.$mpor_assigned->mpor_id.'"></span></p>';
													//showElapsdTimeElapsed('2021-04-08 05:32:11', '244');
                                                    $START_HTML .= '<div class="card"><ul class="list-group list-group-flush">';
														foreach($mpor_assign as $mpor_assignedx){
															if($mpor_assignedx->status == "Completed"){
																$START_HTML .= '<li class="list-group-item" style="padding: 10px 5px; text-align: left;">'.$mpor_assignedx->assign_rooms.'-'.ucfirst(substr($mpor_assignedx->chk_stay,0,1)).'/O - <span class="bg-success" style="padding: 5px;">100% '.$mpor_assignedx->status.'</span></li>';
															}elseif($mpor_assignedx->status == "In-Progress"){
																$START_HTML .= '<li class="list-group-item" style="padding: 10px 5px;text-align: left;">'.$mpor_assignedx->assign_rooms.'-'.ucfirst(substr($mpor_assignedx->chk_stay,0,1)).'/O - <span class="bg-yellow" style="padding: 5px;">'.$mpor_assignedx->status.'</span></li>';
															}else{
																$START_HTML .= '<li class="list-group-item" style="padding: 10px 5px;text-align: left;">'.$mpor_assignedx->assign_rooms.'-'.ucfirst(substr($mpor_assignedx->chk_stay,0,1)).'/O - <span class="bg-" style="padding: 5px;"></span></li>';
															}
														}
													$START_HTML .= '</ul></div></p>';
													
                                                    $START_HTML .= '</div>';
													//LEFT SIDE END 
													
													
                                                    $START_HTML .= '<div class="col-lg-8 col-md-4 col-sm-4 col-xs-12 b-l"><div class="btn-groupp btn-group-toggle" data-toggle="buttons">';
                                                    if($mpor_assigned->sp_request){$START_HTML .= '<label class="fcbtn btn btn-success btn-1e p-10 m-r-5 m-b-5"> VIP </label>';}else{$START_HTML .= '<label class="fcbtn btn btn-success btn-outline btn-1e p-10 m-r-5 m-b-5"> VIP </label>';}
                                                    if($mpor_assigned->sp_request){$START_HTML .= '<label class="fcbtn btn btn-warning btn-1e p-10 m-r-5 m-b-5"> SPECIAL REQUEST </label>';}else{$START_HTML .= '<label class="fcbtn btn btn-warning btn-outline btn-1e p-10 m-r-5 m-b-5"> SPECIAL REQUEST </label>';}
                                                    if($mpor_assigned->notes){$START_HTML .= '<label class="fcbtn btn btn-danger btn-1e p-10 m-r-5 m-b-5"> NOTES </label>';}else{$START_HTML .= '<label class="fcbtn btn btn-danger btn-outline btn-1e p-10 m-r-5 m-b-5"> NOTES </label>';}
                                                    $START_HTML .= '<label class="fcbtn btn btn-info btn-outline btn-1e p-10 m-r-5 m-b-5" data-toggle="modal" data-target="#gen-ticket-modal-'.$mpor_assigned->mpor_id.'"><input type="radio" name="options" id="option3" autocomplete="off"> TICKET </label>';
                                                    $START_HTML .= '<label class="fcbtn btn btn-primary btn-outline btn-1e p-10 m-r-5 m-b-5" data-toggle="modal" data-target="#dnd-modal-'.$mpor_assigned->mpor_id.'"><input type="radio" name="options" id="option3" autocomplete="off"> DO NOT DISTURB </label>';
                                                    //$START_HTML .= '<label class="fcbtn btn btn-primary btn-outline btn-1e p-10 m-r-5 m-b-5"><i class="fa fa-envelope"></i></label>';
													
													$START_HTML .= '<a class="dropdown-togglee waves-effectt waves-lightt" href="#"><i class="mdi mdi-gmail"></i><div class="notifyyyy"> <span class="heartbitxxxx" style="right: 60px;"></span> <span class="pointxxxx" style="right: 70px;"></span> </div></a>';
													
													
                                                    $START_HTML .= '</div>';
                                                    /*if ($mpor_assigned->sp_request){$START_HTML .= '</br><p class="pull-left m-b-10"><strong>SPECIAL REQUEST:</strong> '.ucfirst($mpor_assigned->sp_request).'</p></br>';}*/
                                                    if ($mpor_assigned->notes){$START_HTML .= '<p class="pull-left m-b-10"><strong>NOTES:</strong> '.htmlspecialchars_decode($mpor_assigned->notes).'</p>';}
                                                    if(is_array($categories)){															
                                                        $START_HTML .= '</br></br><table id="myTableccccccccs" class="table table-striped table-bordered table-responsive"><thead><tr><th></th><th>Housekeeping Performed</th></tr></thead><tbody>';
														
														$counter = 1;
                                                        foreach($categories as $category_val){
                                                            $START_HTML .= '<tr><td>'.$category_val->cat_name;
																$mpor_checklist_info = admin_helper::group_mpor_checklist_info($mpor_assigned->hotel_id, $mpor_assigned->mpor_id, $category_val->c_id);
																if(is_array($mpor_checklist_info) && !empty($mpor_checklist_info)){
																	if($mpor_checklist_info[0]->status == 1){
																		$START_HTML .= '<span style="color:red;"> '.$mpor_checklist_info[0]->time_taken.'</span>';
																	}else{
																		if($counter == 1){
																			$START_HTML .= '<div style="font-size:10px;"><span id="hour" class="timeel hours">00</span><span class="timeel timeRefHours">:</span><span id="min" class="timeel minutes">00</span><span class="timeel timeRefMinutes">:</span><span id="sec" class="timeel seconds">00</span><span class="timeel timeRefSeconds"></span></div>';
																			$START_HTML .= '<button type="button" style="padding:5px; margin-right: 10px; font-weight:none; font-size:10px;" class="btn btn-sm btn-success waves-effect waves-light mm-r-10 btn-light" id="start_button" data-mpor="'.$mpor_assigned->mpor_id.'" data-cat="'.$category_val->c_id.'">Start Cleaning</button>';
																			$START_HTML .= '<button style="padding:5px; margin:0 auto; font-weight:none; font-size:10px;" class="btn btn-sm btn-info waves-effect waves-light mm-r-10 btn-light" id="timer_submit">Complete Cleaning</button>';
																			$START_HTML .= '<div id="total_time"></div>';
																		}
																		$counter = $counter+1;
																	}
																}else{
																	if($counter == 1){
																		$START_HTML .= '<div style="font-size:10px;"><span id="hour" class="timeel hours">00</span><span class="timeel timeRefHours">:</span><span id="min" class="timeel minutes">00</span><span class="timeel timeRefMinutes">:</span><span id="sec" class="timeel seconds">00</span><span class="timeel timeRefSeconds"></span></div>';
																		$START_HTML .= '<button type="button" style="padding:5px; margin-right: 10px; font-weight:none; font-size:10px;" class="btn btn-sm btn-success waves-effect waves-light mm-r-10 btn-light" id="start_button" data-mpor="'.$mpor_assigned->mpor_id.'" data-cat="'.$category_val->c_id.'">Start Cleaning</button>'; 
																		$START_HTML .= '<button style="padding:5px; margin:0 auto; font-weight:none; font-size:10px;" class="btn btn-sm btn-info waves-effect waves-light mm-r-10 btn-light" id="timer_submit">Complete Cleaning</button>';
																		$START_HTML .= '<div id="total_time"></div>';
																	}
																	$counter = $counter+1;
																}
                                                            $START_HTML .= '</td><td class="text-left">';                                                            
                                                            $cat_subcat = admin_helper::get_subcat_active_edit_items($category_val->c_id);
                                                            if(is_array($cat_subcat)){foreach($cat_subcat as $cat_subcat_items){
                                                                $START_HTML .= '<label class="showUs">- '.$cat_subcat_items->subcat_name.' <i class="fa fa-clock-o"></i></label><br>';
																/*$mpor_checklist_info = admin_helper::group_mpor_checklist_info($mpor_assigned->hotel_id, $mpor_assigned->mpor_id, $cat_subcat_items->s_id);
																if(is_array($mpor_checklist_info) && !empty($mpor_checklist_info)){
																	if($mpor_checklist_info[0]->status == 1){
																		$START_HTML .= '<span style="color:red;"> '.$mpor_checklist_info[0]->time_taken.'</span>';
																	}else{
																		if($counter == 1){
																			$START_HTML .= '<div style="font-size:10px;"><span id="hour" class="timeel hours">00</span><span class="timeel timeRefHours">:</span><span id="min" class="timeel minutes">00</span><span class="timeel timeRefMinutes">:</span><span id="sec" class="timeel seconds">00</span><span class="timeel timeRefSeconds"></span></div>';
																			$START_HTML .= '<button type="button" style="padding:5px; margin-right: 10px; font-weight:none; font-size:10px;" class="btn btn-sm btn-success waves-effect waves-light mm-r-10 btn-light" id="start_button" data-mpor="'.$mpor_assigned->mpor_id.'" data-cat="'.$category_val->c_id.'" data-subcat="'.$cat_subcat_items->s_id.'">Start Cleaning</button>';
																			$START_HTML .= '<button style="padding:5px; margin:0 auto; font-weight:none; font-size:10px;" class="btn btn-sm btn-info waves-effect waves-light mm-r-10 btn-light" id="timer_submit">Complete Cleaning</button>';
																			$START_HTML .= '<div id="total_time"></div>';
																		}
																		$counter = $counter+1;
																	}
																}else{
																	if($counter == 1){
																		$START_HTML .= '<div style="font-size:10px;"><span id="hour" class="timeel hours">00</span><span class="timeel timeRefHours">:</span><span id="min" class="timeel minutes">00</span><span class="timeel timeRefMinutes">:</span><span id="sec" class="timeel seconds">00</span><span class="timeel timeRefSeconds"></span></div>';
																		$START_HTML .= '<button type="button" style="padding:5px; margin-right: 10px; font-weight:none; font-size:10px;" class="btn btn-sm btn-success waves-effect waves-light mm-r-10 btn-light" id="start_button" data-mpor="'.$mpor_assigned->mpor_id.'" data-cat="'.$category_val->c_id.'" data-subcat="'.$cat_subcat_items->s_id.'" >Start Cleaning</button>'; 
																		$START_HTML .= '<button style="padding:5px; margin:0 auto; font-weight:none; font-size:10px;" class="btn btn-sm btn-info waves-effect waves-light mm-r-10 btn-light" id="timer_submit">Complete Cleaning</button>';
																		$START_HTML .= '<div id="total_time"></div>';
																	}
																	$counter = $counter+1;
																}
																$START_HTML .= '<br>';*/
                                                            }}
                                                            /*https://www.jqueryscript.net/time-clock/count-up-stopwatch.html*/
                                                            $START_HTML .= '</td></tr>';
                                                        }
                                                        $START_HTML .= '</tbody></table></br></div></div>';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $mpor_assigned->assign_rooms .' ('.$room_types[0]->room_type.')'; ?></td>
                                                    <td><?php $username = admin_helper::get_user_name($mpor_assigned->assign_to_id);echo ucfirst($username[0]->username);?></td>
                                                    <td><?php echo ucfirst($mpor_assigned->chk_stay);?></td>
                                                    <td>--</td>
                                                    <td><?php echo ucfirst($mpor_assigned->sp_request);?></td>
                                                    <td><?php echo htmlspecialchars_decode($mpor_assigned->notes);?></td>
                                                    <?php if($mpor_assigned->assign_to_id == $this->session->userdata['logged_in']['id']){
														if($mpor_assigned->started_at != '0000-00-00 00:00:00'){echo '<td>No</td>';}
														else if($mpor_assigned->is_dnd == 0 ){?>
                                                        	<td><button type="button" data-toggle="modal" data-target="#dnd-modal-<?php echo $mpor_assigned->mpor_id;?>" class="btn btn-danger waves-effect waves-light" title="Do Not Disturb"><i class="fa fa-ban"></i></button></td>
                                                        <?php }
														else{echo '<td>Yes</td>';}
													}else{if($mpor_assigned->is_dnd == 1){echo '<td>Do Not Disturb</td>';}else{echo '<td>&mdash;</td>';}}?>
                                                    <?php if($mpor_assigned->is_dnd == 0){?>
                                                    <td id="startedd_<?php echo $mpor_assigned->mpor_id;?>">
													<?php if($mpor_assigned->approved == 'Ree-Inspect'){echo 'Re-Inspect';}
                                                        else{
                                                            if(($mpor_assigned->started_at == '0000-00-00 00:00:00' && $mpor_assigned->completed_at == '0000-00-00 00:00:00') 
                                                            || (($mpor_assigned->approved == 'Normal Re-Inspect' || $mpor_assigned->approved == 'Re-Inspect') && $mpor_assigned->status == 'Pending')){
                                                                
                                                                $dateEnd = new DateTime(gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'].' hours')));
                                                                $dateStart = new DateTime($mpor_assign[$key]->started_at);

                                                                $dateDiff  = $dateStart->diff($dateEnd);
                                                                $started_time = $dateDiff->format("%H:%I:%S");

                                                                // Parse the difference into hours, minutes, seconds
                                                                list($hours, $minutes, $seconds) = explode(":", $started_time);
                                                                $time_seconds = ($hours * 3600) + ($minutes * 60) + $seconds;

                                                                ?>
                                                                <button type="button" class="btn btn-success waves-effect waves-light m-r-10" id="start_<?php echo $mpor_assigned->mpor_id;?>">Start</button>
                                                        		<script>
																	$('#start_<?php echo $mpor_assigned->mpor_id;?>').on('click', function(){
                                                                        var hours = <?php echo $hours; ?>;
                                                                        var minutes = <?php echo $minutes; ?>;
                                                                        var seconds = <?php echo $seconds; ?>;
                                                                        var  t="<?php echo $hours.':'.$minutes.':'.$seconds;?>";
																	//	seconds = 0, minutes = 0, hours = 0, t="00:0:00";
																		function add(){
																			seconds++;
																			if (seconds >= 60) {
																				seconds = 0;
																				minutes++;
																				if (minutes >= 60) {
																					minutes = 0;
																					hours++;
																				}
																			}
																			var xyz = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
																			$("#timerValue_<?php echo $mpor_assigned->mpor_id;?>").html(xyz);
																		   timer()
																		}
																		function timer(){t = setTimeout(add, 1000);}
																		
																		swal({   
																			title: "Are you sure?",
																			text: "Do you want to start cleaning room (<?php echo $mpor_assigned->assign_rooms .' ('.$room_types[0]->room_type.')'; ?>) cleaning? <?php if ($mpor_assigned->notes){echo 'NOTES:  '.htmlspecialchars_decode($mpor_assigned->notes);}?>",   
																			type: "warning",   
																			showCancelButton: true,   
																			confirmButtonColor: "#DD6B55",   
																			confirmButtonText: "Yes, start it!",   
																			cancelButtonText: "No, cancel please!",   
																			closeOnConfirm: false,
																			closeOnCancel: false,
																			allowOutsideClick: false
																			}, function(isConfirm){
																				if (isConfirm){
																					swal({
																						title: 'Room <?php echo $mpor_assigned->assign_rooms .' ('.$room_types[0]->room_type.')'; ?> is In-Progress!',
																						text: "",
																						type: "success",
																						allowOutsideClick: false,
																						confirmButtonText: "Complete",
																						showCancelButton: false,
																						confirmButtonColor: "#DD6B55",
																						closeOnConfirm: false,
																						closeOnCancel: false,
																						html: '<h1><time id="timerValue_<?php echo $mpor_assigned->mpor_id;?>"></time></h1><?php echo $START_HTML;?>',
																					}, function(isConfirm){
																							if (isConfirm){
																								swal({
																									title: "Are you sure?",   
																									text: "Do you really want complete this room? Please complete with signature.",   
																									type: "warning",   
																									showCancelButton: true,   
																									confirmButtonColor: "#DD6B55",   
																									confirmButtonText: "Yes, sign it!",   
																									cancelButtonText: "No, cancel please!",   
																									closeOnConfirm: true,   
																									closeOnCancel: false,
																									allowOutsideClick: false
																								}, function(isConfirm){
																									if (isConfirm) {
																										//swal("Confirm!", "Completed", "success");
																										$("#ticket_<?php echo $mpor_assigned->mpor_id;?>").css({'z-index':'1000'});
																										$('#esig-modal-'+<?php echo $mpor_assigned->mpor_id;?>).modal();
																									} else {
																										location.reload();
																									} 
																								});
																							}else{
																								//alert('Not configure');
																							}
																						}
																					);
																					var start = document.getElementsByClassName('confirm');
                                                                                    <?php if($mpor_assigned->approved == 'Premium Re-Inspect' || $mpor_assigned->approved == 'Normal Re-Inspect' || $mpor_assigned->approved == 'Re-Inspect') { ?>
                                                                                        $("#timerValue_<?php echo $mpor_assigned->mpor_id;?>").html(
                                                                                            (hours > 9 ? hours : "0" + hours) + ":" +
                                                                                            (minutes > 9 ? minutes : "0" + minutes) + ":" +
                                                                                            (seconds > 9 ? seconds : "0" + seconds)
                                                                                        );
                                                                                    <?php } else { ?>    
                                                                                        $("#timerValue_<?php echo $mpor_assigned->mpor_id;?>").html("00:00:00");
                                                                                    <?php } ?>    

																					start.onclick = timer();
                                                                                    
																					$("#ticket_<?php echo $mpor_assigned->mpor_id;?>").css({'z-index':'999999'});
																					
																					var data_string = "mpor_id=<?php echo $mpor_assigned->mpor_id;?>&method_type=started";

                                                                                    <?php if($mpor_assigned->approved == 'Normal Re-Inspect' || $mpor_assigned->approved == 'Re-Inspect') { ?>
                                                                                        data_string += "&type=reinspect";
                                                                                    <?php } else if($mpor_assigned->approved == 'Start-Over') { ?>
                                                                                        data_string += "&type=startover";
                                                                                    <?php } else { ?>
                                                                                        data_string += "&type=start";
                                                                                    <?php } ?>     
                                                                                    
																					$.ajax({
																						url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
																						type: "POST",
																						data: data_string,
																						success: function(data){
																							localStorage.clear();
																							location.reload();
                                                                                        }
																					});
																				} else {
																					swal("Cancelled", "You cancelled it but you can start anytime", "error");   
																				}
																			}
																		);
																	});
																</script>
                                                    	<?php }
                                                            else if($mpor_assigned->started_at != '0000-00-00 00:00:00' && $mpor_assigned->completed_at != '0000-00-00 00:00:00' && $mpor_assigned->approved !== 'Re-Inspect'){
																$dateStart = new DateTime($mpor_assigned->started_at);
																$dateEnd   = new DateTime($mpor_assigned->completed_at);																	
																$dateDiff  = $dateStart->diff($dateEnd);
																print $dateDiff->format("%H:%I:%S");
															}
                                                            else if($mpor_assigned->started_at != '0000-00-00 00:00:00' && $mpor_assigned->completed_at == '0000-00-00 00:00:00'){
															
                                                                $dateEnd = new DateTime(gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'].' hours')));
                                                                $dateStart = new DateTime($mpor_assign[$key]->started_at);

                                                                $dateDiff  = $dateStart->diff($dateEnd);
                                                                $started_time = $dateDiff->format("%H:%I:%S");

                                                                // Parse the difference into hours, minutes, seconds
                                                                list($hours, $minutes, $seconds) = explode(":", $started_time);
                                                                $time_seconds = ($hours * 3600) + ($minutes * 60) + $seconds;
                                                                
                                                                 //Calculate goal time
                                                                $goal_time_formatted = '';
                                                                $chk_stay = $mpor_assigned->chk_stay;
                                                                if ($settings && !empty($settings[0]->goal_time)) {
                                                                    $goal_times = json_decode($settings[0]->goal_time, true);

                                                                    if (isset($goal_times[$chk_stay][$room_types[0]->room_type])) {
                                                                        // Extract goal time (format: "01:05 Hours:Minutes")
                                                                        list($v_hours, $v_minutes) = sscanf($goal_times[$chk_stay][$room_types[0]->room_type], "%d:%d");
                                                                
                                                                        // Format as H:i:s (appending 00 seconds)
                                                                        $goal_time_formatted = sprintf('%02d:%02d:%02d', $v_hours, $v_minutes, 0);
                                                                    }                                                 
                                                                }
                                                                
															?>
																<script>
																	$(document).ready(function(){
																		$("#ticket_<?php echo $mpor_assigned->mpor_id;?>").css({'z-index':'999999'});
																	                                                                     
                                                                        seconds = <?php echo $seconds;?>, 
                                                                        minutes = <?php echo $minutes;?>,
                                                                        hours = <?php echo $hours;?>, 
                                                                        t="<?php echo $hours.':'.$minutes.':'.$seconds;?>";

																		function timestamp() {
																			var data_string = "started_at=<?php echo $mpor_assign[$key]->started_at;?>&tz=<?php echo $this->session->userdata['logged_in']['tz'];?>";
																			$.ajax({
																				url: '<?php echo base_url();?>timestamp.php',
																				type: "POST",
																				data: data_string,
																				success: function(data) {
																					$('#mylive_clock_'+<?php echo $mpor_assigned->mpor_id;?>).html(data);
																					
																					var data_string = "goal_time=<?php echo $goal_time_formatted;?>&type=variance&clock_value="+data;
                                                                                    $.ajax({
                                                                                        url: '<?php echo base_url();?>timestamp.php',
                                                                                        type: "POST",
                                                                                        data: data_string,
                                                                                        success: function(data) {
                                                                                            $('#variance_'+<?php echo $mpor_assigned->mpor_id;?>).html(data);
                                                                                        },
                                                                                    });
																				},
																			});
																		}
																		setInterval(timestamp, 1000);
																		function add(){
																			seconds++;
																			if (seconds >= 60) {
																				seconds = 0;
																				minutes++;
																				if (minutes >= 60) {
																					minutes = 0;
																					hours++;
																				}
																			}
																			var xyz = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
																			$("#timerValue_<?php echo $mpor_assigned->mpor_id;?>").html(xyz);
																		   timer();
																		}
																		function timer(){t = setTimeout(add, 1000);}
																		swal({
																			title: "Room <?php echo $mpor_assigned->assign_rooms .' ('.$room_types[0]->room_type.')'; ?> is In-Progress",
																			text: "", 
																			type: "success",   
																			showCancelButton: false,   
																			confirmButtonColor: "#DD6B55",   
																			confirmButtonText: "Complete",   
																			closeOnConfirm: false,
																			closeOnCancel: false,
																			allowOutsideClick: false,
																			html: '<h1><time id="timerValue_<?php echo $mpor_assigned->mpor_id;?>"></time></h1><?php echo $START_HTML;?>',
																			}, function(isConfirm){
																				if (isConfirm){
																					swal({
																						title: "Are you sure?",   
																						text: "Do you really want complete this room? Please complete with signature.",   
																						type: "warning",   
																						showCancelButton: true,   
																						confirmButtonColor: "#DD6B55",   
																						confirmButtonText: "Yes, sign it!",   
																						cancelButtonText: "No, cancel please!",   
																						closeOnConfirm: true,   
																						closeOnCancel: false,
																						allowOutsideClick: false
																					}, function(isConfirm){
																						if (isConfirm) {
																							
																							$("#ticket_<?php echo $mpor_assigned->mpor_id;?>").css({'z-index':'1000'});
																							$('#esig-modal-'+<?php echo $mpor_assigned->mpor_id;?>).modal();
																							/*swal("Confirm!", "Completed", "success");*/
																						} else {
																							location.reload();
																						} 
																					});
																				} else {
																					//alert('Not configure 2');
																				}
																			}
																		);
																		var start = document.getElementsByClassName('confirm');
                                                                        
                                                                        <?php if($mpor_assigned->approved == 'Re-Inspect') { ?>
                                                                            $("#timerValue_<?php echo $mpor_assigned->mpor_id;?>").html(
                                                                                (hours > 9 ? hours : "0" + hours) + ":" +
                                                                                (minutes > 9 ? minutes : "0" + minutes) + ":" +
                                                                                (seconds > 9 ? seconds : "0" + seconds)
                                                                            );
                                                                        <?php } else { ?>    
																	    	$("#timerValue_<?php echo $mpor_assigned->mpor_id;?>").html("00:00:00");
                                                                        <?php } ?>  
                                                                        timer();  
																	//	start.onclick = timer();
																	});
																</script>
														<?php }
                                                        }?>
                                                    </td>
                                                    <?php }else {echo '<td>Do Not Disturb</td>';}?>
                                                    <?php if($mpor_assigned->assign_to_id == $this->session->userdata['logged_in']['id']){?>
                                                    	<td><button id="ticket_<?php echo $mpor_assigned->mpor_id;?>" type="button" data-toggle="modal" data-target="#gen-ticket-modal-<?php echo $mpor_assigned->mpor_id;?>" class="btn btn-warning waves-effect waves-light">Gen. Ticket</button></td>
                                                        <td><div class="fileupload fcbtn btn btn-success btn-outline btn-1d"><span>Upload</span>
                                                        	<input class="upload" accept="image/*;capture=camera" type="file">
                                                        </div></td>
                                                    <?php }else{echo '<td>&mdash;</td><td>&mdash;</td>';}?>
                                                </tr>
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
	.error_div{
		width:60%;
		color: red;
	}
	.sweet-alert{
		margin-top: -300px !important;
		max-height: 70% !important;
		width:850px !important;
	}
	.bootstrap-table{
		margin-top: 20px !important;
	}
	.left_swal p {
		margin-bottom:10px !important;
		text-align:left !important;
	}
	.progress{
		height: 13px !important;
	}
	.bg-yellow, .progress-bar-yellow {
		background-color: #FFFF00 !important;
	}
</style>

<script>
window.addEventListener('load', function () {
    var dashboard		= document.getElementById("page_name");
    var start_button	= document.getElementById("start_button");
    var stop_button		= document.getElementById("timer_submit");
    //timer 
    var hour			= document.getElementById("hour");
    var mint			= document.getElementById("min");
    var secd			= document.getElementById("sec");
	
    if (dashboard != null && localStorage.getItem('start_button') == null) {
        var hr			= 0;
        var min			= 0;
        var sec			= 0;
    } else if ((dashboard != null && localStorage.getItem('start_button') != null)) {
        $("#start_button").prop("disabled", true);
        $("#start_button").removeClass("btn-outline-success");
        //$("#start_button").addClass("btn-light");
        start_button.innerHTML = "Cleaning In-progress...";
    }
	
    if (start_button) {
        start_button.addEventListener('click', function () {
            localStorage.setItem('start_button', 'clicked');
            $("#start_button").prop("disabled", true);
            $("#start_button").removeClass("btn-outline-success");
            //$("#start_button").addClass("btn-light");
            start_button.innerHTML = "Cleaning In-progress...";
            var total_time = document.getElementById("total_time");
            if (total_time) {
                //total_time.innerHTML = "Counting...";
            }
			
			var mpor_id		= $(this).data("mpor");
			var cat_id		= $(this).data("cat");
			/*var subcat_id	= $(this).data("subcat");*/
			
			lock_start_timer(mpor_id, cat_id);
            timerCycle();
        })
    }
    if (stop_button) {
        stop_button.addEventListener('click', function () {
			var mpor_id		= $("#start_button").data("mpor");
			var cat_id		= $("#start_button").data("cat");
			/*var subcat_id	= $("#start_button").data("subcat");*/
			
			var time_taken	= hr+':'+min+':'+sec;			
            saveData(time_taken, mpor_id, cat_id);                          //To get data after stop button active this fuction
            
			localStorage.clear();
            hour.innerHTML = '00';
            mint.innerHTML = '00';
            secd.innerHTML = '00';
            var total_time = document.getElementById("total_time");
            if (total_time) {
                total_time.innerHTML = hr + ':' + min + ':' + sec;
            }
            //Stopping the cycle
            clearTimeout(cycle);
            hr		= 0;
            min		= 0;
            sec		= 0;
            $("#start_button").prop("disabled", false);
            $("#start_button").addClass("btn-success");
            //$("#start_button").removeClass("btn-light");
            start_button.innerHTML = "Start Cleaning";
        })
    }
    //continue timer on other pages 
    if (dashboard == null && localStorage.getItem('start_button') != null) {
        sec		= localStorage.getItem('sec');
        min		= localStorage.getItem('min');
        hr		= localStorage.getItem('hr');
        timerCycle();
        //continue timer on coming back Dashboard
    }
	else if (dashboard != null && localStorage.getItem('start_button') != null) {
        sec		= localStorage.getItem('sec');
        min		= localStorage.getItem('min');
        hr		= localStorage.getItem('hr');
        timerCycle();
    }
	
    function timerCycle() {
        sec		= parseInt(sec);
        min		= parseInt(min);
        hr		= parseInt(hr);

        sec = sec + 1;

        if (sec == 60) {
            min = min + 1;
            sec = 0;
        }
        if (min == 60) {
            hr = hr + 1;
            min = 0;
            sec = 0;
        }

        if (sec < 10 || sec == 0) {
            sec = '0' + sec;
        }
        if (min < 10 || min == 0) {
            min = '0' + min;
        }
        if (hr < 10 || hr == 0) {
            hr = '0' + hr;
        }

        localStorage.setItem('hr', hr);
        localStorage.setItem('min', min);
        localStorage.setItem('sec', sec);

        hour.innerHTML = hr;
        mint.innerHTML = min;
        secd.innerHTML = sec;

        // if (dashboard == null && localStorage.getItem('start_button') != null) {
        //     var side_timer = document.getElementById('time_title');
        //     if (side_timer) {
        //         handling other counter changeing URL        [Put Where you want to show your counter after URL change]
        //         hour.innerHTML = hr;
        //         min.innerHTML = min;
        //         sec.innerHTML = sec;
        //     }

        // } else {

        // }
        cycle = setTimeout(timerCycle, 1000);
    }
	
	//SAVE DATA WHEN START
	function lock_start_timer(mpor_id, cat_id) {
		var data_string = "method=Start&mpor_id="+mpor_id+"&cat_id="+cat_id;
		
		$.ajax({
			url:"<?php echo site_url("mpor/lock_mpor_start_comp_timer") ?>",
			method: "POST",
			data: data_string,
			success: function (data) {},
			error: function (data, textStatus, errorThrown) {
				console.log("Error:");
				console.log(data);
			},
		});
    }
	//UPDATE DATA WHEN COMPLETE
	function saveData(time_taken, mpor_id, cat_id) {
		var data_string	= "method=Complete&mpor_id="+mpor_id+"&cat_id="+cat_id+"&time_taken="+time_taken;
		
		$.ajax({
			url:"<?php echo site_url("mpor/lock_mpor_start_comp_timer") ?>",
			method: "POST",
			data: data_string,
			success: function (data) {
				location.reload();
             },
             error: function (data, textStatus, errorThrown) {
                 console.log("Error:");
                 console.log(data);
             },
		});
    }
	
});
</script>