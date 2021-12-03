<?php 

include_once '.././assign.php';

session_start();
if(!isset($_SESSION["user"])){
    header("Location:userpage.php");
}
include_once 'database.php';
$uid = $_SESSION["user"];
$sql = "SELECT * FROM orders WHERE uid = '$uid' AND (completed='0') ORDER BY ordered_at DESC;";
$query = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($query);

?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pizza Delivery</title>
    <link rel="stylesheet" type="text/css" href="../style/styles.css"/>

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

          <a href="./edit_profile.php" class="edit-profile">Edit Profile</a>
          <a href="./userpage.php">Back to Home</a>
          <a href="./previous_order.php" id="cart-btn">Previous Orders</a>
          <a href="./user_logout.php" class="sign-out">Sign Out</a>
        </div>
      </div>
    <hr class="horLine">
    <div class="orders">
      <?php foreach($rows as $row) { ?>
        <div class="order_content">
          <p class="order_details">Price: <strong><?php echo $row[2]; ?> ₹</strong></p>
          <p class="order_details">Status: <strong><?php echo $row[3]; ?></strong></p>
          <p class="order_details">Ordered at: <strong><?php echo $row[6]; ?></strong></p>
          <p class="order_details">Items: </p>
          <?php 
            $sql = "SELECT * FROM order_content WHERE order_id = '$row[0]';";
            $query = mysqli_query($conn, $sql);
            if($query){
              $dishes = mysqli_fetch_all($query);
              echo "<ul>";
              foreach($dishes as $dish){
                $sql = "SELECT * from $dish[3] WHERE id='$dish[2]';";
                $dish_content = mysqli_fetch_row(mysqli_query($conn, $sql));
                echo "<li>".$dish[4]." ".$dish_content[1]."</li>";
              }
              echo "</ul>";
            }

         

          ?>

          <div>
            Where is your order? <b><?php echo $row[3]?><b>
          </div>
          <br>
          

       
        
        </div><br>
      <?php } ?>
    </div>
</html>