<?php
	include("session.php");
	include("sidepan.html");	
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
<script type="text/javascript">
	$(document).ready(function()
		{ 	$("#status").hide();
			$("#empid").keyup(function() 
			{  
				var empid = $("#empid").val();										
				if(empid.length == 7 )
				{
					$.ajax({  
						type: "POST",  
						url: "usercheck.php",  
						data: "empid="+ empid,  						
						success: function(msg){ 																				
							if( msg == 1)
 							{	
								var div = $("#empid").closest("div");
								div.removeClass("has-error");								
								div.addClass("has-warning");
								$("#glypcn").remove();								
								div.append('<span id="glypcn" class="glyphicon glyphicon-warning-sign form-control-feedback"></span>');
								var div1 = $("#mit").closest("div");
								$("#sub").remove();
								div1.append('<button type="submit" id="sub" class="btn btn-info disabled">Submit</button>');
								$("#status").show();
							}  
							else 
							{  								
								$("#status").hide();
								var div = $("#empid").closest("div");
								div.removeClass("has-error");
								div.removeClass("has-warning");								
								div.addClass("has-success");									
								$("#glypcn").remove();
								div.append('<span id="glypcn" class="glyphicon glyphicon-ok form-control-feedback"></span>');	
								var div1 = $("#mit").closest("div");
								$("#sub").remove();
								div1.append('<button type="submit" id="sub" class="btn-success">Submit</button>');
							} 
						} 
					}); 
				}
				else
				{	$("#status").hide();			
					var div = $("#empid").closest("div");				
					div.addClass("has-error");
					$("#glypcn").remove();
					div.append('<span id="glypcn" class="glyphicon glyphicon-remove form-control-feedback"></span>');				
					var div1 = $("#mit").closest("div");
					$("#sub").remove();
					div1.append('<button type="submit" id="sub" class="btn btn-info disabled">Submit</button>');
				}
			return false;
			});			
		});
</script>

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
		<h3 class="blank1">Register Employee Profile</h3>
		<form role="form" class="form-horizontal" action="regsuc.php" method="post">			
			<div class="form-group">
				<label class="col-md-1">Employee ID</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" id ="empid" name="empid" placeholder="Employee ID" required>					
				</div>
				<label class="col-md-1">First Name</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="fname" placeholder="First Name" required>					
				</div>
				<label class="col-md-1">Last Name</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="lname" placeholder="Last Name" >					
				</div>
				<label class="col-md-1">Surname</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="sname" placeholder="Surname" required>					
				</div>				
			</div>
			<div class="form-group">
				<label class="col-md-1">Gender</label>
				<div class="col-md-2">					
						<select class="form-control1" name="gender">					
							<option>Male</option>
							<option>Female</option>							
						</select>	
				</div>
				<label class="col-md-1">Date of Birth</label>
				<div class="col-md-2">					
						<input type="date" class="form-control1" name="dob" placeholder="DD / MM / YYYY" required>					
				</div>
				<label class="col-md-1">Marital Status</label>
				<div class="col-md-2">					
						<select class="form-control1" name="maritalstatus">					
							<option>Married</option>
							<option>Unmarried</option>							
						</select>	
				</div>
				<label class="col-md-1">Address 1</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="add1" placeholder="Address 1" required>					
				</div>				
			</div>						
			<div class="form-group">
				<label class="col-md-1">Address 2</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="add2" placeholder="Address 2" >					
				</div>
				<label class="col-md-1">City</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="city" placeholder="City" required>					
				</div>
				<label class="col-md-1">District</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="district" placeholder="District" required>					
				</div>
				<label class="col-md-1">Mobile Number</label>
				<div class="col-md-2">					
						<input type="text" class="form-control1" name="cell" placeholder="Mobile Number" required>					
				</div>				
			</div>		
						
			
			
			<div class="form-group">
				<label class="col-md-2 control-label"></label>
				<div class="col-md-2">
					<div class="input-group in-grp1">
						<span id="mit"></span>
						<button type="submit" id="sub" class="btn-success">Submit</button>						
					</div>					
				</div>				
				<div class="col-md-8">
					<div class="input-group in-grp1">				
						<span id="status" style = "color:red">Employee Already Register, Please go to Edit Employee</button>						
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