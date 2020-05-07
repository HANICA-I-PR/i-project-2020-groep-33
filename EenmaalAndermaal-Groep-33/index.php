<!DOCTYPE php>
<?php
$serverName = "mssql.iproject.icasites.nl";
$connectionInfo = array( "Database"=>"iproject33",  "UID"=>"iproject33", "PWD"=>"thsPUqnU");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>

<html lang="en">
<head>
  <title>EenmaalAndermaal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">

</head>
<header>
	<?php include 'includes/header.php' ?>
</header>
<body>
<br>
<br>
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
          <h3></h3>
          <p></p>
        </div>
      </div>

      <div class="item">
        <img src="Afbeeldingen/indexfoto2.jpg" alt="Image">
        <div class="carousel-caption">
          <h3>More Sell $</h3>
          <p>Lorem ipsum...</p>
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

	$sql = "SELECT * FROM tbl_Bestand";
  $sql1 = "SELECT * FROM tbl_Voorwerp,tbl_Bestand where tbl_Bestand.voorwerp = tbl_Voorwerp.voorwerpnummer";
  $query = sqlsrv_query($conn, $sql, NULL);
  $query1 = sqlsrv_query($conn, $sql1, NULL);

	if ( $query === false)
	{
		die( FormatErrors( sqlsrv_errors() ) );
	}

   $afbeeldingen = '';
   $afbeeldingen .= "<div class='row'>";
	  for($i = 0; $i<6; $i++ )
	   {
        $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC);
        $row = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC);
        $afbeeldingen .= "<div class='col-md-2'>";
        $afbeeldingen .= "<img src= ".$row['filenaam']." class='img-responsive' style='max-height:200px' alt='Image'>";
        $afbeeldingen .= "<p>".$row['titel']."</p>";
        $afbeeldingen .=  "</div>";
      }
   $afbeeldingen .= "</div>";
   echo $afbeeldingen;
	sqlsrv_free_stmt($query);
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
