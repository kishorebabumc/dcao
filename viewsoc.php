<?php
	include("session.php");
	include("sidepan.html");
	$sql = "Select
			  socmonitoring.SocID, 
			  societies.Name,
			  societies.Address,
			  societies.District,
			  socmonitoring.NameCustodian,
			  socmonitoring.Cell,
			  societies.DOR,
			  socmonitoring.FinStatus,
			  soctypes.Types,
			  mandals.Mandal,
			  socstatus.SocStatus,
			  funcregistrars.Registrar
			From
			  socmonitoring Inner Join
			  societies
				On socmonitoring.SocID = societies.ID Inner Join
			  soctypes
				On societies.Type = soctypes.ID Inner Join
			  mandals
				On societies.MandalID = mandals.ID Inner Join
			  socstatus
				On socmonitoring.StatusID = socstatus.ID Inner Join
			  funcregistrars
				On societies.RegistrarID = funcregistrars.ID
			Where
			  socmonitoring.Status = 1";
	/*if(isset($_GET['sort'])){
	
		if ($_GET['sort'] == 'id')
		{
			$sql .= " ORDER BY EmpID";
		}
		elseif ($_GET['sort'] == 'emp')
		{
			$sql .= " ORDER BY Fname";
		}
		elseif ($_GET['sort'] == 'dob')
		{
			$sql .= " ORDER BY DOB";
		}
		elseif($_GET['sort'] == 'deg')
		{
			$sql .= " ORDER BY Designation";
		}
		elseif($_GET['sort'] == 'subdiv')
		{
			$sql .= " ORDER BY SubDiv";
		}
		elseif($_GET['sort'] == 'cell')
		{
			$sql .= " ORDER BY Cell";
		}
		
	}*/	
	$sql = mysql_query($sql);
	$count = mysql_num_rows($sql);
	
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
		<h3 class="blank1">View Societies</h3>
		<div>			
			<!-- <table class="table table-hover">
				<tr>
					<td></td>
					<td><input type="text" name="sort" placeholder="Employee ID"></td>
					<td><input type="text" name="sort" placeholder="Name"></td>					
					<td><input type="text" name="sort" placeholder="Designation"></td>
					<td><input type="text" name="sort" placeholder="Sub Divison"></td>
					<td><button>Search</button></td>
					<td></td>
				</tr>
			</table> -->	
			<table class="table table-hover">				
				<thead class="thead-inverse">				
				<tr>
					<th>Sl.No.</th>
					<th><a href="viewsoc.php?sort=">Name of the Society</a> </th>
					<th><a href="viewsoc.php?sort=">Type of the Society</a></th>					
					<th><a href="viewsoc.php?sort=">Address</a></th>
					<th><a href="viewsoc.php?sort=">Custodian of Records with Cell No.</a></th>
					<th><a href="viewsoc.php?sort=">Date of Registration</a></th>
					<th><a href="viewsoc.php?sort=">Aided / Un-Aided </a></th>
					<th><a href="viewsoc.php?sort=">Status</a></th>
					<th><a href="viewsoc.php?sort=">Functional Registrar</a></th>
					
					<th>Edit</th>
				</tr>
				</thead>
		  
			<?php if($count>0){
				$slno=1;
				while($result = mysql_fetch_assoc($sql))
				{ 	
					echo "<tr><td>".$slno."</td>";	
					echo "<td>".$result['Name']."</td>";					
					echo "<td>".$result['Types']."</td>";					
					echo "<td>".$result['Address'].", ".$result['Mandal'].", Krishna"."</td>";
					echo "<td>".$result['NameCustodian'].", ".$result['Cell']."</td>";
					echo "<td>".$result['DOR']."</td>";
					echo "<td>".$result['FinStatus']."</td>";
					echo "<td>".$result['SocStatus']."</td>";
					echo "<td>".$result['Registrar']."</td>";
					echo "<td>
							  <a href='editsoc.php?empid=".$result['SocID']."'><i class='fa fa-pencil'></i></a>							  
						  </td></tr>";
					$slno = $slno +1;					
				}				
			}
			?>
			</table>
		
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