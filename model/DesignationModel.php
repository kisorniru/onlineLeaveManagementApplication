<?php include("DbOperationModel.php");?>
<?php
	
	class Designation extends DbOperation
	{
		//This variable discribes that, this user is exist in database or not .
		var $CreatedOrNot;
		var $check = 0;
		//-----------------------Method for Create a new Designation
		function dbCreateDesiQuery($dptId,$desiName,$userCodeWhoCreateDesi)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "`desiDptId`,`desiDesignationName`,`desiEmployeeCodeNumberWhoAddDesi`";						//database column name
			$tablesName = "`employeedesignation`"; 																		//database table name
			$conditions = "'".$dptId."','".$desiName."','".$userCodeWhoCreateDesi."'";									// conditions, what we want to apply
			$result = $objDbOperation->dbInsert($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			//This if statement will execute For not creation Designation
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		
		function getAllDpt()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";															//database column name
			$tablesName = "`employeedepartment`"; 										//database table name
			$conditions = "1 ORDER BY `dptId`";															// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);

			return $result;
		}
		
		function getAllDesi()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "employeedesignation.desiId,	employeedepartment.dptName, employeedesignation.desiDesignationName";	//database column name
			$tablesName = "employeedepartment INNER JOIN employeedesignation"; 													//database table name
			$conditions = "employeedepartment.dptId=employeedesignation.desiDptId";				// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getSingleEmpDptInfo($cat)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "employeedesignation.desiId,	employeedepartment.dptName, employeedesignation.desiDesignationName";	//database column name
			$tablesName = "employeedepartment INNER JOIN employeedesignation ON employeedepartment.dptId = employeedesignation.desiDptId";						//database table name
			$conditions = "employeedepartment.dptId=".$cat;
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
	}
	
?>