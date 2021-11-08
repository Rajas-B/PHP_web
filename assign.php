<?php  

include_once 'adminsite/queue.php';
include_once 'logic.php';

$size = count($freeempqueue);
for ($x = 1; $x <= $size; $x++) {

    if(count($orderqueue)<=0){
    break;
    }

    $id = array_shift($freeempqueue);
    $orderid = array_shift($orderqueue);

    $sqli = "UPDATE orders SET completed=1, addedtoqueue=-1, status='ON THE WAY'  WHERE id=$orderid";

    $sql = "UPDATE deliveryboy SET busy=1, assigned=".$orderid." WHERE id=$id";
    mysqli_query($conn, $sqli);
    mysqli_query($conn, $sql);
}
?>  

