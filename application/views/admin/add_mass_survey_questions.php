<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add Mass Survey Questions</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Add Mass Survey Question Page</li>
            </ol>
        </div>
    </div>
        
    <div id="add_question" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Question</h4>
                </div>
                <div class="modal-body">
                	<form class="form-horizontal" action="<?php echo base_url();?>guest_survey/mass_survey_add_question" method="post" enctype="multipart/form-data">
                        <div class="row">
                        	<div class="col-md-12">
                        		<label class="control-label">Question:</label>
                                <input type="text" class="form-control" id="question" name="question" placeholder="Type your question here" value="" required="required" />
                        	</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Label 01:</label>
                                <input type="text" class="form-control" id="label_1" name="label_1" placeholder="Label 01 of Question" value="" required="required" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label class="control-label">Redirect URL:</label>
                                <input type="text" class="form-control" name="red_yes" placeholder="Redirect URL In Case of this answer" value="" />
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-md-6">
                                <label class="control-label">Label 02:</label>
                                <input type="text" class="form-control" id="label_2" name="label_2" placeholder="Label 03 of Question" value="" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label class="control-label">Redirect URL:</label>
                                <input type="text" class="form-control" name="red_no" placeholder="Redirect URL In Case of this answer" value="" />
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-md-6">
                                <label class="control-label">Label 03:</label>
                                <input type="text" class="form-control" id="label_3" name="label_3" placeholder="Label 03 of Question" value="" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label class="control-label">Redirect URL:</label>
                                <input type="text" class="form-control" name="red_yes" placeholder="Redirect URL In Case of this answer" value="" />
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-md-6">
                                <label class="control-label">Label 04:</label>
                                <input type="text" class="form-control" id="label_4" name="label_4" placeholder="Label 03 of Question" value="" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label class="control-label">Redirect URL:</label>
                                <input type="text" class="form-control" name="red_yes" placeholder="Redirect URL In Case of this answer" value="" />
                            </div>
                        </div>
                        <!--<div class="row m-b-10">
                            <div class="col-md-6">
                                <label class="control-label">Redirect If Answer Is:</label>
                                <select class="form-control" name="red_if">
                                    <option value="0" selected="selected">-No Redirection-</option>
                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="col-md-6 p-l-0"></div>
                        </div>-->
                        <div class="modal-footer">
                        	<button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Save</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                    <!--<form class="form-horizontal" action="<?php echo base_url();?>guest_survey/mass_survey_add_question" method="post" enctype="multipart/form-data">
                        <div class="row">
                        	<div class="col-md-12">
                        		<label class="control-label">Question:</label>
                                <input type="text" class="form-control" id="question" name="question" placeholder="Type your question here" value="" required="required" />
                        	</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Label 01:</label>
                                <input type="text" class="form-control" id="label_1" name="label_1" placeholder="Label 01 of Question" value="" required="required" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label class="control-label">Label 02:</label>
                                <input type="text" class="form-control" id="label_2" name="label_2" placeholder="Label 02 of Question" value="" required="required" />
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-md-6">
                                <label class="control-label">Label 03:</label>
                                <input type="text" class="form-control" id="label_3" name="label_3" placeholder="Label 03 of Question" value="" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label class="control-label">Label 04:</label>
                                <input type="text" class="form-control" id="label_4" name="label_4" placeholder="Label 04 of Question" value="" />
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-md-6">
                                <label class="control-label">Redirect YES URL:</label>
                                <input type="text" class="form-control" name="red_yes" placeholder="Redirect URL In Case of YES" value="" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label class="control-label">Redirect NO URL:</label>
                                <input type="text" class="form-control" name="red_no" placeholder="Redirect URL In Case of NO" value="" />
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-md-6">
                                <label class="control-label">Redirect If Answer Is:</label>
                                <select class="form-control" name="red_if">
                                    <option value="0" selected="selected">-No Redirection-</option>
                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="col-md-6 p-l-0"></div>
                        </div>
                        <div class="modal-footer">
                        	<button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Save</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </form>-->
                </div>                                               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Add Mass Survey Questions <button class="btn btn-warning waves-effect waves-light pull-right" data-toggle="modal" data-target="#add_question">Add Question</button></div>
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
						 ?>
                         <!--Add rooms form-->
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Label 01</th>
                                        <th>Label 02</th>
                                        <th>Label 03</th>
                                        <th>Label 04</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($survey_questions)){foreach($survey_questions as $val){?>
                                    <tr>
                                        <td><?php echo $val->question;?></td>
                                        <td><?php echo $val->label_1;?></td>
                                        <td><?php echo $val->label_2;?></td>
                                        <td><?php echo $val->label_3;?></td>
                                        <td><?php echo $val->label_4;?></td>
                                        <td><button type="button" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target="#edit_question_<?php echo $val->q_id;?>"><i class="fa fa-pencil"></i></button> 
                                        <a href="<?php echo base_url();?>guest_survey/mass_survey_delete_question/<?php echo $val->q_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
                                    </tr>
                                    <div id="edit_question_<?php echo $val->q_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Edit Question</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="<?php echo base_url();?>guest_survey/mass_survey_update_question" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="control-label">Question:</label>
                                                                <input type="text" class="form-control" id="question" name="question" placeholder="Type your question here" value="<?php echo $val->question;?>" required="required" />
                                                                <input type="hidden" name="q_id" value="<?php echo $val->q_id;?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="control-label">Label 01:</label>
                                                                <input type="text" class="form-control" id="label_1" name="label_1" placeholder="Label 01 of Question" value="<?php echo $val->label_1;?>" required="required" />
                                                            </div>
                                                            <div class="col-md-6 p-l-0">
                                                                <label class="control-label">Label 02:</label>
                                                                <input type="text" class="form-control" id="label_2" name="label_2" placeholder="Label 02 of Question" value="<?php echo $val->label_2;?>" required="required" />
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-10">
                                                            <div class="col-md-6">
                                                                <label class="control-label">Label 03:</label>
                                                                <input type="text" class="form-control" id="label_3" name="label_3" placeholder="Label 03 of Question" value="<?php echo $val->label_3;?>" />
                                                            </div>
                                                            <div class="col-md-6 p-l-0">
                                                                <label class="control-label">Label 04:</label>
                                                                <input type="text" class="form-control" id="label_4" name="label_4" placeholder="Label 04 of Question" value="<?php echo $val->label_4;?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-10">
                                                            <div class="col-md-6">
                                                                <label class="control-label">Redirect YES URL:</label>
                                                                <input type="text" class="form-control" name="red_yes" placeholder="Redirect URL In Case of YES" value="<?php echo $val->red_yes;?>" />
                                                            </div>
                                                            <div class="col-md-6 p-l-0">
                                                                <label class="control-label">Redirect NO URL:</label>
                                                                <input type="text" class="form-control" name="red_no" placeholder="Redirect URL In Case of NO" value="<?php echo $val->red_no;?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-10">
                                                            <div class="col-md-6">
                                                                <label class="control-label">Redirect If Answer Is:</label>
                                                                <select class="form-control" name="red_if">
                                                                    <option value="0" selected="selected">-No Redirection-</option>
                                                                    <option value="yes" <?php if($val->red_if == 'yes'){echo 'selected="selected"';} ?>>YES</option>
                                                                    <option value="no" <?php if($val->red_if == 'no'){echo 'selected="selected"';} ?>>NO</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 p-l-0"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Save</button>
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