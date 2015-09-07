<?php include("../model/DepartmentModel.php")?>
<?php

	if (isset($_POST['btnSubmit']))
	{
		$dptName = $_POST["dptName"];
		$userCodeWhoCreateDpt = $_SESSION['officeUserName'];
		
		$objDepartment = new Department();
		//object declaretion for using Department class. Department class is in DepartmentModel.php file
		$objDepartment->dbCreateDptQuery($dptName,$userCodeWhoCreateDpt);
		if($objDepartment->CreatedOrNot)
		{
			$_SESSION['msgForDptCreate'] = 1;
			//echo $objDepartment->CreatedOrNot;
			header("Location:../view/AddDepartment.php");
		}
		else
		{
			$_SESSION['msgForDptCreate'] = 0;
			//echo $objDepartment->CreatedOrNot;
			header("Location:../view/AddDepartment.php");
		}
	}
?>