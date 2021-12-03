<?php 
include_once './database.php';
session_start();
if(!isset($_SESSION['user'])){
    header("Location:user_login.php");
  }
$uid = $_SESSION["user"];
$sql = "SELECT * from users WHERE uid = $uid;";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);



?>
<html>
    <head>
        <title>
            Edit profile
        </title>
        <script>0</script>

    <link rel="stylesheet" href="../style/styles.css" />
    
    </head>
    <body>
    
    <div id="Check_out">
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

          <a href="./current_order.php" id="cart-btn">Current Order</a>
          <a href="./previous_order.php" id="cart-btn">Previous Orders</a>
          <a href="./user_logout.php" class="sign-out">Sign Out</a>
        </div>
      </div>
      <hr class="horLine" />
      <div class="box">
        <h3>Edit profile: </h3>
        <h3><?php echo $row["name"];?></h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="testForm" id="testForm">
        <label for="input_phone"><strong>Change phone number: </strong></label><input type="text" id="input_phone" name="input_phone" class="form_control" value="<?php echo $row["phone_number"] ?>" required><br>
        <label for="input_email"><strong>Change e-mail address: </strong></label><input type="email" id="input_email" name="input_email" class="form_control" value="<?php echo $row["email"] ?>" required><br>
          <label for="input_address"><strong>Change address: </strong></label><textarea name="input_address" id="input_address" class="textarea_control" rows="3" required><?php echo $row["address"]; ?></textarea><br />
          <button
            type="submit"
            class="submit_control"
            id="address_change"
          >Confirm</button>
        </form>
        <?php 
        $err = "";
        $is_err = 0;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $input_phone = $_POST["input_phone"];
            if(!preg_match("/^\d{10}$/", $input_phone)){
                $err = $err . "Enter a valid phone number.<br>";
                $is_err = 1;
            }
            $input_email = $_POST["input_email"];
            if(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
                $err = $err . "Enter a valid email address.<br>";
                $is_err = 1;
            }
            $input_address = $_POST["input_address"];
            if(strlen($input_address) == 0){
                $err = $err . "Enter address.<br>";
            }
            if($is_err == 0){
                $sql = "UPDATE users SET phone_number = '$input_phone', email = '$input_email', address = '$input_address' WHERE uid = $uid;";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    header("Location:edit_profile.php");
                    exit();
                } else {
                    echo "Error: " . $sql;
                }
            }
            
        }
        ?> 
        <p style="color: red;">
            <?php
                if($is_err == 1){
                    echo $err;
                }
            ?>
        </p>
        </div>
    </div>
    
    </div>
    </body>
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
        var input_address = document.getElementById("input_address");

        var input_phone = document.getElementById("input_phone");

        var input_email = document.getElementById("input_email");
        var input_address_value = input_address.innerHTML;
        var input_phone_value = input_phone.value;
        var input_email_value = input_email.value;

        var testForm = document.testForm.onsubmit = () => {
            
            var input_address = document.getElementById("input_address");

            var input_phone = document.getElementById("input_phone");

            var input_email = document.getElementById("input_email");

            if((input_address_value != input_address.value) 
            || (input_phone_value != input_phone.value) 
            || (input_email_value != input_email.value)) {
                var regex = /^\d{10}$/;
                if (regex.test(input_phone.value) === false) {
                    console.log("phone");

                    alert("Enter a valid phone number");
                    return false;
                }
                var regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(regex.test(input_email.value) === false){
                    console.log("asdads");
                    alert("Enter a valid email address");
                    return false;
                }
                return true;
            }
            
            alert("Not allowed to submit same data");
            return false;


        };
        
        
        });

    </script>
</html>