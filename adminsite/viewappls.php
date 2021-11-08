<?php 
include_once './database.php';

$id = $_GET['id']; 


?>
<html>
    <head>
        <title>
            Application
        </title>
       
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
    
    <div id="Application">
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

          <a href="#" class="edit-profile">Edit Profile</a>
          <a href="#" class="sign-out">Sign Out</a>
        </div>
      </div>
      <hr class="horLine" />
     


        <div class="container">
            <div class= "appl">
               
         <div class="cont1">

         
          

         


         
                 


        </div>

</div>
</div>