<?php
if ( $conn)
{

  if (isset($_POST['zoeken']))
  {

  $_term = $_POST['term'];
  //Splits de input op in delen, gescheiden door een spatie
  $searchTerms = explode( " ", $_POST['term']);
  //Limiteer dit aantal delen tot 5
  $searchTerms = array_slice($searchTerms, 0, 5);

  //SQL script wat alle voorwerpen zoekt die één of meerder zoektermen in titel of beschrijving hebben
  //Deze worden gesorteerd op basis van het aantal zoektermen wat gevonden wordt
  //gedeelte van sql script opslaan zodat er niet 2 keer een lus gebruikt hoeft te worden
  $temptsql = "";
  //voeg alle zoektermen toe aan het SQL script
  for ($i = 0; $i < count($searchTerms); $i++)
  {
    if($i>0)
    {
      $temptsql .= " + ";
    }
    $temptsql .= "SUM( CASE WHEN titel LIKE '%".$searchTerms[$i]."%' OR beschrijving LIKE '%".$searchTerms[$i]."%' THEN 1 ELSE 0 END)";

  }
  //Rest van het sql script
  $tsql  = "SELECT verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs,";
  $tsql .= $temptsql;
  $tsql .= " as TOTAAL
            FROM tbl_Voorwerp
            INNER JOIN tbl_Bestand ON tbl_Bestand.voorwerp = tbl_voorwerp.voorwerpnummer
            GROUP BY verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
            HAVING ";
  $tsql .= $temptsql;
  $tsql .= " >= 1
            ORDER BY TOTAAL DESC";
  }

  //Als er via een rubriek gezocht wordt:
  else if(isset($_GET['rubriek']))
  {
    //Query wat alle voorwerpen selecteert die bij de rubriek horen
    $tsql = "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
              FROM tbl_Voorwerp
              INNER JOIN tbl_Voorwerp_in_rubriek ON tbl_Voorwerp.voorwerpnummer = tbl_Voorwerp_in_rubriek.voorwerp
              WHERE rubriek_op_laagste_niveau =".$_GET['rubriek'];
  }

  //Als er geen rubriek geselecteerd is en geen zoekterm ingesteld is
  else
  {
    //Query wat alle voorwerpen selecteert
    $tsql = "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
              FROM tbl_Voorwerp";
   }
   //Fetch bij elk voorwerp een bijbehorend plaatje
  $params = array();
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

	// select query voor max bod bedrag met de naam van de gebruiker die het geboden heeft.
	$bodsql = "SELECT TOP 1 bodbedrag, gebruiker
				FROM tbl_Bod
				WHERE voorwerp = ?
				order by bodbedrag DESC";
	$bodresult = sqlsrv_query($conn, $bodsql, array($row['voorwerpnummer']));
	$file = sqlsrv_fetch_array($bodresult);
	 if ( sqlsrv_has_rows($bodresult)) {
    $row = array_merge($row, $file);
	}
  }

  if ($result === false){
    die( FormatErrors( sqlsrv_errors()));
  }

  //Voeg alle informatie samen in een card doormiddel van itemToCard
  if(sqlsrv_has_rows($result))
  {

    $afbeeldingen = '';
    $afbeeldingen .= "<div class='row'>";

    $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
    $afbeeldingen .= itemToCard($row, $conn);
    $afbeeldingen .=  "</div>";
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC))
    {
      $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
      $file = sqlsrv_fetch_array($fileresult);
      $row = array_merge($row, $file);

	  $bodresult = sqlsrv_query($conn, $bodsql, array($row['voorwerpnummer']));
	  $file = sqlsrv_fetch_array($bodresult);
	  if ( sqlsrv_has_rows($bodresult)) {
	  $row = array_merge($row, $file);
	  }

      $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
      $afbeeldingen .= itemToCard($row, $conn);
      $afbeeldingen .=  "</div>";
    }
    $afbeeldingen .= "</div>";
    echo $afbeeldingen;
    sqlsrv_free_stmt($fileresult);
    sqlsrv_close($conn);

  }
  //Melding geven wanneer er geen voorwerpen gevonden zijn
  else
  {
    echo("<div class='alert alert-danger text-center' role='alert'>Geen items gevonden in deze categorie</div>");
  }

}
//Medling geven wanneer er geen verbinding met de database kan worden gesloten
else
{
  echo "Connection could not be established.<br />";
  die( print_r( sqlsrv_errors(), true));
}


 ?>
