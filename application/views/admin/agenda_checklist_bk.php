<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo $agenda_info[0]->agenda_task?></h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Add Agenda Checklist Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
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
    <div class="row">
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title m-b-0">Add ToDo</h3>
                <p class="text-muted m-b-30 font-13">Add Todo List</p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form action="<?php echo base_url();?>agenda/add_agenda_info" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Agenda task</label>
                                <input type="text" name="agenda_task" class="form-control" placeholder="Agenda task" value="" required="required">
                                <input type="hidden" name="step" value="step1">
                            </div>
                            <div class="form-group hidden">
                                <label>Description</label>
                                <textarea class="form-control" id="notes" name="notes" rows="5" cols="60"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><i class="fa fa-check"></i> Save</button>
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
                        </form>
                        <form action="<?php echo base_url();?>agenda/agenda_checklist_info" method="post" enctype="multipart/form-data" class="form-horizontal">
                         	<input type="hidden" name="step" value="checklist">
                            <input type="hidden" name="agenda_id" value="<?php echo $agenda_info[0]->agd_id;?>">
                            <div class="form-body">
                                <div class="row">
                                	<div class="col-md-3">
                                        <label class="control-label">Checklist</label>
                                        <select class="form-control" name="checklist" required>
                                            <?php foreach($checklist as $checklist_list){?>
                                                <option value="<?php echo $checklist_list->agd_cklist_id;?>" <?php if($checklist_list->agd_cklist_id == $agenda_info[0]->checklist_id){echo 'selected="selected"';}?>><?php echo $checklist_list->checklist_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    	<?php
											$user_select = $dept_select = ''; $user_display = $dept_display = 'none';
											if($agenda_info[0]->assign_to_type == 'user'){$user_select = 'selected="selected"'; $user_display = 'block';}
											else if($agenda_info[0]->assign_to_type == 'dept'){$dept_select = 'selected="selected"'; $dept_display = 'block';}
											else{$user_select = 'selected="selected"';$user_display = 'block';}
										?>
                                        <label class="control-label">Assign To</label>
                                        <select class="form-control" id="assign_to_dp_ur" name="assign_to_dp_ur" required>
                                            <option value="">-Assign To-</option>
                                            <option value="user" <?php echo $user_select;?>>Users</option>
                                            <option value="dept" <?php echo $dept_select;?>>Departments</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="user_drp" style="display:<?php echo $user_display;?>;">
                                        <label class="control-label">Users</label>
                                        <select class="form-control" name="select_users_drp" id="select_users_drp">
                                            <?php foreach($users as $user_val){?>
                                                <option value="<?php echo $user_val->id;?>" <?php if($user_val->id == $agenda_info[0]->assign_ids){echo 'selected="selected"';}?>><?php echo $user_val->username;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="dept_drp" style="display:<?php echo $dept_display;?>;">
                                        <label class="control-label">Department</label>
                                        <select class="form-control" name="select_dept_drp" id="select_dept_drp">
                                            <?php foreach($depts as $dept_val){?>
                                                <option value="<?php echo $dept_val->id;?>" <?php if($dept_val->id == $agenda_info[0]->assign_ids){echo 'selected="selected"';}?>><?php echo $dept_val->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Area Type</label>
                                        <select class="form-control" name="area_type" required>
                                            <?php foreach($areas_list as $area_list){?>
                                                <option value="<?php echo $area_list->area_name;?>" <?php if($area_list->area_name == $agenda_info[0]->area_type){echo 'selected="selected"';}?>><?php echo $area_list->area_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-3">
                                        <label class="control-label">Days</label>
                                        <select class="selectpicker" multiple data-style="form-control" name="assign_weekdays[]" id="assign_weekdays" required>
                                            <option value="Saturday" 	<?php if($agenda_info[0]->assign_weekdays == 'Saturday'){echo 'selected="selected"';}?>>Saturday</option>
                                            <option value="Sunday" 		<?php if($agenda_info[0]->assign_weekdays == 'Sunday'){echo 'selected="selected"';}?>>Sunday</option>
                                            <option value="Monday"  	<?php if($agenda_info[0]->assign_weekdays == 'Monday'){echo 'selected="selected"';}?>>Monday</option>
                                            <option value="Tuesday" 	<?php if($agenda_info[0]->assign_weekdays == 'Tuesday'){echo 'selected="selected"';}?>>Tuesday</option>
                                            <option value="Wednesday" 	<?php if($agenda_info[0]->assign_weekdays == 'Wednesday'){echo 'selected="selected"';}?>>Wednesday</option>
                                            <option value="Thursday" 	<?php if($agenda_info[0]->assign_weekdays == 'Thursday'){echo 'selected="selected"';}?>>Thursday</option>
                                            <option value="Friday" 		<?php if($agenda_info[0]->assign_weekdays == 'Friday'){echo 'selected="selected"';}?>>Friday</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mytooltip tooltip-effect-5">
                                        <label for="notes" class="control-label">Time to Complete:</label>
                                        <input type="text" name="time_to_comp" class="form-control" placeholder="Time to Complete" value="<?php echo $agenda_info[0]->time_to_comp?>">
                                        <span class="tooltip-content clearfix"><span class="tooltip-text">Format should like: 12:12 AM/pm</span></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="notes" class="control-label">&nbsp;</label>
                                        <input type="text" name="time_hr_min" class="form-control" placeholder="HOURS-MINS" value="<?php echo $agenda_info[0]->time_hr_min?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Verfication of agenda</label>
                                        <select class="selectpicker" multiple data-style="form-control" name="veri_agd_comp[]">
                                            <option value="Checkbox">Checkbox</option>
                                            <option value="Initial">Initial</option>
                                            <option value="Signature">Signature</option>
                                            <option value="Image">Image</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-b-10">
                                    <div class="col-md-12">
                                        <label for="notes" class="control-label">Description:</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="5" cols="60"><?php echo $agenda_info[0]->description?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Save</button>
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title">Manage Checklist</h3>
                <div class="table-responsive">
                    <table id="myTablee" class="table color-table success-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Checklist</th>
                                <!--<th>Description</th>-->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="page_list-no">
                            
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading"><?php echo $agenda_info[0]->agenda_task?></div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body p-t-10">
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
                         <!--Add arrivals form-->
                         <form action="<?php echo base_url();?>agenda/agenda_checklist_info" method="post" enctype="multipart/form-data" class="form-horizontal">
                         	<input type="hidden" name="step" value="checklist">
                            <input type="hidden" name="agenda_id" value="<?php echo $agenda_info[0]->agd_id;?>">
                            <div class="form-body">
                                <div class="row">
                                	<div class="col-md-3">
                                        <label class="control-label">Checklist</label>
                                        <select class="form-control" name="checklist" required>
                                            <?php foreach($checklist as $checklist_list){?>
                                                <option value="<?php echo $checklist_list->agd_cklist_id;?>" <?php if($checklist_list->agd_cklist_id == $agenda_info[0]->checklist_id){echo 'selected="selected"';}?>><?php echo $checklist_list->checklist_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    	<?php
											$user_select = $dept_select = ''; $user_display = $dept_display = 'none';
											if($agenda_info[0]->assign_to_type == 'user'){$user_select = 'selected="selected"'; $user_display = 'block';}
											else if($agenda_info[0]->assign_to_type == 'dept'){$dept_select = 'selected="selected"'; $dept_display = 'block';}
											else{$user_select = 'selected="selected"';$user_display = 'block';}
										?>
                                        <label class="control-label">Assign To</label>
                                        <select class="form-control" id="assign_to_dp_ur" name="assign_to_dp_ur" required>
                                            <option value="">-Assign To-</option>
                                            <option value="user" <?php echo $user_select;?>>Users</option>
                                            <option value="dept" <?php echo $dept_select;?>>Departments</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="user_drp" style="display:<?php echo $user_display;?>;">
                                        <label class="control-label">Users</label>
                                        <select class="form-control" name="select_users_drp" id="select_users_drp">
                                            <?php foreach($users as $user_val){?>
                                                <option value="<?php echo $user_val->id;?>" <?php if($user_val->id == $agenda_info[0]->assign_ids){echo 'selected="selected"';}?>><?php echo $user_val->username;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="dept_drp" style="display:<?php echo $dept_display;?>;">
                                        <label class="control-label">Department</label>
                                        <select class="form-control" name="select_dept_drp" id="select_dept_drp">
                                            <?php foreach($depts as $dept_val){?>
                                                <option value="<?php echo $dept_val->id;?>" <?php if($dept_val->id == $agenda_info[0]->assign_ids){echo 'selected="selected"';}?>><?php echo $dept_val->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Area Type</label>
                                        <select class="form-control" name="area_type" required>
                                            <?php foreach($areas_list as $area_list){?>
                                                <option value="<?php echo $area_list->area_name;?>" <?php if($area_list->area_name == $agenda_info[0]->area_type){echo 'selected="selected"';}?>><?php echo $area_list->area_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-3">
                                        <label class="control-label">Days</label>
                                        <select class="selectpicker" multiple data-style="form-control" name="assign_weekdays[]" id="assign_weekdays" required>
                                            <option value="Saturday" 	<?php if($agenda_info[0]->assign_weekdays == 'Saturday'){echo 'selected="selected"';}?>>Saturday</option>
                                            <option value="Sunday" 		<?php if($agenda_info[0]->assign_weekdays == 'Sunday'){echo 'selected="selected"';}?>>Sunday</option>
                                            <option value="Monday"  	<?php if($agenda_info[0]->assign_weekdays == 'Monday'){echo 'selected="selected"';}?>>Monday</option>
                                            <option value="Tuesday" 	<?php if($agenda_info[0]->assign_weekdays == 'Tuesday'){echo 'selected="selected"';}?>>Tuesday</option>
                                            <option value="Wednesday" 	<?php if($agenda_info[0]->assign_weekdays == 'Wednesday'){echo 'selected="selected"';}?>>Wednesday</option>
                                            <option value="Thursday" 	<?php if($agenda_info[0]->assign_weekdays == 'Thursday'){echo 'selected="selected"';}?>>Thursday</option>
                                            <option value="Friday" 		<?php if($agenda_info[0]->assign_weekdays == 'Friday'){echo 'selected="selected"';}?>>Friday</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mytooltip tooltip-effect-5">
                                        <label for="notes" class="control-label">Time to Complete:</label>
                                        <input type="text" name="time_to_comp" class="form-control" placeholder="Time to Complete" value="<?php echo $agenda_info[0]->time_to_comp?>">
                                        <span class="tooltip-content clearfix"><span class="tooltip-text">Format should like: 12:12 AM/pm</span></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="notes" class="control-label">&nbsp;</label>
                                        <input type="text" name="time_hr_min" class="form-control" placeholder="HOURS-MINS" value="<?php echo $agenda_info[0]->time_hr_min?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Verfication of agenda</label>
                                        <select class="selectpicker" multiple data-style="form-control" name="veri_agd_comp[]">
                                            <option value="Checkbox">Checkbox</option>
                                            <option value="Initial">Initial</option>
                                            <option value="Signature">Signature</option>
                                            <option value="Image">Image</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-b-10">
                                    <div class="col-md-12">
                                        <label for="notes" class="control-label">Description:</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="5" cols="60"><?php echo $agenda_info[0]->description?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Save</button>
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.modal-backdrop{
	z-index:1002 !important;
}
.mytooltip {
    z-index: 1000;
}
.error_div{
	width:30%;
	color: red;
}
.sec_rad{float: left;width: 57%;position: relative;top: 15px;left: 9px;}
</style>