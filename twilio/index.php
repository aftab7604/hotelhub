<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$sid    = "AC445e4095924f46980dd9e1fc7294f2ce";
$token  = "019afe4047ee82ca1c2b8e42ded4e1b9";
$twilio = new Client($sid, $token);

// Specify the phone numbers in [E.164 format](https://www.twilio.com/docs/glossary/what-e164) (e.g., +16175551212)
// This parameter determines the destination phone number for your SMS message. Format this number with a '+' and a country code
$phoneNumber = "+19105816863";
//$phoneNumber = "+18777804236";
//$phoneNumber = "+923127136060";

// This must be a Twilio phone number that you own, formatted with a '+' and country code
$twilioPurchasedNumber = "+18336587838";

// Send a text message
/*$message = $twilio->messages->create($phoneNumber, // to
	array(
		"from" => $twilioPurchasedNumber,
		"body" => 'Hello BRANDON, CODE is: Alpha009'
	)
);

print("Message sent successfully with sid = " . $message->sid ."\n\n<br>");*/
//echo '<pre>';print_r($message);exit;

// Print the last 10 messages
$messageList = $twilio->messages->read([],10);
//echo '<pre>';print_r($messageList);exit;
echo '<pre>';
foreach ($messageList as $msg) {
    print("ID:: ". $msg->sid . " | " . "From:: " . $msg->from . " | " . "TO:: " . $msg->to . " | "  .  " Status:: " . $msg->status . " | " . " Body:: ". $msg->body ."\n");
}