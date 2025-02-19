
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Brand Survey Box</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Update Survey Box Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Update Survey Box</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
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
						 ?><!--Edit form-->
                        <form action="<?php echo base_url();?>survey_box/edit_survey_box_info" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <?php
									$email_body		= $guest_voice[0]->message;
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group m-b-5">
                                                    <label class="control-label">Guest Name</label>
                                                    <input type="text" name="guest_name" class="form-control" placeholder="Guest Name" value="<?php echo $guestName;?>" required>
                                                    <input type="hidden" name="g_id" value="<?php echo $guest_voice[0]->g_id;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group m-b-5">
                                                    <label class="control-label">Response / Review Date</label>
                                                    <input type="text" name="review_date" class="form-control" placeholder="Response / Review Date" value="<?php echo $reviewDate;?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group m-b-5">
                                                    <label class="control-label">GSS Intent to Recommend</label>
                                                    <input type="text" name="rattings" class="form-control" placeholder="GSS Intent to Recommend" value="<?php echo $recommend;?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group m-b-5">
                                                    <label class="control-label">Comments</label>
                                                    <textarea class="form-control" name="comments" rows="10"><?php echo $comments;?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group m-b-5">
                                                    <label class="control-label">Assign To Department</label>
                                                    <select class="form-control" name="assign_to_dept" required>
                                                        <option value="">Select Any Department</option>
                                                        <option value="2">MANAGER ON DUTY</option>
                                                        <option value="3" selected="selected">FRONT DESK</option>
                                                        <option value="4">HOUSEKEEPING</option>
                                                        <option value="5">FOOD &amp; BEVERAGE</option>
                                                        <option value="6">SALES</option>
                                                        <option value="7">MAINTENANCE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group m-b-5">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="">Status</option>
                                                        <option value="0" <?php if($guest_voice[0]->status == '0'){echo 'selected="selected"';}?>>Active</option>
                                                        <option value="1" <?php if($guest_voice[0]->status == '1'){echo 'selected="selected"';}?>>In-Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group m-b-5">
                                                    <label class="control-label">Original Email Content</label>
                                                    <textarea class="form-control" name="address" id="address" rows="30"><?php echo trim(strip_tags($guest_voice[0]->message));?></textarea>
                                                </div>
											</div>
                                    	</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Approved</button>
                                <a href="<?php echo base_url();?>survey_box/surveys"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>