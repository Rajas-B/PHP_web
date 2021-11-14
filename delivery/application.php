<?php 
include_once '../database.php';
?>
<html>
    <head>
        <title>
            Application
        </title>
       
        <link rel="stylesheet" href="./style/style.css" />
       <script>
         
         </script>
    </head>
    <body>
    
    <div id="Application">
      <div class="title">
        <div>
          <img id="title_image" src="../assets/profile/logo_pizza.png" alt="" />
          <h1>Pizza</h1>
        </div>
        
      </div>
      <hr class="horLine" />
      <div class="box">
      
        <h3> </h3>
        <div class="form-cont">
        <form action="add.php" method="POST" enctype="multipart/form-data">
          <input
            type="text"
            class="form_control"
            name="name"
            placeholder="Please enter your name here"
            required
          />
          <input
            type="text"
            class="form_control"
            name="phoneNumber"
            placeholder="Enter your phone number"
            required
          />
      
          <input
            type="password"
            class="form_control"
            name="password"
            placeholder="Enter password"
            required
          />
          <input
            type="password"
            class="form_control"
            name="confirm_password"
            placeholder="Re-enter password"
            required
          />
          <br/>
          </br>
          <div class="upload">
            <input name="prof" id="prof" type="file" class="file-upload-field" accept=".jpg, .jpeg, .png" hidden/>
            <label for="prof" class="label"> Upload Profile Picture</label>
            <span id="file-chosen1"></span>
          </div>
          <br/>
          <div class="upload">
          <input name="aadhar" id="aadhar" type="file" class="file-upload-field" accept=".pdf" hidden/>
          <label for="aadhar" class="label"> Upload Aadhar Cards</label>
          <span id="file-chosen2"></span>
          </div>
          <br/>
          <div class="upload">
          <input name="license" id="license" type="file" class="file-upload-field" accept=".pdf" hidden>
          <label for="license" class="label">  Upload Driving License</label>
          <span id="file-chosen3"></span>
          </div>
          <br>
        <br>



          
          
          <legend class="lang">Languages known:</legend>
          <input type="checkbox" id="hindi" name="lang[]" value="Hindi">
          <label for="hindi" class="lang"> Hindi</label>
          <input type="checkbox" id="english" name="lang[]" value="English">
          <label for="english" class="lang"> English</label>
          <input type="checkbox" id="marathi" name="lang[]" value="Marathi">
          <label for="marathi" class="lang"> Marathi</label>

          <br />
          <button
            type="submit"
            class="submit_control" name="submit"
          >Submit Application</button>
        </form>
     </div>
     </div>

     
      
      
    </div>
    
    </div>
    </body>
    <script>


const actualBtn1 = document.getElementById('prof');
      const actualBtn2 = document.getElementById('aadhar');
      const actualBtn3 = document.getElementById('license');


const fileChosen1 = document.getElementById('file-chosen1');
const fileChosen2 = document.getElementById('file-chosen2');
const fileChosen3 = document.getElementById('file-chosen3');

actualBtn1.addEventListener('change', function(){
  fileChosen1.textContent = this.files[0].name
})

actualBtn2.addEventListener('change', function(){
  fileChosen2.textContent = this.files[0].name
})
actualBtn3.addEventListener('change', function(){
  fileChosen3.textContent = this.files[0].name
})


    </script>
</html>