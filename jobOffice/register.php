<?php
include '../config.php';
	session_start();
	
		$jobdes = $_POST['jobdes'];
		$jTyp = $_POST['jobType'];
		$sCode = $_POST['secCode'];
		$tDate = $_POST['date'];

		$name = $_SESSION['name'];
		$nic = $_SESSION['nic'];
		$tele = $_SESSION['tele'];
		$email = $_SESSION['email'];
		$adrs = $_SESSION['adrs'];

		$vno = $_SESSION['vno'];
		$eno = $_SESSION['eno'];
		$cno = $_SESSION['cno'];
		$fueltyp = $_SESSION['fueltyp'];

		$rDate = date("Y-m-d");

		$jno = "GT/16/".$jTyp."/".$sCode."/".$_SESSION['index'];
		

	$sql1 = "INSERT INTO customer (NIC,name,v_no,contact_no,address,email) VALUES ('$nic','$name','$vno','$tele','$adrs','$email')";
	$qry1 = mysqli_query($conn,$sql1);
	$sql2 = "INSERT INTO vehicle (v_no,c_NIC,job_no,eng_no,che_no,fuel_typ) VALUES ('$vno','$nic','$jno','$eno','$cno','$fueltyp')";
	$qry2 = mysqli_query($conn,$sql2);
	$sql3 = "INSERT INTO jobservce (job_no,v_no,job_typ,details,sec_code,rDate,tDate) VALUES ('$jno','$vno','$jTyp','$jobdes','$sCode','$rDate','$tDate')";
	$qry3 = mysqli_query($conn,$sql3);

	$msg = "You have a new Job : ".$jno;

	$sqlm = "INSERT INTO messages (fr,t,type,content,mDate) VALUES ('JO','$sCode','notification','$msg','$rDate')";
	$qry = mysqli_query($conn,$sqlm);

	if($qry1 && $qry2 && $qry3 && $qry){
		header('Location:jobOffice.php');
	}

	if($qry1){echo "1";}
	else{echo "Error1";}

	if($qry1){echo "2";}
	else{echo "Error2";}

	if($qry1){echo "3";}
	else{echo "Error3";}

	if($qry){echo "4";}
	else{echo "Error4";}

	

?>