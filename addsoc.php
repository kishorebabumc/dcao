<?php
	include("session.php");
	include("sidepan.html");
	$sql1 = mysql_query("SELECT * FROM soctypes") or die(mysql_error());
	$sql2 = mysql_query("SELECT * FROM mandals") or die(mysql_error());	
	$sql3 = mysql_query("SELECT * FROM funcregistrars") or die(mysql_error());	
	$sql4 = mysql_query("SELECT * FROM subdivision") or die(mysql_error());	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$socname = $_POST['socname'];
		$regno = $_POST['regno'];
		$types = $_POST['types'];
		$sql = mysql_query("SELECT * FROM societies WHERE Type = '$types'");
		$count = mysql_num_rows($sql);
		$sql1 = mysql_query("SELECT * FROM `soctypes` WHERE `ID`='$types'");
		$result = mysql_fetch_assoc($sql1);
		$count = $count+1;
		$socid = $result['Types'].$count;
		$address = $_POST['address'];
		$mandal = $_POST['mandal'];
		$chief = $_POST['chief'];
		$cell = $_POST['cell'];
		$dor = $_POST['dor'];
		$registrar = $_POST['registrar'];
		$finstatus = $_POST['finstatus'];
		$subdiv = $_POST['subdiv'];	
		$sql = "INSERT INTO `societies` (`SocID`, `Name`, `Reg No.`, `Type`, `Address`, `MandalID`,`SubDivID`, `District`, `ChiefPromoter`, `Cell`, `DOR`, `RegistrarID`, `AuditComp`, `DOL`,`status`) 
		         VALUES ('$socid', '$socname', '$regno', '$types', '$address', '$mandal','$subdiv', 'Krishna', '$chief', '$cell', '$dor', '$registrar', '', '',1)";
		$result = mysql_query($sql) or die(mysql_error());		
		$_SESSION['result'] = $socid;
		$sql = "INSERT INTO `socmonitoring` (`ID`, `SocID`, `NameCustodian`, `Cell`, `StatusID`, `FinStatus`, `PresentDate`, `ClosingDate`, `Rem`, `Status`) 
		         VALUES (NULL, '$socid', '$chief', '$cell', '1', '$finstatus', '$dor', '', 'Registered', 1)";
		$result = mysql_query($sql) or die(mysql_error());		
		header("location:socsuc.php");		
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
		<h3 class="blank1">Add New Society</h3>
		<form role="form" class="form-horizontal" action="" method="post">			
			<div class="form-group">
				<label class="col-md-1">Society Name</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="socname" placeholder="Society Name" required>					
				</div>
				<label class="col-md-1">Register No.</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="regno" placeholder="Reg No." required>					
				</div>
				<label class="col-md-1">Type</label>
				<div class="col-md-2">					
						<select name="types" class="form-control1">								
								<?php while ($row1 = mysql_fetch_assoc($sql1)) 
									echo "<option value ='".$row1['ID']."'>".$row1["Types"]."</option>";								
								 ?>
						</select>	
				</div>
				<label class="col-md-1">Address</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="address" placeholder="Address" required>					
				</div>				
			</div>
			<div class="form-group">
				<label class="col-md-1">Mandal</label>
				<div class="col-md-2">					
						<select name="mandal" class="form-control1">								
								<?php while ($row1 = mysql_fetch_assoc($sql2)) 
									echo "<option value ='".$row1['ID']."'>".$row1["Mandal"]."</option>";								
								 ?>
						</select>	
				</div>
				<label class="col-md-1">Name of the Cheif Promoter</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="chief" placeholder="Cheif Promoter">					
				</div>
				<label class="col-md-1">Cell</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="cell" placeholder="Cell No">					
				</div>
				<label class="col-md-1">Date  of Registration</label>
				<div class="col-md-2">					
						<input type="date" class="form-control1" name="dor" >					
				</div>				
			</div>						
			<div class="form-group">
				<label class="col-md-1">Functional Registrar</label>
				<div class="col-md-2">					
						<select name="registrar" class="form-control1">								
								<?php while ($row1 = mysql_fetch_assoc($sql3)) 
									echo "<option value ='".$row1['ID']."'>".$row1["Registrar"]."</option>";								
								 ?>
						</select>
				</div>
				<label class="col-md-1">Aided / Un-Aided</label>
				<div class="col-md-2">					
						<select class="form-control1" name="finstatus">					
							<option>Aided</option>
							<option>Un-Aided</option>							
						</select>
				</div>
				<label class="col-md-1">Sub Division</label>
				<div class="col-md-2">					
						<select name="subdiv" class="form-control1">								
								<?php while ($row1 = mysql_fetch_assoc($sql4)) 
									echo "<option value ='".$row1['ID']."'>".$row1["SubDiv"]."</option>";								
								 ?>
						</select>	
				</div>				
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"></label>
				<div class="col-md-2">
					<div class="input-group in-grp1">
						<span id="mit"></span>
						<button type="submit" id="sub" class="btn-success">Submit </button>						
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