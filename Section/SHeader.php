<header>
    <?php  $secCode=$_SESSION['section'];
        include_once "../config.php";
        $sql = "SELECT section.name FROM section WHERE section.code='$secCode'";
        $qry = mysqli_query($conn,$sql);
        $sec = $qry->fetch_assoc();
        $sec = $sec['name'];
    ?> 
<div class="header" >
		<div class="header1">
			<div class="logo">CGTTI - <span style="font-size: 0.65em;"> Job Information System</span>
			</div>
			<div class="loginAs"><?php echo "$sec"; ?> <a href="../logout.php">( LogOut )</a></div>
		</div>
		<div class="header2"></div>
	</div>

	<div class="sidebar">
		<div class="profileImage"><img src="../images/user1.png" /></div><br>
		<ul id="nav">
			<li><a  style="font-size: 1.3em;border-top: 0.05em solid #403D3E;" href="Msection.php">My Home</a> </li>
			<li><a  href="JOregister1.php">View All Jobs</a></li>	
			<li><a  href="JOview.php?id=0">Received SubJobs</a></li>	
			<li><a  href="JOnewClosedJ.php?id=0">Sent Subjobs</a></li>
			<li><a  href="JOnewClosedJ.php?id=0">View Finished Job</a></li>
			
		</ul>
	</div>
</header>