<?php
	
	require('../vendor/autoload.php');
	//require '../vendor/autoload.php';
	
	public class Mailer
	{
		
		var $transport;
		var $mailer;
		
		public initMailer()
		{
			// Create the Transport
			$this->transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
				->setUsername('ekattortvltd@gmail.com')
				->setPassword('EKATTORtv');
			
			// Create the Mailer using your created Transport
			$this->mailer = Swift_Mailer::newInstance($transport);
		}
		
		public sendMessage($mailTo,$password)
		{
			// Create a message
			$message = Swift_Message::newInstance('Recovered Password')
			->setFrom(array('ekattortvltd@gmail.com' => 'test mail service'))
			->setTo(array($mailTo =>"Forget Password"))
			->setBody('Here is Your password : '.$password);
			
			// Send the message
			$result = $this->mailer->send($message);
			if($result)
			{
				echo "<br/> Password send to <br/>".$mailTo.'Plz Chk';
			}
			else
			{
				echo "<br/> Message not send<br/>";
			}
		}
		
	}
	
?>