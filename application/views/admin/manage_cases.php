<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Cases</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Cases Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Manage Cases</div>
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
                             ?>
                             <!--manage form data-->
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hotel Name</th>
                                            <th>Complaint By</th>
                                            <th>Subject</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php if(is_array($complaints)){
										foreach($complaints as $val){?>
                                            <div class="modal fade bs-view-case-<?php echo $val->c_id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myLargeModalLabel">Full View Support Case</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-3"><b>Date Created:</b></div>
                                                                    <div class="col-md-9"><?php echo date("m-d-Y", strtotime($val->created_date));?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3"><b>Created By:</b></div>
                                                                    <div class="col-md-9"><?php $rolename = admin_helper::get_user_name($val->user_id); echo $rolename[0]->username;?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3"><b>Subject:</b></div>
                                                                    <div class="col-md-9"><?php echo $val->subject;?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3"><b>Description:</b></div>
                                                                    <div class="col-md-9"><?php echo $val->details;?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3"><b>Attachment:</b></div>
                                                                    <div class="col-md-9">
                                                                        <?php if($val->filename){?>
                                                                            <img src="<?php echo base_url();?>assets/images/complaint_images/<?php echo $val->filename;?>" width="300" />
                                                                         <?php }?>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="modal fade bs-update-case-<?php echo $val->c_id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myLargeModalLabel">Update Support Case</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                        	<form action="" method="post" id="case_status" enctype="multipart/form-data">
                                                        		<div class="row">
        														<div class="col-md-3"><b>Status:</b></div>
        														<div class="col-md-3">
                                                                	<select class="form-control" id="status_<?php echo $val->c_id;?>" name="status" required>
                                                                        <option value="">Status</option>
                                                                        <option value="0" selected="selected">Active</option>
                                                                        <option value="2">In-Progress</option>
                                                                        <option value="3">In-Future</option>
                                                                        <option value="4">Pending</option>
                                                                        <option value="1">Completed</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success waves-effect text-left" onclick="saveCaseStatus('<?php echo $val->c_id;?>','<?php echo $val->user_id;?>');">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td><?php if($val->hotel_id == 0){echo 'Case added by Super Admin!';}else{$hotel_name = admin_helper::get_hotel_name($val->hotel_id); echo $hotel_name[0]->hotel_name;}?></td>
                                                <td><?php $rolename = admin_helper::get_user_name($val->user_id); echo $rolename[0]->username;?></td>
                                                <td><?php echo $val->subject;?></td>
                                                <td><?php echo date("m/d/Y h:i", strtotime($val->created_date));?></td>
                                                <td><?php if($val->status == '0'){echo 'Active';}elseif($val->status == '1'){echo 'Completed';}elseif($val->status == '2'){echo 'In-Progress';}elseif($val->status == '3'){echo 'In-Future';}elseif($val->status == '4'){echo 'Pending';}else{echo 'In-Active';}?></td>
                                                <td><button type="button" data-toggle="modal" data-target=".bs-view-case-<?php echo $val->c_id;?>" class="btn btn-success waves-effect waves-light"><i class="fa fa-eye"></i></button>
                                                	<button type="button" data-toggle="modal" data-target=".bs-update-case-<?php echo $val->c_id;?>" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i></button>
                                                	<a href="<?php echo base_url();?>support/delete_case/<?php echo $val->c_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
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