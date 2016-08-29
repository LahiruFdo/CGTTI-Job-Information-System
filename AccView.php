<?php
	include 'config.php';

	function get_jt($j){
		$type = "Private Job";
		switch($j){
			case "BC": $type = "Bus Company"; break;
			case "VM": $type = "Vehicle Maintain"; break;
		}
		return $type;
	}

	if (!isset($_GET['id'])){
    	echo 'No ID was given...';
    	exit;
	}
	else{
		$jobNo = $_GET['id'];

		
                			$no=$jobNo;
                  			$jobtyp=mysqli_query($conn,"SELECT job_typ FROM jobservce WHERE job_no='$no'");
                            $jobtype=mysqli_fetch_assoc($jobtyp);
                            $j=$jobtype["job_typ"];
             			
             				$mydate=getdate(date("U"));
             				$y=$mydate["year"];
             				$mn=$mydate["mon"];
             				$day=$mydate["mday"];
             				$date=$y."-".$mn."-".$day;

             				$gt=mysqli_query($conn,"SELECT MAX(gtpass_no) As maxx FROM account");
             				$gtp=mysqli_fetch_array($gt);
             				$mx=$gtp["maxx"];
             				$gtno=$mx+1;
                           	$in=mysqli_query($conn,"SELECT MAx(invoice_no) As ino FROM account");
             				$inv=mysqli_fetch_assoc($in);
             				$maxin=$inv["ino"];
             				$invno=$maxin+1;
                            $m=mysqli_query($conn,"SELECT man_hrs FROM job WHERE job_no='$no'  ");
                            $ma = mysqli_fetch_assoc($m);
                            $man = $ma["man_hrs"];
                            $m1=mysqli_query($conn,"SELECT man FROM extra ");
                            $ma1 = mysqli_fetch_assoc($m1);
                            $man1= $ma1["man"];
                            $a=$man*$man1;
                            $mc=mysqli_query($conn,"SELECT mach_hrs FROM job WHERE job_no='$no'  ");
                            $mch=mysqli_fetch_assoc($mc);
                            $ba=$mch["mach_hrs"];
                            $mcc=mysqli_query($conn,"SELECT mach FROM extra ");
                            $mchc=mysqli_fetch_assoc($mcc);
                            $bb=$mchc["mach"];
                            $b=$ba*$bb;
                           
                            $amo = $a+$b;
                            $vatt = mysqli_query($conn,"SELECT VAT FROM extra ");
                            $vat=mysqli_fetch_assoc($vatt);
                            $extt = mysqli_query($conn,"SELECT extra FROM extra ");
                            $ext=mysqli_fetch_assoc($extt);
                            $v=$vat["VAT"];
                            $e=$ext["extra"];
                            $total =$amo+$v+$e;
                            $true="T";

                            $sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$no'");
							$row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
							$vNo= $row4['v_no'];

							$sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE v_no = '$vNo'");
							$row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);
							
							



	}

?>

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

<body class="body">
	<?php include 'ACCHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana';">
		<div class="titleArea">
			<div class="theme"><h1>Job No. :- <span class="Number"><?php echo $jobNo; ?></span></h1><br><h2>    VOUCHER</h2></div>
			
		</div>
		<div class="jDetails">
			<div class="topBar">payment Details</div>
			<div class="info">
				<div class="topics">
					<ul>
						<li>Amount :</li><br><br>
						<li>VAT :</li><br><br>
						<li>Extra :</li><br><br>
						<li>Total :</li><br><br>
						<li>Type :</li><br><br>
					</ul>
				</div>
				<div class="ans">
					<?php echo "<ul><li>".$amo."</li><br><br>
									<li>".$v."</li><br><br>
									<li>".$e."</li><br><br>
									<li>".$total."</li><br><br>
									<li>".$j."</li><br><br>
					</ul>";?>
				</div>
			</div>
			
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
									<li>".$invno."</li><br><br>
									<li>".$gtno."</li><br><br>
					</ul>"	;
					?>
				</div>
			</div>
		</div>
		<div class="cDetails">
			<div class="topBar">Other Details</div>
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
				<?php 
				
				echo "<a href='gatepass.php?id=$jobNo'><button class='button button4'>SUBMIT</button></a>";
				?>
			</div>
		</div>
	</div>
	

	
</body>
</html>
 