<?php

include_once 'database.php';
$id = $_GET['id'];

$sqli = "UPDATE candidate SET hired = 1 WHERE id=".$id;
$sql = "INSERT INTO `deliveryboy`(`candidate_id`) VALUES ($id)";

$query = mysqli_query($conn, $sql);

$queryi = mysqli_query($conn, $sqli);


include_once 'queue.php';

array_push($freeempqueue, $id);
include_once 'nextprev.php';


?>
