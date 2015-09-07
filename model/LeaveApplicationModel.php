<?php include("DbOperationModel.php");?>
<?php
	
	class LeaveApplication extends DbOperation
	{
		//This variable discribes that, this user is exist in database or not .
		var $CreatedOrNot;
		var $check = 0;
		//-----------------------Method for Create a new LeaveApplication		
		function getSingleEmpInfo($empCodeName)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "emp.eEmployeeCodeNumber, emp.eFirstName, emp.eLastName,	dpt.dptName, desi.desiDesignationName";	//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON emp.eDptId = dpt.dptId INNER JOIN employeedesignation desi ON emp.eDesignationId = desi.desiId";						//database table name
			$conditions = "emp.eEmployeeCodeNumber = '".$empCodeName."'";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getLeaveType()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "*";										//database column name
			$tablesName = "leavedetails";						//database table name
			$conditions = "1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function applyForLeave($livEmpCode,$livDate,$livLeaveId,$livEmpAddress,$livEmpFrom,$livEmpTo,$livTotalLeaveDays,$livTotalLeaveDaysRemain,$livEmpReason,$livAltEmpCode,$livIsApproved,$livIsRecomanded)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "`lEmployeeCodeNumberWhoApply`,`lApplyDate`,`lLeaveId`,`lEmployeeImargencyAddress`,`lLeaveFromDate`,`lLeaveToDate`,`lTotalLeaveDays`,`lTotalLeaveDaysRemain`,`lLeaveReason`,`lAlternativeEmployeeCardNumber`,`lIsApproved`,`lIsRecomanded`";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "'".$livEmpCode."','".$livDate."',".$livLeaveId.",'".$livEmpAddress."','".$livEmpFrom."','".$livEmpTo."',".$livTotalLeaveDays.",".$livTotalLeaveDaysRemain.",'".$livEmpReason."','".$livAltEmpCode."',".$livIsApproved.",".$livIsRecomanded."";
			// conditions, what we want to apply
			$result = $objDbOperation->dbInsert($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		
		function getLeaveForRecomandation()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "ld.lType, emp.eFirstName,liv.lEmployeeCodeNumberWhoApply,emp.eLastName,liv.lId,liv.lApplyDate,liv.lTotalLeaveDays,liv.lLeaveFromDate,liv.lLeaveToDate,liv.lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails liv INNER JOIN employeeinfo emp ON liv.lEmployeeCodeNumberWhoApply = emp.eEmployeeCodeNumber INNER JOIN leavedetails ld ON liv.lLeaveId = ld.lId";
			//database table name
			$conditions = "lIsRecomanded = 0";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelectAll($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getRecomand($livId,$livRecomandBy)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$columnsName = "lIsRecomanded = 1, lWhoRecomand = '".$livRecomandBy."'";
			//database column name
			$conditions = "lId = ".$livId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbUpdate($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		
		function getEditForRecomand($livApplicationUserId,$livRecomandBy)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$columnsName = "lIsRecomanded = 1, lWhoRecomand = '".$livRecomandBy."'";
			//database column name
			$conditions = "lId = ".$livApplicationUserId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbUpdate($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		
		function getRecomandedApplication()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "ld.lType,emp.eFirstName,emp.eLastName,liv.lId,liv.lApplyDate,liv.lTotalLeaveDays,liv.lLeaveFromDate,liv.lLeaveToDate,liv.lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails liv INNER JOIN employeeinfo emp ON liv.lEmployeeCodeNumberWhoApply = emp.eEmployeeCodeNumber INNER JOIN leavedetails ld ON liv.lLeaveId = ld.lId";
			//database table name
			$conditions = "lIsRecomanded = 1 AND lIsApproved = 0";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelectAll($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getApproved($livId,$livApprovedBy)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$_SESSION['livApplicationId'] = $_POST['btnApproved'];

			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$columnsName = "lIsApproved = 1, lWhoApproved = '".$livApprovedBy."'";
			//database column name
			$conditions = "lId = ".$livId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbUpdate($columnsName,$tablesName,$conditions);
			//var_dump($result);
			
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		function notApproved($livId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "lId = ".$livId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbDelete($tablesName,$conditions);
			//var_dump($result);
			
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		
		function leaveDue($applicantUserCodeNumber,$livLeaveId) //$applicantUserCodeNumber
		{
			
			$objForLeaveDaysRemain = new DbOperation();
			$result  = $objForLeaveDaysRemain->leaveDaysRemainForOneUser($applicantUserCodeNumber,$livLeaveId);
		
			if (mysqli_fetch_array($result) == null)
			{
				$objForLeaveDaysRemain = new DbOperation();
				$leaveTotal  = $objForLeaveDaysRemain->forLeaveDays($livLeaveId);
				while($rowTotal = mysqli_fetch_array($leaveTotal))
				{
					$livTotalLeaveDaysRemain = $rowTotal['lTotalDays'];
				}
				//echo "From If : TotalLeaveDaysRemain = ".$livTotalLeaveDaysRemain."<br/>";
				return $livTotalLeaveDaysRemain;
			}
			else
			{
				$objForLeaveDaysRemain = new DbOperation();
				$result  = $objForLeaveDaysRemain->leaveDaysRemainForOneUser($applicantUserCodeNumber,$livLeaveId);
				while($row = mysqli_fetch_array($result))
				{
					$livTotalLeaveDaysRemain = $row['lTotalLeaveDaysRemain'];
				}
				//echo "From Else : TotalLeaveDaysRemain = ".$livTotalLeaveDaysRemain."<br/>";
				return $livTotalLeaveDaysRemain;
			}
			
			
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lLeaveId = ".$livLeaveId." ORDER BY lId DESC LIMIT 1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function leaveRequest($applicantUserId,$livLeaveId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDays";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lId = ".$applicantUserId." AND lLeaveId = ".$livLeaveId." AND ( lIsApproved = 0 AND ( lIsRecomanded = 0 OR lIsRecomanded = 1 ))";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			if(mysqli_fetch_array($result) == null)
			{
				$leaveForApply = 0;
				//echo "hi";
			}
			else
			{
				$result1 = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
				while($row = mysqli_fetch_array($result1))
				{
					$leaveForApply = $row['lTotalLeaveDays'];
					//echo "hello";
				}
				
			}
			//echo "From Else : TotalLeaveDaysRemain = ".$livTotalLeaveDaysRemain."<br/>";
			return $leaveForApply;
		}
		
		function getUserCodeName($applicantUserId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lEmployeeCodeNumberWhoApply";										//database column name
			$tablesName = "employeeleaveapplicationdetails";						//database table name
			$conditions = "lId = ".$applicantUserId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			while($row = mysqli_fetch_array($result))
			{
				$userCodeNumber = $row['lEmployeeCodeNumberWhoApply'];
			}
			return $userCodeNumber;
		}
		
		function getAllleaveHistory($applicantUserCodeNumber)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lLeaveFromDate,lLeaveToDate,lTotalLeaveDays";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lEmployeeCodeNumberWhoApply = '".$applicantUserCodeNumber."' AND lIsApproved = 1";
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
		function lastTotalAndReaminLeaveDays($livUserId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDays,lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lId = ".$livUserId;
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
		function getApplicantLeaveTypeAndCode($livUserId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lLeaveId,lEmployeeCodeNumberWhoApply";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lId = ".$livUserId;
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
		function updateOnesApplicattion($livUserId,$livUserLeaveFrom,$livUserLeaveTo,$livUserLeaveType,$lTotalLeaveDays,$lTotalLeaveDaysRemain,$livApplicationUpdateBy)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "lLeaveFromDate = '".$livUserLeaveFrom."', lLeaveToDate = '".$livUserLeaveTo."',lLeaveId = '".$livUserLeaveType."', lTotalLeaveDays = '".$lTotalLeaveDays."', lTotalLeaveDaysRemain = '".$lTotalLeaveDaysRemain."', lWhoEdit = '".$livApplicationUpdateBy."'";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "lId = ".$livUserId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbUpdate($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		function AppliedEmpInfo($empId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eFirstName,emp.eLastName,dpt.dptName,desi.desiDesignationName,ld.lType,eld.lEmployeeCodeNumberWhoApply,eld.lApplyDate,eld.lLeaveId,eld.lEmployeeImargencyAddress,eld.lAlternativeEmployeeCardNumber,eld.lTotalLeaveDays,eld.lLeaveFromDate,eld.lLeaveToDate,	eld.lLeaveReason, emp.ePhoneNumberPersonal, emp.ePhoneNumberOffice";
			//database column name
			$tablesName = "employeeleaveapplicationdetails eld INNER JOIN employeeinfo emp ON eld.lEmployeeCodeNumberWhoApply = emp.eEmployeeCodeNumber INNER JOIN employeedepartment dpt ON dpt.dptId = emp.eDptId INNER JOIN employeedesignation desi ON desi.desiId = emp.eDesignationId INNER JOIN leavedetails ld ON ld.lId = eld.lLeaveId ";
			//database table name
			$conditions = " WHERE eld.lIsApproved = 1 AND eld.lId = ".$empId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
		function AppliedEmpAlternativeEmpDetailsInfo($empId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eFirstName,	emp.eLastName, dpt.dptName,	desi.desiDesignationName";
			//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON dpt.dptId = emp.eDptId INNER JOIN employeedesignation desi ON desi.desiId = emp.eDesignationId";
			//database table name
			$conditions = " WHERE emp.eEmployeeCodeNumber = (SELECT lAlternativeEmployeeCardNumber FROM	employeeleaveapplicationdetails	WHERE lId = ".$empId." );";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
		//unnecessery for main concept of Leave Application START
		function empLastApplicationId($livEmpCode)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "lID";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = " WHERE lEmployeeCodeNumberWhoApply = '".$livEmpCode."' ORDER BY lID DESC LIMIT 1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
		function empLastApplicationInfo($empId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eFirstName,emp.eLastName,dpt.dptName,desi.desiDesignationName,ld.lType,eld.lEmployeeCodeNumberWhoApply,eld.lApplyDate,eld.lLeaveId,eld.lEmployeeImargencyAddress,eld.lAlternativeEmployeeCardNumber,eld.lTotalLeaveDays,eld.lLeaveFromDate,eld.lLeaveToDate,	eld.lLeaveReason, emp.ePhoneNumberPersonal, emp.ePhoneNumberOffice";
			//database column name
			$tablesName = "employeeleaveapplicationdetails eld INNER JOIN employeeinfo emp ON eld.lEmployeeCodeNumberWhoApply = emp.eEmployeeCodeNumber INNER JOIN employeedepartment dpt ON dpt.dptId = emp.eDptId INNER JOIN employeedesignation desi ON desi.desiId = emp.eDesignationId INNER JOIN leavedetails ld ON ld.lId = eld.lLeaveId ";
			//database table name
			$conditions = " WHERE eld.lId = ".$empId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
		//unnecessery for main concept of Leave Application END
	}
	
?>