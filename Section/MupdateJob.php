<?php 

session_start();
  include_once '../config.php';  
		$jobNo = $_SESSION['jNo'];
        $oMH = $_SESSION['oldManHr'];
        $oMcnH = $_SESSION['oldMachHr'];
        $manHr = $_POST['manHour'];
        $machHr = $_POST['machHour'];
        $nMH = $oMH + $manHr ;
        $nMcnH = $oMcnH + $machHr ;
   $sql="UPDATE job set man_hrs='$nMH' , mach_hrs='$nMcnH' where job_no='$jobNo'";
    $rst=mysqli_query($conn,$sql);
header('Location:Msection.php');
//echo $nMH."--".$nMcnH;
    
?>