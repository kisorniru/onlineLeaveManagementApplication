<?php include("../model/LeaveApplicationModel.php");
	
	if(isset($_SESSION['officeUserName']))
	{
	
	if ($_SESSION['empType'] == 2 || $_SESSION['empType'] == 1)
	{
?>

		<!DOCTYPE html>
		<html lang="en">

		<head>

			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">

			<title>Leave safasfd Application</title>

			<!-- Bootstrap Core CSS -->
			<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

			<!-- Custom CSS -->
			<link href="../assets/css/simple-sidebar.css" rel="stylesheet">

			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->

		</head>

		<body>

			<div id="wrapper">

				<!-- Sidebar -->
				<div id="sidebar-wrapper">
					<ul class="sidebar-nav">
						<li class="sidebar-brand">
							<a href="LeaveApplication.php" style="color:#DAA520;">Leave application</a>
						</li>
						<li>
							<a href="UserProfile.php">User Profile</a>
						</li>
							<?php
							$objLeaveApplication = new LeaveApplication();
							$result = $objLeaveApplication->getForRecomandationNumber();
							while($row = mysqli_fetch_array($result))
							{ 
							?>
						<li>
							<a href="Applications.php">Applications <span style="color:red"><?php if($row['COUNT(lIsRecomanded)'] != 0){ ?>[ New <?php echo $row['COUNT(lIsRecomanded)']; ?> ]<?php } ?></span></a>
						</li>
							<?php
							}
							$objLeaveApplication = new LeaveApplication();
							$result = $objLeaveApplication->getRecomandationNumber();
							while($row = mysqli_fetch_array($result))
							{ 
							?>
						<li>
							<a href="RecomandedApplications.php">Recomanded Applications<span style="color:red"><?php if($row['COUNT(lIsRecomanded)'] != 0){ ?> [ New <?php echo $row['COUNT(lIsRecomanded)']; ?> ]<?php } ?></span></a>
						</li>
							<?php
							}
							?>
						<li>
							<a href="AddDepartment.php">Add Department</a>
						</li>
						<li>
							<a href="ListDepartment.php">List Department</a>
						</li>
						<li>
							<a href="AddDesignation.php">Add Designation</a>
						</li>
						<li>
							<a href="ListDesignation.php">List Designation</a>
						</li>
						<li>
							<a href="AddEmployee.php">Add Employee</a>
						</li>
						<li>
							<a href="ListEmployee.php">List Employee</a>
						</li>
						<li>
							<a href="UsersLeaveDetails.php">User's Leave Details</a>
						</li>
						<li>
							<a href="ListOfUserBlood.php">Blood Group</a>
						</li>
						<li>
							<a href="../controller/LogoutController.php">Logout</a>
						</li>
					</ul>
				</div>
				<!-- /#sidebar-wrapper -->

				<!-- Page Content -->
				<div id="page-content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu Bar</a>
								<h1 align="center">Leave Application</h1>
								
								<?php
									if (isset($_SESSION['checkLeave']))
									{
										if($_SESSION['checkLeave'] == 1)
										{
											$empCodeName = $_SESSION['officeUserName'];
											$altEmpCodeName = $_SESSION['livAltEmpCode'];
											$empLeaveType = $_SESSION['livEmplivType'];
											$empLeaveReason = $_SESSION['livReason'];
											$empLeaveFrom = $_SESSION['livEmplivFrom'];
											$empLeaveTo = $_SESSION['livEmplivTo'];
											$empAddress = $_SESSION['livAddress'];
											$empLeaveDays = $_SESSION['LeaveDays'];
											
											unset($_SESSION['checkLeave']);
											unset($_SESSION['livAltEmpCode']);
											unset($_SESSION['livEmplivType']);
											unset($_SESSION['livReason']);
											unset($_SESSION['livEmplivFrom']);
											unset($_SESSION['livEmplivTo']);
											unset($_SESSION['livAddress']);
											unset($_SESSION['LeaveDays']);
											?>
											<form role="form" action="../controller/LeaveApplicationController.php" method="post" >
									
												<h3 align="center" class="text-warning">You Can Update Before Final Submission</h3>
												
												<div class="form-group">
											
													<label for="livDate">Date: </label>
													<input type="text" class="form-control" value="<?php echo date("l")." ".date("Y/m/d"); ?>" name="livDate" id="livDate" readonly>
												
												</div>
												
												<?php
													
													$objLeaveApplication = new LeaveApplication();
													$singleResult = $objLeaveApplication->getSingleEmpInfo($empCodeName);
													while ($empResult = mysqli_fetch_array($singleResult))
													{
													?>
													
												<div class="form-group">
											
													<label for="livEmpName">Employee Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eFirstName']." ".$empResult['eLastName']; ?>" name="livEmpName" id="livEmpName" readonly>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpCode">Employee Code Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eEmployeeCodeNumber']; ?>" name="livEmpCode" id="livEmpCode" readonly>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpDptName">Employee Department Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['dptName']; ?>" name="livEmpDptName" id="livEmpDptName" readonly>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpDesiName">Employee Designation Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['desiDesignationName']; ?>" name="livEmpDesiName" id="livEmpDesiName" readonly>
												
												</div>
												
												<?php
													}
												?>
												
												<div class="form-group">
										
												<label for="livType">Leave Type: </label>
												<?php
													
													$objLeaveApplication = new LeaveApplication();
													$singleResult = $objLeaveApplication->getLeaveType();
													while ($empResult = mysqli_fetch_array($singleResult))
													{
													?>
														<div class="radio">
															<label><input type="radio" name="livType" value="<?php echo $empResult['lId']; ?>" required><?php echo $empResult['lType']; ?></label>
														</div>
													<?php
													}
													?>
												</div>
												
												<div class="form-group">
											
													<label for="livEmpAddress">Contact Address During Leave: </label>
													<input type="text" class="form-control" value="<?php echo $empAddress; ?>" name="livEmpAddress" id="livEmpAddress" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpReason">Reason: </label>
													<input type="text" class="form-control" value="<?php echo $empLeaveReason; ?>" name="livEmpReason" id="livEmpReason" required>
												
												</div>
												
												
												
												<div class="form-group">
											
													<label for="livEmpFrom">From: </label>
													<input type="date" class="form-control" value="<?php echo $empLeaveFrom; ?>" name="livEmpFrom" id="livEmpFrom" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpTo">To: </label>
													<input type="date" class="form-control" value="<?php echo $empLeaveTo; ?>" name="livEmpTo" id="livEmpTo" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpPeriod">Period of Days: </label>
													<input type="text" class="form-control" value="<?php echo $empLeaveDays; ?>" name="livEmpPeriod" id="livEmpPeriod" required>
												
												</div>
												
												<?php
													
													$objLeaveApplication = new LeaveApplication();
													$singleResult = $objLeaveApplication->getSingleEmpInfo($altEmpCodeName);
													while ($empResult = mysqli_fetch_array($singleResult))
													{
													?>
												
												<div class="form-group">
											
													<label for="livAltEmployeeCode">Alternative Employee Code Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eEmployeeCodeNumber']; ?>" name="livAltEmployeeCode" id="livAltEmployeeCode" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livAltEmpName">Alternative Employee Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eFirstName']." ".$empResult['eLastName']; ?>" name="livAltEmpName" id="livAltEmpName" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livAltEmpDptName">Alternative Employee Department Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['dptName']; ?>" name="livAltEmpDptName" id="livAltEmpDptName" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livAltEmpDesiName">Alternative Employee Designation Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['desiDesignationName']; ?>" name="livAltEmpDesiName" id="livAltEmpDesiName" required>
												
												</div>
												
												<?php
													}
												?>
												
												<button type="submit" name="btnFinalSubmit" class="btn">Apply</button>
											
											</form>
										<?php
										}
										else
										{
											//echo "hello";
											unset($_SESSION['checkLeave']);
											unset($_SESSION['livAltEmpCode']);
											unset($_SESSION['livEmplivType']);
											unset($_SESSION['livReason']);
											unset($_SESSION['livEmplivFrom']);
											unset($_SESSION['livEmplivTo']);
											unset($_SESSION['livAddress']);
											unset($_SESSION['LeaveDays']);
										}
									}
									else
									{
										?>
										<form role="form" action="../controller/LeaveApplicationController.php" method="post" >
								
											<?php
											
											if (isset($_SESSION['msgForApplication']))
											{
												if ($_SESSION['msgForApplication'] == 1)
												{												
													unset($_SESSION['msgForApplication']);
													?>
													<h3 align="center" class="text-success">Your Application Is Successfully Placed</h3>
													<div class="form-group">
										
														<label for="livAltEmpCode">Alternative Employee Code Name: </label>
														<input type="text" class="form-control" placeholder="Alternative Employee Code Name ...." name="livAltEmpCode" id="livAltEmpCode" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivType">Leave Type: </label>
														<?php
															
															$objLeaveApplication = new LeaveApplication();
															$singleResult = $objLeaveApplication->getLeaveType();
															while ($empResult = mysqli_fetch_array($singleResult))
															{
															?>
																<div class="radio">
																	<label><input type="radio" name="livEmplivType" value="<?php echo $empResult['lId']; ?>" required><?php echo $empResult['lType']; ?></label>
																</div>
															<?php
															}
															?>
													</div>
													
													<div class="form-group">
												
														<label for="livReason">Leave Reason: </label>
														<textarea class="form-control" rows="5" placeholder="Leave Reason ...." name="livReason" id="livReason"required></textarea>
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivFrom">From: </label>
														<input type="date" class="form-control" name="livEmplivFrom" id="livEmplivFrom" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivTo">To: </label>
														<input type="date" class="form-control" name="livEmplivTo" id="livEmplivTo" required>
													
													</div>
													
													<div class="form-group">
													
														<label for="livAddress">Contact Address During Leave: </label>
														<input type="text" class="form-control" placeholder="Address During Name ...." name="livAddress" id="livAddress" required>
													
													</div>
													
													<button type="submit" name="btnSubmit" class="btn">Apply</button>
												<?php
												}
												else
												{
													unset($_SESSION['msgForApplication']);
													//echo "hi";
												}
												
											}
											else
											{
												?>
													
													<div class="form-group">
										
														<label for="livAltEmpCode">Alternative Employee Code Name: </label>
														<input type="text" class="form-control" placeholder="Alternative Employee Code Name ...." name="livAltEmpCode" id="livAltEmpCode" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivType">Leave Type: </label>
														<?php
															
															$objLeaveApplication = new LeaveApplication();
															$singleResult = $objLeaveApplication->getLeaveType();
															while ($empResult = mysqli_fetch_array($singleResult))
															{
															?>
																<div class="radio">
																	<label><input type="radio" name="livEmplivType" value="<?php echo $empResult['lId']; ?>" required><?php echo $empResult['lType']; ?></label>
																</div>
															<?php
															}
															?>
													</div>
													
													<div class="form-group">
												
														<label for="livReason">Leave Reason: </label>
														<textarea class="form-control" rows="5" placeholder="Leave Reason ...." name="livReason" id="livReason"required></textarea>
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivFrom">From: </label>
														<input type="date" class="form-control" name="livEmplivFrom" id="livEmplivFrom" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivTo">To: </label>
														<input type="date" class="form-control" name="livEmplivTo" id="livEmplivTo" required>
													
													</div>
													
													<div class="form-group">
													
														<label for="livAddress">Contact Address During Leave: </label>
														<input type="text" class="form-control" placeholder="Address During Name ...." name="livAddress" id="livAddress" required>
													
													</div>
													
													<button type="submit" name="btnSubmit" class="btn">Apply</button>
													
												<?php
											}
												?>
												
										</form>
										<?php
									}
									
								?>
								
							</div>
						</div>
					</div>
				</div>
				<!-- /#page-content-wrapper -->

			</div>
			<!-- /#wrapper -->

			<!-- jQuery -->
			<script src="../assets/js/jquery.js"></script>

			<!-- Bootstrap Core JavaScript -->
			<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

			<!-- Menu Toggle Script -->
			<script>
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});
			</script>

		</body>

		</html>

