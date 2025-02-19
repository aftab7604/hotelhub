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
<body class="fix-sidebar hide-sidebar">
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
                     </span>
                     </a>
                </div>
                <ul class="nav navbar-top-links navbar-left">
                   <!--<li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>-->
                </ul>
                <ul class="nav navbar-top-links navbar-left" style="width:65%;">
                	<?php 
						$hotel_id	= $reservations[0]->hotel_id;
						$hotel_name = admin_helper::get_hotel_name($hotel_id);
						echo '<li id="hotel-name" style="width:100%; text-align: center;line-height: 60px;font-size:30px;color: white;">'.$hotel_name[0]->hotel_name.'</li>';
					?>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $reservations[0]->guest_name;?>
                    </b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?php echo $reservations[0]->guest_name;?></h4>
                                        <p class="text-muted"><?php echo $reservations[0]->guest_email;?></p>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <?php if(isset($this->session->userdata['logged_in']['role'])){?>
								<li><a href="<?php echo base_url();?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
							<?php }else{?>
								<li><a href="<?php echo base_url();?>login"><i class="fa fa-power-off"></i> Login</a></li>
							<?php }?>
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
                        <h4 class="page-title">Make Reservation</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active">Make Reservation Page</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Reservation</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <!--Errors divs-->
                                     <?php
                                       if($this->session->flashdata('flash_data') != ""){
                                           echo '<div class="alert alert-success alert-dismissable">';
                                           echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                           echo $this->session->flashdata('flash_data');
                                           echo '</div>';
                                       }
                                       if ($this->session->flashdata('flash_data_danger') != ""){
                                           echo '<div style=" margin: 10px;" class="alert alert-danger alert-dismissable">';
                                           echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                           echo $this->session->flashdata('flash_data_danger');
                                           echo '</div>';
                                       }
                                     ?>
                                     <!--create ticket-->
                                    <form action="<?php echo base_url();?>reservations/add_reservations" method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-errorr">
                                                        <input type="hidden" name="hotel_id" value="<?php echo $reservations[0]->hotel_id;?>">
                                                        <input type="text" tabindex="1" class="form-control" placeholder="Guest Name" name="guest_name" value="<?php echo $reservations[0]->guest_name;?>" required>
                                                    </div>
                                                    <div class="form-group has-errorr">
                                                        <select tabindex="3" class="form-control room_type" name="room_type" required>
                                                            <option value="">Select Room Type</option>
                                                            <?php foreach($room_type as $row){?>
                                                                <option value="<?php echo $row->room_type;?>"><?php echo $row->room_type;?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group has-errorr">
                                                        <div class="input-group">
                                                        <input type="text" tabindex="5" class="form-control datetimepicker3" id="datetimepicker3" name="arrival_date" placeholder="Arrival Date" required> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-errorr">
                                                        <input type="text" tabindex="2" class="form-control" placeholder="Email" name="guest_email" value="<?php echo $reservations[0]->guest_email;?>" required>
                                                    </div>
                                                    <div class="form-group has-errorr">
                                                        <input class="form-control" tabindex="4" placeholder="Phone number" name="guest_phone" type="text"  value="" required>
                                                    </div>
                                                    <div class="form-group has-errorr">
                                                        <div class="input-group">
                                                            <input type="text" tabindex="6" class="form-control datetimepicker2" id="datetimepicker2" name="depart_date" placeholder="Departure Date" required> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions text-center">
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
	<?php echo $footer; ?>