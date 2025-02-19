<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/
	/**
	 * Mode ("sandbox" or "prod")
	 **/
	 //https://github.com/twilio/twilio-php
	 //https://arjunphp.com/how-to-use-twilio-to-send-sms-with-codeigniter/
	$config['mode']   			= 'prod';
	/**
	 * Account SID
	 **/
	//$config['account_sid']		= 'AC423f9f1f369e0eca039090fc691eac1b';
	$config['account_sid']		= 'AC445e4095924f46980dd9e1fc7294f2ce';
	/**
	 * Auth Token
	 **/
	//$config['auth_token']		= '5a232d824a9f349665fc6c95f93d5ea2';
	$config['auth_token']		= '019afe4047ee82ca1c2b8e42ded4e1b9';
	/**
	 * API Version
	 **/
	$config['api_version']		= '2010-04-01';
	/**
	 * Twilio Phone Number
	 **/
	//$config['number']			= '+18044049666';
	$config['number']			= '+18336587838';
	//$config['number']			= '+19105816863';
/* End of file twilio.php */