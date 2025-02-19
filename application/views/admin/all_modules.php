<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon.png">
    <title>All Modules | HOPS-247</title>
    <!-- Bootstrap Core CSS -->
    <!-- Custom CSS -->

    <!-- color CSS -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<!-- Preloader -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
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
					<h1>Super Admin</h1>
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
                        <li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="mdi mdi-calendar-check fa-fw" data-icon="v"></i> <span class="hide-menu"> Preventive Maintenance</span></a></li>
                    <h1>Manager</h1>
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
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"></span></span></a>
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
                    <h1>Front Desk</h1>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"></span></span></a>
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
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <h1>Housekeeping</h1>
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
                                	
                                    	<li> <a href="<?php echo base_url();?>mpor/room_breakout"><i class=" fa-fw">-</i><span class="hide-menu">Room Breakout</span></a></li>
                                    	<li> <a href="<?php echo base_url();?>mpor/room_priority"><i class=" fa-fw">-</i><span class="hide-menu">Room Priorities</span></a></li>
                                        <li> <a href="<?php echo base_url();?>mpor/my_board"><i class=" fa-fw">-</i><span class="hide-menu">My Board</span></a></li>
                                        <li> <a href="<?php echo base_url();?>mpor/live_progress"><i class=" fa-fw">-</i><span class="hide-menu">Live Progress</span></a></li>
                                    	<li> <a href="<?php echo base_url();?>mpor/manager_screen"><i class=" fa-fw">-</i><span class="hide-menu">Inspector Central</span></a></li>
                                    
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <h1>Food & Beverage</h1>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"></span></span></a>
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
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <h1>Sales</h1>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"></span></span></a>
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
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <h1>Maintainence</h1>
                          	<li><a href="<?php echo base_url();?>pmp" class="waves-effect"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Preventive Maintenance <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>pmp/checklist_report"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">PM Report</span></a></li>
                                    <li><a href="<?php echo base_url();?>pmp/checklistPerDay"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">PM Per Day/Room</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"></span></span></a>
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
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"></span></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url();?>reservations"><i class="fa fa-circle-o text-warning"></i> <span class="hide-menu">Future Reservations</span></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>logbook" class="waves-effect"><i class="fa fa-clipboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Service Book </span></a></li>
                    <h1>Admin</h1>
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
                            <li><a href="<?php echo base_url();?>survey_box/surveys" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Brand Survey Box <span class="label label-rouded label-danger pull-right"></span></span></a>
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
                            <li><a href="<?php echo base_url();?>reservations" class="waves-effect"><i class="mdi mdi-content-copy fa-fw" data-icon="v"></i> <span class="hide-menu">Reservations <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"></span></span></a>
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
                   
                    <li class="devider"></li>
                    <li><a href="<?php echo base_url();?>support" class="waves-effect"><i class="mdi fa-user fa-fw" data-icon="v"></i> <span class="hide-menu">Tech Support<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>support/add_new_case"><i class=" fa-fw">-</i><span class="hide-menu">New Support Case</span></a></li>
                            	<li> <a href="<?php echo base_url();?>support/manage_cases"><i class=" fa-fw">-</i><span class="hide-menu">Support Cases</span></a></li>
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <!--<li><img class="img-responsive center-block" src="<?php echo base_url();?>assets/images/kayak_group.png" title="Kayak Group" width="150" style="margin-top:20px;" /></li>-->
                </ul>
            </div>
            <footer class="footer text-center"><?php echo date("Y");?> &reg; HOPS247 - All Rights Reserved</footer>
        </div>
    </section>
    <!-- jQuery -->
    
</body>
</html>
