
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Mass Survey</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Mass Survey Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Manage Mass Survey <a href="<?php echo base_url();?>guest_survey/mass_survey_questions"><button class="btn btn-danger waves-effect waves-light pull-right">Survey Questions</button></a>
            </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
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
						   	$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
							$hotel_name = admin_helper::get_hotel_name($hotel_id);
						 ?>
                         <!--Add hotel form-->
                         <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
                        <form action="" id="MassSurveyInfo" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <h3 class="box-title text-center">Welcome to the <?php echo $hotel_name[0]->hotel_name;?></h3><hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Email Body Message:</label>
                                            <div class="col-md-12">
                                            <?php if($survey_info[0]->message != ''){?>
                                            	<textarea class="form-control" name="message" id="message" rows="5"><?php echo $survey_info[0]->message;?></textarea>
                                            <?php }else{?>
                                                <textarea class="form-control" name="message" id="message" rows="5">Thank you for choosing the <?php echo $hotel_name[0]->hotel_name;?>! It is a privilege and honor to have you as our guest. We would greatly appreciate your feedback as we continue to improve our guest service experience. Below their are some rating sections please tell us how we are doing:
</textarea>
											<?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Questions which you want show/hide in email survey:</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                        	<label class="col-md-4"></label>
                                            <div class="col-md-2">
                                                <select class="selectpicker" multiple data-style="form-control" name="questions_1[]" id="questions_1">
                                                    <?php if(is_array($survey_questions)){foreach($survey_questions as $val){?>
                                                    	<option value="<?php echo $val->q_id;?>" <?php if($val->q_state == 'on'){echo 'selected';}?>><?php echo $val->question;?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                         	<div class="col-md-6"></div>
                                    	</div>
                                    </div>
                               </div>
                                
                                
                                
                                <?php if(is_array($survey_questions)){
									foreach($survey_questions as $val){?>
										<!--<div class="row m-t-10">
											<div class="col-md-12 col-md-offset-1">
												<div class="form-group">
													<label class="col-md-4"><?php echo $val->question;?></label>
													<div class="col-md-1">
													   <input class="survey_questions" name="questions[]" id="toggle-trigger-<?php echo $val->q_id;?>" value="<?php echo $val->q_id;?>" data-toggle="toggle" type="checkbox">
													</div>
                                                    <div class="col-md-6">
                                                    </div>
												</div>
											</div>
										</div>-->
                                <?php }}?>
                                                    	<!--<input type="url" class="form-control" name="red_url[]" value="" placeholder="Yes URL" /><input type="url" class="form-control" name="red_url[]" value="" placeholder="No URL" />-->
                                
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Additonal Content For Email:</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="ad_notes" id="ad_notes" rows="5"><?php echo $survey_info[0]->notes;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Email Footer:</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="footer" id="footer" rows="5"><?php echo $survey_info[0]->footer;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Thank You Message:</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="thank_you_message" id="thank_you_message" value="<?php echo $survey_info[0]->thank_you_message;?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions m-t-10 text-center">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#preview_email"> <i class="fa fa-eye"></i> Preview</button>
                                <a href="<?php echo base_url();?>"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                        <div id="preview_email" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Welcome to the <?php echo $hotel_name[0]->hotel_name;?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="text-center">Welcome to the <?php echo $hotel_name[0]->hotel_name;?></h4>
                                        <p><?php if($survey_info[0]->message != ''){echo $survey_info[0]->message;}else{?>Thank you for choosing the <?php echo $hotel_name[0]->hotel_name;?>! It is a privilege and honor to have you as our guest. We would greatly appreciate your feedback as we continue to improve our guest service experience. Below their are some rating sections please tell us how we are doing:<?php }?></p>
                                        <p>&nbsp;</p>
                                        <?php if(is_array($survey_questions)){foreach($survey_questions as $val){
											if($val->q_state == 'on'){?>
                                                <p><p style="margin-bottom: 0px;"><b><?php echo $val->question;?></b></p>
                                                    <div class="btn-group" data-toggle="buttons">
                                                    	<?php if($val->label_1 != ''){?>
                                                        <label class="btn btn-default form-check-label">
                                                            <input type="radio" value="10"> <?php echo $val->label_1;?>
                                                        </label>
                                                        <?php }if($val->label_2 != ''){?>
                                                        <label class="btn btn-default form-check-label">
                                                            <input type="radio" value="9"> <?php echo $val->label_2;?>
                                                        </label>
                                                        <?php }if($val->label_3 != ''){?>
                                                        <label class="btn btn-default form-check-label">
                                                            <input type="radio" value="8"> <?php echo $val->label_3;?>
                                                        </label>
                                                        <?php }if($val->label_4 != ''){?>
                                                        <label class="btn btn-default form-check-label">
                                                            <input type="radio" value="7"> <?php echo $val->label_4;?>
                                                        </label>
                                                        <?php }?>
                                                    </div>
                                                </p>
                                        <?php }}}?>
                                        <p>&nbsp;</p>
                                        <p><?php echo $survey_info[0]->notes;?></p>
                                        <p><?php echo $survey_info[0]->footer;?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
<?php if(is_array($survey_questions)){foreach($survey_questions as $val){?>
	$('#toggle-trigger-<?php echo $val->q_id;?>').bootstrapToggle('<?php echo $val->q_state;?>');
<?php }}?>
});
</script>