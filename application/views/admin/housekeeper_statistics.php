<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Housekeeper Statistics</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Housekeeper Statistics Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Housekeeper Statistics</div>
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
								
								$hotel_id		= $this->session->userdata['logged_in']['firm_id'];											
								$current_date	= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
								$month_ago		= gmdate('Y-m-d', strtotime('1 month ago '.$this->session->userdata['logged_in']['tz'].' hours'));
								
								if(isset($_POST['submit'])){
									if($_POST['employee'] == 0){$employee 	= '';}else{$employee 	= $_POST['employee'];}									
									$start_date		= $_POST['start'];
									$end_date		= $_POST['end'];
									$start_date_f	= $_POST['start'];
									$end_date_f		= $_POST['end'];
									$between		= " BETWEEN '".$start_date." 00:00:00' AND '".$end_date." 00:00:00' ";
								}else{
									$employee 		= '';
									$start_date		= $month_ago;
									$end_date		= $current_date;
									$start_date_f 	= $month_ago;
									$end_date_f		= $current_date;
									$between	= " BETWEEN '".$start_date."' AND '".$end_date."' ";
								}
							?><!--checklist-->
                             <form action="" id="mpor" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-body">
                                    <h3 class="box-title">Filters</h3>
                                    <div class="row">
                                        <div class="col-md-2 p-l-5 p-r-0">
                                            <!--<h5 class="m-t-5">Select Employees</h5>-->
                                            <select class="form-control" name="employee" id="employee">
                                                <option value="0">-All Employees-</option>
                                                <?php if(is_array($all_housekeepers)){
                                                    foreach($all_housekeepers as $all_hk){?>
                                                    <option value="<?php echo $all_hk->id;?>" <?php if($employee == $all_hk->id){echo 'selected="selected"';}?>><?php echo ucfirst($all_hk->username);?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-l-5 p-r-0">
                                            <div class="example">
                                                <div class="input-daterange input-group" id="date-range">
                                                    <input type="text" class="form-control" name="start" id="start" placeholder="yyyy-mm-dd" value="<?php echo $start_date_f;?>" required />
                                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                    <input type="text" class="form-control" name="end" id="end" placeholder="yyyy-mm-dd" value="<?php echo $end_date_f;?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2"><button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button></div>
                                        <div class="col-md-5"></div>
                                    </div>
                                </div>
                             </form>
                             <hr />
                            <div class="table-responsive">
                                <table id="myTable_HK_Statistic" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>EMPLOYEES</th>
                                            <th>ROOMS ASSIGNED</th>
                                            <th>CHECKOUTS</th>
                                            <th>STAY-OVERS</th>
                                            <th>TOTAL MPOR</th>
                                            <th>C/O MPOR</th>
                                            <th>S/O MPOR</th>
                                            <th>GAP TIME</th>
                                            <th>SERVICE TICKETS</th>
                                            <th>ROOMS FLAGGED</th>
                                            <th class="info">GSS ALERTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
											$Assigned_grand = $Checkouts_grand = $Stayovers_grand = $Ticketss_grand = $Reinspect_grand = $TM_grand = $TM_CO_grand = $TM_ST_grand = $TM_GAP_grand = 0;
											$housekeepers	= admin_helper::get_all_housekeepers($hotel_id, $employee);
											if(is_array($housekeepers)){foreach($housekeepers as $val){
												$secondsSum_1 = $secondsSum_2 = $secondsSum_3 = $singleDate = $TMSecondsSum = 0;
												$Total_assigned	 = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'count', 'assigned');
												$Total_checkouts = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'count', 'checkout');
												$Total_stayovers = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'count', 'stayover');
												$Total_tickets	 = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'count', 'tickets');
												$Total_reinspect = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'count', 'reinspect');
												$Total_MPOR		 = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'all',	  'completed');
												$Total_CO_MPOR	 = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'all',	  'checkout_co');
												$Total_ST_MPOR	 = admin_helper::getCountOfRoomsStatistic($hotel_id, $val->id, $between, 'all',	  'stayover_co');
												
												$Assigned_count	 = $Total_assigned[0]->total_rows;
												$Checkouts_count = $Total_checkouts[0]->total_rows;
												$Stayovers_count = $Total_stayovers[0]->total_rows;
												$Ticketss_count  = $Total_tickets[0]->total_rows;
												$Reinspect_count = $Total_reinspect[0]->total_rows;
												
												$Assigned_grand  += $Assigned_count;
												$Checkouts_grand += $Checkouts_count;
												$Stayovers_grand += $Stayovers_count;
												$Ticketss_grand  += $Ticketss_count;
												$Reinspect_grand += $Reinspect_count;
												
												if(is_array($Total_MPOR)){foreach($Total_MPOR as $TotalMPOR){
													$dateStart_1 = new DateTime($TotalMPOR->started_at);
													$dateEnd_1   = new DateTime($TotalMPOR->completed_at);
													$dateDiff_1  = $dateStart_1->diff($dateEnd_1);
													$totalDiff_1 = $dateDiff_1->format("%H:%I:%S");
													$parts_1	 = explode(':', $totalDiff_1);
													$secondsSum_1 += ($parts_1[0] * 3600) + ($parts_1[1] * 60) + $parts_1[2];
												}
													if($secondsSum_1 == 0 && $Assigned_count == 0){
														$AvgTimeMPOR = '00:00:00';
													}else{
														$Cal_Time_1	 = $secondsSum_1 / $Assigned_count;
														$TM_grand	+= $Cal_Time_1;
														$AvgTimeMPOR = gmdate('H:i:s', $Cal_Time_1);
													}
												}
												if(is_array($Total_CO_MPOR)){foreach($Total_CO_MPOR as $TotalCO_MPOR){
													$dateStart_2 = new DateTime($TotalCO_MPOR->started_at);
													$dateEnd_2   = new DateTime($TotalCO_MPOR->completed_at);
													$dateDiff_2  = $dateStart_2->diff($dateEnd_2);
													$totalDiff_2 = $dateDiff_2->format("%H:%I:%S");
													$parts_2	 = explode(':', $totalDiff_2);
													$secondsSum_2 += ($parts_2[0] * 3600) + ($parts_2[1] * 60) + $parts_2[2];
												}
													if($secondsSum_2 == 0 && $Checkouts_count == 0){
														$AvgCoTimeMPOR = '00:00:00';
													}else{
														$Cal_Time_2	 	 = $secondsSum_2 / $Checkouts_count;
														$TM_CO_grand	+= $Cal_Time_2;
														$AvgCoTimeMPOR 	 = gmdate('H:i:s', $Cal_Time_2);
													}
												}
												if(is_array($Total_ST_MPOR)){foreach($Total_ST_MPOR as $TotalST_MPOR){
													$dateStart_3 = new DateTime($TotalST_MPOR->started_at);
													$dateEnd_3   = new DateTime($TotalST_MPOR->completed_at);
													$dateDiff_3  = $dateStart_3->diff($dateEnd_3);
													$totalDiff_3 = $dateDiff_3->format("%H:%I:%S");
													$parts_3	 = explode(':', $totalDiff_3);
													$secondsSum_3 += ($parts_3[0] * 3600) + ($parts_3[1] * 60) + $parts_3[2];
												}
													if($secondsSum_3 == 0 && $Stayovers_count == 0){
														$AvgStTimeMPOR = '00:00:00';
													}else{
														$Cal_Time_3		 = $secondsSum_3 / $Stayovers_count;
														$TM_ST_grand	+= $Cal_Time_3;
														$AvgStTimeMPOR	 = gmdate('H:i:s', $Cal_Time_3);
													}
												}
												if(is_array($Total_MPOR)){foreach($Total_MPOR as $TMIndex=>$TMKey){
													if(count($Total_MPOR) > 1){
														$extractCurrDate = new DateTime($TMKey->started_at);
														$currLoopDate	 = $extractCurrDate->format("Y-m-d");
														if(isset($Total_MPOR[$TMIndex+1])){
															$extractNextDate = new DateTime($Total_MPOR[$TMIndex+1]->started_at);
															$nextLoopDate 	 = $extractNextDate->format("Y-m-d");
															if($currLoopDate != $singleDate && $nextLoopDate == $currLoopDate){
																$singleDate	 = $currLoopDate;																	
																$TMDateStart = new DateTime($TMKey->completed_at);
																$TMDateEnd   = new DateTime($Total_MPOR[$TMIndex+1]->started_at);
																$TMDateDiff  = $TMDateStart->diff($TMDateEnd);
																$TMTotalDiff = $TMDateDiff->format("%H:%I:%S");
																$TMParts	 = explode(':', $TMTotalDiff);
																$TMSecondsSum += ($TMParts[0] * 3600) + ($TMParts[1] * 60) + $TMParts[2];
															}
														}
													}
												}}
												$TM_GAP_grand += $TMSecondsSum;
										?>
                                            <tr>
                                                <td><?php echo ucfirst($val->username);?></td>
                                                <td><?php echo $Assigned_count; ?></td>
                                                <td><?php echo $Checkouts_count;?></td>
                                                <td><?php echo $Stayovers_count;?></td>
                                                <td><?php echo $AvgTimeMPOR;?></td>
                                                <td><?php echo $AvgCoTimeMPOR;?></td>
                                                <td><?php echo $AvgStTimeMPOR;?></td>
                                                <td><?php echo gmdate("H:i:s", $TMSecondsSum);?></td>
                                                <td><?php echo $Ticketss_count;?></td>
                                                <td><?php echo $Reinspect_count;?></td>
                                                <td>&mdash;</td>                                            
                                            </tr>
                                        <?php }}?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>DEPARTMENTAL TOTALS</th>
                                            <th><?php echo $Assigned_grand; ?></th>
                                            <th><?php echo $Checkouts_grand;?></th>
                                            <th><?php echo $Stayovers_grand;?></th>
                                            <th><?php echo gmdate("H:i:s", $TM_grand);?></th>
                                            <th><?php echo gmdate("H:i:s", $TM_CO_grand);?></th>
                                            <th><?php echo gmdate("H:i:s", $TM_ST_grand);?></th>
                                            <th><?php echo gmdate("H:i:s", $TM_GAP_grand);?></th>
                                            <th><?php echo $Ticketss_grand;?></th>
                                            <th><?php echo $Reinspect_grand;?></th>
                                            <th>&mdash;</th>                                            
                                        </tr>
                                    </tfoot>
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