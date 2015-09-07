<?php include("DbOperationModel.php");?>
<?php
	
	class User extends DbOperation
	{
		//This variable discribes that, this user is exist in database or not .
		var $CreatedOrNot;
		var $check = 0;
		//-----------------------Method for Create a new Department
		
		function getUserInformation()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.ePassword,emp.eEmailAddress,emp.ePhoneNumberOffice,emp.ePhoneNumberPersonal,emp.ePresentAddress,emp.eParmanentAddress,emp.eEmployeeCodeNumber,emp.eFirstName,emp.eLastName,emp.eDateOfBirth,emp.eGender,emp.eBloodGroup,bld.bName,dpt.dptName,desi.desiDesignationName";
			//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON emp.eDptId = dpt.dptId INNER JOIN employeedesignation desi ON emp.eDesignationId = desi.desiId INNER JOIN employeeblood bld ON emp.eBloodGroup = bld.bId";
			//database table name
			$conditions = "WHERE `eEmployeeCodeNumber` = '".$_SESSION['officeUserName']."'";		// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);

			return $result;
		}
		
		function dbUserInfoUpdate($officeUserCode,$userPersonalPhoneNumber,$userPresentAddress,$userPassword)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "ePhoneNumberPersonal = ".$userPersonalPhoneNumber.", ePresentAddress = '".$userPresentAddress."', ePassword = '".$userPassword."'";
			//database column name
			$tablesName = "employeeinfo";
			//database table name
			$conditions = "eEmployeeCodeNumber = '".$officeUserCode."'";
			// conditions, what we want to apply
			$result = $objDbOperation->dbUpdate($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			//This if statement will execute For not creation Employee
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		
		function leaveDue($livLeaveId)
		{
			
			$objForLeaveDaysRemain = new DbOperation();
			$result  = $objForLeaveDaysRemain->forLeaveDaysRemain($livLeaveId);
		
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
				$result  = $objForLeaveDaysRemain->forLeaveDaysRemain($livLeaveId);
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
		
		function leaveRequest($livLeaveId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDays";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lEmployeeCodeNumberWhoApply = '".$_SESSION['officeUserName']."' AND lLeaveId = ".$livLeaveId." AND ( lIsApproved = 0 AND ( lIsRecomanded = 0 OR lIsRecomanded = 1 ))";
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
		
		function getAllleaveHistory()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lLeaveFromDate,lLeaveToDate,lTotalLeaveDays";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lEmployeeCodeNumberWhoApply = '".$_SESSION['officeUserName']."' AND lIsApproved = 1";
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			return $result;
		}
		
	}
	
?>