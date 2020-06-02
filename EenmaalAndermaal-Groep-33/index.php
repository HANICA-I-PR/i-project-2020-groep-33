<?php
include('includes/connect.php');
include('includes/itemToCard.php');
$titel = 'EenmaalAndermaal';
include('includes/header.php');
?>
<body>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="Afbeeldingen/indexfoto1.jpg" alt="Image">
        <div class="carousel-caption">
          <h1>Welkom bij EenmaalAndermaal</h1>
          <p>De beste veilingsite van Nederland!</p>
        </div>
      </div>

      <div class="item">
        <img src="Afbeeldingen/indexfoto2.jpg" alt="Image">
        <div class="carousel-caption">
          <h1>Bieden op EenmaalAndermaal?</h1>
          <p> Vlot, eerlijk en onbezorgd! </p> <br>
        </div>
      </div>
    </div>


    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<div class="container text-center">
  <h3>Goede deals speciaal voor u!</h3><br>
  <?php
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
	  if (!$result)
	  {
		  die( FormatErrors( sqlsrv_errors() ) );
    }

   $afbeeldingen = '';
   $afbeeldingen .= "<div class='row'>";
   $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
   $afbeeldingen .= itemToCard($row, $conn);
   $afbeeldingen .=  "</div>";
   for($i = 0; $i<5; $i++ )
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
	sqlsrv_free_stmt($result);
  	sqlsrv_close($conn);
  } else
{
	echo "Connection could not be established.<br />";
	die( print_r( sqlsrv_errors(), true));
}
  ?>
  <br>
  <a class="btn btn-primary" href="productlist.php" role="button">Bekijk meer!</a>
  </div><br>

<!--

  <div class="row">
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Current Project</p>
    </div>
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>
    </div>
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Current Project</p>
    </div>
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>
    </div>
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>
    </div>
  </div>
  <br>
  <a class="btn btn-primary" href="#" role="button">Bekijk meer!</a>
</div><br> -->

</body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
