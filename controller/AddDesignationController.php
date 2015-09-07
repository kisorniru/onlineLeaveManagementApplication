<?php include("../model/DesignationModel.php")?>
<?php

	if (isset($_POST['btnSubmit']))
	{
		$dptId = $_POST["dptName"];
		$desiName = $_POST["desiName"];
		$userCodeWhoCreateDesi = $_SESSION['officeUserName'];
		
		//echo $dptId."<br/>".$desiName."<br/>".$userCodeWhoCreateDesi;
		
		$objDesignation = new Designation();
		//object declaretion for using Designation class. Designation class is in DesignationModel.php file
		$objDesignation->dbCreateDesiQuery($dptId,$desiName,$userCodeWhoCreateDesi);
		if($objDesignation->CreatedOrNot)
		{
			$_SESSION['msgForDesiCreate'] = 1;
			//echo $objDesignation->CreatedOrNot;
			header("Location:../view/AddDesignation.php");
		}
		else
		{
			$_SESSION['msgForDesiCreate'] = 0;
			//echo $objDesignation->CreatedOrNot;
			header("Location:../view/AddDesignation.php");
		}
	}
?>