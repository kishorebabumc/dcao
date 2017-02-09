<?php
	include("config.php");
	session_start();
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM users WHERE userid = '$user'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$loginuser = $row['userid'];
	if(!isset($loginuser)){
		header("location:sesexp.html");
	}	
?>