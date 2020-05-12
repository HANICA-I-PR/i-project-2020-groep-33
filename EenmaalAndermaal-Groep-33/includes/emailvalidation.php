<!DOCTYPE php>

<?php
$mailBox = "";
$mailBoxErrorMessage = "";
if (isset($_POST["registrationButton"]) && $conn)
{
  $mailBox = $_POST['mailBox'];

  if (empty($mailBox))
  { $errors ++;
    $mailBoxErrorMessage = "U hebt geen emailadres ingevuld";
  }
}
?>
