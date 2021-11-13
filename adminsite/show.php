
<?php
include_once './database.php';

$id = $_GET['id']; 

?>
<!DOCTYPE html>
<html>
<head>
  <title>Applicants</title>
  <head>
  
    <link rel="stylesheet" href="../style/styles.css" />

    
  </head>
	
</head>  
<body>
<?php 
$result = mysqli_query($conn, "SELECT * FROM candidate WHERE id=".$id);


if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}


if($row = mysqli_fetch_array($result))
{
$name= $row['name'];
$phone = $row['phone'];
$image = $row['image'];
$aadhar = $row['aadhar'];
$license = $row['license'];
$languages = $row['languages'];

}
?>
<div class="page">
<div class="cont">
        <div class="sub1">
          <img class="prof_img" src=" <?php echo $image;?>">
       </div>
     <div class="sub2">
        <p class="cand_name"><b>Name: </b><?php echo $name;?></p>
     
        <p class="cand_phone"><b>Phone number: </b><?php echo $phone;?></p>
        <p class="languages"><b>Languages known: </b><?php echo $languages;?></p>
         <br>
         <br>
          <div class="pdf">
            <a class="pdfa" href="pdf.php?pdf=<?php echo $row["license"]; ?>" style="text-decoration: none;">View Driving License</a>
             <a class="pdfa" href="pdf.php?pdf=<?php echo $row["aadhar"]; ?>" style="text-decoration: none;">View Aadhar Card</a>
        </div>
      </div>  

     <div class="can">
        <a class="select_can" id="remove" href="deletecand.php?id=<?php echo $row["id"]; ?>" style="text-decoration: none;">Reject</a>  
        <a class="remove_can" id="add" href="selectedcand.php?id=<?php echo $row["id"]; ?>" style="text-decoration: none;">Select</a> 
      </div>

 


<br>
<br>
<div class="group">
<?php


// Previous button 
$previous= mysqli_query($conn, "SELECT * FROM candidate WHERE id<$id AND hired=0 order by id DESC");

if($row = mysqli_fetch_array($previous))
{

  echo '<a href="show.php?id='.$row['id'].'"><button type="button" class="previous">Previous</button></a>';  
} 
// Next button 


$next = mysqli_query($conn, "SELECT * FROM candidate WHERE id>$id AND hired=0 order by id ASC");
if($row = mysqli_fetch_array($next))
{

  echo '<a href="show.php?id='.$row['id'].'"><button type="button" class="next">Next</button></a>';  
} 


?>
</div>
</div>
</div>


</body>
</html>