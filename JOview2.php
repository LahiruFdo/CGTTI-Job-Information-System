<?php
	if(isset($_GET['searchItem'])){
		$input = $_GET['searchItem'];
		if($input == ""){
			header('location:JOview.php');
		}
	}
	else{
		header('location:JOview.php');
	}
?>
<!DOCTYPE html>
<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="CSS/jobOffice.css">
	<link rel="stylesheet" type="text/css" href="CSS/index.css">
	<link rel="stylesheet" type="text/css" href="CSS/view.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		<form action="JOview2.php" method="GET">
		<div class="b"><button id="b" type="submit">GO</button></div>
		<div class="search" style="width:27%;">
		
			<div class="searchName">Search By Job No</div>
			<div class="searchBar"><input id="search" name="searchItem" type="text" placeholder="Enter Job Number Here"/></div>

		</div>
		</form>
		<div class="searchResults">
			<div class="profInfo">
				<?php
					if($input!=""){
						include 'config.php';
						
						$sql = "SELECT * FROM jobservce WHERE job_no LIKE '%$input%'";	
						
						if ($result = mysqli_query($conn,$sql)) {
							$count = mysqli_num_rows($result);
							if($count >0){
						    	echo "<table><tr><th> Job No </th><th> Section </th><th> Job Category </th><th> Registered Date </th><th> Status </th><th> Finished Date </th><th> GatePass No. </th></tr>";
						     	// output data of each row
						    	while($row = mysqli_fetch_assoc($result)) {
							    	$a=$row["job_no"];
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
							        echo "<tr><td><a href='JOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["job_typ"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["rDate"] . "</a></td><td><a href='JOviewjob.php?id=$a'>".$state."</td><td><a href='JOviewjob.php?id=$a'>".$Status."</td><td><a href='JOviewjob.php?id=$a'>".$gp."</td></tr>";
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