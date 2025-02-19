<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon.png">
    <title>Thank You | Hotel GSS</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- animation CSS -->
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url();?>assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> 
</head>
<body>
	<!-- Preloader -->
    <section id="wrapper" class="error-pagee">
        <div class="error-boxx">
            <div class="error-body text-center">
                <!--<h1 class="text-success"><i class="fa fa-thumbs-up fa-2x"></i></h1>-->
                <p class="text-muted m-t-0 m-b-10"><img src="/assets/images/<?php echo $settings_info[0]->email_logo;?>" alt="<?php echo $hotel_name;?>" width="300" height="120" /></p>                
                <h2 class="text-muted"><?php echo $hotel_name;?></h2>                
                <?php if($final == '1'){?>
                <p class="text-muted m-t-0 m-b-10"><?php echo $message;?></p>
                <?php }else {?>
                <form class="form-horizontal" action="<?php echo base_url();?>guest_survey/mass_survey_adtnl_answer" method="post" enctype="multipart/form-data">
                <input type="hidden" name="m_id" value="<?php echo $m_id; ?>" />
                <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>" />
                <p><p style="margin-bottom: 0px;"><b>GSS - Overall Satisfaction</b></p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="10"> 10
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="9"> 9
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="8"> 8
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="7"> 7
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="6"> 6
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="5"> 5
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="4"> 4
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="3"> 3
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="2"> 2
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_1" type="radio" value="1"> 1
                        </label>
                    </div>
                </p>
                <p><p style="margin-bottom: 0px;"><b>Check-In Experience</b></p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="10"> 10
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="9"> 9
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="8"> 8
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="7"> 7
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="6"> 6
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="5"> 5
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="4"> 4
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="3"> 3
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="2"> 2
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_2" type="radio" value="1"> 1
                        </label>
                    </div>
                </p>
                <p><p style="margin-bottom: 0px;"><b>Property Overall</b></p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="10"> 10
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="9"> 9
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="8"> 8
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="7"> 7
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="6"> 6
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="5"> 5
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="4"> 4
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="3"> 3
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="2"> 2
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_3" type="radio" value="1"> 1
                        </label>
                    </div>
                </p>
				<p><p style="margin-bottom: 0px;"><b>Maintenance and Upkeep</b></p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="10"> 10
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="9"> 9
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="8"> 8
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="7"> 7
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="6"> 6
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="5"> 5
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="4"> 4
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="3"> 3
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="2"> 2
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_4" type="radio" value="1"> 1
                        </label>
                    </div>
                </p>
                <p><p style="margin-bottom: 0px;"><b>Staff Service</b></p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="10"> 10
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="9"> 9
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="8"> 8
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="7"> 7
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="6"> 6
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="5"> 5
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="4"> 4
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="3"> 3
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="2"> 2
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_5" type="radio" value="1"> 1
                        </label>
                    </div>
                </p>
                <p><p style="margin-bottom: 0px;"><b>Room Overall</b></p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="10"> 10
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="9"> 9
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="8"> 8
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="7"> 7
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="6"> 6
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="5"> 5
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="4"> 4
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="3"> 3
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="2"> 2
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_6" type="radio" value="1"> 1
                        </label>
                    </div>
                </p>
                <p><p style="margin-bottom: 0px;"><b>Room Cleanliness</b></p>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="10"> 10
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="9"> 9
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="8"> 8
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="7"> 7
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="6"> 6
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="5"> 5
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="4"> 4
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="3"> 3
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="2"> 2
                        </label>
                        <label class="btn btn-default form-check-label">
                            <input name="q_7" type="radio" value="1"> 1
                        </label>
                    </div>
                </p>
                <p><p><b>Comments:</b></p>
                    <div class="btn-group" data-toggle="buttons">
                    	<textarea name="feedback" rows="7" cols="70" placeholder="Guest Feedback"></textarea>
                    </div>
                </p>
                <p>
                    <div class="btn-group" style="margin-bottom: 60px;">
                    	<button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> Send</button>
                    </div>
                </p>
               </form>
               <?php } ?>
            </div>
            <footer class="footer text-center" style="left: 0px;"><?php echo date("Y");?> &reg; Hotel GSS - All Rights Reserved</footer>
        </div>
    </section>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <style>
    .error-body {
        padding-top: 0px !important;
    }
    .error-box {
        top: 0% !important;
    }
    </style>
</body>
</html>
