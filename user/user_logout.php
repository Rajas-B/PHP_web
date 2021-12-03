<?php 
session_start();
if (isset($_SESSION['user'])) {
  unset($_SESSION['user']);
  header('Location:user_login.php');
}
else{
    header("location:javascript://history.go(-1)");
}
?>