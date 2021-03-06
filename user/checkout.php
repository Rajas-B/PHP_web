<?php 
header('Access-Control-Allow-Origin: *'); 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_POST["key"])){
        $_SESSION["cart"] = [];
        foreach($_POST as $key=>$value){
            $_SESSION["cart"][$key] = $value;
        }
    }
    $_SESSION["cart"] = $_POST;
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>
            Checkout
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
        <img id="back_png" onclick="go_back()" src="../assets/profile/back.png" />
      </div>
      <hr class="horLine" />
      <div class="box">
        <h3>Check out</h3>
        <form action="./store_order.php" method="post" name="testForm" id="testForm">
          <h3 id="final">Final amount :</h3>
          <input
            type="submit"
            class="submit_control"
            value="Confirm"
          />
        </form>
        <button
            id="cart-btn"
            class="submit_control"
          >View Cart</button><br>
      </div>
    </div>
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close_modal">&times;</span>
                <h2>Food cart</h2>
            </div>
            <div class="modal-body" id="fc_list"></div>
        </div>
    </div>
    
    </div>
    </body>
    <script>
        var cart = {};
            <?php 
                foreach($_SESSION["cart"] as $key=>$value){
                    
                    echo "cart["."'".$key."'"."] = "."'". $value ."'".";\n";
                }   
            ?>
        document.addEventListener("DOMContentLoaded", () => {
            for(item in cart){
                cart[item] = cart[item].split(',');
                cart[item][1] = parseInt(cart[item][1]);
                cart[item][4] = parseInt(cart[item][4]);
            }
            console.log(cart);
            totalCost();
            var modal = document.getElementById("cartModal");
            var cart_span = document.getElementsByClassName("close_modal")[0];
            var btn = document.getElementById("cart-btn");

            btn.onclick = function() {
                modal.style.display = "block";
                checkoutItems();
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
        function totalCost(){
            var cost = 0;
            for(item in cart){
                cost += cart[item][1] * cart[item][4];
            }
            document.getElementById('final').innerHTML = `Final amount :${cost} ???`;
        }
        function checkoutItems(){
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
                </div>
                `;
            }
            fc_list.innerHTML = innerHTML;
        }
    </script>
</html>
