<?php
	include 'config.php';

	function get_jt($j){
		$type = "Private Job";
		switch($j){
			case "BC": $type = "Bus Company"; break;
			case "VM": $type = "Vehicle Maintain"; break;
		}
		return $type;
	}

	if (!isset($_GET['id'])){
    	echo 'No ID was given...';
    	exit;
	}
	else{
		$jobNo = $_GET['id'];

		$sql1 = mysqli_query($conn,"SELECT * FROM jobservce WHERE job_no = '$jobNo'");
		$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
		$jt = get_jt($row1['job_typ']);
		$code = $row1['sec_code'];
		$cDate = $row1['closedDate'];
		$gp = $row1['gatePass'];

		$sql2 = mysqli_query($conn,"SELECT name FROM section WHERE code = '$code'");
		$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
		$sec = $row2['name'];
		$rDate = $row1['rDate'];
		$det = $row1['details'];

		$sql3 = mysqli_query($conn,"SELECT subJob_no FROM subjob WHERE job_no = '$jobNo'");
		$sj = mysqli_num_rows($sql3);

		$sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$jobNo'");
		$row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
		$vNo= $row4['v_no'];

		$sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE v_no = '$vNo'");
		$row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);

		$sql6 = mysqli_query($conn,"SELECT gtpass_no FROM account WHERE job_no = '$jobNo'");
		$row6 = mysqli_fetch_array($sql5, MYSQL_ASSOC);
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
	<div class="pageArea" style="font-family: 'calibri','verdana';">
		<div class="titleArea">
			<div class="theme"><h1>Job No. :- <span class="Number"><?php echo $jobNo; ?></span></h1></div>
		</div>
		<div class="jDetails">
			<div class="topBar">Job Details</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Job Type :</li><br><br>
						<li>Section :</li><br><br>
						<li>Registered Date :</li><br><br>
						<li>Description :</li><br><br>
					</ul>
				</div>
				<div class="ans">
					<?php echo "<ul><li>".$jt."</li><br><br>
									<li>".$sec."</li><br><br>
									<li>".$rDate."</li><br><br>
									<li><p>".$det."<br><br></p></li>
					</ul>";?>
				</div>
			</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Sub Job No :</li><br><br>
					</ul>
				</div>
				<div class="ans">
					<?php echo "<ul>";
						if($sj == 0){
							echo "<li> - </li><br><br>";
						}
						else{
						while($sj>0){
						$row3 = mysqli_fetch_array($sql3, MYSQL_ASSOC);
						echo "<li>".$row3['subJob_no']."</li><br><br>";
						}}
					echo "</ul>";
					?>
				</div>
			</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Finished Date :</li><br><br>
						<li>GatePass No. :</li><br><br>
					</ul>
				</div>
				<div class="ans">
					<?php echo "<ul><li>";
						if($cDate == ""){
							echo " - </li><br><br>";
						}
						else{
							echo $cDate."</li><br><br>";
						}
						if($gp == "F"){
							echo " - </li><br><br>";
						}
						else{
							echo $row6['gtpass_no']."</li><br><br>";
						}
					echo "</ul>";
					?>
				</div>
			</div>
		</div>
		<div class="cDetails">
			<div class="topBar">Other Details</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Customer Name :</li><br><br>
						<li>Contacts :</li><br><br>
						<li>Email :</li><br><br>
						<li>Address :</li><br><br><br><br>
						<li>Vehicle No :</li><br><br>
					</ul>
				</div>
				<div class="ans">
					<?php 
						echo "<ul><li>".$row5['name']."</li><br><br>
										<li>".$row5['contact_no']."</li><br><br>
										<li>".$row5['email']."</li><br><br>
										<li><p>".$row5['address']."<br><br><br><br></p></li>
										<li>".$vNo."</li><br><br><br><br><br><br><br>
					</ul>";?>
					<br><br>
				</div>
			</div>
		</div>
		<div class="links">
			<div class="butArea">
				<button class="btn-circle" id="b1">1</button>
				<div id = "g1" class="button-action"><p>Send Message to</p><p>the Job Section</p></div><br>
				<button class="btn-circle" id="b2">2</button>
				<div id = "g2" class="button-action" style="margin-top:16%"><p>Get More Details</p></div><br>
				<button class="btn-circle" id="b3">3</button>
				<div id = "g3" class="button-action" style="margin-top:16%"><p>Download Details</p></div><br>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var event1 = document.getElementById('b1');
		var event2 = document.getElementById('b2');
		var event3 = document.getElementById('b3');
		event1.onmouseover = function() {
		  document.getElementById('g1').style.display = 'block';
		}
		event1.onmouseout = function() {
		  document.getElementById('g1').style.display = 'none';
		}
		event2.onmouseover = function() {
		  document.getElementById('g2').style.display = 'block';
		}
		event2.onmouseout = function() {
		  document.getElementById('g2').style.display = 'none';
		}
		event3.onmouseover = function() {
		  document.getElementById('g3').style.display = 'block';
		}
		event3.onmouseout = function() {
		  document.getElementById('g3').style.display = 'none';
		}
	</script>

<!--Job message box-->
	<div id="jobmsg" class="msgWindow">
		<div class="msgBody">
			<span class="close">x</span>
			<br>
			<form action="" method="post">
			<div class="info">
				<div class="topics" style="width:14%; padding-top:1%;">
					<ul>
						<li>To :</li><br><br><br>
						<li>Message :</li>
					</ul>
				</div>
				<div class="ans" style="padding-left:3%; width:80%;">
					<ul>
						<li><div class="toMsg"><?php echo $sec." Section";?></div></li><br><br><br>
						<input type="hidden" name="to" value="<?php echo $code;?>">
						<input type="hidden" name="from" value="<?php echo "JO";?>">
						<input type="hidden" name="type" value="normal">
						<textarea style="cursor:auto;" name="msg" cols="50" rows="5" placeholder="Type your message here"></textarea>
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
		var msgBox = document.getElementById('jobmsg');
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
</body>
</html>
