<?php
/*We need to do few things from the gmail side while connecting
1. Login to your gmail account, Under Settings -> Forwarding and POP/IMAP -> Enable Imap.
2. Go to https://www.google.com/settings/security/lesssecureapps and select "Turn On"
3. Go to: https://accounts.google.com/b/0/DisplayUnlockCaptcha and enable access.
https://davidwalsh.name/gmail-php-imap*/

/* connect to gmail */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'springhill.suites.hotelgss@gmail.com';
$password = 'Muuu@6060';

/* try to connect */
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox,'UNSEEN');//ALL,UNSEEN 

/* if emails are returned, cycle through each... */
if($emails) {
	$output = '';
	/* put the newest emails on top */
	rsort($emails);
	foreach($emails as $email_number) {
		/* get information specific to this email */
		$overview = imap_fetch_overview($inbox, $email_number, 0);
		$message  = imap_fetchbody($inbox, $email_number, 2);
		
		$header = imap_headerinfo($inbox, $email_number);
		$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
		$overview[0]->from_email = $fromaddr;
		/*echo '<pre>';
		print_r($fromaddr);
		print_r($overview);*/
		/* output the email header information */
		$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
		$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
		$output.= '<span class="from">'.$overview[0]->from.'</span>';
		$output.= '<span class="from">'.$overview[0]->from_email.'</span>';
		$output.= '<span class="date">on '.$overview[0]->date.'</span>';
		$output.= '</div>';
		
		/* output the email body */
		$output.= '<div class="body">'.$message.'</div>';
	}
	
	echo $output;
} 

/* close the connection */
imap_close($inbox);
?>
<style>
div.toggler				{ border:1px solid #ccc; background:url(gmail2.jpg) 10px 12px #eee no-repeat; cursor:pointer; padding:10px 32px; }
div.toggler .subject	{ font-weight:bold; }
div.read					{ color:#666; }
div.toggler .from, div.toggler .date { font-style:italic; font-size:11px; }
div.body					{ padding:10px 20px; }
</style>

<script>
window.addEvent('domready',function() {
	var togglers = $$('div.toggler');
	if(togglers.length) var gmail = new Fx.Accordion(togglers,$$('div.body'));
	togglers.addEvent('click',function() { this.addClass('read').removeClass('unread'); });
	togglers[0].fireEvent('click'); //first one starts out read
});
</script>
