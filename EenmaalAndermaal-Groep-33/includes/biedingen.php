<!DOCTYPE php>

<?php
include('connect.php');
//initialisatie variabelen
$errors = 0;
$voorwerp = 0;
$nieuwBod = 0;
$gebruiker = '';




//Waardetoekenning variabelen
$voorwerp = $_POST["product"];
$nieuwBod = $_POST["nieuwBod"];
$gebruiker = $_SESSION["userName"];



//Database input


  $tsql="INSERT INTO tbl_Bod VALUES(?,?,?, GETDATE(), CONVERT(TIME(0),GETDATE()))";
  $params= array($voorwerp, $nieuwBod, $gebruiker);
  $result= sqlsrv_query($conn, $tsql, $params);


if($result===false)
{
  die(print_r( sqlsrv_errors(), true));
}


header('Location: ../product.php?product='.$_POST['product'].'');


?>
