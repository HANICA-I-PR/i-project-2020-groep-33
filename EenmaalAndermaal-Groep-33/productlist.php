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
  <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css" href="CSS/bootstrap.css">

</head>
<header>
	<?php include 'includes/header.php' ?>
</header>
<body>
  <div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">pagina Heading
    <small>Secondary Text</small>
  </h1>

<?php
if ( $conn) {

  $sql = "SELECT * FROM tbl_Voorwerp, tbl_Bestand WHERE voorwerpnummer = voorwerp";
  $query = sqlsrv_query($conn, $sql, NULL);

  if ( $query === false){
    die( FormatErrors( sqlsrv_errors()));
  }

  $afbeeldingen = '';
  $afbeeldingen .= "<div class='row'>";
  while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)){
    $afbeeldingen .= "<div class='col-sm-4'>";
    $afbeeldingen .= "<div class='card'>";
    $afbeeldingen .= "<a href='#'><img class = 'card-img-top'src= ".$row['filenaam']." class='img-responsive card-img-top' style='height:200px' alt='Image'></a>";
    $afbeeldingen .=  "<div class='card-body'>";
    $afbeeldingen .=  "<h4 class='card-title'><a href='#'>".$row['titel']."</a></h4>";
    $afbeeldingen .=  "</div>";
    $afbeeldingen .=  "</div>";
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

  <!-- <div class="row">
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
  </div> -->
  <!-- /.row -->

  <!-- Pagination -->
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
    </li>
  </ul>

</div>
<!-- /.container -->
</body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
