<!DOCTYPE php>

<?php
include('itemToCard.php');

$userNameErrorMessage = "";
$nameErrorMessage = "";
$surnameErrorMessage = "";
$address1ErrorMessage = "";
$address2ErrorMessage = "";
$postCodeErrorMessage = "";
$placeNameErrorMessage = "";
$birthDateErrorMessage = "";
$mailBoxErrorMessage = "";
$passwordErrorMessage = "";
$answerErrorMessage = "";
$alteredAccountInformationNotification="";


//Ingelogd check
if (isset($_SESSION['userName']) && $conn)
{
  $accountInformation = array();
  $informationHTML = "";
  $saleInformation = array();
  $auctionInformation = "";
  //PLACEHOLDER
  $test="";

  //Fetch gebruikers gegevens
  $tsql = "SELECT voornaam, achternaam, adresregel1, adresregel2, postcode, plaatsnaam, land, geboorteDag, email, verkoper
           FROM tbl_Gebruiker
           WHERE gebruikersnaam = ?";
  $params = array($_SESSION['userName']);
  $result = sqlsrv_query($conn, $tsql, $params);
  $accountInformation = sqlsrv_fetch_array($result);

  //Fetch telefoonnummers
  $tsql = "SELECT telefoon
           FROM tbl_Gebruikerstelefoon
           WHERE gebruiker = ?";
  $params = array($_SESSION['userName']);
  $result = sqlsrv_query($conn, $tsql, $params);
  $telephoneNumbers = array($result);

  while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
  {
    $result = sqlsrv_query($conn, $tsql, $params);
    $telephoneNumbers = array_merge($telephoneNumbers, array($result));
  }


  //Gegevens in html zetten
  $informationHTML .= "<b>Voornaam:</b><div class='well well-sm'>".$accountInformation['voornaam']."</div>";
  $informationHTML .= "<b>Achternaam:</b> <div class='well well-sm'>".$accountInformation['achternaam']."</div>";
  $informationHTML .= "<b>Adresregel 1:</b> <div class='well well-sm'>".$accountInformation['adresregel1']."</div>";
  if ($accountInformation['adresregel2'])
  {
    $informationHTML .= "<b>Adresregel 2:</b> <div class='well well-sm'>".$accountInformation['adresregel2']."</div>";
  }
  $informationHTML .= "<b>Postcode:</b> <div class='well well-sm'>".$accountInformation['postcode']."</div>";
  $informationHTML .= "<b>Plaatsnaam:</b> <div class='well well-sm'>".$accountInformation['plaatsnaam']."</div>";
  $informationHTML .= "<b>Land:</b> <div class='well well-sm'>".$accountInformation['land']."</div>";
  $informationHTML .= "<b>Geboortedatum:</b> <div class='well well-sm'>".date_format($accountInformation['geboorteDag'], 'd-m-Y')."</div>";
  $informationHTML .="<label for='Emailadres' class='control-label'>Emailadres</label><input type='email' maxlength='50' name='mailBox' id='Emailadres' value='";
  $informationHTML .= htmlspecialchars($accountInformation['email'], ENT_QUOTES);
  $informationHTML .= "' class='form-control'>";
  $informationHTML .= "<b>E-mail:</b> <div class='well well-sm'>".$accountInformation['email']."</div>";


  //Fetch actieve veilingen behorende bij de gebruiker als verkoper
  if($accountInformation['verkoper'] == 1)
  {
    $tsql = "SELECT voorwerpnummer, titel, startprijs, looptijd, tbl_Voorwerp.verkoper, looptijdEindeDag, looptijdEindeTijdstip
              FROM tbl_Voorwerp
                INNER JOIN tbl_Gebruiker ON tbl_Voorwerp.verkoper = tbl_Gebruiker.gebruikersnaam
              WHERE gebruikersnaam = ?";
    $result = sqlsrv_query($conn, $tsql, $params);
    if(sqlsrv_has_rows($result))
    {
      $row = sqlsrv_fetch_array($result); // bovenste rij

      $filesql = "SELECT TOP 1 filenaam
             FROM tbl_Bestand
             WHERE voorwerp = ?";
      $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
      $file = sqlsrv_fetch_array($fileresult);
      $row = array_merge($row, $file);

      $auctionInformation.= itemToCard($row);
      //PLACEHOLDER
      $test.= itemToCard($row);
      while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
      {
        $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
        $file = sqlsrv_fetch_array($fileresult);
        $row = array_merge($row, $file);
        $auctionInformation.= itemToCard($row);
      }
    }
    else
    {
      $auctionInformation = "U verkoopt nog geen voorwerpen. Klik op de bovenstaande knop om voorwerpen te verkopen.";
    }
  }
  else
  {
    $auctionInformation = "U bent nog geen verkoper. Als U zelf veilingen op wil zetten om voorwerpen te verkopen moet U zich eerst als verkoper aanmelden. Dit is makkelijk en snel te doen door op de onderstaande knop te drukken.";
    $auctionInformation .= "PLACEHOLDER TEXT";
  }

  //Wijzig account informatie knop ingedrukt
  if (isset($_POST["accountInformationButton"]))
  {
    $mailBox = $_POST['mailBox'];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $postCode = $_POST["postCode"];
    $placeName = $_POST["placeName"];
    $country = $_POST["country"];
    $birthDate = $_POST["birthDate"];
    $phoneNumber = $_POST['telephoneNumber'];
    $errors = 0;

    //Empty check
    if (empty($mailBox))
    { $errors ++;
      $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Emailadres verplicht</div>";
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
      $birthDateErrorMessage = "<div class='alert alert-danger' role='alert'>Geboortedatum verplicht</div>";
    }

    //Verandering check
    if ($mailBox == $accountInformation['email'] &&
        $name == $accountInformation['voornaam'] &&
        $surname == $accountInformation['achternaam'] &&
        $address1 == $accountInformation['adresregel1'] &&
        $address2 == $accountInformation['adresregel2'] &&
        $postCode == $accountInformation['postcode'] &&
        $placeName == $accountInformation['plaatsnaam'])
    {
      $errors ++;
      echo ("TEST1");
    }

    //Email al in gebruik check
    if($mailBox != $accountInformation['email'])
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
          $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert'>Emailadres is al in gebruik</div>";
        }
     }
     //Datum na huidige datum check
     if (new DateTime() < new dateTime("$birthDate 00:00:00") )
     {
       $errors ++;
       $birthDateErrorMessage = "<div class='alert alert-danger' role='alert'>Geboortedatum moet voor de huidige datum zijn</div>";
     }

     //Doorvoeren wijzigingen
     if ($errors == 0)
     {
       $tsql = "UPDATE tbl_Gebruiker
                SET voornaam = ?, achternaam = ?, adresregel1 = ?, adresregel2 = ?,
                    postcode = ?, plaatsnaam = ?, land = ?, geboorteDag = ?, email = ?
                WHERE gebruikersnaam = ?";
       $params = array($name, $surname, $address1, $address2, $postCode, $placeName, $country, $birthDate, $mailBox, $_SESSION['userName']);
       $result = sqlsrv_query($conn, $tsql, $params);
       echo("TEST2");
       $alteredAccountInformationNotification = "<div class='alert alert-info text-center' role='alert'>Uw account informatie is aangepast!</div>";
     }

  }



  $userName = $_SESSION['userName'];

}


?>
