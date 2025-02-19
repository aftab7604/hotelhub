<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Brand Survey Box</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Un-Approved Survey Box Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">Un-Approved Survey Box</div>
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
                                            <th>Sr. #</th>
                                            <th>Guest Name</th>
                                            <th>Response Date</th>
                                            <th style="width:20px;">Ratting</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    	<?php $i=1; if(is_array($gv_tickets)){foreach($gv_tickets as $val){
											$email_body		= $val->message;
											$email_body_1	= str_replace("48 hours:", "48 hours.", $email_body);
											$email_body_2	= str_replace("Response Date", "Response / Review Date", $email_body_1);
											
											if (strpos($email_body_2, 'GSS Intent to Recommend') !== false) {}else{
												$email_body_2	= str_replace("Comments:", "<b>GSS Intent to Recommend:</b> <br> Comments:", $email_body_2);
											}
											
											$parsingData	= explode(":",strip_tags($email_body_2));
											$guestName		= trim(str_replace("Response / Review Date", "", $parsingData[1]));
											$reviewDate		= trim(str_replace("GSS Intent to Recommend", "", $parsingData[2]));
											$recommend		= trim(str_replace("Comments", "", $parsingData[3]));			
											$comments		= trim(strip_tags(str_replace("<br>", " ", $parsingData[4])));
										?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $guestName;?></td>
                                                <td><?php echo $reviewDate;?></td>
                                                <td style="width:20px;"><?php echo $recommend;?></td>
                                                <td><?php if($val->status == '1'){echo 'Approved';}else{echo 'Un-Approved';}?></td>
                                                <td><a href="<?php echo base_url();?>survey_box/edit_survey_box/<?php echo $val->g_id;?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></button></a> 
                                                	<a href="<?php echo base_url();?>survey_box/delete_survey/<?php echo $val->g_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
                                            </tr>
                                        <?php $i++; }}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>