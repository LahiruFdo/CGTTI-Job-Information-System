<?php
	session_start();

	if(isset($_SESSION["section"])=="JO"){  
		include '../config.php';
		$sql1 = "SELECT job_typ, COUNT(*) AS 'total' FROM jobservce GROUP BY job_typ";
		$result1 = mysqli_query($conn,$sql1);
		$PJ = $VM = $BJ = $M = $TRG = $PRG = $PR = $STC = $VTI = $DP = 10;
		$total = 100;
		while($row = mysqli_fetch_assoc($result1)){
			if(($row['job_typ'])=="PJ"){
				$PJ = $row['total']; $total = $total + $PJ;
			}
			if(($row['job_typ'])=="VM"){
				$VM = $row['total']; $total = $total + $VM;
			}
			if(($row['job_typ'])=="BJ"){
				$BJ = $row['total']; $total = $total + $BJ;
			}
			if(($row['job_typ'])=="M"){
				$M = $row['total']; $total = $total + $M;
			}
			if(($row['job_typ'])=="TRG"){
				$TRG = $row['total']; $total = $total + $TRG;
			}
			if(($row['job_typ'])=="PRG"){
				$PRG = $row['total']; $total = $total + $PRG;
			}
			if(($row['job_typ'])=="PR"){
				$PR = $row['total']; $total = $total + $PR;
			}
			if(($row['job_typ'])=="STC"){
				$STC = $row['total']; $total = $total + $STC ;
			}
			if(($row['job_typ'])=="VTI"){
				$VTI = $row['total']; $total = $total + $VTI;
			}
			if(($row['job_typ'])=="DP"){
				$DP = $row['total']; $total = $total + $DP;
			}
		}
	
		function getPercentage($v,$total){
			$percentage = round($v / $total * 100);
			return $percentage;
		}

		$sql2 = "SELECT COUNT(*) AS 'inboxCount' FROM messages WHERE (t='JO' AND readBy='F')";
		$result2 = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_assoc($result2);
		$inboxCount = $row['inboxCount'];

	}
	else{
	 header("Location:index.php");
	}
?>
<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/button.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	
 
</head>

