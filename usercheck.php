<?php 
	include("config.php");
	session_start();
	if(isset($_POST['empid'])){
		$empid = $_POST['empid'];
		$sql = mysql_query("SELECT * FROM emprofile WHERE EmpID='$empid'");
		if(mysql_num_rows($sql)){
			echo 1;			
		}
		else {
			echo 0;
		}		
	}	
		
?>