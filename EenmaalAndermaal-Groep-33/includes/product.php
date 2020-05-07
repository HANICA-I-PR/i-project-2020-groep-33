<?php
if ( $conn) {

  $sql = "SELECT * FROM tbl_Voorwerp, tbl_Bestand WHERE voorwerpnummer = voorwerp";
  $query = sqlsrv_query($conn, $sql, NULL);

  if ( $query === false){
    die( FormatErrors( sqlsrv_errors()));
  }

  $afbeeldingen = '';
  $afbeeldingen .= "<div class='row'>";

  for($i = 0; $i<6; $i++ ) {
    $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC);
    $afbeeldingen .= "<div class='col-sm-2' >";
    $afbeeldingen .= "<class='img-responsive'>";
    $afbeeldingen .= "<a href='#'><img class = 'img-responsive'src= ".$row['filenaam']." style='width:100px'' alt='Image'></a>";
    $afbeeldingen .=  "<h4 class='card-title'><a href='#'>".$row['titel']."</a></h4>";
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
