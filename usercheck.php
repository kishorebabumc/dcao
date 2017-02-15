<?php 
	include("config.php");
	$empid = $_POST["empid"];
	$sql = mysql_query("SELECT * FROM users WHERE EmpID='$empid'");
	$data = mysql_num_rows($sql);
	echo $data;	
?>