<?php
	include("session.php");
	include("sidepan.html");
	if(isset($_GET['empid'])){
		$_SESSION['temp'] = $_GET['empid'];
	}
	if(isset($_SESSION['temp'])){		
		$empid = $_SESSION['temp'];					
		$desig = mysql_query("SELECT * FROM designations") or die(mysql_error());
		$subdiv = mysql_query("SELECT * FROM subdivision") or die(mysql_error());
		$sql = mysql_query("SELECT * FROM emprofile WHERE EmpID = '$empid'");	
		$empdata = mysql_fetch_assoc($sql);
		$sql = mysql_query("SELECT * FROM empmonitoring WHERE EmpID='$empid' AND Status = 1");
		$workdata = mysql_fetch_assoc($sql);
		$degid = $workdata['DegID'];
		$subid = $workdata['SubDivID'];
		$sql = mysql_query("SELECT * FROM designations WHERE ID='$degid'");
		$currentdesig = mysql_fetch_assoc($sql);	
		$sql = mysql_query("SELECT * FROM subdivision WHERE ID='$subid'");
		$currentsubdiv = mysql_fetch_assoc($sql);
		unset($_SESSION['temp']);
	}
	else{
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
				<h3 class="blank1">Edit Employee</h3>
				<form role="form" class="form-horizontal" action="editsuc.php" method="post">			
					<div class="form-group">
						<label class="col-md-1">Employee ID</label>
						<div class="col-md-2"><?php echo $empid; ?> </div>
						<label class="col-md-1">Employee Name</label>
						<div class="col-md-2">
							<?php echo $empdata['Fname']." ".$empdata['Lname']." ".$empdata['Sname']; ?>
							<input type = "hidden" value = "<?php echo $empid; ?>" name ="empid">
							<input type = "hidden" value = "<?php echo $empdata['Fname']; ?>" name ="fname">
							<input type = "hidden" value = "<?php echo $empdata['Lname']; ?>" name ="lname">
							<input type = "hidden" value = "<?php echo $empdata['Sname']; ?>" name ="sname">
						</div>
						
						<label class="col-md-1">Designation</label>
						<div class="col-md-2">
							<select name="DegID" class="form-control1">		
								<option value = "<?php echo $currentdesig['ID']; ?> "> <?php echo $currentdesig['Designation']; ?></option>
								<?php while ($row1 = mysql_fetch_assoc($desig)) 
									echo "<option value ='".$row1['ID']."'>".$row1["Designation"]."</option>";								
								 ?>
							</select>	
						</div>
						<label class="col-md-1">Sub Division</label>
						<div class="col-md-2">
							<select name="SubDivID" class="form-control1">								
								<option value = "<?php echo $$currentsubdiv['ID']; ?> "> <?php echo $currentsubdiv['SubDiv']; ?></option>
								<?php while ($row2 = mysql_fetch_assoc($subdiv)) 
									echo "<option value ='".$row2['ID']."'>".$row2["SubDiv"]."</option>";								
								 ?>
							</select>	
						</div>						
					</div>
					<div class="form-group">
						<label class="col-md-1">Date of Joining</label>
						<div class = "col-md-2">
							<input type ="date" value = "<?php echo $workdata['DOJ']; ?>" name ="doj" required>
						</div>
						<label class="col-md-1">Reasons for Edit Employee</label>
						<div class = "col-md-2">
							<input type ="text" name ="rem" placeholder="Remarks" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-8">
							<div class="input-group in-grp1">						
								<button type="submit" class="btn-success">Submit </button>						
							</div>					
						</div>
						<div class="clearfix"> </div>
					</div>						
				</form>
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