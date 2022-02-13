<?php

if  (isset($_POST["submit"]))  {
    include_once("../dbconnect.php");
    $title  =  $_POST["title"];
    $description  =  $_POST["description"];
    $color = $_POST["color"];
    $price  =  $_POST["price"];
    $state  =  $_POST["state"];
    $sqlregister = "INSERT INTO tbl_lab3 (`title`, `description`, `color`,`price`, `state`)
    VALUES('$title', '$description', '$color', '$price', '$state')";
    try {
        $conn->exec($sqlregister);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file ($_FILES["fileToUpload"]["tmp_name"])) {
        uploadImage($title);
        }
        echo "<script>alert('Upload successful')</script>";
        echo "<script>window.location.replace('mainpage.php')</script>";
        } catch (PDOException $e) {
        echo "<script>alert('Upload failed')</script>";
        echo "<script>window.location.replace('newitem.php')</script>";
        }
    }
        
      function uploadImage($title)
        {
        $target_dir = "../res/images/";
        $target_file = $target_dir . $title . ".png"; 
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
           
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8">
    <meta  http-equiv="X-UA-Compatible"  content="IE=edge">
    <meta  name="viewport"  content="width=device-width,  initial-scale=1.0">
    <link  rel="stylesheet"  href="https://www.w3schools.com/w3css/4/w3.css">
    <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link  rel="stylesheet"  href="../style/style.css">
    <script  src="../javascript/script.js"></script>
    <title>New Product</title>
</head>

<div  class="w3-header  w3-display-container  w3-teal w3-padding-32  w3-center">
<h1  style="font-size:calc(8px  +  4vw);">D'Shah Homemix Bundle</h1>
<p  style="font-size:calc(8px  +  1vw);;">Buy more, cut more</p>
</div>

<div class="w3-bar w3-pale-green">
    <a href="mainpage.php" class="w3-bar-item w3-button w3-left">Home</a>
</div>

<div  class="w3-container  w3-padding-64  form-container">
<div  class="w3-card">
<div  class="w3-container  w3-teal">
    <p>New Item<p>
    </div>

    <form  class="w3-container  w3-padding"  name="registerForm" action="newitem.php"  method="POST"  enctype="multipart/form-data" onsubmit="return confirmDialog()">
    <p>
        <div  class="w3-container  w3-border  w3-center  w3-padding">
        <img  class="w3-image  w3-round  w3-margin" src="../res/images/home.png" style="width:100%; max-width:600px"><br>
        <input  type="file"  onchange="previewFile()"  name="fileToUpload" id="fileToUpload"><br>
        </div>
    </p>

    <p>
        <i class = "fa fa-info icon"></i>
        <label>Title</label>
        <input  class="w3-input  w3-border  w3-round"  name="title"  id="idtitle" type="text"  required>
    </p>

    <p>
        <i class = "fa fa-info icon"></i>
        <label>Description</label>
        <textarea class="w3-input w3-border" id="iddescription" name="description" rows="4" cols="50" width="100%" placeholder="Please enter your description" required></textarea>
    </p>

    <p>
        <i class = "fa fa-pencil icon"></i>
        <label>Color</label>
        <input  class="w3-input  w3-border  w3-round"  name="color"  id="idcolor" type="text"  required>
    </p>

    <p>
        <i class = "fa fa-dollar icon"></i>
        <label>Price</label>
        <input  class="w3-input  w3-border  w3-round"  name="price"  id="idprice" type="text"  required>
    </p>

    <p>
        <i class = "fa fa-map-pin icon"></i>
        <label>State</label>
        <input  class="w3-input  w3-border  w3-round"  name="state"  id="idstate" type="text"  required>
    </p>


    <div  class="row">
        <input  class="w3-input  w3-border  w3-block  w3-teal w3-round"  type="submit" name="submit"  value="Submit">
    </div>

</form>


</div>
</div>

<footer class="w3-footer w3-teal w3-center">
    <div class="w3-xlarge w3-section">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>©️ 2021 Copyright all right reserved | Designed by <a class="text-white">D'Shah Homemix Bundle</a></p>
</footer>

</html>