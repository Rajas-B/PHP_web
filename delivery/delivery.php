<?php
session_start();
include_once '.././assign.php';
include_once './database.php';
if(!isset($_SESSION['user'])){
  header("Location:login.php");
}
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pizza Delivery</title>
    <link rel="stylesheet" href=".././style/styles.css" />

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
    <script>

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
          <p>  Hi <?php echo $_SESSION['name'] ?></p>

          <a href="#" class="order_assigned">Order Assigned</a>
          <a href="#" id="profile">View Profile</a>
          <a href="./logout.php" class="sign-out">Sign Out</a>
        </div>
      </div>
      
      <hr class="horLine" />
      <div>
<?php
      $sqld = "SELECT assigned FROM deliveryboy WHERE candidate_id=".$_SESSION['user']. " AND assigned<>0 ";
      $result = mysqli_query($conn, $sqld);
      if ($result) {
        $row = mysqli_fetch_row($result);
        
         ?>
         
          <div>
            <p>ORDER ID:<?php echo $row[0]?></p>
            <?php
            $sqlo = mysqli_query($conn,"SELECT * FROM order_content WHERE order_id=".$row[0]);
   
            while($r = mysqli_fetch_row($sqlo)){

              $sqlr = mysqli_query($conn,"SELECT * FROM $r[3] WHERE id=".$r[2]);

              $list = mysqli_fetch_row($sqlr);


              ?>
              <p><?php echo $r[4] . " ".$r[3]. ": ".$list[1] ?></p>
              


              <?php

            }
           




            





        


          
        mysqli_free_result($result);
          
      } else {
          echo "Error: " . $sqld;
      }

      ?>
  </body>
</html>


