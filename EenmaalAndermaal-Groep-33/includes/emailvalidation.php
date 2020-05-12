<!DOCTYPE php>

<?php
$mailBox = "";
$mailBoxErrorMessage = "";
$errors = 0;
$validationCode = "";
if (isset($_POST["validationButton"]) && $conn)
{
  $mailBox = $_POST['mailBox'];

  //Nonempty check
  if (empty($mailBox))
  { $errors ++;
    $mailBoxErrorMessage = "U hebt geen emailadres ingevuld";
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
      if (sqlsrv_has_rows($result))
      {
        $errors ++;
        $mailBoxErrorMessage = "Emailadres is al in gebruik";
      }
  }

  //Verzending verificatiemail
  if ($errors == 0)
  {
    $validationCode = sprintf('%06d', rand(0,999999));
    $_SESSION['validationCode'] = $validationCode;
    $_SESSION['mailBox'] = $mailBox;
    $validationLink = "https://iproject33.icasites.nl/register.php?validationCode=$validationCode";

    $msg = "Welkom bij EenmaalAndermaal!\nOm uw registratie te voltooien dient de onderstaande link te volgen, om vervolgens uw gegevens in te voeren.\n".$validationLink."\nNa het registreren kunt u meebieden op producten of zelfs zelf producten gaan verkopen!";
    $msg = wordwrap($msg,70);

    mail($mailBox,"Email-validatiecode EenmaalAndermaal",$msg);
  }
}
?>
