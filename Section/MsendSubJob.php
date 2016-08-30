<?php
        session_start();
        include_once '../config.php';
	    $jNo = $_SESSION['jNo'];
		$to = $_POST['to'];
		$from = $_POST['from'];
		$subJobDetails = $_POST['subJobDetails'];
        $sjNum=$jNo."-".$to;
        $sDate = 0000-00-00;
		
         //echo $jNo."<br>".$to."<br>".$from."<br>".$subJobDetails."<br>".$sjNum;
        $sqlsj = mysqli_query($conn,"SELECT subJob_no FROM subjob WHERE t = '$to' AND fr='$from';");
		$sj = mysqli_num_rows($sqlsj)+1;
        
        $sjNum = $sjNum."-".$sj;
        //echo $sjNum;
		$sqlm = "INSERT INTO subjob (subjob_no,job_no,sj_details,fr,t,start_date) VALUES ('$sjNum','$jNo','$subJobDetails','$from','$to','$sDate')";
		$qry = mysqli_query($conn,$sqlm);
		//header('location:$loc');

		if($qry){
            header("Location:MOJOviewjob.php?id=$jNo");
        }
		else{echo "Sorry! error occured";} 
	
?>