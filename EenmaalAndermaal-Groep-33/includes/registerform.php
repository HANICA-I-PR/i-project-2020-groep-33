<!DOCTYPE php>

<?php
//initializeren variabelen
$errors = 0;
$mailBox = $_SESSION['mailBox'];
$validationCode = $_GET['validationCode'];
$userName = "";
$name = "";
$surname = "";
$address1 = "";
$address2 = "";
$postCode = "";
$placeName = "";
$country = "";
$birthDate = "";
$password = "";
$questionNumber = "";
$answer = "";
$seller = 0;
$validationCodeErrorMessage = "";
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
  $password = $_POST["password"];
  $questionNumber = $_POST["questionNumber"];
  $answer = $_POST["answer"];
  $seller = 0;

  // Formulier verificatie
  // Lege velden check
  if (empty($userName) )
  { $errors ++;
    $userNameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Gebruikersnaam verplicht</div>";
  }
  if (empty($name))
  { $errors ++;
    $nameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Voornaam verplicht</div>";
  }
  if (empty($surname))
  { $errors ++;
    $surnameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Achternaam verplicht</div>";
  }
  if (empty($address1))
  { $errors ++;
    $address1ErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Adres verplicht</div>";
  }
  if (empty($postCode))
  { $errors ++;
    $postCodeErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Postcode verplicht</div>";
  }
  if (empty($placeName))
  { $errors ++;
    $placeNameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Plaatsnaam verplicht</div>";
  }
  if (empty($birthDate))
  { $errors ++;
    $birthDateErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Geboortedatum verplicht</div>";
  }
  if (empty($mailBox))
  { $errors ++;
    $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Emailadres verplicht</div>";
  }
  if (empty($password))
  { $errors ++;
    $passwordErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Wachtwoord verplicht</div>";
  }
  if (empty($answer))
  { $errors ++;
    $answerErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Antwoord Beveiligingsvraag verplicht</div>";
  }

  //Validatiecode check
  if($validationCode != $_SESSION['validationCode'])
  {
    $errors ++;
    $validationCodeErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Validatiecode niet geldig of verlopen</div>";
  }

  // Gebruikersnaam al in gebruik check
  if(!empty($userName))
  {
    $tsql = "SELECT gebruikersnaam FROM tbl_Gebruiker WHERE gebruikersnaam = ?";
    $params = array ($userName);
    $result = sqlsrv_query($conn, $tsql, $params);
    if(!$result)
    {
      die(print_r( sqlsrv_errors(), true));
    }
      if (sqlsrv_has_rows($result))
      {
        $errors ++;
        $userNameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Gebruikersnaam niet beschikbaar</div>";
      }
  }

    // Postcode Check
    $postCodePattern = '{\A [1-9] [0-9]{3} ([A-RT-Za-rt-z] [A-Za-z] | [sS] [BCbcE-Re-rT-Zt-z]) \z}x'; //postcode patroon Nederland
    if (!preg_match($postCodePattern,$postCode) && !empty($postCode))
    {
      $errors ++;
      $postCodeErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Postcode ongeldig in $country</div>";
    }

    //Datum na huidige datum check
    if (new DateTime() < new dateTime("$birthDate 00:00:00") )
    {
      $errors ++;
      $birthDateErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Geboortedatum moet voor de huidige datum zijn</div>";
    }

  // Registratie
    if ($errors == 0)
    {
        $hashPassword = sha1($password);

        $tsql = "INSERT INTO tbl_Gebruiker VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($userName,$name,$surname,$address1,$address2,$postCode,$placeName,$country,$birthDate,$mailBox,$hashPassword,$questionNumber,$answer,$seller);
        $result = sqlsrv_query($conn, $tsql, $params);
        if(!$result)
        {
          die(print_r( sqlsrv_errors(), true));
        }
        //Niet meer relevante session variabelen unsetten
        unset($_SESSION['mailBox']);
        unset($_SESSION['validationCode']);
        //Inloggen direct na registratie
        $_SESSION['userName'] = $userName;
        header('Location: ../index.php');
    }

}

?>
