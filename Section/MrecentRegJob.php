<?php
					include 'config.php';
					$sql = "SELECT jobservce.job_no,jobservce.sec_code,jobservce.job_typ,jobservce.rDate,jobservce.details,job.start_date FROM jobservce RIGHT JOIN job ON jobservce.job_no=job.job_no WHERE  jobservce.sec_code='$secCode' AND job.start_date=0000-00-00";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th></th><th> Section Name </th><th> Register Date </th><th> Job Type <th> Customer Name </th><th> Job Description </th>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["job_no"];
						    	$scode = $row["sec_code"];
						        $section = $conn->query("SELECT name FROM section WHERE code='$scode'");
						        $sec = $section->fetch_assoc();
                                $jnum = $row["job_no"];
                                $custNIC = $conn->query("SELECT c_NIC FROM vehicle WHERE
                                job_no='$jnum'");
                                $cNIC = $custNIC->fetch_assoc();
                                $NIC = $cNIC["c_NIC"];
                                $custName = $conn->query("SELECT name FROM customer WHERE
                                NIC='$NIC'");
                                $cName = $custName->fetch_assoc();
                                
						        
		//job_no | Section Name | rDate | Job Type | Customer name | job Details				        
						        echo "<tr><td><a href='MRJOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["rDate"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["job_typ"] . "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $cName["name"]."</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["details"]."</a></td></tr>";                               
                               
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No recently registerd Job at the moment.";
					    }
					}
				?>