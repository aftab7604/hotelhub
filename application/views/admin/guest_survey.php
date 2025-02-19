<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon.png">
    <title>
		<?php if(isset($page_title)) : ?><?php echo $page_title ?>  <?php endif; ?> 	
        <?php if(!isset($page_title)) : ?><?php echo 'Login'; ?>  <?php endif; ?>     
        <?php if(isset($site_name)) : ?><?php echo $site_name; endif; ?>
        <?php if(!isset($site_name)) : ?><?php echo ' - Hotelgss'; endif; ?> 
    </title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.plugin.min.js"></script>
    
    <?php if($this->uri->segment(2) == 'pending_tickets'){?>
        <script src="<?php echo base_url();?>assets/js/jquery.countdown.js"></script>
    <?php }elseif($this->uri->segment(2) == 'picked_tickets'){?>
        <script src="<?php echo base_url();?>assets/js/jquery.countdown.min.js"></script>
    <?php }else{}?>
    
    <!-- Footable CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link href="<?php echo base_url();?>assets/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/new-resposive.css" rel="stylesheet">
    <!-- Popup CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- color CSS -->
    <!--<link href="<?php echo base_url();?>assets/css/colors/default.css" id="theme" rel="stylesheet">-->
    <link href="<?php echo base_url();?>assets/css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/spectrum.css" rel="stylesheet">

    <!--alerts CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
                    <!-- Logo -->
                    <a class="logo" href="<?php echo base_url();?>"><b>
                        <img src="<?php echo base_url();?>assets/images/logo_home.png" alt="www.hotelgss.com" class="dark-logo" width="180" height="50"/>
                     </b>
                     <span class="hidden-xs"><img src="<?php echo base_url();?>assets/images/logo_home.png" alt="www.hotelgss.com" class="light-logo" width="180" height="50"/>
                     	<img src="<?php echo base_url();?>assets/images/logo_home.png" alt="www.hotelgss.com" class="light-logo" width="180" height="50" />
                     </span> </a>
                     <!--<a class="logo" href="<?php echo base_url();?>"><b>
                        <img src="" alt="www.hotelgss.com" class="dark-logo" width="200" height="60"/>
                     </b>
                     <span class="hidden-xs"><img src="" alt="www.hotelgss.com" class="light-logo" width="200" height="60"/>
                     	<img src="" alt="www.hotelgss.com" class="light-logo" width="200" height="60" />
                     </span> </a>-->
                </div>
                <!--<ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                </ul>-->
                <ul class="nav navbar-top-links navbar-left" style="width:65%;">
					<?php if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] == '8' || $this->session->userdata['logged_in']['role'] == '3' || $this->session->userdata['logged_in']['role'] == '2')){
						$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
						$hotel_name = admin_helper::get_hotel_name($hotel_id);
						echo '<li id="hotel-name" style="width:100%; text-align: center;line-height: 60px;font-size:30px;color: white;">'.$hotel_name[0]->hotel_name.'</li>';
					}?>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">
						<?php if(isset($this->session->userdata['logged_in'])){
							  if(isset($this->session->userdata['logged_in']['username'])){echo $this->session->userdata['logged_in']['username'];}
							  else if(isset($this->session->userdata['logged_in']['first_name'])){echo $this->session->userdata['logged_in']['first_name'];}
						}?>
                    </b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?php if(isset($this->session->userdata['logged_in'])){
												  if(isset($this->session->userdata['logged_in']['username'])){echo $this->session->userdata['logged_in']['username'];}
												  else if(isset($this->session->userdata['logged_in']['first_name'])){echo $this->session->userdata['logged_in']['first_name'];}
											}?></h4>
                                        <p class="text-muted">
                                        <?php if(isset($this->session->userdata['logged_in'])){
											  if(isset($this->session->userdata['logged_in']['email'])){echo $this->session->userdata['logged_in']['email'];}
										}?>
                                        </p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
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
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
        <div id="page-wrapper">
        <style>
			.navbar-header {
				background: black;
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
        </style>
        
        <div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Guest Survey</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Guest Survey Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Guest Survey</div>
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
						   	$hotel_id	= $this->session->userdata['logged_in']['firm_id'];
							$hotel_name = admin_helper::get_hotel_name($hotel_id);
						 ?>
                         <!--Add hotel form-->
                         <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
                        <form action="" id="guestSurveyInfo" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <h3 class="box-title text-center">Welcome to the <?php echo $hotel_name[0]->hotel_name;?></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Message:</label>
                                            <div class="col-md-12">
                                            <?php if($survey_info[0]->message != ''){?>
                                            	<textarea class="form-control" name="message" id="message" rows="5"><?php echo $survey_info[0]->message;?></textarea>
                                            <?php }else{?>
                                                <textarea class="form-control" name="message" id="message" rows="5">Dear "<?php echo $this->session->userdata['logged_in']['username'];?>",
Thank you for choosing the <?php echo $hotel_name[0]->hotel_name;?>! We are thrilled to have you as our guest. 
</textarea>
											<?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Rating</label>
                                            <div class="col-md-12">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 10
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 9
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 8
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 7
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 6
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 5
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 4
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 3
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 2
                                                    </label>
                                                    <label class="btn btn-default form-check-label">
                                                        <input class="form-check-input" type="radio" autocomplete="off"> 1
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Questions which you want show/hide in the survey:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">GSS - Overall Satisfaction</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-1" value="1" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Check-In Experience</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-2" value="2" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Property Overall</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-3" value="3" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Maintenance and Upkeep</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-4" value="4" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Staff Service</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-5" value="5" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Room Overall</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-6" value="7" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-md-5">Room Cleanliness</label>
                                            <div class="col-md-3">
                                               <input class="survey_questions" id="toggle-trigger-7" value="7" data-toggle="toggle" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Additonal Feedback:</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="feedback" id="feedback" rows="5"><?php echo $survey_info[0]->feedback;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Additonal Notes:</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="ad_notes" id="ad_notes" rows="5"><?php echo $survey_info[0]->notes;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Footer:</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="footer" id="footer" rows="5"><?php echo $survey_info[0]->footer;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions m-t-10 text-center">
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
               <!-- /.container-fluid -->
            <footer class="footer text-center"> <?php echo date("Y");?> &reg; Hotel GSS - All Rights Reserved <!--Develope by 
            <a href="https://www.fiverr.com/php_developer_6/fix-any-php-javascript-jquery-htmlcss-bugs?funnel=4dcb841e-1a6f-409f-a534-0b89f04facd6">Luqman R.</a>--> </footer>
        </div>
        <!-- ==============================================================-->
        <!-- End Page Content -->
        <!-- ==============================================================-->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <!-- Magnific popup JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
    <!-- Calendar JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/calendar/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/moment/moment.js"></script>
    <script src='<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/jquery.fullcalendar.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/cal-init.js"></script>
    <!-- Footable -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/footable/js/footable.all.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <!-- Clock Plugin JavaScript -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!--FooTable init-->
    <script src="<?php echo base_url();?>assets/js/footable-init.js"></script>
    <!-- jQuery for carousel -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/owl.carousel/owl.custom.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/js/waves.js"></script>
    <script src="<?php echo base_url();?>assets/js/cbpFWTabs.js"></script>
    <!-- Sweet-Alert  -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <!--DataTables -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jasny-bootstrap.js"></script>
    <!--Tinymce Editor-->
    <!--<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=yz7pdwlbipbaf6318sszxx1ww4de2gzggllojz1j210yadef"></script>-->
	<!--<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>-->
    <!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->
    <script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>

	<script>
		tinymce.init({
			selector:'textarea#mymce',
			plugins: [
				//'spellchecker',
				'advlist autolink lists link image charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code'
			  ],
			/*spellchecker_languages: 'English=en',
			browser_spellcheck: true,
  			contextmenu: false,
			external_plugins: {"nanospell": "/assets/nanospell/plugin.js"},
			nanospell_server: "php",*/
			toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',			
			setup: function (editor) {
				editor.on('change', function () {
					editor.save();
				});
			}
		});
		tinymce.init({
			selector:'textarea#notes',
			plugins: [
				//'spellchecker',
			  ],
			/*spellchecker_languages: 'English=en',
			browser_spellcheck: true,
  			contextmenu: false,*/
			external_plugins: {"nanospell": "/assets/nanospell/plugin.js"},
			nanospell_server: "php",
			//toolbar: 'spellchecker',			
			setup: function (editor) {
				editor.on('change', function () {
					editor.save();
				});
			}
		});
		
		<?php if($this->uri->segment(2) == 'pending_tickets' || $this->uri->segment(2) == 'picked_tickets' || $this->uri->segment(1) == 'logbook' || $this->uri->segment(1) == 'welcome_call'){?>
			tinymce.init({
				selector:'textarea',
				plugins: [
					'emoticons',
				  ],
				/*spellchecker_languages: 'English=en',
				browser_spellcheck: true,
				contextmenu: false,*/
				external_plugins: {"nanospell": "/assets/nanospell/plugin.js"},
				nanospell_server: "php",
				menubar: "false",
				toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | emoticons',		
				setup: function (editor) {
					editor.on('change', function (){
						editor.save();
					});
				}
			});
		<?php } ?>
    </script>
    <!--Style Switcher-->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/spectrum.js"></script>
    <!--On/Off Button-->
	<link href="//gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="//gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!--Push Notifications-->
	<script>
    	//request permission on page load
    	document.addEventListener('DOMContentLoaded', function () {
		if (!Notification) {
			alert('Desktop notifications not available in your browser. Try Chromium.'); 
			return;
		}
    
		if (Notification.permission !== "granted")
			Notification.requestPermission();
		});
    
		function notifyMe(title, bodyMsg, post_url){
			if (Notification.permission !== "granted")
				Notification.requestPermission();
			else {
				var notification = new Notification(title, {
					icon: 'http://www.hotelgss.com/assets/images/favicon.png',
					body: bodyMsg,
				});
				notification.onclick = function (){
					window.open(post_url);      
				};
			}		
		}
	</script>
    <script>
		$(document).ready(function(){
			
			$('.clockpicker').clockpicker({
				donetext: 'Done',
			}).find('input').change(function() {
				console.log(this.value);
			});
			$('#myTable').DataTable();
			$('#myTableTask').DataTable({
			  	aaSorting: [[2, 'asc']]
			});
			$('#myTableLead').DataTable({
			  	aaSorting: [[3, 'asc']],
			  "pageLength": 100
			});
			$('#myTabletodo').DataTable({
				aaSorting: [[3, 'asc']]
			});
			
			jQuery('#datetimepicker-history').datepicker({
                format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true,
				//startDate: '-0d',
				endDate: '-1d',
			});
			
			jQuery('#datetimepicker1').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				//startDate: '-0d',
				endDate: '+0d',
			});
			jQuery('#datetimepicker2').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datetimepicker3').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datetimepicker4').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datetimepicker5').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datetimepicker6').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datepicker_due_2').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datepicker_due_3').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datepicker_due_4').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datepicker_due_5').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datepicker-autoclose').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datepicker-autoclose-end_date').datepicker({
        		format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				startDate: '-0d'
			});
			jQuery('#datepicker-autoclose-achivement_date').datepicker({
        		format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				defaultDate : '',
				startDate: '-0d'
			});
			
			
		});
		(function(){
			[].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
				new CBPFWTabs(el);
			});
		})();
		function validateEmail(sEmail) {
			var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if (filter.test(sEmail)) {return true;}
			else {return false;}
		}
		
	</script>
<style>
#page-wrapper {
    margin: 0 0 0 0px !important;
}
</style>
</body>
</html>