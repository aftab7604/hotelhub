
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Hotels</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Hotels Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Manage Hotels</div>
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
                                            <th>Rooms</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php if(is_array($hotels)){
										foreach($hotels as $val){?>
                                            <tr>
                                                <td><?php echo $val->hotel_name; ?></td>
                                                <td><?php echo $val->no_of_rooms; ?></td>
                                                <td><?php echo $val->email;?></td>
                                                <td><?php echo $val->phone;?></td>
                                                <td><?php if($val->status == '1'){echo 'Active';}else{echo 'In-Active';}?></td>
                                                <td><a href="<?php echo base_url();?>hotel/edit_hotel/<?php echo $val->hotel_id;?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></button></a> 
                                                	<a href="<?php echo base_url();?>hotel/delete_hotel/<?php echo $val->hotel_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
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