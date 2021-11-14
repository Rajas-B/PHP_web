<?php 

include_once './database.php';
if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $passwd = $_POST['password'];

   
      if($passwd == "admin@123" && $username=="admin"){
       
        header('Location:adminpage.php');
      }
} 
?>
<html>
    <head>
        <title>
           Admin Login Page
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
            name="username"
            placeholder="Enter username"
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
