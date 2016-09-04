<?php
	session_start();
		include 'config.php';
		$to = "WE";
		$from = $_POST['from'];
		$msg = $_POST['msg'];
		$type = "comment";

		$mDate = date("Y-m-d");

		$sqlm = "INSERT INTO messages (fr,t,type,content,mDate) VALUES ('$from','$to','$type','$msg','$mDate')";
		$qry = mysqli_query($conn,$sqlm);
		//header('location:$loc');

		if($qry){
			if($_SESSION["section"]=="JO"){
				header("Location:jobOffice/jobOffice.php");
			}
			else if($_SESSION["section"]=="ACC"){
				header("Location:account/account.php");
			}
			else if($_SESSION["section"]=="admin"){
				header("Location:admin/admin.php");
			}
			else{
				header("Location:section/section.php");
			}
		}
		else{echo "wrong";}
	
?>