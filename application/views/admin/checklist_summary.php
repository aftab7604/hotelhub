<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">PM History</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">PM History Page</li>
                <li class="active"><a href="<?php echo base_url();?>pmp/checklist/<?php echo $room_no;?>/<?php echo $room_type;?>">Back To PM</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="panel panel-info">
                <div class="panel-heading">PM History <button class="btn btn-warning waves-effect waves-light">Room# <?php echo $room_no; ?></button> & <button class="btn btn-warning waves-effect waves-light">Room Type <?php echo $room_type; ?></button><?php echo $quarterHTML;?></div>
                	<div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="white-box">
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
                             <div class="row">
								<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                    <select id="demo-show-entries" class="form-control input-sm">
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select> 
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"></div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                	<button class="btn btn-warning waves-effect waves-light" onclick="expandAll();">Expand All</button>
                                	<button class="btn btn-warning waves-effect waves-light" onclick="collapseAll();">Collapse All</button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                	<input id="demo-input-search22" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                </div>
                                <table id="demo-foo-row-toggler" class="table m-b-0 toggle-arrow-tiny">
                                    <thead><tr><th data-toggle="true">Employee</th><th data-toggle="true">Date</th><th data-toggle="true">Time</th><th data-toggle="true">Category</th><th data-toggle="true">Item</th><th data-toggle="true">Update PM</th><th data-toggle="true">Status</th><th data-hide="all"> Notes </th><th data-hide="all"> Attachment </th></tr></thead>
                                <tbody>
                                <!--display checklist summary and model data-->
                                <?php if(is_array($logs)){$j=1;
										foreach($logs as $val){
											$created_date	= date_create($val->created_date);
											$username = admin_helper::get_user_name($val->user_id);
											$cat_name = admin_helper::get_category_name($val->cat_id);
											$subcat_name = admin_helper::get_subcategory_name($val->item_id);
									?>
                                    <tr data-expanded="true"><td><?php echo $username[0]->username;?></td>
                                    	<td><?php echo date_format($created_date,"m-d-Y");?></td>
                                        <td><?php echo date_format($created_date,"h:i A");?></td>
                                        <td><?php echo $cat_name[0]->cat_name;?></td>
                                        <td><?php echo $subcat_name[0]->subcat_name;?></td>
                                        <td> -- </td>
                                    	<td><?php 
                                                if($val->flag == 'flag'){?><img src="<?php echo base_url();?>assets/images/flag.png" title="<?php echo 'Flag type is '.$val->flag_type;?>" /><?php }else{?>
                                                 <img src="<?php echo base_url();?>assets/images/tick.png" title="Completed" />
                                            <?php }
                                                if($val->filename){?><img src="<?php echo base_url();?>assets/images/attachment.png" title="Attachment" />
                                            <?php }
                                                echo $val->desc;
                                        ?></td>
                                        <td><?php echo $val->notes;?></td>
                                        <td><div><?php if($val->filename){?>
                                        <!--<a class="image-popup-vertical-fit" href="<?php echo base_url();?>assets/images/pmp_images/<?php echo $val->filename;?>" title="<?php echo $subcat_name[0]->subcat_name;?>"><img src="<?php echo base_url();?>assets/images/pmp_images/<?php echo $val->filename;?>" width="300" class="img-responsive"/></a>-->
                                        <div class="modal fade bs-example-modal-lg_<?php echo $j;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-contentt">
                                                    <!--<div class="modal-header">
                                                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" id="myLargeModalLabel">Attachment:</h4>
                                                    </div>-->
                                                    <div class="modal-body" style="right:20px; bottom:5px;">
                                                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff !important; opacity:1;">×</button>
                                                    </div>
                                                    <div class="modal-bodyt">
                                                    	<p><img src="<?php echo base_url();?>assets/images/pmp_images/<?php echo $val->filename;?>" width="870" /></p>
                                                    </div>
                                                    <!--<div class="modal-footer">
                                                    	<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <img src="<?php echo base_url();?>assets/images/pmp_images/<?php echo $val->filename;?>" data-toggle="modal" data-target=".bs-example-modal-lg_<?php echo $j;?>" class="model_img img-responsive" width="300" />
										<?php }else{echo '';}?></div></td></tr>
                                    <?php $j++;}}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-right">
                                                <ul class="pagination pagination-split m-t-10"></ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
