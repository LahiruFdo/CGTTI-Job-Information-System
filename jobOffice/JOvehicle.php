<?php
	if (!isset($_GET['id'])){
    	$num = 0;
	}
	else{
		$num = $_GET['id'];
	}
?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/view.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		<form action="JOvehicle2.php" method="GET">
		<div class="search-button"><button id="b" type="submit">GO</button></div>
		<div class="search" style="width:30%;">
		
			<div class="searchName" style="width:55%;">Search By Vehicle No.</div>
			<div class="searchBar" style="width:44%;"><input id="search" name="searchItem" type="text" placeholder="Enter Vehicle Number"/></div>

		</div>
		</form>
		<div class="searchResults">
			<div class="profInfo">
				<?php
					$num1 = $num;
					$num2 = $num1+10;
					include '../config.php';
					$sql = "SELECT * FROM jobservce ORDER BY id DESC LIMIT $num1,10 ";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Vehicle No. </th><th> Job No. </th><th> Job Category </th><th> Registered Date </th><th> Status </th><th> Finished Date </th><th> GatePass No. </th></tr>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["job_no"];
						    	$vehicle = $conn->query("SELECT v_no FROM vehicle WHERE job_no='$a'");
						        $vno = $vehicle->fetch_assoc();
						    	$scode = $row["sec_code"];
						        $section = $conn->query("SELECT name FROM section WHERE code='$scode'");
						        $sec = $section->fetch_assoc();
						        $jn = $row["job_no"];
						        $gp = $conn->query("SELECT gtpass_no FROM account WHERE job_no='$jn'");
						        $gp = $gp->fetch_assoc();
						        if($gp==""){
						        	$gp="-";
						        }
						        $Status = $row["closedDate"];
						        if($Status==""){
						        	$state = "Unfinished";
						        	$Status="-";
						        }
						        else{$state = "Finished";}
						        $s = $row["gatePass"];
						        if($s=='T'){$state = "Closed";}
						        echo "<tr><td>" . $vno["v_no"]. "</td><td>" . $row["job_no"]. "</td><td>" . $row["job_typ"]. "</td><td>" . $row["rDate"] . "</td><td>".$state."</td><td>".$Status."</td><td>".$gp."</td></tr>";
						   	}
					     	echo "</table>";
					     	if($count==10){echo "<div class='links'><a href='JOvehicle.php?id=$num2'><u>View More</u></a></div>";}}
					 	else {
					     	echo "<center>No more vehicles</center>";
					    }
					}
				?>

			</div>	
		</div>
	</div>
</body>
</html>


