<?php 

session_start();
  include_once '../config.php';  
		$sjobNo = $_SESSION['sjNo'];
        $strtDate = $_POST['date'];
        $manHr = $_POST['manHour'];
        $machHr = $_POST['machHour']; 
   $sql="UPDATE subjob set start_date='$strtDate' , man_hrs='$manHr' , mach_hrs='$machHr' where subjob_no='$sjobNo'";
    $rst=mysqli_query($conn,$sql);
header('Location:Msection.php');
    
?>