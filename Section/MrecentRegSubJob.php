<?php
					include 'config.php';
					$sql = "SELECT subjob.subjob_no,subjob.job_no,subjob.sj_details,subjob.fr,subjob.t,jobservce.job_typ FROM subjob RIGHT JOIN jobservce ON jobservce.job_no=subjob.job_no WHERE  subjob.t='$secCode' AND subjob.start_date=0000-00-00";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> SubJob No </th></th><th> Details </th><th> From </th><th> To <th> Job Type </th>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["subjob_no"];
						    	$sj_d = $row["sj_details"];
                                $frm=$row["fr"];
                                $t=$row["t"];
						        $fsection = $conn->query("SELECT name FROM section WHERE code='$frm'");
						        $fsec = $fsection->fetch_assoc();
                                 $tsection = $conn->query("SELECT name FROM section WHERE code='$t'");
                                $tsec = $tsection->fetch_assoc();
                                $jnum = $row["job_no"];
                                $custNIC = $conn->query("SELECT c_NIC FROM vehicle WHERE
                                job_no='$jnum'");
                                $cNIC = $custNIC->fetch_assoc();
                                $NIC = $cNIC["c_NIC"];
                                $custName = $conn->query("SELECT name FROM customer WHERE
                                NIC='$NIC'");
                                $cName = $custName->fetch_assoc();
                                
						        
		//Subjob_no | Details | From | To | Job Type | 				        
						        echo "<tr><td><a href='MRJOviewSjob.php?id=$a'>" . $row["subjob_no"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $row["sj_details"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $fsec["name"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $tsec["name"] . "</a></td><td><a href='MRJOviewSjobs.php?id=$a'>" . $row["job_typ"]."</a></td></tr>";                               
                               
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No recently registerd Job at the moment.";
					    }
					}
				?>