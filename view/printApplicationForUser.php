<?php include("../model/LeaveApplicationModel.php"); ?>
<?php
	
	if(isset($_SESSION['livApplicationId']))
	{
	?>
<!DOCTYPE html>
<html>

   <head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Leave Application</title>

		<!-- Custom CSS -->
		<link href="../assets/css/application.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
			window.print();
		</script>
		
   </head>
   
   <body>
      
		<form>
			
			<table class="tableNoOne">
				<tr>
					<td class="tdStyleForImage"><img src="../assets/img/images/logo.png"></td>
					<td><center>57, Shaheed shurawardi Anenue, Baridhara, Dhaka-1212<br><br><b>Leave Application</b></center></td> 
					<td class="tdStyleForImage"><img src="../assets/img/images/blank.png"></td>
				</tr>
			</table>
			<br>
			<table class="tableNoTwo">
				<tr>
				</tr>
				<tr>
				</tr>
				<tr>
					<td style="text-decoration: underline;"><b>To the filled by the Aplicant:</b></td>
					<td><span class="alignLeft">Date: ... ... ... <?php echo date("Y/m/d"); ?></span></td>
				</tr>
			</table>
			<br>
			<table class="tableNoTwo">
				<tr>
					<td class="tableNoThreeOne">
						<TABLE class="tableNofour">
							
							<?php
								
								$empId = $_SESSION['livApplicationId'];
								//echo $empId;
								//unset($_SESSION['livApplicationId']);
								
								$objLeaveApplication = new LeaveApplication();
								$result = $objLeaveApplication->empLastApplicationInfo($empId);
								while($row = mysqli_fetch_array($result))
								{
									$applicantUserCodeNumber = $row['lEmployeeCodeNumberWhoApply'];
								
							?>
							
							<TR>
								<TD class="tdStyleNoUnderLine">Name</TD>
								<TD>: <?php echo $row['eFirstName']." ".$row['eLastName'] ?></TD>
							</TR>
								
							<TR>
								<TD class="tdStyleNoUnderLine">Code No.</TD>
								<TD>: <?php echo $row['lEmployeeCodeNumberWhoApply'] ?></TD>
							</TR>
							
							<TR>
								<TD class="tdStyleNoUnderLine">Department</TD>
								<TD>: <?php echo $row['dptName'] ?></TD>
							</TR>
							<TR>
								<TD class="tdStyleNoUnderLine">Designation</TD>
								<TD>: <?php echo $row['desiDesignationName'] ?></TD>
							</TR>
					   </TABLE>
					</td>
					<td class="tableNoThreeTwo">
						<TABLE class="tableNofour">
							<TR>
								<TD class="tdStyleNoUnderLine">Period of Days</TD>
								<TD>: <?php echo $row['lTotalLeaveDays'] ?> Days</TD>
							</TR>
							<TR>
								<TD class="tdStyleNoUnderLine">From : <?php echo $row['lLeaveFromDate'] ?></TD>
								<TD>To : <?php echo $row['lLeaveToDate'] ?></TD>
								
							</TR>
							<TR>
								<TD class="tdStyleNoUnderLine">Reasons : </TD>
								<TD>: <?php echo $row['lLeaveReason'] ?></TD>
							</TR>
							<TR>
							</TR>
					   </TABLE>
					</td>
				</tr>
			</table>
			<br>
			<table class="tableNoTwo">
				<tr>
					<td class="tableNoThreeOne">
						<TABLE class="tableNofour">
							<TR>
								<TD class="tdStyleNoUnderLine">Description of Leave<br>(Please Mark)</TD>
								<TD class="tdStyleNoUnder">: Casual Leave</TD>
								<TD>
								<?php 
								if($row['lLeaveId'] == 1) 
								{ ?>
									<img src="../assets/img/images/boxClicked.png">
								</TD>
								<?php
								}
								else
								{ ?>
								<img src="../assets/img/images/box.png"></TD>
								<?php
								}
								?>
							</TR>
							<TR>
								<td rowspan="3" ></td>
								<TD class="tdStyleNoUnder">: Sick Leave</TD>
								<TD>
								<?php 
								if($row['lLeaveId'] == 2) 
								{ ?>
									<img src="../assets/img/images/boxClicked.png">
								</TD>
								<?php
								}
								else
								{ ?>
								<img src="../assets/img/images/box.png"></TD>
								<?php
								}
								?>
							</TR>
							<TR>
								<TD class="tdStyleNoUnder">: Earn Leave</TD>
								<TD>
								<?php 
								if($row['lLeaveId'] == 3) 
								{ ?>
									<img src="../assets/img/images/boxClicked.png">
								</TD>
								<?php
								}
								else
								{ ?>
								<img src="../assets/img/images/box.png"></TD>
								<?php
								}
								?>
							</TR>
							<TR>
								<TD class="tdStyleNoUnder">: Maternity Leave</TD>
								<TD>
								<?php 
								if($row['lLeaveId'] == 4) 
								{ ?>
									<img src="../assets/img/images/boxClicked.png">
								</TD>
								<?php
								}
								else
								{ ?>
								<img src="../assets/img/images/box.png"></TD>
								<?php
								}
								?>
							</TR>
					   </TABLE>
					</td>
					<td class="tableNoThreeTwo">
						<TABLE class="tableNofour">
							<TR>
								<td class="tdStyle" rowspan="4" ></td>
								<TD><br></TD>
							</TR>
							<TR>
								<TD>&nbsp;</TD>
							</TR>
							<TR>
								<TD>&nbsp;</TD>
							</TR>
							<TR>
								<TD><span class="alignLeft">------------------------------<br><center>Applicant Signature</center><span></TD>
							</TR>
					   </TABLE>
					</td>
				</tr>
			</table>
			<br>
			<table class="tableNoTwo">
				<tr>
					<td class="tableNoThreeOne">
						<TABLE class="tableNofour">
							<TR>
								<TD class="tdStyle" colspan="2">Contact Address/Telephone number during leave</TD>
								
							</TR>							
							<TR>
								<TD class="tdStyleNoUnderLine">Personal</TD>
								<TD>: <?php echo $row['ePhoneNumberPersonal'] ?></TD>
							</TR>							
							<TR>
								<TD class="tdStyleNoUnderLine">Office</TD>
								<TD>: <?php echo $row['ePhoneNumberOffice'] ?></TD>
							</TR>
							<TR>
								<TD class="tdStyleNoUnderLine">Address</TD>
								<TD>: <?php echo $row['lEmployeeImargencyAddress'] ?></TD>
							</TR>
							<?php
								}
								?>
					   </TABLE>
					</td>
					<td class="tableNoThreeTwo">
						
					</td>
				</tr>
			</table>
			<br>
			<table class="tableNoTwo">
				<tr>
					<td class="tableNoThreeOne">
						<TABLE class="tableNofour">
							
							<?php
								
								$objLeaveApplication = new LeaveApplication();
								$result = $objLeaveApplication->AppliedEmpAlternativeEmpDetailsInfo($empId);
								while($row = mysqli_fetch_array($result))
								{
								
							?>
							
							<TR>
								<TD class="tdStyle" colspan="2">Person to look after my desk during my absence</TD>
								
							</TR>
							<tr>
								<TD>&nbsp;</TD>
							</tr>
							
							<TR>
								<TD class="tdStyleNoUnderLine">Name</TD>
								<TD>: <?php echo $row['eFirstName']." ".$row['eLastName'] ?></TD>
							</TR>
							<TR>
								<TD class="tdStyleNoUnderLine">Designation</TD>
								<TD>: <?php echo $row['dptName'] ?></TD>
							</TR>
							<TR>
								<TD class="tdStyleNoUnderLine">Department</TD>
								<TD>: <?php echo $row['desiDesignationName'] ?></TD>
							</TR>
							<?php
								}
								?>
					   </TABLE>
					</td>
					<td class="tableNoThreeTwo">
						<TABLE class="tableNofour">
							<TR>
								<td class="tdStyle" rowspan="4" ></td>
								<TD><br></TD>
							</TR>
							<TR>
								<TD>&nbsp;</TD>
							</TR>
							<TR>
								<TD>&nbsp;</TD>
							</TR>
							<TR>
								<TD><span class="alignLeft">------------------------------<br><center>Signature</center><span></TD>
							</TR>
					   </TABLE>
					</td>
				</tr>
			</table>
			<br>
			<table class="tableNoTwo">
				<tr>
					<td class="tableNoThreeOne">
						<TABLE class="tableNofour">
							
							<TR>
								<TD>&nbsp;</TD>
							</TR>
							<TR>
								<TD><span class="alignRight">------------------------------<br><center>Recommended by</center><span></TD>
								<td class="tdStyle" rowspan="4" ></td>
							</TR>
					   </TABLE>
					</td>
					<td class="tableNoThreeTwo">
						<TABLE class="tableNofour">
							<TR>
								<td class="tdStyle" rowspan="4" ></td>
								<TD><br></TD>
							</TR>
							<TR>
								<TD><span class="alignLeft">------------------------------<br><center>Head of Department</center><span></TD>
							</TR>
					   </TABLE>
					</td>
				</tr>
			</table>
			
			<hr class="hrLength">
			
			<b><center>For office use only</center></b></p>
			
			
			
			<table class="tableNoTwo">
				<tr>
					<td class="tableNoThreeOne">
						<TABLE class="tableNoSix">
							<TR>
								<td>Leave Name</td>
							</TR>
							<TR>
								<TD>Leave due</TD>
							</TR>
							<TR>
								<TD>Leave Requested for</TD>
							</TR>
							<TR>
								<TD>Leave Balance</TD>
							</TR>
					   </TABLE>
					</td>
					
					<td class="tableNoThreeOne">
						<TABLE class="border">
							<TR>
								<td class="border">CL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td class="border">SL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td class="border">EL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td class="border">ML&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td class="border">Total&nbsp;&nbsp;&nbsp;</td>
							</TR>
							<TR>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
							</TR>
							<TR>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
							</TR>
							<TR>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
								<td class="border">&nbsp;</td>
							</TR>
					   </TABLE>
						
					</td>
					
					<td class="tableNoThreeTwo">
						
					</td>
					
				</tr>
			</table>
			<br>
			<br>
			<table class="tableNoTwo">
				<tr>
					<td class="tableNoThreeOne">
						<TABLE class="tableNofour">
							
							<TR>
								<TD><span class="alignRight">------------------------------<br><center>HR Department</center><span></TD>
								
							</TR>
					   </TABLE>
					</td>
					<td class="tableNoThreeTwo">
						<TABLE class="tableNofour">
							
							<TR>
								<TD><span class="alignLeft">------------------------------<br><center>Approved By</center><span></TD>
							</TR>
					   </TABLE>
					</td>
				</tr>
			</table>
			
		</form>
   
   </body>
   
<html>
<?php
	
	unset($_SESSION['livApplicationId']);
	$_SESSION['msgForApplication'] = 1;
	
	}
	else
	{
		header("Location:../view/LeaveApplication.php");
	}
?>