<div class="container-fluid"> 
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Room PM</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="btn btn-warning"><a href="<?php echo base_url();?>pmp/summary/<?php echo $room_no.'/'.$room_type;?>">Room PM History</a></li>
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Room PM Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info m-b-10">
                <div class="panel-heading"> Room PM for <button class="btn btn-warning waves-effect waves-light">room #<?php echo $room_no;?></button> & <button class="btn btn-warning waves-effect waves-light">room type <?php echo $room_type;?></button> <?php echo $quarterHTML;?> </div>
                <div class="panel-wrapper collapse in" aria-expanded="true"><!--Errors-->
                	<?php
					   if($this->session->flashdata('flash_data') != "") {
						   echo '<div class="alert alert-success alert-dismissable m-t-10">';
						   echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						   echo $this->session->flashdata('flash_data');
						   echo '</div>';
					   }
					   if ($this->session->flashdata('flash_data_danger') != "") {
						   echo '<div style=" margin: 10px;" class="alert alert-danger alert-dismissable m-t-10">';
						   echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						   echo $this->session->flashdata('flash_data_danger');
						   echo '</div>';
					   }?>
				</div>
			</div>
		</div>
	</div>
    <!--Model-->
    <div id="add_item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modal_title"></h4>
                </div>
                <div class="modal-body">
                    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" 	id="user_id" 	value="<?php echo $this->session->userdata['logged_in']['id'];?>" />
                        <input type="hidden" name="hotel_id" 	id="hotel_id" 	value="<?php echo $this->session->userdata['logged_in']['firm_id'];?>" />
                        <input type="hidden" name="room_no"		id="room_no" 	value="<?php echo $room_no;?>" />
                        <input type="hidden" name="room_type"	id="room_type" 	value="<?php echo $room_type;?>" />
                        <input type="hidden" name="quarter"		id="quarter" 	value="<?php echo $quarter;?>" />
                        <input type="hidden" name="cat_id"		id="cat_id" 	value="" />
                        <input type="hidden" name="item_id"		id="item_id" 	value="" />
                        <input type="hidden" name="checked"		id="checked" 	value="" />
                        
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select class="form-control" name="flaged" id="flaged" required>
                                <option value="complete" selected="selected">Complete</option>
                                <option value="flag">Flagged</option>
                            </select>
                        </div>
                        <div class="form-group" id="repair_req">
                            <h3 class="box-title m-b-0">Were repairs necessary?</h3>
                            <div class="radio radio-success">
                                <input type="radio" name="repair" id="repairno" value="no">
                                <label> No </label>
                            </div>
                            <div class="radio radio-success">
                                <input type="radio" name="repair" id="repairyes" value="yes">
                                <label> Yes </label>
                            </div>
                        </div>
                        <div class="form-group" id="repair_no" style="display:none;">
                            <h3 class="box-title m-b-0">What condition would you rate this item?</h3>
                            <div class="radio radio-success">
                                <input type="radio" name="rate" value="new">
                                <label> NEW </label>
                            </div>
                            <div class="radio radio-success">
                                <input type="radio" name="rate" value="great">
                                <label> GREAT </label>
                            </div>
                            <div class="radio radio-success">
                                <input type="radio" name="rate" value="fair">
                                <label> FAIR </label>
                            </div>
                            <div class="radio radio-success">
                                <input type="radio" name="rate" value="poor">
                                <label> POOR </label>
                            </div>
                        </div>
                        <div class="form-group clearfix" id="repair_yes" style="display:none;">
                            <h3 class="box-title m-b-0">What was speficially repaired?</h3>
                            <div class="col-md-6">
                            	<input type="text" class="form-control" name="repair_yes_notes" id="repair_yes_notes" value="" placeholder="What was speficially repaired?">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="form-group" id="flaged_type" style="display:none;">
                            <label class="control-label">Flagged Type</label>
                            <select class="form-control" name="flaged_type">
                                <option value="paint" selected="selected">Paint</option>
                                <option value="repair">Repair</option>
                                <option value="replace">Replace</option>
                            </select>
                        </div>
                        <div class="form-group" id="flaged_type_sub" style="display:none;">
                            <label class="control-label">Flagged Type</label>
                            <select class="form-control" name="flaged_type_2">
                                <option value="slight" selected="selected">Slight</option>
                                <option value="moderate">Moderate</option>
                                <option value="severe">Severe</option>
                            </select>
                        </div>
                        <div class="form-group" id="outside_vendor" style="display:none;">
                            <h3 class="box-title m-b-0">Outside Vendor Required?</h3>
                            <div class="radio radio-success">
                                <input type="radio" name="vendor" id="vendorno" value="no" checked="">
                                <label> No </label>
                            </div>
                            <div class="radio radio-success">
                                <input type="radio" name="vendor" id="vendoryes" value="yes">
                                <label> Yes </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label">Notes:</label>
                            <textarea class="form-control" id="notes" name="notes" rows="5" cols="60"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                <input type="file" name="file[]" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                        	</div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <!--Form data-->
    <form action="<?php echo base_url();?>pmp/save_checklist_by_employee" method="post" enctype="multipart/form-data">
        <div class="form-body" id="print_div">
        	<button type="button" class="btn btn-defualt waves-effect waves-light pull-right m-t-20 m-r-10" onclick="print_this('print_div');">Print</button>
            <?php if(is_array($categories)){
                foreach($categories as $category){$last_edited = '';
					$last_edited_by_category = admin_helper::last_edited_by_category($this->session->userdata['logged_in']['firm_id'], $room_no, $room_type, $category->c_id, $quarter);
					if(count($last_edited_by_category) > 0){$last_edited = admin_helper::lastEditted_helper($last_edited_by_category[0]->created_date); $last_edited = 'Last edited '.$last_edited.' ago';}?>
                    <div class="white-box m-b-10 p-20" id="main_cat_div_<?php echo $category->c_id;?>">
                        <div class="row m-t-10">
                            <div class="col-lg-4 col-xs-12 col-sm-12"><p class="cat_name" style="display:none;"><?php echo $category->cat_name;?></p>
                            	<h2 style="text-decoration:underline; font-style:italic;" class="page-title"><?php echo $category->cat_name;?>:</h2>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12"></div>
                            <div class="col-lg-4 col-xs-12 col-sm-12"><small><?php echo $last_edited;?></small></div>
                        </div>
                        <div class="row">
							<?php $items = admin_helper::get_subcat_active_edit_items($category->c_id);$i=0;
                                if(is_array($items)){foreach($items as $item){$i++;
									$items_checked = admin_helper::get_emp_checked_items($this->session->userdata['logged_in']['firm_id'], $room_no, $room_type, $category->c_id, $item->s_id, $quarter);?>
                                	<p class="subCat_hdn_<?php echo $item->s_id;?>" style="display:none;"><?php echo $item->subcat_name;?></p>
                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                        <div class="checkbox checkbox-success">
                                            <input data-toggle="modal" data-target="add_item" type="checkbox" <?php if(count($items_checked) > 0){echo 'checked="checked"';}?> class="checkbox_<?php echo $category->c_id;?>" name="<?php echo $category->c_id;?>" value="<?php echo $item->s_id;?>" id="subCat_<?php echo $item->s_id;?>">
                                            <label> <?php echo $item->subcat_name;?>
                                            <?php if(count($items_checked) > 0){
                                                if($items_checked[0]->flag == 'flag'){?>
                                                    <span class="mytooltip tooltip-effect-5 mytooltipcodez"><span class="tooltip-item mytooltipcode"><img src="<?php echo base_url();?>assets/images/flag.png" /></span><span class="tooltip-content clearfix"><span class="tooltip-text"><?php echo 'Flagged: '.$items_checked[0]->flag_type;?></span></span></span>
                                                <?php }if($items_checked[0]->filename != ''){?>
                                                    <span class="mytooltip tooltip-effect-5 mytooltipcodez"><span class="tooltip-item mytooltipcode"><img src="<?php echo base_url();?>assets/images/attachment.png"/></span><span class="tooltip-content clearfix"><img src="<?php echo base_url();?>assets/images/pmp_images/<?php echo $items_checked[0]->filename;?>"/><span class="tooltip-text"></span></span></span>
                                                <?php }if($items_checked[0]->notes != ''){?>
                                                    <span class="mytooltip tooltip-effect-5 mytooltipcodez"><span class="tooltip-item mytooltipcode"><img src="<?php echo base_url();?>assets/images/notes.png" /></span><span class="tooltip-content clearfix"><span class="tooltip-text"><?php echo 'Notes: '.htmlspecialchars_decode($items_checked[0]->notes);?></span></span></span>
                                                <?php }?>
                                            <?php }?></label>
                                        </div>
                                    </div>
                            <?php if(($i % 3) == 0 ){echo '</div><div class="row">';}}}?>
                        </div>
                    </div>
            <?php }}?>
		</div>
        <div class="form-actions">
            <!--<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
            <a href="<?php echo base_url();?>"><button type="button" class="btn btn-default">Cancel</button></a>-->
        </div>
    </form>
</div>
<style>
.mytooltipcode{
	background: transparent;
	z-index:-999999;
	padding:0;
	position:relative;
}
.mytooltipcodez{
	z-index:0;
}
</style>