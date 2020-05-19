<?php
// directory waar de images opgeslagen worden. 
$target_dir = "upload/";
$newfilename = date('dmYHis').str_replace("", "", basename($_FILES["fileToUpload"]["name"]));
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
  $imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Bestand bestaat al!</div>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
   $imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, uw bestand is te groot!</div>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
$imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.!</div>";
 $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
$imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, uw bestand was niet geüpload!.</div>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
$imageErrorMessage .= "<div class='alert alert-success' role='alert'>Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geüpload.</div>";
  } else {
 $imageErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry, Er trad een error op bij het uploaden.</div>";
  }
}
?>
