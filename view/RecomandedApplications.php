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
                    <a style="color:#DAA520;" href="RecomandedApplications.php">Recomanded Applications<span style="color:red"><?php if($row['COUNT(lIsRecomanded)'] != 0){ ?> [ New <?php echo $row['COUNT(lIsRecomanded)']; ?> ]<?php } ?></span></a>
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
                        <h1 align="center">List of Application</h1>
						
						<form role="form" action="../controller/LeaveApplicationController.php" method="post" >
							
							<?php
								
								if(isset($_SESSION['livApplicationDetailsForOneUserId']))
								{
									$applicantUserId = $_SESSION['livApplicationDetailsForOneUserId'];
									//echo $applicantUserId;
									$applicantUserCodeNumber = $_SESSION['livApplicationDetailsForOneUserCode'];
									//echo $applicantUserCodeNumber;
									
									unset($_SESSION['livApplicationDetailsForOneUserId']);
									unset($_SESSION['livApplicationDetailsForOneUserCode']);
									
									$objLeaveApplication = new LeaveApplication();
									$livHistory = $objLeaveApplication->getAllleaveHistory($applicantUserCodeNumber);
									while($historyForLeave = mysqli_fetch_array($livHistory))
									{
										echo "<br/><span style='color:#DAA520;' class='glyphicon glyphicon-road'></span> You were in Leave from <b style='color:#DAA520;'>".$historyForLeave['lLeaveFromDate']."</b> To <b style='color:#DAA520;'>".$historyForLeave['lLeaveToDate']."</b>. Total <b style='color:#DAA520;'>".$historyForLeave['lTotalLeaveDays']."</b> Days.<br/>";
									}
									
									?>
									<div class="table-responsive col-md-6">
						
										<table class="table table-bordered table-hover table-striped">
										
											<thead>
											
												<tr class="success">
													<th>Leave Name</th>
													<th>CL</th>
													<th>SL</th>
													<th>EL</th>
													<th>ML</th>
													<th>Total</th>
												</tr>
												
											</thead>
											
											<tbody>
												
												<tr>
													<td>Leave Due</td>
													<?php
													$livLeaveIdForCl = 1;
													$objLeaveApplication = new LeaveApplication();
													$result1 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result1; ?></td>
													<?php
													$livLeaveIdForCl = 2;
													$objLeaveApplication = new LeaveApplication();
													$result2 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result2; ?></td>
													<?php
													$livLeaveIdForCl = 3;
													$objLeaveApplication = new LeaveApplication();
													$result3 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result3; ?></td>
													<?php
													$livLeaveIdForCl = 4;
													$objLeaveApplication = new LeaveApplication();
													$result4 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result4; ?></td>
													<td><?php echo $result1+$result2+$result3+$result4; ?></td>
												</tr>
												<tr>
													<td>Leave Requested For</td>
													<?php
													$livLeaveIdForCl = 1;
													$objLeaveApplication = new LeaveApplication();
													$result1 = $objLeaveApplication->leaveRequest($applicantUserId,$livLeaveIdForCl);
													?>
													<td><?php echo $result1; ?></td>
													<?php
													$livLeaveIdForCl = 2;
													$objLeaveApplication = new LeaveApplication();
													$result2 = $objLeaveApplication->leaveRequest($applicantUserId,$livLeaveIdForCl);
													?>
													<td><?php echo $result2; ?></td>
													<?php
													$livLeaveIdForCl = 3;
													$objLeaveApplication = new LeaveApplication();
													$result3 = $objLeaveApplication->leaveRequest($applicantUserId,$livLeaveIdForCl);
													?>
													<td><?php echo $result3; ?></td>
													<?php
													$livLeaveIdForCl = 4;
													$objLeaveApplication = new LeaveApplication();
													$result4 = $objLeaveApplication->leaveRequest($applicantUserId,$livLeaveIdForCl);
													?>
													<td><?php echo $result4; ?></td>
													<td><?php echo $result1+$result2+$result3+$result4; ?></td>
												</tr>
												<tr>
													<td>Leave Balance</td>
													<?php
													$livLeaveIdForCl = 1;
													$objLeaveApplication = new LeaveApplication();
													$result1 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result1; ?></td>
													<?php
													$livLeaveIdForCl = 2;
													$objLeaveApplication = new LeaveApplication();
													$result2 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result2; ?></td>
													<?php
													$livLeaveIdForCl = 3;
													$objLeaveApplication = new LeaveApplication();
													$result3 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result3; ?></td>
													<?php
													$livLeaveIdForCl = 4;
													$objLeaveApplication = new LeaveApplication();
													$result4 = $objLeaveApplication->leaveDue($applicantUserCodeNumber,$livLeaveIdForCl);
													?>
													<td><?php echo $result4; ?></td>
													<td><?php echo $result1+$result2+$result3+$result4; ?></td>
												</tr>
												
											</tbody>
											
										</table>
										
									</div>
									
									<?php
										
										if(isset($_SESSION['applicationUpdate']))
										{
											unset($_SESSION['applicationUpdate']);
											?>
											
											<h3 align="center" class="text-danger">Updated Successfully</h3>
											
											<div class="form-horizontal col-md-6">
										
												<div class="form-group col-md-12">
										
													<label class="col-sm-6 control-label" for="userLeaveType">Leave Type : </label>
													<div class="col-sm-6 radio">
														<?php
														$objLeaveApplication = new LeaveApplication();
														$singleResult = $objLeaveApplication->getLeaveType();
														while ($empResult = mysqli_fetch_array($singleResult))
														{
														?>
															<label><input type="radio" name="userLeaveType" id="userLeaveType" value="<?php echo $empResult['lId']; ?>"><?php echo $empResult['lType']; ?></label></br>
														<?php
														}
														?>
													</div>
													
												</div>
												
												<div class="form-group col-md-12">
											
													<label class="col-sm-6 control-label" for="userLeaveFrom">Leave From : </label>
													<div class="col-sm-6">
														<input type="date" class="form-control" value="<?php  ?>" name="userLeaveFrom" id="userLeaveFrom" required>
													</div>
													
												</div>
												
												<div class="form-group col-md-12">
											
													<label class="col-sm-6 control-label" for="userLeaveTo">Leave To : </label>
													<div class="col-sm-6">
														<input type="date" class="form-control" value="<?php  ?>" name="userLeaveTo" id="userLeaveTo" required>
													</div>
													
												</div>
												
												<h3 align="center"><button type="submit" value="<?php echo $applicantUserId; ?>" name="btnUserLeaveApplicationUpdate" class="btn btn-success">Update</button></h3>
												
											</div>
											
											<?php
										}
										else
										{
										
											?>
											
											<div class="form-horizontal col-md-6">
												
												<div class="form-group col-md-12">
										
													<label class="col-sm-6 control-label" for="userLeaveType">Leave Type : </label>
													<div class="col-sm-6 radio">
														<?php
														$objLeaveApplication = new LeaveApplication();
														$singleResult = $objLeaveApplication->getLeaveType();
														while ($empResult = mysqli_fetch_array($singleResult))
														{
														?>
															<label><input type="radio" name="userLeaveType" id="userLeaveType" value="<?php echo $empResult['lId']; ?>"><?php echo $empResult['lType']; ?></label></br>
														<?php
														}
														?>
													</div>
													
												</div>
												
												<div class="form-group col-md-12">
											
													<label class="col-sm-6 control-label" for="userLeaveFrom">Leave From : </label>
													<div class="col-sm-6">
														<input type="date" class="form-control" value="<?php  ?>" name="userLeaveFrom" id="userLeaveFrom" required>
													</div>
													
												</div>
												
												<div class="form-group col-md-12">
											
													<label class="col-sm-6 control-label" for="userLeaveTo">Leave To : </label>
													<div class="col-sm-6">
														<input type="date" class="form-control" value="<?php  ?>" name="userLeaveTo" id="userLeaveTo" required>
													</div>
													
												</div>
												
												<h3 align="center"><button type="submit" value="<?php echo $applicantUserId; ?>" name="btnUserLeaveApplicationUpdate" class="btn btn-success">Update</button></h3>
												
											</div>
											
											
											<?php
										}
								}
								else
								{
									?>
									<?php
								}
								
							?>
						</form>
						
						</div>
					
				</div>
				
				<div class="row">
				
                    <div class="col-lg-12">
						
                        <form role="form" action="../controller/LeaveApplicationController.php" method="post" >
						
							<div class="table-responsive">
								
								<table class="table table-bordered table-hover table-striped">
								
									<thead>
									
										<tr class="success">
											<th>Apply Date</th>
											<th>Name</th>
											<th>Leave From</th>
											<th>Leave To</th>
											<th>Apply For</th>
											<th>Leave Type</th>
											<th>Total Remain Days</th>
											<th>Action</th>
										</tr>
										
									</thead>
									
									<tbody>
									
										<?php
										$objLeaveApplication = new LeaveApplication();
										$result = $objLeaveApplication->getRecomandedApplication();
										while($row = mysqli_fetch_array($result))
										{ 
										?>
											<tr>
												<td><?php echo $row['lApplyDate'] ?></td>
												<td><?php echo $row['eFirstName']." ".$row['eLastName'] ?></td>
												<td><?php echo $row['lLeaveFromDate'] ?></td>
												<td><?php echo $row['lLeaveToDate'] ?></td>
												<td><?php echo $row['lTotalLeaveDays'] ?> Days</td>
												<td><?php echo $row['lType'] ?></td>
												<td><?php echo $row['lTotalLeaveDaysRemain'] ?></td>
												<td><button type="submit" value="<?php echo $row['lId'] ?>" name="btnApproved" class="btn btn-success">Approved</button>  <button type="submit" value="<?php echo $row['lId'] ?>" name="btnApplicationDetailsBeforeApprove" class="btn btn-info">Details</button>  <button type="submit" value="<?php echo $row['lId'] ?>" name="btnNotApproved" class="btn btn-danger">Sorry</button></td>
											</tr>
										<?php
										}
										?>
										
									</tbody>
									
								</table>
								
							</div>
							
						</form>
						
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