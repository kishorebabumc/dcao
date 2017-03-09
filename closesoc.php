<?php
	include("session.php");
	include("sidepan.html");
	$error = "* Once you Windup the Society from the List you unable to get it";
	if(isset($_GET['socid'])){
		$_SESSION['temp'] = $_GET['socid'];
	}
	if(isset($_SESSION['temp'])){		
		$socid = $_SESSION['temp'];					
		$status = mysql_query("SELECT * FROM socstatus") or die(mysql_error());				
		$sql = mysql_query("Select
						  societies.Name,
						  societies.`Reg No.`,
						  soctypes.Types,
						  societies.Address,
						  mandals.Mandal,
						  subdivision.SubDiv,
						  socmonitoring.NameCustodian,
						  socmonitoring.Cell,
						  socmonitoring.SocID,
						  socmonitoring.PresentDate,
						  socstatus.SocStatus,
						  socmonitoring.StatusID,
						  socmonitoring.FinStatus
						From
						  societies Inner Join
						  soctypes
							On societies.Type = soctypes.ID Inner Join
						  mandals
							On societies.MandalID = mandals.ID Inner Join
						  subdivision
							On societies.SubDivID = subdivision.ID Inner Join
						  socmonitoring
							On societies.SocID = socmonitoring.SocID Inner Join
						  socstatus
							On socmonitoring.StatusID = socstatus.ID								
						WHERE 
						    socmonitoring.SocID = '$socid' AND socmonitoring.Status = 1");
		$workdata = mysql_fetch_assoc($sql);		
		unset($_SESSION['temp']);
	}
	else{
		header("location:admin.php");
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$dateofwind = date("Y-m-d");
		$error = "Society Windup and Deleted from the List Successfully";
		$sql = mysql_query("UPDATE socmonitoring SET ClosingDate ='$dateofwind', Status=0 WHERE SocID='$socid' AND Status = 1");
		$sql = mysql_query("UPDATE societies SET DOL ='$dateofwind', Status=0 WHERE SocID='$socid' AND Status = 1");
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
				<h3 class="blank1" style="color:red">Windup of the Society</h3>
				<form role="form" class="form-horizontal" action="" method="post">			
					<div class="form-group">
						<label class="col-md-1">Society Name</label>
						<div class="col-md-2">
							<?php echo $workdata['Name']." No.".$workdata['Reg No.']; ?> 							
						</div>
						<label class="col-md-1">Type of the Society</label>
						<div class="col-md-2">
							<?php echo $workdata['Types']; ?>							
						</div>
						
						<label class="col-md-1">Address</label>
						<div class="col-md-2">
							<?php echo $workdata['Address'].", ".$workdata['Mandal'].", Krishna "; ?>														
						</div>
						
						<label class="col-md-1">Sub Division</label>
						<div class="col-md-2">
							<?php echo $workdata['SubDiv']; ?>							
						</div>												
					</div>
					<div class="form-group">
						<label class="col-md-1">Custodian of Books</label>
						<div class="col-md-2">
							<?php echo $workdata['NameCustodian']; ?>
						</div>
						<label class="col-md-1">Mobile No of Custodian</label>
						<div class = "col-md-2">
							<?php echo $workdata['Cell']; ?>
						</div>
						<label class="col-md-1">Status of the Society</label>
						<div class = "col-md-2">							
							<?php echo $workdata['SocStatus']; ?>															
						</div>
						<label class="col-md-1">Financial Status</label>
						<div class = "col-md-2">							
							<?php echo $workdata['FinStatus']; ?>
						</div>
					</div>
					<div class="form-group">					
						
						<div class="col-md-2">
							<div class="input-group in-grp1">						
								<button type="submit" class="btn btn-danger">Submit </button> 								
							</div>					
						</div>						
						<div class="col-md-10">
							<div class="input-group in-grp1 " style="color:red">						
								<?php echo $error; ?>
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