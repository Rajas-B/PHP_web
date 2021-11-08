<?php
include_once 'database.php';
$orderqueue = array();




$sql = "SELECT * FROM orders WHERE completed=0 AND addedtoqueue=0 ORDER BY id ASC";

$result = mysqli_query($conn, $sql);
if($result){

    if (mysqli_num_rows($result) > 0) {
   
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
    
            array_push($orderqueue, $id);
            $sqli = "UPDATE orders SET addedtoqueue=1 WHERE id=$id";
            mysqli_query($conn, $sqli);
    
        }
    } 
    

}








?>