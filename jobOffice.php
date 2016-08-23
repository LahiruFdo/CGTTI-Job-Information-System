<?php
	session_start();
	if(isset($_SESSION["section"])=="JO"){
		
	}
	else{
	 header("Location:index.php");
	}
?>
<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="CSS/jobOffice.css">
	<link rel="stylesheet" type="text/css" href="CSS/index.css">
	<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea">
		<div class="contentArea" style="position:relative; width:75%; height:100%;">
			<div class="contentArea" style="width:100%; padding-left:0%; padding-right:0%;">
			<div class="detailArea" style="padding:0; border:0.2em solid #6B1A36; border-radius: 10px;">
			<!--<div class="profileImage"><img src="images/user.png" /></div>-->
			<div class="logo" style="margin-top:10%; color: #575354; font-size:1.0em;">You are logged in as Job Office</div>
			<div class="buttonArea">
				<button>View Messages</button>
				<button id="b1">Add Comments</button>
				<button>Contacts</button>
			</div><br>
		</div>
		</div>
			<div class="windowBttn">
				<button><b>Ongoing Jobs</b></button>
			</div>
			<div class="profInfo">
				<?php
					include 'config.php';
					$sql = "SELECT job_no,job_typ,sec_code,rDate,closedDate FROM jobservce WHERE gatepass='F'";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Section </th><th> Job Category </th><th> Registered Date </th><th> Status </th>";
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
						        echo "<tr><td><a href='JOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["job_typ"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["rDate"] . "</a></td><td><a href='JOviewjob.php?id=$a'>" . $state."</a></td></tr>";
					     	}
					     	echo "</table>";}
					 	else {
					     	echo "No ongoing Jobs at the moment";
					    }
					}
				?>
			</div>
			<br>
			<div class="windowBttn">
				<button style="width:60%;"><b>Recently Registered Jobs</b></button>
			</div>
			<div class="profInfo">
				<?php
					include 'config.php';
					$sql = "SELECT job_no,job_typ,sec_code,rDate,closedDate,gatepass FROM jobservce ORDER BY id DESC LIMIT 5";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Section </th><th> Job Category </th><th> Registered Date </th><th> Status </th><th></th>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["job_no"];
						    	$scode = $row["sec_code"];
						        $section = $conn->query("SELECT name FROM section WHERE code='$scode'");
						        $sec = $section->fetch_assoc();
						        $Status = $row["closedDate"];
						        if($Status==""){
						        	$state = "Unfinished";
						        }
						        else{$state = "Finished";}
						        $Status = $row["gatepass"];
						        if($Status=='T'){$state = "Closed";}
						        echo "<tr><td><a href='JOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["job_typ"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["rDate"] . "</a></td><td><a href='JOviewjob.php?id=$a'>" . $state."</a></td></tr>";
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No ongoing Jobs at the moment";
					    }
					}
				?>
			</div>
		</div>
		<div class="contentArea" style="position:relative; width:23%; margin-right:1%; float:right;">
			<?php include 'details.php' ?>
		</div>


<!--Job message box-->
		<div id="comments" class="msgWindow">
			<div class="msgBody">
				<span class="close">x</span>
				<br>
				<form action="" method="post">
				<div class="info">
					<div class="topics" style="width:14%; padding-top:1%;">
						<ul>
							<li>Comment :</li>
						</ul>
					</div>
					<div class="ans" style="padding-left:3%; width:80%;">
						<ul>
							<input type="hidden" name="to" value="admin">
							<input type="hidden" name="from" value="<?php echo "JO";?>">
							<input type="hidden" name="type" value="comment">
							<textarea style="cursor:auto;" name="msg" cols="50" rows="5" placeholder="Type your comment here"></textarea>
						</ul><br>
					</div>
				</div>
				<button id="submit" type="submit" name="submit" value="Register">Send</button>
				</form>
				<?php
					if(isset($_POST['submit'])){include 'sendMsg.php';}
				?>
			</div>
		</div>
	<!--Job message box-->

	<!--Script to visible msg box-->
		<script>
			var msgBox = document.getElementById('comments');
			var btn1 = document.getElementById("b1");
			var btn2 = document.getElementById("submit");
			var span = document.getElementsByClassName("close")[0];

			btn1.onclick = function() {
				msgBox.style.display = "block";
			}
			btn2.onclick = function() {
				msgBox.style.display = "none";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
				msgBox.style.display = "none";
			}
		</script>		
		
	</div>
</body>

</html>