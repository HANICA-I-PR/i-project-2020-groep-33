<!DOCTYPE php>
<?php
Session_start();
include('includes/connect.php');
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
	<?php
	$sql = "SELECT * FROM tbl_Voorwerp, tbl_Bestand WHERE voorwerpnummer = ".$_GET['product'];
	  $query = sqlsrv_query($conn, $sql, NULL);

	  if ( $query === false){
	    die( FormatErrors( sqlsrv_errors()));
	  }

	  $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)
	?>

  <div class="container">
  <div class="row">
    <?php echo "<h1> ".$row['titel']." </h1>" ?>
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
			<p>Hoogste Bod:</p><br>
    		<?php echo "<p> ".$row['startprijs']." </p>" ?>
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
	  <p>Omschrijving: </p><br>
    <?php echo "<p> ".$row['beschrijving']." </p>" ?>
  </div>
  </div>
  <div class="container text-center">
    <h1> Vergelijkbare producten </h1> <br>
<?php include 'includes/vergelijkbaarproduct.php' ?>
   </div>
  </body>
<footer class='container-fluid text-center'>
  <?php include 'includes/footer.php' ?>
</footer>
</html>
