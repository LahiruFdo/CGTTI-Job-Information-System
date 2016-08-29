<?php
	if(isset($_GET['searchItem'])){
		$input = $_GET['searchItem'];
		if($input == ""){
			header('location:JOvehicle.php');
		}
	}
	else{
		header('location:JOvehicle.php');
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
		<form action="JOview2.php" method="GET">
		<div class="search-button"><button id="b" type="submit">GO</button></div>
		<div class="search" style="width:27%;">
		
			<div class="searchName">Search By Job No</div>
			<div class="searchBar"><input id="search" name="searchItem" type="text" placeholder="Enter Job Number Here"/></div>

		</div>
		</form>
		<div class="searchResults">
			<div class="profInfo">
				<?php
					if($input!=""){
						include '../config.php';
						
						$sql = "SELECT * FROM vehicle WHERE v_no LIKE '%$input%'";	
						
						if ($result = mysqli_query($conn,$sql)) {
							$count = mysqli_num_rows($result);
							if($count >0){
						    	echo "<table><tr><th> Vehicle No. </th><th> Job No. </th><th> Job Category </th><th> Registered Date </th><th> Status </th><th> Finished Date </th><th> GatePass No. </th></tr>";
						     	// output data of each row
						    	while($row = mysqli_fetch_assoc($result)) {
						    		$jobNo = $row["job_no"];
							        $jobDetails = $conn->query("SELECT * FROM jobservce WHERE job_no='$jobNo'");
							        $jobDetails = $jobDetails->fetch_assoc();
							        $gp = $conn->query("SELECT gtpass_no FROM account WHERE job_no='$jobNo'");
							        $gp = $gp->fetch_assoc();
							        if($gp==""){
							        	$gp="-";
							        }
							        $Status = $jobDetails["closedDate"];
							        if($Status==""){
							        	$state = "Unfinished";
							        	$Status="-";
							        }
							        else{$state = "Finished";}
							        $s = $jobDetails["gatePass"];
							        if($s=='T'){$state = "Closed";}
							        echo "<tr><td>" . $jobNo. "</td><td>" . $row["job_no"]. "</td><td>" . $jobDetails["job_typ"]. "</td><td>" . $jobDetails["rDate"] . "</td><td>".$state."</td><td>".$Status."</td><td>".$gp."</td></tr>";
							   	}
						     	echo "</table>";}
						 	else {
						     	echo "No search results are existing";
						    }
						}
					}
				?>
			</div>	
		</div>
	</div>
</body>
</html>