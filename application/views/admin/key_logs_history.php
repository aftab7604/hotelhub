<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">History </h4> </div>
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
								$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
								$current_Month	= date('m');
								$current_Year	= date('Y');
								
								if(isset($_POST['submit'])){
									$dateStart		= new DateTime($_POST['start_date']);
									$dateEnd		= new DateTime($_POST['end_date']);									
									$start_date		= $_POST['start_date'];
									$end_date		= $_POST['end_date'];
								}else{
									$curr_date		= gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
									$start_date		= $end_date	= $curr_date;
								}
                             ?>
                             <!--manage form data-->
                             <form action="<?php echo base_url();?>key_log/history" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <h3 class="box-title"></h3>
                                    <div class="row m-b-20">
                                        <div class="col-md-6">
                                        	<div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control" name="start_date" id="start_date" placeholder="yyyy-mm-dd" value="<?php echo $start_date;?>" required />
                                                <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                <input type="text" class="form-control" name="end_date" id="end_date" placeholder="yyyy-mm-dd" value="<?php echo $end_date;?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Filter</button>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                             </form>
                            <div class="table-responsive">
                                <table id="myTableLead" class="table table-striped">
                                    <thead>
                                        <tr>
                                			<th>Key/Ring #</th>
                                            <th>Issued To</th>
                                            <th>Time Out</th>
                                            <th>Key Holder</th>
                                            <th>Witness</th>
                                            <th>Time In</th>
                                            <th>Key Holder</th>
                                            <th>Witness</th>
                                            <th>Status</th>
                                            <th>Full View</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                  
                                    	<?php if(is_array($key_logs)){$i=1;foreach($key_logs as $val){
											$return_by		= $return_witness = 0;
											$key_name		= admin_helper::get_key_name($val->key_id);
											$issued_to		= admin_helper::get_user_name($val->issued_to);
											$issued_witness	= admin_helper::get_user_name($val->issued_witness);
											if($val->returned_by != 0){
												$return_by		= admin_helper::get_user_name($val->returned_by);
												$return_by		= $return_by[0]->username;
												
												if($val->returned_witness != 0){
													$return_witness	= admin_helper::get_user_name($val->returned_witness);
													$return_witness	= $return_witness[0]->username;
												}
											}else{
												$return_witness	= 'Not Returned Yet!';
												$return_by		= 'Not Returned Yet!';
											}
											
										?>
                                            <tr>
                                            	<td><?php echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;?></td>
                                                <td><?php echo $issued_to[0]->username;?></td>
                                                <td><?php echo $val->time_out;?></td>
                                                <td><?php if($val->key_holderSig != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->key_holderSig;?>" width="120" height="" /><?php }?></td>
                                                <td><?php if($val->issued_witness_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->issued_witness_signature;?>" width="120" height="" /><br /><span style="color:red;"><?php echo date('Y-m-d h:i A', strtotime($val->issued_witness_date)); ?></span><?php }?></td>
                                                <td><?php echo $val->time_in;?></td>
                                                <td><?php if($val->returned_by_sig != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->returned_by_sig;?>" width="120" height="" /><?php }?></td>
                                                <td><?php if($val->returned_witness_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->returned_witness_signature;?>" width="120" height="" /><br /><span style="color:red;"><?php echo date('Y-m-d h:i A', strtotime($val->returned_witness_date)); ?></span><?php }?></td>
                                                <td><?php echo $val->key_status;?></td>
                                                <td><button type="button" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#keys_fullview_<?php echo $val->keylog_id;?>"><i class="fa fa-eye"></i></button></td>
                                            </tr>
                                            <div id="keys_fullview_<?php echo $val->keylog_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myModalLabel">Key Log Full View</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" id="" action="<?php echo base_url();?>" method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-6"><label class="control-label">Key/Ring#</label> <?php echo $key_name[0]->key_num.'--'.$key_name[0]->key_name;?></div>
                                                                    <div class="col-md-6"><label class="control-label">Key Holder:</label> <?php echo $issued_to[0]->username;?></div>
                                                                </div>
																<div class="row">
                                                                    <div class="col-md-6"><label class="control-label">e-Signature:</label> <?php if($val->key_holderSig != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->key_holderSig;?>" width="120" height="" /><?php }?></div>
                                                                    <div class="col-md-6 m-t-10"><label class="control-label">Time OUT:</label> <?php echo $val->time_out;?></div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-6"><label class="control-label">Date/Time</label> <?php echo date('Y-m-d h:i A', strtotime($val->created_date));?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                                
                                                                <?php if($val->key_status == 'Issued' || $val->key_status == 'Returned' || $val->key_status == 'Completed'){ ?>
                                                                <div class="row"><div class="col-md-12"><hr /></div></div>
                                                                <div class="row">
                                                                    <div class="col-md-6 m-t-10"><label class="control-label">Issue Witness</label> <?php if($val->issued_witness != ''){echo $issued_witness[0]->username;}?></div>
                                                                    <div class="col-md-6"><label class="control-label">Witness e-Signature:</label> <?php if($val->issued_witness_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->issued_witness_signature;?>" width="120" height="" /><?php }?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->issued_witness_notes);?></div>
                                                                    <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->issued_witness_filename != ''){?><img src="<?php echo base_url();?>assets/images/key_logs/<?php echo $val->issued_witness_filename;?>" width="120" height="50" /><?php }?></div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-6"><label class="control-label">Date/Time</label> <?php if($val->issued_witness != ''){echo date('Y-m-d h:i A', strtotime($val->issued_witness_date));}?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                                
                                                                <?php } ?>
                                                                <?php if($val->key_status == 'Returned' || $val->key_status == 'Completed'){ ?>
                                                                <div class="row"><div class="col-md-12"><hr /></div></div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6 m-t-10"><label class="control-label">Returned By:</label> <?php if($val->returned_by != 0){echo $return_by;}?></div>
                                                                    <div class="col-md-6"><label class="control-label">Witness e-Signature:</label> <?php if($val->returned_by_sig != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->returned_by_sig;?>" width="120" height="" /><?php }?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6"><label class="control-label">Time IN:</label> <?php echo $val->time_in;?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                                <?php } ?>
                                                                <?php if($val->key_status == 'Completed'){ ?>
                                                                <div class="row"><div class="col-md-12"><hr /></div></div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6 m-t-10"><label class="control-label">Return Witness</label> <?php if($val->returned_witness != ''){echo $return_witness;}?></div>
                                                                    <div class="col-md-6"><label class="control-label">Witness e-Signature:</label> <?php if($val->returned_witness_signature != ''){?><img src="<?php echo base_url();?>assets/images/eSignatures/<?php echo $val->returned_witness_signature;?>" width="120" height="" /><?php }?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6"><label class="control-label">Notes:</label> <?php echo htmlspecialchars_decode($val->returned_witness_notes);?></div>
                                                                    <div class="col-md-6"><label class="control-label">Attachment:</label> <?php if($val->returned_witness_filename != ''){?><img src="<?php echo base_url();?>assets/images/key_logs/<?php echo $val->returned_witness_filename;?>" width="120" height="50" /><?php }?></div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-6"><label class="control-label">Date/Time</label> <?php if($val->returned_witness != ''){echo date('Y-m-d h:i A', strtotime($val->returned_witness_date));}?></div>
                                                                    <div class="col-md-6"></div>
                                                                </div>
                                                                <?php } ?>
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>                                               
                                                    </div>
                                                </div>
                                            </div>
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