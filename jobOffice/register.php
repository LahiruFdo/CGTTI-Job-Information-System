<?php
include '../config.php';
	session_start();
	
		$jobdes = $_POST['jobdes'];
		$jTyp = $_POST['jobType'];
		$sec = $_POST['sec'];
		$sCode = $_POST['secCode'];
		$date = $_POST['date'];

		$name = $_SESSION['name'];
		$nic = $_SESSION['nic'];
		$tele = $_SESSION['tele'];
		$email = $_SESSION['email'];
		$adrs = $_SESSION['adrs'];

		$vno = $_SESSION['vno'];
		$eno = $_SESSION['eno'];
		$cno = $_SESSION['cno'];
		$fueltyp = $_SESSION['fueltyp'];


		$jno = "GT/16/".$jTyp."/".$sCode."/".$_SESSION['index'];

		

	$sql1 = "INSERT INTO customer (NIC,name,v_no,contact_no,address,email) VALUES ('$nic','$name','$vno','$tele','$adrs','$email')";
	$qry1 = mysqli_query($conn,$sql1);
	$sql2 = "INSERT INTO vehicle (v_no,c_NIC,job_no,eng_no,che_no,fuel_typ) VALUES ('$vno','$nic','$jno','$eno','$cno','$fueltyp')";
	$qry2 = mysqli_query($conn,$sql2);
	$sql3 = "INSERT INTO jobservce (job_no,v_no,job_typ,details,sec_code,rDate) VALUES ('$jno','$vno','$jTyp','$jobdes','$sCode','$date')";
	$qry3 = mysqli_query($conn,$sql3);

	/*if($qry1){echo "1";}
	else{echo "Error1";}

	if($qry1){echo "2";}
	else{echo "Error2";}

	if($qry1){echo "3";}
	else{echo "Error3";}*/
	if($qry1 && $qry2 && $qry3){
		header('Location:jobOffice.php');
	}

?>