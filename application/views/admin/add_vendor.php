<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add Vendor</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Add Vendor Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Add Vendor</div>
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
                        <form action="<?php echo base_url();?>vendor_log/add_vendor_info" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                            <h3 class="box-title">Vendor / Company Information</h3><hr class="m-0">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Vendor / Company Name</label>
                                            <input type="text" name="vendor_name" class="form-control" placeholder="Vendor / Company Name" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Company Type</label>
                                            <input type="text" name="vendor_type" class="form-control" placeholder="Company Type" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">CITY, STATE & ZIP</label>
                                            <input type="text" name="vendor_city" class="form-control" placeholder="CITY, STATE & ZIP" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Phone Number</label>
                                            <input type="text" name="vendor_phone" class="form-control" placeholder="Phone Number" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" name="vendor_email" class="form-control" placeholder="Email" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" name="vendor_address" class="form-control" placeholder="Address" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="box-title">Additional Information</h3><hr class="m-0">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Tracking Required</label>
                                            <select class="form-control" name="tracking_req" required>
                                                <option value="0" selected="selected">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Guest Rooms</label>
                                            <select class="form-control" name="guest_room_req" required>
                                                <option value="0" selected="selected">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Public Areas</label>
                                            <select class="form-control" name="public_area" required>
                                                <option value="0" selected="selected">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">What Room Types</label>
                                            <select class="form-control" name="room_types" required>
                                                <option value="0" selected="selected">ALL</option>
                                                <?php foreach($room_types as $room_type){?>
                                                <option value="<?php echo $room_type->room_type; ?>"><?php echo $room_type->room_type; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">What Public Areas</label>
                                            <select class="form-control" name="wt_public_areas" required>
                                                <option value="0" selected="selected">ALL</option>
                                                <?php foreach($areas_list_info as $areas_list){?>
                                                    <option value="<?php echo $areas_list->area_name;?>"><?php echo $areas_list->area_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-2">
                                    	<div class="form-group">
                                        	<label class="control-label"> &nbsp;</label>
                                            <div class="radio radio-success m-t-0 m-b-5">
                                                <input class="room_percent_number" name="room_percent_number" type="radio" value="percentage">
                                                <label>Percentage of rooms</label>
                                            </div>
                                            <div class="radio radio-success m-b-0">
                                                <input class="room_percent_number" name="room_percent_number" type="radio" checked="" value="number">
                                                <label>Number of rooms</label>
                                            </div>
                                     	</div>
                                     </div>
                                    <div class="col-md-2" id="percentage" style="display:none;">
                                        <div class="form-group">
                                            <label class="control-label">Percentage of Rooms</label>
                                            <input type="number" min="1" min="100" name="per_of_rooms" class="form-control" placeholder="% Of Rooms" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="number">
                                        <div class="form-group">
                                            <label class="control-label">How Many Rooms</label>
                                            <input type="number" min="1" min="99" name="num_of_rooms" class="form-control" placeholder="How Many Rooms" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">How Often</label>
                                            <select class="form-control" id="how_often" name="how_often">
                                                <option value="never">Never</option>
                                                <option value="daily">Every day</option>
                                                <option value="every_weekend">Every Weekend</option>
                                                <option value="every_workday">Every Workday</option>
                                                <option value="every_month">Every Month</option>
                                                <option value="every_quarter">Every Quarter</option>
                                                <option value="every_year">Every Year</option>
                                                <!--<option value="dayOfEveryMonth">Day 30 of every month</option>
                                                <option value="every_noOfday">Every last Tuesday</option>
                                                <option value="everyYear">Every April 30</option>
                                                <option value="custom">Custom...</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Time Frame</label>
                                            <select class="form-control" name="time_frame" required>
                                                <option value="1" selected="selected">1 TIME PER DAY</option>
                                                <option value="2">1 PER MONTH</option>
                                                <option value="3">1 EVERY OTHER MONTH</option>
                                                <option value="4">1 PER QUARTER</option>
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