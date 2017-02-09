<?php
	include("config.php");
	session_start();
	$error = " ";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$sql = "SELECT * FROM users WHERE userid='$username' AND password='$password'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		
		if($count == 1){
			$row = mysql_fetch_assoc($result);
			$_SESSION['user']= $row['userid'];
			header("location:admin.php");
		}
		else {
			$error = "Invalid Username and Password";
		}
	}
?>
<!DOCTYPE html>
<html land ="en">
	<head>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="css/dcao.css" rel="stylesheet">
		<title>Audit Programme Dashboard</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-offset-5 col-md-3">
					<div class="form-login">
						<form action="" method="post">
						<h4>Welcome back, <br> Audit Management Software</h4>
						<input type="text" name="user" class="form-control input-sm chat-input" placeholder="Username" autocomplete="off" /></br>
						<input type="password" name="pass" class="form-control input-sm chat-input" placeholder="Password" /></br>
						<div class="wrapper">
							<div><p style="font-family:Roboto; color:Red; font-size: 12px;"> <?php echo $error; ?> </p></div>
							<span class="group-btn">     
								<button type ="submit" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
							</span>
						</div>
						</form>						
					</div>
				
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>	
	