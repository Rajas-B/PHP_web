<?php 
include_once './database.php';

$id = $_GET['id'];
$sqlupdateorders = "UPDATE orders SET completed=-1, status='On the way' WHERE id=$id";
if ( mysqli_query($conn, $sqlupdateorders)) {
    header("Location:delivery.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>