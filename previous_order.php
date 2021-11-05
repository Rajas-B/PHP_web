<?php 
session_start();
include_once 'database.php';

if(!isset($_SESSION["user"])){
    header("Location:userpage.php");
}
include_once 'database.php';
$uid = $_SESSION["user"];
$sql = "SELECT * FROM orders WHERE (uid = '$uid') AND (completed='1');";
$query = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($query);

?>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];
        $feedback = $_POST["feedback"];
        $sql = "UPDATE orders SET feedback='$feedback' WHERE id='$id';";
        $query = mysqli_query($conn, $sql);
        header("Location:previous_order.php");
    }
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pizza Delivery</title>
    <link rel="stylesheet" type="text/css" href="styles.css?version=51"/>

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
          <img id="title_image" src="logo_pizza.png" alt="" />
          <h1>Pizza</h1>
        </div>
        <div class="right-icons">
          <img id="profpic" src="profile/user.png" />
        </div>
        <div class="sidebar" id="sidebar">
          <a href="#" class="close-btn">&times;</a>

          <a href="#" class="edit-profile">Edit Profile</a>
          <a href="./userpage.php">Back to Home</a>
          <a href="./user_logout.php" class="sign-out">Sign Out</a>
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
          <form action="./checkout.php" method="POST">
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
              <input type="text" style="display:none;" name="<?php echo $key; ?>" value="<?php echo $cart[$key]; ?>" >
          <?php }
          ?>
          </ul>
          <input type="Submit" class="submit_control" value="Re-order">
          </form>
          <p><?php if($row[5] == ""){ ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" style="display:none;" name="id" value="<?php echo $row[0]; ?>" required/>
                <textarea name="feedback" rows="3" class="textarea_control" placeholder="Enter Feedback" required></textarea>
                <input type="Submit" class="submit_control" value="Submit Feedback">
            </form>
          <?php } else{?>
            <p class="order_details">Feedback: <strong><?php echo $row[5]; ?></strong></p>
          <?php } ?></p>
          
        </div><br>
      <?php } ?>
    </div>

</body>
          
</html>