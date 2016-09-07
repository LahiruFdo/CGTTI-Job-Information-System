<?php
	include '../config.php';

	
	
		$jobNo = $_GET['id'];

		
                			$no=$jobNo;
                  			$jobtyp=mysqli_query($conn,"SELECT job_typ FROM jobservce WHERE job_no='$no'");
                            $jobtype=mysqli_fetch_assoc($jobtyp);
                            $j=$jobtype["job_typ"];
             				$day=mysqli_query($conn,"SELECT pay_date FROM account WHERE job_no='$no'");
							$daya=mysqli_fetch_assoc($day);
							$date=$daya["pay_date"];
             			

             				
                            $m=mysqli_query($conn,"SELECT man_hrs FROM job WHERE job_no='$no'  ");
                            $ma = mysqli_fetch_assoc($m);
                            $man = $ma["man_hrs"];
                            
                            $mc=mysqli_query($conn,"SELECT mach_hrs FROM job WHERE job_no='$no'  ");
                            $mch=mysqli_fetch_assoc($mc);
                            $ba=$mch["mach_hrs"];
                            
                           
                            $day=mysqli_query($conn,"SELECT * FROM account WHERE job_no='$no'");
							$daya=mysqli_fetch_assoc($day);
							$date=$daya["pay_date"];
							$tot=$daya["total"];
							$amo=$daya["amount"];
							$v=$daya["VAT"];
							$e=$daya["extra"];
							$inv=$daya["invoice_no"];
							$gt=$daya["gtpass_no"];

                            $sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$no'");
							$row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
							$vNo= $row4['v_no'];

							$sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE v_no = '$vNo'");
							$row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);
							
							



	

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
	<?php include 'ACCHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana';">
		<div class="titleArea">
			<div class="theme"><h1>Job No. :- <span class="Number"><?php echo $jobNo; ?></span></h1><br><h2>    VOUCHER</h2></div>
			
		</div>
		<div class="jDetails">
			<div class="topBar">job Details</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Total man.h(h) :</li><br><br>
						<li>Total mach.h(h) :</li><br><br>
						<li>Amount(LKR) :</li><br><br>
						<li>VAT(LKR) :</li><br><br>
						<li>Extra(LKR) :</li><br><br>
						<li><h3>Total(LKR) :</h3></li><br><br>
						
					</ul>
				</div>
				<div class="ans">
					<?php echo "<ul><li>".$man."</li><br><br>
									<li>".$ba."</li><br><br>
									<li>".$amo."</li><br><br>
									<li>".$v."</li><br><br>
									<li>".$e."</li><br><br>
									<li><h3>".$tot."</h3></li><br><br>
									
					</ul>";?>
				</div>
			</div>
			
			
		</div>
		<div class="cDetails">
			<div class="topBar">Other Details</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Pay Date :</li><br><br>
						<li>Invoice No. :</li><br><br>
						<li>GatePass No. :</li><br><br>
					</ul>
				</div>
				<div class="ans">
					<?php echo "<ul><li>".$date."</li><br><br>
									<li>".$inv."</li><br><br>
									<li>".$gt."</li><br><br>
					</ul>"	;
					?>
				</div>
			</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Customer Name :</li><br><br>
						<li>Contacts :</li><br><br>
						<li>Email :</li><br><br>
						<li>Address :</li><br><br><br><br>
						<li>Vehicle No :</li><br><br>
					</ul>
				</div>
				<div class="ans">
					<?php 
						echo "<ul><li>".$row5['name']."</li><br><br>
										<li>".$row5['contact_no']."</li><br><br>
										<li>".$row5['email']."</li><br><br>
										<li><p>".$row5['address']."<br><br><br><br></p></li>
										<li>".$vNo."</li><br><br><br><br><br><br><br>
					</ul>";?>
					<br><br>
				</div>
			</div>
		</div>
		<div class="links">
			<div class="butArea">
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}


.button4 {border-radius: 12px;}

</style>
				<?php 
				
				echo 
				"<a href='invoice2.php?id=$jobNo' ><button class='button button4'>Print Again</button></a>";
				?>
			</div>
		</div>
	</div>
	

	
</body>
</html>
 