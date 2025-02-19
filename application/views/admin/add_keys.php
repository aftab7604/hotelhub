<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Hotel keys</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Hotel keys Page</li>
            </ol>
        </div>
    </div>
    
    <div id="add_hotel_areas" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Hotel keys</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url();?>rooms/add_keys_info" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="notes" class="control-label">Key #:</label>
                                <input type="text" class="form-control" id="key_num" name="key_num" placeholder="Key number is required" value="" required="required" />
                            </div>
                            <div class="col-md-6 p-l-0">
                                <label for="notes" class="control-label">Key Name:</label>
                                <input type="text" class="form-control" id="key_name" name="key_name" placeholder="Key Name is required" value="" required="required" />
                            </div>
                        </div>
                        <div class="row m-b-10">
                        	<div class="col-md-12">
                        		<label for="notes" class="control-label">Description:</label>
                                <textarea class="form-control" id="notes" name="notes" rows="5" cols="60"></textarea>
                        	</div>
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
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Manage <?php echo $hotel_info[0]->hotel_name;?> keys <button class="btn btn-warning waves-effect waves-light pull-right" data-toggle="modal" data-target="#add_hotel_areas">Add keys</button></div>
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
                        <!--<form action="<?php echo base_url();?>rooms/add_keys_info" method="post" enctype="multipart/form-data">-->
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    	<div class="table-responsive">
                                            <table id="myTable" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.#</th>
                                                        <th>Number</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php if(is_array($hotel_keys)){$i=1;foreach($hotel_keys as $keys){?>
                                    				<tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $keys->key_num;?></td>
                                                        <td><?php echo $keys->key_name;?></td>
                                                        <td><?php echo htmlspecialchars_decode($keys->key_desc);?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#edit_hotel_keys_<?php echo $keys->key_id;?>"><i class="fa fa-pencil"></i></button>
                                                            <a href="<?php echo base_url();?>rooms/delete_hotel_keys/<?php echo $keys->key_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a>
                                                        </td>
                                                    </tr>
                                                    <div id="edit_hotel_keys_<?php echo $keys->key_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Hotel keys</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal" id="pickup_form_<?php echo $keys->key_id;?>" action="<?php echo base_url();?>rooms/edit_keys_info" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="notes" class="control-label">Key #:</label>
                                                                                <input type="text" class="form-control" name="key_num" placeholder="Key number is required" value="<?php echo $keys->key_num;?>" required="required" />
                                                                                <input type="hidden" name="key_id" value="<?php echo $keys->key_id;?>" />
                                                                            </div>
                                                                            <div class="col-md-6 p-l-0">
                                                                                <label for="notes" class="control-label">Key Name:</label>
                                                                                <input type="text" class="form-control" name="key_name" placeholder="Key Name is required" value="<?php echo $keys->key_name;?>" required="required" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row m-b-10">
                                                                            <div class="col-md-12">
                                                                                <label for="notes" class="control-label">Description:</label>
                                                                                <textarea class="form-control notes" id="notes_<?php echo $keys->key_id;?>" name="notes" rows="5" cols="60"><?php echo $keys->key_desc;?></textarea>
                                                                            </div>
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
                                            		<?php $i++; }}?>
                                            	</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <!-- </form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>