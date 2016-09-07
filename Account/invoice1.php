


<!DOCTYPE html>
<html>


<?php 
                include '../config.php';
                $no=$_GET['id'];
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
    <link rel="stylesheet" type="text/css" href="../CSS/gtpass.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/button.css">
</head>
<script src="print.js"></script>
 <body class="body">
    <?php include 'AccHeader.php'; ?>
    
    <div class="pageArea">
    <style>
    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 200px;
    cursor: pointer;

}.button1 {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px -200px;
    cursor: pointer;
}

</style>
    <?php 
                
                echo "<a href='gatepass.php?id=$no' ><button class='button button4'  >NEXT</button></a>";
                ?>
    <button class='button1 ' onclick="printDiv('printableArea')" >PRINT</button>
<div id="printableArea">
<div id="page-wrap" style="background-color:#fff;border:0.05em solid black; padding:3%;">
            <p id="headerr">CASH RECEIPT</p>

            <div id="identity">
        
                    <p id="address">CEYLON GERMAN TECHNICAL TRAINING INSTITUTE<br>
No. 582,Galle Road,<br>
Mt.Lavinia<br>
Phone: 011-1254325</p>



            </div>
             <div id="logo">
                <img id="image" src="../images/logo.png" alt="logo" />
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
                        <td><div class="due">Rs <?php echo "$tot";?>/=</div></td>
                    </tr>

                </table>


                    <br>

                <table id="items">
        
          <tr>
              <th>Item</th>
              
              
          </tr>
          
          <tr class="item-row">
              <td class="item-name">Amount(LKR)</td>
              
              <td ><?php echo "$amo";?></td>
          </tr>

           <tr class="item-row">
              <td class="item-name">Vat(LKR)</td>
              
              <td ><?php echo "$vat";?></td>
          </tr>
           <tr class="item-row">
              <td class="item-name">extra(LKR)</td>
              
              <td ><?php echo "$ex";?></td>
          </tr>
          

          <tr class="item-row">
          <td><hr></td>
          <td><hr></td>
          </tr>
          
          <tr>
            <tr class="item-row">
              <td class="item-name">Total(LKR)</td>
              
              <td ><h4><?php echo "$tot";?></h4></td>

          </tr>
          
        
        </table>
<!--Cash receipt-->
            <br><br>

            <p>
                ..................................................<br>
                Shorff,<br>
                Ceylon German Technical Training Institute,<br>
                For Director Principal<br>
                </p>
            
</div>



</body>
</div>

</div>
</html>

