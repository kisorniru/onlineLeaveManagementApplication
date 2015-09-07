<?php include("../model/EmployeeModel.php");

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
					$objLeaveApplication = new Employee();
					$result = $objLeaveApplication->getForRecomandationNumber();
					while($row = mysqli_fetch_array($result))
					{ 
					?>
                <li>
                    <a href="Applications.php">Applications <span style="color:red"><?php if($row['COUNT(lIsRecomanded)'] != 0){ ?>[ New <?php echo $row['COUNT(lIsRecomanded)']; ?> ]<?php } ?></span></a>
                </li>
					<?php
					}
					$objLeaveApplication = new Employee();
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
                    <a style="color:#DAA520;" href="UsersLeaveDetails.php">User's Leave Details</a>
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
						<?php
							
							if(isset($_GET['cat']))
							{
								$applicantUserCodeNumber = $_GET['cat'];
						?>
							<h1 align="center">Leave History For : <?php echo $_GET['cat']; ?></h1>
						<?php
							}
							else
							{
								?>
									<h1 align="center">Leave History</h1>
								<?php
							}
						?>
						<div class="table-responsive">
							
							<table class="table table-bordered table-hover table-striped">
							
								<thead>
								
									<tr class="success">
										<th>From</th>
										<th>To</th>
										<th>Total</th>
									</tr>
									
								</thead>
								
								<tbody>
								
									<?php
									if(isset($applicantUserCodeNumber))
									{
										$objDepartment = new Employee();
										$result = $objDepartment->getAllleaveHistoryForOneUser($applicantUserCodeNumber);
										if(mysqli_fetch_array($result) != null)
										{
											$objDepartment = new Employee();
											$result = $objDepartment->getAllleaveHistoryForOneUser($applicantUserCodeNumber);
											while($row = mysqli_fetch_array($result))
											{
											?>
												<tr>
													<td><?php echo $row['lLeaveFromDate'] ?></td>
													<td><?php echo $row['lLeaveToDate'] ?></td>
													<td><?php echo $row['lTotalLeaveDays'] ?> Days</td>
												</tr>
											<?php
											}
										}
										else
										{
											?>
												<tr>
													<td colspan="3"><center><b style="color:red; font-size: 20px;"><i>" This user didn't take leave yet using this system "</i></b></center></td>
												</tr>
											<?php
										}
									}
									else
									{
										?>
											<tr>
												<td colspan="3"><center><b style="color:Green; font-size: 20px;"><i>" <a href="../view/ListEmployee.php">Go back </a> and select one user first "</i></b></center></td>
											</tr>
										<?php
									}
										?>
									
								</tbody>
								
							</table>
							
						</div>
						
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