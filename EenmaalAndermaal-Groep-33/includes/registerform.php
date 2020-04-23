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

  $tsql = "Insert INTO tbl_Gebruiker VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $params = array($userName,$name,$surname,$address1,$address2,$postCode,$placeName,$country,$birthDate,$mailBox,$password,$questionNumber,$answer,$seller);
  $result = sqlsrv_query($conn, $tsql, $params);
  if(!$result){
    die(print_r( sqlsrv_errors(), true));
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
