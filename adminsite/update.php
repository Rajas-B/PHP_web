<?php
include_once 'database.php';

$sql = "DELETE FROM ". $_GET["table"] . " WHERE id=" . $_GET["id"] ." ";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);

} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>