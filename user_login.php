<?php 
include_once 'database.php';
session_start();
if(isset($_SESSION["user"])){
  header("Location:userpage.php");
}
?>
<html>
<html>
    <head>
        <title>
            Login
        </title>
        <script>0</script>

    <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
    <div id="Check_out">
      <div class="title">
        <div>
          <img id="title_image" src="logo_pizza.png" alt="" />
          <h1>Pizza</h1>
        </div>
      </div>
      <hr class="horLine" />
      <div class="box">
        <h3>Sign Up: </h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="testForm" id="testForm" onsubmit="return validateForm()">
          <input
            type="text"
            class="form_control"
            name="name"
            placeholder="Please enter your name here"
          />
          <input
            type="password"
            class="form_control"
            name="password"
            placeholder="Enter password"
            required
          />
          <button
            type="submit"
            class="submit_control"
          >Confirm</button>
        </form>
        <a href="./user_reg.php">Don't have an account yet? Sign up here.</a>
        <?php 
          $err = "";
          $is_err = 0;
          if($_SERVER["REQUEST_METHOD"] == "POST"){
              $name = $_POST["name"];
              if(!preg_match("/^[a-zA-Z\s]+$/i", $name)){
                  $err = "Invalid username or password";
                  $is_err = 1;
              }
              $password = $_POST["password"];
              if(strlen($password) == 0){
                $err = "Invalid username or password";
                $is_err = 1;
              }
              if($is_err == 0){
                $sql = "SELECT uid, password FROM users WHERE name = '$name'";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                  $returned = mysqli_fetch_row($query);
                  if($password == $returned[1]){
                    $_SESSION['user'] = $returned[0];
                    header('Location:userpage.php');
                  }else{
                    $is_err = 1;
                  }
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
        function validateForm() {
            var name = document.testForm.name.value;
            var password = document.testForm.password.value;
            var error = false;

            if (name == "") {
                error = true;
                alert("Enter a name");
            } else {
                var regex = /^[a-zA-Z\s]+$/i;
                if (regex.test(name) === false) {
                alert("Enter a valid name");
                error = true;
                }
            }
            if(password.length < 8 && password.length < 20 ){
                alert("Must be longer than 8 characters and shorter than 20");
                error = true;
            }
            if (error === true) {
                return false;
            } else {
                return true;
            }
        }
    </script>
</html>