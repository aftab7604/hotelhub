
<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<div class="container-fluid"> 
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Inspector Central</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li><a href="<?php echo base_url().'mpor/room_priority';?>">Room Priorities</a></li>
                <li class="active">Inspector Central Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Inspector Central</div>
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
                            $assignedRooms	= array();
                            $both_strings	= '';
							if(is_array($house_keeping_info)){$total_records = count($house_keeping_info);}else{$total_records = 1;}
                            if(is_array($house_keeping_info)){foreach($house_keeping_info as $hk_info_val){
                                $both_strings .= $hk_info_val->assign_rooms.',';
                            }}
                            $both_strings	= trim($both_strings,',');
                            $assignedRooms	= explode(',', $both_strings);
							function cal_percentage($obt, $total){
								$result = round(($obt/$total)*100, 1);
								$progressBar = 0;
								if($result>=1 && $result<5) {$progressBar = 5;}
								if($result>5  && $result<10){$progressBar = 5;}
								if($result>10 && $result<15){$progressBar = 10;}
								if($result>15 && $result<20){$progressBar = 15;}
								if($result>20 && $result<25){$progressBar = 20;}
								if($result>25 && $result<30){$progressBar = 25;}
								if($result>30 && $result<35){$progressBar = 30;}
								if($result>35 && $result<40){$progressBar = 35;}
								if($result>40 && $result<45){$progressBar = 40;}
								if($result>45 && $result<50){$progressBar = 45;}
								if($result>50 && $result<55){$progressBar = 50;}
								if($result>55 && $result<60){$progressBar = 55;}
								if($result>60 && $result<65){$progressBar = 60;}
								if($result>65 && $result<70){$progressBar = 65;}
								if($result>70 && $result<75){$progressBar = 70;}
								if($result>75 && $result<80){$progressBar = 75;}
								if($result>80 && $result<85){$progressBar = 80;}
								if($result>85 && $result<90){$progressBar = 85;}
								if($result>90 && $result<95){$progressBar = 90;}
								if($result>95 && $result<99){$progressBar = 95;}
								if($result>99){$progressBar = 100;}
								return array('0'=>$result, '1'=>$progressBar);
							}
                        ?>
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-body">
                                <h3 class="box-title">Room Statistics</h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group m-b-0">
                                            <label class="col-sm-6 col-xs-4 control-label">Total Checkouts:</label>
                                            <div class="col-sm-6">
                                            	<div data-label="<?php $res = cal_percentage($checkout_count, $total_records); echo $res[0];?>%" class="css-bar css-bar-<?php  echo $res[1];?> css-bar-sm css-bar-success m-b-0"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-b-0">
                                            <label class="col-sm-6 col-xs-4 control-label">Total Stayover:</label>
                                            <div class="col-sm-6">
                                            	<div data-label="<?php $res = cal_percentage($stayover_count, $total_records); echo $res[0];?>%" class="css-bar css-bar-<?php  echo $res[1];?> css-bar-sm css-bar-success m-b-0"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-b-0">
                                            <label class="col-sm-6 col-xs-4 control-label">In-Progress:</label>
                                            <div class="col-sm-6">
                                            	<div data-label="<?php $res = cal_percentage($inprogress_count, $total_records); echo $res[0];?>%" class="css-bar css-bar-<?php  echo $res[1];?> css-bar-sm css-bar-success m-b-0"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-b-0">
                                            <label class="col-sm-6 col-xs-4 control-label">Completed:</label>
                                            <div class="col-sm-6">
                                            	<div data-label="<?php $res = cal_percentage($completed_count, $total_records); echo $res[0];?>%" class="css-bar css-bar-<?php  echo $res[1];?> css-bar-sm css-bar-success m-b-0"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-3">
                                        <div class="form-group m-b-0">
                                            <label class="col-sm-6 col-xs-4 control-label">Approved Stayovers:</label>
                                            <div class="col-sm-6">
                                            	<div data-label="<?php $res = cal_percentage($apr_stayover_count, $total_records); echo $res[0];?>%" class="css-bar css-bar-<?php  echo $res[1];?> css-bar-sm css-bar-success m-b-0"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-b-0">
                                            <label class="col-sm-6 col-xs-4 control-label">Approved Checkouts:</label>
                                            <div class="col-sm-6">
                                            	<div data-label="<?php $res = cal_percentage($apr_checkout_count, $total_records); echo $res[0];?>%" class="css-bar css-bar-<?php  echo $res[1];?> css-bar-sm css-bar-success m-b-0"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </form><hr />
                        <div class="table-responsive">
                            <table id="MPOR_INSPECTOR_CENTRAL" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Room Assigned</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                        <th>Requests</th>
                                        <th>Notes</th>
                                        <th>DND</th>
                                        <th>Work Orders</th>
                                        <th>Started</th>
                                        <th>Finished</th>
                                        <th>Timer</th>
                                        <th>GAP</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php if(is_array($house_keeping_info)){
                                    foreach($house_keeping_info as $key => $hk_info_val){
										/*if(isset($house_keeping_info[$key+1]) && $house_keeping_info[$key+1]->started_at !='0000-00-00 00:00:00'){
											$dateStart_gap	= new DateTime($hk_info_val->completed_at);
											$dateEnd_gap	= new DateTime($house_keeping_info[$key+1]->started_at);
																												
											$dateDiff_gap	= $dateStart_gap->diff($dateEnd_gap);
											$gap			= $dateDiff_gap->format("%H:%I:%S");
										}else{$gap = '&mdash;';}*/
										
										$room_types = admin_helper::get_room_type($hk_info_val->hotel_id, $hk_info_val->assign_rooms);?>
										
										<!-- Notes Modal -->
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
                                        
                                        <div id="reinspt-room-modal-<?php echo $hk_info_val->mpor_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:100999999999999999; top: 30px;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">MPOR Re-Inspection Section</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post" id="mpor_reinspt_<?php echo $hk_info_val->mpor_id;?>" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-lg-6"><label class="control-label">Todays Date:</label> <?php echo gmdate('m/d/Y h:i A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));?></div>
                                                                <div class="col-lg-6"><label class="control-label">Re-Inspection by:</label> <?php echo ucfirst($this->session->userdata['logged_in']['username']);?></div>
                                                            </div>
                                                            
                                                            <!-- Normal or Premium Re-Inspecion -->
                                                            <div class="row align-items-center mt-3">
                                                                <div class="col-lg-6">
                                                                    <label>Choose Re-Inspection Type:</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 d-flex align-items-center" id="inspection_type_<?php echo $hk_info_val->mpor_id;?>">
                                                                    <input name="inspection_type_<?php echo $hk_info_val->mpor_id;?>" value="normal" type="radio" checked>
                                                                    <label for="inspection_type_<?php echo $hk_info_val->mpor_id;?>" style="font-weight: normal;" class="ml-2">Normal Re-Inspection</label>
                                                                </div>
                                                                <div class="col-lg-6 d-flex align-items-center" id="inspection_type_premium_<?php echo $hk_info_val->mpor_id;?>">
                                                                    <input name="inspection_type_<?php echo $hk_info_val->mpor_id;?>" value="premium" type="radio">
                                                                    <label for="inspection_type_<?php echo $hk_info_val->mpor_id;?>" style="font-weight: normal;" class="ml-2">Premium Re-Inspection</label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div id="re_signArea_<?php echo $hk_info_val->mpor_id;?>">
                                                                        <h2 class="tag-ingo">Put signature below*</h2>
                                                                        <div class="sig sigWrapper" style="height:auto;width: 54%;">
                                                                            <div class="typed"></div>
                                                                            <canvas class="sign-pad" id="re_sign-pad_<?php echo $hk_info_val->mpor_id;?>" width="300" height="100"></canvas>
                                                                        </div>
                                                                        <div class="checkbox checkbox-success">
                                                                            <input id="re_terms_<?php echo $hk_info_val->mpor_id;?>" type="checkbox" name="terms" value="1">
                                                                            <label><?php echo htmlspecialchars_decode($settings[0]->terms_conditions_hk);?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                	<label class="control-label">Notes:</label>
                                                                    <textarea class="form-control" rows="5" cols="5" id="re_notes_<?php echo $hk_info_val->mpor_id;?>" name="notes_<?php echo $hk_info_val->mpor_id;?>"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                                                    <h3 class="box-title m-b-0">Attachment</h3>
                                                                    <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                                        <input class="upload" name="file" id="reinspt_file" accept="image/*;capture=camera" type="file">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    	<button type="button" id="re_btnSaveSign_<?php echo $hk_info_val->mpor_id;?>" class="btn btn-success waves-effect"><i class="fa fa-check"></i>Re-Inspection</button>
                                                        <button type="button" id="re_btnClearSign_<?php echo $hk_info_val->mpor_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
											$(document).ready(function() {
												$('#re_signArea_'+<?php echo $hk_info_val->mpor_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
											});
											$("#re_btnSaveSign_"+<?php echo $hk_info_val->mpor_id;?>).click(function(e){
												$('#loader_main').show();
												html2canvas([document.getElementById('re_sign-pad_'+<?php echo $hk_info_val->mpor_id;?>)], {
													onrendered: function (canvas) {
														var canvas_img_data = canvas.toDataURL('image/png');
														var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
														if(img_data == 'iVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAABj0lEQVR4nO3XsQnDQBBFQfXfnYJTMTrQuQGDlUkPz8DPN3qw2wKI2J4+AOAuwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvI+Bqs8zzNzB7ddV2/gzXnXMdxrH3fzcwe2RhjzTnvBWuM8fjBZva/ux0sL6GZvWG3XkKAtxIsIEOwgAzBAjIEC8gQLCBDsIAMwQIyPk4Cq9nMNq3PAAAAAElFTkSuQmCC'){
															alert('E-Signatures are required');
															$('#loader_main').hide();
															return false;
														}
														var terms = $('#re_terms_'+<?php echo $hk_info_val->mpor_id;?>).prop('checked');
														if(terms == false){
															alert('Please check Terms and Conditions');
															$('#loader_main').hide();
															return false;
														}
														else{
															var notes		= $('#re_notes_'+<?php echo $hk_info_val->mpor_id;?>).val();
															var formFileRaw	= $('#mpor_reinspt_'+<?php echo $hk_info_val->mpor_id;?>)[0];
															var formFile	= new FormData(formFileRaw);
															let mpor_id = "<?php echo $hk_info_val->mpor_id; ?>"; 
                                                            let inspection_type = $(`input[name="inspection_type_${mpor_id}"]:checked`).val();
															
															formFile.append('mpor_id', <?php echo $hk_info_val->mpor_id;?>);
															formFile.append('notes', notes);
															formFile.append('Esignatures', img_data);
															formFile.append('method_type', 'reinspect');
															formFile.append('inspection_type', inspection_type);
															
															$.ajax({
																url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
																type: "POST",
																data: formFile,
																contentType: false,
																cache: false,
																processData:false,
																success: function(data){
																	location.reload();
																}
															});
															/*var notes		= $('#re_notes_'+<?php echo $hk_info_val->mpor_id;?>).val();
															var data_string = "mpor_id=<?php echo $hk_info_val->mpor_id;?>&notes="+notes+"&Esignatures="+img_data+"&method_type=reinspect";
															$.ajax({
																url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
																type: "POST",
																data: data_string,
																success: function(data){
																	location.reload();
																}
															});*/
														}
													}
												});
											});
											$("#re_btnClearSign_"+<?php echo $hk_info_val->mpor_id;?>).click(function(e){
												$('#re_signArea_'+<?php echo $hk_info_val->mpor_id;?>).signaturePad().clearCanvas();
											});
										</script>
                                        <div id="apr-room-modal-<?php echo $hk_info_val->mpor_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:100999999999999999; top: 30px;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">FINAL ROOM APPROVAL</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post" id="mpor_approve_<?php echo $hk_info_val->mpor_id;?>" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-lg-6"><label class="control-label">Todays Date:</label> <?php echo gmdate('m/d/Y h:i A', strtotime($this->session->userdata['logged_in']['tz'].' hours'));?></div>
                                                                <div class="col-lg-6"><label class="control-label">Approved by:</label> <?php echo ucfirst($this->session->userdata['logged_in']['username']);?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div id="signArea_<?php echo $hk_info_val->mpor_id;?>">
                                                                        <h2 class="tag-ingo">Put signature below*</h2>
                                                                        <div class="sig sigWrapper" style="height:auto;width: 54%;">
                                                                            <div class="typed"></div>
                                                                            <canvas class="sign-pad" id="sign-pad_<?php echo $hk_info_val->mpor_id;?>" width="300" height="100"></canvas>
                                                                        </div>
                                                                        <div class="checkbox checkbox-success">
                                                                            <input id="terms_<?php echo $hk_info_val->mpor_id;?>" type="checkbox" name="terms" value="1">
                                                                            <label><?php echo htmlspecialchars_decode($settings[0]->terms_conditions_hk);?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                	<label class="control-label">Notes:</label>
                                                                    <textarea class="form-control" rows="5" cols="5" id="apr_notes_<?php echo $hk_info_val->mpor_id;?>" name="notes_<?php echo $hk_info_val->mpor_id;?>"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                                                    <h3 class="box-title m-b-0">Attachment</h3>
                                                                    <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                                        <input class="upload" name="file" id="apr_file" accept="image/*;capture=camera" type="file">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    	<button type="button" id="btnSaveSign_<?php echo $hk_info_val->mpor_id;?>" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Approved</button>
                                                        <button type="button" id="btnClearSign_<?php echo $hk_info_val->mpor_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--Ticket Modal -->
                                        <div id="gen-ticket-modal-<?php echo $hk_info_val->mpor_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:100999999999999999; top: 30px;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">MPOR Generate Ticket</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post" id="mpor_gen_ticket_<?php echo $hk_info_val->mpor_id;?>" enctype="multipart/form-data">
                                                            <input type="hidden" id="mpor_id_<?php echo $hk_info_val->mpor_id;?>" name="mpor_id" value="<?php echo $hk_info_val->mpor_id;?>" />
                                                            <input type="hidden" id="room_no_<?php echo $hk_info_val->mpor_id;?>" name="room_no" value="<?php echo $hk_info_val->assign_rooms;?>" />
                                                            <input type="hidden" id="room_type_<?php echo $hk_info_val->mpor_id;?>" name="room_type" value="<?php echo $room_types[0]->room_type;?>" />
                                                            <div class="row">
                                                                <div class="col-lg-6"><label class="control-label">Todays Date:</label> <?php echo gmdate('m/d/Y', strtotime($this->session->userdata['logged_in']['tz'].' hours'));?></div>
                                                                <div class="col-lg-6"><label class="control-label">Created by:</label> <?php echo $this->session->userdata['logged_in']['username'];?></div>
                                                            </div>
                                                            <div class="row m-b-10">
                                                                <div class="col-lg-6"><label class="control-label">Room #:</label> <span id="room_num"><?php echo $hk_info_val->assign_rooms;?></span></div>
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
                                                                        <select class="form-control" id="maintenence_<?php echo $hk_info_val->mpor_id;?>" name="maintenence">
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
                                                                <textarea class="form-control" rows="5" cols="5" id="notes_<?php echo $hk_info_val->mpor_id;?>" name="notes"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-12 p-l-0">Attachment:</label>
                                                            <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                                    <input type="file" accept="image/*;capture=camera" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                                    </div>
                                                                </div>
                											<div class="error_div m-t-10" id="popup_error_<?php echo $hk_info_val->mpor_id;?>"></div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light popup-btn" onclick="mpor_gen_ticket(<?php echo $hk_info_val->mpor_id;?>);">GENERATE TICKET</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <script>
											$(document).ready(function() {
												$('#signArea_'+<?php echo $hk_info_val->mpor_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
											});
											$("#btnSaveSign_"+<?php echo $hk_info_val->mpor_id;?>).click(function(e){
												$('#loader_main').show();
												html2canvas([document.getElementById('sign-pad_'+<?php echo $hk_info_val->mpor_id;?>)], {
													onrendered: function (canvas) {
														var canvas_img_data = canvas.toDataURL('image/png');
														var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
														if(img_data == 'iVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAABj0lEQVR4nO3XsQnDQBBFQfXfnYJTMTrQuQGDlUkPz8DPN3qw2wKI2J4+AOAuwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvI+Bqs8zzNzB7ddV2/gzXnXMdxrH3fzcwe2RhjzTnvBWuM8fjBZva/ux0sL6GZvWG3XkKAtxIsIEOwgAzBAjIEC8gQLCBDsIAMwQIyPk4Cq9nMNq3PAAAAAElFTkSuQmCC'){
															alert('E-Signatures are required');
															$('#loader_main').hide();
															return false;
														}
														var terms = $('#terms_'+<?php echo $hk_info_val->mpor_id;?>).prop('checked');
														if(terms == false){
															alert('Please check Terms and Conditions');
															$('#loader_main').hide();
															return false;
														}
														else{
															var notes		= $('#apr_notes_'+<?php echo $hk_info_val->mpor_id;?>).val();
															var formFileRaw	= $('#mpor_approve_'+<?php echo $hk_info_val->mpor_id;?>)[0];
															var formFile	= new FormData(formFileRaw);
															
															formFile.append('mpor_id', <?php echo $hk_info_val->mpor_id;?>);
															formFile.append('notes', notes);
															formFile.append('Esignatures', img_data);
															formFile.append('method_type', 'approved');
															
															$.ajax({
																url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
																type: "POST",
																data: formFile,
																contentType: false,
																cache: false,
																processData:false,
																success: function(data){
																	location.reload();
																}
															});
														}
													}
												});
											});
											$("#btnClearSign_"+<?php echo $hk_info_val->mpor_id;?>).click(function(e){
												$('#signArea_'+<?php echo $hk_info_val->mpor_id;?>).signaturePad().clearCanvas();
											});
										</script>
                                        <tr>
                                            <td><?php echo $hk_info_val->assign_rooms.' ('.$room_types[0]->room_type.')'; ?></td>
                                            <td>
                                                <?php if($hk_info_val->status == 'Completed' && $hk_info_val->approved == 'Approved') { 
                                                    $username = admin_helper::get_user_name($hk_info_val->assign_to_id); 
                                                    echo ucfirst($username[0]->username);
                                                } else { ?>
                                                    <select onchange="handleEmployeeChange(this)" id="<?php echo $hk_info_val->mpor_id;?>" class="form-control" name="assign_to_id" required>
                                                        <?php if(is_array($house_keeping)){
                                                            foreach($house_keeping as $hk_val){?>
                                                                <option value="<?php echo $hk_val->id;?>" <?php if($hk_info_val->assign_to_id == $hk_val->id){echo 'selected="selected"';}?>><?php if($hk_val->manager_inspector != ''){echo $hk_val->username.' ('.ucfirst($hk_val->manager_inspector).')';}else{echo $hk_val->username;}?></option>
                                                            <?php }}?>
                                                    </select>                                                                                                        
                                                <?php }?>  
                                            </td>
                                            <td>
                                                <div class="radio radio-success m-t-0 m-b-5">
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
                                                <button type="button" data-toggle="modal" data-target=".bs-mpor-notes-<?php echo $hk_info_val->mpor_id;?>" class="btn btn-warning waves-effect waves-light model_img img-responsive">Add Notes<?php if($hk_info_val->notes){echo '**';}?>
                                                </button>
                                            </td>
                                            <td>
                                                <select class="form-control dnd_drpdwn" id="dnd_<?php echo $hk_info_val->mpor_id;?>" required>
                                                    <option value="0" <?php if('0' == $hk_info_val->is_dnd){echo 'selected="selected"';}?>>No</option>
                                                    <option value="1" <?php if('1' == $hk_info_val->is_dnd){echo 'selected="selected"';}?>>Yes</option>
                                                </select>
                                            </td>
                                            
                                            <!-- <td><?php //if($hk_info_val->is_ticket){?><a target="_blank" href="<?php //echo site_url("ticket/ticket_info/").'/'.$hk_info_val->is_ticket;?>">View</a><?php //}else{echo '&mdash;';}?></td> -->
                                            <td><button id="ticket_<?php echo $hk_info_val->mpor_id;?>" type="button" data-toggle="modal" data-target="#gen-ticket-modal-<?php echo $hk_info_val->mpor_id;?>" class="btn btn-warning waves-effect waves-light">Gen. Ticket</button></td>

                                            <td id="startedTime_<?php echo $hk_info_val->mpor_id; ?>"></td>
                                            <td id="completedTime_<?php echo $hk_info_val->mpor_id; ?>"></td>
                                            <td><time id="timerValue_<?php echo $hk_info_val->mpor_id;?>"></time>
                                            </td>
                                            <td><time id="timerValueeee_<?php echo $hk_info_val->mpor_id;?>"></time>
                                            </td>
                                            <?php if($this->session->userdata['logged_in']['role'] == '3'){?>
                                            <td id='action1_<?php echo $hk_info_val->mpor_id;?>'>
                                            </td>
											<?php }else{?>
                                                <td id='action2_<?php echo $hk_info_val->mpor_id;?>'>
                                                </td>
                                            <?php }?>
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
.buttons-pdf{
	margin-left:10px !important;
}
</style>