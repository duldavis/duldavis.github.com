<?php
/*
Class emailSender
v1.2

by kareemgan@gmail.com
9.3.2014
*/

class emailSender {
	private $language = 'EN';
	private $user_messages = array(
		'CZ' => array(
			'no_sender' 		=> 'neznámý odesílatel',
			'no_subject' 		=> 'předmět neuveden',
			'no_message' 		=> 'žádná zpráva',
			'bad_recepient' 	=> 'Email příjemce není správně.',
			'bad_sender' 		=> 'Váš email není správně.',
			'subject_required' 	=> 'Předmět musí být vyplněn.',
			'message_required' 	=> 'Zpráva musí být vyplněna.',
			'name_required'		=> 'Jméno musí být vyplněno.',
			'mail_failed' 		=> 'Zprávu se nepodařilo odeslat kvůli chybě na serveru, zkuste to prosím později.',
			'mail_succeed' 		=> 'Zpráva byla úspěšně odeslána.',
		),
		'EN' => array(
			'no_sender' 		=> 'unknown sender',
			'no_subject' 		=> 'no subject',
			'no_message' 		=> 'no message',
			'bad_recepient'		=> 'Recepient email is not valid.',
			'bad_sender' 		=> 'Your email is not valid.',
			'subject_required' 	=> 'Subject must be set.',
			'message_required' 	=> 'Message must be set.',
			'name_required'		=> 'Name must be set.',
			'mail_failed' 		=> 'Problem on server side, please try again later.',
			'mail_succeed' 		=> 'Message successfully sent.',
		),
	);
	
	private $control_messages = array(
		'CZ' => array(
			'from' 		=> 'Od',
			'subject'	=> 'Předmět',
			'message' 	=> 'Zpráva',
		),
		'EN' => array(
			'from' 		=> 'From',
			'subject' 	=> 'Subject',
			'message' 	=> 'Message',
		),
	);
	
	/*
	Send email
	@param $recepient - email to
	@param $sender - email from
	@param $subject - email subject
	@param $message - email message
	@param $name - from name
	@param $sender_required - true/false if email from is required
	@param $subject_required - true/false if email subject is required
	@param $message_required - true/false if email message is required
	@param $name_required - true/false if from name is required
	@return - error messages or nothing on success
	*/
	public function sendEmail($recepient, $sender, $subject, $message, $name, $sender_required = true, $subject_required = true, $message_required = true, $name_required = false) {
		if(!$this->validateEmail($recepient))
			return $this->user_messages[$this->language]['bad_recepient'];
		if($sender_required == true && !$this->validateEmail($sender))
			return $this->user_messages[$this->language]['bad_sender'];
		if($subject_required == true && !$subject)
			return $this->user_messages[$this->language]['subject_required'];
		if($message_required == true && !$message)
			return $this->user_messages[$this->language]['message_required'];
		if($name_required == true && !$name)
			return $this->user_messages[$this->language]['name_required'];
		
		if(!$sender)
			$sender = $this->user_messages[$this->language]['no_sender'];
		if(!$subject)
			$subject = $this->user_messages[$this->language]['no_subject'];
		if(!$message)
			$message = $this->user_messages[$this->language]['no_message'];
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: " . $name . "<" . $sender . ">\r\n";
		$message = '<html>
		<head>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		</head>
		<body>
			<p><strong>' . $this->control_messages[$this->language]['from'] . ':</strong> ' . $sender . '</p>
			<p><strong>' . $this->control_messages[$this->language]['subject'] . ':</strong> ' . $subject . '</p>
			<p><strong>' . $this->control_messages[$this->language]['message'] . ':</strong> ' . $message . '</p>
		</body>
		</html>';
		
		if(!@mail($recepient, $subject, $message, $headers))
			return $this->user_messages[$this->language]['mail_failed'];
	}
	
	/*
	Validates email, this is basic validation, do not depend on this function
	@param $email_address - email to validate
	@return - true/false if email valid
	*/
	public function validateEmail($email_address) {
		if(preg_match('#^.+@.+\..{2,4}$#', $email_address))
			return true;
		return false;
	}
}
?>
