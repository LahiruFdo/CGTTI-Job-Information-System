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
        $code = "GT";
        $Mat = $_POST['mat'];
        $qun = $_POST['quan'];
        $upr = $_POST['upr'];
   $sql="UPDATE job set man_hrs='$nMH' , mach_hrs='$nMcnH' where job_no='$jobNo'";
    $rst=mysqli_query($conn,$sql);
    $sql1 = "INSERT INTO `cgtti`.`materials` (`ID`, `code`, `name`, `quantity`, `job_no`) VALUES (NULL, '$code', '$Mat', '$qun', '$jobNo')";
    $rst1=mysqli_query($conn,$sql1);
header('Location:Msection.php');
//echo $nMH."--".$nMcnH;
   // echo $Mat."--".$qun."--".$upr;
?>