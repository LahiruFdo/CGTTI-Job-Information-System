<!DOCTYPE html>

<html>
<head>
	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="CSS/index.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
</head>

<body class="body">
	<div class="header">
		<div class="header1">
			<img src="images/logo.png" id="imgleft">
			<div style="display: table-cell; vertical-align: middle; color: white; padding: 0; font-size: 30px;">
				Ceylon German Technical Training Institute
			</div>
		</div>
		<div class="header2">
			<div style="display: table-cell; vertical-align: middle;">
				Job Information system
			</div>
		</div>
	</div>
	<div class="container" style="background-color:  #fbf4db ;">
		<div class="sidebar" style="padding-top:3%;">
			<ul id="nav" style="margin-top:0%;">
				<li><a  style="border-top: 0.05em solid #403D3E; font-size:1.3em; padding-left:0; text-align: center;" href="http://www.cgtti.lk/">About Us</a></li>
				<li><a  style="padding-left:0px; font-size:1.3em; text-align: center;" href="http://www.cgtti.lk/">Contact Us</a></li>	
				<li><a  style="padding-left:0px; font-size:1.3em; text-align: center;" href="http://www.cgtti.lk/">Services</a></li>	
			</ul>
			<br>
			<img src="images/pic.png" style="width:100%;height:50%;">
		</div>
		<div class="content" style="background-color:  #fbf4db ;">
			<br>
			<div class="home">
				<div class="homeDetails">
					<h1 style="font-size: 3.2em;">Welcome to the CGTTI job informaion system !</h1><br>
					<img src="images/cgtti.jpg" alt="CGTTI Image" style="width:100%;height:30%;">
					<br><br>
					<p>This is the web information system about the job services that provided by the Ceylon German Technical Training Institue, Moratuwa.
					<span style="color:#6B1A36;"><I> You have to login first</I></span></p>
					<br>
					<h2 style="color: #6B1A36; font-size: 2.2em;">Our Services</h2>
					<br>
					<h3>Production / Repair</h3>
					<br>
					<p>CGTTI offers following production/repair services to the general public, private sector and public sector organizations at reasonable rates with state-of the-art machinery/equipments.</p><br>
					<ul>
					    <li>Vehicle Repairing</li>
					    <li>Vehicle Servicing</li>
					    <li>Wheel alignment</li>
					    <li>Engine Tuning</li>
					    <li>Engine Testing</li>
					    <li>Diesel Fuel Pump repairing & testing</li>
					    <li>Machining work</li>
					    <li>Welding work</li>
					    <li>Repairing of Electrical appliances, Refrigerators & A/C plants.</li>
					</ul><br>
					<h3>Vehicle Fitness Certificates</h3><br>
					<p>CGTTI is an authorized Institution to issue Vehicle Fitness Certificates for heavy and light vehicles.</p>
					<p>For further details contact Chief Engineer-Production and Maintenance under Contact Details of this website.</p><br>
					<h3>Conducting Trade Tests</h3><br>
					<p>CGTTI is providing consultancy facilities by conducting trade tests for local and foreign employment agencies.</p>
					<p>For further details contact Chief Training Engineer under Contact Details of this website.</p><br>
				</div>
				<div class="newsArea">
					<div class="nHeader" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">you have to login first</div>
					<div class="loginArea" style="height:400px;">
						<div class="loginBackground">
							<div class="inner">
								<form action="login.php" method="post">
									<ul id="login">
										<li> Username: <br>
											<input type="text" name="username" placeholder="username"></li>
										<li> Password: <br>
											<input type="password" name="password" placeholder="password"></li>
									</ul>
										<center> <input type="submit" style="background-color: #6B1A36; padding:4px; color:#fff; border:2px solid #fff; width:30%;" value="login"> </center>
									<br>
								</form>
							</div><br><br>
							<center><div id="Contacts"><button>Contact Details</button></div></center>
						</div>
					</div>
					<div class="nHeader" style="margin-top:8%; background-color:black;">Related Links</div>
					<div class="nContents"> <?php echo "L";?> </div>
				</div>
			<div id="popupWindow" class="popupWindow">
				<div class="contacts">
					<span class="close">x</span>
					<br>
					<h1>Contacts</h1>
					<br>
					<p>Work Engineering Section - 011 2 568 985</p>
					<p>Director - 011 2 569 569</p>
				</div>
			</div>
			
			<script>
				// Get the modal
				var modal = document.getElementById('popupWindow');

				// Get the button that opens the modal
				var btn = document.getElementById("Contacts");

				// Get the <span> element that closes the modal
				var span = document.getElementsByClassName("close")[0];

				// When the user clicks the button, open the modal 
				btn.onclick = function() {
				    modal.style.display = "block";
				}

				// When the user clicks on <span> (x), close the modal
				span.onclick = function() {
				    modal.style.display = "none";
				}

				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
				    if (event.target == modal) {
				        modal.style.display = "none";
				    }
				}
			</script>		
			</div>
		</div>
	</div>
</body>

</html>
