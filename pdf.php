<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
	if (!extension_loaded('imagick')){
	echo 'imagick not installed';
}else{
	// create Imagick object
	$imagick = new Imagick();
	// Reads image from PDF
	$imagick->setResolution(200, 200);
	$imagick->readImage('pdf/1.pdf');
	$imagick->scaleImage(800,0);
	//$imagick->flattenImages();
	
	$imagick->setImageFormat('jpg');
	//header('Content-Type: image/jpeg');
	//echo $imagick;
	// Writes an image or image sequence Example- converted-0.jpg, converted-1.jpg
	$imagick->writeImages('pdf/converted.jpg', false);
}
?>


</body>
</html>