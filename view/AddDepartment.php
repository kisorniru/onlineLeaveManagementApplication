<?php include("../model/DepartmentModel.php");
	
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
							<a href="LeaveApplication.php">Leave application</a>
						</li>
						<li>
							<a href="UserProfile.php">User Profile</a>
						</li>
							<?php
							$objLeaveApplication = new Department();
							$result = $objLeaveApplication->getForRecomandationNumber();
							while($row = mysqli_fetch_array($result))
							{ 
							?>
						<li>
							<a href="Applications.php">Applications <span style="color:red"><?php if($row['COUNT(lIsRecomanded)'] != 0){ ?>[ New <?php echo $row['COUNT(lIsRecomanded)']; ?> ]<?php } ?></span></a>
						</li>
							<?php
							}
							$objLeaveApplication = new Department();
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
							<a style="color:#DAA520;" href="AddDepartment.php">Add Department</a>
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
								<h1 align="center">Department</h1>
								<form role="form" action="../controller/AddDepartmentController.php" method="post" >
									
									<div class="form-group">
								
										<label for="dptName">Department Name: </label>
										<input type="text" class="form-control" placeholder="Department Name ...." name="dptName" id="dptName" required>
									
									</div>
								
									<button type="submit" name="btnSubmit" class="btn">Add Department</button>
								
								</form>
								<?php
								
									if (isset($_SESSION['msgForDptCreate']))
									{
										if ($_SESSION['msgForDptCreate'] == 1)
										{												
											unset($_SESSION['msgForDptCreate']);
											?>
											<h3 align="center">Department Created Successfully</h3>
										
											<div class="table-responsive">
											
												<table class="table table-bordered table-hover table-striped">
												
													<thead>
													
														<tr class="success">
															<th>Serial Number</th>
															<th>Department Name</th>
														</tr>
														
													</thead>
													
													<tbody>
													
														<?php
														$objDepartment = new Department();
														$Desc = "DESC";
														$result = $objDepartment->getAllDpt($Desc);
														while($row = mysqli_fetch_array($result))
														{ 
														?>
															<tr>
																<td><?php echo $row['dptId'] ?></td>
																<td><?php echo $row['dptName'] ?></td>
															</tr>
														<?php
														}
														?>
														
													</tbody>
													
												</table>
												
											</div>	
											
											<?php
										}
										else
										{
											unset($_SESSION['msgForDptCreate']);
											?>
											<?php
										}
									}
									else
									{
										?>
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
		header("Location:../view/LeaveApplication.php");
	}
	}
	else
	{
		header("Location:../");
	}
?>