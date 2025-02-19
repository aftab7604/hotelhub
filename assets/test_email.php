<?php
date_default_timezone_set('America/New_York');

try{
	$headers	 = "MIME-Version: 1.0" . "\r\n";
	$headers	.= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers	.= 'From: Facebook <kristen.brooks@facebook.com>' . "\r\n";
	//$headers	.= 'From: Facebook <sabahanif4@gmail.com>' . "\r\n";
	
	$email_data['subject']	= "Lunch and dinner Catering";
	$email_data['to']		= 'mluqman2008@gmail.com'; //sanam5902@yahoo.com
	$email_data['message']	= "Hello, <br> <p>I was told your store locations could handle 150 person sandwich trays weekly from Feb to July. We need to get these trays delivered to our Facebook location near Social Circle. Please advise if this is possible. I appreciate you assistance and look forward to hearing from you. </p>
	<br><br>
Kristen Brooks<br>
Account Admin <br>
Facebook.";
	
	if(mail($email_data['to'], $email_data['subject'], $email_data['message'], $headers)){
		echo 'true<br>';
	}else{echo 'false<br>';}
}
catch(Exception $e) {
	echo $e->getMessage();
}
?>