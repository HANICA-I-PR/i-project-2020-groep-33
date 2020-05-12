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
    $userNameErrorMessage = "Gebruikersnaam verplicht";
  }
  if (empty($name))
  { $errors ++;
    $nameErrorMessage = "Voornaam verplicht";
  }
  if (empty($surname))
  { $errors ++;
    $surnameErrorMessage = "Achternaam verplicht";
  }
  if (empty($address1))
  { $errors ++;
    $address1ErrorMessage = "Adres verplicht";
  }
  if (empty($postCode))
  { $errors ++;
    $postCodeErrorMessage = "Postcode verplicht";
  }
  if (empty($placeName))
  { $errors ++;
    $placeNameErrorMessage = "Plaatsnaam verplicht";
  }
  if (empty($birthDate))
  { $errors ++;
    $birthDateErrorMessage = "Geboortedatum verplicht";
  }
  if (empty($mailBox))
  { $errors ++;
    $mailBoxErrorMessage = "Emailadres verplicht";
  }
  if (empty($password))
  { $errors ++;
    $passwordErrorMessage = "Wachtwoord verplicht";
  }
  if (empty($answer))
  { $errors ++;
    $answerErrorMessage = "Antwoord Beveiligingsvraag verplicht";
  }

  //Validatiecode check
  if($validationCode != $_SESSION['validationCode'])
  {
    $errors ++;
    $validationCodeErrorMessage = "Validatiecode niet geldig of verlopen";
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
        $userNameErrorMessage = "Gebruikersnaam niet beschikbaar";
      }
  }

    // Postcode Check
    $postCodePattern = '{\A [1-9] [0-9]{3} ([A-RT-Za-rt-z] [A-Za-z] | [sS] [BCbcE-Re-rT-Zt-z]) \z}x'; //postcode patroon Nederland
    if (!preg_match($postCodePattern,$postCode) && !empty($postCode))
    {
      $errors ++;
      $postCodeErrorMessage = "Postcode ongeldig in $country";
    }

    //Datum na huidige datum check
    if (new DateTime() < new dateTime("$birthDate 00:00:00") )
    {
      $errors ++;
      $birthDateErrorMessage = "Geboortedatum moet voor de huidige datum zijn";
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
        header('Location: ../index.php');
    }

}

?>
