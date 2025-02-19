<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Hotel Areas</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Hotel Areas Page</li>
            </ol>
        </div>
    </div>
    
    <div id="add_hotel_areas" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Hotel Area</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url();?>rooms/add_hotel_areas" method="post" enctype="multipart/form-data">
                        <div class="row">
                        	<div class="col-md-4">
                        		<label for="notes" class="control-label">Standard Areas:</label>
                                <select class="form-control" name="area_type" id="area_type" required="required">
                                    <option value="">Select Standard Areas</option>
                                    <option value="custom">Custom Area...</option>
                                    <?php foreach($areas_list_info as $areas_list){?>
                                        <option value="<?php echo $areas_list->area_name;?>"><?php echo $areas_list->area_name;?></option>
                                    <?php } ?>
                                </select>
                        	</div>
                            <div class="col-md-4 p-l-0">
                                <label for="notes" class="control-label">Area Name:</label>
                                <input type="text" class="form-control" id="area_name" name="area_name" placeholder="Rename required area" value="" required="required" />
                            </div>
                            <div class="col-md-4 p-l-0">
                                <label for="notes" class="control-label">Floor:</label>
                                <input type="text" class="form-control" name="area_floor" placeholder="E.g 1st, 2nd, 3rd, 4th Floor " value="" required="required" />
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
                <div class="panel-heading">Manage <?php if(isset($hotel_info[0])) {echo $hotel_info[0]->hotel_name;} else {echo '';}?> Areas <button class="btn btn-warning waves-effect waves-light pull-right" data-toggle="modal" data-target="#add_hotel_areas">Add Area</button></div>
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
                        <form action="<?php echo base_url();?>rooms/add_rooms_info" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row"><div class="col-md-2"><div class="form-group m-b-0"><label class="control-label">Floor</label></div></div><div class="col-md-2"><div class="form-group m-b-0"><label class="control-label">Room#</label></div></div><div class="col-md-2"><div class="form-group m-b-0"><label class="control-label">Room Type</label></div></div><div class="col-md-6"><div class="form-group m-b-0"><label class="control-label">Other Areas</label></div></div></div>
                                <div class="row">
                                	<div class="col-md-6">
										<?php $no_of_rooms = 0;
										if(isset($hotel_info[0]))  {
										    $no_of_rooms = $hotel_info[0]->no_of_rooms - 1;
										    
										}
                                            for ($i=0; $i <= $no_of_rooms; $i++){?>
                                            	<div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" id="floor_num" name="floor_num[]" class="form-control" placeholder="Floor Number" value="<?php if(!empty($room_info)){echo $room_info[$i]->floor_num;}?>" required>
                                                            <input type="hidden" id="room_id" name="room_id[]" class="form-control" value="<?php if(!empty($room_info)){echo $room_info[$i]->id;}?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" id="room_num" name="room_num[]" class="form-control" placeholder="Room Number" value="<?php if(!empty($room_info)){echo $room_info[$i]->room_no;}?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group has-errorr">
                                                            <input type="text" id="room_type" name="room_type[]" class="form-control" placeholder="Room Type" value="<?php if(!empty($room_info)){echo $room_info[$i]->room_type;}?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php }?>
                                    </div>
                                    <div class="col-md-6">
                                    	<div class="table-responsive">
                                            <table id="myTable" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Floor</th>
                                                        <th>Area Name</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php if(is_array($hotel_area)){foreach($hotel_area as $hotel_areas){?>
                                    				<tr>
                                                        <td><?php echo $hotel_areas->floor_num;?></td>
                                                        <td><?php echo $hotel_areas->area_type;?></td>
                                                        <td><?php echo $hotel_areas->description;?></td>
                                                        <td><a href="<?php echo base_url();?>rooms/delete_hotel_areas/<?php echo $hotel_areas->area_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
                                                    </tr>
                                            		<?php }}?> 
                                            	</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
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