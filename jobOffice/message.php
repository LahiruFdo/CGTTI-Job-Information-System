<?php
	
	session_start();
	if(isset($_SESSION["section"])){
		$sec = $_SESSION["section"];
	}
	include_once '../config.php';
	
	/*
	$sql1 = mysqli_query($conn,"SELECT * FROM messages WHERE (t = '$sec' AND readBy = 'F') ORDER BY mDate DESC");
	$sql2 = mysqli_query($conn,"SELECT * FROM messages WHERE t = '$sec' ");
	$sql3 = mysqli_query($conn,"SELECT * FROM messages WHERE fr = '$sec' ");
	//$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
	//$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
	//$row3 = mysqli_fetch_array($sql3, MYSQL_ASSOC);

	}*/
	$CH = $EN = $VRS = $WS = $AM = $AC = $AE = $PE = $MW = $JM = $BSA = $BSB = $MTTC = $IM = $JO = $WE = $ACC = 0;

	if(isset($_GET['id'])){
		$toMsg = $_GET['id'];
		$sql00 = "UPDATE messages SET readBy = 'T' WHERE fr='$toMsg'";
		$update = new DatabaseCon($conn);
		$upResult = $update->getConnection($sql00);
	}

	$sqlQ0 = "SELECT ID,fr FROM messages WHERE ( t='$sec' AND readBy='F' AND ( type='normal' OR type='notification'))";
	$msgCount = new DatabaseCon($conn);
	$msgResult0 = $msgCount->getConnection($sqlQ0);
	while($msgRow = $msgCount->getoutput($msgResult0)){
		$fSec = $msgRow['fr'];
		switch($fSec){
			case "WE": $WE += 1 ; break;
			case "JO": $JO += 1 ; break;
			case "ACC": $ACC += 1 ; break;
			case "CH": $CH += 1 ; break;
			case "EN": $EN += 1 ; break;
			case "VRS": $VRS += 1 ; break;
			case "WS": $WS += 1 ; break;
			case "AM": $AM += 1 ; break;
			case "AC": $AC += 1 ; break;
			case "AE": $AE += 1 ; break;
			case "PE": $PE += 1 ; break;
			case "MW": $MW += 1 ; break;
			case "JM": $JM += 1 ; break;
			case "BSA": $BSA += 1 ; break;
			case "BSB": $BSB += 1 ; break;
			case "MTTC": $MTTC += 1 ; break;
			case "IM": $IM += 1 ; break;
		}
	}

	function getMsgCount($section){
		if($section==0){
			echo "";
		}
		else{
			echo "<div class='notification-circle'>".$section." New</div>" ;
		}
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
			<div class="topBar" style="background-color: rgb(236,104,118);">Sections / Offices</div>
			<div id="Dropdown">
				<input type="text" placeholder="Search..." id="search" name="to" onkeyup="filterFunction()" value="">
				<div style="overflow:auto; max-height:50%;">
				<ul>
				<a href="message.php?id=WE"><li id="1" value="WE" style="border-top:0.1em solid #403D3E;"> Work Engineering Section ( WE ) 
					<?php getMsgCount($WE); ?></li></a>
				<a href="message.php?id=JO"><li id="2" value="JO"> Job Office ( JO )
					<?php getMsgCount($JO); ?></li></a>
				<a href="message.php?id=ACC"><li id="3" value="ACC"> Accounts Office ( ACC )
					<?php getMsgCount($ACC); ?></li></a>
				<a href="message.php?id=CH"><li id="4" value="CH"> Chassis ( CH )
					<?php getMsgCount($CH); ?></li></a>
				<a href="message.php?id=EN"><li id="5" value="EN"> Engine ( EN )
					<?php getMsgCount($EN); ?></li></a>
				<a href="message.php?id=VRS"><li id="6" value="VRS"> Vehicle Repair ( VRS )
					<?php getMsgCount($VRS); ?></li></a>
				<a href="message.php?id=WS"><li id="7" value="WS"> Welding ( WS )
					<?php getMsgCount($WS); ?></li></a>
				<a href="message.php?id=AM"><li id="8" value="AM"> Automobile ( AM )
					<?php getMsgCount($AM); ?></li></a>
				<a href="message.php?id=AC"><li id="9" value="AC"> A/C ( AC )
					<?php getMsgCount($AC); ?></li></a>
				<a href="message.php?id=AE"><li id="10" value="AE"> Auto Electrical ( AE )
					<?php getMsgCount($AE); ?></li></a>
				<a href="message.php?id=PE"><li id="11" value="PE"> Power Electrical ( PE )
					<?php getMsgCount($PE); ?></li></a>
				<a href="message.php?id=MW"><li id="12" value="MW"> Mill Wright ( MW )
					<?php getMsgCount($MW); ?></li></a>
				<a href="message.php?id=JM"><li id="13" value="JM"> Jool Machine ( JM )
					<?php getMsgCount($JM); ?></li></a>
				<a href="message.php?id=BSA"><li id="14" value="BSA"> Basic A ( BSA )
					<?php getMsgCount($BSA); ?></li></a>
				<a href="message.php?id=BSB"><li id="15" value="BSB"> Basic B ( BSB )
					<?php getMsgCount($BSB); ?></li></a>
				<a href="message.php?id=MTTC"><li id="16" value="MTTC"> MTTC ( MTTC )
					<?php getMsgCount($MTTC); ?></li></a>
				<a href="message.php?id=IM"><li id="17" value="IM"> Megatonic ( IM )
					<?php getMsgCount($IM); ?></li></a>
				</ul>						
			</div>
			</div>
			<script type="text/javascript">
				function checkMyValue($sec){ /* this does not work */
					alert($sec);
					for(i=0; i<18; i++){
						var f = i
						var c = document.getElementById(f);
							alert(c.value);
						}
					}
				}
			</script>
		</div>
		<div id="NewMsg" class="message-area">
			<div class="read-area">
				<div class="new-message" style="height:100%; width:100%;">
				<form action="../sendMsg.php" method="POST">
					<div class="message-header" >Send New Message</div>
					<div class="list">
					<dt><div class="form-fields" style="padding-left:10%;">To</div><div class="form-dots">:</div></dt>
					<dd><div class="form-inputs" >
						<div id="inp" onclick="searchFunction()" class="select-button" style="width:66%;">Click here to select a Section</div>
					</div></dd>
					</div>

					<div class="dropdown" style="margin-top:4%; margin-left:37%;">
						<div id="Dropdown1" class="dropdown-content" style="overflow-y:hidden;">
						    <input type="text" placeholder="Search..." id="search1" name="to" onkeyup="filterFunction1()" value="">
						    <!--<option><div class="dropliast-a">WE</div><div class="dropliast-b">-</div><div class="dropliast-c">Work Engineering Section</div></option>-->
						    <option id="WE" value="WE" onclick="getValue(this)" style="background-color: #575354;">Work Engineering Section ( WE )</option>
							<option id="JO" value="JO" onclick="getValue(this)" style="background-color: #575354;">Job Office ( JO )</option>
							<option id="ACC" value="ACC" onclick="getValue(this)" style="background-color: #575354;">Accounts Office ( ACC )</option>
						    <option id="CH" value="CH" onclick="getValue(this)" style="background-color: #575354;">Chassis ( CH )</option>
							<option id="EN" value="EN" onclick="getValue(this)" style="background-color: #575354;">Engine ( EN )</option>
							<option id="VRS" value="VRS" onclick="getValue(this)" style="background-color: #575354;">Vehicle Repair ( VRS )</option>
							<option id="WS" value="WS" onclick="getValue(this)" style="background-color: #575354;">Welding ( WS )</option>
							<option id="AM" value="AM" onclick="getValue(this)" style="background-color: #575354;">Automobile ( AM )</option>
							<option id="AC" value="AC" onclick="getValue(this)" style="background-color: #575354;">A/C ( AC )</option>
							<option id="AE" value="AE" onclick="getValue(this)" style="background-color: #575354;">Auto Electrical ( AE )</option>
							<option id="PE" value="PE" onclick="getValue(this)" style="background-color: #575354;">Power Electrical ( PE )</option>
							<option id="MW" value="MW" onclick="getValue(this)" style="background-color: #575354;">Mill Wright ( MW )</option>
							<option id="JM" value="JM" onclick="getValue(this)" style="background-color: #575354;">Jool Machine ( JM )</option>
							<option id="BSA" value="BSA" onclick="getValue(this)" style="background-color: #575354;">Basic A ( BSA )</option>
							<option id="BSB" value="BSB" onclick="getValue(this)" style="background-color: #575354;">Basic B ( BSB )</option>
							<option id="MTTC" value="MTTC" onclick="getValue(this)" style="background-color: #575354;">MTTC ( MTTC )</option>
							<option id="IM" value="IM" onclick="getValue(this)" style="background-color: #575354;">Megatonic ( IM )</option>								
						</div>
					</div>

					<div class="list" style="margin-top:-3%;">
					<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%; padding-left:10%;">Messsage</div><div class="form-dots1">:</div></dt>
					<dd><div class="form-inputs"><textarea type="text" name="msg" cols="50" rows="6" input required="required" style="border: 0.1em solid rgb(254,217,139);"></textarea></div></dd>
					</div><br>
					<input type="hidden" name="from" value="<?php echo $sec;?>">
					<input type="hidden" name="type" value="normal">
					<button type="submit" name="submit" class="send-button" style="background-color: rgb(236,104,118);">SEND</button>
				</form>
				</div>
			</div>
		</div>

		
		<?php
			if(isset($_GET['id'])){
				$msgSec = $_GET['id'];

					function getSecName($id){
						$secName = "";
						switch($id){
								case "WE": $secName="Work Engineering Section (WE)"; break;
								case "JO": $secName="Job Office (JO)"; break;
								case "ACC": $secName="Accounts Office (ACC)"; break;
								case "CH": $secName="Chassis (CH)"; break;
								case "EN": $secName="Engine (EN)"; break;
								case "VRS": $secName="Vehicle Repair (VRS)"; break;
								case "WS": $secName="Welding (WS)"; break;
								case "AM": $secName="Automobile (AM)"; break;
								case "AC": $secName="A/C Section (AC)"; break;
								case "AE": $secName="Auto Electrical (AE)"; break;
								case "PE": $secName="Power Electrical (PE)"; break;
								case "MW": $secName="Mill Wright (MW)"; break;
								case "JM": $secName="Jool Machine (JM)"; break;
								case "BSA": $secName="Basic A (BSA)"; break;
								case "BSB": $secName="Basic B (BSB)"; break;
								case "MTTC": $secName="MTTC"; break;
								case "IM": $secName="Megatonic (IM)"; break;
							}
					return $secName;
					}
				echo "<div class='conversation-area'>";
				echo "<div class='topBar' style='background-color: rgb(236,104,118);'>".getSecName($msgSec)."</div>";

				$sqlQ = "SELECT fr,t,mDate,content,type FROM messages WHERE ((fr='$sec' AND t='$msgSec') OR (t='$sec' AND fr='$msgSec')) ORDER BY mDate ";
				$msgList = new DatabaseCon($conn);
				$msgResult1 = $msgList->getConnection($sqlQ);

				echo "<div id='scroll' class='inner-area'>";

				while($msgRow = $msgList->getoutput($msgResult1)){
					if($msgRow['t']==$sec){
						if($msgRow['type']=='normal'){
							echo 	"<div class='message-box'>
										<div class='message-box-from'><P>".$msgRow['content']."</P>
											<div class='date-from'>".$msgRow['mDate']."</div>
										</div>		
								   </div>";
						}
						else if ($msgRow['type']=='notification') {
							echo 	"<div class='message-box'>
										<div class='message-box-from'><P style='color:rgb(236,104,118);'>".$msgRow['content']."</P>
											<div class='date-from' style='color:#fff'>".$msgRow['mDate']."</div>
										</div>		
								   </div>";
						}
					}
					else if ($msgRow['fr']==$sec){
						if($msgRow['type']=='normal'){
							echo 	"<div class='message-box'>
										<div class='message-box-to'><P>".$msgRow['content']."</P>
											<div class='date-to'>".$msgRow['mDate']."</div>
										</div>	
									</div>";
						}
						else if ($msgRow['type']=='notification') {
							echo 	"<div class='message-box'>
										<div class='message-box-to'><P style='color:rgb(236,104,118);'>".$msgRow['content']."</P>
											<div class='date-to' style='color:#fff'>".$msgRow['mDate']."</div>
										</div>	
									</div>";
						}
					}
				}
				echo "</div>";

				echo 	"<div class='message-write-area'>
						<form action='../sendMsg.php' method='POST'>
						<textarea type='text' name='msg' cols='50' rows='5' input required='required' style='border: 0.1em solid rgb(254,217,139);'' placeholder='Type your message here.......''></textarea>
						<input type='hidden' name='to' value=".$msgSec.">
						<input type='hidden' name='from' value=".$sec.">
						<input type='hidden' name='type' value='normal'>
						<button type='submit' name='submit' class='send-button-to'>>>></button>
						</form>
						</div>";
		        echo "</div>";
	
			}
		?>
	</div>
			
			<!--<div id="scroll" class="inner-area">
				<div class="message-box">
					<div class="message-box-from"><P>fafadadfa svsdsb jfjgjfgjgjf gfggdfgd fg</P>
						<div class="date-from">2016-09-02</div>
					</div>		
				</div>
				<div class="message-box">
					<div class="message-box-to"><P>ogdfnd vofbnd nff d b f bffdsdag affgdg fgwg faggw fsfsg ffff fsvsgs fsddfsdg vsfsfsg sfsfsg fdfs</P>
						<div class="date-to">2016-09-02</div>
					</div>	
				</div>
			</div>-->
			<script type="text/javascript">
				var element = document.getElementById("scroll");
				element.scrollTop = element.scrollHeight;
			</script>
					
					
	<!-- Script to above functions -->
					<script type="text/javascript">

						//var modal = document.getElementById("Dropdown");

						function searchFunction() {
						    document.getElementById("Dropdown1").classList.toggle("show");
						}

						window.onclick = function(event) {
							  if (!event.target.matches('.select-button')) {
							  	if (!event.target.matches('#search1')){
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
						    a = div.getElementsByTagName("li");
						    for (i = 0; i < a.length; i++) {
						        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
						            a[i].style.display = "";
						        } else {
						            a[i].style.display = "none";
						        }
						    }
						}

						function filterFunction1() {
						    var input, filter, ul, li, a, i;
						    input = document.getElementById("search1");
						    filter = input.value.toUpperCase();
						    div = document.getElementById("Dropdown1");
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
							var val = document.getElementById('search1');
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

					</script>
		
	

</body>
</html>