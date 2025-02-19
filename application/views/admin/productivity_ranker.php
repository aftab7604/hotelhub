<div class="container-fluid"> 
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Productivity Ranker</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Productivity Ranker Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Productivity Ranker</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body p-t-10">
                        <?php
                            if($this->session->flashdata('flash_data') != ""){
                                echo '<div class="alert alert-success alert-dismissable">';
                                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                echo $this->session->flashdata('flash_data');
                                echo '</div>';
                            }
                            if ($this->session->flashdata('flash_data_danger') != ""){
                                echo '<div style=" margin: 10px;" class="alert alert-danger alert-dismissable">';
                                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                echo $this->session->flashdata('flash_data_danger');
                                echo '</div>';
                            }
							$hotel_id		= $this->session->userdata['logged_in']['firm_id'];
							$current_Month	= date('m');
							$current_Year	= date('Y');
							
							if(isset($_POST['submit'])){
								if($_POST['ticket_types']	== 0){$ticket_type 		= '';}	else{$ticket_type 	= $_POST['ticket_types'];}
								if($_POST['role']			== 0){$dprole 			= '';}	else{$dprole		= $_POST['role'];}
								if($_POST['employee']		== 0){$employee 		= '';}	else{$employee 		= $_POST['employee'];}
								if($_POST['ticket_status']	== 0){$ticket_status	= '';}	else{$ticket_status = $_POST['ticket_status'];}
								//if($_POST['display_result']	== 0){$display_result	= 0;}	else{$display_result= $_POST['display_result'];}
								
								function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
									$datetime1 = date_create($date_1);
									$datetime2 = date_create($date_2);
									$interval = date_diff($datetime1, $datetime2);
									return $interval->format($differenceFormat);
								}
								$number_of_days	= dateDifference($_POST['start'], $_POST['end'], '%a');
																
								$start_date		= $_POST['start'];
								$end_date		= $_POST['end'];
							}else{
								$ticket_type 	= $dprole 	= $employee 	= $ticket_status 	= $display_result 	= '';
								//$number_of_days	= cal_days_in_month(CAL_GREGORIAN, $current_Month, $current_Year);
								//$Month_Start	= date_format(date_create($current_Year.'-'.$current_Month.'-01'),"Y-m-d");
								//$Month_End		= date_format(date_create($current_Year.'-'.$current_Month.'-'.$number_of_days),"Y-m-d");								
								//$start_date		= gmdate('Y-m-d', strtotime('1 week ago '.$this->session->userdata['logged_in']['tz'].' hours'));
								$start_date		= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
								$end_date		= $start_date;
								$number_of_days	= 0;
								$between		= "BETWEEN '".$start_date." 00:00:00' AND '".$start_date." 23:59:59' ";
							}
                        ?>
                        <form action="" id="mpor" method="post" enctype="multipart/form-data" class="form-horizontal ">
                            <div class="form-body">
                                <h3 class="box-title">Filters</h3>
                                <div class="row">
                                    <div class="col-md-2">
                                        <select class="form-control" name="ticket_types" id="ticket_types">
                                            <option value="0">-All Ticket Types-</option>
                                            <?php if(is_array($ticket_types)){foreach($ticket_types as $ticketType){?>
                                                <option value="<?php echo $ticketType->t_id;?>" <?php if($ticket_type == $ticketType->t_id){echo 'selected="selected"';}?>><?php echo ucfirst($ticketType->type_name);?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 p-l-0">
                                        <select class="form-control" name="role" id="role">
                                            <option value="0">-Departments-</option>
                                            <?php if(is_array($roles)){foreach($roles as $role){?>
                                                <option value="<?php echo $role->id;?>" <?php if($dprole == $role->id){echo 'selected="selected"';}?>><?php echo ucfirst($role->name);?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 p-l-0">
                                        <select class="form-control" name="employee" id="employee">
                                            <option value="0">-All Employees-</option>
                                            <?php if(is_array($users)){foreach($users as $all_users){?>
                                                <option value="<?php echo $all_users->id;?>" <?php if($employee == $all_users->id){echo 'selected="selected"';}?>><?php echo ucfirst($all_users->username).' - '.$all_users->Role_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 p-l-0">
                                        <select class="form-control" name="ticket_status" id="ticket_status">
                                            <option value="0" <?php if($ticket_status == 0){echo 'selected="selected"';}?>>-Ticket Status-</option>
                                            <option value="1" <?php if($ticket_status == 1){echo 'selected="selected"';}?>>Pending Tickets</option>
                                            <option value="2" <?php if($ticket_status == 2){echo 'selected="selected"';}?>>Picked Tickets</option>
                                            <option value="3" <?php if($ticket_status == 3){echo 'selected="selected"';}?>>Closed Tickets</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 p-l-0">
                                        <div class="example">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control" name="start" id="start" placeholder="yyyy-mm-dd" value="<?php echo $start_date;?>" required />
                                                <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                <input type="text" class="form-control" name="end" id="end" placeholder="yyyy-mm-dd" value="<?php echo $end_date;?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 p-l-0"><button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button></div>
                                </div>
                                <!--<div class="row m-t-10">
                                    <div class="col-md-2">
                                        <select class="form-control" name="display_result" id="display_result">
                                            <option value="0" <?php if($display_result == 0){echo 'selected="selected"';}?>>Today Results</option>
                                            <option value="1" <?php if($display_result == 1){echo 'selected="selected"';}?>>Date Range Results</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 p-l-0"><button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button></div>
                                    <div class="col-md-9 p-l-0"></div>
                                </div>-->
                            </div>
                         </form>
                        <hr />
                        <div class="table-responsive" style="font-size: 12px !important;">
                        	<table id="PRODUCTIVITY_RANKER" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>EMPLOYEES</th>
                                        <th>Date</th>
                                        <?php $dept_roles = admin_helper::get_roles($dprole);foreach($dept_roles as $dept_role){?>
											<th><?php echo ucfirst($dept_role->name);?></th>
										<?php }?>
                                        <th>TOTALS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php //if($display_result == 1){
										for($x=0; $x <= $number_of_days; $x++){
											$TOTAL_RIGHT = 0;
											$TOTAL_BOTTOM	= array();
											$TOTAL_RIGHT_BOTTOM = 0;
											$starting_date = date('Y-m-d', strtotime('+'.$x.' days', strtotime($start_date)));
											$between = "BETWEEN '".$starting_date." 00:00:00' AND '".$starting_date." 23:59:59' ";
									?>
										<?php $users = admin_helper::get_hotel_Users($hotel_id, $employee);
                                            if(is_array($users)){foreach($users as $user_id){$TOTAL_RIGHT = 0;?>
                                            <tr>
                                                <td><?php echo ucfirst($user_id->username).' is '.$user_id->Role_name;?></td>
                                                <td><?php echo $starting_date;?></td>
                                                <?php foreach($dept_roles as $dept_role){
                                                    $RANKING = admin_helper::getCalculateProductivityRanking($hotel_id, $user_id->id, $dept_role->id, $ticket_type, $ticket_status, $between);
                                                    $TOTAL_RIGHT					+= $RANKING[0]->total;
                                                    @$TOTAL_BOTTOM[$dept_role->id]	+= $RANKING[0]->total;
                                                ?>
                                                <td><?php echo $RANKING[0]->total;?></td>
                                                <?php }?>
                                                <td><strong><?php echo $TOTAL_RIGHT;?></strong></td>
                                                <?php $TOTAL_RIGHT_BOTTOM += $TOTAL_RIGHT;?>
                                            </tr>
                                        <?php }}?>
                                        <tr>
                                            <th>TOTALS</th>
                                            <th><?php echo $starting_date;?></th>
                                            <?php foreach($dept_roles as $dept_role){?>
                                            <th><?php print_r($TOTAL_BOTTOM[$dept_role->id]);?></th> 
                                            <?php }?>
                                            <th><?php echo $TOTAL_RIGHT_BOTTOM;?></th>
                                        </tr>
                                    <?php }/*} else {?>
										<?php $users = admin_helper::get_hotel_Users($hotel_id, $employee);
                                            if(is_array($users)){foreach($users as $user_id){$TOTAL_RIGHT = 0;?>
                                            <tr>
                                                <td><?php echo ucfirst($user_id->username).' is '.$user_id->Role_name;?></td>
                                                <td><?php echo $start_date;?></td>
                                                <?php foreach($dept_roles as $dept_role){
                                                    $RANKING = admin_helper::getCalculateProductivityRanking($hotel_id, $user_id->id, $dept_role->id, $ticket_type, $ticket_status, $between);
                                                    $TOTAL_RIGHT					+= $RANKING[0]->total;
                                                    @$TOTAL_BOTTOM[$dept_role->id]	+= $RANKING[0]->total;
                                                ?>
                                                <td><?php echo $RANKING[0]->total;?></td>
                                                <?php }?>
                                                <td><strong><?php echo $TOTAL_RIGHT;?></strong></td>
                                                <?php $TOTAL_RIGHT_BOTTOM += $TOTAL_RIGHT;?>
                                            </tr>
                                        <?php }}?>
                                        <tr>
                                            <th>TOTALS</th>
                                            <th><?php echo $start_date;?></th>
                                            <?php foreach($dept_roles as $dept_role){?>
                                            <th><?php print_r($TOTAL_BOTTOM[$dept_role->id]);?></th> 
                                            <?php }?>
                                            <th><?php echo $TOTAL_RIGHT_BOTTOM;?></th>
                                        </tr>
                                    <?php }*/?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
			</div>
        </div>
	</div>
</div>
<style>
.buttons-pdf{
	margin-left:10px !important;
}
</style>