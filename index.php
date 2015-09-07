<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Leave Application</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
							<?php
								if(isset($_SESSION["LoginError"]))
								{
									if($_SESSION["LoginError"] == 1)
									{
										?>
											<form role="form" action="controller/LoginController.php" method="post" class="login-form">
												<div class="form-group">
													<label class="sr-only" for="form-username">Office Code</label>
													<input type="text" name="officeUserCode" placeholder="Administrator" class="form-username form-control" id="form-username">
												</div>
												<div class="form-group">
													<label class="sr-only" for="form-password">Password</label>
													<input type="password" name="officeUserPass" placeholder="admin" class="form-password form-control" id="form-password">
												</div>
												<button type="submit" name="btnSubmit" class="btn">Sign in!</button>
												<h3 align="center">Are You Sure about your office code and password</h3>
												<h3 align="center"><a href = "view/recoverPassword.php">Forget Password</a></h3>
											</form>
											
										<?php
										unset($_SESSION["LoginError"]);
									}
									unset($_SESSION["LoginError"]);
								}
								else
								{
									?>
										
										<form role="form" action="controller/LoginController.php" method="post" class="login-form">
											<div class="form-group">
												<label class="sr-only" for="form-username">Office Code</label>
												<input type="text" name="officeUserCode" placeholder="Administrator" class="form-username form-control" id="form-username">
											</div>
											<div class="form-group">
												<label class="sr-only" for="form-password">Password</label>
												<input type="password" name="officeUserPass" placeholder="admin" class="form-password form-control" id="form-password">
											</div>
											<button type="submit" name="btnSubmit" class="btn">Sign in!</button>
											<h3 align="center"><a href = "view/recoverPassword.php">Forget Password</a></h3>
										</form>
										
									<?php
								}
							?>
			                    
		                    </div>
							
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>