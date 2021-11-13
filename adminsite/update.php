<?php
include_once 'database.php';
if(count($_POST)>0) {
    mysqli_query($conn,UPDATE `pastas` SET `id`='[value-1]',`name`='[value-2]',
    `veg`='[value-3]',`price`='[value-4]',`image`='[value-5]',`avail`='[value-6]' WHERE 1);
    $message = "Record Modified Successfully";
    }

?>