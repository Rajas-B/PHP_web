<?php
include_once 'database.php';
include_once '.././assign.php';
$res_deals = mysqli_query($conn,"SELECT * FROM deals");
$res_pizzas = mysqli_query($conn,"SELECT * FROM pizzas");
$res_pastas = mysqli_query($conn,"SELECT * FROM pastas");
$res_desserts = mysqli_query($conn,"SELECT * FROM desserts");
$can=0;
$result = mysqli_query($conn, "SELECT * FROM candidate WHERE hired = 0 LIMIT 1 ");
 if($canid = mysqli_fetch_array($result))
  {$can=$canid['id'];}
    
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pizza Delivery</title>
    <link rel="stylesheet" href="../style/styles.css" />

    <script src="adminscript.js"></script>
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
          <a href="show.php?id=<?php echo $can;?> ">
          View Applicant Details </a>


        
          <a href="./logout.php" class="sign-out">Sign Out</a>


        </div>
      </div>
      <nav class="nav-bar">
        <div>
          <p id="deals" class="item_list_btns" onclick="changeItems('deals')">
            Deals
          </p>
          <p id="pizza" class="item_list_btns" onclick="changeItems('pizza')">
            Pizza
          </p>
          <p id="pastas" class="item_list_btns" onclick="changeItems('pastas')">
            Pastas
          </p>
          <p
            id="desserts"
            class="item_list_btns"
            onclick="changeItems('desserts')"
          >
            Desserts
          </p>
        </div>
      </nav>
      <hr class="horLine" />
      <div class="rest">
        <div id="items">
          <div class="items_list" id="deals_items">
            <?php
            while($row = mysqli_fetch_array($res_deals)) {
              ?>


            
            <div class="item" id="deals">
                            <img class="item_img" src=" <?php echo $row['image'];?> ">
                            <p class="item_name"><?php echo $row['name'];?></p>
                            <p class="item_price"><?php echo $row['price'];?> Rs</p>
                            <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
                            <div class="item_btns">
                                <button class="item_btn" id="add" onclick="">
                                    Add
                                </button>
                                <a class="item_btn" id="remove" href="delete.php?table=deals&id=<?php echo $row["id"]; ?>" style="text-decoration: none;">Remove</a> 
                                
                            </div>
             </div>
             <?php }
          ?>
          </div>

          <div class="items_list" id="pizza_items">
          <?php
            while($row = mysqli_fetch_array($res_pizzas)) {
              ?>


            
            <div class="item" id="pizzas">
                            <img class="item_img" src=" <?php echo $row['image'];?> ">
                            <p class="item_name"><?php echo $row['name'];?></p>
                            <p class="item_price"><?php echo $row['price'];?> Rs</p>
                            <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
                            <div class="item_btns">
                                <button class="item_btn" id="add" onclick="">
                                    Add
                                </button>
                                <a class="item_btn" id="remove" href="delete.php?table=pizzas&id=<?php echo $row["id"]; ?>" style="text-decoration: none;">Remove</a> 
                                
                            </div>
                          </div>
                          <?php }
          ?>
            </div>
          <div class="items_list" id="pastas_items">
          <?php
            while($row = mysqli_fetch_array($res_pastas)) {
              ?>


            
            <div class="item" id="pastas">
                            <img class="item_img" src=" <?php echo $row['image'];?> ">
                            <p class="item_name"><?php echo $row['name'];?></p>
                            <p class="item_price"><?php echo $row['price'];?> Rs</p>
                            <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
                            <div class="item_btns">
                                
                                
                                 <a class="item_btn" id="update" href="" style="text-decoration: none;">Update</a> 
                                
                                <a class="item_btn" id="remove" href="delete.php?table=pastas&id=<?php echo $row["id"]; ?>" style="text-decoration: none;">Remove</a> 
                                
                            </div>
                          </div>
                          <?php }
          ?>
            </div>
          <div class="items_list" id="desserts_items"> <?php
            while($row = mysqli_fetch_array($res_deals)) { 

              ?>


            
            <div class="item" id="desserts">
                            <img class="item_img" src=" <?php echo $row['image'];?> ">
                            <p class="item_name"><?php echo $row['name'];?></p>
                            <p class="item_price"><?php echo $row['price'];?> Rs</p>
                            <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
                            <div class="item_btns">
                                <button class="item_btn" id="add" onclick="">
                                    Add
                                </button>
                                <a class="item_btn" id="remove" href="delete.php?table=desserts&id=<?php echo $row["id"]; ?>" style="text-decoration: none;">Remove</a> 
                                
                            </div>
                          </div>
                          <?php }
          ?>
                        </div>



           
        </div>
      </div>
            </div>
    

    <div id="add_to_menu" class="add_to_menu">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">&times;</span>
          <h2>Add to the Menu</h2>
        </div>
        <form action="add.php" method="POST" enctype="multipart/form-data">
          <div class="inputs">
            <label for="name">Name of the dish:</label>
            <input type="text" id="name" name="name" placeholder="Enter Name" />
          </div>

          <div class="inputs">
            <input type="radio" id="type" name="type" value="deals" />
              <label for="deal">Deal</label><br />
            <input type="radio" id="type" name="type" value="pizzas" />
              <label for="pizza">Pizza</label><br />
            <input type="radio" id="type" name="type" value="pastas" />
              <label for="pasta">Pasta</label><br />
            <input type="radio" id="type" name="type" value="desserts" />
              <label for="dessert">Dessert</label>
          </div>

          <div class="inputs">
            <input type="radio" id="veg" name="veg" value="veg" />
              <label for="veg">Veg</label><br />
            <input
              type="radio"
              id="veg"
              name="veg"
              value="nonveg"
            />
              <label for="nonveg">Non-Veg</label>
          </div>

          <div class="inputs">
            <label for="price">Price:</label>
            <input
              type="number"
              id="price"
              name="price"
              placeholder="Enter Price"
            />
          </div>

          <div class="inputs">
            Upload Image:
            <input type="file" id="image" name="image" />
          </div>
          <div class="submit">
          <input type="submit" name="submit" value="submit">
          </div>

        </form>
      </div>
    </div>

    <div class="addbutton" id="addbutton">+</div>  



  </body>
</html>


