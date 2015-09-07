<?php include("../model/LoginModel.php")?>
<?php

	if (isset($_POST['btnSubmit']))
	{
		$officeUserCode = $_POST["officeUserCode"];
		$officeUserPass = $_POST["officeUserPass"];
		
		$objLogin = new Login();
		//object declaretion for using Login class. Login class is in LoginModel.php file
		$objLogin->dbUserQuery($officeUserCode,$officeUserPass);
		if($objLogin->officeUserIsFound)
		{
			//echo $objLogin->officeUserIsFound;
			//header("Location:../view/userDashboard.php");
			header("Location:../view/LeaveApplication.php");
		}
		else
		{
			//echo $objLogin->officeUserIsFound;
			$_SESSION["LoginError"] = 1;
			header("Location:../index.php");
		}
	}
?>