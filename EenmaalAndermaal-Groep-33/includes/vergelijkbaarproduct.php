<?php
include('itemToCard.php');

if ( $conn) {
  $tsql = "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, filenaam, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
          FROM tbl_Voorwerp
          INNER JOIN tbl_Bestand ON tbl_Bestand.voorwerp = tbl_Voorwerp.voorwerpnummer";
  $params = array();
  $result = sqlsrv_query($conn, $tsql, $params);
  $row = sqlsrv_fetch_array($result); // bovenste rij

if ($result === false)
{
  die( FormatErrors( sqlsrv_errors() ) );
}

 $afbeeldingen = '';
 $afbeeldingen .= "<div class='row'>";
 $afbeeldingen .= "<div class='col-md-2'>";
 $afbeeldingen .= itemToCard($row);
 $afbeeldingen .=  "</div>";
  for($i = 0; $i<5; $i++ )
   {
      $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
      $afbeeldingen .= "<div class='col-md-2'>";
      $afbeeldingen .= itemToCard($row);
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
