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
$alteredAccountErrorMessage = "";
$alteredAccountInformationNotification="";


//Ingelogd check
if (isset($_SESSION['userName']) && $conn)
{
  $accountInformation = array();
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
      $auctionInformation = "<div class='alert alert-info text-center' role='alert'>Gefeliciteerd! U bent een verkoper</div>U verkoopt nog geen voorwerpen. Klik op de bovenstaande knop om voorwerpen te verkopen.";
    }
  }
  else
  {
    $auctionInformation = "<b>U bent nog geen verkoper.</b> Als U zelf veilingen op wil zetten om voorwerpen te verkopen moet U zich eerst als verkoper aanmelden. U kunt makkelijk en snel verkoper worden door het onderstaande formulier in te vullen.";
    $auctionInformation.= "<br>U bent verplicht om een bankrekeningnummer of creditcardnummer op te geven. Beide opgeven is ook een optie.";
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

    //Lengtes check
    if (strlen($mailBox) > 50)
    {
      $errors ++;
      $mailBoxErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Emailadres maximaal 50 tekens</div>";
    }
    if (strlen($name) > 50)
    {
      $errors ++;
      $nameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Voornaam maximaal 50 tekens</div>";
    }
    if (strlen($surname) > 58)
    {
      $errors ++;
      $surnameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Achternaam maximaal 58 tekens</div>";
    }
    if (strlen($address1) > 55)
    {
      $errors ++;
      $address1ErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Adresregel maximaal 55 tekens</div>";
    }
    if (strlen($address2) > 55)
    {
      $errors ++;
      $address2ErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Adresregel maximaal 55 tekens</div>";
    }
    if (strlen($postCode) > 10)
    {
      $errors ++;
      $postCodeErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Postcode maximaal 10 tekens</div>";
    }
    if (strlen($placeName) > 28)
    {
      $errors ++;
      $placeNameErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Plaatsnaam maximaal 28 tekens</div>";
    }


    //Verandering check
    if ($mailBox == $accountInformation['email'] &&
        $name == $accountInformation['voornaam'] &&
        $surname == $accountInformation['achternaam'] &&
        $address1 == $accountInformation['adresregel1'] &&
        $address2 == $accountInformation['adresregel2'] &&
        $postCode == $accountInformation['postcode'] &&
        $placeName == $accountInformation['plaatsnaam'] &&
        $birthDate == date_format($accountInformation['geboorteDag'], 'Y-m-d'))
    {
      $errors ++;
      $alteredAccountErrorMessage = "<div class='alert alert-danger' role='alert'>U hebt geen account informatie gewijzigd.</div>";
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
       $alteredAccountInformationNotification = "<div class='alert alert-info text-center' role='alert'>Uw account informatie is aangepast! Refresh de pagina om up-to-date informatie te bekijken.</div>";
     }

  }



  $userName = $_SESSION['userName'];

}


?>
