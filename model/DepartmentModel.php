<?php include("DbOperationModel.php");?>
<?php
	
	class Department extends DbOperation
	{
		//This variable discribes that, this user is exist in database or not .
		var $CreatedOrNot;
		var $check = 0;
		//-----------------------Method for Create a new Department
		function dbCreateDptQuery($dptName,$userCodeWhoCreateDpt)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "`dptName`,`dptEmployeeCodeNumberWhoAddDept`";												//database column name
			$tablesName = "`employeedepartment`"; 																		//database table name
			$conditions = "'".$dptName."','".$userCodeWhoCreateDpt."'";													// conditions, what we want to apply
			$result = $objDbOperation->dbInsert($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($result)
			{
				$this->CreatedOrNot = 1;
				$this->check = 1;				
			}
			//This if statement will execute For not creation department
			if($this->check==0)
			{
				$this->CreatedOrNot=0;
			}
		}
		
		function getAllDpt($DescOrAsc)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			
			$columnsName = "*";															//database column name
			$tablesName = "`employeedepartment`"; 										//database table name
			$conditions = "1 ORDER BY `dptId`".$DescOrAsc;															// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);

			return $result;
		}
		
	}
	
?>