
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add User</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Add User Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> Add User</div>
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
                         <!--Add users form-->
                        <form action="<?php echo base_url();?>users/add_user_data" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <h3 class="box-title">Person Info</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" value="" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" value="" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                
                                <div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Phone</label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Hotel</label>
                                            <select class="form-control" name="hotel" required>
                                                <option value="">Assign Hotel</option>
                                                <?php foreach($hotels as $hotel){?>
                                                <option value="<?php echo $hotel->hotel_id; ?>"><?php echo $hotel->hotel_name; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <select class="form-control" name="role" required>
                                                <option value="">Role</option>
                                                <?php foreach($roles as $val){?>
                                                <option value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Language</label>
                                            <select class="form-control" id="lang" name="lang">
                                                <option value="en" selected="selected">English</option>
                                                <option value="es">Spanish</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Status</option>
                                                <option value="1" selected="selected">Active</option>
                                                <option value="0">In-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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