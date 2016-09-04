<?php
	session_start();
	if(isset($_SESSION["section"])){
		$secCode = $_SESSION["section"];
	}
	else{
	 header("Location:../index.php");
	}

	include '../config.php';

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
		$sjobNo = $_GET['id'];
        $jobNumber = mysqli_query($conn,"SELECT job_no FROM subjob WHERE subjob_no = '$sjobNo'");
        $rowJn=mysqli_fetch_array($jobNumber, MYSQL_ASSOC);
        $jobNo=$rowJn['job_no'];

		$sql1 = mysqli_query($conn,"SELECT * FROM jobservce WHERE job_no = '$jobNo'");
		$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
		$jt = get_jt($row1['job_typ']);
		$code = $row1['sec_code'];
		$cDate = $row1['closedDate'];
		$gp = $row1['gatePass'];
        $jDes = $row1['details'];

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
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>
	<div class="pageArea">
		<div class="titleArea">
			<div class="theme"><h1>Sub Job No. :- <span class="Number"><?php echo $sjobNo; ?></span></h1></div>

		</div>
		<div class="form-area" style="background-color:#fff; height:auto;width:43.5%;margin-top:0%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Sub Job Details</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1">Job Type</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $jt; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Section</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $sec; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Registered Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $rDate; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Description</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $det; ?></div></dd>
			</div><br>
                
             <form action="MstartSJob.php" method="post">
                 <div class="list">
				<dt><div class="form-fields1">Start Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><input style="width:72%;" type="date" id="date" name="date"/></div></dd>
			</div><br>
                 <div class="list">
				<dt><div class="form-fields1">Man Hours</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><input type="text" id="manHour" name="manHour"  /></div></dd>
			</div><br>
                 <div class="list">
				<dt><div class="form-fields1">Machine Hours</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><input type="text" id="machHour" name="machHour"  /></div></dd>
			</div><br>
                 <?php 
                
                $_SESSION["sjNo"] = $sjobNo;
                ?>
                 <button class='btn-circle' id='submit' name='submit' value='Register'><b> Start Sub Job </b></button>
                 
                </form>
			
			</dl>
            
            
		</div>
        
        
		<div class="form-area" style="background-color:#fff; height:auto; width:38%;margin-top:0%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Other Details</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Customer Name</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row5['name']; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Vehicle No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $vNo ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Contact No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row5['contact_no'] ?></div></dd>
			</div><br>
			<div class="list">--------------------------------------------------------------------------------</div>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;padding-top:1%;">Email</div><div class="form-dots2" style="padding-top:1%;">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;padding-top:1%;"><?php echo $row5['email'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Address</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row5['address'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Fuel Type</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row4['fuel_typ'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Engine No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row4['eng_no'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;padding-bottom:2%;">Chassis No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row4['che_no'] ?></div></dd>
			</div><br>
			</dl>
		</div>
		<div id = "g1" class="button-action1"><p>Send Message to</p><p>the Job Section</p></div>
		<div id = "b1" class="round-button1">fafaf</div>
		<div id = "b2" class="round-button2">fafaf</div>
		<div id = "g2" class="button-action1" style="margin-top:18%"><p>Download Details</p></div><br>
		<script type="text/javascript">
			var event1 = document.getElementById('b1');
			var event2 = document.getElementById('b2');
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
	</script>
	</div>

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
				//if(isset($_POST['submit'])){include 'sendMsg.php';}
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
	