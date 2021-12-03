<?php 
session_start();
include_once 'database.php';
 if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!isset($_SESSION["cart"])){
        header("Location:userpage.php");
    }
    if(!isset($_SESSION["user"])){
        header("Location:user_login.php");
    }
    $uid = $_SESSION["user"]; 
    $price = 0;
    foreach($_SESSION["cart"] as $key=>$value){
        $value = explode(",", $value);
        $price += (int)$value[1] * (int)$value[4];
    }
    $sql = "SELECT uid from users WHERE uid = '$uid';";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        $returned = mysqli_fetch_row($query);
        $uid = $returned[0];
        $sql = "INSERT INTO orders (`uid`, `amount`) VALUES ('$uid', '$price');";
        $order_query = mysqli_query($conn, $sql);
        if ($order_query) {
            $last_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO order_content (`order_id`, `menu_id`, `type`, `amount`) VALUES ";
            foreach($_SESSION["cart"] as $key=>$value){
                $value = explode(",", $value);
                $menu_id = (int)substr($key, -1);
                $type = substr($key, 0, -1);
                $amount = (int)$value[4];
                $values = "('$last_id', '$menu_id', '$type', '$amount'),";
                $sql .= $values;
                
            }
            $sql = substr($sql, 0, -1);
            $sql .= ";";
            $content_query = mysqli_query($conn, $sql);
            if ($content_query) {
                header("Location:current_order.php");
                exit();
            } else {
                echo "Error: " . $sql;
            }
            exit();
        } else {
            echo "Error: " . $sql;
        }
        exit();
    } else {
        echo "Error: " . $sql;
    }
 }
?>
<html>
    <body>
        <?php echo $price; ?>
    </body>
</html>