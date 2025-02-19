<?php
	if (!extension_loaded('imagick')){
	echo 'imagick not installed';
}else{
	/*$imagick = new Imagick();
	$imagick->setResolution(200, 200);
	$imagick->readImage('https://hotelgss.com/assets/pdf/1.pdf');
	$imagick->scaleImage(800,0);
	$imagick->setImageFormat('jpg');
	//$imagick->setResolution(300, 300);
	//header('Content-Type: image/jpeg');
	$imagick->writeImages('https://hotelgss.com/assets/pdf/converted.jpg', false);*/
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PDF DocuSign</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
    .text, .checkbox {
		padding:10px;
		float:left;
		cursor:move;  
	}
	#sideBar{
		width: 200px;
		height: 750px;
		border: 5px dotted red;
		float:left;
	}
	#container {
		float:left;
		/*width: 700px;
		height:500px;
		border: 5px dotted #292929;*/        
	}
	</style>
	<script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url();?>assets/js/html2canvas.min.js"></script>
    
<script>
	$(document).ready(function() {
		var nextItemId=1;
		$('.text, .checkbox').draggable({
			helper: "clone",
			drop: function(event, ui) {
                $(this).append($(ui.helper).clone(true).attr('id','item'+nextItemId++));
                $("#container .text").addClass("item");
                $(".item").removeClass("ui-draggable text");
                $(".item").draggable({
                    containment: 'parent',
                    grid: [5,5]
                });
                //$(".item").resizable();
                $("#item"+nextItemId).resizable();
                
        }
		}).on('dragstart', function (e, ui) {
			$(ui.helper).css('z-index','999999');
		}).on('dragstop', function (e, ui) {
			$("#container").append($(ui.helper).clone().draggable());
		});
		
		$('.text input').resizable();
   });
	
	var version = detectIE();
	function takeScreenShot(){
		$("#container input").css("border", "0");
		html2canvas(document.querySelector('#container')).then(function(canvas) {
			if (version === false) {
				console.log(canvas);
				saveAs(canvas.toDataURL(), 'file-name.png');
			}else{
				document.getElementById('target').appendChild(canvas);
			}
		});
	}
	function saveAs(uri, filename) {
		var link = document.createElement('a');
		if (typeof link.download === 'string') {
			link.href = uri;
			link.download = filename;
			//Firefox requires the link to be in the body
			document.body.appendChild(link);
			link.click();
			document.body.removeChild(link);
		} else {
			window.open(uri);
		}
	}
	function detectIE() {
	  var ua 	= window.navigator.userAgent;
	  var msie 	= ua.indexOf('MSIE ');
	  if (msie > 0) {
		// IE 10 or older => return version number
		return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
	  }
	  var trident = ua.indexOf('Trident/');
	  if (trident > 0) {
		var rv = ua.indexOf('rv:');
		return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
	  }
	  var edge = ua.indexOf('Edge/');
	  if (edge > 0) {
		return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
	  }
	  return false;
	}
</script>
</head>
<body>
<div id="sideBar">
    <div class="text">
        <input type="text" value="" placeholder="Enter your text here...">
    </div>
    <div class="checkbox">
        <input type="checkbox" checked="checked"/>
    </div>
</div>
<div id="container"><img src="<?php echo base_url();?>assets/pdf/converted-0.jpg" width="800"/></div>
<button onClick="takeScreenShot()">Save PDF</button>
<div id="target"></div>
</body>
</html>