
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Track Users</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Track Users Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-themecolor">
                        <div class="panel-heading">USERS</div>
                        <div class="panel-body">
                            <!--<div class="form-material">
                                <input class="form-control p-20" type="text" placeholder="Search Contact">
                            </div>-->
                            <div class="chat-left-inner">
                                <ul class="chatonline">
                                    <?php if(is_array($users)){foreach($users as $val){?>
                                        <li><!--<div class="call-chat">
                                                <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                            </div>-->
                                            <a href="javascript:void(0)" onclick="get_user_tracks(<?php echo $val->id;?>);"><img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="<?php echo $val->first_name.' '.$val->last_name;?>" class="img-circle"> <span><?php echo $val->first_name.' '.$val->last_name;?><small class="text-success"><?php $rolename= admin_helper::get_role_name($val->role); echo $rolename[0]->name;?></small></span></a>
                                    </li>
                                    <?php }}?>
                                	<li class="p-20"></li>
                                </ul>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-themecolor">
                        <div class="panel-heading">USER TRACKS</div>
                        <div class="panel-body" style="padding-top:0px;padding-bottom:10px;">
                            <div style="display:none;" id="loader_main" class="loader_main"><div class="loader"></div></div>
                            <table class="table table-hover">
                                <!--<thead>
                                    <tr>
                                        <th width="30">
                                            <div class="checkbox m-t-0 m-b-0 ">
                                                <input id="checkbox0" type="checkbox" class="checkbox-toggle" value="check all">
                                                <label for="checkbox0"></label>
                                            </div>
                                        </th>
                                        <th colspan="4">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light m-r-5" data-toggle="dropdown" aria-expanded="false"> Filter <b class="caret"></b> </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#fakelink">Read</a></li>
                                                    <li><a href="#fakelink">Unread</a></li>
                                                    <li><a href="#fakelink">Something else here</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#fakelink">Separated link</a></li>
                                                </ul>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-refresh"></i> </button>
                                            </div>
                                        </th>
                                        <th class="hidden-xs" width="100">
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>-->
                                <tbody id="results">
                                    <tr class="unread"><td colspan="6" class="hidden-xs">No Results Found</td></tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-xs-7" id="total_results">Showing 0 - 0 of 0</div>
                                <div class="col-xs-5">
                                    <div class="btn-group pull-right">
                                        <!--<button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>
                                        <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/chat.js"></script>