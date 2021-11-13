<?php
include_once 'database.php';
if(count($_POST)>0) {
mysqli_query($conn,"UPDATE employee set userid='" . $_POST['userid'] . "', first_name='" . $_POST['first_name'] . "', last_name='" . $_POST['last_name'] . "', city_name='" . $_POST['city_name'] . "' ,email='" . $_POST['email'] . "' WHERE userid='" . $_POST['userid'] . "'");
$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM employee WHERE userid='" . $_GET['userid'] . "'");
$row= mysqli_fetch_array($result);  // wil help in showing previous values
?>
<html>
<head>
<title>Update</title>
</head>
<body>
<div id="update_to_menu" class="update_to_menu">
      <div class="modal-content">
        <div class="modal-header">
          <span class="updateclose">&times;</span>
          <h2>Update to the Menu</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="inputs">
            <label for="name">Name of the dish:</label><br>
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
</body>

</html>