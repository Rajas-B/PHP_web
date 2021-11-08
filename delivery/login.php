<?php 
include_once './database.php';
include_once '.././assign.php';


session_start();


if(isset($_POST['submit'])){

    $phone = $_POST['phonenumber'];
    $passwd = $_POST['password'];

    $sql = "SELECT id, password, name FROM candidate where phone=".$phone."";
     $result = mysqli_query($conn,$sql);
     


     if ($result) {
      $returned = mysqli_fetch_row($result);
      
      if($passwd == $returned[1]){
        $_SESSION['user'] = $returned[0];
        $_SESSION['name'] = $returned[2];
        header('Location:delivery.php');
      }else{
        echo "Invalid Password";
      }
      exit();
    } else {
        echo "Error: " . $sql;
    }

}


if(isset($_SESSION["user"])){
  header("Location:delivery.php");
}





?>
<html>
    <head>
        <title>
            Application
        </title>
       
        <link rel="stylesheet" href="./style/style.css" />
    
    </head>
    <body>
    
    <div id="Application">
      <div class="title">
        <div>
          <img id="title_image" src="../assets/profile/logo_pizza.png" alt="" />
          <h1>Pizza</h1>
        </div>
        
      </div>
      <hr class="horLine" />
      <div class="box">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
         
          <input
            type="text"
            class="form_control"
            name="phonenumber"
            placeholder="Enter your phone number"
            required
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
            class="submit_control" name="submit"
          >Submit Application</button>
        </form>
        </div>
   </div>
</body>
</html>
