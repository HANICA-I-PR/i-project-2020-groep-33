<?php
//Niet ingelogd check
if(!isset($_SESSION['userName']))
{
  header("Location:index.php");
}

//initialiseer variabelen
$errors = 0;
$openBidErrorMessage = "";
$openSaleErrorMessage = "";

//Verwijder account
if(isset($_POST['deleteButton']))
{

  //Koper heeft hoogste bod controle
  //Fetch alle biedingen door gebruiker op open veilingen
  $tsql = "SELECT voorwerp, bodbedrag
           FROM tbl_Bod
           INNER JOIN tbl_Voorwerp ON voorwerp = voorwerpnummer
           WHERE gebruiker = ?
           AND veiling_gesloten = ?";
  $params = array($_SESSION['userName'], 0);
  $result = sqlsrv_query($conn, $tsql, $params);
  //SQL query voor het vinden van het hoogste bodbedrag bij een bepaalde veiling
  $tsql = "SELECT TOP 1 bodbedrag
           FROM tbl_Bod
           WHERE voorwerp = ?
           order by bodbedrag DESC";

  if(sqlsrv_has_rows($result))
  {
    //Controle eerst gevonden bod ook het hoogste bod voor het voorwerp is
    $row = sqlsrv_fetch_array($result);
    $params = array($row['voorwerp']);
    $bidResult = sqlsrv_query($conn, $tsql, $params);
    $highestBid = sqlsrv_fetch_array($bidResult);
    //Als een hoogste bieding is gevonden geef error
    if($row['bodbedrag'] = $highestBid['bodbedrag'])
    {
      $errors ++;
      $openBidErrorMessage = "<div class='alert alert-info' role='alert'>U hebt op dit moment het hoogste bod op een voorwerp. U kunt uw account verwijderen als u overboden word of wanneer de desbetreffende veiling sluit. U kunt op de account pagina de veiling in de gaten houden.</div>";
    }
    else {
      $openBidErrorMessage.= $row['bodbedrag'];
    }
    //Herhaal controle voor alle biedingen
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) && $errors == 0)
    {
      $params = array($row['voorwerp']);
      $bidResult = sqlsrv_query($conn, $tsql, $params);
      $highestBid = sqlsrv_fetch_array($bidResult);
      //Als een hoogste bieding is gevonden geef error
      if($row['bodbedrag'] = $highestBid['bodbedrag'])
      {
        $errors ++;
        $openBidErrorMessage = "<div class='alert alert-info' role='alert'>U hebt op dit moment het hoogste bod op een voorwerp. U kunt uw account verwijderen wanneer u overboden word of wanneer de desbetreffende veiling sluit. Op de account pagina kunt u uw actieve veilingen in de gaten houden.</div>";
      }
      else {
        $openBidErrorMessage.= $row['bodbedrag'];
      }
    }
  }

  //Verkoper open veilingen check
  $tsql = "SELECT voorwerpnummer
           FROM tbl_Voorwerp
           WHERE verkoper = ?
           AND veiling_gesloten = ?";
  $params = array($_SESSION['userName'], 0);
  $result = sqlsrv_query($conn, $tsql, $params);
  if (sqlsrv_has_rows($result))
  {
    $errors ++;
    $openSaleErrorMessage = "<div class='alert alert-info' role='alert'>U hebt op dit moment als verkoper een veiling openstaan. U kunt uw account verwijderen wanneer u geen veilingen meer open hebt staan. Op de account pagina kunt u uw actieve veilingen in de gaten houden.</div>";
  }

  //annonimiseren veilingen en biedingen, verwijderen persoonsgegevens
  if($errors == 0)
  {
    //annonimiseer verkoper voorwerp
    $params = array('Onbekend', $_SESSION['userName']);
    $tsql = "UPDATE tbl_Voorwerp
             SET verkoper = ?
             WHERE verkoper = ?";
    $result = sqlsrv_query($conn, $tsql, $params);

    //annonimiseer koper voorwerp
    $tsql = "UPDATE tbl_Voorwerp
             SET koper = ?
             WHERE koper = ?";
    $result = sqlsrv_query($conn, $tsql, $params);

    //annonimiseer gebruiker bod
    $tsql = "UPDATE tbl_Bod
             SET gebruiker = ?
             WHERE gebruiker = ?";
    $result = sqlsrv_query($conn, $tsql, $params);

    //verwijder telefoonnummers
    $params = array($_SESSION['userName']);
    $tsql = "DELETE FROM tbl_Gebruikerstelefoon
             WHERE gebruiker = ?";
    $result = sqlsrv_query($conn, $tsql, $params);

    //verwijder bankgegevens
    $tsql = "DELETE FROM tbl_Verkoper
             WHERE gebruiker = ?";
    $result = sqlsrv_query($conn, $tsql, $params);

    //verwijder persoonsgegevens
    $tsql = "DELETE FROM tbl_Gebruiker
             WHERE gebruikersnaam = ?";
    $result = sqlsrv_query($conn, $tsql, $params);

    //Log uit
    include('logout.php');


  }




}
?>
