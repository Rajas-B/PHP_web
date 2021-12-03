<?php
include_once 'database.php';
$can=0;
$result = mysqli_query($conn, "SELECT * FROM candidate WHERE hired = 0 LIMIT 1 ");
 if($canid = mysqli_fetch_array($result))
  {$can=$canid['id'];}
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pizza Delivery</title>
    <link rel="stylesheet" href="../style/styles.css" />

    <script>
        document.addEventListener("DOMContentLoaded", function () {

        var profbtn = document.getElementById("profpic");

        var closebtn = document.getElementsByClassName("close-btn")[0];
        profbtn.onclick = function () {
            document.getElementById("sidebar").style.width = "250px";
        };

        closebtn.onclick = function () {
            document.getElementById("sidebar").style.width = "0";
        };
    });
    </script>
  </head>
  <body>
    <div id="menu">
      <div class="title">
        <div>
          <img id="title_image" src="../assets/profile/logo_pizza.png" alt="" />
          <h1>Pizza</h1>
        </div>
        <div class="right-icons">
          <img id="profpic" src="../assets/profile/user.png" />
        </div>
        <div class="sidebar" id="sidebar">
          <a href="#" class="close-btn">&times;</a>
          <a href="adminpage.php">Main page</a>
          <a href="show.php?id=<?php echo $can;?> ">
          View Applicant Details </a>
         
          <a href="./logout.php" class="sign-out">Sign Out</a>
        </div>
      </div>
    <hr class="horLine">

<div class="table">
<table style="width:100%;">
           <tr >
           <th>Name of the Customer</th>
           <th style="width=30%">Feedback given</th>
           </tr>

<?php
$feedback = mysqli_query($conn,"SELECT uid,feedback FROM orders WHERE completed=1");
while( $row = mysqli_fetch_row($feedback)){
    $namequery = mysqli_query($conn,"SELECT name FROM users WHERE uid=".$row[0]);
    $uname = mysqli_fetch_row($namequery);
   ?>

    <tr>
    <td><?php echo $uname[0]?></th>
    <td><?php echo $row[1]?></th>
    </td>
    
<?php

}



?>
</div>