<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Service Book</h4>
		</div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Service Book Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <!--Model 1-->
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Compose Service Book Entry</h4>
				</div>
                <div class="modal-body">
                    <form action="" method="post" id="new_enrty_form" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="heading" class="control-label">Heading:</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="">
                        </div>
                        <div class="form-group">
                            <label for="message" class="control-label">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" cols="60"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 p-l-0">Attachment:</label>
                            <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                <input type="file" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" onclick="composeLogBook();">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--Model 2-reply-->
    <div id="responsive-modal-reply" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Compose Reply</h4>
				</div>
                <div class="modal-body">
                    <form action="" method="post" id="new_reply_form" enctype="multipart/form-data">
                    	<input type="hidden" name="lead_id" id="lead_id" value=""  />
                        <div class="form-group">
                            <label for="message" class="control-label">Message:</label>
                            <textarea class="form-control" id="message1" name="message1" rows="5" cols="60"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 p-l-0">Attachment:</label>
                            <div class="fileinput fileinput-new input-group col-sm-12" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                <input type="file" name="file" multiple> </span> <a href="#" class="input-group-addon btn btn-success fileinput-exists rem_file" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" onclick="replyLogBook();">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="white-box p-t-10">
        <div class="row">
            <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12 p-l-20">
                <h3 class="box-title col-md-10 col-sm-12 col-xs-12">Service Book</h3><button type="button" class="btn btn-danger waves-effect waves-light model_img img-responsive" data-toggle="modal" data-target="#responsive-modal">Compose Entry</button>
                <?php if(is_array($logs_entry)){
					foreach($logs_entry as $val){
						$repDate = date("d M, Y", strtotime($val->added_date));
						$repTime = date("h:i a", strtotime($val->added_date));
						if($val->likes >0){$likeP = ' fa-thumbs-up';}else{$likeP = ' fa-thumbs-o-up';}
						?>
                        <div class="media">
                            <div class="media-left">
                                <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" data-holder-rendered="true" style="width: 64px; height: 64px;"> </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $val->heading;?> <span class="sl-date">By <?php echo $val->user_name;?></span></h4> <?php echo htmlspecialchars_decode($val->message);?><br />
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12"><small class="text-muted font-light"></small></div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <a href="javascript:;" onclick="likeParentLog(<?php echo $val->lead_id;?>);"><i class="fa<?php echo $likeP;?>"></i></a><?php if($val->likes >0){echo '('.$val->likes.')';}?>&nbsp;&nbsp;&nbsp;
                                        <!--<a href="javascript:;"><i class="fa fa-paperclip"></i></a>&nbsp;&nbsp;&nbsp;-->
                                        <?php if($val->file_name){?>
                                        	<a class="image-popup-vertical-fit" href="<?php echo base_url();?>assets/images/logbook_images/<?php echo $val->file_name;?>"><i class="fa fa-paperclip"></i></a>&nbsp;&nbsp;&nbsp;
										<?php }?>
                                        <small class="text-muted font-light"><a href="javascript:;" onclick="getLeadId(<?php echo $val->lead_id;?>);" data-toggle="modal" data-target="#responsive-modal-reply">Reply</a></small>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12"><small class="text-muted font-light"><?php echo $repDate.' '.$repTime;?></small></div>
                                </div>
                                <?php 
									$logs_replies = admin_helper::get_log_replies($val->lead_id); 
									if(is_array($logs_replies)){
										foreach($logs_replies as $replies){
											$replyDate = date("d M, Y", strtotime($replies->added_date));
											$replyTime = date("h:i a", strtotime($replies->added_date));
											if($replies->likes >0){$likeC = ' fa-thumbs-up';}else{$likeC = ' fa-thumbs-o-up';}
									?>
                                        	<div class="media m-t-5" style="background-color: white !important;">
                                                <div class="media-left">
                                                    <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" data-holder-rendered="true" style="width: 64px; height: 64px;"> </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><span class="sl-date">By <?php echo $replies->user_name;?></span></h4><?php echo htmlspecialchars_decode($replies->message);?><br />
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-12 col-xs-12"><small class="text-muted font-light"></small></div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <a href="javascript:;" onclick="likeChildLog(<?php echo $replies->r_lead_id;?>);"><i class="fa<?php echo $likeC;?>"></i></a><?php if($replies->likes >0){echo '('.$replies->likes.')';}?>&nbsp;&nbsp;&nbsp;
                                                            <!--<a href="javascript:;"><i class="fa fa-paperclip"></i></a>&nbsp;&nbsp;&nbsp;-->
                                                            <?php if($replies->file_name){?>
                                                                <a class="image-popup-vertical-fit" href="<?php echo base_url();?>assets/images/logbook_images/<?php echo $replies->file_name;?>"><i class="fa fa-paperclip"></i></a>&nbsp;&nbsp;&nbsp;
                                                            <?php }?>
                                                            <!--<small class="text-muted font-light"><a href="javascript:;">Reply</a></small>-->
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12"><small class="text-muted font-light"><?php echo $replyDate.' '.$replyTime;?></small></div>
                                                    </div>
                                    			</div>
                                			</div>
								<?php }}?>
                             </div>
                        </div>
                <?php }}?>
            </div>
        </div>
    </div>
</div>
<style>
.media {
    background-color: aliceblue;
}
</style>