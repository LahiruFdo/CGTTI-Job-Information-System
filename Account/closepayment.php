
<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/button.css">
	<link rel="stylesheet" type="text/css" href="../CSS/view.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
		<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'AccHeader.php'; ?>
	<div class="pageArea">
		<form action="search.php" method="GET">
		<div class="search-button"><button id="b" type="submit">GO</button></div>
		<div class="search" style="width:27%;">
		
			<div class="searchName" style="padding-top:2.4%;">Search</div>
			<div class="searchBar"><input id="search" name="searchItem" type="text" placeholder="Search Here"/></div>

		</div>
		</form>

		
			
			
			<div class="page-area4">
			<div class="windowBttn">
				<b>Recently closed Jobs</b>
			</div>
			<div class="profInfo">
				<?php
					include "../config.php";
                    $sql1 = "SELECT job_no FROM account WHERE payORnot !='F' ORDER BY gtpass_no ";
					
                    $con = new DatabaseCon($conn);
                    if ($result = $con->getConnection($sql1)) {
                        $count = $con->getRowCount($result);
                       
                        if($count >0){
                            echo "<table><tr><th> Job No </th><th> Section </th><th> Amount </th><th>Pay Date </th>";
                            
                            while($row = $con->getoutput($result)) {
                         // output data of each row
                            $no=$row["job_no"];
                            $sql6="SELECT pay_date FROM account WHERE job_no='$no'";
                            $paydate=$con->getConnection($sql6);
                           	$date=$con->getoutput($paydate);
                           	$sql7="SELECT total FROM account WHERE job_no='$no'";
                           	$amn=$con->getConnection($sql7);
                           	$amu=$con->getoutput($amn);
                           	$sql8="SELECT sec_code FROM jobservce WHERE job_no='$no'";
                            $se=$con->getConnection($sql8);
                            $sec=$con->getoutput($se);
                            $tem=$sec["sec_code"];
                            $sql9="SELECT name FROM section WHERE code='$tem'";
                            $section=$con->getConnection($sql9);
                            $sect=$con->getoutput($section);

                             echo "<tr><td><a href='AccView2.php?id=$no'>" . $row["job_no"]. "</a></td><td><a href='AccView2.php?id=$no'>" . $sect["name"]. "</a></td><td><a href='AccView2.php?id=$no'>" . $amu["total"]. "</a></td><td><a href='AccView2.php?id=$no'>" . $date["pay_date"]. "</a></td></tr>";
                         }
                         echo "</table>";}
                     }else {
                         echo "No New Finised Jobs";
                    }
                ?>
			</div>
		</div>
		
		


<!--Job message box-->
		<div id="comments" class="msgWindow">
			<div class="msgBody">
				<span class="close">x</span>
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
	<!--Job message box-->

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
					if(isset($_POST['submit'])){include '../sendMsg.php';}
				?>
			</div>
		</div>
	<!--Comments box-->

	<!--details box-->
		<div id="details" class="msgWindow" style="width:150%; margin-left:-25%;">
			<div class="msgBody">
				<span id="c2" class="close">x</span>
				<?php include '../details.php';?>
			</div>
		</div>
	<!--details box-->

	<!--details box-->
		<div id="contacts" class="msgWindow">
			<div class="msgBody">
				<span id="c3" class="close"><h3>x</h3></span>
				<div class="contact-details">
				<h2>Contacts</h2>
				</div>
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