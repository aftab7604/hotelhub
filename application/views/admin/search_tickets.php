<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Search Tickets</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Search Tickets Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Search Tickets</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="white-box">
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
								$hotel_id		= $this->session->userdata['logged_in']['firm_id'];											
								$current_date	= gmdate('Y-m-d H:i:s', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
								$month_ago		= gmdate('Y-m-d H:i:s', strtotime('1 month ago '.$this->session->userdata['logged_in']['tz'].' hours'));
								
								if(isset($_POST['submit'])){
									if($_POST['ticket_type'] == 0){$ticketType 	= '';}else{$ticketType 	= $_POST['ticket_type'];}								
									$start_date		= $_POST['start'];
									$end_date		= $_POST['end'];
									$start_date_f	= $_POST['start'];
									$end_date_f		= $_POST['end'];
									$between		= " BETWEEN '".$start_date." 00:00:00' AND '".$end_date." 00:00:00' ";
								}else{
									$ticketType 	= '';
									$start_date		= $month_ago;
									$end_date		= $current_date;
									$start_date_f 	= $end_date_f	= '';
									$between		= " BETWEEN '".$start_date."' AND '".$end_date."' ";
								}
                             ?>
                             <form action="" id="search_tickets" method="post" enctype="multipart/form-data" class="form-horizontal m-b-10">
                                <div class="form-body">
                                    <h3 class="box-title">Filters</h3>
                                    <div class="row">
                                        <div class="col-md-3 p-l-5 p-r-0">
                                            <select class="form-control" name="ticket_type" id="ticket_type">
                                                <option value="0">-Ticket Types-</option>
                                                <?php if(is_array($ticket_types)){
                                                    foreach($ticket_types as $ticket_type){?>
                                                    <option value="<?php echo $ticket_type->t_id;?>" <?php if($ticketType == $ticket_type->t_id){echo 'selected="selected"';}?>><?php echo ucfirst($ticket_type->type_name);?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-5 p-l-5 p-r-0">
                                            <div class="example">
                                                <div class="input-daterange input-group" id="date-range">
                                                    <input type="text" class="form-control" name="start" id="start" placeholder="yyyy-mm-dd" value="<?php echo $start_date_f;?>" required />
                                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                    <input type="text" class="form-control" name="end" id="end" placeholder="yyyy-mm-dd" value="<?php echo $end_date_f;?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4"><button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button></div>
                                    </div>
                                </div>
                             </form>
                             <!--Table display Search ticket data-->
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ticket #</th>
                                            <th>Guest Name</th>
                                            <th>Service Recovery</th>
                                            <th>In-house/Future</th>
                                            <th>Room#</th>
                                            <th>Status</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php if(is_array($closedTickets)){
										foreach($closedTickets as $val){
											if($val->special_ticket == 1){$ticket_type = 'PM';}elseif($val->special_ticket == 2){$ticket_type = 'GWC';}elseif($val->special_ticket == 3){$ticket_type = 'GV';}elseif($val->special_ticket == 5){$ticket_type = 'Quick';}else{$ticket_type = 'GSS';}?>
                                            <tr>
                                                <td><?php echo $ticket_type.$val->id;?></td>
                                                <td><?php echo $val->guestName;?></td>
                                                <td><?php echo ucwords($val->serviceRec);?></td>
                                                <td><?php if($val->houseGuest == 'yes'){echo 'In-House';}else{echo 'Future';} ?></td>
                                                <td><?php echo $val->guestRoomNumber;?></td>
                                                <td>Closed</td>
                                                <!--<td><a href="<?php echo base_url();?>ticket/ticket_info/<?php echo $val->id;?>"><button type="button" class="btn btn-warning waves-effect waves-light">View ticket</button></a></td>-->
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