<?php

	}
	else
	{
		?>
		
		<!DOCTYPE html>
		<html lang="en">

		<head>

			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">

			<title>Leave Application</title>

			<!-- Bootstrap Core CSS -->
			<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

			<!-- Custom CSS -->
			<link href="../assets/css/simple-sidebar.css" rel="stylesheet">

			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->

		</head>

		<body>

			<div id="wrapper">

				<!-- Sidebar -->
				<div id="sidebar-wrapper">
					<ul class="sidebar-nav">
						<li class="sidebar-brand">
							<a href="LeaveApplication.php" style="color:#DAA520;">Leave application</a>
						</li>
						<li>
							<a href="UserProfile.php">User Profile</a>
						</li>
						<li>
							<a href="ListOfUserBlood.php">Blood Group</a>
						</li>
						<li>
							<a href="../controller/LogoutController.php">Logout</a>
						</li>
					</ul>
				</div>
				<!-- /#sidebar-wrapper -->

				<!-- Page Content -->
				<div id="page-content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu Bar</a>
								<h1 align="center">Leave Application</h1>
								
								<?php
									if (isset($_SESSION['checkLeave']))
									{
										if($_SESSION['checkLeave'] == 1)
										{
											$empCodeName = $_SESSION['officeUserName'];
											$altEmpCodeName = $_SESSION['livAltEmpCode'];
											$empLeaveType = $_SESSION['livEmplivType'];
											$empLeaveReason = $_SESSION['livReason'];
											$empLeaveFrom = $_SESSION['livEmplivFrom'];
											$empLeaveTo = $_SESSION['livEmplivTo'];
											$empAddress = $_SESSION['livAddress'];
											$empLeaveDays = $_SESSION['LeaveDays'];
											
											unset($_SESSION['checkLeave']);
											unset($_SESSION['livAltEmpCode']);
											unset($_SESSION['livEmplivType']);
											unset($_SESSION['livReason']);
											unset($_SESSION['livEmplivFrom']);
											unset($_SESSION['livEmplivTo']);
											unset($_SESSION['livAddress']);
											unset($_SESSION['LeaveDays']);
											?>
											<form role="form" action="../controller/LeaveApplicationController.php" method="post" >
									
												<h3 align="center" class="text-warning">You Can Update Before Final Submission</h3>
												
												<div class="form-group">
											
													<label for="livDate">Date: </label>
													<input type="text" class="form-control" value="<?php echo date("l")." ".date("Y/m/d"); ?>" name="livDate" id="livDate" readonly>
												
												</div>
												
												<?php
													
													$objLeaveApplication = new LeaveApplication();
													$singleResult = $objLeaveApplication->getSingleEmpInfo($empCodeName);
													while ($empResult = mysqli_fetch_array($singleResult))
													{
													?>
													
												<div class="form-group">
											
													<label for="livEmpName">Employee Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eFirstName']." ".$empResult['eLastName']; ?>" name="livEmpName" id="livEmpName" readonly>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpCode">Employee Code Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eEmployeeCodeNumber']; ?>" name="livEmpCode" id="livEmpCode" readonly>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpDptName">Employee Department Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['dptName']; ?>" name="livEmpDptName" id="livEmpDptName" readonly>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpDesiName">Employee Designation Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['desiDesignationName']; ?>" name="livEmpDesiName" id="livEmpDesiName" readonly>
												
												</div>
												
												<?php
													}
												?>
												
												<div class="form-group">
										
												<label for="livType">Leave Type: </label>
												<?php
													
													$objLeaveApplication = new LeaveApplication();
													$singleResult = $objLeaveApplication->getLeaveType();
													while ($empResult = mysqli_fetch_array($singleResult))
													{
													?>
														<div class="radio">
															<label><input type="radio" name="livType" value="<?php echo $empResult['lId']; ?>" required><?php echo $empResult['lType']; ?></label>
														</div>
													<?php
													}
													?>
												</div>
												
												<div class="form-group">
											
													<label for="livEmpAddress">Contact Address During Leave: </label>
													<input type="text" class="form-control" value="<?php echo $empAddress; ?>" name="livEmpAddress" id="livEmpAddress" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpReason">Reason: </label>
													<input type="text" class="form-control" value="<?php echo $empLeaveReason; ?>" name="livEmpReason" id="livEmpReason" required>
												
												</div>
												
												
												
												<div class="form-group">
											
													<label for="livEmpFrom">From: </label>
													<input type="date" class="form-control" value="<?php echo $empLeaveFrom; ?>" name="livEmpFrom" id="livEmpFrom" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpTo">To: </label>
													<input type="date" class="form-control" value="<?php echo $empLeaveTo; ?>" name="livEmpTo" id="livEmpTo" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livEmpPeriod">Period of Days: </label>
													<input type="text" class="form-control" value="<?php echo $empLeaveDays; ?>" name="livEmpPeriod" id="livEmpPeriod" required>
												
												</div>
												
												<?php
													
													$objLeaveApplication = new LeaveApplication();
													$singleResult = $objLeaveApplication->getSingleEmpInfo($altEmpCodeName);
													while ($empResult = mysqli_fetch_array($singleResult))
													{
													?>
												
												<div class="form-group">
											
													<label for="livAltEmployeeCode">Alternative Employee Code Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eEmployeeCodeNumber']; ?>" name="livAltEmployeeCode" id="livAltEmployeeCode" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livAltEmpName">Alternative Employee Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['eFirstName']." ".$empResult['eLastName']; ?>" name="livAltEmpName" id="livAltEmpName" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livAltEmpDptName">Alternative Employee Department Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['dptName']; ?>" name="livAltEmpDptName" id="livAltEmpDptName" required>
												
												</div>
												
												<div class="form-group">
											
													<label for="livAltEmpDesiName">Alternative Employee Designation Name: </label>
													<input type="text" class="form-control" value="<?php echo $empResult['desiDesignationName']; ?>" name="livAltEmpDesiName" id="livAltEmpDesiName" required>
												
												</div>
												
												<?php
													}
												?>
												
												<button type="submit" name="btnFinalSubmit" class="btn">Apply</button>
											
											</form>
										<?php
										}
										else
										{
											//echo "hello";
											unset($_SESSION['checkLeave']);
											unset($_SESSION['livAltEmpCode']);
											unset($_SESSION['livEmplivType']);
											unset($_SESSION['livReason']);
											unset($_SESSION['livEmplivFrom']);
											unset($_SESSION['livEmplivTo']);
											unset($_SESSION['livAddress']);
											unset($_SESSION['LeaveDays']);
										}
									}
									else
									{
										?>
										<form role="form" action="../controller/LeaveApplicationController.php" method="post" >
								
											<?php
											
											if (isset($_SESSION['msgForApplication']))
											{
												if ($_SESSION['msgForApplication'] == 1)
												{												
													unset($_SESSION['msgForApplication']);
													?>
													<h3 align="center" class="text-success">Your Application Is Successfully Placed</h3>
													<div class="form-group">
										
														<label for="livAltEmpCode">Alternative Employee Code Name: </label>
														<input type="text" class="form-control" placeholder="Alternative Employee Code Name ...." name="livAltEmpCode" id="livAltEmpCode" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivType">Leave Type: </label>
														<?php
															
															$objLeaveApplication = new LeaveApplication();
															$singleResult = $objLeaveApplication->getLeaveType();
															while ($empResult = mysqli_fetch_array($singleResult))
															{
															?>
																<div class="radio">
																	<label><input type="radio" name="livEmplivType" value="<?php echo $empResult['lId']; ?>" required><?php echo $empResult['lType']; ?></label>
																</div>
															<?php
															}
															?>
													</div>
													
													<div class="form-group">
												
														<label for="livReason">Leave Reason: </label>
														<textarea class="form-control" rows="5" placeholder="Leave Reason ...." name="livReason" id="livReason"required></textarea>
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivFrom">From: </label>
														<input type="date" class="form-control" name="livEmplivFrom" id="livEmplivFrom" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivTo">To: </label>
														<input type="date" class="form-control" name="livEmplivTo" id="livEmplivTo" required>
													
													</div>
													
													<div class="form-group">
													
														<label for="livAddress">Contact Address During Leave: </label>
														<input type="text" class="form-control" placeholder="Address During Name ...." name="livAddress" id="livAddress" required>
													
													</div>
													
													<button type="submit" name="btnSubmit" class="btn">Apply</button>
												<?php
												}
												else
												{
													unset($_SESSION['msgForApplication']);
													//echo "hi";
												}
												
											}
											else
											{
												?>
													
													<div class="form-group">
										
														<label for="livAltEmpCode">Alternative Employee Code Name: </label>
														<input type="text" class="form-control" placeholder="Alternative Employee Code Name ...." name="livAltEmpCode" id="livAltEmpCode" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivType">Leave Type: </label>
														<?php
															
															$objLeaveApplication = new LeaveApplication();
															$singleResult = $objLeaveApplication->getLeaveType();
															while ($empResult = mysqli_fetch_array($singleResult))
															{
															?>
																<div class="radio">
																	<label><input type="radio" name="livEmplivType" value="<?php echo $empResult['lId']; ?>" required><?php echo $empResult['lType']; ?></label>
																</div>
															<?php
															}
															?>
													</div>
													
													<div class="form-group">
												
														<label for="livReason">Leave Reason: </label>
														<textarea class="form-control" rows="5" placeholder="Leave Reason ...." name="livReason" id="livReason"required></textarea>
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivFrom">From: </label>
														<input type="date" class="form-control" name="livEmplivFrom" id="livEmplivFrom" required>
													
													</div>
													
													<div class="form-group">
												
														<label for="livEmplivTo">To: </label>
														<input type="date" class="form-control" name="livEmplivTo" id="livEmplivTo" required>
													
													</div>
													
													<div class="form-group">
													
														<label for="livAddress">Contact Address During Leave: </label>
														<input type="text" class="form-control" placeholder="Address During Name ...." name="livAddress" id="livAddress" required>
													
													</div>
													
													<button type="submit" name="btnSubmit" class="btn">Apply</button>
													
												<?php
											}
												?>
												
										</form>
										<?php
									}
									
								?>
								
							</div>
						</div>
					</div>
				</div>
				<!-- /#page-content-wrapper -->

			</div>
			<!-- /#wrapper -->

			<!-- jQuery -->
			<script src="../assets/js/jquery.js"></script>

			<!-- Bootstrap Core JavaScript -->
			<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

			<!-- Menu Toggle Script -->
			<script>
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});
			</script>

		</body>

		</html>

		
		<?php
	}
	}
	else
	{
		header("Location:../");
	}

?>
