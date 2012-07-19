<?php
require("class.sendmail.php");
$mail = new SendMail;
	
	$mail->addEmail("Poop-Face","poop@face.com");
	$mail->addEmail("Face-2","face-2@poop.com");
	
	$mail->subject("Subject Text!");
	$mail->body("Body text......");
	
	$mail->fromName("Blah Jones");
	$mail->fromEmail("slice@ljkasd.com");
	
	$mail->Mailer = 'mail'; //options: smtp, mail, sendmail
	
	$result = $mail->send();
	
	if (!$result){
		if(!empty($mail->errors)) {
			$mail->displayErrors($mail->errors,'li');
		}
		exit();
	}

echo "Email sent";
?>