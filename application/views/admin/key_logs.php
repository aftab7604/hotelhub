<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Key Logs</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Key Logs Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
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
    
    <?php if(is_array($my_issued_keys)){?>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">MY KEYS</h3>
                    <div class="table-responsive">
                        <table  class="table color-table danger-table">
                            <thead>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>Key/Ring #</th>
                                    <th>Issued Witness</th>
                                    <th>Return Key</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach($my_issued_keys as $my_issued_key){
                                $my_issued_to		= admin_helper::get_user_name($my_issued_key->issued_to);
                                $my_issued_witness	= admin_helper::get_user_name($my_issued_key->issued_witness);
                                $my_key_name		= admin_helper::get_key_name($my_issued_key->key_id);
                            ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $my_key_name[0]->key_num.'--'.$my_key_name[0]->key_name;?></td>
                                    <td><?php echo $my_issued_witness[0]->username;?></td>
                                    <td><button type="button" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target="#my_keys_<?php echo $my_issued_key->keylog_id;?>"><i class="fa fa-check"></i> Return</button></td>
                                </tr>
                                <div id="my_keys_<?php echo $my_issued_key->keylog_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Return Key</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" id="my_keys_form_<?php echo $my_issued_key->keylog_id;?>" action="<?php echo base_url();?>key_log/return_a_key" method="post" enctype="multipart/form-data">
                                                <div class="row m-b-10">
                                                    <div class="col-md-12">
                                                        <div id="signArea_<?php echo $my_issued_key->keylog_id;?>">
                                                            <h2 class="tag-ingo">Put signature below*</h2>
                                                            <div class="sig sigWrapper" style="height:auto;width: 54%;">
                                                                <div class="typed"></div>
                                                                <canvas class="sign-pad" id="sign-pad_<?php echo $my_issued_key->keylog_id;?>" width="300" height="100"></canvas>
                                                            </div>
                                                            <div class="checkbox checkbox-success">
                                                                <input id="terms_<?php echo $my_issued_key->keylog_id;?>" type="checkbox" name="terms" value="1">
                                                                <label><?php echo htmlspecialchars_decode($settings[0]->terms_conditions);?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="keylog_id" value="<?php echo $my_issued_key->keylog_id;?>" />
                                                    <input type="hidden" name="Esignatures" id="sigE_<?php echo $my_issued_key->keylog_id;?>" value="" />
                                                    <button type="button" id="btnSaveSign_<?php echo $my_issued_key->keylog_id;?>" class="btn btn-success waves-effect"><i class="fa fa-check"></i>Return It</button>
													<button type="button" id="btnClearSign_<?php echo $my_issued_key->keylog_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>                                               
                                    </div>
                                </div>
                            </div>
								<script>
                                    $(document).ready(function() {
                                        $('#signArea_'+<?php echo $my_issued_key->keylog_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
                                    });
                                    $("#btnSaveSign_"+<?php echo $my_issued_key->keylog_id;?>).click(function(e){
                                        $('#loader_main').show();
                                        html2canvas([document.getElementById('sign-pad_'+<?php echo $my_issued_key->keylog_id;?>)], {
                                            onrendered: function (canvas) {
                                                var canvas_img_data = canvas.toDataURL('image/png');
                                                var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");//alert(canvas_img_data);
                                                if(img_data == 'iVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAABj0lEQVR4nO3XsQnDQBBFQfXfnYJTMTrQuQGDlUkPz8DPN3qw2wKI2J4+AOAuwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvI+Bqs8zzNzB7ddV2/gzXnXMdxrH3fzcwe2RhjzTnvBWuM8fjBZva/ux0sL6GZvWG3XkKAtxIsIEOwgAzBAjIEC8gQLCBDsIAMwQIyPk4Cq9nMNq3PAAAAAElFTkSuQmCC'){
                                                    alert('E-Signatures are required');
                                                    $('#loader_main').hide();
                                                    return false;
                                                }
                                                var terms = $('#terms_'+<?php echo $my_issued_key->keylog_id;?>).prop('checked');
                                                if(terms == false){
                                                    alert('Please check Terms and Conditions');
                                                    $('#loader_main').hide();
                                                    return false;
                                                }
                                                else{
                                                    $('#sigE_'+<?php echo $my_issued_key->keylog_id;?>).val(img_data);
                                                    $('#my_keys_form_'+<?php echo $my_issued_key->keylog_id;?>).submit();
                                                    $('#loader_main').hide();
                                                }
                                            }
                                        });
                                    });
                                    $("#btnClearSign_"+<?php echo $my_issued_key->keylog_id;?>).click(function(e){
                                        $('#signArea_'+<?php echo $my_issued_key->keylog_id;?>).signaturePad().clearCanvas();
                                    });
                                </script>
							<?php $i++; }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
                            
    <div class="row">
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title m-b-20">Get a Key <p class="text-muted pull-right font-13"><?php echo gmdate('d M, Y', strtotime($this->session->userdata['logged_in']['tz'].' hours')); ?></p></h3>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form id="request_a_key_form" action="<?php echo base_url();?>key_log/request_a_key" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-4 col-xs-4">
                                    <div class="form-group m-b-0">
                                        <label class="control-label">Available Keys List</label>
                                        <select class="form-control" id="key_id" name="key_id" required>
                                            <option value="">-Key/Ring#-</option>
                                            <?php foreach($available_keys as $available_key){?>
                                                <option value="<?php echo $available_key->key_id;?>"><?php echo $available_key->key_num.'--'.$available_key->key_name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                            	</div>
                            	<div class="col-sm-4 col-xs-4">
                                    <div class="form-group m-b-0">
                                        <label>Time Out</label>
                                        <input type="text" name="time_out" class="form-control" placeholder="Time Out" value="<?php echo gmdate('h:i A', strtotime($this->session->userdata['logged_in']['tz'].' hours')); ?>" required="required" readonly="readonly">
                                    </div>
                                </div>
                            	<div class="col-sm-4 col-xs-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="signArea">
                                        <h2 class="tag-ingo">Put signature below*</h2>
                                        <div class="sig sigWrapper" style="height:auto;width: 100%;">
                                            <div class="typed"></div>
                                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="terms" type="checkbox" name="terms" value="1">
                                            <label><?php echo htmlspecialchars_decode($settings[0]->terms_conditions);?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4 p-l-0 p-r-0" style="margin-top:165px;">
                                	<div class="form-group m-b-0">
                                        <label>&nbsp;</label> 
                                        <button type="button" id="btnClearSign" class="btn btn-warning waves-effect">Reset</button> 
                                        <button type="button" class="btn btn-success waves-effect waves-light" id="btnSaveSign"><i class="fa fa-check"></i> Request</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="Esignatures" id="sigE" value="" />
                        </form>
                        <script>
							$(document).ready(function() {
								$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
							});
							$("#btnSaveSign").click(function(e){
								if($('#key_id').val()){}else{alert('Select Key First');return false;}
								$('#loader_main').show();
								html2canvas([document.getElementById('sign-pad')], {
									onrendered: function (canvas) {
										var canvas_img_data = canvas.toDataURL('image/png');
										var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");//alert(canvas_img_data);
										if(img_data == 'iVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAABj0lEQVR4nO3XsQnDQBBFQfXfnYJTMTrQuQGDlUkPz8DPN3qw2wKI2J4+AOAuwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvI+Bqs8zzNzB7ddV2/gzXnXMdxrH3fzcwe2RhjzTnvBWuM8fjBZva/ux0sL6GZvWG3XkKAtxIsIEOwgAzBAjIEC8gQLCBDsIAMwQIyPk4Cq9nMNq3PAAAAAElFTkSuQmCC'){
											alert('E-Signatures are required');
											$('#loader_main').hide();
										}
										var terms = $('#terms').prop('checked');
										if(terms == false){
											alert('Please check Terms and Conditions');
											$('#loader_main').hide();
											return false;
										}
										else{
											$('#sigE').val(img_data);
											$('#request_a_key_form').submit();
											$('#loader_main').hide();
										}
									}
								});
							});
							$("#btnClearSign").click(function(e){
								$('#signArea').signaturePad().clearCanvas();
							});
						</script>
                        <script>
							/*$('#request_a_key').on('click', function(){
								if($('#key_id').val()){
								swal({   
									title: "Are you sure?",   
									text: "",   
									type: "warning",   
									showCancelButton: true,   
									confirmButtonColor: "#DD6B55",   
									confirmButtonText: "Yes, request it!",   
									//closeOnConfirm: false,
									allowOutsideClick: false
								}, function(isConfirm){
									if (isConfirm){
										swal("Returned!", "Waiting For Key Witness", "success");
										$('#request_a_key_form').submit();
									}else{
										swal("Cancelled", "You cancelled it but you can request anytime", "error");
									}
								});
								}else{
									alert('Select Key First');
								}
							});*/
						</script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title">KEYS NOT RETUREND YET</h3>
                <div class="table-responsive">
                    <table id="myTablee" class="table color-table success-table">
                        <thead>
                            <tr>
                                <th>Sr.#</th>
                                <th>Key/Ring #</th>
                                <th>Issued To</th>
                                <th>Issued Witness</th>
                                <th>Key Status</th>
                            </tr>
                        </thead>
                        <tbody id="page_listt">
                            <?php if(is_array($notReturned_keys)){$i=1;foreach($notReturned_keys as $notReturned_key){
									$issued_to		= admin_helper::get_user_name($notReturned_key->issued_to);
									$issued_witness	= admin_helper::get_user_name($notReturned_key->issued_witness);
									$key_name		= admin_helper::get_key_name($notReturned_key->key_id);
									if($notReturned_key->key_status == 'Issued'){$key_status = 'Key Not Returned Yet';}else{$key_status = 'Waiting For Return Witness';}
							?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;?></td>
                                <td><?php echo $issued_to[0]->username;?> <br /> On <span style="color:red;"><?php echo date('Y-m-d h:i A', strtotime($notReturned_key->issued_witness_date));?></span></td>
                                <td><?php #echo $issued_witness[0]->username;?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $notReturned_key->issued_witness_signature;?>" width="130" height="" /></td>
                                <td><?php echo $key_status;?></td>
                            </tr>
                            <?php $i++;}}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title">Today's Pending Keys Requests</h3>
                <div class="table-responsive">
                    <table id="myTablee" class="table color-table danger-table">
                        <thead>
                            <tr>
                                <th>Sr.#</th>
                                <th>Key/Ring #</th>
                                <th>Request By</th>
                                <th>Witness Status</th>
                            </tr>
                        </thead>
                        <tbody id="page_listt">
                            <?php if(is_array($requested_keys)){$i=1;foreach($requested_keys as $requested_key){
									$issued_to	= admin_helper::get_user_name($requested_key->issued_to);
									$key_name	= admin_helper::get_key_name($requested_key->key_id);
							?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;?></td>
                                <td><?php echo $issued_to[0]->username;?><br /> On <span style="color:red;"><?php echo date('Y-m-d h:i A', strtotime($requested_key->created_date));?></span></td>
                                <td><?php if($requested_key->issued_to == $this->session->userdata['logged_in']['id']){
										echo 'Pending';
									}elseif($requested_key->key_status == 'Requested'){
										echo '<button type="button" class="btn btn-warning waves-effect waves-light m-r-10" data-toggle="modal" data-target="#requested_keys_'.$requested_key->keylog_id.'"><i class="fa fa-check"></i> Issue Witness</button>';	
									}elseif($requested_key->key_status == 'Returned'){
										echo '<button type="button" class="btn btn-warning waves-effect waves-light m-r-10" data-toggle="modal" data-target="#returned_keys_'.$requested_key->keylog_id.'"><i class="fa fa-check"></i> Return Witness</button>';	
									}?>
                                </td>
                            </tr>
                            <?php if($requested_key->key_status == 'Requested'){?>
                            <div id="requested_keys_<?php echo $requested_key->keylog_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo $issued_to[0]->username;?> Requested For "<?php echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;?>" key Witness</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" id="requested_keys_form_<?php echo $requested_key->keylog_id;?>" action="<?php echo base_url();?>key_log/witness_a_key" method="post" enctype="multipart/form-data">
                                                <div class="row m-b-10">
                                                    <div class="col-md-12">
                                                        <div id="signArea_<?php echo $requested_key->keylog_id;?>">
                                                            <h2 class="tag-ingo">Put signature below*</h2>
                                                            <div class="sig sigWrapper" style="height:auto;width: 55%;">
                                                                <div class="typed"></div>
                                                                <canvas class="sign-pad" id="sign-pad_<?php echo $requested_key->keylog_id;?>" width="300" height="100"></canvas>
                                                            </div>
                                                            <div class="checkbox checkbox-success">
                                                                <input id="terms_<?php echo $requested_key->keylog_id;?>" type="checkbox" name="terms" value="1">
                                                                <label><?php echo htmlspecialchars_decode($settings[0]->terms_conditions);?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row m-b-10">
                                                    <div class="col-md-12">
                                                        <label for="notes" class="control-label">Description (If any):</label>
                                                        <input type="hidden" name="keylog_id" value="<?php echo $requested_key->keylog_id;?>" />
                                                        <input type="hidden" name="key_type" value="request" />
                                                        <input type="hidden" name="Esignatures" id="sigE_<?php echo $requested_key->keylog_id;?>" value="" />
                                                        <textarea class="form-control notes" id="notes_<?php echo $requested_key->keylog_id;?>" name="notes" rows="5" cols="60"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row m-b-10">
                                                    <div class="col-md-12">
                                                        <label class="col-sm-12 p-l-0">Attachment (If any):</label>
                                                        <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                            <input type="file" accept="image/*;capture=camera" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="btnSaveSign_<?php echo $requested_key->keylog_id;?>" class="btn btn-success waves-effect"><i class="fa fa-check"></i>Become Witness</button>
													<button type="button" id="btnClearSign_<?php echo $requested_key->keylog_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>                                               
                                    </div>
                                </div>
                            </div>
                            <script>
								$(document).ready(function() {
									$('#signArea_'+<?php echo $requested_key->keylog_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
								});
								$("#btnSaveSign_"+<?php echo $requested_key->keylog_id;?>).click(function(e){
									$('#loader_main').show();
									html2canvas([document.getElementById('sign-pad_'+<?php echo $requested_key->keylog_id;?>)], {
										onrendered: function (canvas) {
											var canvas_img_data = canvas.toDataURL('image/png');
											var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");//alert(canvas_img_data);
											if(img_data == 'iVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAABj0lEQVR4nO3XsQnDQBBFQfXfnYJTMTrQuQGDlUkPz8DPN3qw2wKI2J4+AOAuwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvI+Bqs8zzNzB7ddV2/gzXnXMdxrH3fzcwe2RhjzTnvBWuM8fjBZva/ux0sL6GZvWG3XkKAtxIsIEOwgAzBAjIEC8gQLCBDsIAMwQIyPk4Cq9nMNq3PAAAAAElFTkSuQmCC'){
												alert('E-Signatures are required');
												$('#loader_main').hide();
												return false;
											}
											var terms = $('#terms_'+<?php echo $requested_key->keylog_id;?>).prop('checked');
											if(terms == false){
												alert('Please check Terms and Conditions');
												$('#loader_main').hide();
												return false;
											}
											else{
												$('#sigE_'+<?php echo $requested_key->keylog_id;?>).val(img_data);
												$('#requested_keys_form_'+<?php echo $requested_key->keylog_id;?>).submit();
												$('#loader_main').hide();
											}
										}
									});
								});
								$("#btnClearSign_"+<?php echo $requested_key->keylog_id;?>).click(function(e){
									$('#signArea_'+<?php echo $requested_key->keylog_id;?>).signaturePad().clearCanvas();
								});
							</script>
                            <?php }?>
                            <?php if($requested_key->key_status == 'Returned'){?>
							<div id="returned_keys_<?php echo $requested_key->keylog_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Request For "<?php echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;?>" key Returned Witness</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" id="requested_keys_form_<?php echo $requested_key->keylog_id;?>" action="<?php echo base_url();?>key_log/witness_a_key" method="post" enctype="multipart/form-data">
                                                <div class="row m-b-10">
                                                    <div class="col-md-12">
                                                        <!--<label for="notes" class="control-label">Description (If any):</label>-->
                                                        <div id="signArea_<?php echo $requested_key->keylog_id;?>">
                                                            <h2 class="tag-ingo">Put signature below*</h2>
                                                            <div class="sig sigWrapper" style="height:auto;width: 55%;">
                                                                <div class="typed"></div>
                                                                <canvas class="sign-pad" id="sign-pad_<?php echo $requested_key->keylog_id;?>" width="300" height="100"></canvas>
                                                            </div>
                                                            <div class="checkbox checkbox-success">
                                                                <input id="terms_<?php echo $requested_key->keylog_id;?>" type="checkbox" name="terms" value="1">
                                                                <label><?php echo htmlspecialchars_decode($settings[0]->terms_conditions);?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row m-b-10">
                                                    <div class="col-md-12">
                                                        <label for="notes" class="control-label">Description (If any):</label>
                                                        <input type="hidden" name="keylog_id" value="<?php echo $requested_key->keylog_id;?>" />
                                                        <input type="hidden" name="key_type" value="returned" />
                                                        <input type="hidden" name="Esignatures" id="sigE_<?php echo $requested_key->keylog_id;?>" value="" />
                                                        <textarea class="form-control notes" id="notes_<?php echo $requested_key->keylog_id;?>" name="notes" rows="5" cols="60"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row m-b-10">
                                                    <div class="col-md-12">
                                                        <label class="col-sm-12 p-l-0">Attachment (If any):</label>
                                                        <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                            <input type="file" accept="image/*;capture=camera" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="btnSaveSign_<?php echo $requested_key->keylog_id;?>" class="btn btn-success waves-effect"><i class="fa fa-check"></i>Become Witness</button>
													<button type="button" id="btnClearSign_<?php echo $requested_key->keylog_id;?>"  class="btn btn-warning waves-effect">Reset Signature</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>                                               
                                    </div>
                                </div>
                            </div>
							<script>
								$(document).ready(function() {
									$('#signArea_'+<?php echo $requested_key->keylog_id;?>).signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
								});
								$("#btnSaveSign_"+<?php echo $requested_key->keylog_id;?>).click(function(e){
									$('#loader_main').show();
									html2canvas([document.getElementById('sign-pad_'+<?php echo $requested_key->keylog_id;?>)], {
										onrendered: function (canvas) {
											var canvas_img_data = canvas.toDataURL('image/png');
											var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");//alert(canvas_img_data);
											if(img_data == 'iVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAABj0lEQVR4nO3XsQnDQBBFQfXfnYJTMTrQuQGDlUkPz8DPN3qw2wKI2J4+AOAuwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvIECwgQ7CADMECMgQLyBAsIEOwgAzBAjIEC8gQLCBDsIAMwQIyBAvI+Bqs8zzNzB7ddV2/gzXnXMdxrH3fzcwe2RhjzTnvBWuM8fjBZva/ux0sL6GZvWG3XkKAtxIsIEOwgAzBAjIEC8gQLCBDsIAMwQIyPk4Cq9nMNq3PAAAAAElFTkSuQmCC'){
												alert('E-Signatures are required');
												$('#loader_main').hide();
											}
											var terms = $('#terms_'+<?php echo $requested_key->keylog_id;?>).prop('checked');
											if(terms == false){
												alert('Please check Terms and Conditions');
												$('#loader_main').hide();
												return false;
											}
											else{
												$('#sigE_'+<?php echo $requested_key->keylog_id;?>).val(img_data);
												$('#requested_keys_form_'+<?php echo $requested_key->keylog_id;?>).submit();
												$('#loader_main').hide();
											}
										}
									});
								});
								$("#btnClearSign_"+<?php echo $requested_key->keylog_id;?>).click(function(e){
									$('#signArea_'+<?php echo $requested_key->keylog_id;?>).signaturePad().clearCanvas();
								});
							</script>
                            <?php }?>
                            <?php $i++;}}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title">Key Log Summary</h3>
                <div class="table-responsive">
                    <table id="myTablee" class="table color-table success-table">
                        <thead>
                            <tr>
                                <th>Sr.#</th>
                                <th>Key/Ring #</th>
                                <th>Issued To</th>
                                <th>Issued Witness</th>
                                <th>Returned Witness</th>
                            </tr>
                        </thead>
                        <tbody id="page_listt">
                            <?php if(is_array($issued_keys)){$i=1;foreach($issued_keys as $issued_key){
									$issued_to		= admin_helper::get_user_name($issued_key->issued_to);
									$issued_witness	= admin_helper::get_user_name($issued_key->issued_witness);
									if($issued_key->returned_by != 0){
										$return_witness	= admin_helper::get_user_name($issued_key->returned_by);
										$return_witness	= $return_witness[0]->username;
									}else{
										$return_witness	= 'Not Returned Yet!';
									}
									$key_name		= admin_helper::get_key_name($issued_key->key_id);
							?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;?></td>
                                <td><?php echo $issued_to[0]->username;?><br /> On <span style="color:red;"><?php echo date('Y-m-d h:i A', strtotime($issued_key->issued_witness_date));?></span></td>
                                <td><?php #echo $issued_witness[0]->username;?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $issued_key->issued_witness_signature;?>" width="150" height="" /></td>
                                <td><?php echo $return_witness;?>
                            </tr>
                            <?php $i++;}}?>
                        </tbody>
                    </table>
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
#page_list tr:hover {
    cursor: move;
}
.input-group-btn select {
	border-color: #ccc;
	margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 7px;
    padding-bottom: 7px;
}
</style>