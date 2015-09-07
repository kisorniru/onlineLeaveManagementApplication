<?php include("../model/LoginModel.php");?>
<?php
	
		require '../vendor/autoload.php';
		// Create the Transport
		$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
			->setUsername('mailserverapplicationtest@gmail.com')
			->setPassword('MAILserver');
		
		// Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance($transport);

		// Send the Mail
		$_SESSION['isLogin'] = 0;
	  
		$objLoginModel = new Login();
		$objLoginModel->getPasswordByEmail($_POST['officeUserEmail']);
	  
		if( $_SESSION['isLogin'] )
		{
			$message = Swift_Message::newInstance('Your Password')
			->setFrom(array('mailserverapplicationtest@gmail.com' => 'EKATTOR Media Ltd.'))
			->setTo(array($_POST['officeUserEmail']=>"Your Password"))
			->setBody('Here is the password : '.$_SESSION['officeUserPass']);
			$result = $mailer->send($message);
			if($result)
			{
				$_SESSION['msg'] = 1;
				header("Location:../view/recoverPassword.php");
			}
			else
			{
				$_SESSION['msg'] = 0;
				header("Location:../view/recoverPassword.php");
			}
		}
		else
		{
			header("Location:../view/sorry.php");
			//echo $_POST['officeUserEmail']."<br/> We can't send your mail address in your mail address, please try again later <br/>";
			//var_dump($_SESSION);
		}
		
?>