<?php
/*session_start();
if(isset($_SESSION["section"])=="JO"){

}
else{
    header("Location:index.php");
}*/
?>
<!DOCTYPE html>

<html>
<head>

    <title>CGTTI JobInfo</title>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
    <script>

    </script>

</head>

<body class="body">
<?php include 'adminHeader.php'; ?>
<div class="pageArea">
    <div class="contentArea" style="position:relative; width:75%; height:100%;">
        <div class="contentArea" style="width:100%; padding-left:0%; padding-right:0%;">
            <div class="detailArea" style="padding:0; border:0">
                <!--<div class="profileImage"><img src="images/user.png" /></div>-->
                <!--<div class="logo" style="margin-top:10%; color: #575354; font-size:1.0em;">You are logged in as Job Office</div>-->
                <div class="buttonArea">
                    <!--<div class="menu_item three first ">
                        <div class="menu_heading">
                            <i class="fa fa-user fa-2x"></i>Member Updates
                        </div>
                        <div class="menu_footer">
                            <span class="pull-left">View More</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </div>
                    <div class="menu_item three">
                        <div class="menu_heading">
                            <i class="fa fa-comments fa-2x"></i>Member Updates
                        </div>
                        <div class="menu_footer">
                            <span class="pull-left">View More</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </div>

                    <div class="menu_item">
                        <div class="menu_heading">
                            <i class="fa fa-comments fa-2x"></i>Member Updates
                        </div>
                        <div class="menu_footer">
                            <span class="pull-left">View More</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </div>

                    <div class="menu_item last">
                        <div class="menu_heading">
                            <i class="fa fa-comments fa-2x"></i>Member Updates
                        </div>
                        <div class="menu_footer">
                            <span class="pull-left">View More</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </div>
                </div><br>
            </div>
        </div>

        <div class="profInfo">
            <?php include '../config.php';
            $sql="SELECT image,name,position,section FROM officer";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                echo "<table><tr><th>Office Image</th><th>Name</th><th>Position</th><th>Section</th><th></th></tr>";
                while ($record=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".'<img  src="data:image/png;base64,'.base64_encode($record['image']).'"/>'."</td>";
                    echo "<td>".$record["name"]."</td>";
                    echo "<td>".$record["position"]."</td>";
                    echo "<td>".$record["section"]."</td>";
                    echo "<td><button>View More</button></td>";
                    echo "</tr>";

                }
            }

            ?>
        </div>

    </div>
    <div class="contentArea" style="position:relative; width:23%; margin-right:1%; float:right;">
        <?php include '../details.php' ?>
    </div>

</div>
</body>

</html>