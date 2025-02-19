
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Reservations</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Reservations Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Manage Reservations</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="white-box">
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
                             <!--manage users-->
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Guest Name</th>
                                            <th>Guest Email</th>
                                            <th>Phone</th>
                                            <th>Room Type</th>
                                            <th>Arrival Date</th>
                                            <th>Depart Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php if(is_array($reservations)){
										foreach($reservations as $val){?>
                                            <tr>
                                                <td><?php echo $val->guest_name; ?></td>
                                                <td><?php echo $val->guest_email; ?></td>
                                                <td><?php echo $val->guest_phone; ?></td>
                                                <td><?php echo $val->room_type; ?></td>
                                                <td><?php echo $val->arrival_date; ?></td>
                                                <td><?php echo $val->depart_date; ?></td>
                                                <td><a href="<?php echo base_url();?>reservations/confirm_reservation/<?php echo $val->f_r_id;?>"><button type="button" class="btn btn-success waves-effect waves-light"><?php if($val->status == '1'){echo 'Confirmed';}else{echo 'Pending';}?></button></a></td>
                                                <td><a href="<?php echo base_url();?>reservations/delete_reservation/<?php echo $val->f_r_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
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