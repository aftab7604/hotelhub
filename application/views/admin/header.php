<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon.png">
    <title>
		<?php if(isset($page_title))	: ?><?php echo $page_title; 	endif; ?> 	
        <?php if(!isset($page_title))	: ?><?php echo 'Login';			endif; ?>     
        <?php if(isset($site_name))		: ?><?php echo $site_name;		endif; ?>
        <?php if(!isset($site_name))	: ?><?php echo ' | HOPS 247';	endif; ?> 
    </title>
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>-->
    <!--<script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>-->
    
    <script src="<?php echo base_url();?>assets/js/jquery.plugin.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/timer.jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.countdown.min.js"></script>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>-->
        
    <link href="<?php echo base_url();?>assets/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- Footable CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style_2.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style_3.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/new-resposiveeeexxxxxxxxx.css" rel="stylesheet">
    <!-- Popup CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- color CSS -->
    <!--<link href="<?php echo base_url();?>assets/css/colors/default.css" id="theme" rel="stylesheet">-->
    <link href="<?php echo base_url();?>assets/css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/spectrum.css" rel="stylesheet">
    <!--alerts CSS -->
    <!--<link href="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">-->
    <!--Chart CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/css-chart/css-chart.css" rel="stylesheet">
    <!-- MULTI Select CSS -->
   <!-- <link href="<?php echo base_url();?>assets/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />-->
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Toastr Settings -->
    <script>
        toastr.options = {
            closeButton: true,       // Show close (×) button
            progressBar: true,       // Show progress bar
            positionClass: "toast-top-right", // Position
            timeOut: 5000,           // Duration (5 seconds)
            extendedTimeOut: 2000,   // Extra time if hovered
            preventDuplicates: true, // Prevent duplicate messages
            showMethod: "fadeIn",    // Animation when appearing
            hideMethod: "fadeOut",   // Animation when disappearing
        };
    </script>    
    <style>
        /* Remove transparency */
        #toast-container > .toast {
            opacity: 1 !important; /* Fully opaque */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }

        /* Make it stand out more */
        .toast-success {
            background-color: #28a745 !important; /* Green */
            color: #fff !important;
        }

        .toast-info {
            background-color: #17a2b8 !important; /* Blue */
            color: #fff !important;
        }

        .toast-warning {
            background-color: #ffc107 !important; /* Yellow */
            color: white !important;
        }

        .toast-error {
            background-color: #dc3545 !important; /* Red */
            color: #fff !important;
        }

        /* Close button color */
        .toast-close-button {
            color: white !important;
            opacity: 1 !important; /* Fully visible */
        }
    </style> 
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
        var base_url = "<?php echo base_url(); ?>";
		function showElapsdTimeElapsed(timestamp, id){
			jQuery('.get_started_'+id).countdown(timestamp, {elapse: true}).on('update.countdown', function(event) {
				//alert(jQuery(this).attr('id')+":::"+timestamp);
				var format = '%H:%M:%S';
				jQuery(this).html(event.strftime(format));				  
			});
		}
		function showElapsdTimeGap(timestamp, id){
			jQuery('.pickup_gap_'+id).countdown(timestamp, {elapse: true}).on('update.countdown', function(event) {
			var format = '%H:%M:%S';
				jQuery(this).html(event.strftime(format));				  
			});
		}
		function showPickedupTime(timestamp, id){
			jQuery('.pickup_started_'+id).countdown(timestamp, {elapse: true}).on('update.countdown', function(event) {
				var format = '%H:%M:%S';
				if (event.elapsed){
					jQuery(this).html(event.strftime('After end:<br/> '+format));
				} else {
					jQuery(this).html(event.strftime('To end: ' +format));
				}
			});
		}
    </script>
