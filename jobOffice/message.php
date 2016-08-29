<?php
	$sec = "JO";
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
			<div class="new-message">
				<div id="new-msg" class="message-header">New Message</div>
				<div class="list" style="margin-top:2%;">
					<dt><div class="form-fields" >To</div><div class="form-dots">:</div></dt>
					<dd><div class="form-inputs" >
						<div onclick="searchFunction()" class="select-button">Select a Section/Office</div>
					</div></dd>
				</div><br>
					<div class="dropdown">
						<div id="Dropdown" class="dropdown-content">
						    <input type="text" placeholder="Search..." id="search" onkeyup="filterFunction()">
						    <!--<option><div class="dropliast-a">WE</div><div class="dropliast-b">-</div><div class="dropliast-c">Work Engineering Section</div></option>-->
						    <option>Work Engineering Section ( WE )</option>
							<option>Job Office ( JO )</option>
							<option>Accounts Office	( ACC )</option>
						    <option>Chassis ( CH )</option>
							<option>Engine ( CH )</option>
							<option>Vehicle Repair ( VRS )</option>
							<option>Welding ( WS )</option>
							<option>Automobile ( AM )</option>
							<option>A/C ( AC )</option>
							<option>Auto Electrical ( AE )</option>
							<option>Power Electrical ( PE )</option>
							<option>Mill Wright ( MW )</option>
							<option>Jool Machine ( JM )</option>
							<option>Basic A ( BSA )</option>
							<option>Basic B ( BSB )</option>
							<option>MTTC ( MTTC )</option>
							<option>Megatonic ( IM )</option>
						</div>
					</div>
					<script type="text/javascript">

						//var modal = document.getElementById("Dropdown");
						function searchFunction() {
						    document.getElementById("Dropdown").style.display="block";
						}

						/*window.onclick = function(event) {
						    if (event.target == modal) {
						        modal.style.display = "none";
						    }
						}*/

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
					</script>
				<div class="list">
					<dt><div class="form-fields" style="padding-top: 3.2%; padding-bottom: 1%;">Messsage</div><div class="form-dots1">:</div></dt>
					<dd><div class="form-inputs"><textarea type="text" name="message cols="50" rows="6" input required="required"></textarea></div></dd>
				</div><br>
			</div>
			<div id="rec-msg" class="rec-message">
				<div class="message-header">Recieved Messages</div>
				gdhdd
			</div>
			<div id="sen-msg" class="sent-message">
				<div class="message-header">Sent Messages</div>
				gdxxxgxhxhhhdd
			</div>
		</div>
		<div class="message-area">
			<div id="newMsg" class="message-box" style="border:0; opacity:0.8;"><div class="inner">+</div><br><br>New Message</div>
			<div id="recMsg" class="message-box"><div class="inner"><-</div><br><br>Recieved Messages</div>
			<div id="senMsg" class="message-box"><div class="inner">-></div><br><br>Sent Messages</div>
		</div>
		<script type="text/javascript">
			var event1 = document.getElementById('newMsg');
			var event2 = document.getElementById('recMsg');
			var event3 = document.getElementById('senMsg');
			var div1 = document.getElementById('new-msg');
			var div2 = document.getElementById('rec-msg');
			var div3 = document.getElementById('sen-msg');
			var div4 = document.getElementById('Dropdown');
			event1.onclick = function() {
				div1.style.display = 'block';
				div2.style.display = 'none';
				div3.style.display = 'none';
				div4.style.display = 'none';

				event1.style.border = '0';
				event1.style.cursor = 'auto';
				event1.style.opacity = '0.8';

				event2.style.border = '0.15em solid red';
				event2.style.cursor = 'pointer';
				event2.style.opacity = '1';

				event3.style.border = '0.15em solid red';
				event3.style.cursor = 'pointer';
				event3.style.opacity = '1';
			}
			event2.onclick = function() {
				div2.style.display = 'block';
				div1.style.display = 'none';
				div3.style.display = 'none';
				div4.style.display = 'none';

				event2.style.border = '0';
				event2.style.cursor = 'auto';
				event2.style.opacity = '0.8';

				event1.style.border = '0.15em solid red';
				event1.style.cursor = 'pointer';
				event1.style.opacity = '1';
				
				event3.style.border = '0.15em solid red';
				event3.style.cursor = 'pointer';
				event3.style.opacity = '1';
			}
			event3.onclick = function() {
			 	div3.style.display = 'block';
				div1.style.display = 'none';
				div2.style.display = 'none';
				div4.style.display = 'none';

				event3.style.border = '0';
				event3.style.cursor = 'auto';
				event3.style.opacity = '0.8';

				event1.style.border = '0.15em solid red';
				event1.style.cursor = 'pointer';
				event1.style.opacity = '1';
				
				event2.style.border = '0.15em solid red';
				event2.style.cursor = 'pointer';
				event2.style.opacity = '1';
			}
		</script>
		
		
	</div>

</body>
</html>