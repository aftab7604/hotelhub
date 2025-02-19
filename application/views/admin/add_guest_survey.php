
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add Guest Survey</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Add Guest Survey Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> Manage Your Guest Survey</div>
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
                        <form action="" id="guestSurveyInfo" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <h3 class="box-title text-center">Welcome to the <?php echo $hotel_name[0]->hotel_name;?></h3>
                                <hr>
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
                                            <label class="col-md-5">GSS - Overall Satisfaction</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-1" value="1" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Check-In Experience</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-2" value="2" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Property Overall</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-3" value="3" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Maintenance and Upkeep</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-4" value="4" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Staff Service</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-5" value="5" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Room Overall</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-6" value="7" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Room Cleanliness</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-7" value="7" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            </div>
                            <div class="form-actions m-t-10 text-center">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?php echo base_url();?>"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
	$('#toggle-trigger-1').bootstrapToggle('<?php echo $survey_info[0]->q_1;?>');
	$('#toggle-trigger-2').bootstrapToggle('<?php echo $survey_info[0]->q_2;?>');
	$('#toggle-trigger-3').bootstrapToggle('<?php echo $survey_info[0]->q_3;?>');
	$('#toggle-trigger-4').bootstrapToggle('<?php echo $survey_info[0]->q_4;?>');
	$('#toggle-trigger-5').bootstrapToggle('<?php echo $survey_info[0]->q_5;?>');
	$('#toggle-trigger-6').bootstrapToggle('<?php echo $survey_info[0]->q_6;?>');
	$('#toggle-trigger-7').bootstrapToggle('<?php echo $survey_info[0]->q_7;?>');
});
</script>