

<?php
include_once 'database.php';
session_start();
if(!isset($_SESSION['user'])){
  header("Location:user_login.php");
}
$res_deals = mysqli_query($conn,"SELECT * FROM deals");
$res_pizzas = mysqli_query($conn,"SELECT * FROM pizzas");
$res_pastas = mysqli_query($conn,"SELECT * FROM pastas");
$res_desserts = mysqli_query($conn,"SELECT * FROM desserts");

?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pizza Delivery</title>
    <link rel="stylesheet" href="styles.css" />

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
          <a href="./current_order.php" id="cart-btn">Current Order</a>
          <a href="./previous_order.php" id="cart-btn">Previous Orders</a>
          <a href="./user_logout.php" class="sign-out">Sign Out</a>
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


            
            <div class="item" id="deals<?php echo $row['id'];?>">
              <img class="item_img" src=" <?php echo $row['image'];?> ">
              <p class="item_name"><?php echo $row['name'];?></p>
              <p class="item_price"><?php echo $row['price'];?> Rs</p>
              <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
              <div class="item_btns">
                  <button class="item_btn" id="add" onclick="add_to_cart()">
                      Add
                  </button>
                  <button class="item_btn" id="remove" onclick="remove_from_cart()">
                      Remove
                  </button>
              </div>
             </div>
             <?php }
          ?>
          </div>

          <div class="items_list" id="pizza_items">
          <?php
            while($row = mysqli_fetch_array($res_pizzas)) {
              ?>


            
            <div class="item" id="pizzas<?php echo $row['id'];?>">
                            <img class="item_img" src=" <?php echo $row['image'];?> ">
                            <p class="item_name"><?php echo $row['name'];?></p>
                            <p class="item_price"><?php echo $row['price'];?> Rs</p>
                            <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
                            <div class="item_btns">
                                <button class="item_btn" id="add" onclick="add_to_cart()">
                                    Add
                                </button>
                                <button class="item_btn" id="remove" onclick="remove_from_cart()">
                                    Remove
                                </button>
                            </div>
                          </div>
                          <?php }
          ?>
            </div>
          <div class="items_list" id="pastas_items">
          <?php
            while($row = mysqli_fetch_array($res_pastas)) {
              ?>


            
            <div class="item pasta" id="pastas<?php echo $row['id'];?>">
                            <img class="item_img" src=" <?php echo $row['image'];?> ">
                            <p class="item_name"><?php echo $row['name'];?></p>
                            <p class="item_price"><?php echo $row['price'];?> Rs</p>
                            <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
                            <div class="item_btns">
                                
                                
                            <button class="item_btn" id="add" onclick="add_to_cart()">
                                    Add
                                </button>
                                <button class="item_btn" id="remove" onclick="remove_from_cart()">
                                    Remove
                                </button>
                            </div>
                          </div>
                          <?php }
          ?>
            </div>
          <div class="items_list" id="desserts_items"> <?php
            while($row = mysqli_fetch_array($res_deals)) { 

              ?>
              <div class="item" id="desserts<?php echo $row['id'];?>">
                  <img class="item_img" src=" <?php echo $row['image'];?> ">
                  <p class="item_name"><?php echo $row['name'];?></p>
                  <p class="item_price"><?php echo $row['price'];?> Rs</p>
                  <p class="item_type"><?php echo $row['veg']=="1"?"Veg":"Non-Veg";?></p>
                  <div class="item_btns">
                      <button class="item_btn" id="add" onclick="add_to_cart()">
                          Add
                      </button>
                      <button class="item_btn" id="remove" onclick="remove_from_cart()">
                          Remove
                      </button>
                  </div>
              </div>
                <?php }
                ?>
            </div>
        </div>
      </div>
      </div>
      <div id="cartModal" class="modal">

            <div class="modal-content">
              <div class="modal-header">
                <span class="close_modal">&times;</span>
                <h2>Food cart</h2>
              </div>
              <div class="modal-body" id="fc_list">
              </div>
              <div class="modal-footer">
                  <button class="exit_btn" onclick="checkout()">
                      Check out
                  </button>
                  <button class='clear_btn' onclick="clear_cart()">
                    Clear cart
                </button>
              </div>
            </div>
          
          </div>
      <script>
        document.addEventListener('DOMContentLoaded', () => {
          var modal = document.getElementById("cartModal");
          var cart_span = document.getElementsByClassName("close_modal")[0];
          var btn = document.getElementById("cart-btn");

          btn.onclick = function() {
            modal.style.display = "block";
            fcItems();
          }

          cart_span.onclick = function() {
              modal.style.display = "none";
          }

          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
          }
        });
        
        cart = {}

        function add_to_cart(){
          id = event.target.parentElement.parentElement.id;
          if(cart[id] != undefined){
            len = cart[id].length;
            cart[id][len-1] += 1;
            console.log(cart[id]);
          }
          else{
            var item = document.getElementById(id);
            img = item.querySelector('img').src;
            name = item.querySelector('p.item_name').innerHTML;
            price = item.querySelector('p.item_price').innerHTML.slice(0,-3);
            type = item.querySelector('p.item_type').innerHTML;
            var item = [name, price, type, img, 1];
            cart[id] = item;
            console.log(cart);
          }
        }
       function remove_from_cart(){
        id = event.target.parentElement.parentElement.id;
          if(cart[id] != undefined){
            console.log("here")
            len = cart[id].length;
            cart[id][len-1] -= 1;
            if(cart[id][len-1] <= 0){
              delete cart[id];
            }
          }
       }
       function fcItems(){
          fc_list = document.getElementById("fc_list");
          innerHTML = '';
          for(item in cart){
              actual_item = cart[item];
              innerHTML += `
              <div class="fc_item">
                  <img class="fc_item_img" src="${actual_item[3]}">
                  <div class="fc_item_det">
                  <h3>${actual_item[0]}</h3>
                  <p>${actual_item[4]} X ${actual_item[1]}</p>
                  </div>
                  <div class="fc_item_btns">
                  <button class="fc_item_btn" onclick="add_from_cart(${item})">
                      Add
                  </button><br>
                  <button class="fc_item_btn" onclick="remove_cart(${item})">
                  Remove
                  </button>
                  </div>
              </div>
              `;
          }
          if(innerHTML == ''){
              innerHTML = '<h2>Your cart is empty, hope you are hungry</h2>';
          }
          fc_list.innerHTML = innerHTML;
      }
      function add_from_cart(item){
       var item = item.id;
            if(cart[item]){
              len = cart[id].length;
              cart[id][len-1] += 1;
            }
            fcItems();
        }

        function remove_cart(item){
          item = item.id;
            if(cart[item]){
                cart[item][4] -= 1;
                if(cart[item][4]<=0){
                    delete cart[item];
                }
            }
            fcItems();
        }
        function isEmpty(obj) {
          return Object.keys(obj).length === 0;
        }
        
        function checkout(){
          if(isEmpty(cart)){
            return false;
          }
          var formData = new FormData();
          for(item in cart){
            formData.append(item, cart[item]);
          }
          fetch('./checkout.php', {
            method: "post",
            redirect: "follow",
            body: formData,
          })
          .then(response => window.location.href = response.url);

        }
        
      </script>
      
  </body>
</html>


