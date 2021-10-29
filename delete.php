<?php
include_once 'database.php';
echo $_GET["table"];
$sql = "DELETE FROM ". $_GET["table"] . " WHERE id=" . $_GET["id"] ." ";
if (mysqli_query($conn, $sql)) {
    header("Location:adminpage.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>