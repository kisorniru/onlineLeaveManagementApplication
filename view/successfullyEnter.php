<?php session_Start(); ?>

<!DOCTYPE html>
<html>
	
	<head>
		
	</head>
	
	<body style="background-image:url(../assets/img/images/pageFound.jpg);background-repeat:no-repeat;background-position:50% -30%;">
		
		<h1>Hello <?php echo $_SESSION['officeUserName']; ?></h1>
		
	</body>
	
</html>
