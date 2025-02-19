
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">GSS Settings</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">GSS Setting Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading box-title">GSS Initial Settings</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
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
                         <!--Add hotel form-->
                        <form action="<?php echo base_url();?>settings/save_settings" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                            	<?php if(is_array($settings)){foreach($settings as $settings_val){?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Checklist Complete Percentage</label>
                                                <?php if($settings_val->percentage > 0){?>
                                                    <input type="text" id="percentage" name="percentage" class="form-control" placeholder="Checklist Complete Percentage" value="<?php echo $settings_val->percentage;?>" required>
                                                <?php }else{?>
                                                    <input type="text" id="percentage" name="percentage" class="form-control" placeholder="Checklist Complete Percentage" value="1" required>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Email Address</label>
                                                <input type="email" id="email_add" name="email_add" class="form-control" placeholder="Email Address" value="<?php echo $settings_val->email_add;?>" required>
                                                <small>Only G-Mail Email Address is valid</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Email Password</label>
                                                <input type="password" id="email_pass" name="email_pass" class="form-control" placeholder="Password" value="">
                                                <input type="hidden" name="email_pass_hdn" value="<?php echo $settings_val->email_pass;?>">
                                                <small>Leave Password blank if you don't wanna update the password</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Email From Label</label>
                                                <input type="text" name="from_email_label" class="form-control" placeholder="Email From Label" value="<?php echo $settings_val->from_label;?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-sm-12 p-l-0">Logo For Mass Survey Email:</label>
                                                <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="file_email_logo" > </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                <input type="hidden" name="hdn_email_logo" value="<?php echo $settings_val->email_logo;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Panic Button:</label>
                                                <select class="form-control" name="panic_btn" required>
                                                    <option value="">Display Panic Button</option>
                                                    <option value="1" <?php if($settings_val->panic_btn == '1'){echo 'selected="selected"';}?>>Yes</option>
                                                    <option value="0" <?php if($settings_val->panic_btn == '0'){echo 'selected="selected"';}?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Checkout Stayover -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Checkouts/Stayover:</label>
                                                <div class="radio radio-success">
                                                    <input class="chk_sty_edit" name="chk_sty_setting" value="checkout" type="radio" checked>
                                                    <label>Checkout</label>
                                                </div>
                                                <div class="radio radio-success">
                                                    <input class="chk_sty_edit" name="chk_sty_setting" value="stayover" type="radio">
                                                    <label>Stayover</label>
                                                </div>
                                            </div>
										</div>
                                        <!-- Room Type -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Room Type:</label>
                                                <select class="form-control" name="room_type" id="room_type" required>
                                                    <option value="">Select Room Type</option>
                                                    <?php foreach($room_types as $room_type){?>
                                                    <option value="<?php echo $room_type->room_type; ?>"><?php echo $room_type->room_type; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Goal Time -->
                                        <div class="col-md-3" id="valid_time_container" style="display: none;">
                                            <div class="form-group">
                                                <label class="control-label">Goal Time (HH:MM):</label>
                                                <div class="d-flex">
                                                    <input type="number" name="hours" class="form-control" id="valid_hours" placeholder="Hours" min="0" max="23">
                                                    <input type="number" name="minutes" class="form-control" id="valid_minutes" placeholder="Minutes" min="0" max="59">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                    	<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Terms & Conditions for e-Signature (Key-Log Module)</label>
                                                <textarea class="form-control notes" name="terms" rows="5" cols="60"><?php echo $settings_val->terms_conditions;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Terms & Conditions for e-Signature (House-Keeping Module)</label>
                                                <textarea class="form-control notes" name="terms_hk" rows="5" cols="60"><?php echo $settings_val->terms_conditions_hk;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php }}?>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?php echo base_url();?>"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     $('#room_type').on('change', function() {
        var selectedRoom = $('#room_type').val();
        var chkStySetting = $('input[name="chk_sty_setting"]:checked').val(); // Get selected checkout/stayover

        if (selectedRoom && chkStySetting) {
            // Fetch goal time from the database
            $.ajax({
                url: "<?php echo site_url('settings/fetch_goal_time'); ?>",
                type: "POST",
                data: { 
                    room_type: selectedRoom,
                    chk_sty_setting: chkStySetting
                },
                dataType: "json",
                success: function(response) {
                    if (response.goal_time) {
                        var timeParts = response.goal_time.split(":");
                        $('#valid_hours').val(timeParts[0]);
                        $('#valid_minutes').val(timeParts[1]);
                    } else {
                        $('#valid_hours').val('');
                        $('#valid_minutes').val('');
                    }

                    $('#valid_time_container').show(); // Show the input fields
                }
            });

        } else {
            $('#valid_time_container').hide(); // Hide the input fields if no selection
        }
    });   
</script> 