<!DOCTYPE php>

<?php
$serverName = "mssql.iproject.icasites.nl";
$connectionInfo = array( "Database"=>"iproject33",  "UID"=>"iproject33", "PWD"=>"thsPUqnU");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$userName = $_POST["userName"];
$userNameErrorMessage = "";
$name = $_POST["name"];
$nameErrorMessage = "";
$surname = $_POST["surname"];
$surnameErrorMessage = "";
$address1 = $_POST["address1"];
$address1ErrorMessage = "";
$address2 = $_POST["address2"];
$adress2ErrorMessage = "";
$postCode = $_POST["postCode"];
$postCodeErrorMessage = "";
$placeName = $_POST["placeName"];
$placeNameErrorMessage = "";
$country = $_POST["country"];
$birthDate = $_POST["birthDate"];
$birthDateErrorMessage = "";
$mailBox = $_POST["mailBox"];
$mailBoxErrorMessage = "";
$password = $_POST["password"];
$passwordErrorMessage = "";
$questionNumber = $_POST["questionNumber"];
$answer = $_POST["answer"];
$answerErrorMessage = "";
$seller = 0;
$isValid = true;

if(!$userName || !$name || !$surname || !$address1 || !$postCode || !$placeName || !$country || !$birthDate || !$mailBox || !$password || !$questionNumber || !$answer)
{
  $isvalid = false;
}

if($conn)
{
	echo "Connection established.<br />";

  // Gebruikersnaam al in gebruik check
  if(!empty($userName)){
    $tsql = "SELECT gebruikersnaam FROM tbl_Gebruiker WHERE gebruikersnaam = ?";
    $params = array ($userName);
    $result = sqlsrv_query($conn, $tsql, $params);
    if(!$result)
    {
      die(print_r( sqlsrv_errors(), true));
    }
      if (sqlsrv_has_rows($result)){
        $errors = $errors + 1;
        $userNameErrorMessage = "Gebruikersnaam niet beschikbaar";
      }
  }

  // Postcode Check
  $postCodePattern = '{\A [1-9] [0-9]{3} ([A-RT-Za-rt-z] [A-Za-z] | [sS] [BCbcE-Re-rT-Zt-z]) \z}x'; //postcode patroon Nederland
  if (!preg_match($postCodePattern,$postCode) && !empty($postCode))
  {
    $errors = $errors + 1;
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
