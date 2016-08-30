<?php 

session_start();
  include_once '../config.php';  
		$sjobNo = $_SESSION['sjNo'];
        $oMH = $_SESSION['oldManHr'];
        $oMcnH = $_SESSION['oldMachHr'];
        $manHr = $_POST['manHour'];
        $machHr = $_POST['machHour'];
        $nMH = $oMH + $manHr ;
        $nMcnH = $oMcnH + $machHr ;
   $sql="UPDATE subjob set man_hrs='$nMH' , mach_hrs='$nMcnH' where subjob_no='$sjobNo'";
    $rst=mysqli_query($conn,$sql);
header('Location:Msection.php');
/*echo $nMH."--".$nMcnH."--";
echo $sjobNo."--".$oMH."--".$oMcnH."--".$manHr;*/
    
?>