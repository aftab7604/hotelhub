<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">One-Login Settings</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">One-Login Settings Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading box-title">One-Login Settings</div>
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
                                <?php if(is_array($admin_users)){$user_count = 1;foreach($admin_users as $user_val){
									$hotel_name			= admin_helper::get_hotel_name($user_val->firm_id);
									$multi_firms_array	= array();
									
									if(isset($user_val->multi_firms)){
										$multi_firms_array 	= explode(',', $user_val->multi_firms);
									}
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4"><?php echo $user_count.') '.$user_val->first_name;?> <?php echo $user_val->last_name;?><br /><span class="text-muted">(<?php echo $hotel_name[0]->hotel_name;?>)</span></label>
                                            <div class="col-md-8" id="user_<?php echo $user_val->id;?>">
                                            	<?php foreach($hotels as $hotel_info){?>
                                                    <div class="col-md-4 p-r-0">
                                                        <div class="checkbox checkbox-success">
                                                            <input type="checkbox" class="hotel_selected" data-user="<?php echo $user_val->id;?>" value="<?php echo $hotel_info->hotel_id;?>" <?php if (in_array($hotel_info->hotel_id, $multi_firms_array)){echo 'checked="checked"';}?>>
                                                            <label><?php echo $hotel_info->hotel_name;?></label>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            	<?php $user_count++;}}?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
	$('.hotel_selected').change(function() {		
		var user_id		= $(this).data('user');
		
		var hotel_ids 	= new Array();
		$('#user_'+user_id+' input[type=checkbox]').each(function() {
			if($(this).prop('checked')){
				hotel_ids.push($(this).val());
			}
		});
		var hotel_id_list = hotel_ids.join(',');
		var data_string = "user_id="+user_id+"&hotel_id_list="+hotel_id_list;
		
		$.ajax({
			url: "<?php echo site_url("hotel/update_user_multi_firms/");?>",
			type: "POST",
			data: data_string,
			success: function(data){}
		});
	});
});
</script>