<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Preventive Maintenance</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Preventive Maintenance Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info m-b-10">
            	<div id="add_category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">ADD CATEGORY</h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url();?>pmp/add_cat" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="cat-name" class="control-label">Category Name:</label>
                                        <input class="form-control" id="cat-name" name="cat_name" type="text" value="" />
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
                <div class="panel-heading"> Preventive Maintenance</div>
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
        <div class="col-lg-3 col-xs-6 col-sm-6">
    		<button type="button" class="btn btn-danger waves-effect waves-light pull-right" data-toggle="modal" data-target="#add_category">Add Categories</button>
    	</div>
    </div>
    <div class="row m-t-10"><div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    	<?php if(is_array($categories)){$j=0;
			foreach($categories as $category){$j++;?>
            <div id="add_item_<?php echo $category->c_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">ADD ITEMS IN <?php echo strtoupper($category->cat_name);?></h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url();?>pmp/add_item" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="item-name" class="control-label">Item Name:</label>
                                    <input class="form-control" id="item-name" name="item_name" type="text" value="" />
                                    <input name="cat_id" type="hidden" value="<?php echo $category->c_id;?>" />
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
            <div id="edit_category_<?php echo $category->c_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">EDIT CATEGORY</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url();?>pmp/update_cat" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cat-name" class="control-label">Category Name:</label>
                                    <input class="form-control" id="cat-name" name="cat_name" type="text" value="<?php echo $category->cat_name;?>" />
                                    <input class="form-control" id="cat-name" name="cat_id" type="hidden" value="<?php echo $category->c_id;?>" />
                                </div>
                                <div class="form-group">
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        	<div class="col-md-6">
                <div class="white-box" style="padding:10px;margin-bottom: 15px;">
                	<div class="row">
                    	<div class="col-lg-9 col-xs-12 col-sm-12"><h2 class="page-title"><?php echo $category->cat_name;?>
							<?php if($category->status == 1){$cstatus = 'In-Active';$cstatusValue = '0';}else{$cstatus = 'Active';$cstatusValue = '1';}?>
                            	<div class="btn-group m-r-10 pull-right">
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-ellipsis-v m-r-5"></i></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="javascript:;" data-toggle="modal" data-target="#edit_category_<?php echo $category->c_id;?>">Edit</a></li>
                                        <li><a href="javascript:;" onclick="changeStatusOfCategory('<?php echo $category->c_id;?>','<?php echo $cstatusValue;?>');"><?php echo $cstatus;?></a></li>
                                        <li><a href="javascript:;" onclick="deleteCategory('<?php echo $category->c_id;?>');">Delete</a></li>
                                    </ul>
                                </div>
							</h2>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-12"><button type="button" class="btn btn-danger waves-effect waves-light m-t-10" data-toggle="modal" data-target="#add_item_<?php echo $category->c_id;?>">Add items</button></div>
                    </div>
                    <div class="row">
                    	<?php $items = admin_helper::get_subcat_items($category->c_id);$i=0;
							if(is_array($items)){foreach($items as $item){$i++;?>
                            <div id="edit_item_<?php echo $item->s_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">EDIT ITEMS IN <?php echo strtoupper($category->cat_name);?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url();?>pmp/update_item" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="item-name" class="control-label">Item Name:</label>
                                                    <input class="form-control" id="item-name" name="item_name" type="text" value="<?php echo $item->subcat_name;?>" />
                                                    <input name="item_id" type="hidden" value="<?php echo $item->s_id;?>" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-info waves-effect">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="checkbox"><!--checkbox checkbox-danger-->
                                    <input type="checkbox" id="checkbox_<?php echo $i;?>" value="<?php echo $item->s_id;?>">
                                    <label for="checkbox_<?php echo $i;?>"> <?php echo $item->subcat_name;?> </label>
                                    <?php if($item->status == 1){$status = 'In-Active';$statusValue = '0';}else{$status = 'Active';$statusValue = '1';}?>
                                    <div class="btn-group m-r-10 pull-right">
                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-ellipsis-v m-r-5"></i></button>
                                        <ul role="menu" class="dropdown-menu">
                                        	<li><a href="javascript:;" data-toggle="modal" data-target="#edit_item_<?php echo $item->s_id;?>">Edit</a></li>
                                            <li><a href="javascript:;" onclick="changeStatusOfItem('<?php echo $item->s_id;?>','<?php echo $statusValue;?>');"><?php echo $status;?></a></li>
                                            <li><a href="javascript:;" onclick="deleteItem('<?php echo $item->s_id;?>');">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
						<?php if($i % 2 == 0 ){echo '</div><div class="row">';}}}?>
                    </div>
                </div>
            </div>
        <?php if($j % 2 == 0 ){echo '</div><div class="row m-t-10">';}}}?>
    </div>
</div>