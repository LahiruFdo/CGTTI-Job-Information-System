<?php
	session_start();

	include_once ("../config.php");
	if(isset($_SESSION["section"])=="JO"){
		if(isset($_SESSION['name'], $_SESSION['nic'], $_SESSION['tele'], $_SESSION['email'], $_SESSION['adrs'], $_SESSION['vno'], $_SESSION['eno'], $_SESSION['cno'], $_SESSION['fueltyp'])){

			$sql = "SELECT job_typ, COUNT(*) AS 'total' FROM jobservce";
			$qry = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($qry);
			$index = $row['total']+1;

			if($index<10){$index = "00".$index;}
			else if($index<100){$index = "0".$index;}

			$_SESSION['index'] = $index;
		}
	}

	$CH = $EN = $VRS = $WS = $AM = $AC = $AE = $PE = $MW = $JM = $BSA = $BSB = $MTTC = $IM = 0;

	$sql1 = "SELECT sec_code, COUNT(sec_code) AS 'jobCount' FROM jobservce WHERE closedDate IS NULL GROUP BY sec_code";

	$cont = new DatabaseCon($conn);

	if($result = $cont->getConnection($sql1)){
		$count = $cont->getRowCount($result);
		if ($count >0){
			while($row= $cont->getoutput($result)){
				$job = $row['sec_code'];
				switch($job){
					case "CH": $CH = $row['jobCount']; break;
					case "EN": $EN = $row['jobCount']; break;
					case "VRS": $VRS = $row['jobCount']; break;
					case "WS": $WS = $row['jobCount']; break;
					case "AM": $AM = $row['jobCount']; break;
					case "AC": $AC = $row['jobCount']; break;
					case "AE": $AE = $row['jobCount']; break;
					case "PE": $PE = $row['jobCount']; break;
					case "MW": $MW = $row['jobCount']; break;
					case "JM": $JM = $row['jobCount']; break;
					case "BSA": $BSA = $row['jobCount']; break;
					case "BSB": $BSB = $row['jobCount']; break;
					case "MTTC": $MTTC = $row['jobCount']; break;
					case "IM": $IM = $row['jobCount']; break;
				}
			}
		}
	}

	function jobCnt($jobTyp){
		if($jobTyp > 9){return "<div class='red'></div>";}
		if($jobTyp > 6){return "<div class='yellow'></div>";}
		else{return "<div class='green'></div>";}
	}

