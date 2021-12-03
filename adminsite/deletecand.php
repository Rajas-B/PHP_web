<?php
include_once 'database.php';
$id  = $_GET["id"];
$sql = "DELETE FROM candidate WHERE id=" . $_GET["id"];

include_once 'nextprev.php';

?>

