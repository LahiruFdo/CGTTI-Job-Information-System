<?php
	session_start();

	include_once ("config.php");

	function check_input($r){
	$r=strip_tags($r);
	$r=stripslashes($r);
	$r=mysql_real_escape_string($r);
	return $r;
	}

	if (isset($_POST['username'],$_POST['password'])){
		if($_POST['username']=="" || $_POST['password']==""){
			header('Location: index.php');
			exit();
		}
		$uname = $_POST['username'];
		$pw = $_POST['password'];

		$squery1 = mysqli_query($conn, "SELECT pw FROM officer WHERE uname = '$uname' ");
		$pwData = mysqli_fetch_array($squery1, MYSQL_ASSOC);
		$squery2 = mysqli_query($conn, "SELECT * FROM officer WHERE pw = '$pw' ");
		$userData = mysqli_fetch_array($squery2, MYSQL_ASSOC);

		if (mysqli_num_rows($squery1)==1) {
			if (mysqli_num_rows($squery2)>0) {
				if($pwData["pw"] == $pw ){
					$section=$userData['section'];
	  				$_SESSION['section']=$section;
					if($section=="JO"){
						header('Location: jobOffice/jobOffice.php');
					}
                    else if($section=="ACC"){
						header('Location: Account.php');
					}
                    else{
                        header('Location: Section/Msection.php');
                    }
				}
			}
			else{
				echo "<script type = \"text/javascript\">
				alert(\"Invalid password\");
				window.location = (\"index.php\")
				</script>";
			}
		}
	}
	else{
		echo "<script type = \"text/javascript\">
		alert(\"Login Failed. Try Again\");
		</script>";
	}
?>