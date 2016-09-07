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
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/view.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
</head>

<body class="body">
	<?php include 'AccHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		
		<div class="searchResults">
			<div class="profInfo">
				<?php
					if($input!=""){
						include '../config.php';
						
						$sql = "SELECT * FROM account WHERE payORnot='F' AND job_no LIKE '%$input%'";	
						
				$con = new DatabaseCon($conn);
                    if ($result = $con->getConnection($sql)) {
                        $count = $con->getRowCount($result);
                       
                        if($count >0){
                            echo "<table><tr><th> Job No </th><th> Section </th><th> Amount </th><th>Pay Date </th>";
                            
                            while($row = $con->getoutput($result)) {
                         // output data of each row
                            $no=$row["job_no"];
                            $sql6="SELECT pay_date FROM account WHERE job_no='$no'";
                            $paydate=$con->getConnection($sql6);
                           	$date=$con->getoutput($paydate);
                           	$sql7="SELECT total FROM account WHERE job_no='$no'";
                           	$amn=$con->getConnection($sql7);
                           	$amu=$con->getoutput($amn);
                           	$sql8="SELECT sec_code FROM jobservce WHERE job_no='$no'";
                            $se=$con->getConnection($sql8);
                            $sec=$con->getoutput($se);
                            $tem=$sec["sec_code"];
                            $sql9="SELECT name FROM section WHERE code='$tem'";
                            $section=$con->getConnection($sql9);
                            $sect=$con->getoutput($section);

                             echo "<tr><td><a href='AccView.php?id=$no'>" . $row["job_no"]. "</a></td><td><a href='AccView.php?id=$no'>" . $sect["name"]. "</a></td><td><a href='AccView.php?id=$no'>" . $amu["total"]. "</a></td><td><a href='AccView.php?id=$no'>" . $date["pay_date"]. "</a></td></tr>";
                         }
                         echo "</table>";}
                          }

                  else {
                         echo "No New Finised Jobs";
                    }
                
					}
				?>
			</div>	
		</div>
	</div>
</body>
</html>