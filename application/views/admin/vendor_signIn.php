<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Vendor Sign-In</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Vendor Sign-In Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Vendor Sign-In</div>
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
							   
								
								/*if(isset($_POST['submit'])){
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
								}*/
                             ?>
                             <!--manage form data-->
                            <form id="vendor_signin_form" action="<?php echo base_url();?>vendor_log/vendor_signIn_info" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <h3 class="box-title"></h3>
                                    <div class="row">
                                    	<div class="col-md-3 p-l-5 p-r-0">
                                            <select class="form-control" name="vendor_list" id="vendor_list" required="required">
                                                <option value="">Vendor / Company Name</option>
                                                <?php if(is_array($vendor_info)){
                                                    foreach($vendor_info as $vendor_list){?>
                                                    <option value="<?php echo $vendor_list->v_id;?>"><?php echo ucfirst($vendor_list->v_name);?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-l-5 p-r-0">
                                        	<input type="text" class="form-control" name="v_rep_name" id="v_rep_name" placeholder="Vendor Representative Name" value="" required="required">
                                        </div>
                                        <div class="col-md-2 p-l-5 p-r-0">
                                            <select class="form-control" name="key_req" id="key_req" required="required">
                                                <option value="">Key Needed?</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 p-l-5 p-r-0" id="available_keys" style="display:none;">
                                            <select class="form-control" name="key_id" id="key_id">
                                                <option value="">Available keys</option>
                                                <?php if(is_array($available_keys)){
                                                    foreach($available_keys as $avail_keys){?>
                                                    <option value="<?php echo $avail_keys->key_id;?>"><?php echo $avail_keys->key_name.' / '.$avail_keys->key_num;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                        	<input type="text" name="time_inn" class="form-control" placeholder="Time In" value="<?php echo gmdate('h:i A', strtotime($this->session->userdata['logged_in']['tz'].' hours')); ?>" required="required" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-md-3 p-l-5 p-r-0">
                                            <h2>Reason for Visit</h2>
                                        	<input type="text" class="form-control" name="reason_of_visit" id="reason_of_visit" placeholder="Reason for Visit" value="" required="required">
                                            <!--<textarea class="form-control" id="notes" name="notes" ></textarea>-->
                                        </div>
                                        <div class="col-md-4">
                                            <div id="signArea">
                                                <h2 class="tag-ingo">Vendor Representative E-Sign</h2>
                                                <div class="sig sigWrapper" style="height:auto;width: 100%;">
                                                    <div class="typed"></div>
                                                    <canvas class="sign-pad" id="sign-pad" width="370" height="100"></canvas>
                                                </div>
                                                <div class="m-t-5">
                                                	<button type="button" id="btnClearSign" class="btn btn-warning waves-effect">Reset Signature</button>
                                                </div>
                                                <!--<div class="checkbox checkbox-success">
                                                    <input id="terms" type="checkbox" name="terms" value="1">
                                                    <label><?php #echo htmlspecialchars_decode($settings[0]->terms_conditions);?></label>
                                                </div>-->
                                            </div>
                                        	<input type="hidden" name="v_r_Esignatures" id="v_r_Esignatures" value="" />											
                                        </div>
                                        <div class="col-md-4">
                                            <div id="signArea_1">
                                                <h2 class="tag-ingo">Hotel Rep Witness E-Sign</h2>
                                                <div class="sig sigWrapper" style="height:auto;width: 100%;">
                                                    <div class="typed"></div>
                                                    <canvas class="sign-pad" id="sign-pad_1" width="370" height="100"></canvas>
                                                </div>
                                                <div class="m-t-5">
                                                	<button type="button" id="btnClearSign_1" class="btn btn-warning waves-effect">Reset Signature</button> 
                                                </div>
                                            </div>
                                        	<input type="hidden" name="h_r_Esignatures" id="h_r_Esignatures" value="" />											
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                        	<button type="button" id="btnSaveSign" class="btn btn-success waves-effect">Save</button> 
                                        </div>
                                        <script>
											$(document).ready(function() {
												$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
												$('#signArea_1').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
											});
											$("#btnSaveSign").click(function(e){
												var vendor 			= $('#vendor_list').val();
												var vendor_rep_name	= $('#v_rep_name').val();
												var key_needed		= $('#key_req').val();
												var key_id			= $('#key_id').val();
												var reason_of_visit	= $('#reason_of_visit').val();
												
												if(vendor){}else{alert('Select any vendor first');return false;}
												if(vendor_rep_name){}else{alert('Vendor rep Name is required');return false;}
												if(key_needed){}else{alert('Select key required or not');return false;}
												if(key_needed == 'yes'){
													if(key_id){}else{alert('Select any key first');return false;}
												}
												if(reason_of_visit){}else{alert('Reason for visit is required');return false;}
												
												html2canvas([document.getElementById('sign-pad')], {
													onrendered: function (canvas) {
														var canvas_img_data = canvas.toDataURL('image/png');
														var img_data 		= canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
														$('#v_r_Esignatures').val(img_data);
													}
												});
												html2canvas([document.getElementById('sign-pad_1')], {
													onrendered: function (canvas) {
														var canvas_img_data2	= canvas.toDataURL('image/png');
														var img_data2 			= canvas_img_data2.replace(/^data:image\/(png|jpg);base64,/, "");
														$('#h_r_Esignatures').val(img_data2);
														$('#vendor_signin_form').submit();
													}
												});
											});
											$("#btnClearSign").click(function(e){$('#signArea').signaturePad().clearCanvas();$('#v_r_Esignatures').val('');});
											$("#btnClearSign_1").click(function(e){$('#signArea_1').signaturePad().clearCanvas();$('#h_r_Esignatures').val('');});
										</script>
                                    </div>
                                </div>
                            </form><hr />
                            <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Vendor</th>
                                        <th>Rep. Name</th>
                                        <th>Key?</th>
                                        <th>Reason</th>
                                        <th>Rep. Sign</th>
                                        <th>H Rep. Sign</th>
                                        <th>Time IN</th>
                                        <th>Time OUT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($time_in_keys)){
                                    foreach($time_in_keys as $val){
										$vendor_name	= admin_helper::get_vendor_name($val->v_id);
										$key_name		= admin_helper::get_key_name($val->key_id);
										$keylog_id		= admin_helper::get_key_status($val->keylog_id);
									?>
                                        <tr>
                                            <td><?php echo $vendor_name[0]->v_name; ?></td>
                                            <td><?php echo $val->v_r_name; ?></td>
                                            <td><?php if($val->key_required == 'no'){echo 'No';}else{echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;}?></td>
                                            <td><?php echo $val->visit_reason;?></td>
                                            <td><?php if($val->v_r_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->v_r_signature;?>" width="120" height="" /><?php }?></td>
                                            <td><?php if($val->h_r_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->h_r_signature;?>" width="120" height="" /><br /><span style="color:red;"><?php echo date('Y-m-d h:i A', strtotime($val->created_date)); ?></span><?php }?></td>
                                            <td><?php echo $val->time_in;?></td>
                                            <td>
											<?php if($val->key_required == 'no'){?>
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#vendor_timeout_<?php echo $val->vsignin_id;?>">TIME OUT</button></td>
                                            <?php }else{
												if($keylog_id[0]->key_status == 'Requested'){?>
													<button type="button" class="btn btn-warning waves-effect waves-light">Waiting for Key Witness</button></td>
												<?php }else{?>
													<button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#vendor_timeout_<?php echo $val->vsignin_id;?>">Return Key</button></td>
                                            <?php }}?>
                                        </tr>
                                        <div id="vendor_timeout_<?php echo $val->vsignin_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" id="myModalLabel">Vendor TIME-OUT</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="vendor_timeout_form_<?php echo $val->vsignin_id;?>" action="<?php echo base_url();?>vendor_log/vendor_signIn_info_timeout" method="post" enctype="multipart/form-data">
                                                            <div class="row m-b-10">
                                                                <div class="col-md-6">
                                                                    <div id="signArea_r_<?php echo $val->vsignin_id;?>">
                                                                        <h2 class="tag-ingo">Vendor Rep E-Sign</h2>
                                                                        <div class="sig sigWrapper" style="height:auto;width: 100%;">
                                                                            <div class="typed"></div>
                                                                            <canvas class="sign-pad" id="sign-pad_r_<?php echo $val->vsignin_id;?>" width="265" height="100"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div id="signArea_h_<?php echo $val->vsignin_id;?>">
                                                                        <h2 class="tag-ingo">Hotel Rep E-Sign</h2>
                                                                        <div class="sig sigWrapper" style="height:auto;width: 100%;">
                                                                            <div class="typed"></div>
                                                                            <canvas class="sign-pad" id="sign-pad_h_<?php echo $val->vsignin_id;?>" width="265" height="100"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row m-b-10">
                                                                <div class="col-md-6">
                                                                    <button type="button" id="btnClearSign_r_<?php echo $val->vsignin_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button" id="btnClearSign_h_<?php echo $val->vsignin_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="vsignin_id" value="<?php echo $val->vsignin_id;?>" />
                                                            <input type="hidden" name="keylog_id" value="<?php echo $val->keylog_id;?>" />
                                                            <input type="hidden" name="key_type" value="returned" />
                                                            <input type="hidden" name="Esignatures_r" id="sigE_r_<?php echo $val->vsignin_id;?>" value="" />
                                                            <input type="hidden" name="Esignatures_h" id="sigE_h_<?php echo $val->vsignin_id;?>" value="" />
                                                            <div class="modal-footer">
                                                                <button type="button" id="btnSaveSign_<?php echo $val->vsignin_id;?>" class="btn btn-success waves-effect"><i class="fa fa-check"></i>TIME-OUT</button>
                                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>                                               
                                                </div>
                                            </div>
                                        </div>
										<script>
											$(document).ready(function() {
												$('#signArea_r_'+<?php echo $val->vsignin_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
												$('#signArea_h_'+<?php echo $val->vsignin_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
											});
											$("#btnSaveSign_"+<?php echo $val->vsignin_id;?>).click(function(e){
												html2canvas([document.getElementById('sign-pad_r_'+<?php echo $val->vsignin_id;?>)], {
													onrendered: function (canvas) {
														var canvas_img_data_r	= canvas.toDataURL('image/png');
														var img_data_r			= canvas_img_data_r.replace(/^data:image\/(png|jpg);base64,/, "");
														$('#sigE_r_'+<?php echo $val->vsignin_id;?>).val(img_data_r);
													}
												});
												html2canvas([document.getElementById('sign-pad_h_'+<?php echo $val->vsignin_id;?>)], {
													onrendered: function (canvas) {
														var canvas_img_data_h	= canvas.toDataURL('image/png');
														var img_data_h 			= canvas_img_data_h.replace(/^data:image\/(png|jpg);base64,/, "");
														$('#sigE_h_'+<?php echo $val->vsignin_id;?>).val(img_data_h);
														$('#vendor_timeout_form_'+<?php echo $val->vsignin_id;?>).submit();
													}
												});
											});
											$("#btnClearSign_r_"+<?php echo $val->vsignin_id;?>).click(function(e){$('#signArea_r_'+<?php echo $val->vsignin_id;?>).signaturePad().clearCanvas();$('#sigE_r_'+<?php echo $val->vsignin_id;?>).val('');});
											$("#btnClearSign_h_"+<?php echo $val->vsignin_id;?>).click(function(e){$('#signArea_h_'+<?php echo $val->vsignin_id;?>).signaturePad().clearCanvas();$('#sigE_h_'+<?php echo $val->vsignin_id;?>).val('');});
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