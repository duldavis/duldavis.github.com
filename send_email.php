<?php
/*
 * Send email to your email box
 * Change "kareemgan@gmail.com" to your email address and "Message from Precise" to email subject. You may also want to change which fields are required - look for "$is_sender_required"...
**/

include_once('class.emailSender.php');

$recepient = "duldavis@gmail.com";
$subject = "Message from SpamSite";
$is_sender_required = true;
$is_subject_required = true;
$is_message_required = true;
$is_name_required = true;

$ajax = false;
if(@$_POST['ajax'] == 'true')
	$ajax = true;
$sender = @$_POST['email'];
$name = @$_POST['name'];
$message = @$_POST['message'];

if(!$ajax):
	?>
	<!doctype html>
	<html>
	<head>
	<meta charset="utf-8">
	<title>Contact</title>
	</head>
	
	<body>
	<?php
endif;

$mail = new emailSender();
echo $mail->sendEmail($recepient, $sender, $subject, $message, $name, $is_sender_required, $is_subject_required, $is_message_required, $is_name_required);

if(!$ajax):
	?>
	</body>
	</html>
	<?php
endif;



/*Example use of PHPMailer
include_once('PHPMailer_5.2.4/class.phpmailer.php');
$mail = new PHPMailer();
	
$mail->CharSet = 'utf-8';
$mail->SetFrom($sender, $name);
$mail->AddAddress($recepient, "Recepients Name");
$mail->Subject = $subject;
$mail->MsgHTML('From: '.$name.' '.$sender.'<br>'
		.$_POST['message']);
	
if(!$mail->Send()) {
	echo $mail->ErrorInfo;
} else if(!$ajax) {
	echo "Message sent.";
}
return;
*/
?>
