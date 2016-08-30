<?php
	session_start();
	if(isset($_SESSION["section"])=="JO"){
		
	}
	else{
	 header("Location:");
	}
?>
<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<link rel="stylesheet" type="text/css" href="../CSS/index.css">
	<link rel="stylesheet" type="text/css" href="../CSS/viewJob.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'AccHeader.php'; ?>
	<div class="pageArea">
		<div class="contentArea" style="position:relative; width:75%; height:100%;">
			<div class="contentArea" style="width:100%; padding-left:0%; padding-right:0%;">
			<div class="detailArea" style="padding:0; border:0.2em solid #6B1A36; border-radius: 10px;">
			<!--<div class="profileImage"><img src="/images/user.png" /></div>-->
			<div class="logo" style="margin-top:10%; color: #575354; font-size:1.0em;">You are logged in as Account Office</div>
			<div class="buttonArea">
				<button>View Messages</button>
				<button id="b1">Add Comments</button>
				<button>Contacts</button>
			</div><br>
		</div>
		</div>
			<div class="windowBttn">
				<button><b>New Finised Jobs</b></button>
			</div>
			<div class="profInfo">
				<?php
					include 'config.php';
                    $sql = "SELECT job_no FROM account WHERE payORnot='F'ORDER BY job_no ";
					
                    if ($result = mysqli_query($conn,$sql)) {
                        $count = mysqli_num_rows($result);
                       
                        if($count >0){
                            echo "<table><tr><th> Job No </th><th> JobType </th><th> Section </th><th>Registered Date </th><th></th>";
                            while($row = mysqli_fetch_assoc($result)) {
                         // output data of each row
                            $no=$row["job_no"];
                            $jobtyp=mysqli_query($conn,"SELECT job_typ FROM jobservce WHERE job_no='$no'");
                            $jobtype=mysqli_fetch_assoc($jobtyp);
                            $re=mysqli_query($conn,"SELECT date FROM jobservce WHERE job_no='$no'");
                            $reg=mysqli_fetch_assoc($re);
                            $se=mysqli_query($conn,"SELECT sec_code FROM jobservce WHERE job_no='$no'");
                            $sec=mysqli_fetch_assoc($se);
                            $tem=$sec["sec_code"];
                            $section=mysqli_query($conn,"SELECT name FROM section WHERE code='$tem'");
                            $sect=mysqli_fetch_assoc($section);
                             echo "<tr><td><a href='AccView.php?id=$no'>" . $row["job_no"]. "</a></td><td><a href='AccView.php?id=$no'>" . $jobtype["job_typ"]. "</a></td><td><a href='AccView.php?id=$no'>" . $sect["name"]. "</a></td><td><a href='AccView.php?id=$no'>" . $reg["date"]. "</a></td></tr>";
                         }
                         echo "</table>";}
                     }else {
                         echo "No New Finised Jobs";
                    }
                ?>

					
				
			</div>
			<br>
			<div class="windowBttn">
				<button style="width:60%;"><b>Recently Registered Jobs</b></button>
			</div>
			<div class="profInfo">
				<?php
					include 'config.php';
                    $sql1 = "SELECT job_no FROM account WHERE payORnot !='F' ORDER BY gtpass_no DESC LIMIT 10";
					
                    if ($result = mysqli_query($conn,$sql1)) {
                        $count = mysqli_num_rows($result);
                       
                        if($count >0){
                            echo "<table><tr><th> Job No </th><th> Section </th><th> Amount </th><th>Pay Date </th><th></th>";
                            
                            while($row = mysqli_fetch_assoc($result)) {
                         // output data of each row
                            $no=$row["job_no"];
                            $paydate=mysqli_query($conn,"SELECT pay_date FROM account WHERE job_no='$no'");
                           	$date=mysqli_fetch_assoc($paydate);
                           	$amn=mysqli_query($conn,"SELECT total FROM account WHERE job_no='$no'");
                           	$amu=mysqli_fetch_assoc($amn);
                            $se=mysqli_query($conn,"SELECT sec_code FROM jobservce WHERE job_no='$no'");
                            $sec=mysqli_fetch_assoc($se);
                            $tem=$sec["sec_code"];
                            $section=mysqli_query($conn,"SELECT name FROM section WHERE code='$tem'");
                            $sect=mysqli_fetch_assoc($section);

                             echo "<tr><td><a href='AccView.php?id=$no'>" . $row["job_no"]. "</a></td><td><a href='AccView.php?id=$no'>" . $sect["name"]. "</a></td><td><a href='AccView.php?id=$no'>" . $amu["total"]. "</a></td><td><a href='AccView.php?id=$no'>" . $date["pay_date"]. "</a></td></tr>";
                         }
                         echo "</table>";}
                     }else {
                         echo "No New Finised Jobs";
                    }
                ?>
			</div>
		</div>
		<div class="contentArea" style="position:relative; width:23%; margin-right:1%; float:right;">
			<?php include 'details.php' ?>
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

	<!--Script to visible msg box-->
		<script>
			var msgBox = document.getElementById('comments');
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
		
	</div>
</body>

</html>