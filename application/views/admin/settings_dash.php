<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Scroller Settings</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Scroller Settings Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading box-title">Scroller Settings</div>
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
						   
					   		$customArrayOfScrollerTypes = array("top_PM", "top_Cleaned", "top_sales_tickets", "top_guest_recovery", "users_tickets_created", "users_tickets_closed", "tickets_completed", "percentage_of_pending_tickets", "percentage_of_pickup_tickets", "percentage_of_close_tickets", "avg_tickets_completed_time", "avg_guest_recovery_completing_time", "top_MPOR", "upcoming_events", "PM_completed/Flagged_Pie_Chart", "Pending/Picked_Up_And_Completed_Tickets_Pie_Chart");//avg_MPOR_users_tickets_created
							$arrayOfDBScrollers = array();
							
							if(is_array($settings)){foreach($settings as $settings_val){$arrayOfDBScrollers[$settings_val->scroll_type] = $settings_val->filter_range;}}
						 ?>
                         <!--Add hotel form-->
                        <form action="<?php echo base_url();?>settings/save_dash_settings" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                            <?php foreach($customArrayOfScrollerTypes as $index=>$scroller){?>
                                <div class="row p-l-20">
                                <?php if($index==0){?>
                                    <h3 class="box-title m-b-0">Scroller Types <span class="sl-date">Select minimum 2 types</span></h3>
                                    <?php }?>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 p-l-30">
                                        <div class="form-group m-b-0">
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" name="taskassignto[]" value="<?php echo $scroller;?>" <?php if(count($arrayOfDBScrollers)>=1 && isset($arrayOfDBScrollers[$scroller])){?>checked="checked"<?php }?>>
                                                <label><?php echo ucwords(str_replace("_", " ", $scroller));?></label>
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-b-0">
                                            <select class="form-control" name="range_<?php echo $scroller;?>">
                                                <option <?php if(count($arrayOfDBScrollers)>=1 && isset($arrayOfDBScrollers[$scroller]) && $arrayOfDBScrollers[$scroller]=="Daily"){echo 'selected="selected"';}?> value="Daily">Daily</option>
                                                <option <?php if(count($arrayOfDBScrollers)>=1 && isset($arrayOfDBScrollers[$scroller]) && $arrayOfDBScrollers[$scroller]=="Weekly"){echo 'selected="selected"';}?> value="Weekly">Weekly</option>
                                                <option <?php if(count($arrayOfDBScrollers)>=1 && isset($arrayOfDBScrollers[$scroller]) && $arrayOfDBScrollers[$scroller]=="Monthly"){echo 'selected="selected"';}?> value="Monthly">Monthly</option>
                                                <option <?php if(count($arrayOfDBScrollers)>=1 && isset($arrayOfDBScrollers[$scroller]) && $arrayOfDBScrollers[$scroller]=="Quarterly"){echo 'selected="selected"';}?> value="Quarterly">Quarterly</option>
                                                <option <?php if(count($arrayOfDBScrollers)>=1 && isset($arrayOfDBScrollers[$scroller]) && $arrayOfDBScrollers[$scroller]=="Yearly"){echo 'selected="selected"';}?> value="Yearly">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>
                            <?php }?>
                            <!--<div class="col-md-2 p-l-0">
                                    <div class="form-group">
                                        <label class="control-label">Top Results</label>
                                        <select class="form-control" name="range_avg" id="top_results">
                                            <option value="3" <?php if($settings_val->top_res == 3){echo 'selected="selected"';}?>>Top 3</option>
                                            <option value="5" <?php if($settings_val->top_res == 5){echo 'selected="selected"';}?>>Top 5</option>
                                        </select>
                                    </div>
                                </div>-->
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