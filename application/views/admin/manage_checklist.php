<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Checklist</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Checklist Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Manage Checklist</div>
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
                             ?><!--checklist-->
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hotel Name</th>
                                            <th>Room Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php if(is_array($checklists)){
										foreach($checklists as $val){?>
                                            <tr>
                                                <td><?php $hotelname = admin_helper::get_hotel_name($val->hotel_id); 
                                                if(isset($hotelname[0]->hotel_name)) {
                                                    echo $hotelname[0]->hotel_name;
                                                } else {
                                                    echo '';
                                                }?></td>
                                                <td><?php echo $val->room_type; ?></td>
                                                <td><?php if($val->status == '1'){echo 'Active';}else{echo 'In-Active';}?></td>
                                                <td><a href="<?php echo base_url();?>pmp/view_checklist/<?php echo $val->clt_id;?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-eye"></i></button></a> 
                                                	<a href="<?php echo base_url();?>pmp/toggle_checklist/<?php echo $val->clt_id;?>">
                                                        <button type="button" class="btn waves-effect waves-light 
                                                            <?php echo ($val->status == '1') ? 'btn-danger' : 'btn-success'; ?>">
                                                            <i class="<?php echo ($val->status == '1') ? 'fa fa-times' : 'fa fa-check'; ?>"></i>
                                                        </button>
                                                    </a></td>
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