<?php
include_once '.././assign.php';
include_once './database.php';
session_start();
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
      $sqld = "SELECT assigned FROM deliveryboy WHERE id=".$_SESSION['user'];
      $result = mysqli_query($conn, $sqld);
      if ($result) {
        $returned = mysqli_fetch_row($result);
        echo $returned;
       
          header('Location:delivery.php');
        
        exit();
      } else {
          echo "Error: " . $sql;
      }

      ?>
  </body>
</html>


