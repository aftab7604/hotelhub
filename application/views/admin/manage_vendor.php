
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Vendor</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Vendor Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Manage Vendor</div>
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
                                            <th>Vendor Name</th>
                                            <th>Company Type</th>
                                            <th>City/State</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php if(is_array($vendor_info)){
										foreach($vendor_info as $val){?>
                                            <tr>
                                                <td><?php echo $val->v_name; ?></td>
                                                <td><?php echo $val->company_type; ?></td>
                                                <td><?php echo $val->v_city;?></td>
                                                <td><?php echo $val->v_email;?></td>
                                                <td><?php echo $val->v_phone;?></td>
                                                <td><a href="<?php echo base_url();?>vendor_log/edit_vendor/<?php echo $val->v_id;?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></button></a> 
                                                	<a href="<?php echo base_url();?>vendor_log/delete_vendor/<?php echo $val->v_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
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