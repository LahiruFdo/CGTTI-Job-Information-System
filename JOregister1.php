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
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-top:10%;">
		<form method="post" action="JOregister2.php">
		<div class="jDetails" style="width:55%">
			
			<div class="regForm">
				<div class="topBar" style="padding:0.4%;">Customer Registration</div>
				<div class="info">
					<div class="topics" style="width:25%;">
						<ul>
							<li>Customer Name : </li><br><br>
							<li>NIC No. : </li><br><br>
							<li>Tele. No. : </li><br><br>
							<li>Email : </li><br><br>
							<li>Address : </li><br><br>
						</ul>
					</div>
					<div class="ans" style="width:70%; float:left; padding-left:1%;">
						<ul>
							<li><input type="text" id="name" name="name" input required="required" /></li><br><br>
							<li><input style="width:50%;" type="text" maxlength="10" id="nic" name="nic" input required="required"/></li><br><br>
							<li><input style="width:50%;" type="text" maxlength="10" id="tele" name="tele" input required="required"/></li><br><br>
							<li><input type="text" type="email" id="email" name="email" placeholder="  example@123.com" /></li><br><br>
							<li><textarea style="font-size:0.8em; border: 0.05em solid #DFBEA8; cursor:auto;" type="text" name="adrs" cols="50" rows="4" input required="required"></textarea></li><br><br><br>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
		<div class="cDetails" style="border-right:0;">
			<div class="regForm">
		
				<div class="topBar" style="padding:0.4%;">Vehicle Registration</div>
				<div class="info" style="margin-top:8%;">
					<div class="topics" style="width:35%;">
						<ul>
							<li>Vehicle No. : </li><br><br>
							<li>Engine No. : </li><br><br>
							<li>Chessis No. : </li><br><br>
							<li>Fuel Type : </li><br><br>
							<li>Transmission Type : </li><br><br>
						</ul>
					</div>
					<div class="ans" style="width:65%; float:left; padding-left:1%;">
						<ul>
							<li><input style="width:70%;" type="text" maxlength="10" id="vno" name="vno" input required="required"/></li><br><br>
							<li><input style="width:70%;" type="text" maxlength="10" id="eno" name="eno" /></li><br><br>
							<li><input style="width:70%;" type="text" maxlength="10" id="cno" name="cno"/></li><br><br>
							<li><input style="margin-left:1px;" name="fuelType" type="radio" value="Diesel"/>Diesel
    							<input style="margin-left:8px;" name="fuelType" type="radio" value="Petrol"/>Petrol
    							<input style="margin-left:8px;" name="fuelType" type="radio" value="Gas"/>Gas</li><br><br>
							<li><input style="margin-left:1px;" name="transType" type="radio" value="Mannual"/>Mannual
    							<input style="margin-left:8px;" name="transType" type="radio" value="Auto"/>Auto</li><br><br>
						</ul><br><br><br>
					</div>
				</div>
			</div>
			
		</div>
		<div class="links" style="float:right; margin-right:10%;">
			<div class="next"><input type="submit" name="next" value="Next >>"/></div>
			</form>
		</div>
	</div>
	
</body>
</html>