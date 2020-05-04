<!DOCTYPE php>

<?php
//initializeren variabelen
$errors = 0;
$userName = "";
$name = "";
$surname = "";
$address1 = "";
$address2 = "";
$postCode = "";
$placeName = "";
$country = "";
$birthDate = "";
$mailBox = "";
$password = "";
$questionNumber = "";
$answer = "";
$seller = 0;
$userNameErrorMessage = "";
$nameErrorMessage = "";
$surnameErrorMessage = "";
$address1ErrorMessage = "";
$adress2ErrorMessage = "";
$postCodeErrorMessage = "";
$placeNameErrorMessage = "";
$birthDateErrorMessage = "";
$mailBoxErrorMessage = "";
$passwordErrorMessage = "";
$answerErrorMessage = "";

// Database connectie
$serverName = "mssql.iproject.icasites.nl";
$connectionInfo = array( "Database"=>"iproject33",  "UID"=>"iproject33", "PWD"=>"thsPUqnU");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

// Gebruiker registratie
if (isset($_POST["registrationButton"]) && $conn)
{
  // input waarden
  $userName = $_POST["userName"];
  $name = $_POST["name"];
  $surname = $_POST["surname"];
  $address1 = $_POST["address1"];
  $address2 = $_POST["address2"];
  $postCode = $_POST["postCode"];
  $placeName = $_POST["placeName"];
  $country = $_POST["country"];
  $birthDate = $_POST["birthDate"];
  $mailBox = $_POST["mailBox"];
  $password = $_POST["password"];
  $questionNumber = $_POST["questionNumber"];
  $answer = $_POST["answer"];
  $seller = 0;

  // Formulier verificatie
  // Lege velden check
  if (empty($userName) )
  { $errors = $errors + 1;
    $userNameErrorMessage = "Gebruikersnaam verplicht";}
  if (empty($name))
  { $errors = $errors + 1;
    $nameErrorMessage = "Voornaam verplicht";}
  if (empty($surname))
  { $errors = $errors + 1;
    $surnameErrorMessage = "Achternaam verplicht";}
  if (empty($address1))
  { $errors = $errors + 1;
    $address1ErrorMessage = "Adres verplicht";}
  if (empty($postCode))
  { $errors = $errors + 1;
    $postCodeErrorMessage = "Postcode verplicht";}
  if (empty($placeName))
  { $errors = $errors + 1;
    $placeNameErrorMessage = "Plaatsnaam verplicht";}
  if (empty($birthDate))
  { $errors = $errors + 1;
    $birthDateErrorMessage = "Geboortedatum verplicht";}
  if (empty($mailBox))
  { $errors = $errors + 1;
    $mailBoxErrorMessage = "Emailadres verplicht";}
  if (empty($password))
  { $errors = $errors + 1;
    $passwordErrorMessage = "Wachtwoord verplicht";}
  if (empty($answer))
  { $errors = $errors + 1;
    $answerErrorMessage = "Antwoord Beveiligingsvraag verplicht";}

  // Gebruikersnaam al in gebruik check
  $tsql = "SELECT gebruikersnaam FROM tbl_Gebruiker WHERE gebruikersnaam = ?";
  $params = array ($userName);
  $result = sqlsrv_query($conn, $tsql, $params);
  if($result)
  {
    $userNameErrorMessage = "Gebruikersnaam niet beschikbaar";
  }

  // Postcode Check
  $postCodePattern = '{\A [1-9] [0-9]{3} ([A-RT-Za-rt-z] [A-Za-z] | [sS] [BCbcE-Re-rT-Zt-z]) \z}x'; //postcode patroon Nederland
  if (!preg_match($postCodePattern,$postCode) && !empty($postCode))
  {
    $postCodeErrorMessage = "Postcode ongeldig in $country";
  }


  // Registratie
  if ($errors == 0){
      $tsql = "INSERT INTO tbl_Gebruiker VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $params = array($userName,$name,$surname,$address1,$address2,$postCode,$placeName,$country,$birthDate,$mailBox,$password,$questionNumber,$answer,$seller);
      $result = sqlsrv_query($conn, $tsql, $params);
      if(!$result){
        die(print_r( sqlsrv_errors(), true));
      }
      header('Location: ../index.php');
  }

}










// if($conn)
// {
// 	echo "Connection established.<br />";
//
//   $tsql = "SELECT gebruikersnaam FROM tbl_Gebruiker WHERE gebruikersnaam = ?";
//   $params = array ($userName);
//   $result = sqlsrv_query($conn, $tsql, $params);
//   if(!$result){
//     die(print_r( sqlsrv_errors(), true));
//   }
//   if (sqlsrv_has_rows($result)){
//     die('Username exists, please choose another!');
//   }
//
//   $tsql = "Insert INTO tbl_Gebruiker VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
//   $params = array($userName,$name,$surname,$address1,$address2,$postCode,$placeName,$country,$birthDate,$mailBox,$password,$questionNumber,$answer,$seller);
//   $result = sqlsrv_query($conn, $tsql, $params);
//   if(!$result){
//     die(print_r( sqlsrv_errors(), true));
//   }
//   header('Location: ../index.php');
// }


// 	$tsql = "SELECT tst_Column1, tst_Column2, tst_Column3 FROM test";
// 	$result = sqlsrv_query( $conn, $tsql, null);
//
// 	if ( $result === false)
// 	{
// 		die( FormatErrors( sqlsrv_errors() ) );
// 	}
//
// 	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC))
// 	{
// 		echo $row['tst_Column1'].", ".$row['tst_Column2']."<br />";
// 	}
// 	sqlsrv_free_stmt($result);
//   	sqlsrv_close($conn);
// } else
// {
// 	echo "Connection could not be established.<br />";
// 	die( print_r( sqlsrv_errors(), true));

?>
