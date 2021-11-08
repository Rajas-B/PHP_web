<?php
include_once 'database.php';



if(isset($_POST['submit']))
{	 
     $name = $_POST['name'];

     $type = $_POST['type'];
     $veg = $_POST['veg'];
     if($veg=='veg'){
         $veg = 1;   //"1"
     }
     else{
        $veg = 0;   //""
     }
     $price = $_POST['price'];
    

     $filename = $_FILES['image']['name'];
     $fileeror = $_FILES['image']['error'];
     $filetmp = $_FILES['image']['tmp_name'];

    

     $fileext = explode('.',$filename);
     $filecheck = strtolower(end($fileext));

     $fileextstored = array('png','jpeg','jpg');

     if(in_array($filecheck,$fileextstored)) {

        $destinationfile = '../databaseassets/'.$filename;
        move_uploaded_file($filetmp,$destinationfile);

        $sql = "INSERT INTO ".$type." (`name`, `veg`, `price`, `image`)
        VALUES ('$name','$veg','$price','$destinationfile')";


       $query = mysqli_query($conn, $sql);

       if ($query) {
    
        header("Location:adminpage.php");
        exit();
	 } else {
		echo "Error: " . $sql;
	 }
	
     }
  
}
mysqli_close($conn);

?>