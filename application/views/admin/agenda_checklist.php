<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo $agenda_info[0]->agenda_task?></h4></div>
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
                <h3 class="box-title m-b-20">Add To Do</h3>
                <!--<p class="text-muted m-b-30 font-13">Add Todo List</p>-->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form action="<?php echo base_url();?>agenda/agenda_checklist_info" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="agenda_id" 	value="<?php echo $agenda_info[0]->agd_id;?>">
                            <div class="row">
                            	<div class="col-sm-8 col-xs-4">
                                    <div class="form-group">
                                        <label>To Do</label>
                                        <input type="text" name="todo_task" class="form-control" placeholder="To Do Task" value="" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">Assign To</label>
                                        <select class="form-control" id="assign_to_dp_ur" name="assign_to_dp_ur" required>
                                            <option value="">-Assign To-</option>
                                            <option value="user" selected="selected">Users</option>
                                            <option value="dept">Departments</option>
                                        </select>
                                    </div>
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-4 col-xs-4" id="user_drp" style="display:block;">
                                    <div class="form-group">
                                        <label class="control-label">Users</label>
                                        <select class="form-control" name="select_users_drp" id="select_users_drp">
                                            <?php foreach($users as $user_val){?>
                                                <option value="<?php echo $user_val->id;?>"><?php echo $user_val->username;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4" id="dept_drp" style="display:none;">
                                    <div class="form-group">
                                        <label class="control-label">Department</label>
                                        <select class="form-control" name="select_dept_drp" id="select_dept_drp">
                                            <?php foreach($depts as $dept_val){?>
                                                <option value="<?php echo $dept_val->id;?>"><?php echo $dept_val->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">Area Type</label>
                                        <input type="text" id="custom_area" name="custom_area" class="form-control" placeholder="Enter area type" value="" style="display:none;">
                                        <select class="form-control" id="area_type_agenda" name="area_type" required>
                                            <option value="">Select Area Type</option>
                                            <option value="custom">Custom Area Type</option>
                                            <?php foreach($areas_list as $area_list){?>
                                                <option value="<?php echo $area_list->area_name;?>"><?php echo $area_list->area_name;?></option>
                                            <?php } ?>
                                        </select>
                                        <small id="switch_back_drp" style="display:none;">Switch back</small>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">Days</label>
                                        <select class="selectpicker" multiple data-style="form-control" name="assign_weekdays[]" id="assign_weekdays" required>
                                            <option value="everyday" selected="selected">Everyday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-4 col-xs-4 mytooltip tooltip-effect-5">
                                    <div class="form-group">
                                        <label>Time to Complete:</label>
                                        <input type="text" name="time_to_comp" class="form-control" placeholder="Time to Complete" value="">
                                        <span class="tooltip-content clearfix"><span class="tooltip-text">Format should like: 12:12 AM/pm</span></span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="text" name="time_hr_min" class="form-control" placeholder="HOURS-MINS" value="">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label>Verfication of agenda</label>
                                        <select class="selectpicker" multiple data-style="form-control" name="veri_agd_comp[]">
                                            <option value="Checkbox" selected="selected">Checkbox</option>
                                            <option value="Initial">Initial</option>
                                            <option value="Signature">Signature</option>
                                            <option value="Image">Image</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <h3 class="box-title m-b-0">Choose File:</h3>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="file" multiple/> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-12 col-xs-12 pull-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><i class="fa fa-check"></i> Save</button>
                                    <button type="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title">Manage "<?php echo $agenda_info[0]->agenda_task?>" Checklist</h3>
                <div class="table-responsive">
                    <table id="myTablee" class="table color-table success-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>To Do</th>
                                <th>Assign To</th>
                                <th>Area</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="page_list">
                            <?php if(is_array($agenda_checklist)){$i=1;foreach($agenda_checklist as $agenda_checklist_val){
								if($agenda_checklist_val->assign_to_type == 'user'){
									$user_name	= admin_helper::get_user_name($agenda_checklist_val->assign_ids);
									$NAME		= $user_name[0]->username;
								}else{
									$dept_name	= admin_helper::get_role_name($agenda_checklist_val->assign_ids);
									$NAME		= $dept_name[0]->name;
								}
							?>
                            <div class="modal fade in edit_agenda_checklist-<?php echo $agenda_checklist_val->adg_chk_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Update "<?php echo $agenda_info[0]->agenda_task?>" Checklist</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="<?php echo base_url();?>agenda/edit_checklist_info" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="control-label">Agenda task</label>
                                                        <input type="text" name="todo_task" class="form-control" placeholder="Todo Task" value="<?php echo $agenda_checklist_val->todo_task;?>" required>
                                                        <input type="hidden" name="agenda_id" value="<?php echo $agenda_info[0]->agd_id;?>">
                                                        <input type="hidden" name="adg_chk_id" value="<?php echo $agenda_checklist_val->adg_chk_id;?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 col-xs-4">
														<?php
                                                            $user_select = $dept_select = ''; $user_display = $dept_display = 'none';
                                                            if($agenda_checklist_val->assign_to_type == 'user'){$user_select = 'selected="selected"'; $user_display = 'block';}
                                                            else if($agenda_checklist_val->assign_to_type == 'dept'){$dept_select = 'selected="selected"'; $dept_display = 'block';}
                                                            else{$user_select = 'selected="selected"';$user_display = 'block';}
                                                        ?>
                                                        <label class="control-label">Assign To</label>
                                                        <select class="form-control assignto" id="edit_assign_to_dp_ur_<?php echo $agenda_checklist_val->adg_chk_id;?>" name="assign_to_dp_ur" required>
                                                            <option value="">-Assign To-</option>
                                                            <option value="user" <?php echo $user_select;?>>Users</option>
                                                            <option value="dept" <?php echo $dept_select;?>>Departments</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4" id="edit_user_drp_<?php echo $agenda_checklist_val->adg_chk_id;?>" style="display:<?php echo $user_display;?>;">
                                                        <label class="control-label">Users</label>
                                                        <select class="form-control" name="select_users_drp" id="edit_select_users_drp_<?php echo $agenda_checklist_val->adg_chk_id;?>">
                                                            <?php foreach($users as $user_val){?>
                                                                <option value="<?php echo $user_val->id;?>" <?php if($user_val->id == $agenda_checklist_val->assign_ids){echo 'selected="selected"';}?>><?php echo $user_val->username;?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4" id="edit_dept_drp_<?php echo $agenda_checklist_val->adg_chk_id;?>" style="display:<?php echo $dept_display;?>;">
                                                        <label class="control-label">Department</label>
                                                        <select class="form-control" name="select_dept_drp" id="edit_select_dept_drp_<?php echo $agenda_checklist_val->adg_chk_id;?>">
                                                            <?php foreach($depts as $dept_val){?>
                                                                <option value="<?php echo $dept_val->id;?>" <?php if($dept_val->id == $agenda_checklist_val->assign_ids){echo 'selected="selected"';}?>><?php echo $dept_val->name;?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <label class="control-label">Area Type</label>
                                                        <?php $custom_area = $area_type_disp = $switchbtn = 'none'; $custom_area_select = '';
                                                            if($agenda_checklist_val->area_type == 'custom'){$area_type_disp = 'none';$custom_area_select = $agenda_checklist_val->area_type_cus;$custom_area = $switchbtn = 'block';}
                                                            else{$area_type_disp = 'block';}
                                                        ?>
                                        				<input type="text" id="custom_area_<?php echo $agenda_checklist_val->adg_chk_id;?>" name="custom_area" class="form-control" placeholder="Enter area type" value="<?php echo $custom_area_select;?>" style="display:<?php echo $custom_area;?>;">
                                                        <select class="form-control areatype" id="area_type_agenda_<?php echo $agenda_checklist_val->adg_chk_id;?>" name="area_type" style="display:<?php echo $area_type_disp;?>">
                                                            <option value="">Select Area Type</option>
                                                            <option value="custom" <?php if($agenda_checklist_val->area_type == 'custom'){echo 'selected="selected"';}?>>Custom Area Type</option>
                                                            <?php foreach($areas_list as $area_list){?>
                                                                <option value="<?php echo $area_list->area_name;?>" <?php if($area_list->area_name == $agenda_checklist_val->area_type){echo 'selected="selected"';}?>><?php echo $area_list->area_name;?></option>
                                                            <?php } ?>
                                                        </select>
                                        				<small class="switchBack" id="switch_back_drp_<?php echo $agenda_checklist_val->adg_chk_id;?>" style="display:<?php echo $switchbtn;?>;">Switch back</small>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-4">
                                                        <label class="control-label">Days</label>
                                                        <?php $weekdays = explode(",", $agenda_checklist_val->assign_weekdays);?>
                                                        <select class="selectpicker" multiple data-style="form-control" name="assign_weekdays[]" id="assign_weekdaysss" required>
                                                            <option value="everyday"	<?php if(in_array('everyday', $weekdays)){echo 'selected="selected"';}?>>Everyday</option>
                                                            <option value="Saturday" 	<?php if(in_array('Saturday', $weekdays)){echo 'selected="selected"';}?>>Saturday</option>
                                                            <option value="Sunday" 		<?php if(in_array('Sunday', $weekdays)){echo 'selected="selected"';}?>>Sunday</option>
                                                            <option value="Monday"  	<?php if(in_array('Monday', $weekdays)){echo 'selected="selected"';}?>>Monday</option>
                                                            <option value="Tuesday" 	<?php if(in_array('Tuesday', $weekdays)){echo 'selected="selected"';}?>>Tuesday</option>
                                                            <option value="Wednesday" 	<?php if(in_array('Wednesday', $weekdays)){echo 'selected="selected"';}?>>Wednesday</option>
                                                            <option value="Thursday" 	<?php if(in_array('Thursday', $weekdays)){echo 'selected="selected"';}?>>Thursday</option>
                                                            <option value="Friday" 		<?php if(in_array('Friday', $weekdays)){echo 'selected="selected"';}?>>Friday</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-4">
                                                        <label>Time to Complete:</label>
                                                        <input type="text" name="time_to_comp" class="form-control" placeholder="Time to Complete" value="<?php echo $agenda_checklist_val->time_to_comp;?>">
                                                        <span class="tooltip-content clearfix"><span class="tooltip-text">Format should like: 12:12 AM/pm</span></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                       <label>&nbsp;</label>
                                                       <input type="text" name="time_hr_min" class="form-control" placeholder="HOURS-MINS" value="<?php echo $agenda_checklist_val->time_hr_min;?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Verfication of agenda</label>
                                                        	<?php $verification = explode(",", $agenda_checklist_val->veri_agd_comp);?>
                                                            <select class="selectpicker" multiple data-style="form-control" name="veri_agd_comp[]" required>
                                                                <option value="Checkbox"	<?php if(in_array('Checkbox', $verification)){echo 'selected="selected"';}?>>Checkbox</option>
                                                                <option value="Initial"		<?php if(in_array('Initial', $verification)){echo 'selected="selected"';}?>>Initial</option>
                                                                <option value="Signature"	<?php if(in_array('Signature', $verification)){echo 'selected="selected"';}?>>Signature</option>
                                                                <option value="Image"		<?php if(in_array('Image', $verification)){echo 'selected="selected"';}?>>Image</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-xs-8"></div>
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
                            <tr id="<?php echo $agenda_checklist_val->adg_chk_id;?>">
                                <td><?php echo $i;?></td>
                                <td><?php echo $agenda_checklist_val->todo_task;?></td>
                                <td><?php echo $NAME;?></td>
                                <td><?php if($agenda_checklist_val->area_type == 'custom'){echo $agenda_checklist_val->area_type_cus;}else{echo $agenda_checklist_val->area_type;}?></td>
                                <td><button type="button" data-toggle="modal" data-target=".edit_agenda_checklist-<?php echo $agenda_checklist_val->adg_chk_id;?>" class="btn btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></button>
                                    <a href="<?php echo base_url();?>agenda/delete_agenda_checklist/<?php echo $agenda_info[0]->agd_id;?>/<?php echo $agenda_checklist_val->adg_chk_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
                            </tr>
                            <?php $i++;}}?>
                        </tbody>
                    </table>
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
#page_list tr:hover {
    cursor: move;
}

.input-group-btn select {
	border-color: #ccc;
margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 7px;
    padding-bottom: 7px;
}

</style>