</head>
<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!--<a class="logo" href="<?php echo base_url();?>">
                        <img src="<?php echo base_url();?>assets/images/logo-1.png" alt="www.hotelgss.com" class="dark-logo 1" width="205" height="36"/>
                        <span class="hidden-xs">
                            <img src="<?php echo base_url();?>assets/images/logo-1.png" alt="www.hotelgss.com" class="light-logo 2" width="205" height="36"/>
                            <img src="<?php echo base_url();?>assets/images/logo-2.png" alt="www.hotelgss.com" class="light-logo 3" width="205" height="36" />
                        </span>
                    </a>-->
                    <a class="logo" href="<?php echo base_url();?>">
                        <b>
                            <img src="<?php echo base_url();?>assets/images/logo-1.png" width="33" height="" alt="www.hotelgss.com" class="dark-logo" />
                            <img src="<?php echo base_url();?>assets/images/logo-1.png" width="33" height="" alt="www.hotelgss.com" class="light-logo" />
                        </b>
                        <span class="hidden-xs">
                            <img src="<?php echo base_url();?>assets/images/logo-2.png" width="139" height="" alt="www.hotelgss.com" class="dark-logo" />
                            <img src="<?php echo base_url();?>assets/images/logo-2.png" width="139" height="" alt="www.hotelgss.com" class="light-logo" />
                        </span>
                    </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                	<li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                    <!--<li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle waves-effect waves-light notification">
                        	<i class="mdi mdi-bell"></i>
                            <span class="badge" id="badge"></span>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li><div class="message-center top_notifications" id="top_notifications"></div></li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <?php
						$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
						if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] != '1')){
							$hotel_name		= admin_helper::get_hotel_name($hotel_id);
							$hotel_settings = admin_helper::get_settings($hotel_id);
							//echo $hotel_name[0]->hotel_name;
							
							if(isset($hotel_settings[0]) && $hotel_settings[0]->panic_btn == 1){
								echo '<li class="dropdown">
									<a class="dropdown-toggle waves-effect waves-light" data-toggle="modal" data-target=".bs-panic-button" data-backdrop="static" data-keyboard="false" href="#" style="background-color: reddd;"><i class="fa fa-exclamation-circle fa-2xxx"></i></a>
								</li>';
							}
						}
					?>
                    
                    <!-- .Megamenu -->
                    <li class="mega-dropdown hidden-sm hidden-xs" style="text-align: center;line-height: 60px;font-size:30px;color: white;">
                    </li>
                    <!-- /.Megamenu -->
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10 m-t-20">
                            <!--<input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a>-->
                            <?php echo date("l, F d, Y");?>
                        </form>
                    </li>
					<?php
                        $user_id	= $this->session->userdata['logged_in']['id'];
                        if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] == '8')){
                            $user_info		= admin_helper::get_user_name($user_id);
                            if($user_info[0]->multi_firms != ''){
                                $multi_firms	= admin_helper::get_multiple_hotels($user_info[0]->multi_firms);
                            }
					?>
                    <li>
                        <form role="search" class="app-searchh col-lg-12 col-md-12 col-sm-3 col-xs-3 hidden-sm hidden-xs" style="margin-top: 12px;">
                            <select class="form-control" id="single_hotel_top" required>
                                <?php if(is_array($multi_firms)){foreach($multi_firms as $multi_firm){?>
                                <option value="<?php echo $multi_firm->hotel_id; ?>" <?php if($multi_firm->hotel_id == $hotel_id){echo 'selected="selected"';} ?>><?php echo $multi_firm->hotel_name; ?></option>
                                <?php }} ?>
                            </select>
                        </form>
                    </li>
                    <?php } ?>
                    <?php
						//$profile_default_image = default_profile_image().'assets/plugins/images/users/varun.jpg';
						if(isset($this->session->userdata['logged_in'])){
							$user_info = admin_helper::get_user_name($this->session->userdata['logged_in']['id']);
							if($user_info[0]->logo != ''){
								$user_logo	= base_url().'assets/images/user_profile_images/'.$user_info[0]->logo;
							}else{
								$user_logo	= base_url().DEFAULT_PROFILE_IMAGE;
							}
						}
					?>
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo $user_logo; ?>" alt="user-img" width="36" height="36" class="img-circle"><b class="hidden-xs">
						<?php if(isset($this->session->userdata['logged_in'])){
							  if(isset($this->session->userdata['logged_in']['username'])){echo $this->session->userdata['logged_in']['username'];}
							  else if(isset($this->session->userdata['logged_in']['first_name'])){echo $this->session->userdata['logged_in']['first_name'];}
						}?>
                    </b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box p-b-0">
                                    <div class="u-img"><img src="<?php echo $user_logo; ?>" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?php if(isset($this->session->userdata['logged_in'])){
												  if(isset($this->session->userdata['logged_in']['username'])){echo $this->session->userdata['logged_in']['username'];}
												  else if(isset($this->session->userdata['logged_in']['first_name'])){echo $this->session->userdata['logged_in']['first_name'];}
											}?></h4>
                                        <p class="text-muted">
                                        <?php if(isset($this->session->userdata['logged_in'])){
											  if(isset($this->session->userdata['logged_in']['email'])){echo $this->session->userdata['logged_in']['email'];}
										}?>
                                        </p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                    </div>
                                    <?php 
									if(isset($this->session->userdata['logged_in'])){
										$user_role = admin_helper::get_role_name($this->session->userdata['logged_in']['role']);
										$user_role_name = $user_role[0]->name;
									}else{$user_role_name = '';}
									?>
                                    <p class="text-muted m-b-0 m-t-10">Welcome back <?php echo $this->session->userdata['logged_in']['first_name'].' '.$this->session->userdata['logged_in']['last_name'];?> (<?php echo $user_role_name;?>)</p>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url();?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        
        <!--$('#myModal').modal({backdrop: 'static', keyboard: false})-->
			<div class="modal fade bs-panic-button" id="panic-button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:99999999999999999; top:50px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title panic-title" id="myModalLabel">YOU ARE ACTIVATING THE HOTEL PANIC SYSTEM</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action="<?php echo base_url();?>emergency" id="panic_button_form" method="post" enctype="multipart/form-data">
                            	<div id="sec_1">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-12">
                                            <p class="text-center">IS THIS AN EMERGENCY?</p>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-12 text-center"><p>
                                            <button type="button" class="btn btn-danger waves-effect m-r-20" onClick="panic_button('yes')">YES</button>
                                            <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">NO</button></p>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-12 text-center">
                                            <p>"OPPS" I HIT THE WRONG BUTTON</p>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="sec_2" style="display:none;">
                                	<div class="form-group m-b-0">
                                        <label class="col-sm-5">What is your location?</label>
                                        <div class="col-sm-5 m-b-10">
                                        	<input type="text" class="form-control" name="location" placeholder="Your Location" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-sm-5">Emergency:</label>
                                        <div class="col-sm-5">
                                            <div class="radio radio-success">
                                                <input name="emergency_type" value="Medical" type="radio" required>
                                                <label>MEDICAL</label>
                                            </div>
                                            <div class="radio radio-success">
                                                <input name="emergency_type" value="Fire" type="radio" required>
                                                <label>FIRE</label>
                                            </div>
                                            <div class="radio radio-success">
                                                <input name="emergency_type" value="Law Enforcement" type="radio" required>
                                                <label>LAW ENFORCEMENT</label>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group m-b-0 clearfix">
                                        <label class="col-sm-12">Notes:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="panic_notes" name="panic_notes" rows="5" cols="60" required></textarea>
                                        </div>
                                    </div>                                                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div id="sec_2_footer" style="display:none;">
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success waves-effect">Submit</button>
                                </div>
                            </div>
						</form>
                    </div>
                </div>
            </div>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation" style="background-color:#FFFFFF;">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                    <div class="user-profile" style="padding: 45px 0 15px;">
                        <div class="dropdown user-pro-body" style="display:none;">
                            <div><img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="user-img" class="img-circle"></div>
                            <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php if(isset($this->session->userdata['logged_in'])){
                                      if(isset($this->session->userdata['logged_in']['username'])){echo $this->session->userdata['logged_in']['username'];}
                                      else if(isset($this->session->userdata['logged_in']['first_name'])){echo $this->session->userdata['logged_in']['first_name'];}
                                }?>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu animated flipInY">
                                <!--<li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                <li role="separator" class="divider"></li>-->
                                <li><a href="<?php echo base_url();?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                	<ul class="nav" id="side-menu">
                		<li><a href="<?php echo base_url();?>" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard</span></a></li>
                        <!--1 	Super Admin
                            2 	Manager
                            3 	Front Desk
                            4	Housekeeping
                            5 	Food & Beverage
                            6 	Sales
                            7 	Maintainence
                            8 	Admin-->
					<?php 	   if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '1'){?>
                        <li><a href="<?php echo base_url();?>add_hotel" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu"> Hotels <span class="fa arrow"></span> </span></a>
                            <ul class="nav nav-second-level">
                                <li> <a href="<?php echo base_url();?>hotel/add_hotel"><i class=" fa-fw">-</i><span class="hide-menu">Add Hotels</span></a></li>
                                <li> <a href="<?php echo base_url();?>hotel/manage_hotel"><i class=" fa-fw">-</i><span class="hide-menu">Manage Hotels</span></a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url();?>add_users" class="waves-effect"><i class="fa fa-users fa-fw" data-icon="v"></i> <span class="hide-menu"> Users <span class="fa arrow"></span> </span></a>
                            <ul class="nav nav-second-level">
                                <li> <a href="<?php echo base_url();?>users/add_user"><i class=" fa-fw">-</i><span class="hide-menu">Add User</span></a></li>
                                <li> <a href="<?php echo base_url();?>users/manage_users"><i class=" fa-fw">-</i><span class="hide-menu">Manage Users</span></a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url();?>hotel/one_login" class="waves-effect"><i class="mdi mdi-calendar-check fa-fw" data-icon="v"></i> <span class="hide-menu"> One-Login</span></a></li>
                        <li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="mdi mdi-calendar-check fa-fw" data-icon="v"></i> <span class="hide-menu"> Preventive Maintenance</span></a></li>
                    <?php }
						  else if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '2'){?>
                            <li><a href="<?php echo base_url();?>rooms" class="waves-effect"><i class="fa fa-bars fa-fw" data-icon="v"></i> <span class="hide-menu">Management<span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>rooms/add_rooms"><i class=" fa-fw">-</i><span class="hide-menu">Manage Rooms</span></a></li>
                                    <li> <a href="<?php echo base_url();?>rooms/add_keys"><i class=" fa-fw">-</i><span class="hide-menu">Manage Keys</span></a></li>
                                </ul>
                        	</li>
                            <li><a href="<?php echo base_url();?>add_users" class="waves-effect"><i class="fa fa-users fa-fw" data-icon="v"></i> <span class="hide-menu"> Employees <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>users/add_employee"><i class=" fa-fw">-</i><span class="hide-menu">Add Employee</span></a></li>
                                    <li> <a href="<?php echo base_url();?>users/manage_employee"><i class=" fa-fw">-</i><span class="hide-menu">Manage Employees</span></a></li>
                                </ul>
                        	</li>
                            <!--<li><a href="<?php echo base_url();?>rooms/add_rooms" class="waves-effect"><i class="fa fa-bars fa-fw"data-icon="v"></i> <span class="hide-menu">Manage Rooms</span></a></li>-->
                            <li><a href="<?php echo base_url();?>pmp/add_checklist" class="waves-effect"><i class="mdi mdi-calendar-check fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage PMP <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>pmp/add_checklist"><i class=" fa-fw">-</i><span class="hide-menu">Add Checklist</span></a></li>
                                    <li> <a href="<?php echo base_url();?>pmp/manage_checklist"><i class=" fa-fw">-</i><span class="hide-menu">Manage Checklist</span></a></li>
                                </ul>
                        	</li>
                            <li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>event/calendar" class="waves-effect"><i class="fa fa-calendar fa-fw" data-icon="v"></i> <span class="hide-menu">Events</span></a></li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"><?php $GVPndgTkts_count= admin_helper::getCountOfGVPendingTickets($hotel_id);echo $GVPndgTkts_count[0]->GVPndgTkts_count; ?></span></span></a>
                            </li>
                            <li><a href="<?php echo base_url();?>mpor" class="waves-effect"><i class="fa fa-fort-awesome fa-fw" data-icon="v"></i> <span class="hide-menu"> Housekeeping Zone <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/my_board"><i class=" fa-fw">-</i><span class="hide-menu">My Board</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/statistics"><i class=" fa-fw">-</i><span class="hide-menu">HK Statistics</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/analytics"><i class=" fa-fw">-</i><span class="hide-menu">MPOR Analytics</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/history"><i class=" fa-fw">-</i><span class="hide-menu">HK History</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>key_log" class="waves-effect"><i class="fa fa-key fa-fw" data-icon="v"></i> <span class="hide-menu"> Key Logs <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>key_log/view"><i class=" fa-fw">-</i><span class="hide-menu">Key Logs</span></a></li>
                                    <li> <a href="<?php echo base_url();?>key_log/history"><i class=" fa-fw">-</i><span class="hide-menu">Key Logs History</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>welcome_call" class="waves-effect"><i class="fa fa-phone fa-fw" data-icon="v"></i> <span class="hide-menu"> Welcome Call <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>welcome_call"><i class=" fa-fw">-</i><span class="hide-menu">Add Welcome Call</span></a></li>
                                    <li> <a href="<?php echo base_url();?>welcome_call/history"><i class=" fa-fw">-</i><span class="hide-menu">Welcome Call History</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>guest_survey" class="waves-effect"><i class="fa fa-list fa-fw" data-icon="v"></i> <span class="hide-menu"> Guest Survey<span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>guest_survey/manage"><i class=" fa-fw">-</i><span class="hide-menu">Manage Guest Survey</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/scoreboard"><i class=" fa-fw">-</i><span class="hide-menu">Survey Scoreboard</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/survey_responses"><i class=" fa-fw">-</i><span class="hide-menu">GWC Survey Responses</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/mass_survey"><i class=" fa-fw">-</i><span class="hide-menu">Manage Mass Survey</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/mass_survey_upload"><i class=" fa-fw">-</i><span class="hide-menu">MASS SURVEY UPLOAD</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>users/tracking" class="waves-effect"><i class="fa fa-bars fa-fw" data-icon="v"></i> <span class="hide-menu">Tracking</span></a></li>
                            <li class="devider"></li>
                            <li><a href="<?php echo base_url();?>settings" class="waves-effect"><i class="fa fa-cog fa-fw" data-icon="v"></i> <span class="hide-menu"> Settings</span></a></li>
                    <?php }
						  else if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '3'){?>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"><?php $GVPndgTkts_count= admin_helper::getCountOfGVPendingTickets($hotel_id);echo $GVPndgTkts_count[0]->GVPndgTkts_count; ?></span></span></a>
                            </li>
                            <li><a href="<?php echo base_url();?>ticket" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage Tickets <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>ticket/create_ticket">		<i class="fa-fw">-</i><span class="hide-menu">Create Service Ticket</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/pending_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Pending Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/picked_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Picked-up Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/closed_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Closed Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/search_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Search Tickets</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>mpor" class="waves-effect"><i class="fa fa-fort-awesome fa-fw" data-icon="v"></i> <span class="hide-menu"> Housekeeping Zone <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>key_log/view" class="waves-effect"><i class="fa fa-key fa-fw" data-icon="v"></i> <span class="hide-menu">Key Logs</span></a></li>
                            <li><a href="<?php echo base_url();?>welcome_call" class="waves-effect"><i class="fa fa-phone fa-fw" data-icon="v"></i> <span class="hide-menu"> Welcome Call <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>welcome_call/index"><i class=" fa-fw">-</i><span class="hide-menu">Add Welcome Call</span></a></li>
                                    <li> <a href="<?php echo base_url();?>welcome_call/history"><i class=" fa-fw">-</i><span class="hide-menu">Welcome Call History</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/scoreboard"><i class=" fa-fw">-</i><span class="hide-menu">Survey Scoreboard</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/survey_responses"><i class=" fa-fw">-</i><span class="hide-menu">GWC Survey Responses</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"><?php $futureReservations= admin_helper::getCountOfFutureReservations($hotel_id);echo $futureReservations[0]->reservations_count; ?></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <?php }
						  else if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '4'){?>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>ticket" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage Tickets <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>ticket/create_ticket">		<i class="fa-fw">-</i><span class="hide-menu">Create Service Ticket</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/pending_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Pending Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/picked_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Picked-up Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/closed_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Closed Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/search_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Search Tickets</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>event/calendar" class="waves-effect"><i class="fa fa-calendar fa-fw" data-icon="v"></i> <span class="hide-menu">Events</span></a></li>
                            <li><a href="<?php echo base_url();?>key_log/view" class="waves-effect"><i class="fa fa-key fa-fw" data-icon="v"></i> <span class="hide-menu">Key Logs</span></a></li>
                            <li><a href="<?php echo base_url();?>mpor" class="waves-effect"><i class="fa fa-fort-awesome fa-fw" data-icon="v"></i> <span class="hide-menu"> Housekeeping Zone <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                	<?php if($this->session->userdata['logged_in']['mngrInsptr'] == 'manager' || $this->session->userdata['logged_in']['mngrInsptr'] == 'inspector'){?>
                                    	<li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    	<li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                        <li> <a href="<?php echo base_url();?>mpor/my_board"><i class=" fa-fw">-</i><span class="hide-menu">My Board</span></a></li>
                                        <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    	<li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                    <?php }else{?>
                                        <li> <a href="<?php echo base_url();?>mpor/my_board"><i class=" fa-fw">-</i><span class="hide-menu">My Board</span></a></li>
                                        <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <?php }
						  else if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '5'){?>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"><?php $GVPndgTkts_count= admin_helper::getCountOfGVPendingTickets($hotel_id);echo $GVPndgTkts_count[0]->GVPndgTkts_count; ?></span></span></a>
                            </li>
                            <li><a href="<?php echo base_url();?>ticket" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage Tickets <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>ticket/create_ticket">		<i class="fa-fw">-</i><span class="hide-menu">Create Service Ticket</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/pending_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Pending Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/picked_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Picked-up Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/closed_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Closed Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/search_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Search Tickets</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>mpor" class="waves-effect"><i class="fa fa-fort-awesome fa-fw" data-icon="v"></i> <span class="hide-menu"> Housekeeping Zone <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>welcome_call" class="waves-effect"><i class="fa fa-phone fa-fw" data-icon="v"></i> <span class="hide-menu"> Welcome Call <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>welcome_call/index"><i class=" fa-fw">-</i><span class="hide-menu">Add Welcome Call</span></a></li>
                                    <li> <a href="<?php echo base_url();?>welcome_call/history"><i class=" fa-fw">-</i><span class="hide-menu">Welcome Call History</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/scoreboard"><i class=" fa-fw">-</i><span class="hide-menu">Survey Scoreboard</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/survey_responses"><i class=" fa-fw">-</i><span class="hide-menu">GWC Survey Responses</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"><?php $futureReservations= admin_helper::getCountOfFutureReservations($hotel_id);echo $futureReservations[0]->reservations_count; ?></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <?php }
						  else if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '6'){?>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"><?php $GVPndgTkts_count= admin_helper::getCountOfGVPendingTickets($hotel_id);echo $GVPndgTkts_count[0]->GVPndgTkts_count; ?></span></span></a>
                            </li>
                            <li><a href="<?php echo base_url();?>ticket" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage Tickets <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>ticket/create_ticket">		<i class="fa-fw">-</i><span class="hide-menu">Create Service Ticket</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/pending_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Pending Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/picked_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Picked-up Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/closed_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Closed Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/search_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Search Tickets</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>mpor" class="waves-effect"><i class="fa fa-fort-awesome fa-fw" data-icon="v"></i> <span class="hide-menu"> Housekeeping Zone <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>welcome_call" class="waves-effect"><i class="fa fa-phone fa-fw" data-icon="v"></i> <span class="hide-menu"> Welcome Call <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>welcome_call/index"><i class=" fa-fw">-</i><span class="hide-menu">Add Welcome Call</span></a></li>
                                    <li> <a href="<?php echo base_url();?>welcome_call/history"><i class=" fa-fw">-</i><span class="hide-menu">Welcome Call History</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/scoreboard"><i class=" fa-fw">-</i><span class="hide-menu">Survey Scoreboard</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/survey_responses"><i class=" fa-fw">-</i><span class="hide-menu">GWC Survey Responses</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"><?php $futureReservations= admin_helper::getCountOfFutureReservations($hotel_id);echo $futureReservations[0]->reservations_count; ?></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <?php }
						  else if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '7'){?>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"><?php $GVPndgTkts_count= admin_helper::getCountOfGVPendingTickets($hotel_id);echo $GVPndgTkts_count[0]->GVPndgTkts_count; ?></span></span></a>
                            </li>
                            <li><a href="<?php echo base_url();?>ticket" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage Tickets <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>ticket/create_ticket">		<i class="fa-fw">-</i><span class="hide-menu">Create Service Ticket</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/pending_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Pending Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/picked_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Picked-up Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/closed_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Closed Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/search_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Search Tickets</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>mpor" class="waves-effect"><i class="fa fa-fort-awesome fa-fw" data-icon="v"></i> <span class="hide-menu"> Housekeeping Zone <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>welcome_call" class="waves-effect"><i class="fa fa-phone fa-fw" data-icon="v"></i> <span class="hide-menu"> Welcome Call <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>welcome_call/index"><i class=" fa-fw">-</i><span class="hide-menu">Add Welcome Call</span></a></li>
                                    <li> <a href="<?php echo base_url();?>welcome_call/history"><i class=" fa-fw">-</i><span class="hide-menu">Welcome Call History</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/scoreboard"><i class=" fa-fw">-</i><span class="hide-menu">Survey Scoreboard</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/survey_responses"><i class=" fa-fw">-</i><span class="hide-menu">GWC Survey Responses</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"><?php $futureReservations= admin_helper::getCountOfFutureReservations($hotel_id);echo $futureReservations[0]->reservations_count; ?></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <?php }
						  else if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '8'){?>
                            <li><a href="<?php echo base_url();?>add_users" class="waves-effect"><i class="fa fa-users fa-fw" data-icon="v"></i> <span class="hide-menu"> Employees <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>users/add_employee"><i class=" fa-fw">-</i><span class="hide-menu">Add Employee</span></a></li>
                                    <li> <a href="<?php echo base_url();?>users/manage_employee"><i class=" fa-fw">-</i><span class="hide-menu">Manage Employees</span></a></li>
                                </ul>
                        	</li>
                            <li><a href="<?php echo base_url();?>rooms" class="waves-effect"><i class="fa fa-bars fa-fw" data-icon="v"></i> <span class="hide-menu">Manage Hotel Areas<span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>rooms/add_rooms"><i class=" fa-fw">-</i><span class="hide-menu">Manage Rooms</span></a></li>
                                    <li> <a href="<?php echo base_url();?>rooms/add_keys"><i class=" fa-fw">-</i><span class="hide-menu">Manage Keys</span></a></li>
                                </ul>
                        	</li>
                            <li><a href="<?php echo base_url();?>message" class="waves-effect"><i class="fa fa-envelope fa-fw" data-icon="v"></i> <span class="hide-menu">Messages</span></a></li>
                            <li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="mdi mdi-calendar-check fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage PMP <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>pmp/add_checklist"><i class=" fa-fw">-</i><span class="hide-menu">Add Checklist</span></a></li>
                                    <li> <a href="<?php echo base_url();?>pmp/manage_checklist"><i class=" fa-fw">-</i><span class="hide-menu">Manage Checklist</span></a></li>
                                    <li> <a href="<?php echo base_url();?>pmp/manage_board_checklist"><i class=" fa-fw">-</i><span class="hide-menu">My Board Checklist</span></a></li>
                                </ul>
                        	</li>
                            <li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>ticket" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu"> Manage Tickets <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>ticket/create_ticket">		<i class="fa-fw">-</i><span class="hide-menu">Create Service Ticket</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/pending_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Pending Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/picked_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Picked-up Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/closed_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Closed Tickets</span></a></li>
                                    <li><a href="<?php echo base_url();?>ticket/search_tickets">	<i class="fa-fw">-</i><span class="hide-menu">Search Tickets</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>productivity" class="waves-effect"><i class="fa fa-list fa-fw" data-icon="v"></i> <span class="hide-menu">Productivity Ranker<span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>productivity/ranker"><i class=" fa-fw">-</i><span class="hide-menu">Productivity Ranker</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"><?php $GVPndgTkts_count= admin_helper::getCountOfGVPendingTickets($hotel_id);echo $GVPndgTkts_count[0]->GVPndgTkts_count; ?></span></span></a>
                            </li>
                            <li><a href="<?php echo base_url();?>mpor" class="waves-effect"><i class="fa fa-fort-awesome fa-fw" data-icon="v"></i> <span class="hide-menu"> Housekeeping Zone <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/my_board"><i class=" fa-fw">-</i><span class="hide-menu">My Board</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/statistics"><i class=" fa-fw">-</i><span class="hide-menu">HK Statistics</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/analytics"><i class=" fa-fw">-</i><span class="hide-menu">MPOR Analytics</span></a></li>
                                    <li> <a href="<?php echo base_url();?>mpor/history"><i class=" fa-fw">-</i><span class="hide-menu">HK History</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>key_log" class="waves-effect"><i class="fa fa-key fa-fw" data-icon="v"></i> <span class="hide-menu"> Key Logs <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>key_log/view"><i class=" fa-fw">-</i><span class="hide-menu">Key Logs</span></a></li>
                                    <li> <a href="<?php echo base_url();?>key_log/history"><i class=" fa-fw">-</i><span class="hide-menu">Key Logs History</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>vendor_log" class="waves-effect"><i class="fa fa-wrench fa-fw" data-icon="v"></i> <span class="hide-menu"> Vendor Logs <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>vendor_log/add_vendor"><i class=" fa-fw">-</i><span class="hide-menu">Add Vendor</span></a></li>
                                    <li> <a href="<?php echo base_url();?>vendor_log/manage_vendor"><i class=" fa-fw">-</i><span class="hide-menu">Manage Vendor</span></a></li>
                                    <li> <a href="<?php echo base_url();?>vendor_log/vendor_signIn"><i class=" fa-fw">-</i><span class="hide-menu">Vendor Sign-In</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>welcome_call" class="waves-effect"><i class="fa fa-phone fa-fw" data-icon="v"></i> <span class="hide-menu"> Welcome Call <span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>welcome_call"><i class=" fa-fw">-</i><span class="hide-menu">Add Welcome Call</span></a></li>
                                    <li> <a href="<?php echo base_url();?>welcome_call/history"><i class=" fa-fw">-</i><span class="hide-menu">Welcome Call History</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>event/calendar" class="waves-effect"><i class="fa fa-calendar fa-fw" data-icon="v"></i> <span class="hide-menu">Events</span></a></li>
                            <li><a href="<?php echo base_url();?>guest_survey" class="waves-effect"><i class="fa fa-list fa-fw" data-icon="v"></i> <span class="hide-menu"> Guest Survey<span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>guest_survey/manage"><i class=" fa-fw">-</i><span class="hide-menu">Manage Guest Survey</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/scoreboard"><i class=" fa-fw">-</i><span class="hide-menu">Survey Scoreboard</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/survey_responses"><i class=" fa-fw">-</i><span class="hide-menu">GWC Survey Responses</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/mass_survey"><i class=" fa-fw">-</i><span class="hide-menu">Manage Mass Survey</span></a></li>
                                    <li> <a href="<?php echo base_url();?>guest_survey/mass_survey_upload"><i class=" fa-fw">-</i><span class="hide-menu">MASS SURVEY UPLOAD</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"><?php $futureReservations= admin_helper::getCountOfFutureReservations($hotel_id);echo $futureReservations[0]->reservations_count; ?></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>users/tracking" class="waves-effect"><i class="fa fa-bars fa-fw" data-icon="v"></i> <span class="hide-menu">Tracking</span></a></li>
                            <li><a href="<?php echo base_url();?>agenda/add_agenda" class="waves-effect"><i class="fa fa-bars fa-fw" data-icon="v"></i> <span class="hide-menu">Agenda</span></a></li>
                            <li class="devider"></li>
                            <li><a href="<?php echo base_url();?>settings" class="waves-effect"><i class="fa fa-cog fa-fw" data-icon="v"></i> <span class="hide-menu">Settings<span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?php echo base_url();?>settings/index"><i class=" fa-fw">-</i><span class="hide-menu">Settings</span></a></li>
                                    <li> <a href="<?php echo base_url();?>settings/dash"><i class=" fa-fw">-</i><span class="hide-menu">Dashboard Settings</span></a></li>
                                    <li> <a href="<?php echo base_url();?>settings/ticket"><i class=" fa-fw">-</i><span class="hide-menu">Tickets Notifications</span></a></li>
                                </ul>
                            </li>
                    <?php }
					
					?>
                    <li class="devider"></li>
                    <li><a href="<?php echo base_url();?>support" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Tech Support<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>support/add_new_case"><i class=" fa-fw">-</i><span class="hide-menu">New Support Case</span></a></li>
                            <?php if(isset($this->session->userdata['logged_in']['role']) && $this->session->userdata['logged_in']['role'] == '1'){?>
                            	<li> <a href="<?php echo base_url();?>support/manage_cases"><i class=" fa-fw">-</i><span class="hide-menu">Support Cases</span></a></li>
                            <?php }?>
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <!--<li><img class="img-responsive center-block" src="<?php echo base_url();?>assets/images/kayak_group.png" title="Kayak Group" width="150" style="margin-top:20px;" /></li>-->
                </ul>
            </div>
        </div>
        <div id="page-wrapper">
        <style>
			.navbar-header {
				/*background: black;*/
				/*background-color:#fff;*/
				/*background-color:#000040;*/
				
				background-color:#00529b;
				/*background-color:#57c4c2;*/
			}
			#side-menu ul > li > a.active {
				color: #f33155;
				font-weight: 500;
			}
			#side-menu ul > li > a:hover {
				color: #f33155;
				font-weight: 500;
			}
			[placeholder]:focus::-webkit-input-placeholder {
			  transition: opacity 0.5s 0.5s ease; 
			  opacity: 0;
			}
			.sidebar .sidebar-head h3{
				color:#00529b;
			}
			.navbar-top-links .badge {
				position: absolute;
				right: 7px;
				top: 7px;
			}
			.badge {
				padding: 3px 5px;
				margin-top: 0px;
				background-color: red;
			}
			.app-search{
				color:white;
			}
        </style>
        
<script>
    //Employee change
    function handleEmployeeChange(selectedElement) {
		let record_id = selectedElement.id;
		let employee_id = selectedElement.value;

		let data = {
			'record_id' : record_id,
			'employee_id' : employee_id
		};

		$.ajax({
			url: "<?php echo site_url('mpor/update_employee'); ?>",
			type: "POST",
			data: data,
			beforeSend: function() {
				$('#loader_main').show(); 
			},
			success: function(response) {
				$('#loader_main').hide(); 
				if(response == 'Success') {
					toastr.success("Employee Updated Successfully.");
				} else {
					toastr.success("There is an error, Please try again.");
				}                
			},
			error: function(xhr, status, error) {
				$('#loader_main').hide();
				toastr.error("There is an error, Please try again.");
			}
		});
	}
</script> 