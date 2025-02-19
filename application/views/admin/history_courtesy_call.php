<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">History</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">History Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">History</div>
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
                             <form action="<?php echo base_url();?>welcome_call/history" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <h3 class="box-title"></h3>
                                    <div class="row">
                                        <div class="col-md-3 p-l-20">
                                            <div class="form-group has-errorr">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker1" id="datetimepicker-history" name="history_date" placeholder="Filter Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php #if(is_array($history) && !empty($history)){?>
                            <div class="table-responsive">
                                <table id="myTableLead" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Guest Name</th>
                                            <th>Room #</th>
                                            <th>Check-In</th>
                                            <th>Call Back</th>
                                            <th>GWC Type</th>
                                            <th>Ticket Link</th>
                                            <th>Notes</th>
                                            <th>Initials</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                  
                                    	<?php if(is_array($history) && !empty($history)){
										foreach($history as $val){
											$numbers = explode(',', $val->ticket_id);											
											$links = '';
											if($val->dual_ticket == 'yes'){
												if($numbers['0'] > 0 && $numbers['1'] > 0){													
													$links = '<a target="_blank" href="http://www.hotelgss.com/ticket/ticket_info/'.$numbers['0'].'">Ticket 1</a>'.' | '.'<a target="_blank" href="http://www.hotelgss.com/ticket/ticket_info/'.$numbers['1'].'">Ticket 2</a>';
												}
											}else{
												if($numbers['0'] > 0){
													$links = '<a target="_blank" href="http://www.hotelgss.com/ticket/ticket_info/'.$numbers['0'].'">Ticket 1</a>';
												}
											}
											?>
                                            <tr>
                                                <td><?php echo date("Y-m-d", strtotime($val->created_date));?></td>
                                                <td><?php echo $val->guest_name; ?></td>
                                                <td><?php echo $val->room_no; ?></td>
                                                <td><?php echo $val->time_in; ?></td>
                                                <td><?php echo $val->call_back; ?></td>
                                                <td><?php if($val->call_type == 'email'){echo ucfirst($val->call_type);}else{echo $val->rating_points.' Scores';} ?></td>
                                                <td><?php if($val->ticket_type != ''){echo $links;}else{echo 'Ticket was not required';}?></td>
                                                <td><?php echo htmlspecialchars_decode($val->pm_notes); ?></td>
                                                <td><?php echo $val->initals;?></td>
                                            </tr>
                                        <?php }}?>
                                    </tbody>
                                </table>
                            </div>
                            <?php #}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>