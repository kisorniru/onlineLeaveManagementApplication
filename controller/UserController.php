<?php include("../model/UserModel.php")?>
<?php

	if (isset($_POST['btnUserInfoUpdate']))
	{
		$officeUserCode = $_SESSION['officeUserName'];
		$userPersonalPhoneNumber = $_POST["userPersonalPhoneNumber"];
		$userPresentAddress = $_POST["userPresentAddress"];
		$userPassword = $_POST["userPassword"];
		
		//echo "<br/> User code : ".$officeUserCode."<br/> Personal Number : ".$userPersonalPhoneNumber."<br/> Present Address : ".$userPresentAddress."<br/> Password : ".$userPassword;
		
		$objUser = new User();
		$objUser->dbUserInfoUpdate($officeUserCode,$userPersonalPhoneNumber,$userPresentAddress,$userPassword);
		
		if($objUser->CreatedOrNot)
		{
			$_SESSION['UserInfoUpdated'] = 1;
			//echo $objUser->CreatedOrNot;
			header("Location:../view/UserProfile.php");
		}
		else
		{
			$_SESSION['UserInfoUpdated'] = 0;
			//echo $objUser->CreatedOrNot;
			header("Location:../view/UserProfile.php");
		}
	}
?>