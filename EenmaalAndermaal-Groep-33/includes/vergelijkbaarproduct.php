<?php
include('itemToCard.php');

if ( $conn) {
  $tsql = "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
          FROM tbl_Voorwerp";
  $params = array();
  $result = sqlsrv_query($conn, $tsql, $params);
  $row = sqlsrv_fetch_array($result); // bovenste rij

  $filesql = "SELECT TOP 1 filenaam
         FROM tbl_Bestand
         WHERE voorwerp = ?";
  $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
  $file = sqlsrv_fetch_array($fileresult);
  if ( sqlsrv_has_rows($fileresult)) {
  $row = array_merge($row, $file);
}

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
if ($result === false)
{
  die( FormatErrors( sqlsrv_errors() ) );
}

 $afbeeldingen = '';
 $afbeeldingen .= "<div class='row'>";
 $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
 $afbeeldingen .= itemToCard($row, $conn);
 $afbeeldingen .=  "</div>";
  for($i = 0; $i<3; $i++ )
   {
      $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
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
  sqlsrv_free_stmt($query);
  sqlsrv_close($conn);
} else {
  echo "Connection could not be established.<br />";
  die( print_r( sqlsrv_errors(), true));
}
 ?>
