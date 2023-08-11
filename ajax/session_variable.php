<?php 
	session_start();
	if(isset($_POST['hash']))
	{
		
		$package=$_POST['package'];
		$plan=$_POST['plan'];
		$_SESSION['package']=$package;
		$_SESSION['plan']=$plan;
		echo "0";
	}
?>