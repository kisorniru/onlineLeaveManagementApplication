<?php include("ConnectionModel.php"); ?>

<?php
	
	class DbOperation
	{
		function dbSelect($columnsName,$tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			//$sql = "SELECT DISTINCT ".$columnsName." FROM ".$tablesName." WHERE ".$conditions;
			$result = mysqli_query($con, "SELECT DISTINCT ".$columnsName." FROM ".$tablesName." WHERE ".$conditions);
			//var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function dbJoinSelect($columnsName,$tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			//$sql = "SELECT ".$columnsName." FROM ".$tablesName." ON ".$conditions;
			$result = mysqli_query($con, "SELECT ".$columnsName." FROM ".$tablesName." ON ".$conditions);
			//var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function dbInsert($columnsName,$tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			//$sql = "INSERT INTO ".$tablesName."( ".$columnsName." ) VALUES ( ".$conditions." )";
			$result = mysqli_query($con, "INSERT INTO ".$tablesName."( ".$columnsName." ) VALUES ( ".$conditions." )");
			//var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function dbEmpSelect($columnsName,$tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			//$sql = "SELECT DISTINCT ".$columnsName." FROM ".$tablesName." WHERE ".$conditions;
			$result = mysqli_query($con, "SELECT DISTINCT ".$columnsName." FROM ".$tablesName." ".$conditions);
			//var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function dbJoinSingleSelect($columnsName,$tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			//$sql = "SELECT ".$columnsName." FROM ".$tablesName." ".$conditions;
			$result = mysqli_query($con, "SELECT ".$columnsName." FROM ".$tablesName." ".$conditions);
			//var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function dbSelectAll($columnsName,$tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			//$sql = "SELECT ".$columnsName." FROM ".$tablesName." WHERE ".$conditions;
			$result = mysqli_query($con, "SELECT ".$columnsName." FROM ".$tablesName." WHERE ".$conditions);
			//var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function dbUpdate($columnsName,$tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			$sql = "UPDATE ".$tablesName." SET ".$columnsName." WHERE ".$conditions;
			$result = mysqli_query($con, "UPDATE ".$tablesName." SET ".$columnsName." WHERE ".$conditions);
			var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function dbDelete($tablesName,$conditions)
		{
			$objConnection = new Connection();
			// object declaretion for using Connection class. Connection class is in ConnectionModel.php file
			$objConnection->dbConnection();
			$con = $objConnection->con;
			$sql = "DELETE FROM ".$tablesName." WHERE ".$conditions;
			$result = mysqli_query($con, "DELETE FROM ".$tablesName." WHERE ".$conditions);
			var_dump($sql);
			//var_dump($result);
			$objConnection->dbCloseConnection();
			//var_dump($result);
			return $result;
		}
		
		function getForRecomandationNumber()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "COUNT(lIsRecomanded)";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "lIsRecomanded = 0";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelectAll($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function getRecomandationNumber()
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "COUNT(lIsRecomanded)";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "lIsRecomanded = 1 AND lIsApproved = 0";
			// conditions, what we want to apply
			$result = $objDbOperation->dbSelectAll($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function forLeaveDaysRemain($livLeaveId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lEmployeeCodeNumberWhoApply = '".$_SESSION['officeUserName']."' AND lLeaveId = ".$livLeaveId." AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function forLeaveDays($livLeaveId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalDays";
			//database column name
			$tablesName = "leavedetails";
			//database table name
			$conditions = "WHERE lId = ".$livLeaveId;
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function leaveDaysRemainForOneUser($applicantUserCodeNumber,$livLeaveId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lEmployeeCodeNumberWhoApply = '".$applicantUserCodeNumber."' AND lLeaveId = ".$livLeaveId." AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function forLeaveDaysRemainWhenUpdate($livLeaveId)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lId = ".$livLeaveId." AND lLeaveId = ".$livLeaveId." AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}
		
		function forNewLeaveDaysRemain($livUserCode,$livUserLeaveType)
		{
			$objDbOperation = new DbOperation();
			$this->check=0;

			$columnsName = "lTotalLeaveDaysRemain";
			//database column name
			$tablesName = "employeeleaveapplicationdetails";
			//database table name
			$conditions = "WHERE lEmployeeCodeNumberWhoApply = '".$livUserCode."' AND lLeaveId = ".$livUserLeaveType." AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
			// conditions, what we want to apply
			$result = $objDbOperation->dbJoinSingleSelect($columnsName,$tablesName,$conditions);
			//var_dump($result);
			return $result;
		}

	}
	
?>