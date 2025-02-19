    
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Survey Scoreboard</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Survey Scoreboard Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Survey Scoreboard</div>
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
							   $firm_id	= $this->session->userdata['logged_in']['firm_id'];
                             ?>
                             <!--manage form data-->
                            <div class="table-responsive">
                            	<?php 
									$hotel_info			= admin_helper::get_hotel_info($firm_id);
									$hotel_created		= $hotel_info[0]->created_date;
									$hotel_created_m	= date("m", strtotime($hotel_created));
									$hotel_created_y	= date("Y", strtotime($hotel_created));
									$current_m			= date("m");
									$current_y			= date("Y");
									
									if($hotel_created_y == $current_y){$month_start_from = $hotel_created_m;}else{$month_start_from = $current_m;}
									$divider			= (($current_m - $month_start_from)+1);
									
									/*echo 'Hotel Created: '.$hotel_created.'</br>';
									echo 'Month "'.$hotel_created_m.'" And Year was: "'.$hotel_created_y.'"</br>';
									echo 'Current Month : "'.$current_m.'" And Year was: "'.$current_y.'"</br>';
									echo 'Started Month: '.$month_start_from.'</br>';
									echo 'Divider: '.$divider;*/
								?>
                            
                            	<table class="table">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>June</th>
                                            <th>July</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th class="active">Total</th>
                                            <th>Benchmark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>SURVEY RESPONSES</strong></td>
                                            <td><?php $jan_count = survey_helper::get_survey_counts_by_month($firm_id, '1');echo $jan_count[0]->total_counts;?></td>
                                            <td><?php $feb_count = survey_helper::get_survey_counts_by_month($firm_id, '2');echo $feb_count[0]->total_counts;?></td>
                                            <td><?php $mar_count = survey_helper::get_survey_counts_by_month($firm_id, '3');echo $mar_count[0]->total_counts;?></td>
                                            <td><?php $apr_count = survey_helper::get_survey_counts_by_month($firm_id, '4');echo $apr_count[0]->total_counts;?></td>
                                            <td><?php $may_count = survey_helper::get_survey_counts_by_month($firm_id, '5');echo $may_count[0]->total_counts;?></td>
                                            <td><?php $jun_count = survey_helper::get_survey_counts_by_month($firm_id, '6');echo $jun_count[0]->total_counts;?></td>
                                            <td><?php $jul_count = survey_helper::get_survey_counts_by_month($firm_id, '7');echo $jul_count[0]->total_counts;?></td>
                                            <td><?php $aug_count = survey_helper::get_survey_counts_by_month($firm_id, '8');echo $aug_count[0]->total_counts;?></td>
                                            <td><?php $sep_count = survey_helper::get_survey_counts_by_month($firm_id, '9');echo $sep_count[0]->total_counts;?></td>
                                            <td><?php $oct_count = survey_helper::get_survey_counts_by_month($firm_id, '10');echo $oct_count[0]->total_counts;?></td>
                                            <td><?php $nov_count = survey_helper::get_survey_counts_by_month($firm_id, '11');echo $nov_count[0]->total_counts;?></td>
                                            <td><?php $dec_count = survey_helper::get_survey_counts_by_month($firm_id, '12');echo $dec_count[0]->total_counts;?></td>
                                            <td class="active"><?php echo $full_total = $jan_count[0]->total_counts+$feb_count[0]->total_counts+$mar_count[0]->total_counts+$apr_count[0]->total_counts+$may_count[0]->total_counts+$jun_count[0]->total_counts+$jul_count[0]->total_counts+$aug_count[0]->total_counts+$sep_count[0]->total_counts+$oct_count[0]->total_counts+$nov_count[0]->total_counts+$dec_count[0]->total_counts;?></td>
                                            <td>0</td>
                                        </tr>
                                        
                                        <tr><td><strong>Primary Metric</strong></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                        
                                        <tr>
                                            <td>GSS - Overall Satisfaction</td>
                                            <td><?php 
											$jan_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '1', 'q_1');$jan_q1 = $jan_count_1[0]->total_q_counts;
											if($jan_q1 !=''){$jan_q1_div = ($jan_q1/$jan_count[0]->total_counts);
												echo $jan_final_q1 = round($jan_q1_div,2);
											}else{echo '--'; $jan_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$feb_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '2', 'q_1');$feb_q1 = $feb_count_1[0]->total_q_counts;
											if($feb_q1 !=''){$feb_q1_div = ($feb_q1/$feb_count[0]->total_counts);
												echo $feb_final_q1 = round($feb_q1_div,2);
											}else{echo '--'; $feb_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$mar_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '3', 'q_1');$mar_q1 = $mar_count_1[0]->total_q_counts;
											if($mar_q1 !=''){$mar_q1_div = ($mar_q1/$mar_count[0]->total_counts);
												echo $mar_final_q1 = round($mar_q1_div,2);
											}else{echo '--'; $mar_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$apr_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '4', 'q_1');$apr_q1 = $apr_count_1[0]->total_q_counts;
											if($apr_q1 !=''){$apr_q1_div = ($apr_q1/$apr_count[0]->total_counts);
												echo $apr_final_q1 = round($apr_q1_div,2);
											}else{echo '--'; $apr_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$may_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '5', 'q_1');$may_q1 = $may_count_1[0]->total_q_counts;
											if($may_q1 !=''){$may_q1_div = ($may_q1/$may_count[0]->total_counts);
												echo $may_final_q1 = round($may_q1_div,2);
											}else{echo '--'; $may_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jun_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '6', 'q_1');$jun_q1 = $jun_count_1[0]->total_q_counts;
											if($jun_q1 !=''){$jun_q1_div = ($jun_q1/$jun_count[0]->total_counts);
												echo $jun_final_q1 = round($jun_q1_div,2);
											}else{echo '--'; $jun_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jul_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '7', 'q_1');$jul_q1 = $jul_count_1[0]->total_q_counts;
											if($jul_q1 !=''){$jul_q1_div = ($jul_q1/$jul_count[0]->total_counts);
												echo $jul_final_q1 = round($jul_q1_div,2);
											}else{echo '--'; $jul_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$aug_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '8', 'q_1');$aug_q1 = $aug_count_1[0]->total_q_counts;
											if($aug_q1 !=''){$aug_q1_div = ($aug_q1/$aug_count[0]->total_counts);
												echo $aug_final_q1 = round($aug_q1_div,2);
											}else{echo '--'; $aug_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$sep_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '9', 'q_1');$sep_q1 = $sep_count_1[0]->total_q_counts;
											if($sep_q1 !=''){$sep_q1_div = ($sep_q1/$sep_count[0]->total_counts);
												echo $sep_final_q1 = round($sep_q1_div,2);
											}else{echo '--'; $sep_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$oct_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '10', 'q_1');$oct_q1 = $oct_count_1[0]->total_q_counts;
											if($oct_q1 !=''){$oct_q1_div = ($oct_q1/$oct_count[0]->total_counts);
												echo $oct_final_q1 = round($oct_q1_div,2);
											}else{echo '--'; $oct_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$nov_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '11', 'q_1');$nov_q1 = $nov_count_1[0]->total_q_counts;
											if($nov_q1 !=''){$nov_q1_div = ($nov_q1/$nov_count[0]->total_counts);
												echo $nov_final_q1 = round($nov_q1_div,2);
											}else{echo '--'; $nov_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$dec_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '12', 'q_1');$dec_q1 = $dec_count_1[0]->total_q_counts;
											if($dec_q1 !=''){$dec_q1_div = ($dec_q1/$dec_count[0]->total_counts);
												echo $dec_final_q1 = round($dec_q1_div,2);
											}else{echo '--'; $dec_final_q1 = '0';}?>
                                            </td>
                                            <td class="active"><?php 
											if($full_total > 0){
											$question_1_sat = ($jan_count_1[0]->total_q_counts+$feb_count_1[0]->total_q_counts+$mar_count_1[0]->total_q_counts+$apr_count_1[0]->total_q_counts+$may_count_1[0]->total_q_counts+$jun_count_1[0]->total_q_counts+$jul_count_1[0]->total_q_counts+$aug_count_1[0]->total_q_counts+$sep_count_1[0]->total_q_counts+$oct_count_1[0]->total_q_counts+$nov_count_1[0]->total_q_counts+$dec_count_1[0]->total_q_counts) / $full_total;
											}else{
												$question_1_sat = 0;
											}
												echo round($question_1_sat, 2);
											?></td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Check-In Experience</td>
                                            <td><?php 
											$jan_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '1', 'q_2');$jan_q1 = $jan_count_1[0]->total_q_counts;
											if($jan_q1 !=''){$jan_q1_div = ($jan_q1/$jan_count[0]->total_counts);
												echo $jan_final_q1 = round($jan_q1_div,2);
											}else{echo '--'; $jan_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$feb_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '2', 'q_2');$feb_q1 = $feb_count_1[0]->total_q_counts;
											if($feb_q1 !=''){$feb_q1_div = ($feb_q1/$feb_count[0]->total_counts);
												echo $feb_final_q1 = round($feb_q1_div,2);
											}else{echo '--'; $feb_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$mar_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '3', 'q_2');$mar_q1 = $mar_count_1[0]->total_q_counts;
											if($mar_q1 !=''){$mar_q1_div = ($mar_q1/$mar_count[0]->total_counts);
												echo $mar_final_q1 = round($mar_q1_div,2);
											}else{echo '--'; $mar_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$apr_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '4', 'q_2');$apr_q1 = $apr_count_1[0]->total_q_counts;
											if($apr_q1 !=''){$apr_q1_div = ($apr_q1/$apr_count[0]->total_counts);
												echo $apr_final_q1 = round($apr_q1_div,2);
											}else{echo '--'; $apr_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$may_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '5', 'q_2');$may_q1 = $may_count_1[0]->total_q_counts;
											if($may_q1 !=''){$may_q1_div = ($may_q1/$may_count[0]->total_counts);
												echo $may_final_q1 = round($may_q1_div,2);
											}else{echo '--'; $may_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jun_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '6', 'q_2');$jun_q1 = $jun_count_1[0]->total_q_counts;
											if($jun_q1 !=''){$jun_q1_div = ($jun_q1/$jun_count[0]->total_counts);
												echo $jun_final_q1 = round($jun_q1_div,2);
											}else{echo '--'; $jun_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jul_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '7', 'q_2');$jul_q1 = $jul_count_1[0]->total_q_counts;
											if($jul_q1 !=''){$jul_q1_div = ($jul_q1/$jul_count[0]->total_counts);
												echo $jul_final_q1 = round($jul_q1_div,2);
											}else{echo '--'; $jul_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$aug_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '8', 'q_2');$aug_q1 = $aug_count_1[0]->total_q_counts;
											if($aug_q1 !=''){$aug_q1_div = ($aug_q1/$aug_count[0]->total_counts);
												echo $aug_final_q1 = round($aug_q1_div,2);
											}else{echo '--'; $aug_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$sep_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '9', 'q_2');$sep_q1 = $sep_count_1[0]->total_q_counts;
											if($sep_q1 !=''){$sep_q1_div = ($sep_q1/$sep_count[0]->total_counts);
												echo $sep_final_q1 = round($sep_q1_div,2);
											}else{echo '--'; $sep_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$oct_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '10', 'q_2');$oct_q1 = $oct_count_1[0]->total_q_counts;
											if($oct_q1 !=''){$oct_q1_div = ($oct_q1/$oct_count[0]->total_counts);
												echo $oct_final_q1 = round($oct_q1_div,2);
											}else{echo '--'; $oct_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$nov_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '11', 'q_2');$nov_q1 = $nov_count_1[0]->total_q_counts;
											if($nov_q1 !=''){$nov_q1_div = ($nov_q1/$nov_count[0]->total_counts);
												echo $nov_final_q1 = round($nov_q1_div,2);
											}else{echo '--'; $nov_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$dec_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '12', 'q_2');$dec_q1 = $dec_count_1[0]->total_q_counts;
											if($dec_q1 !=''){$dec_q1_div = ($dec_q1/$dec_count[0]->total_counts);
												echo $dec_final_q1 = round($dec_q1_div,2);
											}else{echo '--'; $dec_final_q1 = '0';}?>
                                            </td>
                                            <td class="active"><?php 
											if($full_total > 0){
												$question_2_sat = ($jan_count_1[0]->total_q_counts+$feb_count_1[0]->total_q_counts+$mar_count_1[0]->total_q_counts+$apr_count_1[0]->total_q_counts+$may_count_1[0]->total_q_counts+$jun_count_1[0]->total_q_counts+$jul_count_1[0]->total_q_counts+$aug_count_1[0]->total_q_counts+$sep_count_1[0]->total_q_counts+$oct_count_1[0]->total_q_counts+$nov_count_1[0]->total_q_counts+$dec_count_1[0]->total_q_counts) / $full_total;
											}else{
												$question_2_sat = 0;
											}
												echo round($question_2_sat, 2);
											?></td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Property Overall</td>
                                            <td><?php 
											$jan_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '1', 'q_3');$jan_q1 = $jan_count_1[0]->total_q_counts;
											if($jan_q1 !=''){$jan_q1_div = ($jan_q1/$jan_count[0]->total_counts);
												echo $jan_final_q1 = round($jan_q1_div,2);
											}else{echo '--'; $jan_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$feb_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '2', 'q_3');$feb_q1 = $feb_count_1[0]->total_q_counts;
											if($feb_q1 !=''){$feb_q1_div = ($feb_q1/$feb_count[0]->total_counts);
												echo $feb_final_q1 = round($feb_q1_div,2);
											}else{echo '--'; $feb_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$mar_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '3', 'q_3');$mar_q1 = $mar_count_1[0]->total_q_counts;
											if($mar_q1 !=''){$mar_q1_div = ($mar_q1/$mar_count[0]->total_counts);
												echo $mar_final_q1 = round($mar_q1_div,2);
											}else{echo '--'; $mar_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$apr_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '4', 'q_3');$apr_q1 = $apr_count_1[0]->total_q_counts;
											if($apr_q1 !=''){$apr_q1_div = ($apr_q1/$apr_count[0]->total_counts);
												echo $apr_final_q1 = round($apr_q1_div,2);
											}else{echo '--'; $apr_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$may_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '5', 'q_3');$may_q1 = $may_count_1[0]->total_q_counts;
											if($may_q1 !=''){$may_q1_div = ($may_q1/$may_count[0]->total_counts);
												echo $may_final_q1 = round($may_q1_div,2);
											}else{echo '--'; $may_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jun_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '6', 'q_3');$jun_q1 = $jun_count_1[0]->total_q_counts;
											if($jun_q1 !=''){$jun_q1_div = ($jun_q1/$jun_count[0]->total_counts);
												echo $jun_final_q1 = round($jun_q1_div,2);
											}else{echo '--'; $jun_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jul_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '7', 'q_3');$jul_q1 = $jul_count_1[0]->total_q_counts;
											if($jul_q1 !=''){$jul_q1_div = ($jul_q1/$jul_count[0]->total_counts);
												echo $jul_final_q1 = round($jul_q1_div,2);
											}else{echo '--'; $jul_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$aug_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '8', 'q_3');$aug_q1 = $aug_count_1[0]->total_q_counts;
											if($aug_q1 !=''){$aug_q1_div = ($aug_q1/$aug_count[0]->total_counts);
												echo $aug_final_q1 = round($aug_q1_div,2);
											}else{echo '--'; $aug_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$sep_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '9', 'q_3');$sep_q1 = $sep_count_1[0]->total_q_counts;
											if($sep_q1 !=''){$sep_q1_div = ($sep_q1/$sep_count[0]->total_counts);
												echo $sep_final_q1 = round($sep_q1_div,2);
											}else{echo '--'; $sep_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$oct_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '10', 'q_3');$oct_q1 = $oct_count_1[0]->total_q_counts;
											if($oct_q1 !=''){$oct_q1_div = ($oct_q1/$oct_count[0]->total_counts);
												echo $oct_final_q1 = round($oct_q1_div,2);
											}else{echo '--'; $oct_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$nov_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '11', 'q_3');$nov_q1 = $nov_count_1[0]->total_q_counts;
											if($nov_q1 !=''){$nov_q1_div = ($nov_q1/$nov_count[0]->total_counts);
												echo $nov_final_q1 = round($nov_q1_div,2);
											}else{echo '--'; $nov_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$dec_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '12', 'q_3');$dec_q1 = $dec_count_1[0]->total_q_counts;
											if($dec_q1 !=''){$dec_q1_div = ($dec_q1/$dec_count[0]->total_counts);
												echo $dec_final_q1 = round($dec_q1_div,2);
											}else{echo '--'; $dec_final_q1 = '0';}?>
                                            </td>
                                            <td class="active"><?php 
											if($full_total > 0){
												$question_3_sat = ($jan_count_1[0]->total_q_counts+$feb_count_1[0]->total_q_counts+$mar_count_1[0]->total_q_counts+$apr_count_1[0]->total_q_counts+$may_count_1[0]->total_q_counts+$jun_count_1[0]->total_q_counts+$jul_count_1[0]->total_q_counts+$aug_count_1[0]->total_q_counts+$sep_count_1[0]->total_q_counts+$oct_count_1[0]->total_q_counts+$nov_count_1[0]->total_q_counts+$dec_count_1[0]->total_q_counts) / $full_total;
											}else{
												$question_3_sat = 0;
											}
												echo round($question_3_sat, 2);
											?></td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Maintenance and Upkeep</td>
                                            <td><?php 
											$jan_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '1', 'q_4');$jan_q1 = $jan_count_1[0]->total_q_counts;
											if($jan_q1 !=''){$jan_q1_div = ($jan_q1/$jan_count[0]->total_counts);
												echo $jan_final_q1 = round($jan_q1_div,2);
											}else{echo '--'; $jan_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$feb_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '2', 'q_4');$feb_q1 = $feb_count_1[0]->total_q_counts;
											if($feb_q1 !=''){$feb_q1_div = ($feb_q1/$feb_count[0]->total_counts);
												echo $feb_final_q1 = round($feb_q1_div,2);
											}else{echo '--'; $feb_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$mar_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '3', 'q_4');$mar_q1 = $mar_count_1[0]->total_q_counts;
											if($mar_q1 !=''){$mar_q1_div = ($mar_q1/$mar_count[0]->total_counts);
												echo $mar_final_q1 = round($mar_q1_div,2);
											}else{echo '--'; $mar_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$apr_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '4', 'q_4');$apr_q1 = $apr_count_1[0]->total_q_counts;
											if($apr_q1 !=''){$apr_q1_div = ($apr_q1/$apr_count[0]->total_counts);
												echo $apr_final_q1 = round($apr_q1_div,2);
											}else{echo '--'; $apr_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$may_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '5', 'q_4');$may_q1 = $may_count_1[0]->total_q_counts;
											if($may_q1 !=''){$may_q1_div = ($may_q1/$may_count[0]->total_counts);
												echo $may_final_q1 = round($may_q1_div,2);
											}else{echo '--'; $may_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jun_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '6', 'q_4');$jun_q1 = $jun_count_1[0]->total_q_counts;
											if($jun_q1 !=''){$jun_q1_div = ($jun_q1/$jun_count[0]->total_counts);
												echo $jun_final_q1 = round($jun_q1_div,2);
											}else{echo '--'; $jun_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jul_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '7', 'q_4');$jul_q1 = $jul_count_1[0]->total_q_counts;
											if($jul_q1 !=''){$jul_q1_div = ($jul_q1/$jul_count[0]->total_counts);
												echo $jul_final_q1 = round($jul_q1_div,2);
											}else{echo '--'; $jul_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$aug_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '8', 'q_4');$aug_q1 = $aug_count_1[0]->total_q_counts;
											if($aug_q1 !=''){$aug_q1_div = ($aug_q1/$aug_count[0]->total_counts);
												echo $aug_final_q1 = round($aug_q1_div,2);
											}else{echo '--'; $aug_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$sep_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '9', 'q_4');$sep_q1 = $sep_count_1[0]->total_q_counts;
											if($sep_q1 !=''){$sep_q1_div = ($sep_q1/$sep_count[0]->total_counts);
												echo $sep_final_q1 = round($sep_q1_div,2);
											}else{echo '--'; $sep_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$oct_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '10', 'q_4');$oct_q1 = $oct_count_1[0]->total_q_counts;
											if($oct_q1 !=''){$oct_q1_div = ($oct_q1/$oct_count[0]->total_counts);
												echo $oct_final_q1 = round($oct_q1_div,2);
											}else{echo '--'; $oct_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$nov_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '11', 'q_4');$nov_q1 = $nov_count_1[0]->total_q_counts;
											if($nov_q1 !=''){$nov_q1_div = ($nov_q1/$nov_count[0]->total_counts);
												echo $nov_final_q1 = round($nov_q1_div,2);
											}else{echo '--'; $nov_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$dec_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '12', 'q_4');$dec_q1 = $dec_count_1[0]->total_q_counts;
											if($dec_q1 !=''){$dec_q1_div = ($dec_q1/$dec_count[0]->total_counts);
												echo $dec_final_q1 = round($dec_q1_div,2);
											}else{echo '--'; $dec_final_q1 = '0';}?>
                                            </td>
                                            <td class="active"><?php 
											if($full_total > 0){
												$question_4_sat = ($jan_count_1[0]->total_q_counts+$feb_count_1[0]->total_q_counts+$mar_count_1[0]->total_q_counts+$apr_count_1[0]->total_q_counts+$may_count_1[0]->total_q_counts+$jun_count_1[0]->total_q_counts+$jul_count_1[0]->total_q_counts+$aug_count_1[0]->total_q_counts+$sep_count_1[0]->total_q_counts+$oct_count_1[0]->total_q_counts+$nov_count_1[0]->total_q_counts+$dec_count_1[0]->total_q_counts) / $full_total;
											}else{
												$question_4_sat = 0;
											}
												echo round($question_4_sat, 2);
											?></td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Staff Service</td>
                                            <td><?php 
											$jan_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '1', 'q_5');$jan_q1 = $jan_count_1[0]->total_q_counts;
											if($jan_q1 !=''){$jan_q1_div = ($jan_q1/$jan_count[0]->total_counts);
												echo $jan_final_q1 = round($jan_q1_div,2);
											}else{echo '--'; $jan_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$feb_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '2', 'q_5');$feb_q1 = $feb_count_1[0]->total_q_counts;
											if($feb_q1 !=''){$feb_q1_div = ($feb_q1/$feb_count[0]->total_counts);
												echo $feb_final_q1 = round($feb_q1_div,2);
											}else{echo '--'; $feb_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$mar_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '3', 'q_5');$mar_q1 = $mar_count_1[0]->total_q_counts;
											if($mar_q1 !=''){$mar_q1_div = ($mar_q1/$mar_count[0]->total_counts);
												echo $mar_final_q1 = round($mar_q1_div,2);
											}else{echo '--'; $mar_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$apr_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '4', 'q_5');$apr_q1 = $apr_count_1[0]->total_q_counts;
											if($apr_q1 !=''){$apr_q1_div = ($apr_q1/$apr_count[0]->total_counts);
												echo $apr_final_q1 = round($apr_q1_div,2);
											}else{echo '--'; $apr_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$may_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '5', 'q_5');$may_q1 = $may_count_1[0]->total_q_counts;
											if($may_q1 !=''){$may_q1_div = ($may_q1/$may_count[0]->total_counts);
												echo $may_final_q1 = round($may_q1_div,2);
											}else{echo '--'; $may_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jun_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '6', 'q_5');$jun_q1 = $jun_count_1[0]->total_q_counts;
											if($jun_q1 !=''){$jun_q1_div = ($jun_q1/$jun_count[0]->total_counts);
												echo $jun_final_q1 = round($jun_q1_div,2);
											}else{echo '--'; $jun_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jul_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '7', 'q_5');$jul_q1 = $jul_count_1[0]->total_q_counts;
											if($jul_q1 !=''){$jul_q1_div = ($jul_q1/$jul_count[0]->total_counts);
												echo $jul_final_q1 = round($jul_q1_div,2);
											}else{echo '--'; $jul_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$aug_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '8', 'q_5');$aug_q1 = $aug_count_1[0]->total_q_counts;
											if($aug_q1 !=''){$aug_q1_div = ($aug_q1/$aug_count[0]->total_counts);
												echo $aug_final_q1 = round($aug_q1_div,2);
											}else{echo '--'; $aug_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$sep_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '9', 'q_5');$sep_q1 = $sep_count_1[0]->total_q_counts;
											if($sep_q1 !=''){$sep_q1_div = ($sep_q1/$sep_count[0]->total_counts);
												echo $sep_final_q1 = round($sep_q1_div,2);
											}else{echo '--'; $sep_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$oct_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '10', 'q_5');$oct_q1 = $oct_count_1[0]->total_q_counts;
											if($oct_q1 !=''){$oct_q1_div = ($oct_q1/$oct_count[0]->total_counts);
												echo $oct_final_q1 = round($oct_q1_div,2);
											}else{echo '--'; $oct_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$nov_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '11', 'q_5');$nov_q1 = $nov_count_1[0]->total_q_counts;
											if($nov_q1 !=''){$nov_q1_div = ($nov_q1/$nov_count[0]->total_counts);
												echo $nov_final_q1 = round($nov_q1_div,2);
											}else{echo '--'; $nov_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$dec_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '12', 'q_5');$dec_q1 = $dec_count_1[0]->total_q_counts;
											if($dec_q1 !=''){$dec_q1_div = ($dec_q1/$dec_count[0]->total_counts);
												echo $dec_final_q1 = round($dec_q1_div,2);
											}else{echo '--'; $dec_final_q1 = '0';}?>
                                            </td>
                                            <td class="active"><?php 
											if($full_total > 0){
												$question_5_sat = ($jan_count_1[0]->total_q_counts+$feb_count_1[0]->total_q_counts+$mar_count_1[0]->total_q_counts+$apr_count_1[0]->total_q_counts+$may_count_1[0]->total_q_counts+$jun_count_1[0]->total_q_counts+$jul_count_1[0]->total_q_counts+$aug_count_1[0]->total_q_counts+$sep_count_1[0]->total_q_counts+$oct_count_1[0]->total_q_counts+$nov_count_1[0]->total_q_counts+$dec_count_1[0]->total_q_counts) / $full_total;
											}else{
												$question_5_sat = 0;
											}
												echo round($question_5_sat, 2);
											?></td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Room Overall</td>
                                            <td><?php 
											$jan_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '1', 'q_6');$jan_q1 = $jan_count_1[0]->total_q_counts;
											if($jan_q1 !=''){$jan_q1_div = ($jan_q1/$jan_count[0]->total_counts);
												echo $jan_final_q1 = round($jan_q1_div,2);
											}else{echo '--'; $jan_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$feb_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '2', 'q_6');$feb_q1 = $feb_count_1[0]->total_q_counts;
											if($feb_q1 !=''){$feb_q1_div = ($feb_q1/$feb_count[0]->total_counts);
												echo $feb_final_q1 = round($feb_q1_div,2);
											}else{echo '--'; $feb_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$mar_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '3', 'q_6');$mar_q1 = $mar_count_1[0]->total_q_counts;
											if($mar_q1 !=''){$mar_q1_div = ($mar_q1/$mar_count[0]->total_counts);
												echo $mar_final_q1 = round($mar_q1_div,2);
											}else{echo '--'; $mar_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$apr_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '4', 'q_6');$apr_q1 = $apr_count_1[0]->total_q_counts;
											if($apr_q1 !=''){$apr_q1_div = ($apr_q1/$apr_count[0]->total_counts);
												echo $apr_final_q1 = round($apr_q1_div,2);
											}else{echo '--'; $apr_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$may_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '5', 'q_6');$may_q1 = $may_count_1[0]->total_q_counts;
											if($may_q1 !=''){$may_q1_div = ($may_q1/$may_count[0]->total_counts);
												echo $may_final_q1 = round($may_q1_div,2);
											}else{echo '--'; $may_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jun_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '6', 'q_6');$jun_q1 = $jun_count_1[0]->total_q_counts;
											if($jun_q1 !=''){$jun_q1_div = ($jun_q1/$jun_count[0]->total_counts);
												echo $jun_final_q1 = round($jun_q1_div,2);
											}else{echo '--'; $jun_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jul_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '7', 'q_6');$jul_q1 = $jul_count_1[0]->total_q_counts;
											if($jul_q1 !=''){$jul_q1_div = ($jul_q1/$jul_count[0]->total_counts);
												echo $jul_final_q1 = round($jul_q1_div,2);
											}else{echo '--'; $jul_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$aug_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '8', 'q_6');$aug_q1 = $aug_count_1[0]->total_q_counts;
											if($aug_q1 !=''){$aug_q1_div = ($aug_q1/$aug_count[0]->total_counts);
												echo $aug_final_q1 = round($aug_q1_div,2);
											}else{echo '--'; $aug_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$sep_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '9', 'q_6');$sep_q1 = $sep_count_1[0]->total_q_counts;
											if($sep_q1 !=''){$sep_q1_div = ($sep_q1/$sep_count[0]->total_counts);
												echo $sep_final_q1 = round($sep_q1_div,2);
											}else{echo '--'; $sep_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$oct_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '10', 'q_6');$oct_q1 = $oct_count_1[0]->total_q_counts;
											if($oct_q1 !=''){$oct_q1_div = ($oct_q1/$oct_count[0]->total_counts);
												echo $oct_final_q1 = round($oct_q1_div,2);
											}else{echo '--'; $oct_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$nov_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '11', 'q_6');$nov_q1 = $nov_count_1[0]->total_q_counts;
											if($nov_q1 !=''){$nov_q1_div = ($nov_q1/$nov_count[0]->total_counts);
												echo $nov_final_q1 = round($nov_q1_div,2);
											}else{echo '--'; $nov_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$dec_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '12', 'q_6');$dec_q1 = $dec_count_1[0]->total_q_counts;
											if($dec_q1 !=''){$dec_q1_div = ($dec_q1/$dec_count[0]->total_counts);
												echo $dec_final_q1 = round($dec_q1_div,2);
											}else{echo '--'; $dec_final_q1 = '0';}?>
                                            </td>
                                            <td class="active"><?php 
											if($full_total > 0){
												$question_6_sat = ($jan_count_1[0]->total_q_counts+$feb_count_1[0]->total_q_counts+$mar_count_1[0]->total_q_counts+$apr_count_1[0]->total_q_counts+$may_count_1[0]->total_q_counts+$jun_count_1[0]->total_q_counts+$jul_count_1[0]->total_q_counts+$aug_count_1[0]->total_q_counts+$sep_count_1[0]->total_q_counts+$oct_count_1[0]->total_q_counts+$nov_count_1[0]->total_q_counts+$dec_count_1[0]->total_q_counts) / $full_total;
											}else{
												$question_6_sat = 0;
											}
												echo round($question_6_sat, 2);
											?></td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Room Cleanliness</td>
                                            <td><?php 
											$jan_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '1', 'q_7');$jan_q1 = $jan_count_1[0]->total_q_counts;
											if($jan_q1 !=''){$jan_q1_div = ($jan_q1/$jan_count[0]->total_counts);
												echo $jan_final_q1 = round($jan_q1_div,2);
											}else{echo '--'; $jan_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$feb_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '2', 'q_7');$feb_q1 = $feb_count_1[0]->total_q_counts;
											if($feb_q1 !=''){$feb_q1_div = ($feb_q1/$feb_count[0]->total_counts);
												echo $feb_final_q1 = round($feb_q1_div,2);
											}else{echo '--'; $feb_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$mar_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '3', 'q_7');$mar_q1 = $mar_count_1[0]->total_q_counts;
											if($mar_q1 !=''){$mar_q1_div = ($mar_q1/$mar_count[0]->total_counts);
												echo $mar_final_q1 = round($mar_q1_div,2);
											}else{echo '--'; $mar_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$apr_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '4', 'q_7');$apr_q1 = $apr_count_1[0]->total_q_counts;
											if($apr_q1 !=''){$apr_q1_div = ($apr_q1/$apr_count[0]->total_counts);
												echo $apr_final_q1 = round($apr_q1_div,2);
											}else{echo '--'; $apr_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$may_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '5', 'q_7');$may_q1 = $may_count_1[0]->total_q_counts;
											if($may_q1 !=''){$may_q1_div = ($may_q1/$may_count[0]->total_counts);
												echo $may_final_q1 = round($may_q1_div,2);
											}else{echo '--'; $may_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jun_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '6', 'q_7');$jun_q1 = $jun_count_1[0]->total_q_counts;
											if($jun_q1 !=''){$jun_q1_div = ($jun_q1/$jun_count[0]->total_counts);
												echo $jun_final_q1 = round($jun_q1_div,2);
											}else{echo '--'; $jun_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$jul_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '7', 'q_7');$jul_q1 = $jul_count_1[0]->total_q_counts;
											if($jul_q1 !=''){$jul_q1_div = ($jul_q1/$jul_count[0]->total_counts);
												echo $jul_final_q1 = round($jul_q1_div,2);
											}else{echo '--'; $jul_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$aug_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '8', 'q_7');$aug_q1 = $aug_count_1[0]->total_q_counts;
											if($aug_q1 !=''){$aug_q1_div = ($aug_q1/$aug_count[0]->total_counts);
												echo $aug_final_q1 = round($aug_q1_div,2);
											}else{echo '--'; $aug_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$sep_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '9', 'q_7');$sep_q1 = $sep_count_1[0]->total_q_counts;
											if($sep_q1 !=''){$sep_q1_div = ($sep_q1/$sep_count[0]->total_counts);
												echo $sep_final_q1 = round($sep_q1_div,2);
											}else{echo '--'; $sep_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$oct_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '10', 'q_7');$oct_q1 = $oct_count_1[0]->total_q_counts;
											if($oct_q1 !=''){$oct_q1_div = ($oct_q1/$oct_count[0]->total_counts);
												echo $oct_final_q1 = round($oct_q1_div,2);
											}else{echo '--'; $oct_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$nov_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '11', 'q_7');$nov_q1 = $nov_count_1[0]->total_q_counts;
											if($nov_q1 !=''){$nov_q1_div = ($nov_q1/$nov_count[0]->total_counts);
												echo $nov_final_q1 = round($nov_q1_div,2);
											}else{echo '--'; $nov_final_q1 = '0';}?>
                                            </td>
                                            <td><?php 
											$dec_count_1 = survey_helper::get_survey_counts_by_month_and_question($firm_id, '12', 'q_7');$dec_q1 = $dec_count_1[0]->total_q_counts;
											if($dec_q1 !=''){$dec_q1_div = ($dec_q1/$dec_count[0]->total_counts);
												echo $dec_final_q1 = round($dec_q1_div,2);
											}else{echo '--'; $dec_final_q1 = '0';}?>
                                            </td>
                                            <td class="active"><?php 
											if($full_total > 0){
											$question_7_sat = ($jan_count_1[0]->total_q_counts+$feb_count_1[0]->total_q_counts+$mar_count_1[0]->total_q_counts+$apr_count_1[0]->total_q_counts+$may_count_1[0]->total_q_counts+$jun_count_1[0]->total_q_counts+$jul_count_1[0]->total_q_counts+$aug_count_1[0]->total_q_counts+$sep_count_1[0]->total_q_counts+$oct_count_1[0]->total_q_counts+$nov_count_1[0]->total_q_counts+$dec_count_1[0]->total_q_counts) / $full_total;
											}else{
												$question_7_sat = 0;
											}
												echo round($question_7_sat, 2);
											?></td>
                                            <td>0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>