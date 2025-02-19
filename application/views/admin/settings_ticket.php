<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tickets Notification Settings</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Notification Settings Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading box-title">Tickets Notification</div>
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
                         <!--Add hotel form-->
                         <div style="display:none;" id="loader_main" class="loader_main"><div class="loader"></div></div>
                        <form action="<?php echo base_url();?>settings/save_dash_settingsss" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <!--<h3 class="box-title m-b-0">Ticket Types</h3>-->
                                <?php if(is_array($users)){foreach($users as $user_val){$email_ids_array = $sms_ids_array = $dept_ids_array = array();
                                    $user_ticket_notifications = admin_helper::get_user_ticket_notifications($user_val->id);
									if(isset($user_ticket_notifications[0])){
										$email_ids_array 	= explode(',', $user_ticket_notifications[0]->email_ids);
										$sms_ids_array 		= explode(',', $user_ticket_notifications[0]->sms_ids);
										$dept_ids_array 	= explode(',', $user_ticket_notifications[0]->dept_ids);
									}
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4"><?php echo $user_val->username;?> <span class="text-muted">(<?php echo $user_val->Role_name;?>)</span></label>
                                            <div class="col-md-8"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row font-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        	<div class="col-md-2 m-t-10 col-md-offset-1"><label>ALLOW DEPT.</label></div>
                                            <?php if(is_array($roles)){foreach($roles as $role){?>
                                            	<div class="col-md-1 p-r-0">
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" class="dept_<?php echo $user_val->id;?> dept" value="<?php echo $role->id;?>" <?php if (in_array($role->id, $dept_ids_array)){echo 'checked="checked"';}?>>
                                                        <label><?php echo $role->name;?></label>
                                                    </div>
                                                </div>
                                            <?php }}?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row font-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        	<div class="col-md-2 m-t-10 col-md-offset-1"><label>ALLOW EMAILS</label></div>
                                            <?php if(is_array($ticket_types)){foreach($ticket_types as $ticket_type){?>
                                            	<div class="col-md-1">
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" class="email_<?php echo $user_val->id;?> email" value="<?php echo $ticket_type->t_id;?>" <?php if (in_array($ticket_type->t_id, $email_ids_array)){echo 'checked="checked"';}?>>
                                                        <label><?php echo $ticket_type->type_name;?></label>
                                                    </div>
                                                </div>
                                            <?php }}?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row font-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        	<div class="col-md-2 m-t-10 col-md-offset-1"><label>ALLOW SMS</label></div>
                                            <?php if(is_array($ticket_types)){foreach($ticket_types as $ticket_type){?>
                                            	<div class="col-md-1">
                                                <div class="checkbox checkbox-success">
                                                    <input type="checkbox" class="sms_<?php echo $user_val->id;?> sms" value="<?php echo $ticket_type->t_id;?>" <?php if (in_array($ticket_type->t_id, $sms_ids_array)){echo 'checked="checked"';}?>>
                                                    <label><?php echo $ticket_type->type_name;?></label>
                                                </div>
                                            </div>
                                            <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            	<?php }}?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>