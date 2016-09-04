<?php
    session_start();
    include ('../config.php');
    require ('../fpdf.php');

    class PDF extends FPDF{
        // Page header
        function Header(){
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'CGTTI - Job Details',0,0,'C');
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer(){
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Ceylon German Technical Training Institute - Moratuwa',0,0,'C');
        }
    }

    $jobNo = $_GET['id'];

        $sql1 = mysqli_query($conn,"SELECT * FROM jobservce WHERE job_no = '$jobNo'");
        $row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
        $jt = get_jt($row1['job_typ']);
        $code = $row1['sec_code'];
        $cDate = $row1['closedDate'];
        $gp = $row1['gatePass'];

        if($cDate==""){
            $status = "Unfinished";
        }
        else if($gp==""){
            $status = "Finished";
        }
        else{
            $status = "Closed";
        }

        $sql2 = mysqli_query($conn,"SELECT name FROM section WHERE code = '$code'");
        $row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
        $sec = $row2['name'];
        $rDate = $row1['rDate'];
        $det = $row1['details'];

        $sql3 = mysqli_query($conn,"SELECT subJob_no FROM subjob WHERE job_no = '$jobNo'");
        $sj = mysqli_num_rows($sql3);
        $sArray = [];
        while($row3 = mysqli_fetch_assoc($sql3)){
            $sArray = $row3['subJob_no'];
        }
        $arrlength = count($sArray);


        $sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$jobNo'");
        $row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
        $vNo= $row4['v_no'];

        $sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE v_no = '$vNo'");
        $row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);

        $sql6 = mysqli_query($conn,"SELECT gtpass_no FROM account WHERE job_no = '$jobNo'");
        $row6 = mysqli_fetch_array($sql6, MYSQL_ASSOC);
    


    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',16);
    $pdf->Cell(60);
    $pdf->Cell(50,0,'Job No.  :  '.$jobNo,0,1);

    $tDate = date("d / m / y");

    $pdf->SetFont('Arial','',10);

    $pdf->Cell(72);
    $pdf->Cell(50,17,'  ( Up to date : '.$tDate." )",0,1);

    $pdf->Cell(50,15,' _______________________________________________________________________________________________',0,1);

    

    $pdf->SetFont('Arial','',11);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Job Type                    :      '.$jt,0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Details                        :      '.$det,0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Section                       :      '.$sec,0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Registered Date         :      '.$rDate,0,1);

    $pdf->Cell(50,15,' ______________________________________________________________________________________',0,1);


    $pdf->Cell(5);
    $pdf->Cell(50,10,' Job Status                  :      '.$status,0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Sub-Jobs                    :      ',0,1);

    for($x = 0; $x < $arrlength; $x++) { 
        $pdf->Cell(5);
        $pdf->Cell(70,10,' Sub-Job No.     :      '.$sArray[$x],0,1);
    }

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Gate-Pass No.            :      '.$row6['gtpass_no'],0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Closed Date                :      '.$cDate,0,1);

    $pdf->Cell(50,15,' ______________________________________________________________________________________',0,1);


    $pdf->Cell(5);
    $pdf->Cell(50,10,' Vehicle No.                 :      '.$vNo,0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Customer Name         :      '.$row5['name'],0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Contact No.                :      '.$row5['contact_no'],0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' Email.                         :      '.$row5['email'],0,1);

    $pdf->Cell(5);
    $pdf->Cell(50,10,' NIC No.                      :      '.$row5['NIC'],0,1);

    $pdf->Cell(50,15,' ______________________________________________________________________________________',0,1);

    $pdf->Output();

?>