<?php 
include_once './database.php';

$id = $_GET['id'];
$cand = $_GET['cand'];

$sqlupdate = "UPDATE orders SET completed=1, status='Delivered successfully' WHERE id=$id";

$sqlupdatedelivery = "UPDATE deliveryboy SET busy=0, assigned=0 WHERE id=$cand";


  if ( mysqli_query($conn, $sqlupdate) &&  mysqli_query($conn, $sqlupdatedelivery)) {
    header("Location:delivery.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}


?>