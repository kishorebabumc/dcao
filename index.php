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
			if($row['role'] == 1){				
				$_SESSION['user']= $row['userid'];
				header("location:admin.php");
			}
			else {
				header("location:auditors.php");
			}
		}
		else {
			$error = "Invalid Username and Password";
		}
	}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Audit Programme Management Portal</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style1.css">

  
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Audit Programme</h1><span>Management Portal by <a href=''>Kishore Babu</a></span>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class=""></i>
    
  </div>
  <div class="form">
    <h2>Login to your account</h2>
    <form action="" method="post">
      <input type="text" name="user" placeholder="Username" autocomplete="off"/>
      <input type="password" name="pass" placeholder="Password"/>
      <button>Login</button>
    </form>
  </div>
  
  <div class="form">
    <h2>Designed and Developed by Kishore Babu, Junior Inspector</h2>
  </div>
  <div class="cta" style = "color:red"><?php echo $error; ?></div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


    <script src="js/index1.js"></script>

</body>
</html>
