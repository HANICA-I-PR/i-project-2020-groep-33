<!DOCTYPE php>

<?php
//initializeren variabelen
$errors = 0;
$userName = "";
$password = "";
$loginErrorMessage = "";

//Gebruiker login
if (isset($_POST["loginButton"]) && $conn)
{
  $userName = $_POST['userName'];
  $password = $_POST['password'];
  //nonempty checks
  if (empty($userName))
  {
    $errors ++;
    $userNameErrorMessage = "U hebt geen gebruikersnaam ingevuld";
  }
  if (empty($password))
  {
    $errors ++;
    $passwordErrorMessage = "U hebt geen wachtwoord ingevuld";
  }
  //login
  if ($errors == 0)
  {

    $hashPassword = sha1($password);

    $tsql = "SELECT * FROM tbl_Gebruiker WHERE gebruikersnaam = ? AND wachtwoord = ?";
    $params = array($userName,$hashPassword);
    $result = sqlsrv_query($conn, $tsql, $params);
    if (sqlsrv_has_rows($result))
    {
      $_SESSION['userName'] = $userName;
      header('location: index.php');
    } else {
      $loginErrorMessage = "Deze combinatie van gebruikersnaam en wachtwoord wordt niet herkend";
    }
  }

}
?>
