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
  <div class="container">
  <div class="row">
    <h1> Product </h1>
    <div class="col-sm-8" >
      <div id="myCarousel" class="carousel slide" data-ride="carousel" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
          <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
            <div class="carousel-caption">
              <h3>SELL $</h3>
              <p>Money Money.</p>
            </div>
          </div>

          <div class="item">
            <img src="https://placehold.it/800x400?text=Another Image Maybe" alt="Image">
            <div class="carousel-caption">
              <h3>More Sell $</h3>
              <p>Lorem ipsum...</p>
            </div>
          </div>
          <div class="item">
            <img src="https://placehold.it/800x400?text=Another Image Maybe" alt="Image">
            <div class="carousel-caption">
              <h3>More Sell $</h3>
              <p>Lorem ipsum...</p>
            </div>
          </div>
          <div class="item">
            <img src="https://placehold.it/800x400?text=Another Image Maybe" alt="Image">
            <div class="carousel-caption">
              <h3>More Sell $</h3>
              <p>Lorem ipsum...</p>
            </div>
          </div>
          <div class="item">
            <img src="https://placehold.it/800x400?text=Another Image Maybe" alt="Image">
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
    </div>
    <div class="col-sm-4">
      <div class="well">
         <p>Hoogste bod..</p>
      </div>
      <div class="well">
         <p>Plaats bod</p>
      </div>
      <div class="well">
         <p>aflopende tijd</p>
      </div>
    </div>
  </div>
    <br>
  <div class="well">
    <p>Beschrijving product</p>
  </div>
  </div>
  <div class="container text-center">
    <h1> Vergelijkbare producten </h1> <br>
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
   </div>
  </body>
<footer class='container-fluid text-center'>
  <?php include 'includes/footer.php' ?>
</footer>
</html>
