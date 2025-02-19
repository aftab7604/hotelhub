    
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Survey History</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Survey History Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Survey History (<?php echo date('Y');?>)</div>
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
                             <div class="row">
								<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                    <select id="demo-show-entries" class="form-control input-sm">
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select> 
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"></div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                	<button class="btn btn-warning waves-effect waves-light" onclick="expandAll();">Expand All</button>
                                	<button class="btn btn-warning waves-effect waves-light" onclick="collapseAll();">Collapse All</button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                	<input id="demo-input-search22" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                </div>
                                <table id="demo-foo-row-toggler" class="table m-b-0 toggle-arrow-tiny">
                                    <thead><tr>                                            
                                            <th data-toggle="true">Guest Name</th>
                                            <th data-toggle="true">Email</th>
                                            <th data-toggle="true">Room#</th>
                                            <th data-toggle="true">Check-In</th>
                                            <th data-toggle="true">Call Back</th>
                                            <th data-toggle="true">GSS - Overall Satisfaction</th>
                                            <th data-hide="all">Check-In Experience</th>
                                            <th data-hide="all">Property Overall</th>
                                            <th data-hide="all">Maintenance and Upkeep</th>
                                            <th data-hide="all">Staff Service</th>
                                            <th data-hide="all">Room Overall</th>
                                            <th data-hide="all">Room Cleanliness</th>
                                            <th data-hide="all">Customer Comments</th>
                                            <th data-toggle="true">Suvey Created</th>
                                    </tr></thead>
                                <tbody>
                                <?php if(is_array($survey_score_info)){
									foreach($survey_score_info as $val){?>
                                        <tr data-expanded="true">
                                            <td><?php echo $val->guest_name;?></td>
                                            <td><?php echo $val->guest_email;?></td>
                                            <td><?php echo $val->room_no;?></td>
                                            <td><?php echo $val->time_in;?></td>
                                            <td><?php echo $val->call_back;?></td>
                                            <!--<td><?php echo $val->q_1;?></td>-->
                                            <td><?php $new_width = ($val->q_1 / 10) * (100);
												if($val->q_1 <= 8){$status = 'danger';}else if($val->q_1 > 8){$status = 'success';}?>
                                                <span class="text-<?php echo $status;?>"><?php echo $val->q_1;?> Score</span><div class="progress">
                                                <div class="progress-bar progress-bar-<?php echo $status;?>" role="progressbar" aria-valuenow="<?php echo $new_width;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $new_width;?>%;"> <span class="sr-only"><?php echo $val->q_1;?> Score</span></div>
                                                </div>
                                            </td>
                                            <td><?php echo $val->q_2;?></td>
                                            <td><?php echo $val->q_3;?></td>
                                            <td><?php echo $val->q_4;?></td>
                                            <td><?php echo $val->q_5;?></td>
                                            <td><?php echo $val->q_6;?></td>
                                            <td><?php echo $val->q_7;?></td>
                                            <td><?php echo $val->feedback;?></td>
                                            <td><?php echo date("d M, Y", strtotime($val->added_date));?></td>
                                            <!--<td><?php $hotel_name = admin_helper::get_hotel_name($val->hotel_id); echo $hotel_name[0]->hotel_name;?></td>
                                            <td><?php $new_width = ($val->q_1 / 10) * (100);
											if($val->q_1 < 1){$status = 'danger';}else if($val->q_1 > 1 && $val->q_1 <= 5){$status = 'warning';}else if($val->q_1 > 8){$status = 'success';}
											?>
                                                <span class="text-<?php echo $status;?>"><?php echo $new_width;?>%</span>
                                                <div class="progress">
                                                	<div class="progress-bar progress-bar-<?php echo $status;?>" role="progressbar" aria-valuenow="<?php echo $new_width;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $new_width;?>%;"> <span class="sr-only"><?php echo $new_width;?>% Complete</span></div>
                                            	</div>
                                            </td>-->
                                        </tr>
									<?php }}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-right">
                                                <ul class="pagination pagination-split m-t-10"></ul>
                                            </div>
                                        </td>
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