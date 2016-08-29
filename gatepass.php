
<?php
include 'config.php';
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 							$jobNo = $_GET['id'];

							$no=$jobNo;
                  			$jobtyp=mysqli_query($conn,"SELECT job_typ FROM jobservce WHERE job_no='$no'");
                            $jobtype=mysqli_fetch_assoc($jobtyp);
                            $j=$jobtype["job_typ"];
             			
             				$mydate=getdate(date("U"));
             				$y=$mydate["year"];
             				$mn=$mydate["mon"];
             				$day=$mydate["mday"];
             				$date=$y."-".$mn."-".$day;

             				
             				$gt=mysqli_query($conn,"SELECT MAX(gtpass_no) As maxx FROM account");
             				$gtp=mysqli_fetch_array($gt);
             				$mx=$gtp["maxx"];
             				$gtno=$mx+1;
                           	$in=mysqli_query($conn,"SELECT MAx(invoice_no) As ino FROM account");
             				$inv=mysqli_fetch_assoc($in);
             				$maxin=$inv["ino"];
             				$invno=$maxin+1;
                            $m=mysqli_query($conn,"SELECT man_hrs FROM job WHERE job_no='$no'  ");
                            $ma = mysqli_fetch_assoc($m);
                            $man = $ma["man_hrs"];
                            $m1=mysqli_query($conn,"SELECT man FROM extra ");
                            $ma1 = mysqli_fetch_assoc($m1);
                            $man1= $ma1["man"];
                            $a=$man*$man1;
                            $mc=mysqli_query($conn,"SELECT mach_hrs FROM job WHERE job_no='$no'  ");
                            $mch=mysqli_fetch_assoc($mc);
                            $ba=$mch["mach_hrs"];
                            $mcc=mysqli_query($conn,"SELECT mach FROM extra ");
                            $mchc=mysqli_fetch_assoc($mcc);
                            $bb=$mchc["mach"];
                            $b=$ba*$bb;
                           
                            $amo = $a+$b;
                            $vatt = mysqli_query($conn,"SELECT VAT FROM extra ");
                            $vat=mysqli_fetch_assoc($vatt);
                            $extt = mysqli_query($conn,"SELECT extra FROM extra ");
                            $ext=mysqli_fetch_assoc($extt);
                            $v=$vat["VAT"];
                            $e=$ext["extra"];
                            $total =$amo+$v+$e;
                            $true="T";		
                			
