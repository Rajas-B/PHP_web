<?php
include_once '../database.php';
if(isset($_POST['submit']))
{	 
     $name = $_POST['name'];
     $phone = $_POST['phoneNumber'];
     $password = $_POST['password'];
     $lang = $_POST['lang'];
     $langs = "";

     foreach($lang as $l){
         $langs .= $l.",";
     }

     $aadharfilename = $_FILES['aadhar']['name'];
     $aadharfileeror = $_FILES['aadhar']['error'];
     $aadharfiletmp = $_FILES['aadhar']['tmp_name'];

     $licensefilename = $_FILES['license']['name'];
     $licensefileeror = $_FILES['license']['error'];
     $licensefiletmp = $_FILES['license']['tmp_name'];

     $filename = $_FILES['prof']['name'];
     $fileeror = $_FILES['prof']['error'];
     $filetmp = $_FILES['prof']['tmp_name'];



     $aadhardestinationfile = '../databaseassets/aadhar/'.$aadharfilename;
        move_uploaded_file($aadharfiletmp,$aadhardestinationfile);
     $licensedestinationfile = '../databaseassets/license/'.$licensefilename;
        move_uploaded_file($licensefiletmp,$licensedestinationfile);
     $destinationfile = '../databaseassets/prof/'.$filename;
        move_uploaded_file($filetmp,$destinationfile);


        $sql = "INSERT INTO candidate (name, phone, image, aadhar, license, password, languages) 
        VALUES ('$name','$phone','$destinationfile','$aadhardestinationfile','$licensedestinationfile','$password','$langs')";
       
       $query = mysqli_query($conn, $sql);

       if ($query) {
    
        header("Location:thankyou.php");
       
	 } else {
		echo "Error: " . $sql;
	 }
	
     
  
}
mysqli_close($conn);

?>