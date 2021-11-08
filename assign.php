<?php  


include_once 'logic.php';

$freeempqueue = array();
$sqldel = mysqli_query($conn,"SELECT id FROM deliveryboy WHERE busy=0");

while($row = mysqli_fetch_array($sqldel)){
    array_push($freeempqueue,$row['id']);
   
}



$size = count($freeempqueue);
for ($x = 1; $x <= $size; $x++) {
  
    if(count($orderqueue)<=0){
    break;
    }
    
     echo "hi";
    echo $size;
    echo $freeempqueue;
    print_r($orderqueue);
    

    $id = array_shift($freeempqueue);
    $orderid = array_shift($orderqueue);

    $sqli = "UPDATE orders SET completed=-1, addedtoqueue=-1, status='On the way'  WHERE id=$orderid";

    $sql = "UPDATE deliveryboy SET busy=1, assigned=".$orderid." WHERE id=$id";
    mysqli_query($conn, $sqli);
    mysqli_query($conn, $sql);
}
?>
