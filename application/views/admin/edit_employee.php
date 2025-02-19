
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Update Employee</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Update Employee Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> Update Employee</div>
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
						 ?>
                         <!--Edit emp form-->
                        <form action="<?php echo base_url();?>users/edit_employee_info" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <h3 class="box-title">Person Info</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" value="<?php echo $users[0]->first_name;?>" required>
                                            <input type="hidden" name="user_id" value="<?php echo $users[0]->id;?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" value="<?php echo $users[0]->last_name;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo $users[0]->username;?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $users[0]->email;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Phone</label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="<?php echo $users[0]->phone;?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="">
                                            <input type="hidden" name="pass" value="<?php echo $users[0]->pass;?>">
                                            <span class="help-block"> Leave blank if you don't wanna update the existing password. </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Language</label>
                                            <select class="form-control" id="lang" name="lang">
                                                <option value="en" <?php if($users[0]->lang == 'en'){echo 'selected="selected"';}?>>English</option>
                                                <option value="es" <?php if($users[0]->lang == 'es'){echo 'selected="selected"';}?>>Spanish</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <select class="form-control" id="employee_role" name="role" required>
                                                <option value="">Role</option>
                                                <?php foreach($roles as $val){?>
                                                <option value="<?php echo $val->id; ?>" <?php if($users[0]->role == $val->id){echo 'selected="selected"';}?>><?php echo $val->name; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Status</option>
                                                <option value="1" <?php if($users[0]->status == '1'){echo 'selected="selected"';}?>>Active</option>
                                                <option value="0" <?php if($users[0]->status == '0'){echo 'selected="selected"';}?>>In-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                    	<div class="form-group">
                                            <label class="col-sm-12 p-l-0">Attachment:</label>
                                            <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                <input type="file" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                <input type="hidden" name="hdn_profile_pic" value="<?php echo $users[0]->logo;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4"><?php if($users[0]->logo){echo '<img src="'.base_url().'/assets/images/user_profile_images/'.$users[0]->logo.'" width="150"/>';}?></div>
                                    <div class="col-md-4"></div>
                                </div>
                                <?php if($users[0]->manager_inspector != ''){$show = 'block';}else{$show = 'none';}?>
                                <div class="row" id="second_dv" style="display:<?php echo $show;?>;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Manager/Inspector</label>
                                            <select class="form-control" name="manager_inspector">
                                                <option value="">Select Manager or Inspector</option>
                                                <option value="manager"   <?php if($users[0]->manager_inspector == 'manager'){echo 'selected="selected"';}?>>Manager</option>
                                                <option value="inspector" <?php if($users[0]->manager_inspector == 'inspector'){echo 'selected="selected"';}?>>Inspector</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?php echo base_url();?>users/manage_users"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>