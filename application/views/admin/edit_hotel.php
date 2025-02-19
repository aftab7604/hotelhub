
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Update Hotel</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Update Hotel Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> Update Hotel</div>
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
						 ?><!--Edit form-->
                        <form action="<?php echo base_url();?>hotel/edit_hotel_info" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <h3 class="box-title">Person Info</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Hotel Name</label>
                                            <input type="text" id="hotelname" name="hotelname" class="form-control" placeholder="Hotel Name" value="<?php echo $hotel[0]->hotel_name;?>" required>
                                            <input type="hidden" name="user_id" value="<?php echo $hotel[0]->hotel_id;?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Number of rooms</label>
                                            <input type="text" id="rooms" name="rooms" class="form-control" placeholder="NUmber of rooms" value="<?php echo $hotel[0]->no_of_rooms;?>" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $hotel[0]->email;?>" required></div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Phone</label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="<?php echo $hotel[0]->phone;?>" required></div>
                                    </div>
                                    <!--/span-->
                                </div>
                                
                                <div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">City</label>
                                            <input type="text" id="city" name="city" class="form-control" placeholder="Your city name" value="<?php echo $hotel[0]->city;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">State</label>
                                            <input type="text" id="state" name="state" class="form-control" placeholder="State" value="<?php echo $hotel[0]->state;?>" required></div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Zip Code</label>
                                            <input type="text" id="zipcode" name="zipcode" class="form-control" placeholder="Zip Code" value="<?php echo $hotel[0]->zipcode;?>" required></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">Website</label>
                                            <input type="text" id="website" name="website" class="form-control" placeholder="Website" value="<?php echo $hotel[0]->website;?>" ></div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group has-errorr">
                                            <label class="control-label">TimeZone</label>
                                            <input type="text" id="timezone" name="timezone" class="form-control" placeholder="Time Zone" value="<?php echo $hotel[0]->timezone;?>" required>
                                            <small>Time Zone should be like: +5 or -2 or 4</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Status</option>
                                                <option value="1" <?php if($hotel[0]->status == '1'){echo 'selected="selected"';}?>>Active</option>
                                                <option value="0" <?php if($hotel[0]->status == '0'){echo 'selected="selected"';}?>>In-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <textarea class="form-control" name="address" id="address" rows="5"><?php echo $hotel[0]->address;?></textarea>
                                        </div>
                                    </div>
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