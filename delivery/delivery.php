<?php
session_start();
include_once '.././assign.php';
include_once '../database.php';


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
          <p style="color:white; font-size:30px; margin-left:30px;">  Hi <?php echo $_SESSION['name'] ?></p>

          <a href="./logout.php" class="sign-out">Sign Out</a>
        </div>
      </div>
      
      <hr class="horLine" />
      <div>
<?php
      $sqld = "SELECT assigned, id FROM deliveryboy WHERE candidate_id=".$_SESSION['user'];
      $result = mysqli_query($conn, $sqld);
      $row = mysqli_fetch_row($result);
      if ($row[0]!= 0) {
       
        
         ?>
         
          <div class="orders">

            <div class="assigned">
              <div class="border">
            <p>ORDER ID: <?php echo $row[0]?></p>

            <table style="width:50%; color:white;">
           <tr class="colname">
           <th class="rw">Name</th>
           <th class="rw">Category</th>
           <th class="rw">Quantity</th>
           <th class="rw">Price</th>
           
            </tr>

            <?php
            $sqlo = mysqli_query($conn,"SELECT * FROM order_content WHERE order_id=".$row[0]);
            $sqlorder = mysqli_query($conn,"SELECT * FROM orders WHERE id=".$row[0]);
            $order=mysqli_fetch_row($sqlorder);
      
            while($r = mysqli_fetch_row($sqlo)){

              $sqlr = mysqli_query($conn,"SELECT * FROM $r[3] WHERE id=".$r[2]);

              $list = mysqli_fetch_row($sqlr);
               $price = $r[4]*$list[3];
               $veg = $list[2];
               $color = "green";
               if($veg==0){
                $color = "red";
               }
                  

              ?>
             <tr class="row">
              <td>
                
                <?php echo $list[1];

                if($veg==0){
                  echo "<div class='circle' style='background-color:red; height:10px; width:10px; border-radius: 60px; float:right; margin-right:100px; margin-top:10px;'></div>";
                 }
                else{
                  echo "<div class='circle' style='background-color:green; height:10px; width:10px; border-radius: 60px; float:right; margin-right:100px; margin-top:10px;'></div>";
                }
               ?></td>
              <td><?php echo $r[3]?></td>
              <td><?php echo $r[4]?></td>
              <td><?php echo $price?></td>
              </tr>

              <?php

            } 

            ?>
            </table>
            <br>
            <?php
             
            $sqluserid = mysqli_query($conn,"SELECT * FROM users WHERE uid=".$order[1]);
            $userdetails = mysqli_fetch_row($sqluserid);
             ?>
              <fieldset>
               <legend>Customer Details:</legend>
                 <p>Name: <?php echo $userdetails[1]?></p>
                 <p>Phone Number: <?php echo $userdetails[2]?></p>
                 <p>Address: <?php echo $userdetails[4]?></p>
              </fieldset>
             <p style="
                margin-bottom: 40px;"> Total Price: <?php echo $order[2]?></p>

           <?php    
               
                  if($order[4]==0){?>

               <a style="text-decoration: none;  
                font-size: 16px;
                padding: 10px;
                background: yellow;
                display: inline-block
                width:110px;
                border-radius:10px;
                color: black;"
                
                href="picked.php?id=<?php echo $order[0]; ?>">Picked it up ?</a> 
              
               <?php  
                  }
                
                  else if($order[4]==-1){
                    
                    ?>
                    <a style="text-decoration: none;  
                  
                font-size: 16px;
                padding: 10px;
                background: yellow;
                display: inline-block
                width:110px;
                border-radius:10px;
                color: black;"
                
                href="delivered.php?id=<?php echo $row[0];?>&cand=<?php echo $row[1];?>">Delivered ?</a> 

               

            
               <?php  
                  }
                  
                ?>

        

       

             </div>
            </div>
            </div>
            <?php
        mysqli_free_result($result);
          
      } else {
        ?>
        <div class="noorder">As of now, No order has been assigned to you!! Yay! Break Time</div>
        <?php
      }

      ?>
  </body>
</html>


