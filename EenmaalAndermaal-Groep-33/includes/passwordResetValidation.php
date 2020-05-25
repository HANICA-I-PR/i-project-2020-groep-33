<!DOCTYPE php>

<?php
//initializeren variabelen
$errors = 0;
$mailBox = $_SESSION['recoveryMailBox'];
$validationCode = "";
if(isset($_GET['validationCode'])){
  $validationCode = $_GET['validationCode'];
}
$password = "";
$answer = "";
$alteredPasswordNotification = "";
$validationCodeErrorMessage = "";
$mailBoxErrorMessage = "";
$passwordErrorMessage = "";
$answerErrorMessage = "";

// Gebruiker registratie
if (isset($_POST["validationButton"]) && $conn)
{
  // input waarden
  $password = $_POST["password"];
  $answer = $_POST["answer"];
  $validationCode = $_POST["validationCode"];

  // Formulier verificatie
  // Lege velden check
  if (empty($mailBox))
  { $errors ++;
    $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert'>Emailadres verplicht</div>";
  }
  if (empty($password))
  { $errors ++;
    $passwordErrorMessage = "<div class='alert alert-danger' role='alert'>Wachtwoord verplicht</div>";
  }
  //Beide validatiemethodes leeg
  if (empty($answer) && empty($validationCode) )
  { $errors ++;
    $answerErrorMessage = "<div class='alert alert-danger' role='alert'>Antwoord Beveiligingsvraag of Validatiecode verplicht</div>";
  }

  //Fetch beveiligingsvraag antwoord uit database
  if (!empty($answer))
  {
    $tsql = "SELECT antwoord_text
             FROM tbl_Gebruiker
             WHERE email = ?";
    $params = array($_SESSION['recoveryMailBox']);
    $result = sqlsrv_query($conn, $tsql, $params);
    $answerRow = sqlsrv_fetch_array($result);
  }
  //Er is ten minste 1 validatiemethode ingevuld
  if(!empty($answer) || !empty($validationCode))
  {
      //Validatiecode check
      if(!empty($validationCode) && $validationCode != $_SESSION['recoveryCode'])
      {
        $errors ++;
        $validationCodeErrorMessage = "<div class='alert alert-danger' role='alert'>Validatiecode niet geldig of verlopen</div>";
      }
      //Beveiligingsvraag antwoord check;
      if(!empty($answer) && $answer != $answerRow['antwoord_text'])
      {
        $errors++;
        $answerErrorMessage = "<div class='alert alert-danger' role='alert'>Antwoord Beveiligingsvraag onjuist</div>";
      }
  }






  //Mailbox check
  if($mailBox != $_SESSION['recoveryMailBox'])
  {
    $errors ++;
    $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert'>Er is een mail gestuurd naar een ander email.</div>";
  }

  // Registratie
  if ($errors == 0)
        {
          $hashPassword = sha1($password);

          $tsql = "UPDATE tbl_Gebruiker
                   SET wachtwoord = ?
                   WHERE email = ?";
          $params = array($hashPassword, $_SESSION['recoveryMailBox']);
          $result = sqlsrv_query($conn, $tsql, $params);
          $alteredPasswordNotification = "<div class='alert alert-info text-center' role='alert'>Uw wachtwoord is gewijzigd!</div>";

        //Mail ter bevestiging sturen
        $msg = "Beste EenmaalAndermaal gebruiker,\nrecentelijk is uw wachtwoord gewijzigd. U kunt vanaf nu inloggen met uw nieuwe wachtwoord!\nAls u uw wachtwoord niet zelf gewijzigd hebt, neem dan zo snel mogelijk contact op met de klantenservice van EenmaalAndermaal!";
        $msg = wordwrap($msg,70);
        mail($_SESSION['recoveryMailBox'], "EenmaalAndermaal: Wachtwoord Gewijzigd", $msg);

        //Niet meer relevante session variabelen unsetten
        unset($_SESSION['recoveryMailBox']);
        unset($_SESSION['recoveryCode']);
        //naar inlogpagina direct na wijziging wachtwoord
        header('Location: ../login.php');
        }

}

?>
