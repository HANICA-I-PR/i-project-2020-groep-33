<!DOCTYPE php>

<?php
$mailBox = "";
$mailBoxErrorMessage = "";
$errors = 0;
$validationCode = "";
if ((isset($_POST["validationButton"]) || isset($_POST["recoveryButton"]) ) && $conn)
{
  $mailBox = $_POST['mailBox'];

  //Nonempty check
  if (empty($mailBox))
  { $errors ++;
    $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert'>U hebt geen emailadres ingevuld</div>";
  }

  //Email al in gebruik check
  if(!empty($mailBox))
  {
    $tsql = "SELECT email FROM tbl_Gebruiker WHERE email = ?";
    $params = array ($mailBox);
    $result = sqlsrv_query($conn, $tsql, $params);
    if($result === false)
    {
      die(print_r( sqlsrv_errors(), true));
    }
      if (sqlsrv_has_rows($result) && isset($_POST["validationButton"]))
      {
        $errors ++;
        $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert'>Emailadres is al in gebruik</div>";
      }
      else if (!sqlsrv_has_rows($result) && isset($_POST["recoveryButton"]))
      {
        $errors ++;
        $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert'>Emailadres niet gevonden.</div>";
      }
  }

  //Verzending verificatiemail
  if ($errors == 0)
  {
    $validationCode = sprintf('%06d', rand(0,999999));



    if (isset($_POST["validationButton"]))
    {
      $_SESSION['mailBox'] = $mailBox;
      $_SESSION['validationCode'] = $validationCode;
      $validationLink = "https://iproject33.icasites.nl/register.php?validationCode=$validationCode";
      $msg = "Welkom bij EenmaalAndermaal!\nOm uw registratie te voltooien dient de onderstaande link te volgen, om vervolgens uw gegevens in te voeren.\n".$validationLink."\nNa het registreren kunt u meebieden op producten of zelfs zelf producten gaan verkopen!";
    }
    elseif (isset($_POST["recoveryButton"]))
    {
      $_SESSION['recoveryMailBox'] = $mailBox;
      $_SESSION['recoveryCode'] = $validationCode;
      $recoveryLink = "https://iproject33.icasites.nl/wachtwoordReset.php?validationCode=$validationCode";
      $msg = "Welkom bij EenmaalAndermaal!\nOm uw wachtwoord opnieuw in te stellen dient u de onderstaande link te volgen, om vervolgens uw gegevens in te voeren.\n".$recoveryLink."\nNadat het wachtwoord is veranderd kunt u met het nieuwe wachtwoord inloggen.";
    }
    $msg = wordwrap($msg,70);
    mail($mailBox,"Email-validatiecode EenmaalAndermaal",$msg);
  }
}
?>
