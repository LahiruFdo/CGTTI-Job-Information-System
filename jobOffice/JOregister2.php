<?php
	session_start();

	include_once ("../config.php");

		$_SESSION['name'] = $_POST['name'];
		$_SESSION['nic'] = $_POST['nic'];
		$_SESSION['tele'] = $_POST['tele'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['adrs'] = $_POST['adrs'];

		$_SESSION['vno'] = $_POST['vno'];
		$_SESSION['eno'] = $_POST['eno'];
		$_SESSION['cno'] = $_POST['cno'];
		$_SESSION['fueltyp'] = $_POST['fuelType'];

		$sql = "SELECT job_typ, COUNT(*) AS 'total' FROM jobservce";
		$qry = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($qry);
		$index = $row['total']+1;

		if($index<100){$index = "0".$index;}

		$_SESSION['index'] = $index;
?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/viewJob.css">
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea">
		<form method="post" action="register.php">
		<div class="form-area">
			<div class="topBar">Job Registration</div>
			<dl>
			<div class="list" style="padding:0%;">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Job Description </div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;">
				<textarea type="text" name="jobdes" cols="50" rows="4" input required="required"></textarea></div></dd>
			</div><br>
			<div class="list" style="padding:0%;">
			<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Job Type</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;">
					<div class="radio-tab"><input style="margin-top:2%;" name="jobType" type="radio" value="PJ" input required="required"/>PJ</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="VM" input required="required"/>VM</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="BJ" input required="required"/>BJ</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="M" input required="required"/>M</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="TRG" input required="required"/>TRG</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="PRG" input required="required"/>PRG</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="PR" input required="required"/>PR</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="STC" input required="required"/>STC</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="VTI" input required="required"/>VTI</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="DP" input required="required"/>DP</div><br>
				</div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Section</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;"><input type="text" maxlength="16" id="sec" name="sec" input required="required" /></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Section Code</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;"><input style="width:30%;" type="text" maxlength="4" id="secCode" name="secCode" input required="required" /></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Date</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;"><input style="width:50%;" type="date" id="date" name="date" input required="required"/></div></dd>
			</div><br>
			
			</dl>
		</div>
		
		<div class="form-area" style="width: 17%; padding-top:1.6%; padding-bottom:1.7%;">
				<h4>Job Categories</h4>
				<div class="code">
					<p>PJ</p>
					<p>VM</p>
					<p>BJ</p>
					<p>M</p>
					<p>TRG</p>
					<p>PRG</p>
					<p>PR</p>
					<p>STC</p>
					<p>VTI</p>
					<p>DP</p>
				</div>
				<div class="mean">
					<p>- Private Jobs</p>
					<p>- Vehicle maintain</p>
					<p>- Bus Jobs</p>
					<p>- Institute Maintainance</p>
					<p>- Training (Full Time)</p>
					<p>- Training (Part Time)</p>
					<p>- Production</p>
					<p>- Special Training Course</p>
					<p>- Borella Institute</p>
					<p>- Director Bunglow</p><br>
				</div><br>
				<h4>Sections</h4>
				<div class="code">
					<p>CH</p>
					<p>EN</p>
					<p>VRS</p>
					<p>WS</p>
					<p>AM</p>
					<p>AC</p>
					<p>AE</p>
					<p>PE</p>
					<p>MW</p>
					<p>JM</p>
					<p>BSA</p>
					<p>BSB</p>
					<p>MTTC</p>
					<p>IM</p>
				</div>
				<div class="mean">
					<p>- Chassis</p>
					<p>- Engine</p>
					<p>- Vehicle Repair</p>
					<p>- Welding</p>
					<p>- Automobile</p>
					<p>- A/C</p>
					<p>- Auto Electrical</p>
					<p>- Power Electrical</p>
					<p>- Mill Wright</p>
					<p>- Jool Machine</p>
					<p>- Basic A</p>
					<p>- Basic B</p>
					<p>- MTTC</p>
					<p>- Megatonic</p>
				</div>	
		</div>
		<div class="form-area" style="width:30%; height:auto; padding-bottom: 3%; margin-top: 10%;">
			<div class="topBar">Job Number</div>
			<div class="numArea">
				<div class="numBox1">GT</div><div class="slash">/</div>
				<div class="numBox1">16</div><div class="slash">/</div>
				<div id="jobType" class="numBox1">-</div><div class="slash">/</div>
				<div id="secNum" class="numBox1">-</div><div class="slash">/</div>
				<div class="numBox1"><?php echo $index;?></div>
			</div>
		</div>
		<div class="next-button" style="margin-left:63%; margin-top:20%;"><input type="submit" name="next" value="Register"/></div>
		</form>
		<script type="text/javascript">
        		var input1 = document.getElementById('secCode');
        		var input2 = document.getElementById('JobT');
        		var div1 = document.getElementById('secNum');
        		var div2 = document.getElementById('jobType');
        		input1.onkeyup = function(){
        			div1.innerHTML = input1.value;
        			div2.innerHTML = input2.value;
    			}
		</script>
		
	</div>
</body>
</html>

	<!--<div class="pageArea" style="padding-left:5%; padding-top:7%;">
		<form method="post" action="register.php">
		<div class="cDetails" style="width: 70%; border:0; padding-top:3%;">
			<div class="regForm">
				<div class="info" style="width:100%;">
					<div class="topBar" style="padding:0.4%; width:100%;">Job Registration</div>
					<div class="topics" style="width:25%; margin-top:2%;">
						<ul>
							<li>Job Description : </li><br><br><br><br><br>
							<li>Job Type : </li><br><br>
							<li></li><br><br>
							<li>Section : </li><br><br>
							<li>Section Code : </li><br><br>
							<li>Job Number : </li><br><br>
							<li>Date : </li><br><br>
						</ul>
					</div>
					<div class="ans" style="width:65%; float:left; padding-left:1%;margin-top:2%;">
						<ul>
							<li><textarea style="font-size:0.85em; border: 0.05em solid #DFBEA8;" type="text" name="jobdes" cols="50" rows="5" input required="required"></textarea></li><br><br><br><br>
							<li><input style="margin-left:1px;" name="jobType" type="radio" value="PJ" input required="required"/>PJ
    							<input style="margin-left:8px;" name="jobType" type="radio" value="VM" input required="required"/>VM
    							<input style="margin-left:8px;" name="jobType" type="radio" value="BJ" input required="required"/>BJ</li><br><br><br>
    						<li><input style="margin-left:1px;" name="jobType" type="radio" value="M" input required="required"/>M
    							<input style="margin-left:8px;" name="jobType" type="radio" value="TRG" input required="required"/>TRG
    							<input style="margin-left:8px;" name="jobType" type="radio" value="PRG" input required="required"/>PRG
    							<input style="margin-left:8px;" name="jobType" type="radio" value="PR" input required="required"/>PR
    							<input style="margin-left:8px;" name="jobType" type="radio" value="STC" input required="required"/>STC
    							<input style="margin-left:8px;" name="jobType" type="radio" value="VTI" input required="required"/>VTI
    							<input style="margin-left:8px;" name="jobType" type="radio" value="DP" input required="required"/>DP</li><br><br>
							<li><input style="width:50%;" type="text" maxlength="16" id="sec" name="sec" input required="required"/></li><br><br>
							<li><input style="width:20%;" type="text" maxlength="4" id="secCode" name="secCode" input required="required"/></li><br><br>
							<li><input style="width:50%;" type="text" maxlength="13" id="jNo" name="jNo" input required="required"/></li><br><br>
							<li><input style="width:50%;" type="date" id="date" name="date"/></li><br><br>
						</ul>
					</div>
				</div>
			</div>
			<div class="links" style="margin-top: 0%; float:right; margin-right:10%;">
				<div class="next" ><input style="padding:60%; font-size:1em;" type="submit" name="next" value="Register"/></div>
			</div>
		</div>
		</form>
		
		<div class="contentArea" style="position:relative; width:23%; margin-right:1%; float:right;">
			<div class="detailArea">
				<h3>Abbreviations</h3><br>
				<h4>Job Categories</h4><br>
				<div class="code">
					<p>PJ</p>
					<p>VM</p>
					<p>BC</p>
					<p>M</p>
					<p>TRG</p>
					<p>PRG</p>
					<p>PR</p>
					<p>STC</p>
					<p>VTI</p>
					<p>DP</p>
				</div>
				<div class="mean">
					<p>- Private Jobs</p>
					<p>- Vehicle maintain</p>
					<p>- Bus Company</p>
					<p>- Institute Maintainance</p>
					<p>- Training (Full Time)</p>
					<p>- Training (Part Time)</p>
					<p>- Production</p>
					<p>- Special Training Course</p>
					<p>- Borella Institute</p>
					<p>- Director Bunglow</p><br>
				</div>
				<h4>Sections</h4><br>
				<div class="code">
					<p>CH</p>
					<p>EN</p>
					<p>VRS</p>
					<p>WS</p>
					<p>AM</p>
					<p>AC</p>
					<p>AE</p>
					<p>PE</p>
					<p>MW</p>
					<p>JM</p>
					<p>BSA</p>
					<p>BSB</p>
					<p>MTTC</p>
					<p>IM</p>
				</div>
				<div class="mean">
					<p>- Chassis</p>
					<p>- Engine</p>
					<p>- Vehicle Repair</p>
					<p>- Welding</p>
					<p>- Automobile</p>
					<p>- A/C</p>
					<p>- Auto Electrical</p>
					<p>- Power Electrical</p>
					<p>- Mill Wright</p>
					<p>- Jool Machine</p>
					<p>- Basic A</p>
					<p>- Basic B</p>
					<p>- MTTC</p>
					<p>- Megatonic</p><br>
				</div>	
			</div>
		</div>
	</div>-->




