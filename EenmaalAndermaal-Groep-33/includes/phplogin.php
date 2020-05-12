<!DOCTYPE php>

<?php
//initializeren variabelen
$errors = 0;
$userName = "";
$password = "";
$userNameErrorMessage = "";
$passwordErrorMessage = "";
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
    $userNameErrorMessage = "<div class='alert alert-danger' role='alert'>U hebt geen gebruikersnaam ingevuld</div>";
  }
  if (empty($password))
  {
    $errors ++;
    $passwordErrorMessage = "<div class='alert alert-danger' role='alert'>U hebt geen wachtwoord ingevuld</div>";
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
      $loginErrorMessage = "<div class='alert alert-danger' role='alert'>Deze combinatie van gebruikersnaam en wachtwoord wordt niet herkend</div>";
    }
  }

}
?>
