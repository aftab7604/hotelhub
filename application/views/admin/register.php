<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/plugins/images/favicon.png">
    <title>
    
    <?php if(isset($page_title)) : ?><?php echo $page_title ?>  <?php endif; ?> 	
	<?php if(!isset($page_title)) : ?><?php echo 'Register'; ?>  <?php endif; ?>     
	<?php if(isset($site_name)) : ?><?php echo $site_name; endif; ?>    
    <?php if(!isset($site_name)) : ?><?php echo ' - Extranet'; endif; ?> 
    
    </title>
    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="<?php echo base_url();?>assets/css/colors/default.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar">
    <div class="white-box">
    <?php
		   if($this->session->flashdata('flash_data') != "") {
			   echo '<div class="alert alert-success alert-dismissable">';
			   echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			   echo $this->session->flashdata('flash_data');
			   echo '</div>';
		   }
		   /*if ($this->session->flashdata('flash_data_danger') != "") {
			   echo '<div style=" margin: 10px;" class="alert alert-danger alert-dismissable">';
			   echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			   echo $this->session->flashdata('flash_data_danger');
			   echo '</div>';
		   }*/
         ?>
    
      <form class="form-horizontal form-material" id="loginform" action="<?php echo base_url();?>register/auth_register" method="post" enctype="multipart/form-data">
        <a href="<?php echo base_url();?>" class="text-center db"><img src="<?php echo base_url();?>assets/plugins/images/admin-logo-dark.png" alt="Home" /><br/><img src="<?php echo base_url();?>assets/plugins/images/admin-text-dark.png" alt="Home" /></a> 
        <h3 class="box-title m-t-40 m-b-0">Register Now</h3><small>Create your account and enjoy</small> 
        <div class="form-group m-t-20">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="name" required placeholder="Name">
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="email" required placeholder="Email">
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="pass" required placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="pass_c" required placeholder="Confirm Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary p-t-0">
              <input id="checkbox-signup" type="checkbox" name="chk_bx" value="1">
              <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
            </div>
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Already have an account? <a href="<?php echo base_url();?>login" class="text-primary m-l-5"><b>Sign In</b></a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url();?>assets/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