?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/viewJob.css">
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<link rel="stylesheet" type="text/css" href="../CSS/message.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea">
		<form method="post" action="register.php" name="jobReg">
		<div class="form-area">
			<div class="topBar">Job Registration</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Section</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;"><div id="inp" class="select-button" style="border: 0.05em solid #DFBEA8; width: 81%;" 
					onclick="searchFunction()">Click here to select a Section</div>
				</dd>
			</div><br>
					<div class="dropdown" style="margin-top:5.8%; margin-left:35.3%;">
						<div id="Dropdown" class="dropdown-content" style="overflow-y:hidden;">
						    <input type="text" placeholder="Search..." id="search" name="to" onkeyup="filterFunction()" value="">
						    <!--<option><div class="dropliast-a">WE</div><div class="dropliast-b">-</div><div class="dropliast-c">Work Engineering Section</div></option>-->
						    <option id="CH" value="CH" onclick="getValue(this)">Chassis ( CH )</option>
							<option id="EN" value="EN" onclick="getValue(this)">Engine ( EN )</option>
							<option id="VRS" value="VRS" onclick="getValue(this)">Vehicle Repair ( VRS )</option>
							<option id="WS" value="WS" onclick="getValue(this)">Welding ( WS )</option>
							<option id="AM" value="AM" onclick="getValue(this)">Automobile ( AM )</option>
							<option id="AC" value="AC" onclick="getValue(this)">A/C ( AC )</option>
							<option id="AE" value="AE" onclick="getValue(this)">Auto Electrical ( AE )</option>
							<option id="PE" value="PE" onclick="getValue(this)">Power Electrical ( PE )</option>
							<option id="MW" value="MW" onclick="getValue(this)">Mill Wright ( MW )</option>
							<option id="JM" value="JM" onclick="getValue(this)">Jool Machine ( JM )</option>
							<option id="BSA" value="BSA" onclick="getValue(this)">Basic A ( BSA )</option>
							<option id="BSB" value="BSB" onclick="getValue(this)">Basic B ( BSB )</option>
							<option id="MTTC" value="MTTC" onclick="getValue(this)">MTTC ( MTTC )</option>
							<option id="IM" value="IM" onclick="getValue(this)">Megatonic ( IM )</option>								
						</div>
					</div>
			<div class="list">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Section Code</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;"><input style="width:22%;" type="text" maxlength="4" id="secCode" name="secCode" input required="required" readonly/></div>
				</dd>
			</div><br>
			<div class="list" style="padding:0%;">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Job Description </div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;">
				<textarea type="text" name="jobdes" cols="25" rows="4" input required="required"></textarea></div></dd>
			</div><br>
			<div class="list" style="padding:0%;">
			<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Job Type</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;">
					<div class="radio-tab"><input style="margin-top:2%;" name="jobType" type="radio" value="PJ" input required="required" onclick="handleClick(this);" />PJ</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="VM" input required="required" onclick="handleClick(this);" />VM</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="BJ" input required="required" onclick="handleClick(this);" />BJ</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="M" input required="required" onclick="handleClick(this);" />M</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="TRG" input required="required" onclick="handleClick(this);" />TRG</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="PRG" input required="required" onclick="handleClick(this);" />PRG</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="PR" input required="required" onclick="handleClick(this);" />PR</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="STC" input required="required" onclick="handleClick(this);" />STC</div><br>
    				<div class="radio-tab"><input name="jobType" type="radio" value="VTI" input required="required" onclick="handleClick(this);" />VTI</div>
    				<div class="radio-tab"><input name="jobType" type="radio" value="DP" input required="required" onclick="handleClick(this);" />DP</div><br>
				</div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Target Date</div><div class="form-dots1">:</div></dt>
				<dd><div class="form-inputs" style="padding-top: 3%; padding-bottom: 1%;"><input style="width:50%;" type="date" id="date" name="date" input required="required"/></div></dd>
			</div><br>
			
			</dl>
		</div>
		
		<div class="form-area" style="width:30%; height:auto; padding-bottom: 2%; margin-top: 2%;">
			<div class="topBar">Job Number</div>
			<div class="numArea">
				<div class="numBox1">GT</div><div class="slash">/</div>
				<div class="numBox1">16</div><div class="slash">/</div>
				<div id="jobType" class="numBox1">-</div><div class="slash">/</div>
				<div id="secNum" class="numBox1">-</div><div class="slash">/</div>
				<div class="numBox1"><?php echo $index;?></div>
			</div>
		</div>

		<div class="form-area" style="width:17%; margin-top: 2%; margin-left: 1%; background-color: rgb(255,249,230); border:0; padding: 0%">
				<table>
				<tr><th> Section </th><th> Ongoing Jobs </th><th> Status </th></tr>
				<tr><td><a value="CH" onclick="jobSeCount(this)" href="JOregister2.php?id=CH"> CH </a></td>
					<td><a value="CH" onclick="jobSeCount(this)" href="JOregister2.php?id=CH"><?php echo $CH ?></a></td>
					<td><a value="CH" onclick="jobSeCount(this)" href="JOregister2.php?id=CH"><?php echo jobCnt($CH); ?></a></td></tr>
				<tr><td><a value="EN" onclick="jobSeCount(this)" href="#"> EN </a></td>
					<td><a value="EN" onclick="jobSeCount(this)" href="#"><?php echo $EN ?></a></td>
					<td><a value="EN" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($EN); ?></a></td></tr>
				<tr><td><a value="VRS" onclick="jobSeCount(this)" href="#"> VRS </a></td>
					<td><a value="VRS" onclick="jobSeCount(this)" href="#"><?php echo $VRS ?></a></td>
					<td><a value="VRS" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($VRS); ?></a></td></tr>
				<tr><td><a value="WS" onclick="jobSeCount(this)" href="#"> WS </a></td>
					<td><a value="WS" onclick="jobSeCount(this)" href="#"><?php echo $WS ?></a></td>
					<td><a value="WS" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($WS); ?></a></td></tr>
				<tr><td><a value="AM" onclick="jobSeCount(this)" href="#"> AM </a></td>
					<td><a value="AM" onclick="jobSeCount(this)" href="#"><?php echo $AM ?></a></td>
					<td><a value="AM" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($AM); ?></a></td></tr>
				<tr><td><a value="AC" onclick="jobSeCount(this)" href="#"> AC </a></td>
					<td><a value="AC" onclick="jobSeCount(this)" href="#"><?php echo $AC ?></a></td>
					<td><a value="AC" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($AC); ?></a></td></tr>
				<tr><td><a value="AE" onclick="jobSeCount(this)" href="#"> AE </a></td>
					<td><a value="AE" onclick="jobSeCount(this)" href="#"><?php echo $AE ?></a></td>
					<td><a value="AE" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($AE); ?></a></td></tr>
				<tr><td><a value="PE" onclick="jobSeCount(this)" href="#"> PE </a></td>
					<td><a value="PE" onclick="jobSeCount(this)" href="#"><?php echo $PE ?></a></td>
					<td><a value="PE" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($PE); ?></a></td></tr>
				<tr><td><a value="MW" onclick="jobSeCount(this)" href="#"> MW </a></td>
					<td><a value="MW" onclick="jobSeCount(this)" href="#"><?php echo $MW ?></a></td>
					<td><a value="MW" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($MW); ?></a></td></tr>
				<tr><td><a value="JM" onclick="jobSeCount(this)" href="#"> JM </a></td>
					<td><a value="JM" onclick="jobSeCount(this)" href="#"><?php echo $JM ?></a></td>
					<td><a value="JM" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($JM); ?></a></td></tr>
				<tr><td><a value="BSA" onclick="jobSeCount(this)" href="#"> BSA </a></td>
					<td><a value="BSA" onclick="jobSeCount(this)" href="#"><?php echo $BSA ?></a></td>
					<td><a value="BSA" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($BSA); ?></a></td></tr>
				<tr><td><a value="BSB" onclick="jobSeCount(this)" href="#"> BSB </a></td>
					<td><a value="BSB" onclick="jobSeCount(this)" href="#"><?php echo $BSB ?></a></td>
					<td><a value="BSB" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($BSB); ?></a></td></tr>
				<tr><td><a value="MTTC" onclick="jobSeCount(this)" href="#"> MTTC </a></td>
					<td><a value="MTTC" onclick="jobSeCount(this)" href="#"><?php echo $MTTC ?></a></td>
					<td><a value="MTTC" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($MTTC); ?></a></td></tr>
				<tr><td><a value="IM" onclick="jobSeCount(this)" href="#"> IM </a></td>
					<td><a value="IM" onclick="jobSeCount(this)" href="#"><?php echo $IM ?></a></td>
					<td><a value="IM" onclick="jobSeCount(this)" href="#"><?php echo jobCnt($IM); ?></a></td></tr>
				</table>
		</div>

		<div class="form-area" style="width: 12%; height: auto; padding-right:0; padding-left:0.5; margin-top: 11%; margin-left: 39.7%; position: absolute;">
				<h4>Job Categories</h4><br>
				<div class="code" style="font-size: 0.7em;">
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
				<div class="mean" style="font-size: 0.7em;">
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
		</div>
		<div class="form-area" style="width: 11%; height: auto; padding-right:0; padding-left:0.5; margin-top: 11%; margin-left: 53%; position: absolute;">
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
					<p><br></p>
					<p>- Megatonic</p><br><br><br>
				</div>	
		</div>



		<div class="next-button" style="margin-left:41.5%; margin-top:29%;"><input type="submit" name="next" value="Register"/></div>
		</form>
		
		<script>
		    var rad = document.jobReg.jobType;
		    function handleClick(myRadio){
		    	var div2 = document.getElementById('jobType');
		    	div2.innerHTML = myRadio.value;
		    }
		</script>

		<script type="text/javascript">

						//var modal = document.getElementById("Dropdown");

						function searchFunction() {
						    document.getElementById("Dropdown").classList.toggle("show");
						}

						window.onclick = function(event) {
							  if (!event.target.matches('.select-button')) {
							  	if (!event.target.matches('#search')){
							  		var dropdowns = document.getElementsByClassName("dropdown-content");
								    var i;
								    for (i = 0; i < dropdowns.length; i++) {
								      var openDropdown = dropdowns[i];
								      if (openDropdown.classList.contains('show')) {
								        openDropdown.classList.remove('show');
								      }
								    }
							  	}
							    
							  }
						}

						function filterFunction() {
						    var input, filter, ul, li, a, i;
						    input = document.getElementById("search");
						    filter = input.value.toUpperCase();
						    div = document.getElementById("Dropdown");
						    a = div.getElementsByTagName("option");
						    for (i = 0; i < a.length; i++) {
						        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
						            a[i].style.display = "";
						        } else {
						            a[i].style.display = "none";
						        }
						    }
						}

						function getValue(elem){
							var input = elem.value;
							var output = document.getElementById('inp');
							output.style.color = "black";
							var val = document.getElementById('secCode');
							val.value = input;
							var div1 = document.getElementById('secNum');
							div1.innerHTML = input;

							switch(input){
								case "WE": input="Work Engineering Section (WE)"; break;
								case "JO": input="Job Office (JO)"; break;
								case "ACC": input="Accounts Office (ACC)"; break;
								case "CH": input="Chassis (CH)"; break;
								case "EN": input="Engine (EN)"; break;
								case "VRS": input="Vehicle Repair (VRS)"; break;
								case "WS": input="Welding (WS)"; break;
								case "AM": input="Automobile (AM)"; break;
								case "AC": input="A/C Section (AC)"; break;
								case "AE": input="Auto Electrical (AE)"; break;
								case "PE": input="Power Electrical (PE)"; break;
								case "MW": input="Mill Wright (MW)"; break;
								case "JM": input="Jool Machine (JM)"; break;
								case "BSA": input="Basic A (BSA)"; break;
								case "BSB": input="Basic B (BSB)"; break;
								case "MTTC": input="MTTC"; break;
								case "IM": input="Megatonic (IM)"; break;
							}
							output.innerHTML = input;
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




