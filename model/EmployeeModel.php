<?php include("DbOperationModel.php");?>
<?php
	
	class Employee extends DbOperation
	{
		//This variable discribes that, this user is exist in database or not .
		var $CreatedOrNot;
		var $check = 0;
		//-----------------------Method for Create a new Employee
		function dbCreateEmpQuery($empCodeName,$empFirstName,$empLastName,$empDoB,$empBloodGroup,$empGender,$empPhoneNumPersonal,$empPhoneNumOffice,$empParmanentAddress,$empPresentAddress,$empDptId,$empDesiId,$empEmailAddress,$empLoginPass,$userCodeWhoCreateEmp,$empVerification,$empType)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "`eEmployeeCodeNumber`,`eFirstName`,`eLastName`,`eDateOfBirth`,`eBloodGroup`,`eGender`,`ePhoneNumberPersonal`,`ePhoneNumberOffice`,`eParmanentAddress`,`ePresentAddress`,`eDptId`,`eDesignationId`,`eEmailAddress`,`ePassword`,`eEmployeeCodeNumberWhoAddEmployee`,`eEmployeeVerification`,`eEmpType`";
			//database column name
			$tablesName = "`employeeinfo`";
			//database table name
			$conditions = "'".$empCodeName."','".$empFirstName."','".$empLastName."','".$empDoB."','".$empBloodGroup."','".$empGender."','".$empPhoneNumPersonal."','".$empPhoneNumOffice."','".$empParmanentAddress."','".$empPresentAddress."','".$empDptId."','".$empDesiId."','".$empEmailAddress."','".$empLoginPass."','".$userCodeWhoCreateEmp."','".$empVerification."','".$empType."'";
			// conditions, what we want to apply
			$result = $objDbOperation->dbInsert($columnsName,$tablesName,$conditions);
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
		
		function getAllDptDesi()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";							//database column name
			$tablesName = "employeedepartment"; 		//database table name
			$conditions = "order by dptName";			// conditions, what we want to apply
			$result = $objDbOperation->dbEmpSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getSingleDptDesi($cat)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";	//database column name
			$tablesName = "employeedesignation"; 													//database table name
			$conditions = "desiDptId=".$cat." order by desiDesignationName";	// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getAllDesi()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";										//database column name
			$tablesName = "employeedesignation"; 					//database table name
			$conditions = "1 order by desiDesignationName";			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getSingleEmployee()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eEmployeeCodeNumber,emp.eFirstName,emp.eLastName,dpt.dptName,desi.desiDesignationName";
			//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON emp.eDptId = dpt.dptId INNER JOIN employeedesignation desi ON emp.eDesignationId = desi.desiId";
			//database table name
			$conditions = "ORDER BY emp.eId DESC LIMIT 1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			
			//SELECT fields FROM table ORDER BY id DESC LIMIT 1;
			
			return $result;
		}		
		
		function getAllEmp()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eEmpType,emp.eId,emp.eEmployeeVerification,emp.eEmployeeCodeNumber,emp.eFirstName,emp.eLastName,dpt.dptName,desi.desiDesignationName";
			//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON emp.eDptId = dpt.dptId INNER JOIN employeedesignation desi ON emp.eDesignationId = desi.desiId";
			//database table name
			$conditions = "ORDER BY emp.eId ASC";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);

			return $result;
		}
		
		function getAllEmpBloodInfo()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eEmployeeCodeNumber,emp.eFirstName,emp.eLastName,bld.bName,emp.ePhoneNumberPersonal,emp.ePhoneNumberOffice,dpt.dptName,desi.desiDesignationName";
			//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON emp.eDptId = dpt.dptId INNER JOIN employeedesignation desi ON emp.eDesignationId = desi.desiId INNER JOIN employeeBlood bld ON emp.eBloodGroup = bld.bId";
			//database table name
			$conditions = "ORDER BY emp.eId ASC";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);

			return $result;
		}
		
		function getSingleEmpBloodInfo($cat)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eEmployeeCodeNumber,emp.eFirstName,emp.eLastName,bld.bName,emp.ePhoneNumberPersonal,emp.ePhoneNumberOffice,dpt.dptName,desi.desiDesignationName";
			//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON emp.eDptId = dpt.dptId INNER JOIN employeedesignation desi ON emp.eDesignationId = desi.desiId INNER JOIN employeeBlood bld ON emp.eBloodGroup = bld.bId";
			//database table name
			$conditions = "bld.bId=".$cat." ORDER BY emp.eId ASC";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}		
		
		function getEmpBloodInfo()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";
			//database column name
			$tablesName = "employeeBlood";
			//database table name
			$conditions = "1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);

			return $result;
		}
		
		function allBloodInfo()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";	//database column name
			$tablesName = "employeeBlood"; 													//database table name
			$conditions = "1";	// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getAllDptInfo()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";
			//database column name
			$tablesName = "employeedepartment";
			//database table name
			$conditions = "1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);

			return $result;
		}
		
		function getSingleEmpDptInfo($cat)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "emp.eEmpType,emp.eId,emp.eEmployeeVerification,emp.eEmployeeCodeNumber,emp.eFirstName,emp.eLastName,dpt.dptName,desi.desiDesignationName";
			//database column name
			$tablesName = "employeeinfo emp INNER JOIN employeedepartment dpt ON emp.eDptId = dpt.dptId INNER JOIN employeedesignation desi ON emp.eDesignationId = desi.desiId";
			//database table name
			$conditions = "dpt.dptId=".$cat." ORDER BY emp.eId ASC";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function dbEmpStatus($empUserId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "eEmployeeVerification";
			//database column name
			$tablesName = "employeeinfo";
			//database table name
			$conditions = "eId = ".$empUserId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function dbEmpCoordinetorType($empUserId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "eEmpType";
			//database column name
			$tablesName = "employeeinfo";
			//database table name
			$conditions = "eId = ".$empUserId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function dbVerifyEmployee($empWhoVerifytheEmployee,$empUserId,$empVerification)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "eEmployeeVerification = ".$empVerification.", eWhoVerifytheEmployee = '".$empWhoVerifytheEmployee."'";
			//database column name
			$tablesName = "employeeinfo";
			//database table name
			$conditions = "eId = ".$empUserId;
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
		
		function dbEmpTypeUpdate($empWhoVerifytheEmployee,$empUserId,$empType)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "eEmpType = ".$empType.", eWhoVerifytheEmployee = '".$empWhoVerifytheEmployee."'";
			//database column name
			$tablesName = "employeeinfo";
			//database table name
			$conditions = "eId = ".$empUserId;
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
		
		function getAllleaveHistoryForOneUser($applicantUserCodeNumber)
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
		
	}
	
?>