<?php

$databaseHost = 'localhost';
$databaseName = 'phpproject';
$databaseUsername = 'root';
$databasePassword = 'password';

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

if(!$conn){
  echo 'Connection error';

}



?>