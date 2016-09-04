<?php
	session_start();
	if(isset($_SESSION["section"])){
		$secCode = $_SESSION["section"];
	}
	else{
	 header("Location:../index.php");
	}
    include_once "../config.php";
    $sql2 = "SELECT COUNT(*) AS 'inboxCount' FROM messages WHERE (t='$secCode' AND readBy='F')";
		$result2 = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_assoc($result2);
		$inboxCount = $row['inboxCount'];
?>
<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">
	<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/button.css">
    <link rel="stylesheet" type="text/css" href="../CSS/section.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>
	<div class="pageArea">
        <div class="contentArea"> 
        <a href="#">
			<div class="message-button">
				<div class="inner-left-corner"><img src="../images/message.png" style="width:100px; height:80px;"></div>
				<div class="button-text-1">Messages<?php if($inboxCount>0){echo "<div class='inbox-number'>".$inboxCount."</div>";}?></div>
			</div>
			</a>
			<a href="#" id="b1">
			<div class="comment-button">
				<div class="inner-left-corner"><img src="../images/comments.png" style="width:100px; height:80px;"></div>
				<div class="button-text-1">Add Comments</div>
			</div>
			</a>
			<div class="detail-button-area">
				<a href="#" id="b2">
				<div class="contact-button">
					<div class="inner-mid-corner"><img src="../images/details.png" style="width:30px; height:25px;"></div>
					<div class="button-text-2">Job Details</div>
				</div>
				</a>
				<a href="#" id="b3">
				<div class="details-button">
					<div class="inner-mid-corner"><img src="../images/contact.png" style="width:30px; height:25px;"></div>
					<div class="button-text-2">Contacts</div>
				</div>
				</a>
			</div>
        </div>
        <div class="page-area1">
			<div class="windowBttn">
				<b>Recently Registered Jobs</b>
			</div>
			<div class="profInfo">
				<?php
					include '../config.php';
					$sql = "SELECT jobservce.job_no,jobservce.sec_code,jobservce.job_typ,jobservce.rDate,jobservce.details,job.start_date FROM jobservce RIGHT JOIN job ON jobservce.job_no=job.job_no WHERE  jobservce.sec_code='$secCode' AND job.start_date=0000-00-00";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th></th><th> Section Name </th><th> Register Date </th><th> Job Type <th> Customer Name </th><th> Job Description </th>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["job_no"];
						    	$scode = $row["sec_code"];
						        $section = $conn->query("SELECT name FROM section WHERE code='$scode'");
						        $sec = $section->fetch_assoc();
                                $jnum = $row["job_no"];
                                $custNIC = $conn->query("SELECT c_NIC FROM vehicle WHERE
                                job_no='$jnum'");
                                $cNIC = $custNIC->fetch_assoc();
                                $NIC = $cNIC["c_NIC"];
                                $custName = $conn->query("SELECT name FROM customer WHERE
                                NIC='$NIC'");
                                $cName = $custName->fetch_assoc();
                                
						        
		//job_no | Section Name | rDate | Job Type | Customer name | job Details				        
						        echo "<tr><td><a href='MRJOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["rDate"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["job_typ"] . "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $cName["name"]."</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["details"]."</a></td></tr>";                               
                               
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No recently registerd Job at the moment.";
					    }
					}
				?>
			</div><br><br>
		</div>
        <div class="page-area1" style="margin-top:-4%">
			<div class="windowBttn">
				<b>Recently Registered Sub Jobs</b>
			</div>
			<div class="profInfo" >
				<?php
					include '../config.php';
					$sql = "SELECT subjob.subjob_no,subjob.job_no,subjob.sj_details,subjob.fr,subjob.t,jobservce.job_typ FROM subjob RIGHT JOIN jobservce ON jobservce.job_no=subjob.job_no WHERE  subjob.t='$secCode' AND subjob.start_date=0000-00-00";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> SubJob No </th></th><th> Details </th><th> From </th><th> To <th> Job Type </th>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["subjob_no"];
						    	$sj_d = $row["sj_details"];
                                $frm=$row["fr"];
                                $t=$row["t"];
						        $fsection = $conn->query("SELECT name FROM section WHERE code='$frm'");
						        $fsec = $fsection->fetch_assoc();
                                 $tsection = $conn->query("SELECT name FROM section WHERE code='$t'");
                                $tsec = $tsection->fetch_assoc();
                                $jnum = $row["job_no"];
                                $custNIC = $conn->query("SELECT c_NIC FROM vehicle WHERE
                                job_no='$jnum'");
                                $cNIC = $custNIC->fetch_assoc();
                                $NIC = $cNIC["c_NIC"];
                                $custName = $conn->query("SELECT name FROM customer WHERE
                                NIC='$NIC'");
                                $cName = $custName->fetch_assoc();
                                
						        
		//Subjob_no | Details | From | To | Job Type | 				        
						        echo "<tr><td><a href='MRJOviewSjob.php?id=$a'>" . $row["subjob_no"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $row["sj_details"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $fsec["name"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $tsec["name"] . "</a></td><td><a href='MRJOviewSjobs.php?id=$a'>" . $row["job_typ"]."</a></td></tr>";                               
                               
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No recently registerd Job at the moment.";
					    }
					}
				?>
			</div>
		</div>
        <div class="page-area1" style="margin-top:1%">
			<div class="windowBttn">
				<b>Ongoing Jobs</b>
			</div>
			<div class="profInfo" >
				<?php
					include '../config.php';
					$sql = "SELECT jobservce.job_no,jobservce.sec_code,jobservce.job_typ,jobservce.closedDate,jobservce.details,job.start_date FROM jobservce RIGHT JOIN job ON jobservce.job_no=job.job_no WHERE jobservce.gatepass='F' AND jobservce.sec_code='$secCode' AND job.start_date!=0000-00-00";	
                /* SELECT column_name(s)
FROM table1
RIGHT JOIN table2
ON table1.column_name=table2.column_name;*/
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Section Name </th><th> Job Description </th><th> Started Date </th><th> Status </th>";
					    	while($row = mysqli_fetch_assoc($result)) {
					    		$a=$row["job_no"];
					    		$scode = $row["sec_code"];
					        	$section = mysqli_query($conn,"SELECT name FROM section WHERE code='$scode'");
					        	$sec = mysqli_fetch_assoc($section);
					        	$Status = $row["closedDate"];
					        	if($Status==""){
					        		$state = "Unfinished";
					        	}
						        else{$state = "Finished";}
						        echo "<tr><td><a href='MOJOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $row["details"]. "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $row["start_date"] . "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $state."</a></td></tr>";
					     	}
					     	echo "</table>";}
					 	else {
					     	echo "No ongoing Jobs at the moment";
					    }
					}
				?>
			</div>
			<br>
			<!--Code for Generate Ongoing Job End-->
                
                    <!--Code for Generate Ongoing Sub Job -->
	
		</div>
        <div class="page-area1" style="margin-top:-4%">
			<div class="windowBttn">
				<b>Ongoing Sub Jobs</b>
			</div>
			<div class="profInfo" >
				<?php
					include '../config.php';
					$sql = "SELECT subjob.subjob_no,subjob.t,subjob.sj_details,jobservce.job_typ,jobservce.closedDate,jobservce.details, jobservce.sec_code FROM subjob RIGHT JOIN jobservce ON subjob.job_no=jobservce.job_no WHERE jobservce.gatepass='F' AND subjob.t='$secCode' AND subjob.start_date!=0000-00-00";	
                
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Sub Job No </th><th> Section Name </th><th> Job Type </th><th>Sub Job Description </th><th> Status </th>";
					    	while($row = mysqli_fetch_assoc($result)) {
					    		$a=$row["subjob_no"];
					    		$scode = $row["sec_code"];
					        	$section = mysqli_query($conn,"SELECT name FROM section WHERE code='$scode'");
					        	$sec = mysqli_fetch_assoc($section);
					        	$Status = $row["closedDate"];
					        	if($Status==""){
					        		$state = "Unfinished";
					        	}
						        else{$state = "Finished";}
						        echo "<tr><td><a href='MOJOviewSjob.php?id=$a'>" . $row["subjob_no"]. "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $row["job_typ"]. "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $row["sj_details"] . "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $state."</a></td></tr>";
					     	}
					     	echo "</table>";}
					 	else {
					     	echo $count." No ongoing Sub Jobs at the moment";
					    }
					}
				?>
			</div>
			</div>
			<br>
			<!--Code for Generate Ongoing Job End-->
                
                    <!--Code for Generate Ongoing Sub Job -->
	
		</div>
    </div>
    </body>
</html>