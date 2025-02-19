<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
            <h4 class="page-title">My Board Preventive Maintenance</h4> </div>
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">My Board Preventive Maintenance Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info m-b-10">
                <div class="panel-heading">My Board Preventive Maintenance</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
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
    <div class="row">
    	<div class="col-lg-3 col-xs-6 col-sm-6"></div>
        <div class="col-lg-3 col-xs-6 col-sm-6">
    		<!--<button type="button" class="btn btn-danger waves-effect waves-light pull-right" onclick="selectAll();">Select All</button>-->
    	</div>
        <div class="col-lg-3 col-xs-6 col-sm-6">
    		<!--<button type="button" class="btn btn-danger waves-effect waves-light" onclick="deSelectAll();">De-Select All</button>-->
    	</div>
        <div class="col-lg-3 col-xs-6 col-sm-6 m-b-20">
    		<button type="button" class="btn btn-danger waves-effect waves-light pull-right" id="add_category">Add Categories</button>
    	</div>
    </div>
    <form action="<?php echo base_url();?>pmp/save_checklist_board" method="post" enctype="multipart/form-data" id="add_checklist">
        <div class="form-body">
            <!--<div class="row m-t-10 m-b-10">
                <div class="col-lg-3 col-xs-6 col-sm-6">
                    <div class="form-group m-b-0">
                        <select class="form-control" name="room_type" required>
                            <option value="">Select Room Type</option>
                            <?php foreach($room_types as $room_type){?>
                            <option value="<?php echo $room_type->room_type; ?>"><?php echo $room_type->room_type; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>-->
            <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
            <?php if(is_array($categories)){$j=0;
                foreach($categories as $category){$j++;?>
                    <div class="white-box m-b-10 p-20" id="main_cat_div_<?php echo $category->c_id; ?>">
                        <div class="row m-t-10">
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="checkbox checkbox-dangerr">
                                    <input type="checkbox" name="category[<?php echo $category->c_id;?>][cat_name]" id="checkbox_cat_<?php echo $category->c_id;?>" value="<?php echo $category->cat_name;?>" checked="checked">
                                    <label style="text-decoration:underline; font-style:italic;" class="showUs" id="label_cat_<?php echo $category->c_id;?>" for="checkbox_cat_<?php echo $category->c_id;?>"> <?php echo $category->cat_name;?></label>
                                    
                                    <div class="btn-group m-r-10 pull-right">
                                        <button id="edit_cat_<?php echo $category->c_id;?>" class="edit_cat btn btn-defaultt btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-pencil m-r-5"></i></button>
                                    </div>
                                    <label class="hideUs" style="display:none;" id="hdn_label_cat_<?php echo $category->c_id;?>"><input type="text" class="cat" id="_<?php echo $category->c_id;?>" value="<?php echo $category->cat_name;?>"/></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12"></div>
                            <div class="col-lg-4 col-xs-12 col-sm-12"><button type="button" class="add_sub_category btn btn-danger waves-effect waves-light m-t-5 pull-right" id="<?php echo $category->c_id;?>" ><i class="fa fa-plus"></i></button></div>
                        </div>
                        <div class="row">
							<?php $items = admin_helper::get_custom_or_default_subcat_active($this->session->userdata['logged_in']['firm_id'], $category->c_id);$i=0;
                                if(is_array($items)){foreach($items as $item){$i++;?>
                                <div class="col-lg-4 col-xs-12 col-sm-12">
                                    <div class="checkbox">
                                        <input type="checkbox" name="category[<?php echo $category->c_id;?>][<?php echo $item->s_id;?>]" id="checkbox_subCat_<?php echo $item->s_id;?>" value="<?php echo $item->subcat_name;?>" checked="checked">
                                        <label class="showUs" id="label_subCat_<?php echo $item->s_id;?>" for="checkbox_subCat_<?php echo $item->s_id;?>"> <?php echo $item->subcat_name;?> </label>
                                        <div class="btn-group m-r-10 pull-right">
                                            <button id="edit_subCat_<?php echo $item->s_id;?>" class="edit_subCat btn btn-defaultt btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-pencil m-r-5"></i></button>
                                        </div>
                                        <label class="hideUs" style="display:none;" id="hdn_label_subCat_<?php echo $item->s_id;?>"><input type="text" class="<?php echo $category->c_id;?> subcat" id="_<?php echo $item->s_id;?>" value="<?php echo $item->subcat_name;?>"/></label>
                                    </div>
                                </div>
                            <?php if(($i % 3) == 0 ){echo '</div><div class="row">';}}}?>
                        </div>
                    </div>
            <?php }}?>
		</div>
        <div class="form-actions">
            <button type="button" class="btn btn-success save"> <i class="fa fa-check"></i> Save</button>
            <a href="<?php echo base_url();?>"><button type="button" class="btn btn-default">Cancel</button></a>
        </div>
    </form>
</div>