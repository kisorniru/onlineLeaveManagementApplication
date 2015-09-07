
<?php

	session_start();
	session_unset();
	header('Cache-Control: no-cache, must-revalidate');
	header("Location:../");
	
?>