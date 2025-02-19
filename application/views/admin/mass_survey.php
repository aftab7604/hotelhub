<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Mass Survey Upload</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Mass Survey Upload Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Mass Survey Upload</div>
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
								
								if(isset($_POST['submit'])){
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
								}
                             ?>
                             <!--manage form data-->
                            <form action="<?php echo base_url();?>guest_survey/upload_survey" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <h3 class="box-title"></h3>
                                    <div class="row">
                                    	<div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-sm-12 p-l-0">Attachment:</label>
                                                <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="file" multiple required="required"> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="col-sm-12 p-l-0">&nbsp;</label>
                                            <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> UPLOAD</button>
                                        </div>
                                    	<div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-12 p-l-0">&nbsp;</label>
                                                <div class="col-sm-12">
                                                    <a href="<?php echo base_url();?>assets/images/mass_files/demo.csv">Download Demo CSV File</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form><hr />
								<div class="table-responsive">
                                    <table id="myTableMASSSURVEY" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>code</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>EMail</th>
                                                <th>Phone</th>
                                                <th>Arrival</th>
                                                <th>Departure</th>
                                                <th>Member Level</th>
                                                <th>Member#</th>
                                                <th>Room#</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                    
											<?php if(is_array($survey_info)){
                                            foreach($survey_info as $val){?>
                                                <tr>
                                                    <td><?php echo date('Y-m-d', strtotime($val->created_date));?></td>
                                                    <td><?php echo $val->unique_code; ?></td>
                                                    <td><?php echo $val->first_name; ?></td>
                                                    <td><?php echo $val->last_name; ?></td>
                                                    <td><?php echo $val->email; ?></td>
                                                    <td><?php echo $val->phone; ?></td>
                                                    <td><?php echo $val->arrival; ?></td>
                                                    <td><?php echo $val->departure; ?></td>
                                                    <td><?php echo $val->member_level; ?></td>
                                                    <td><?php echo $val->member_no; ?></td>
                                                    <td><?php echo $val->room_no; ?></td>
                                                    <td>
                                                    <button type="button" data-toggle="modal" data-target="#edit_mass_survey_<?php echo $val->m_id;?>" class="btn btn-success waves-effect waves-light model_img img-responsive"><i class="fa fa-pencil"></i></button> 
                                                        <a href="<?php echo base_url();?>guest_survey/delete_survey/<?php echo $val->m_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
                                                </tr>
                                                <div id="edit_mass_survey_<?php echo $val->m_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myModalLabel">Edit Mass Survey</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" id="mass_survey_form_<?php echo $val->m_id;?>" action="<?php echo base_url();?>guest_survey/edit_survey_info" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="notes" class="control-label">First Name:</label>
                                                                            <input type="text" class="form-control" name="first_name" placeholder="First name is required" value="<?php echo $val->first_name;?>" required="required" />
                                                                            <input type="hidden" name="m_id" value="<?php echo $val->m_id;?>" />
                                                                        </div>
                                                                        <div class="col-md-6 p-l-0">
                                                                            <label for="notes" class="control-label">Last Name:</label>
                                                                            <input type="text" class="form-control" name="last_name" placeholder="Last name is required" value="<?php echo $val->last_name;?>" required="required" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="notes" class="control-label">Email:</label>
                                                                            <input type="text" class="form-control" name="email" placeholder="Email is required" value="<?php echo $val->email;?>" required="required" />
                                                                        </div>
                                                                        <div class="col-md-6 p-l-0">
                                                                            <label for="notes" class="control-label">Phone:</label>
                                                                            <input type="text" class="form-control" name="phone" placeholder="Phone number is required" value="<?php echo $val->phone;?>" required="required" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="notes" class="control-label">Arrival:</label>
                                                                            <input type="text" class="form-control" name="arrival" placeholder="Arrival is required" value="<?php echo $val->arrival;?>" required="required" />
                                                                        </div>
                                                                        <div class="col-md-6 p-l-0">
                                                                            <label for="notes" class="control-label">Departure:</label>
                                                                            <input type="text" class="form-control" name="departure" placeholder="Departure is required" value="<?php echo $val->departure;?>" required="required" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="notes" class="control-label">Member Level:</label>
                                                                            <input type="text" class="form-control" name="member_level" placeholder="Member Level is required" value="<?php echo $val->member_level;?>" required="required" />
                                                                        </div>
                                                                        <div class="col-md-6 p-l-0">
                                                                            <label for="notes" class="control-label">Member No.:</label>
                                                                            <input type="text" class="form-control" name="member_no" placeholder="Member No is required" value="<?php echo $val->member_no;?>" required="required" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="notes" class="control-label">Room Number:</label>
                                                                            <input type="text" class="form-control" name="room_no" placeholder="Room Number is required" value="<?php echo $val->room_no;?>" required="required" />
                                                                        </div>
                                                                        <div class="col-md-6 p-l-0"></div>
                                                                    </div>
                                                                    <div class="row m-b-10">
                                                                        <div class="col-md-12">
                                                                            <label for="notes" class="control-label">Comments:</label>
                                                                            <textarea class="form-control notes" id="notes_<?php echo $val->m_id;?>" name="notes" rows="5" cols="60"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Save</button>
                                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>                                               
                                                        </div>
                                                    </div>
                                                </div>
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