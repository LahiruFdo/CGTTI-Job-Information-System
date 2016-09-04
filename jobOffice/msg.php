<?php
	$sec = "JO";
	include_once '../config.php';
	$sql1 = mysqli_query($conn,"SELECT * FROM messages WHERE (t = '$sec' AND readBy = 'F') ORDER BY mDate DESC");
	$sql2 = mysqli_query($conn,"SELECT * FROM messages WHERE t = '$sec' ");
	$sql3 = mysqli_query($conn,"SELECT * FROM messages WHERE fr = '$sec' ");
	//$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
	//$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
	//$row3 = mysqli_fetch_array($sql3, MYSQL_ASSOC);

	function getSecName($code){
		switch($code){
			case "WE": $section ="Work Engineering Section (WE)"; break;
			case "JO": $section ="Job Office (JO)"; break;
			case "ACC": $section ="Accounts Office (ACC)"; break;
			case "CH": $section ="Chassis (CH)"; break;
			case "EN": $section ="Engine (EN)"; break;
			case "VRS": $section ="Vehicle Repair (VRS)"; break;
			case "WS": $section ="Welding (WS)"; break;
			case "AM": $section ="Automobile (AM)"; break;
			case "AC": $section ="A/C Section (AC)"; break;
			case "AE": $section ="Auto Electrical (AE)"; break;
			case "PE": $section ="Power Electrical (PE)"; break;
			case "MW": $section ="Mill Wright (MW)"; break;
			case "JM": $section ="Jool Machine (JM)"; break;
			case "BSA": $section ="Basic A (BSA)"; break;
			case "BSB": $section ="Basic B (BSB)"; break;
			case "MTTC": $section ="MTTC"; break;
			case "IM": $section ="Megatonic (IM)"; break;
			case "admin": $section = "Admin"; break;
		}
		return $section;
	}
?>

<!DOCTYPE HTML>

<html>
<head>
	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<link rel="stylesheet" type="text/css" href="../CSS/message.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
</head>

