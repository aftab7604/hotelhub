<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">MPOR Analytics</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">MPOR Analytics Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">MPOR Analytics</div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="white-box"><!--Errors-->
							<?php
								if($this->session->flashdata('flash_data') != ""){
									echo '<div class="alert alert-success alert-dismissable">';
									echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
									echo $this->session->flashdata('flash_data');
									echo '</div>';
								}
								if($this->session->flashdata('flash_data_danger') != ""){
									echo '<div style=" margin: 10px;" class="alert alert-danger alert-dismissable">';
									echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
									echo $this->session->flashdata('flash_data_danger');
									echo '</div>';
								}
								
								$hotel_id		= $this->session->userdata['logged_in']['firm_id'];
								$current_Month	= date('m');
								$current_Year	= date('Y');
								
								if(isset($_POST['submit'])){
									if($_POST['employee'] == 0){$employee = '';}else{$employee = $_POST['employee'];}
									$dateStart		= new DateTime($_POST['start']);
									$dateEnd		= new DateTime($_POST['end']);
									$dateDiff		= $dateStart->diff($dateEnd);
									$number_of_days	= ($dateDiff->d)+1;
									
									$data_type		= $_POST['type'];
									$start_date		= $_POST['start'];
									$end_date		= $_POST['end'];
								}else{
									$employee		= '';
									$data_type		= '1';
									$number_of_days	= cal_days_in_month(CAL_GREGORIAN, $current_Month, $current_Year);
									$Month_Start	= date_format(date_create($current_Year.'-'.$current_Month.'-01'),"Y-m-d");
									$Month_End		= date_format(date_create($current_Year.'-'.$current_Month.'-'.$number_of_days),"Y-m-d");
									$start_date		= $Month_Start;
									$end_date		= $Month_End;
								}
							?><!--checklist-->
                             <form action="" id="mpor" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-body">
                                    <h3 class="box-title">Filters</h3>
                                    <div class="row">
                                        <div class="col-md-2 p-l-5 p-r-0">
                                            <select class="form-control" name="type" id="type">
                                                <option value="1" <?php if($data_type == '1'){echo 'selected="selected"';}?>>Departmental MPOR</option>
                                                <option value="2" <?php if($data_type == '2'){echo 'selected="selected"';}?>>MPOR Average</option>
                                                <option value="3" <?php if($data_type == '3'){echo 'selected="selected"';}?>>MPOR Checkouts</option>
                                                <option value="4" <?php if($data_type == '4'){echo 'selected="selected"';}?>>MPOR Stay-Overs</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 p-l-5 p-r-0">
                                            <select class="form-control" name="employee" id="employee">
                                                <option value="0">-All Employees-</option>
                                                <?php if(is_array($all_housekeepers)){
                                                    foreach($all_housekeepers as $all_hk){?>
                                                    <option value="<?php echo $all_hk->id;?>" <?php if($employee == $all_hk->id){echo 'selected="selected"';}?>><?php echo ucfirst($all_hk->username);?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 p-l-5 p-r-0">
                                            <div class="example">
                                                <div class="input-daterange input-group" id="date-range">
                                                    <input type="text" class="form-control" name="start" id="start" placeholder="yyyy-mm-dd" value="<?php echo $start_date;?>" required />
                                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                    <input type="text" class="form-control" name="end" id="end" placeholder="yyyy-mm-dd" value="<?php echo $end_date;?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4"><button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button></div>
                                    </div>
                                </div>
                             </form>
                             <hr />
							<?php if($data_type == 1){?>
                            	<div class="row bg-title m-b-0 p-t-0 p-l-0 p-r-0">
                                	<div class="col-lg-12 col-md-4 col-sm-4 col-xs-12 text-center bg-success"><h4 class="page-title">Departmental MPOR</h4></div>
                                </div>
								<div class="table-responsive" style="font-size: 12px !important;">
                                    <table id="myTableHKStatistic" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <?php $DPTMTL_grand = $DPTMTL_grand_SO = $DPTMTL_grand_CO = 0;
                                                for($i=1; $i<=$number_of_days; $i++){if($i==1){$stop_date = $start_date;}else{
                                                        $stop_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
                                                        $start_date = $stop_date;
                                                    }
                                                    $between		= " BETWEEN '".$start_date." 00:00:00' AND '".$start_date." 23:59:59' ";
                                                    $Total_DPTMTL	= admin_helper::getCountOfAnalytics($hotel_id, $employee, $between, 'all', 'completed');
                                                    $secondsSum_1 = $secondsSumForSO = $secondsSumForCO = $SORows = $CORows = $Cal_Time_CO = $Cal_Time_SO = 0;
                                                    
                                                    if(is_array($Total_DPTMTL)){
                                                        $Total_Rows	 = count($Total_DPTMTL);
                                                        foreach($Total_DPTMTL as $TotalDPTMTL){
                                                            $dateStart_1 = new DateTime($TotalDPTMTL->started_at);
                                                            $dateEnd_1   = new DateTime($TotalDPTMTL->completed_at);
                                                            $dateDiff_1  = $dateStart_1->diff($dateEnd_1);
                                                            $totalDiff_1 = $dateDiff_1->format("%H:%I:%S");
                                                            $parts_1	 = explode(':', $totalDiff_1);
                                                            $secondsSum_1 += ($parts_1[0] * 3600) + ($parts_1[1] * 60) + $parts_1[2];
                                                            
                                                            if($TotalDPTMTL->chk_stay=="stayover")
                                                            {
                                                                $SORows++;
                                                                $secondsSumForSO += ($parts_1[0] * 3600) + ($parts_1[1] * 60) + $parts_1[2];
                                                            }
                                                            elseif($TotalDPTMTL->chk_stay=="checkout")
                                                            {
                                                                $CORows++;
                                                                $secondsSumForCO += ($parts_1[0] * 3600) + ($parts_1[1] * 60) + $parts_1[2];
                                                            }
                                                        }
                                                        
                                                        if($secondsSum_1 == 0 && $Total_Rows == 0){
                                                            $AvgTimeMPOR = '00:00:00';
                                                        }else{
                                                            $Cal_Time_1	 = $secondsSum_1 / $Total_Rows;
                                                            $DPTMTL_grand	+= $Cal_Time_1;
                                                            $AvgTimeMPOR = gmdate('H:i:s', $Cal_Time_1);
                                                        }
                                                        if($secondsSumForSO == 0 && $SORows == 0){
                                                            $AvgTimeSO = '00:00:00';
                                                        }else{
                                                            $Cal_Time_SO	 = $secondsSumForSO / $SORows;
                                                            $DPTMTL_grand_SO	+= $Cal_Time_SO;
                                                            $AvgTimeSO = gmdate('H:i:s', $Cal_Time_SO);
                                                        }
                                                        if($secondsSumForCO == 0 && $CORows == 0){
                                                            $AvgTimeCO = '00:00:00';
                                                        }else{
                                                            $Cal_Time_CO	 = $secondsSumForCO / $CORows;
                                                            $DPTMTL_grand_CO	+= $Cal_Time_CO;
                                                            $AvgTimeCO = gmdate('H:i:s', $Cal_Time_CO);
                                                        }	
                                                    }
                                                    
                                                    $arrayOfDates[$i] = array("dept_total" =>$AvgTimeMPOR, "checkouts" =>$AvgTimeCO, "stayovers" =>$AvgTimeSO);
                                                ?>
                                                <th><?php echo date("l", strtotime($stop_date));?><br /><?php echo $stop_date;?></th>
                                                <?php }?>
                                                <th>RANGE AVG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>DEPARTMENT TOTAL</td>
                                                <?php for($j=1; $j<=$number_of_days; $j++){?>
                                                    <td><?php echo $arrayOfDates[$j]['dept_total'];?></td>
                                                <?php }?>
                                                <td><?php $DPTMTL_total = ($DPTMTL_grand/$number_of_days); echo gmdate('H:i:s', $DPTMTL_total);?></td>
                                            </tr>
                                            <tr>
                                                <td>STAYOVERS</td>
                                                <?php for($j=1; $j<=$number_of_days; $j++){?>
                                                    <td><?php echo $arrayOfDates[$j]['stayovers'];?></td>
                                                <?php }?>
                                                <td><?php $DPTMTL_SO_total = ($DPTMTL_grand_SO/$number_of_days); echo gmdate('H:i:s', $DPTMTL_SO_total);?></td>
                                            </tr>                                        
                                            <tr>
                                                <td><span class="hidden">E</span>CHECKOUTS</td>
                                                <?php for($j=1; $j<=$number_of_days; $j++){?>
                                                    <td><?php echo $arrayOfDates[$j]['checkouts'];?></td>
                                                <?php }?>
                                                <td><?php $DPTMTL_CO_total = ($DPTMTL_grand_CO/$number_of_days); echo gmdate('H:i:s', $DPTMTL_CO_total);?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
							<?php }?>
                            
                            <?php if($data_type == 2){?>
                                <div class="row bg-title m-b-0 p-t-0 p-l-0 p-r-0">
                                    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12 text-center bg-success"><h4 class="page-title">MPOR Average</h4></div>
                                </div>
                            	<div class="table-responsive" style="font-size: 12px !important;">
                                    <table id="myTableHKStatistic" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <?php for($i=1; $i<=$number_of_days; $i++){if($i==1){$stop_date = $start_date;}else{
                                                        $stop_date	= date('Y-m-d', strtotime($start_date . ' +1 day'));
                                                        $start_date = $stop_date;
                                                    }
                                                    $between			= " BETWEEN '".$start_date." 00:00:00' AND '".$start_date." 23:59:59' ";
													$arrayOfDates[$i]	= array("between" =>$between);
                                                ?>
                                                <th><?php echo date("l", strtotime($stop_date));?><br /><?php echo $stop_date;?></th>
                                                <?php }?>
                                                <th>RANGE AVG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php $all_housekeepers = admin_helper::get_all_housekeepers($hotel_id, $employee);
											 if(is_array($all_housekeepers)){foreach($all_housekeepers as $indd=>$all_hk){$DPTMTL_grand = 0;?>
												<tr>
                                                    <td><?php echo ucfirst($all_hk->username);?></td>
                                                    <?php for($j=1; $j<=$number_of_days; $j++){
														$Total_DPTMTL = admin_helper::getCountOfAnalytics($hotel_id, $all_hk->id, $arrayOfDates[$j]['between'], 'all', 'completed');
                                                    	$secondsSum_1 = $DailyTimeMPOR = 0;
														if(is_array($Total_DPTMTL)){
															$Total_Rows	 = count($Total_DPTMTL);
															foreach($Total_DPTMTL as $TotalDPTMTL){
																$dateStart_1 = new DateTime($TotalDPTMTL->started_at);
																$dateEnd_1   = new DateTime($TotalDPTMTL->completed_at);
																$dateDiff_1  = $dateStart_1->diff($dateEnd_1);
																$totalDiff_1 = $dateDiff_1->format("%H:%I:%S");
																$parts_1	 = explode(':', $totalDiff_1);
																$secondsSum_1 += ($parts_1[0] * 3600) + ($parts_1[1] * 60) + $parts_1[2];
															}
															if($secondsSum_1 == 0 && $Total_Rows == 0){
																$AvgTimeMPOR 	= '00:00:00';
																$DailyTimeMPOR	= '0';
															}else{
																$Cal_Time_1		 = $secondsSum_1 / $Total_Rows;
																$DPTMTL_grand	+= $Cal_Time_1;
																$DailyTimeMPOR	+= $Cal_Time_1;
																$AvgTimeMPOR	 = gmdate('H:i:s', $Cal_Time_1);
															}
														}
														$arrayOfSoldRooms[$indd][$j]	= $Total_Rows;
														$arrayOfAvgRoomsTime[$indd][$j]	= $DailyTimeMPOR;
													?>
                                                    <td><?php echo $AvgTimeMPOR;?></td>
                                                    <?php }?>
                                                    <td><?php $allEmployees = ($DPTMTL_grand / $number_of_days); echo gmdate('H:i:s', $allEmployees);?></td>
                                                </tr>
											<?php }}$sum_sold_rooms_Array = array();
												foreach($arrayOfSoldRooms as $subArray){
													foreach($subArray as $id=>$value){
													@$sum_sold_rooms_Array[$id] += $value;
												}}
												$sum_avg_rooms_Time_Array = array();
												foreach($arrayOfAvgRoomsTime as $subArray_2){
													foreach($subArray_2 as $id_2 => $value_2){
													@$sum_avg_rooms_Time_Array[$id_2] += $value_2;
												}}
											?>
                                            <tr>
                                            	<td><span class="hidden">zzzzz</span>MPOR AVERAGE</td>
                                                <?php $sum_avg_rooms_Time = 0;foreach($sum_avg_rooms_Time_Array as $sum_avg_rooms_Time_daily){?>
                                                <td><?php echo gmdate('H:i:s', $sum_avg_rooms_Time_daily);?></td>
                                                <?php $sum_avg_rooms_Time += $sum_avg_rooms_Time_daily;}?>
                                                <td><?php $range_avg_rooms_Time = ($sum_avg_rooms_Time / $number_of_days); echo gmdate('H:i:s', $range_avg_rooms_Time);?></td>
                                            </tr>
                                            <tr>
                                            	<td><span class="hidden">zzzzz</span>SOLD ROOMS</td>
                                                <?php $sold_rooms_total = 0;foreach($sum_sold_rooms_Array as $sold_rooms_daily){?>
                                                <td><?php echo $sold_rooms_daily;?></td>
                                                <?php $sold_rooms_total += $sold_rooms_daily;}?>
                                                <td><?php echo $sold_rooms_total;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
							<?php }?>
                            
                            <?php if($data_type == 3){?>
                                <div class="row bg-title m-b-0 p-t-0 p-l-0 p-r-0">
                                    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12 text-center bg-success"><h4 class="page-title">MPOR Checkouts</h4></div>
                                </div>
                            	<div class="table-responsive" style="font-size: 12px !important;">
                                    <table id="myTableHKStatistic" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <?php $DPTMTL_grand = $DPTMTL_grand_SO = $DPTMTL_grand_CO = 0;
                                                for($i=1; $i<=$number_of_days; $i++){if($i==1){$stop_date = $start_date;}else{
                                                        $stop_date	= date('Y-m-d', strtotime($start_date . ' +1 day'));
                                                        $start_date = $stop_date;
                                                    }
                                                    $between			= " BETWEEN '".$start_date." 00:00:00' AND '".$start_date." 23:59:59' ";
													$arrayOfDates[$i]	= array("between" =>$between);
                                                ?>
                                                <th><?php echo date("l", strtotime($stop_date));?><br /><?php echo $stop_date;?></th>
                                                <?php }?>
                                                <th>EOM TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php $all_housekeepers = admin_helper::get_all_housekeepers($hotel_id, $employee);
											 if(is_array($all_housekeepers)){foreach($all_housekeepers as $indd=>$all_hk){$DPTMTL_grand_CO = 0;?>
												<tr>
                                                    <td><?php echo ucfirst($all_hk->username);?></td>
                                                    <?php for($j=1; $j<=$number_of_days; $j++){
														$Total_DPTMTL = admin_helper::getCountOfAnalytics($hotel_id, $all_hk->id, $arrayOfDates[$j]['between'], 'all', 'completed');
                                                    	$DailyTimeMPOR = $secondsSumForCO = $CORows = $Cal_Time_CO = 0;
														if(is_array($Total_DPTMTL)){
															foreach($Total_DPTMTL as $TotalDPTMTL){
																$dateStart_1 = new DateTime($TotalDPTMTL->started_at);
																$dateEnd_1   = new DateTime($TotalDPTMTL->completed_at);
																$dateDiff_1  = $dateStart_1->diff($dateEnd_1);
																$totalDiff_1 = $dateDiff_1->format("%H:%I:%S");
																$parts_1	 = explode(':', $totalDiff_1);
																if($TotalDPTMTL->chk_stay=="checkout")
																{
																	$CORows++;
																	$secondsSumForCO += ($parts_1[0] * 3600) + ($parts_1[1] * 60) + $parts_1[2];
																}
															}
															if($secondsSumForCO == 0 && $CORows == 0){
																$AvgTimeCO		= '00:00:00';
																$DailyTimeMPOR	= '0';
															}else{
																$Cal_Time_CO	 	 = $secondsSumForCO / $CORows;
																$DPTMTL_grand_CO	+= $Cal_Time_CO;
																$DailyTimeMPOR		+= $Cal_Time_CO;
																$AvgTimeCO 			 = gmdate('H:i:s', $Cal_Time_CO);
															}	
														}
														$arrayOfSoldRooms[$indd][$j]	= $CORows;
														$arrayOfAvgRoomsTime[$indd][$j]	= $DailyTimeMPOR;
													?>
                                                        <td><?php echo $AvgTimeCO;?></td>
                                                    <?php }?>
                                                    <td><?php $range_avg_DPTMTL_grand_CO = ($DPTMTL_grand_CO / $number_of_days); echo gmdate('H:i:s', $range_avg_DPTMTL_grand_CO);?></td>
                                                </tr>
											<?php }}$sum_sold_rooms_Array = array();
												foreach($arrayOfSoldRooms as $subArray){
													foreach($subArray as $id=>$value){
													@$sum_sold_rooms_Array[$id] += $value;
												}}
												$sum_avg_rooms_Time_Array = array();
												foreach($arrayOfAvgRoomsTime as $subArray_2){
													foreach($subArray_2 as $id_2 => $value_2){
													@$sum_avg_rooms_Time_Array[$id_2] += $value_2;
												}}?>
                                            <tr>
                                            	<td><span class="hidden">zzzzz</span>MPOR AVERAGE</td>
                                                <?php $sum_avg_rooms_Time = 0;foreach($sum_avg_rooms_Time_Array as $sum_avg_rooms_Time_daily){?>
                                                <td><?php echo gmdate('H:i:s', $sum_avg_rooms_Time_daily);?></td>
                                                <?php $sum_avg_rooms_Time += $sum_avg_rooms_Time_daily;}?>
                                                <td><?php $range_avg_rooms_Time = ($sum_avg_rooms_Time / $number_of_days); echo gmdate('H:i:s', $range_avg_rooms_Time);?></td>
                                            </tr>
                                            <tr>
                                            	<td><span class="hidden">zzzzz</span>SOLD ROOMS</td>
                                                <?php $sold_rooms_total = 0;foreach($sum_sold_rooms_Array as $sold_rooms_daily){?>
                                                <td><?php echo $sold_rooms_daily;?></td>
                                                <?php $sold_rooms_total += $sold_rooms_daily;}?>
                                                <td><?php echo $sold_rooms_total;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
							<?php }?>
                            
                            <?php if($data_type == 4){?>
                                <div class="row bg-title m-b-0 p-t-0 p-l-0 p-r-0">
                                    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12 text-center bg-success"><h4 class="page-title">MPOR Stay-overs</h4></div>
                                </div>
                            	<div class="table-responsive" style="font-size: 12px !important;">
                                    <table id="myTableHKStatistic" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <?php $DPTMTL_grand = $DPTMTL_grand_SO = $DPTMTL_grand_CO = 0;
                                                for($i=1; $i<=$number_of_days; $i++){if($i==1){$stop_date = $start_date;}else{
                                                        $stop_date	= date('Y-m-d', strtotime($start_date . ' +1 day'));
                                                        $start_date = $stop_date;
                                                    }
                                                    $between			= " BETWEEN '".$start_date." 00:00:00' AND '".$start_date." 23:59:59' ";
													$arrayOfDates[$i]	= array("between" =>$between);
                                                ?>
                                                <th><?php echo date("l", strtotime($stop_date));?><br /><?php echo $stop_date;?></th>
                                                <?php }?>
                                                <th>EOM TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php
											 $all_housekeepers	= admin_helper::get_all_housekeepers($hotel_id, $employee);
											 if(is_array($all_housekeepers)){foreach($all_housekeepers as $indd=>$all_hk){$DPTMTL_grand_SO = 0;?>
												<tr>
                                                    <td><?php echo ucfirst($all_hk->username);?></td>
                                                    <?php for($j=1; $j<=$number_of_days; $j++){
														$Total_DPTMTL = admin_helper::getCountOfAnalytics($hotel_id, $all_hk->id, $arrayOfDates[$j]['between'], 'all', 'completed');
                                                    	$DailyTimeMPOR = $secondsSumForSO = $secondsSumForCO = $SORows = $CORows = $Cal_Time_CO = $Cal_Time_SO = 0;
														if(is_array($Total_DPTMTL)){
															//$Total_Rows	 = count($Total_DPTMTL);
															foreach($Total_DPTMTL as $TotalDPTMTL){
																$dateStart_1 = new DateTime($TotalDPTMTL->started_at);
																$dateEnd_1   = new DateTime($TotalDPTMTL->completed_at);
																$dateDiff_1  = $dateStart_1->diff($dateEnd_1);
																$totalDiff_1 = $dateDiff_1->format("%H:%I:%S");
																$parts_1	 = explode(':', $totalDiff_1);																
																if($TotalDPTMTL->chk_stay=="stayover")
																{
																	$SORows++;
																	$secondsSumForSO += ($parts_1[0] * 3600) + ($parts_1[1] * 60) + $parts_1[2];
																}
															}
															if($secondsSumForSO == 0 && $SORows == 0){
																$AvgTimeSO		= '00:00:00';
																$DailyTimeMPOR	= 0;
															}else{
																$Cal_Time_SO	 	 = $secondsSumForSO / $SORows;
																$DPTMTL_grand_SO	+= $Cal_Time_SO;
																$DailyTimeMPOR		+= $Cal_Time_SO;
																$AvgTimeSO			 = gmdate('H:i:s', $Cal_Time_SO);
															}
														}
														$arrayOfSoldRooms[$indd][$j]	= $SORows;
														$arrayOfAvgRoomsTime[$indd][$j]	= $DailyTimeMPOR;
													?>
                                                        <td><?php echo $AvgTimeSO;?></td>
                                                    <?php }?>
                                                    <td><?php $range_avg_DPTMTL_grand_SO = ($DPTMTL_grand_SO / $number_of_days); echo gmdate('H:i:s', $range_avg_DPTMTL_grand_SO);?></td>
                                                </tr>
											<?php }}$sum_sold_rooms_Array = array();
												foreach($arrayOfSoldRooms as $subArray){
													foreach($subArray as $id=>$value){
													@$sum_sold_rooms_Array[$id] += $value;
												}}
												$sum_avg_rooms_Time_Array = array();
												foreach($arrayOfAvgRoomsTime as $subArray_2){
													foreach($subArray_2 as $id_2 => $value_2){
													@$sum_avg_rooms_Time_Array[$id_2] += $value_2;
												}}?>
                                            <tr>
                                            	<td><span class="hidden">zzzzz</span>MPOR AVERAGE</td>
                                                <?php $sum_avg_rooms_Time = 0;foreach($sum_avg_rooms_Time_Array as $sum_avg_rooms_Time_daily){?>
                                                <td><?php echo gmdate('H:i:s', $sum_avg_rooms_Time_daily);?></td>
                                                <?php $sum_avg_rooms_Time += $sum_avg_rooms_Time_daily;}?>
                                                <td><?php $range_avg_rooms_Time = ($sum_avg_rooms_Time / $number_of_days);echo gmdate('H:i:s', $range_avg_rooms_Time);?></td>
                                            </tr>
                                            <tr>
                                            	<td><span class="hidden">zzzzz</span>SOLD ROOMS</td>
                                                <?php $sold_rooms_total = 0;foreach($sum_sold_rooms_Array as $sold_rooms_daily){?>
                                                <td><?php echo $sold_rooms_daily;?></td>
                                                <?php $sold_rooms_total += $sold_rooms_daily;}?>
                                                <td><?php echo $sold_rooms_total;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
							<?php }?>
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
.buttons-csv{
	margin-left:10px !important;
}
</style>