<?php 

session_start();
  include_once '../config.php';  
		$jobNo = $_SESSION['jNo'];
        $strtDate = $_POST['date'];
        $manHr = $_POST['manHour'];
        $machHr = $_POST['machHour']; 
   $sql="UPDATE job set start_date='$strtDate' , man_hrs='$manHr' , mach_hrs='$machHr' where job_no='$jobNo'";
    $rst=mysqli_query($conn,$sql);
header('Location:Msection.php');
    
?>