<body class="body">

	<?php include 'JOHeader.php'; ?>
	<div class="pageArea">
		<div class="notification-area">
			<div id="new-msg" class="newly-rec">
				<div class="message-header" style="height: 12%; padding-left: 2.5%;"><div class="notification"></div><div style="margin-left: 5%; position:relative;">New Messages</div></div>
				<div class="message-diplay-area">
					<?php
						if($sql1==true){
							$count = mysqli_num_rows($sql1);
							if($count>0){
								//echo "<form style='height:100%;' name='msg' method='POST' action=''>";
								while($row = mysqli_fetch_assoc($sql1)){
									$sName = getSecName($row['fr']);
									$date = $row['mDate'];
									$mID = $row['ID'];
									//echo "<input type='hidden' name='mid' value=".$mID.">";
									echo "<div class='display-block' onclick='getMessage1(this)' value=".$mID.">
										".$sName."
										</div>";
								}
								//echo "</form>";
							}
							else{echo "No new messages";}
						}
					?>
					<!--<div class="display-block" onclick="getMessage()">gsdgsdg</div>-->
				</div>
			</div>

			<div id="rec-msg" class="rec-message" >
				<div class="message-header" style="height: 12%;">Recieved Messages</div>
				<div id="de" class="message-diplay-area">
				<?php
					if($sql2==true){
						$count = mysqli_num_rows($sql1);
						if($count>0){
							while($row = mysqli_fetch_assoc($sql2)){
								$sName = getSecName($row['fr']);
								$mID = $row['ID'];
									//echo "<form style='height:100%;'>";
									//echo "<input type='hidden' name='mid' value=".$mID.">";
								echo "<div class='display-block' onclick='getMessage1(this)'>".$sName."</div>";
									//echo "</form>";
							}
						}
						else{echo "No new messages";}
					}						
				?>
					<!--<div class="display-block">gsdgsdg</div>-->
				</div>
				<script type="text/javascript">
					var objDiv = document.getElementById("de");
					objDiv.scrollTop = objDiv.scrollHeight;
				</script>
			</div>
			<div id="sen-msg" class="sent-message" >
				<div class="message-header" style="height: 12%;">Sent Messages</div>
				<div id="di" class="message-diplay-area">
				<?php
					if($sql3==true){
						$count = mysqli_num_rows($sql1);
						if($count>0){
							while($row = mysqli_fetch_assoc($sql3)){
								$sName = getSecName($row['t']);
								$mID = $row['ID'];
									//echo "<form style='height:100%;'>";
									//echo "<input type='hidden' name='mid' value=".$mID.">";
								echo "<div class='display-block' onclick='getMessage2(this)'>".$sName."</div>";
									//echo "</form>";
							}
						}
						else{echo "No new messages";}
					}						
				?>
				</div>
				<script type="text/javascript">
					var objDiv = document.getElementById("di");
					objDiv.scrollTop = objDiv.scrollHeight;
				</script>
			</div>
			<div id="read1" class="read-area1" value="">
				<?php
					//$msgID = $_POST['mID'];
						//echo $msgID;
					$sql = mysqli_query($conn,"SELECT * FROM messages WHERE ID='2'");
					$roww = mysqli_fetch_assoc($sql);

					echo "<div class='read-message-display'><div class='read-message-header'>From : <b>" .getSecName($roww['fr']). "</b></div><br>
									<div class='message'>"
										.$roww['content'].
									"</div>
								</div>";	
				?>
			</div>
			<div id="read2" class="read-area1" value="">
				<?php
			
						//echo "hi";
					//$msgID = "";
						//echo $msgID;
					$sql = mysqli_query($conn,"SELECT * FROM messages WHERE ID='2'");
					$roww = mysqli_fetch_assoc($sql);

					echo "<div class='read-message-display'><div class='read-message-header'>To : <b>" .getSecName($roww['t']). "</b></div><br>
									<div class='message'>"
										.$roww['content'].
									"</div>
								</div>";	
				?>
			</div>
		</div>
		<div class="message-area">
			<div id="newMsg" class="message-box" style="border:0; opacity:0.8;"><div class="inner">+</div><br><br>New Message</div>
			<div id="recMsg" class="message-box"><div class="inner"><-</div><br><br>Recieved Messages</div>
			<div id="senMsg" class="message-box"><div class="inner">-></div><br><br>Sent Messages</div>
			<div class="read-area">
				<div class="new-message" style="height:100%; width:100%;">
				<div class="message-header" >Send New Message</div>
				<form action="" method="POST">
				<div class="list">
					<dt><div class="form-fields" >To</div><div class="form-dots">:</div></dt>
					<dd><div class="form-inputs" >
						<div id="inp" onclick="searchFunction()" class="select-button">Click here to select a Section</div>
					</div></dd>
				</div><br>
					<div class="dropdown">
						<div id="Dropdown" class="dropdown-content">
						    <input type="text" placeholder="Search..." id="search" name="to" onkeyup="filterFunction()" value="">
						    <!--<option><div class="dropliast-a">WE</div><div class="dropliast-b">-</div><div class="dropliast-c">Work Engineering Section</div></option>-->
						    <option id="1" value="WE" onclick="getValue(this)" >Work Engineering Section ( WE )</option>
							<option id="2" value="JO" onclick="getValue(this)" >Job Office ( JO )</option>
							<option id="3" value="ACC" onclick="getValue(this)">Accounts Office	( ACC )</option>
						    <option id="4" value="CH" onclick="getValue(this)">Chassis ( CH )</option>
							<option id="5" value="EN" onclick="getValue(this)">Engine ( EN )</option>
							<option id="6" value="VRS" onclick="getValue(this)">Vehicle Repair ( VRS )</option>
							<option id="7" value="WS" onclick="getValue(this)">Welding ( WS )</option>
							<option id="8" value="AM" onclick="getValue(this)">Automobile ( AM )</option>
							<option id="9" value="AC" onclick="getValue(this)">A/C ( AC )</option>
							<option id="10" value="AE" onclick="getValue(this)">Auto Electrical ( AE )</option>
							<option id="11" value="PE" onclick="getValue(this)">Power Electrical ( PE )</option>
							<option id="12" value="MW" onclick="getValue(this)">Mill Wright ( MW )</option>
							<option id="13" value="JM" onclick="getValue(this)">Jool Machine ( JM )</option>
							<option id="14" value="BSA" onclick="getValue(this)">Basic A ( BSA )</option>
							<option id="15" value="BSB" onclick="getValue(this)">Basic B ( BSB )</option>
							<option id="16" value="MTTC" onclick="getValue(this)">MTTC ( MTTC )</option>
							<option id="17" value="IM" onclick="getValue(this)">Megatonic ( IM )</option>								
						</div>
					</div>
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
							var val = document.getElementById('search');
							val.value = input;
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

						function getMessage1(elem){
							//document.msg.submit();
							var message = document.getElementById('read1');
							message.style.display = "block";
						}

						function getMessage2(elem){
							var message = document.getElementById('read2');
							message.style.display = "block";
						}
					</script>

				<div class="list" style="margin-top:-3%;">
					<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Messsage</div><div class="form-dots1">:</div></dt>
					<dd><div class="form-inputs"><textarea type="text" name="msg" cols="50" rows="6" input required="required" style="border: 0.1em solid rgb(254,217,139);"></textarea></div></dd>
				</div><br>
				<input type="hidden" name="from" value="<?php echo "JO";?>">
				<input type="hidden" name="type" value="normal">
				<button type="submit" name="submit" class="send-button">SEND</button>
				</form>
				<?php
					if(isset($_POST['submit'])){include '../sendMsg.php';}
				?>
			</div>
			</div>
		</div>
		<script type="text/javascript">
			var event1 = document.getElementById('newMsg');
			var event2 = document.getElementById('recMsg');
			var event3 = document.getElementById('senMsg');
			var div1 = document.getElementById('new-msg');
			var div2 = document.getElementById('rec-msg');
			var div3 = document.getElementById('sen-msg');
			var div4 = document.getElementById('Dropdown');
			var inp = document.getElementById('inp');
			var re1 = document.getElementById('read1');
			var re2 = document.getElementById('read2');
			event1.onclick = function() {
				div1.style.display = 'block';
				div2.style.display = 'none';
				div3.style.display = 'none';
				//div4.style.display = 'none';

				event1.style.border = '0';
				event1.style.cursor = 'auto';
				event1.style.opacity = '0.8';

				event2.style.border = '0.15em solid red';
				event2.style.cursor = 'pointer';
				event2.style.opacity = '1';

				event3.style.border = '0.15em solid red';
				event3.style.cursor = 'pointer';
				event3.style.opacity = '1';

				re1.style.display = 'none';
				re2.style.display = 'none';
			}
			event2.onclick = function() {
				div2.style.display = 'block';
				div1.style.display = 'none';
				div3.style.display = 'none';
				//div4.style.display = 'none';

				event2.style.border = '0';
				event2.style.cursor = 'auto';
				event2.style.opacity = '0.8';

				event1.style.border = '0.15em solid red';
				event1.style.cursor = 'pointer';
				event1.style.opacity = '1';
				
				event3.style.border = '0.15em solid red';
				event3.style.cursor = 'pointer';
				event3.style.opacity = '1';

				re1.style.display = 'none';
				re2.style.display = 'none';
			}
			event3.onclick = function() {
			 	div3.style.display = 'block';
				div1.style.display = 'none';
				div2.style.display = 'none';
				//div4.style.display = 'none';

				event3.style.border = '0';
				event3.style.cursor = 'auto';
				event3.style.opacity = '0.8';

				event1.style.border = '0.15em solid red';
				event1.style.cursor = 'pointer';
				event1.style.opacity = '1';
				
				event2.style.border = '0.15em solid red';
				event2.style.cursor = 'pointer';
				event2.style.opacity = '1';

				re1.style.display = 'none';
				re2.style.display = 'none';
			}
		</script>
		
		
	</div>

</body>
</html>