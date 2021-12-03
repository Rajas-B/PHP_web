<?php  
include_once 'database.php';
$orderqueue = array();
$sql = "SELECT * FROM orders WHERE completed=0 AND addedtoqueue=0 ORDER BY id ASC"; // checking if still not added to the queue

$result = mysqli_query($conn, $sql);
if($result){

    if (mysqli_num_rows($result) > 0) {
   
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
    
            array_push($orderqueue, $id);
            $sqli = "UPDATE orders SET addedtoqueue=1 WHERE id=$id"; // added to the queue
            mysqli_query($conn, $sqli);
    
        }
    } 
}

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
    
    $id = array_shift($freeempqueue);
    $orderid = array_shift($orderqueue);

    $sqli = "UPDATE orders SET addedtoqueue=-1 WHERE id=$orderid"; //removed it from the queue

    $sql = "UPDATE deliveryboy SET busy=1, assigned=".$orderid." WHERE id=$id";
    mysqli_query($conn, $sqli);
    mysqli_query($conn, $sql);
}
?>
