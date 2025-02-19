<style>
.form-group, .form-horizontal .form-group {
    margin-bottom: 10px;
}
</style> 
<div class="container-fluid">
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">New Service Ticket</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">New Service Ticket Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> New Service Ticket</div>
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
                        <form action="<?php echo base_url();?>ticket/add_ticket_info" id="createTicket" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row">
                                	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <h3 class="box-title m-b-0">SPECIAL PROJECT</h3>
                                        <div class="radio radio-success">
                                            <input type="radio" name="special_project" id="special_project_yes" value="yes">
                                            <label for="special_project"> Yes </label>
                                        </div>
                                        <div class="radio radio-success">
                                            <input type="radio" name="special_project" id="special_project_no" value="no" checked="">
                                            <label for="special_project"> No </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="ser_sec">
                                        <h3 class="box-title m-b-0">SERVICE RECOVERY</h3>
                                        <div class="radio radio-success">
                                            <input type="radio" name="servicerecovery" id="servicerecoveryyes" value="yes">
                                            <label for="servicerecovery"> Yes </label>
                                        </div>
                                        <div class="radio radio-success">
                                            <input type="radio" name="servicerecovery" id="servicerecoveryno" value="no" checked="">
                                            <label for="servicerecovery"> No </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="hus_gst">
                                        <h3 class="box-title m-b-0">IN HOUSE GUEST</h3>
                                        <div class="radio radio-success">
                                            <input type="radio" name="houseguest" id="houseguestyes" value="yes">
                                            <label for="servicerecovery"> Yes </label>
                                        </div>
                                        <div class="radio radio-success">
                                            <input type="radio" name="houseguest" id="houseguestno" value="no">
                                            <label for="servicerecovery"> No </label>
                                        </div>
                                        <div class="radio radio-success">
                                            <input type="radio" name="houseguest" id="housegueststand" value="standard" checked="">
                                            <label for="servicerecovery"> Standard </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="sp_no">
                                    <div class="row" id="inhouseguest" style="display:none;">
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">in house guest</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Guest Name" name="guestname" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <select class="form-control guestroomnumber" name="guestroomnumber" >
                                                    <option value="">Select Room Number</option>
                                                    <?php foreach($room_info as $row){?>
                                                        <option data-roomtype="<?php echo $row->room_type;?>"><?php echo $row->room_no;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group has-errorr">
                                                <div class="input-group">
                                                <input type="text" class="form-control datetimepicker1" id="datetimepicker1" name="arrivaldate" placeholder="Arrival Date"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="Phone number" name="guestnumber" type="text"  value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Email" name="guestemail" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control inhouseguest-room" placeholder="Room Type" name="roomtype" type="text" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker2" id="datetimepicker2" name="departdate" placeholder="Departure Date"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="outhouseguest" style="display:none;">
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">Future Guest</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Guest Name" name="guestnameno" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="Phone number" name="guestnumberno" type="text"  value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Email" name="guestemailno" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <select class="form-control furtherreservation" name="furtherreservation" >
                                                    <option value="no">Does guest have future reservation?</option>
                                                    <option value="no">No</option>
                                                    <option value="yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="standardguest" style="display:block;">
                                    	<div class="col-md-2">
                                            <h3 class="box-title m-b-0">Standard Ticket</h3>
                                            <div class="form-group has-errorr">
                                                <select class="form-control guestroomnumber" name="guestroomnumber" >
                                                    <option value="0">-Room Number-</option>
                                                    <?php foreach($room_info as $row){?>
                                                        <option data-roomtype="<?php echo $row->room_type;?>"><?php echo $row->room_no;?>-<?php echo $row->room_type;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-2">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <select class="form-control" name="rooms_type">
                                                    <option value="0">-Room Types-</option>
                                                    <?php foreach($room_types as $room_type){?>
                                                    <option value="<?php echo $room_type->room_type; ?>"><?php echo $room_type->room_type; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>-->
                                        <div class="col-md-2">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <select class="form-control" name="rooms_floor">
                                                    <option value="0">-Floors-</option>
                                                    <?php foreach($room_floors as $room_floor){?>
                                                    <option value="<?php echo $room_floor->floor_num; ?>"><?php echo $room_floor->floor_num;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <select class="form-control" name="other_areas">
                                                    <option value="0">-Other Areas-</option>
                                                    <?php foreach($hotel_area as $hotel_areas){?>
                                                    <option value="<?php echo $hotel_areas->area_type;?>"><?php echo $hotel_areas->area_type;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="row" id="furtherresrv">
                                        <div class="col-md-6">
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="Room Type" name="guestroomtype" type="text" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker3" id="datetimepicker3" name="departdate_future" placeholder="Departure Date"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-errorr">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker4" id="datetimepicker4" name="arrivaldate_future" placeholder="Arrival Date"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                            <h3 class="box-title m-b-0">SERVICE TICKET ASSIGNED TO:</h3>
                                            <div class="form-group">
                                                <div class="col-sm-offset-1 col-sm-12">
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" name="taskassignto[]" class="frontdesk" value="frontdesk">
                                                        <label for="checkbox33">FRONT DESK</label>
                                                    </div>
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" name="taskassignto[]" class="housekeeping" value="housekeeping">
                                                        <label for="checkbox33">HOUSEKEEPING</label>
                                                    </div>
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" name="taskassignto[]" class="food" value="food">
                                                        <label for="checkbox33">FOOD & BEVERAGE</label>
                                                    </div>
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" name="taskassignto[]" class="sales" value="sales">
                                                        <label for="checkbox33">SALES</label>
                                                    </div>
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" name="taskassignto[]" class="maint" value="maint">
                                                        <label for="checkbox33">MAINTENANCE</label>
                                                    </div>
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" name="taskassignto[]" class="manageronduty" value="manageronduty">
                                                        <label for="checkbox33">MANAGER ON DUTY</label>
                                                    </div>
                                                </div>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="row" id="frontdesk" style="display: none;">
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                            <h3 class="box-title m-b-0">Front Desk</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Guest Request Or Notes:" name="frontdesknotes" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="housekeeping" style="display: none;">
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                            <h3 class="box-title m-b-0">HOUSE KEEPING</h3>
                                            <div class="form-group has-errorr">
                                                <select class="form-control" name="housekeepingservice">
                                                    <option>Room Not Cleaned</option>
                                                    <option>Needs Linen</option>
                                                    <option>Needs Terry</option>
                                                    <option>Needs Coffee</option>
                                                    <option>Needs Shampo,Soap</option>
                                                    <option>Needs Baby Crib</option>
                                                    <option>Needs Rollaway</option>
                                                    <option>Room PM</option>
                                                    <option>Deep CLean</option>
                                                    <option>Carpet Cleaning</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="NOTES" name="housekeepingnotes" type="text" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="foods" style="display: none;">
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                            <h3 class="box-title m-b-0">FOOD AND BEVERAGE</h3>
                                            <div class="radio radio-success">
                                                <input type="radio" name="foodsservice" id="foodsserviceyes" value="breakfast bar" checked="">
                                                <label for="foodsserviceyes"> BREAKFAST BAR </label>
                                            </div>
                                            <div class="radio radio-success">
                                                <input type="radio" name="foodsservice" id="meetingroom" value="resturants or meeting room">
                                                <label for="servicerecovery"> RESTAURANTS OR MEETING ROOM </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="Name of group if applicable" name="nameofgroup" type="text" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="Guest Request Or Notes:" name="foodguestnotes" type="text" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="sales" style="display:none;">
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">SALES</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Guest Name" name="guestname" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="COMPANY" name="salecompany" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="PRIMERY PHONE" name="salesphone" type="text"  value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="SECONDARY PHONE" name="salesphone2" type="text"  value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <select class="form-control" name="calltime">
                                                    <option value="">BEST TIME FOR CALL</option>
                                                    <option value="morning">Morning</option>
                                                    <option value="afternoon">Afternoon</option>
                                                    <option value="evening">Evening</option>
                                                </select>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" name="guestroomneeded" class="guestroomneeded" value="yes">
                                                <label for="checkbox33">GUEST ROOMS NEEDED</label>
                                            </div>
                                            <!--<div class="checkbox checkbox-success">
                                                <input type="checkbox" name="nightsneeded" class="nightsneeded" value="yes">
                                                <label for="checkbox33">NIGHTS NEEDED</label>
                                            </div>-->
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" name="meetingroomneeded" class="meetingroomneeded" value="yes">
                                                <label for="checkbox33">MEETING ROOMS NEEDED</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" name="foodneeded" class="foodneeded" value="yes">
                                                <label for="checkbox33">FOOD AND BEVERAGE NEEDED</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" name="returncust" class="returncust" value="yes">
                                                <label for="checkbox33">RETURN GUEST</label>
                                            </div>
                                            <div class="form-group has-errorr">
                                                <h3 class="box-title m-b-0">URGENT REQUEST</h3>
                                                <div class="radio radio-success">
                                                    <input type="radio" name="urgentrequest" id="urgentrequestnyes" value="yes" checked="">
                                                    <label for="servicerecovery"> Yes </label>
                                                </div>
                                                <div class="radio radio-success">
                                                    <input type="radio" name="urgentrequest" id="urgentrequestnno" value="no">
                                                    <label for="servicerecovery"> No </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="EMAIL" name="salemail" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="WHAT BRINGS THEM TO OUR HOTEL" name="bringshotel" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker5" id="datetimepicker5" name="guestarivaldate" placeholder="ARRIVAL DATE"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                            </div>
                                            <div class="form-group has-errorr" id="nightdeptdate" style="display:none;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker6" id="datetimepicker6" name="guestdepartdate" placeholder="DEPARTURE DATE"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                            </div>
                                            <div class="form-group has-errorr" id="gstrooms" style="display:none">
                                                <input type="text" class="form-control" placeholder="NUMBER OF GUEST ROOMS" name="gstrooms" value="">
                                            </div>
                                            <div class="form-group has-errorr" id="peoples" style="display:none">
                                                <input type="text" class="form-control" placeholder="NUMBER OF PEOPLE FOR MEETING" name="peoples" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="GUEST BUDGET $$" name="cusbudget" value="">
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="NOTES" name="salenotes" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="maint" style="display:none;">
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">MAINTENENCE</h3>
                                            <div class="form-group has-errorr">
                                        		<input type="text" id="custom_area" name="custom_area" class="form-control" placeholder="Enter area type" value="" style="display:none;">
                                                <select class="form-control" name="maintenenceservices" id="area_type_agenda">
                                                    <option value="">Select Maintinance Areas</option>
                                                    <option value="custom">Custom Areas</option>
                                                    <option value="Automatic Doors">Automatic Doors</option>
                                                    <option value="Boiler Room">Boiler Room</option>
                                                    <option value="Electrical">Electrical</option>
                                                    <option value="Electrical Room">Electrical Room</option>
                                                    <option value="Elevator">Elevator</option>
                                                    <option value="Exterior">Exterior</option>
                                                    <option value="Fire Panel">Fire Panel</option>
                                                    <option value="Fitness Center">Fitness Center</option>
                                                    <option value="Guest Safety">Guest Safety</option>
                                                    <option value="HVAC">HVAC</option>
                                                    <option value="Ice Machine">Ice Machine</option>
                                                    <option value="Internet">Internet</option>
                                                    <option value="Kitchen">Kitchen</option>
                                                    <option value="Lighting">Lighting</option>
                                                    <option value="Locks">Locks</option>
                                                    <option value="Meeting Room">Meeting Room</option>
                                                    <option value="Office">Office</option>
                                                    <option value="Public Area">Public Area</option>
                                                    <option value="Public Restroom">Public Restroom</option>
                                                    <option value="Plumbing">Plumbing</option>
                                                    <option value="Ptac">Ptac</option>
                                                    <option value="Phone">Phone</option>
                                                    <option value="Swimming Pool">Swimming Pool</option>
                                                    <option value="Standard">Standard</option>
                                                    <option value="Tv">Tv</option>
                                                    <option value="Wall/Cleaning Damange">Wall/Cleaning Damange</option>
                                                </select>
                                        		<small id="switch_back_drp" style="display:none;">Switch back</small>
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="NOTES" name="mainnotes" type="text" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Needs other (explain)" name="maintexplain" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="manageronduty" style="display:none;">
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">MANAGER ON DUTY</h3>
                                            <div class="form-group has-errorr">
                                                <select class="form-control" name="managerdutyconcern" >
                                                    <option value="guest concern">Guest concern</option>
                                                    <option value="guest safety">Guest safety</option>
                                                    <option value="guest request">Guest request</option>
                                                    <option value="billing">Billing</option>
                                                </select>
                                            </div>
                                            <div class="form-group has-errorr">
                                                <input class="form-control" placeholder="NOTES" name="mainagernotes" type="text" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="box-title m-b-0">&nbsp;</h3>
                                            <div class="form-group has-errorr">
                                                <input type="text" class="form-control" placeholder="Needs other (explain)" name="managerexpalin" value="">
                                            </div>
                                        </div>
                                    </div>
                                
                                	<div class="row">
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                        	<h3 class="box-title m-b-0">Choose Files:</h3>
                                        	<div class="controls col-sm-offset-1">
                                                <div class="entry input-group col-md-3 m-b-5">
                                                    <input class="btn btn-default" name="file[]" type="file">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-success btn-add" type="button" style="height: 36px;left: 0px;"><span class="glyphicon glyphicon-plus"></span></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sp_yes" style="display:none;">
                                	<div class="row">
                                    	<div class="col-md-12 col-sm-12 col-xs-12">
                                            <h3 class="box-title m-b-0">TYPE</h3>
                                        	<div class="row">
                                            	<div class="col-lg-3 col-sm-3">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" id="tkt_typ" name="tkt_typ">
                                                            <option value="">SELECT TICKET AREA</option>
                                                            <option value="rooms">ROOMS</option>
                                                            <option value="public">PUBLIC</option>
                                                            <option value="back">BACK</option>
                                                            <option value="exterior">EXTERIOR</option>
                                                            <option value="admin">ADMIN</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="tkt_typ_room" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" id="tkt_typ_room_list" name="tkt_typ_room_list">
                                                            <option value="">SELECT SPECIFIC TYPE</option>
                                                            <option value="allrooms">ALL ROOMS</option>
                                                            <option value="multirooms">BY ROOMS</option>
                                                            <option value="room_type">BY ROOM TYPE</option>
                                                            <option value="floor">BY FLOOR</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="public_list" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" name="public_list" id="public_list_1">
                                                            <option value="0">Select Public Areas</option>
                                                            <option value="lobby">Lobby</option>
                                                            <option value="hallway">Hallway</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="back_list" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" name="back_list" id="back_list_1">
                                                            <option value="0">Select Back Areas</option>
                                                            <option value="back area">Back Area</option>
                                                            <option value="kitchen">Kitchen</option>
                                                            <option value="office">Office</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="exterior_list" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" name="exterior_list" id="exterior_list_1">
                                                            <option value="0">Select Exterior</option>
                                                            <option value="exterior">Exterior</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="admin_list" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" name="admin_list" id="admin_list_1">
                                                            <option value="0">Select Admin Area</option>
                                                            <option value="admin area">Admin Area</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        		<div class="col-lg-3 col-sm-3" id="rooms_list" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="selectpicker" multiple data-style="form-control" name="rooms_list[]" id="rooms_list_1">
                                                            <option value="">Select Room Number</option>
                                                            <?php foreach($room_info as $row){?>
                                                                <option value="<?php echo $row->room_no;?>"><?php echo $row->room_no. ' ('.$row->room_type.')';?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="rooms_type" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" name="rooms_type" id="rooms_type_1">
                                                            <option value="0">Select Room Type</option>
                                                            <?php foreach($room_types as $room_type){?>
                                                            <option value="<?php echo $room_type->room_type; ?>"><?php echo $room_type->room_type; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="rooms_floors" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" name="rooms_floors" id="rooms_floors_1">
                                                            <option value="0">Select Any Floor</option>
                                                            <?php foreach($room_floors as $room_floor){?>
                                                            <option value="<?php echo $room_floor->floor_num; ?>"><?php echo $room_floor->floor_num;?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-3" id="task_list" style="display:none;">
                                                    <div class="form-group has-errorr">
                                                        <select class="form-control" id="no_of_task" name="no_of_task">
                                                            <option value="">How Many Tasks</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        	</div>
                                        </div>
                                    </div>    
                                    <!--contact support & print pending tickets
                                    admin-001@gmail.com-->
                                    <div class="modal fade task_desc_1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Description/Notes</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Description:</label>
                                                        <textarea class="form-control" id="add_desc_1" name="add_desc_1" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Notes:</label>
                                                        <textarea class="form-control" id="add_notes_1" name="add_notes_1" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Attachment:</label>
                                                        <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                            <input class="upload" name="file_1" accept="image/*;capture=camera" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade task_desc_2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Description/Notes</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Description:</label>
                                                        <textarea class="form-control" id="add_desc_2" name="add_desc_2" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Notes:</label>
                                                        <textarea class="form-control" id="add_notes_2" name="add_notes_2" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Attachment:</label>
                                                        <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                            <input class="upload" name="file_2" accept="image/*;capture=camera" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade task_desc_3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Description/Notes</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Description:</label>
                                                        <textarea class="form-control" id="add_desc_3" name="add_desc_3" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Notes:</label>
                                                        <textarea class="form-control" id="add_notes_3" name="add_notes_3" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Attachment:</label>
                                                        <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                            <input class="upload" name="file_3" accept="image/*;capture=camera" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade task_desc_4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Description/Notes</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Description:</label>
                                                        <textarea class="form-control" id="add_desc_4" name="add_desc_4" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Notes:</label>
                                                        <textarea class="form-control" id="add_notes_4" name="add_notes_4" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Attachment:</label>
                                                        <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                            <input class="upload" name="file_4" accept="image/*;capture=camera" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade task_desc_5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Description/Notes</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Description:</label>
                                                        <textarea class="form-control" id="add_desc_5" name="add_desc_5" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Notes:</label>
                                                        <textarea class="form-control" id="add_notes_5" name="add_notes_5" rows="5" cols="60"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Attachment:</label>
                                                        <div class="fileupload fcbtn btn btn-warning btn-outline btn-1d"><span>Upload</span>
                                                            <input class="upload" name="file_5" accept="image/*;capture=camera" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />                                    
                                    <div class="row" id="task_list_1" style="display:none;">
                                        <div class="col-lg-1 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" class="btn btn-success">Task 1</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <select class="form-control" name="dept_1" id="dept_1">
                                                    <option value="">Department</option>
                                                    <option value="2">MANAGER ON DUTY</option>
                                                    <option value="3">FRONT DESK</option>
                                                    <option value="4">HOUSEKEEPING</option>
                                                    <option value="5">FOOD & BEVERAGE</option>
                                                    <option value="6">SALES</option>
                                                    <option value="7">MAINTENANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_start_date_1" name="task_start_date_1" placeholder="Task Start Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_end_date_1" name="task_end_date_1" placeholder="Task End Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" data-toggle="modal" data-target=".task_desc_1" class="btn btn-warning waves-effect waves-light model_img img-responsive">Add Notes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="task_list_2" style="display:none;">
                                        <div class="col-lg-1 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" class="btn btn-success">Task 2</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <select class="form-control" name="dept_2" id="dept_2">
                                                    <option value="">Department</option>
                                                    <option value="2">MANAGER ON DUTY</option>
                                                    <option value="3">FRONT DESK</option>
                                                    <option value="4">HOUSEKEEPING</option>
                                                    <option value="5">FOOD & BEVERAGE</option>
                                                    <option value="6">SALES</option>
                                                    <option value="7">MAINTENANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_start_date_2" name="task_start_date_2" placeholder="Task Start Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_end_date_2" name="task_end_date_2" placeholder="Task End Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" data-toggle="modal" data-target=".task_desc_2" class="btn btn-warning waves-effect waves-light model_img img-responsive">Add Notes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="task_list_3" style="display:none;">
                                        <div class="col-lg-1 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" class="btn btn-success">Task 3</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <select class="form-control" name="dept_3" id="dept_3">
                                                    <option value="">Department</option>
                                                    <option value="2">MANAGER ON DUTY</option>
                                                    <option value="3">FRONT DESK</option>
                                                    <option value="4">HOUSEKEEPING</option>
                                                    <option value="5">FOOD & BEVERAGE</option>
                                                    <option value="6">SALES</option>
                                                    <option value="7">MAINTENANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_start_date_3" name="task_start_date_3" placeholder="Task Start Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_end_date_3" name="task_end_date_3" placeholder="Task End Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" data-toggle="modal" data-target=".task_desc_3" class="btn btn-warning waves-effect waves-light model_img img-responsive">Add Notes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="task_list_4" style="display:none;">
                                        <div class="col-lg-1 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" class="btn btn-success">Task 4</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <select class="form-control" name="dept_4" id="dept_4">
                                                    <option value="">Department</option>
                                                    <option value="2">MANAGER ON DUTY</option>
                                                    <option value="3">FRONT DESK</option>
                                                    <option value="4">HOUSEKEEPING</option>
                                                    <option value="5">FOOD & BEVERAGE</option>
                                                    <option value="6">SALES</option>
                                                    <option value="7">MAINTENANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_start_date_4" name="task_start_date_4" placeholder="Task Start Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_end_date_4" name="task_end_date_4" placeholder="Task End Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" data-toggle="modal" data-target=".task_desc_4" class="btn btn-warning waves-effect waves-light model_img img-responsive">Add Notes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="task_list_5" style="display:none;">
                                        <div class="col-lg-1 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" class="btn btn-success">Task 5</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <select class="form-control" name="dept_5" id="dept_5">
                                                    <option value="">Department</option>
                                                    <option value="2">MANAGER ON DUTY</option>
                                                    <option value="3">FRONT DESK</option>
                                                    <option value="4">HOUSEKEEPING</option>
                                                    <option value="5">FOOD & BEVERAGE</option>
                                                    <option value="6">SALES</option>
                                                    <option value="7">MAINTENANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_start_date_5" name="task_start_date_5" placeholder="Task Start Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <div class="input-group">
                                                	<input type="text" class="form-control" id="task_end_date_5" name="task_end_date_5" placeholder="Task End Date"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                        	<div class="form-group has-errorr">
                                                <button type="button" data-toggle="modal" data-target=".task_desc_5" class="btn btn-warning waves-effect waves-light model_img img-responsive">Add Notes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions m-t-10">
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

<script>
   
</script>

<style>
    .datepicker {
        z-index: 9999 !important;
        position: fixed !important;
    }
    
    .ui-datepicker {
        position: fixed !important;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
    }
</style> 
