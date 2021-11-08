<?php 
include_once 'database.php';
session_start();

?>
<head>
        <title>
            Checkout
        </title>
        

       <link rel="stylesheet" href="../style/styles.css" />
    
    </head>
    <body>
    
    <div id="Check_out">
      <div class="title">
        <div>
          <img id="title_image" src="../assets/profile/logo_pizza.png" alt="" />
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
            required
          />
          <input
            type="text"
            class="form_control"
            name="phoneNumber"
            placeholder="Enter your phone number"
            required
          />
          <input
            type="email"
            class="form_control"
            name="email"
            placeholder="Enter your e-mail address"
            required
          />
          <input
            type="password"
            class="form_control"
            name="password"
            placeholder="Enter password"
            required
          />
          <input
            type="password"
            class="form_control"
            name="confirm_password"
            placeholder="Re-enter password"
            required
          />
          <input
            type="text"
            class="form_control address"
            name="flat"
            placeholder="Flat no./ Wing/ Apartment name"
            required
          />
          <input
            type="text"
            class="form_control address"
            name="locality"
            placeholder="Locality"
            required
          />
          <input
            type="text"
            class="form_control address"
            name="city"
            placeholder="City, Pin code"
            required
          /><br />
          <button
            type="submit"
            class="submit_control"
          >Confirm</button>
        </form>
        <?php 
        $err = "";
        $is_err = 0;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST["name"];
            if(!preg_match("/^[a-zA-Z\s]+$/i", $name)){
                $err = $err . "Wrong format, no numbers allowed.<br>";
                $is_err = 1;
            }
            $phone_number = $_POST["phoneNumber"];
            if(!preg_match("/^\d{10}$/", $phone_number)){
                $err = $err . "Enter a valid phone number.<br>";
                $is_err = 1;
            }
            $email = $_POST["email"];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $err = $err . "Enter a valid email address.<br>";
                $is_err = 1;
            }
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];
            if($password != $confirm_password){
                $err = $err . "Passwords must match.<br>";
                $is_err = 1;
            }
            $flat = $_POST["flat"];
            if(strlen($flat) == 0){
                $err = $err . "Enter flat.<br>";
            }
            $locality = $_POST["locality"];
            if(strlen($locality) == 0){
                $err = $err . "Enter locality.<br>";
            }
            $city = $_POST["city"];
            if(strlen($city) == 0){
                $err = $err . "Enter city.<br>";
            }
            if($is_err == 0){
                $address = $flat . ", " . $locality . ", " . $city;
                $sql = "INSERT INTO users (`name`, `phone_number`, `email`, `address`, `password`)
                VALUES ('$name','$phone_number','$email','$address', '$password')";
                $query = mysqli_query($conn, $sql);
                $last_id = mysqli_insert_id($conn);
                if ($query) {
                    $_SESSION["user"] = $last_id;
                    header("Location:./userpage.php");
                   
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
            info = {};
            address = "";
            var name = document.testForm.name.value;
            var phone = document.testForm.phoneNumber.value;
            var email = document.testForm.email.value;
            var password = document.testForm.password.value;
            var confirm_password = document.testForm.confirm_password.value;
            var flat = document.testForm.flat.value;
            var locality = document.testForm.locality.value;
            var city = document.testForm.city.value;
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
            if (phone == "") {
                error = true;
                alert("Enter a phone number");
                } 
            else{
                var regex = /^\d{10}$/;
                if (regex.test(phone) === false) {
                    alert("Enter a valid phone number");
                    error = true;
                }
            }
            var regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(regex.test(email) === false){
                alert("Enter a valid email address");
                error = true;
            }
            if(password.length < 8 && password.length < 20 ){
                alert("Must be longer than 8 characters and shorter than 20");
                error = true;
            }
            if(password != confirm_password){
                alert("Passwords must be same");
                error = true;
            }

            if (locality == "") {
                error = true;
                alert("Enter a locality");
            }
            if (city == "") {
                error = true;
                alert("Enter a city");
            }
            if (error === true) {
                console.log("Reached");
                return false;
            } else {
                info["name"] = name;
                info["phone"] = phone;
                info["email"] = email;
                address = address.concat(address, ", ",flat, ", ",locality, ", ",city);
                info["address"] = address;
                console.log(info);
                return true;
            }
        }
    </script>
