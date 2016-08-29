<?php
session_start();
if(isset($_SESSION["section"])=="WE"){

}
else{
    header("Location:index.php");
}
?>
<!DOCTYPE html>
    <html>
<head>
    <title>CGTTI JobInfo</title>
   <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <!--<script src="https://use.fontawesome.com/5fe2b31358.js"></script>-->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
</head>

<body class="body">
<?php include 'adminHeader.php' ?>
<!--<div class="header">
    <div class="header1">
        <img src="images/logo.png" id="imgleft">
        <div style="display: table-cell; vertical-align: middle; color: white; padding: 0; font-size: 30px;">
            Ceylon German Technical Training Institute
        </div>
    </div>
    <div class="header2">
        <div style="display: table-cell; vertical-align: middle;">
            Job Information system
        </div>
    </div>
</div>
<div class="container" style="background-color:  #fbf4db ;">
    <div class="sidebar">
   <div class="bar_heading">
<i class="fa fa-bell fa-fw"></i>Notifications Pannel
        </div>
            <div class="list-group-item">
                <i class="fa fa-comment fa-fw"></i>New Comment

        </div>
                <div class="list-group-item">
            <i class="fa fa-envelope fa-fw"></i>Message Sent
        </div>
        <div class="list-group-item">
            <i class="fa fa-tasks fa-fw"></i>New Jobs
        </div>
        <div class="list-group-item">
            <i class="fa fa-shopping-cart fa-fw"></i>Stock updates
        </div>
        <div class="list-group-item">
            <i class="fa fa-money fa-fw"></i>Payment Received
        </div>
        
    </div>-->
<div class="rightsidebar">
    <?php include '../details.php' ?>
</div>

    <div class="pageArea">
        <div class="menu_item three first ">
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

        <div class="contentArea" style="position:relative; width:73%; height: 100%; ">
            <div class="profInfo">
                <div class="divD"
                <?php include '../config.php';
                $sql="SELECT image,name,position,section FROM officer";
                $result = $conn->query($sql);
                if($result->num_rows>0) {
                    // echo "<table><tr><th>Office Image</th><th>Name</th><th>Position</th><th>Section</th><th></th></tr>";
                    while ($record = mysqli_fetch_assoc($result)) {
                        echo "<b><a href=\"admin.php?id={$record['section']}\">{$record['section']}</a></b>";
                        echo "<br/>";
                    }
                }
                    ?>
                    </div>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql1="SELECT image,name,position,section FROM officer WHERE section ='$id' ";
                $result1 = $conn->query($sql1);
                while ($row=mysqli_fetch_assoc($result1)){
                    ?>
                    <div class="card">
                        <h2>---Details---</h2>
                        <!-- Displaying Data Read From Database -->
                        <div class="profile">
                        <?php echo '<img  src="data:image/png;base64,'.base64_encode($row['image']).'"/>';echo "</br>" ?></div>
                        <span>Name:</span> <?php echo $row['name']; echo "</br>" ?>
                        <span>Position:</span> <?php echo $row['position']; echo "</br>"  ?>
                        <span>Section:</span> <?php echo $row['section']; echo "</br>" ?>
                    </div>
            <?php
                }
            }
            ?>
                      <?php /* echo "<br />";
                        echo "<tr>";
                       echo "<td>".'<img  src="data:image/png;base64,'.base64_encode($record['image']).'"/>'."</td>";
                        echo "<td>".$record["name"]."</td>";
                        echo "<td>".$record["position"]."</td>";
                        echo "<td>".$record["section"]."</td>";
                        echo "<td><button>View More</button></td>";
                        echo "</tr>";*/?>


                </div>
</div>
</body>