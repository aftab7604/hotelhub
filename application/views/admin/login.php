<!DOCTYPE html>  
<html lang="en">
<head>
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
    <?php if(!isset($site_name)) : ?><?php echo ' | HOPS 247'; endif; ?> 
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
<style>
	.modal-dialog {
		  max-width: 800px;
		  margin: 160px auto;
	  }
	.modal-body {
	  position:relative;
	  padding:0px;
	}
	.close {
	  position:absolute;
	  right:-30px;
	  top:0;
	  z-index:999;
	  font-size:2rem;
	  font-weight: normal;
	  color:#fff;
	  opacity:1;
	}
	.form-material .form-control, .form-material .form-control.focus, .form-material .form-control:focus {
    	background-image: linear-gradient(#00529B,#00529B),linear-gradient(rgba(120,130,140,.13),rgba(120,130,140,.13));
	}
</style>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div> <!-- Button trigger modal -->

<!--<button type="button" class="btn btn-primary hidden video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/1hvzlLGXEqo" data-target="#myModal"></button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
        <!-- 16:9 aspect ratio -->
        <!--<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>-->
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar" style="opacity: 0.8;">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" action="<?php echo base_url();?>login/auth_login" method="post" enctype="multipart/form-data">
        <!--<a href="<?php echo base_url();?>" class="text-center db"><img src="<?php echo base_url();?>assets/plugins/images/admin-logo-dark.png" alt="Home" /><br/><img src="<?php echo base_url();?>assets/plugins/images/admin-text-dark.png" alt="Home" /></a> -->
        <a href="<?php echo base_url();?>" class="text-center db"><img src="<?php echo base_url();?>assets/images/logo_login_high.png" alt="www.hotelgss.com" width="300" /></a>
        
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
         ?>
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="email" required placeholder="Email" value="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="pass" required placeholder="Password" value="">
          </div>
        </div>
        <div class="form-group">
            <div class="col-xs-6">
                <div class="radio radio-success">
                    <input type="radio" name="lang" value="en" checked="">
                    <label for="lang">English</label>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="radio radio-success">
                    <input type="radio" name="lang" value="es">
                    <label for="lang">Spanish</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> Remember me </label>
            </div>
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" style="background: #00529B;" type="submit">Login</button>
          </div>
        </div>
        <div class="row hidden">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
          </div>
        </div>
        <div class="form-group m-b-0 hidden">
          <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="<?php echo base_url();?>register" class="text-primary m-l-5"><b>Sign Up</b></a></p>
          </div>
        </div>
      </form>
      <form class="form-horizontal" id="recoverform" action="<?php echo base_url();?>login/fwd_pass" method="post" enctype="multipart/form-data">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
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
<script>
	$(document).ready(function() {
		var $videoSrc;
		$videoSrc = $('.video-btn').data( "src" );
		$('.video-btn').click();
		
		/*$('.video-btn').click(function() {
			$videoSrc = $(this).data( "src" );
		});*/
		console.log($videoSrc);
		// when the modal is opened autoplay it  
		$('#myModal').on('shown.bs.modal', function (e) {
			// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
			$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
		})
		$('#myModal').on('hide.bs.modal', function (e) {
			$("#video").attr('src',$videoSrc); 
		})
	});
</script>
</body>
</html>
