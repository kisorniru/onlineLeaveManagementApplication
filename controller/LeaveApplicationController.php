<?php include("../model/LeaveApplicationModel.php")?>
<?php

	if (isset($_POST['btnSubmit']))
	{
		$livEmpCode = $_SESSION['officeUserName'];
		$_SESSION['livAltEmpCode'] = $_POST["livAltEmpCode"];
		$_SESSION['livEmplivType'] = $_POST["livEmplivType"];
		$_SESSION['livReason'] = $_POST["livReason"];
		$_SESSION['livEmplivFrom'] = $_POST["livEmplivFrom"];
		$_SESSION['livEmplivTo'] = $_POST["livEmplivTo"];
		$_SESSION['livAddress'] = $_POST["livAddress"];
		
		$date1 = date_create($_POST["livEmplivFrom"]);
		$date2 = date_create($_POST["livEmplivTo"]);
		$diff=date_diff($date1,$date2);
		
		$_SESSION['LeaveDays'] = $diff->format("%a");
		
		//$test = $_SESSION['LeaveDays'] - 2;
		//echo "<br/> check :".$test."<br/>";
		
		//echo "<br/> Different : ".$diff->format("%R%a days")."<br/>";
		
		//echo "Aplicant : ".$_SESSION['officeUserName']."<br/>Alternative Aplicant : ".$_SESSION['livAltEmpCode']."<br/>Leave From : ".$_SESSION['livEmplivFrom']."<br/>Leave To : ".$_SESSION['livEmplivTo']."<br/>Total Leave :".$_SESSION['LeaveDays']." days <br/>Leave Type : ".$_SESSION['livEmplivType'];
		
		if($_SESSION['officeUserName']!=null && $_SESSION['livEmplivType'] != null && $_SESSION['livEmplivFrom'] != null && $_SESSION['livEmplivTo'] != null && $_SESSION['livAltEmpCode']!=null && $_SESSION['LeaveDays'] != null && $_SESSION['livReason'] != null && $_SESSION['livAddress'] != null)
		{
			//echo "hi";
			$_SESSION['checkLeave'] = 1;
			header("Location:../view/LeaveApplication.php");
		}
		else
		{
			$_SESSION['checkLeave'] = 0;
			header("Location:../view/LeaveApplication.php");
		}
	}
	
	if (isset($_POST['btnApproved']))
	{
		$livId = $_POST['btnApproved'];
		
		$livApprovedBy = $_SESSION['officeUserName'];
		
		$objLeaveApplication = new LeaveApplication();
		$objLeaveApplication->getApproved($livId,$livApprovedBy);
		
		if($objLeaveApplication->CreatedOrNot)
		{
			header("Location:../view/printApplication.php");
		}
		else
		{
			echo "Sorry";
			//header("Location:../view/RecomandedApplications.php");
		}
	}
	
	if(isset($_POST['btnFinalSubmit']))
	{
		//echo "Final Submit";
		$livEmpCode = $_POST["livEmpCode"];
		$livDate = date("Y/m/d");
		$livLeaveId = $_POST["livType"];
		$livEmpAddress = $_POST["livEmpAddress"];
		$livEmpFrom = $_POST["livEmpFrom"];
		$livEmpTo = $_POST["livEmpTo"];
		
		$date3 = date_create($livEmpFrom);
		$date4 = date_create($livEmpTo);
		$difference = date_diff($date3,$date4);
		
		$livTotalLeaveDays = $difference->format("%a");
		
		$objForLeaveDaysRemain = new LeaveApplication();
		$result  = $objForLeaveDaysRemain->forLeaveDaysRemain($livLeaveId);
	
		if (mysqli_fetch_array($result) == null)
		{
			$objForLeaveDaysRemain = new LeaveApplication();
			$leaveTotal  = $objForLeaveDaysRemain->forLeaveDays($livLeaveId);
			while($rowTotal = mysqli_fetch_array($leaveTotal))
			{
				$livTotalLeaveDaysRemain = $rowTotal['lTotalDays'] - $livTotalLeaveDays;
			}
			//echo "From If : TotalLeaveDaysRemain = ".$livTotalLeaveDaysRemain."<br/>";
		}
		else
		{
			$objForLeaveDaysRemain = new LeaveApplication();
			$result  = $objForLeaveDaysRemain->forLeaveDaysRemain($livLeaveId);
			while($row = mysqli_fetch_array($result))
			{
				$livTotalLeaveDaysRemain = $row['lTotalLeaveDaysRemain'] - $livTotalLeaveDays;
				//echo "From Else : TotalLeaveDaysRemain = ".$livTotalLeaveDaysRemain."<br/>";
			}
		}
		
		$livEmpReason = $_POST["livEmpReason"];
		$livAltEmpCode = $_POST["livAltEmployeeCode"];
		$livIsApproved = 0;
		$livIsRecomanded = 0;
		
		//echo "<br/>".$livEmpCode."<br/>".$livDate."<br/>".$livLeaveId."<br/>".$livEmpAddress."<br/>".$livEmpFrom."<br/>".$livEmpTo."<br/> Apply for :".$livTotalLeaveDays."<br/> Now days Remain : ".$livTotalLeaveDaysRemain."<br/>".$livEmpReason."<br/>".$livAltEmpCode."<br/>".$livIsApproved;
		
		$objLeaveApplication = new LeaveApplication();
		$objLeaveApplication->applyForLeave($livEmpCode,$livDate,$livLeaveId,$livEmpAddress,$livEmpFrom,$livEmpTo,$livTotalLeaveDays,$livTotalLeaveDaysRemain,$livEmpReason,$livAltEmpCode,$livIsApproved,$livIsRecomanded);
		
		if($objLeaveApplication->CreatedOrNot)
		{
			//echo "hi";
			$objempLastApplicationId = new LeaveApplication();
			$result  = $objempLastApplicationId->empLastApplicationId($livEmpCode);
			while($row = mysqli_fetch_array($result))
			{
				echo $row['lID'];
				$_SESSION['livApplicationId'] = $row['lID'];
			}
			header("Location:../view/printApplicationForUser.php");
		}
		else
		{
			//echo "hello";
			$_SESSION['msgForApplication'] = 0;
			header("Location:../view/LeaveApplication.php");
		}
		
	}
	
	if (isset($_POST['btnRecomand']))
	{
		$livId = $_POST['btnRecomand'];
		
		$livRecomandBy = $_SESSION['officeUserName'];
		
		$objLeaveApplication = new LeaveApplication();
		$objLeaveApplication->getRecomand($livId,$livRecomandBy);
		
		if($objLeaveApplication->CreatedOrNot)
		{
			header("Location:../view/Applications.php");
		}
		else
		{
			echo "Sorry";
			//header("Location:../view/ListOfApplication.php");
		}
	}
	
	if (isset($_POST['btnApplicationDetails']))
	{
		$_SESSION['livApplicationDetailsForOneUserId'] = $_POST['btnApplicationDetails'];
		$applicantUserId = $_SESSION['livApplicationDetailsForOneUserId'];
		
		$objLeaveApplication = new LeaveApplication();
		$result = $objLeaveApplication->getUserCodeName($applicantUserId);
		
		$_SESSION['livApplicationDetailsForOneUserCode'] = $result;
		
		//echo $_SESSION['livApplicationDetailsForOneUserId']." - Appliocation Id<br/>";
		header("Location:../view/Applications.php");
		
		//$lWhoEdit = $_SESSION['officeUserName'];
		//echo $lWhoEdit." - Who Edited<br/>";
	}
	if (isset($_POST['btnNotApproved']))
	{
		$livId = $_POST['btnNotApproved'];
		
		$objLeaveApplication = new LeaveApplication();
		$objLeaveApplication->notApproved($livId);
		
		if($objLeaveApplication->CreatedOrNot)
		{
			header("Location:../view/RecomandedApplications.php");
		}
		else
		{
			echo "Sorry";
			//header("Location:../view/RecomandedApplications.php");
		}
	}
	if (isset($_POST['btnApplicationDetailsBeforeApprove']))
	{
		$_SESSION['livApplicationDetailsForOneUserId'] = $_POST['btnApplicationDetailsBeforeApprove'];
		$applicantUserId = $_SESSION['livApplicationDetailsForOneUserId'];
		
		$objLeaveApplication = new LeaveApplication();
		$result = $objLeaveApplication->getUserCodeName($applicantUserId);
		
		$_SESSION['livApplicationDetailsForOneUserCode'] = $result;
		
		//echo $_SESSION['livApplicationDetailsForOneUserId']." - Appliocation Id<br/>";
		header("Location:../view/RecomandedApplications.php");
		
		//$lWhoEdit = $_SESSION['officeUserName'];
		//echo $lWhoEdit." - Who Edited<br/>";
	}
	
	if (isset($_POST['btnUserLeaveApplicationUpdate']))
	{
		$livUserId = $_POST['btnUserLeaveApplicationUpdate'];
		$livUserLeaveFrom = $_POST['userLeaveFrom'];
		$livUserLeaveTo = $_POST['userLeaveTo'];
		$livUserLeaveType = $_POST['userLeaveType'];
		
		$livApplicationUpdateBy = $_SESSION['officeUserName'];
		
		$date1 = date_create($livUserLeaveFrom);
		$date2 = date_create($livUserLeaveTo);
		$diff=date_diff($date1,$date2);
		
		$lTotalLeaveDays = $diff->format("%a");
		//echo "Apply For : ".$lTotalLeaveDays." days <br/>";
		
		$objForApplicantLeaveTypeAndCode = new LeaveApplication();
		$applicantLeaveTypeAndCode  = $objForApplicantLeaveTypeAndCode->getApplicantLeaveTypeAndCode($livUserId);
		
		while($row = mysqli_fetch_array($applicantLeaveTypeAndCode))
		{
			$livUserOldLeaveType = $row['lLeaveId'];
			$livUserCode = $row['lEmployeeCodeNumberWhoApply'];
		}
		if($livUserLeaveType == $livUserOldLeaveType)
		{
			$objForLeaveDaysRemain = new LeaveApplication();
			$result  = $objForLeaveDaysRemain->lastTotalAndReaminLeaveDays($livUserId);
			
			while($orw = mysqli_fetch_array($result))
			{
				$SUB = $lTotalLeaveDays - $orw['lTotalLeaveDays'];
				//echo "From while : TotalLeaveDays = ".$SUB."<br/>";
				$lTotalLeaveDaysRemain = $orw['lTotalLeaveDaysRemain'] - $SUB;
				//echo "From while : TotalLeaveDaysRemain = ".$lTotalLeaveDaysRemain."<br/>";
			}
		}
		else
		{
			$objForLeaveDaysRemain = new LeaveApplication();
			$result  = $objForLeaveDaysRemain->forNewLeaveDaysRemain($livUserCode,$livUserLeaveType);
		
			if (mysqli_fetch_array($result) == null)
			{
				$objForLeaveDaysRemain = new LeaveApplication();
				$leaveTotal  = $objForLeaveDaysRemain->forLeaveDays($livUserLeaveType);
				while($rowTotal = mysqli_fetch_array($leaveTotal))
				{
					$lTotalLeaveDaysRemain = $rowTotal['lTotalDays'] - $lTotalLeaveDays;
				}
				//echo "From If : TotalLeaveDaysRemain = ".$lTotalLeaveDaysRemain."<br/>";
			}
			else
			{
				$objForLeaveDaysRemain = new LeaveApplication();
				$result  = $objForLeaveDaysRemain->forNewLeaveDaysRemain($livUserCode,$livUserLeaveType);
				while($row = mysqli_fetch_array($result))
				{
					$lTotalLeaveDaysRemain = $row['lTotalLeaveDaysRemain'] - $lTotalLeaveDays;
					//echo "From Else : TotalLeaveDaysRemain = ".$lTotalLeaveDaysRemain."<br/>";
				}
			}
		}
		
		//echo "<br/>User Id : ".$livUserId."<br/> From : ".$livUserLeaveFrom."<br/> To : ".$livUserLeaveTo."<br/> Type : ".$livUserLeaveType."<br/>Difference Between Two Date : ".$lTotalLeaveDays."<br/> Total Days Remain : ".$lTotalLeaveDaysRemain;
		
		$objLeaveApplication = new LeaveApplication();
		$objLeaveApplication->updateOnesApplicattion($livUserId,$livUserLeaveFrom,$livUserLeaveTo,$livUserLeaveType,$lTotalLeaveDays,$lTotalLeaveDaysRemain,$livApplicationUpdateBy);
		
		if($objLeaveApplication->CreatedOrNot)
		{
			$_SESSION['applicationUpdate'] = 1;
			header("Location:../view/Applications.php");
		}
		else
		{
			echo "Sorry";
			//header("Location:../view/Applications.php");
		}
		
	}
?>