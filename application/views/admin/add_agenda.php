<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Agenda</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Manage Agenda Page</li>
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
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Add New Agenda</h3>
                <!--<p class="text-muted m-b-30 font-13">Agenda Information</p>-->
                <form action="<?php echo base_url();?>agenda/add_agenda_info" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <div class="form-group m-b-0">
                                <input type="text" name="agenda_task" class="form-control" placeholder="Agenda task" value="" required="required">
                                <input type="hidden" name="step" value="step1">
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><i class="fa fa-check"></i> Save</button>
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Manage Agenda</h3>
                <div class="table-responsive">
                    <table id="myTable" class="table color-table success-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agenda</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="page_list-no">
                            <?php if(is_array($agenda_list)){$i=1;foreach($agenda_list as $agenda_val){?>
                                <div class="modal fade in edit_agenda-<?php echo $agenda_val->agd_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Update Agenda</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="<?php echo base_url();?>agenda/edit_agenda_info" method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Agenda task</label>
                                                            <input type="text" name="agenda_task" class="form-control" placeholder="Agenda task" value="<?php echo $agenda_val->agenda_task;?>" required="required">
                                                            <input type="hidden" name="agenda_id" value="<?php echo $agenda_val->agd_id;?>">
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-10 hidden">
                                                        <div class="col-md-12">
                                                            <label for="notes" class="control-label">Description:</label>
                                                            <textarea class="form-control" name="notes" rows="5" cols="60"></textarea>
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
                                <tr id="<?php echo $agenda_val->agd_id;?>">
                                    <td><?php echo $i;?></td>
                                    <td><a href="<?php echo base_url();?>agenda/agenda_checklist/<?php echo $agenda_val->agd_id;?>"><?php echo $agenda_val->agenda_task;?></a></td>
                                    <td><button type="button" data-toggle="modal" data-target=".edit_agenda-<?php echo $agenda_val->agd_id;?>" class="btn btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></button>
                                        <a href="<?php echo base_url();?>agenda/delete_agenda/<?php echo $agenda_val->agd_id;?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i></button></a></td>
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
#page_list tr:hover {
    cursor: move;
}
</style>