// Attempt update query execution
$sql = "UPDATE account SET amount='$amo' , VAT='$v' ,extra='$e' ,total='$total' ,invoice_no='$invno' ,pay_date='$date', gtpass_no='$gtno' ,payORnot='$true' WHERE job_no='$no'";
if(mysqli_query($conn, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
// Close connection
mysqli_close($conn);
?><!DOCTYPE html>
<html>

<?php 
				include 'config.php';
				$no=$jobNo;
				$invo=mysqli_query($conn,"SELECT invoice_no FROM account WHERE job_no='$no'");
				$invoi=mysqli_fetch_assoc($invo);
				$invNo=$invoi["invoice_no"];
				$day=mysqli_query($conn,"SELECT pay_date FROM account WHERE job_no='$no'");
				$daya=mysqli_fetch_assoc($day);
				$date=$daya["pay_date"];
				$sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$no'");
					$row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
					$vNo= $row4['v_no'];

					$sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE v_no = '$vNo'");
					$row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);
					$name=$row5["name"];
					$idno=$row5["NIC"];

					$t=mysqli_query($conn,"SELECT * FROM account WHERE job_no='$no'");
					$to=mysqli_fetch_array($t);
					$tot=$to["total"];
					$amo=$to["amount"];
					$vat=$to["VAT"];
					$ex=$to["extra"];
					$gt=$to["gtpass_no"];
					
?>

<head>
	<title>CASH RECEIPT</title>
	<link rel="stylesheet" type="text/css" href="CSS/gtpass.css">
	<script src="gtscript.js"></script>
	
</head>


	<img src="images/print.jpg"  height="70" width="70" align="right" onclick="printDiv('printableArea')" value="print a div!" />
	<a href="account.php"><img src="images/home.jpg"  height="70" width="70" align="right" value="print a div!" /></a>
<div id="printableArea">

<div id="page-wrap">
			<p id="header">CASH RECEIPT</p>

			<div id="identity">
		
		            <p id="address">CEYLON GERMAN TECHNICAL TRAINING INSTITUTE<br>
No. 582,Galle Road,<br>
Mt.Lavinia<br>
Phone: 011-1254325</p>



			</div>
			 <div id="logo">
			 	<img id="image" src="images/logo.png" alt="logo" />
			 </div>



			 		<div style="clear:both"></div>
		
					<div id="customer">

            				<p id="customer-title">Vehicle Repair <?php echo "$no";?></p>
					</div>


				<table id="meta">
	                <tr>
	                    <td class="meta-head">Invoice No</td>
	                    <td><p><?php echo "$invNo";?></p></td>
	                </tr>
	                <tr>
	                    <td class="meta-head">Customer name</td>
	                    <td><p><?php echo "$name";?></p></td>
	                </tr>
	                <tr>

	                    <td class="meta-head">Date</td>
	                    <td><p id="date"><?php echo "$date";?></p></td>
	                </tr>
	                <tr>
	                    <td class="meta-head">Amount Due</td>
	                    <td><div class="due"><?php echo "$tot";?></div></td>
	                </tr>

            	</table>



            	<table id="items">
		
		  <tr>
		      <th>Item</th>
		      
		      
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name">Amount</td>
		      
		      <td ><?php echo "$amo";?></td>
		  </tr>

		   <tr class="item-row">
		      <td class="item-name">Vat</td>
		      
		      <td ><?php echo "$vat";?></td>
		  </tr>
		   <tr class="item-row">
		      <td class="item-name">extra</td>
		      
		      <td ><?php echo "$ex";?></td>
		  </tr>
		  

		  <tr class="item-row">
		  <td><hr></td>
		  <td><hr></td>
		  </tr>
		  
		  <tr>
		  	<tr class="item-row">
		      <td class="item-name">Total</td>
		      
		      <td ><h4><?php echo "$tot";?></h4></td>

		  </tr>
		  
		
		</table>
<!--Cash receipt-->
			

			
</div>




<div id="page-wrap">
			<p id="header">GATE PASS</p>

			<div id="identity">
		
		            <p id="address">CEYLON GERMAN TECHNICAL TRAINING INSTITUTE<br>
No. 582,Galle Road,<br>
Mt.Lavinia<br>
Phone: 011-1254325</p>



			</div>
			 <div id="logo">
			 	<img id="image" src="images/logo.png" alt="logo" />
			 </div>



			 		<div style="clear:both"></div>
		
					<div id="customer">

            				<p id="customer-title">Vehicle Repair <?php echo "$no";?></p>
					</div>


				<table id="meta">
	                <tr>
	                    <td class="meta-head">Pass No</td>
	                    <td><p><?php echo "$gt";?></p></td>
	                </tr>
	                <tr>
	                    <td class="meta-head">From</td>
	                    <td><p></p></td>
	                </tr>
	                <tr>

	                    <td class="meta-head">To</td>
	                    <td><p ></p></td>
	                </tr>
	                <tr>
	                    <td class="meta-head">Date</td>
	                    <td><div class="due"><?php echo "$date";?></div></td>
	                </tr>

            	</table>


            		

            	<table id="items">
		
		  <tr>
		      <th>Item</th>
		      
		      
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name">Name</td>
		      
		      <td ><?php echo "$name";?></td>
		  </tr>

		   <tr class="item-row">
		      <td class="item-name">NIC_No</td>
		      
		      <td ><?php echo "$idno";?></td>
		  </tr>
		   <tr class="item-row">
		      <td class="item-name">Vehicle</td>
		      
		      <td ><?php echo "$vNo";?></td>
		  </tr>
		  

		 
		
		</table>
<!--Cash receipt-->
			

			<p>
				..................................................<br>
				Shorff,<br>
				Ceylon German Technical Training Institute,<br>
				For Director Principal
				</p>

			
</div>

</div>


</html>
