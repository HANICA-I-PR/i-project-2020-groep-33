<?php
$target_dir = "Afbeeldingen/";
$newfilename= date('dmYHis').str_replace("", "", basename($_FILES["fileToUpload"]["name"]));
$target_file = $target_dir . $newfilename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["newProductButton"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $imageErrorMessage .= "<div class='alert alert-danger' role='alert'>File already exists!</div>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
   $imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, your file is too large.!</div>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
$imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.!</div>";
 $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
$imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, your file was not uploaded.</div>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
$imageErrorMessage .= "<div class='alert alert-danger' role='alert'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</div>";
  } else {
 $imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, there was an error uploading your file.</div>";
  }
}
?>
