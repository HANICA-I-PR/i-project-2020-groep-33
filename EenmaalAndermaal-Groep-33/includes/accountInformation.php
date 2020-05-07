<!DOCTYPE php>

<?php
include('itemToCard.php');

if (isset($_SESSION['userName']) && $conn)
{
  $accountInformation = array();
  $informationHTML = "";
  $saleInformation = array();
  $auctionInformation = "";
  $test="";

  //Fetch gebruikers gegevens
  $tsql = "SELECT * FROM tbl_Gebruiker WHERE gebruikersnaam = ?";
  $params = array($_SESSION['userName']);
  $result = sqlsrv_query($conn, $tsql, $params);
  $accountInformation = sqlsrv_fetch_array($result);

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
  $informationHTML .= "<b>E-mail:</b> <div class='well well-sm'>".$accountInformation['email']."</div>";


  //Fetch actieve veilingen behorende bij de gebruiker als verkoper
  if($accountInformation['verkoper'] == 1)
  {
    $tsql = "SELECT voorwerpnummer, titel, filenaam
              FROM tbl_Voorwerp
                INNER JOIN tbl_Gebruiker ON tbl_Voorwerp.verkoper = tbl_Gebruiker.gebruikersnaam
                INNER JOIN tbl_Bestand ON tbl_Voorwerp.voorwerpnummer = tbl_Bestand.voorwerp
              WHERE gebruikersnaam = ?";
    $result = sqlsrv_query($conn, $tsql, $params);
    $row = sqlsrv_fetch_array($result); // bovenste rij

    // $auctionInformation .= "<img src= ".$row['filenaam']." class='img-responsive' style='max-height:200px' alt='Image'>";
    // $auctionInformation .= "<p>".$row['titel']."</p>";
    $auctionInformation.= itemToCard($row);
    $test.= itemToCard($row);
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
    {
      $auctionInformation.= itemToCard($row);
      // $auctionInformation .= "<img src= ".$row['filenaam']." class='img-responsive' style='max-height:200px' alt='Image'>";
      // $auctionInformation .= "<p>".$row['titel']."</p>";



      // $auctionInformation .= "<br><br>".$row['titel'] ;
    }
  }
  else
  {
    $auctionInformation = "U bent nog geen verkoper. Als U zelf veilingen op wil zetten om voorwerpen te verkopen moet U zich eerst als verkoper aanmelden. Dit is makkelijk en snel te doen door op de onderstaande knop te drukken.";
    $auctionInformation .= "PLACEHOLDER TEXT";
  }



  $userName = $_SESSION['userName'];

}


?>
