<?php include("DbOperationModel.php");?>
<?php
	
	class Login extends DbOperation
	{
		//This variable discribes that, this user is exist in database or not .
		var $officeUserName;
		var $officeUserPass;
		var $check;
		var $officeUserIsFound;
		//-----------------------Set Function
		function setOfficeUserName($officeUserName)
		{
		  $this->officeUserName = $officeUserName;
		}
		function setOfficeUserPass($officeUserPass)
		{
		  $this->officeUserPass = $officeUserPass;
		}
		//-----------------------Get Function
		function getOfficeUserName()
		{
		  return $this->officeUserName;
		}
		function getOfficeUserPass()
		{
		  return $this->officeUserPass;
		}
		
		//-----------------------Method for varify userName and password
		function dbUserQuery($officeUserName,$officeUserPass)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;
			//$this means current object, here current class object is Login class object
			$columnsName = "*"; 																				//database column name
			$tablesName = "`employeeinfo`"; 																	//database table name
			$conditions = "`eEmployeeCodeNumber`='".$officeUserName."' and `ePassword`='".$officeUserPass."' and `eEmployeeVerification` = 1";	// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			if($row = mysqli_fetch_array($result))
			{
				
				$_SESSION['empType'] = $row['eEmpType'];
				
				$objDbOperation = new DbOperation();
				$this->check=0;
				//$this means current object, here current class object is Login class object
				$tablesName = "`employeeinfo`"; 																	//database table name
				$columnsName = "eLastLogin = NOW()"; 																//database column name
				$conditions = "`eEmployeeCodeNumber`='".$officeUserName."'";	// conditions, what we want to apply
				$result = $objDbOperation->dbUpdate($columnsName,$tablesName,$conditions);
				
				$this->officeUserIsFound = 1;
				$_SESSION['officeUserName'] = $row['eEmployeeCodeNumber'];
				$_SESSION['officeUserPass'] = $row['ePassword'];
				$_SESSION['isLogin'] = 1;
				$this->check = 1;				
			}
			//This if statement will execute For invalid officeUserName or officeUserPass
			if($this->check==0)
			{
				$this->officeUserIsFound=0;
			}
		}
		
		//-----------------------Method for recovering password
		function getPasswordByEmail($officeUserEmail)
		{
			$objDbOperation=new Dboperation();
			$this->check=0;
			
			$columnsName = "*"; 																				//database column name
			$tablesName = "`employeeinfo`"; 																	//database table name
			$conditions = "`eEmailAddress`='".$officeUserEmail."'";												// conditions, what we want to apply
			$result = $objDbOperation->dbSelect($columnsName,$tablesName,$conditions);

			if($row = mysqli_fetch_array($result))
			{
				$this->officeUserIsFound=1;
				$_SESSION['officeUserName'] = $row['eEmployeeCodeNumber'];
				$_SESSION['officeUserPass'] = $row['ePassword'];
				$_SESSION['isLogin'] = 1;
			}
			//This if statement will execute For invalid officeUserName or officeUserPass
			if($this->check==0)
			{
				$this->officeUserIsFound=0;
			}
		}
		
	}
	
?>