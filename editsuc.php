<?php
	include("session.php");
	include("sidepan.html");	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$empid = $_POST['empid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$sname = $_POST['sname'];
		$subdivid = $_POST['SubDivID'];
		$degid = $_POST['DegID'];
		$doj = $_POST['doj'];
		$rem = $_POST['rem'];
		$test = mysql_query("SELECT * FROM empmonitoring WHERE EmpID='$empid' AND Status = 1");
		$count = mysql_num_rows($test);
		$result = mysql_fetch_assoc($test);
		
		$sql1 = mysql_query("SELECT * FROM designations WHERE ID = '$degid' ");
		$row1 = mysql_fetch_assoc($sql1);
		$sql2 = mysql_query("SELECT * FROM subdivision WHERE ID = '$subdivid' ");		
		$row2 = mysql_fetch_assoc($sql2);
		if($count == 1){
			$sql = mysql_query("UPDATE empmonitoring SET DOL ='$doj', Rem ='$rem', Status=0 WHERE EmpID='$empid' AND Status = 1");
			$sql = mysql_query("INSERT INTO `empmonitoring` (`ID`, `EmpID`, `SubDivID`, `DegID`, `DOJ`, `DOL`, `Rem`, `Status`) VALUES (NULL, '$empid', '$subdivid', '$degid', '$doj', '', 'Joined', 1)") or die(mysql_error());
						
		}
		else {
			$sql = mysql_query("INSERT INTO `empmonitoring` (`ID`, `EmpID`, `SubDivID`, `DegID`, `DOJ`, `DOL`, `Rem`, `Status`) VALUES (NULL, '$empid', '$subdivid', '$degid', '$doj', '', 'Joined', 1)") or die(mysql_error());
			$sql3 = mysql_query("INSERT INTO `users` (`id`, `userid`, `password`, `role`,`status`) VALUES (NULL, '$empid', '123456','2','1')");
		}		
	}
	else {
		header("location:admin.php");
	}	
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Audit Programme Management Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
    <!-- left side start-->
		
		<!-- left side end-->
    
		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->
			<!--notification menu start -->
				<div class="menu-right">
					<div class="user-panel-top">  						
						<div class="profile_details">		
							<ul>
								<li class="dropdown profile_details_drop">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<div class="profile_img">											
											 <div class="user-name">
												<p>Administrator<span><?php echo $_SESSION['user'];?></span></p>
											 </div>
											 <i class="lnr lnr-chevron-down"></i>
											 <i class="lnr lnr-chevron-up"></i>
											<div class="clearfix"></div>	
										</div>	
									</a>
									<ul class="dropdown-menu drp-mnu">
										<li> <a href="changepass.php"><i class="fa fa-cog"></i> Change Password</a> </li> 									
										<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
									</ul>
								</li>
								<div class="clearfix"> </div>
							</ul>
						</div>		
						
						<div class="clearfix"></div>
					</div>
				</div>
			<!--notification menu end -->
			</div>
			<div class="panel-body panel-body-inputin">
				<h3 class="blank1" style="color:green">Employee Successfully Edited</h3>	
				<div class="row">		
					<div class="form-group">	
						<label class="col-md-1">Employee ID</label>
						<div class="col-md-2"><?php echo $empid; ?> </div>						
						<label class="col-md-1">Employee Name</label>
						<div class="col-md-2"><?php echo $fname." ".$lname." ".$sname; ?> </div>						
						<label class="col-md-1">Designation</label>
						<div class="col-md-2"><?php echo $row1['Designation']; ?> </div>
						<label class="col-md-1">Sub Division</label>
						<div class="col-md-2"><?php echo $row2['SubDiv']; ?> </div>						
					</div>	
				</div>
				<div class="row">
					<div class="form-group">
						<label class="col-md-1">Date of Joining</label>
						<div class="col-md-2"><?php echo $doj; ?> </div>						
						<div class="col-md-4"><button class ="btn btn-primary" onclick="window.location.href='/dcao/admin.php'"> Home </button> </div>
					</div>
				</div>	
			</div>			
		</div>
		<!-- //header-ends -->
			
        <!--footer section start-->
		<footer>
		   <p>Designed and Developed by V Kishore Babu <a href="https://w3layouts.com/" target="_blank"></a></p>
		</footer>
        <!--footer section end-->

      <!-- main content end-->
   </section>  
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>