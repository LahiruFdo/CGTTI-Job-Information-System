<?php
	session_start();
		include 'config.php';
		$to = $_POST['to'];
		$from = $_POST['from'];
		$msg = $_POST['msg'];
		$type = $_POST['type'];

		$mDate = date("Y-m-d");

		/*echo $to." " ;
		echo $from." " ;
		echo $msg." " ;
		echo $type." " ;
		echo $mDate." " ;*/

		$sqlm = "INSERT INTO messages (fr,t,type,content,mDate) VALUES ('$from','$to','$type','$msg','$mDate')";
		$qry = mysqli_query($conn,$sqlm);
		//header('location:$loc');

		if($qry){
			if($_SESSION["section"]=="JO"){
				header("Location:jobOffice/message.php?id=$to");
			}
			else if($_SESSION["section"]=="ACC"){
				header("Location:account/message.php?id=$to");
			}
			else if($_SESSION["section"]=="admin"){
				header("Location:admin/message.php?id=$to");
			}
			else{
				header("Location:section/message.php?id=$to");
			}
		}
		else{echo "wrong";}
	
?>