<body class="body">

	<?php include 'JOHeader.php'; ?>
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

		<div class="chart-area">
			<div class="chart-header">Registered Jobs By Categories</div>
			<div class="chart-area-left">
			<canvas id="chart" width="250" height="250"><script type="text/javascript"></script></canvas>
			</div>
			<div class="chart-area-right">
				<div class="chart-list"><div class="color-sqr" style="background-color:#F15854;"></div>
				<div class="detail-name">Private Jobs<span> (<?php echo getPercentage($PJ,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#5DA5DA;"></div>
				<div class="detail-name">Bus Jobs<span> (<?php echo getPercentage($BJ,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#38437E;"></div>
				<div class="detail-name">Vehicle Maintains<span> (<?php echo getPercentage($VM,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#269546;"></div>
				<div class="detail-name">Institute Maintainance<span> (<?php echo getPercentage($M,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#B276B2;"></div>
				<div class="detail-name">Training (Full Time)<span> (<?php echo getPercentage($TRG,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#9A2C6B;"></div>
				<div class="detail-name">Training (Part Time)<span> (<?php echo getPercentage($PRG,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#DECF3F;"></div>
				<div class="detail-name">Production<span> (<?php echo getPercentage($PR,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#1F6C85;"></div>
				<div class="detail-name">Special Training Course<span> (<?php echo getPercentage($STC,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#4D4D4D;"></div>
				<div class="detail-name">Borella Institute<span> (<?php echo getPercentage($VTI,$total);?>%)</span></div></div><br>
				<div class="chart-list"><div class="color-sqr" style="background-color:#B2431F;"></div>
				<div class="detail-name">Director Bunglow<span> (<?php echo getPercentage($DP,$total);?>%)</span></div></div>
			</div>
		</div>
		<script>
			var colors = ["#F15854","#5DA5DA","#38437E","#269546","#B276B2","#9A2C6B", "#DECF3F","#1F6C85","#4D4D4D","#B2431F"];
			var data = [<?php echo $PJ; ?>, <?php echo $BJ; ?>, <?php echo $VM; ?>, <?php echo $M; ?>, <?php echo $TRG; ?>, <?php echo $PRG; ?>, <?php echo $PR; ?>, <?php echo $STC; ?>, <?php echo $VTI; ?>, <?php echo $DP; ?>];

			function getTotal(){
				var total = 0;
				for (var j = 0; j < data.length; j++) {
					total += (typeof data[j] == 'number') ? data[j] : 0;
				}
				return total;
			}

			function addData() {
				var canvas;
				var contex;
				var lastValue = 0;
				var total = getTotal();

				canvas = document.getElementById("chart");
				contex = canvas.getContext("2d");
				/*contex.shadowBlur=0;
				contex.shadowColor="black";
				contex.shadowOffsetX = 1;
      			contex.shadowOffsetY = 1;*/
				contex.clearRect(0, 0, canvas.width, canvas.height);

				for (var i = 0; i < data.length; i++) {
					contex.fillStyle = colors[i];
					contex.beginPath();
					contex.moveTo(125,125);
					contex.arc(125,125,125,lastValue,lastValue+(Math.PI*2*(data[i]/total)),false);
					contex.lineTo(125,125);
					contex.fill();
					lastValue += Math.PI*2*(data[i]/total);
				}
			}

			addData();
		</script>
			
		
		<div class="page-area1">
			<div class="windowBttn">
				<b>Ongoing Jobs</b>
			</div>
			<div class="profInfo">
				<?php
					include '../config.php';

					$sql = "SELECT job_no,job_typ,sec_code,rDate,closedDate FROM jobservce WHERE gatepass='F' ORDER BY rDate DESC";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Section </th><th> Job Type </th><th> Registered Date </th><th> Status </th>";
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
			</div><br><br>
		</div>
		
		<div class="page-area2">
			<div class="windowBttn">
				<b>Recently Registered Jobs</b>
			</div>
			<div class="profInfo">
				<?php
					include '../config.php';
					$sql = "SELECT job_no,job_typ,sec_code,rDate,closedDate,gatepass FROM jobservce ORDER BY id DESC LIMIT 5";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Section </th><th> Job Type </th><th> Registered Date </th><th> Status </th>";
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
		<!--</div>
		<div class="contentArea" style="position:relative; width:23%; margin-right:1%; float:right;">
			<?php //include 'details.php' ?>
		</div>-->


	<!--Comments box-->
		<div id="comments" class="msgWindow">
			<div class="msgBody">
				<span id="c1" class="close">x</span>
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
	<!--Comments box-->

	<!--details box-->
		<div id="details" class="msgWindow">
			<div class="msgBody">
				<span id="c2" class="close">x</span>
				<?php include 'details.php';?>
			</div>
		</div>
	<!--details box-->

	<!--details box-->
		<div id="contacts" class="msgWindow">
			<div class="msgBody">
				<span id="c3" class="close">x</span>
				Contacts
				<?php //include 'details.php';//?>
			</div>
		</div>
	<!--details box-->

	<!--Script to visible window boxes-->
		<script>
			var msgBox = document.getElementById('comments');
			var detailBox = document.getElementById('details');
			var contactsBox = document.getElementById('contacts');
			var btn1 = document.getElementById("b1");
			var btn2 = document.getElementById("submit");
			var btn3 = document.getElementById("b2");
			var btn4 = document.getElementById("b3");
			var close1 = document.getElementById("c1");
			var close2 = document.getElementById("c2");
			var close3 = document.getElementById("c3");
			/*var span = document.getElementsByClassName("close")[0];*/

			btn1.onclick = function() {
				msgBox.style.display = "block";
			}
			btn2.onclick = function() {
				msgBox.style.display = "none";
			}
			btn3.onclick = function() {
				detailBox.style.display = "block";
			}
			btn4.onclick = function() {
				contactsBox.style.display = "block";
			}

			close1.onclick = function() {
				msgBox.style.display = "none";
			}
			close2.onclick = function() {
				detailBox.style.display = "none";
			}
			close3.onclick = function() {
				contactsBox.style.display = "none";
			}

			// When the user clicks on <span> (x), close the modal
			/*span.onclick = function() {
				if(msgBox.style.display == "block"){msgBox.style.display = "none";}
				else if(detailBox.style.display == "block"){detailBox.style.display.style.display = "none";}
				else{contactsBox.style.display = "none";}
			}*/
		</script>

	</div>
</body>

</html>