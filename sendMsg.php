<?php
	
		$to = $_POST['to'];
		$from = $_POST['from'];
		$msg = $_POST['msg'];
		$type = $_POST['type'];

		$sqlm = "INSERT INTO messages (fr,t,type,content) VALUES ('$from','$to','$type','$msg')";
		$qry = mysqli_query($conn,$sqlm);
		//header('location:$loc');

		if($qry){}
		else{echo "Sorry! error occured";}
	
?>