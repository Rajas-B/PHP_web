<?php 
session_start();
if(!isset($_SESSION["user"])){
    header("Location:userpage.php");
}
include_once 'database.php';
$uid = $_SESSION["user"];
$sql = "SELECT * FROM orders WHERE uid = '$uid';";
$query = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($query);

?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pizza Delivery</title>
    <link rel="stylesheet" type="text/css" href="styles.css?version=51"/>

    <script src="script.js"></script>
    <script>

    </script>
  </head>
  <body>
    <div id="menu">
      <div class="title">
        <div>
          <img id="title_image" src="logo_pizza.png" alt="" />
          <h1>Pizza</h1>
        </div>
        <div class="right-icons">
          <img id="profpic" src="profile/user.png" />
        </div>
        <div class="sidebar" id="sidebar">
          <a href="#" class="close-btn">&times;</a>

          <a href="#" class="edit-profile">Edit Profile</a>
          <a href="#" id="cart-btn">View Cart</a>
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
                $sql = "SELECT * from $dish[2] WHERE id='$dish[1]';";
                $dish_content = mysqli_fetch_row(mysqli_query($conn, $sql));
                echo "<li>".$dish[3]." ".$dish_content[1]."</li>";
              }
              echo "</ul>";
            }
          ?>
        </div><br>
      <?php } ?>
    </div>
</html>