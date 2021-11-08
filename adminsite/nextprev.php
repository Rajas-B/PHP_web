<?php

$previous= mysqli_query($conn, "SELECT * FROM candidate WHERE id<$id AND hired=0 order by id DESC");
$next = mysqli_query($conn, "SELECT * FROM candidate WHERE id>$id AND hired=0 order by id ASC");
if (mysqli_query($conn, $sql)) {


if($row = mysqli_fetch_array($next)){

    header('Location:show.php?id='.$row['id']);
} 
else if($row = mysqli_fetch_array($previous)){

    header('Location:show.php?id='.$row['id']);
}
else{

    echo "No applications left";
}
  

} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>