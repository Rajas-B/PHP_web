<?php
include_once '../database.php';
include_once '.././assign.php';

$sql = "SELECT * FROM orders WHERE completed='1';";
$query = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($query);

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


          <a href="#" class="edit-profile">Edit Profile</a>
          <a href="#" class="sign-out">Sign Out</a>
        </div>
      </div>
    <hr class="horLine">
    <div class="orders">
      <?php foreach($rows as $row) { ?>
        
        <div class="order_content" id="<?php echo $row[0]; ?>">
          <p class="order_details" id="">Price: <strong><?php echo $row[2]; ?> ₹</strong></p>
          <p class="order_details">Status: <strong><?php echo $row[3]; ?></strong></p>
          <p class="order_details">Ordered at: <strong><?php echo $row[6]; ?></strong></p>
          <p class="order_details">Delivered at: <strong><?php echo $row[7]; ?></strong></p>
          <p class="order_details">Items: </p>
          <ul>
          <?php 
            $sql = "SELECT * FROM order_content WHERE order_id = '$row[0]';";
            $query = mysqli_query($conn, $sql);
            $dishes = mysqli_fetch_all($query);
            $cart = array();
            foreach($dishes as $dish){
              $sql = "SELECT * from $dish[3] WHERE id='$dish[2]';";
              $dish_content = mysqli_fetch_array(mysqli_query($conn, $sql));
              $key = $dish[3].$dish_content["id"];
              $veg = $dish_content["veg"] == "1"?"Veg":"Non-veg";
              $cart[$key] = $dish_content["name"].",".$dish_content["price"].",".$veg.",".$dish_content["image"].",".$dish[4]; 
              ?>
              <li><?php echo $dish[4]; ?> <?php echo $dish_content["name"]; ?></li>
          <?php }
          ?>
          </ul>

        <p class="order_details">Feedback: <strong><?php echo $row[5]; ?></strong></p>
          
        </div><br>
      <?php } ?>
    </div>
    </div>

  </body>
</html>