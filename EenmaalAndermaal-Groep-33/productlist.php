<!DOCTYPE php>
<?php
include('includes/connect.php');
include('includes/itemToCard.php');
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
	<?php
          include 'includes/header.php'
  ?>
</header>
<body>
  <div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">Producten
    <small>Secondary Text</small>
  </h1>

<?php
if ( $conn)
{
  if (isset($_POST['zoeken']))
  {
  $_term = $_POST['term'];
  $tsql =  "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, filenaam, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
              FROM tbl_Voorwerp
              INNER JOIN tbl_Bestand ON tbl_Bestand.voorwerp = tbl_Voorwerp.voorwerpnummer
              WHERE  tbl_Voorwerp.titel LIKE '$_term%' OR tbl_Voorwerp.titel LIKE '%$_term'
              OR tbl_Voorwerp.titel LIKE '%$_term%'";
  }
  else if(isset($_GET['rubriek']))
  {
    $tsql = "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, filenaam, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
              FROM tbl_Voorwerp
              INNER JOIN tbl_Bestand ON tbl_Bestand.voorwerp = tbl_Voorwerp.voorwerpnummer
              INNER JOIN tbl_Voorwerp_in_rubriek ON tbl_Voorwerp.voorwerpnummer = tbl_Voorwerp_in_rubriek.voorwerp
              WHERE rubriek_op_laagste_niveau =".$_GET['rubriek'];
  }
  else
  {
    $tsql = "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
              FROM tbl_Voorwerp";
   }

  $params = array();
  $result = sqlsrv_query($conn, $tsql, $params);
  $row = sqlsrv_fetch_array($result); // bovenste rij

  $filesql = "SELECT TOP 1 filenaam
         FROM tbl_Bestand
         WHERE voorwerp = ?";
  $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
  $file = sqlsrv_fetch_array($fileresult);
  $row = array_merge($row, $file);

  if ($result === false){
    die( FormatErrors( sqlsrv_errors()));
  }
  if(sqlsrv_has_rows($result))
  {
    $afbeeldingen = '';
    $afbeeldingen .= "<div class='row'>";

    $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
    $afbeeldingen .= itemToCard($row);
    $afbeeldingen .=  "</div>";
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC))
    {
      $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
      $file = sqlsrv_fetch_array($fileresult);
      $row = array_merge($row, $file);
      $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
      $afbeeldingen .= itemToCard($row);
      $afbeeldingen .=  "</div>";
    }
    $afbeeldingen .= "</div>";
    echo $afbeeldingen;
    sqlsrv_free_stmt($query);
    sqlsrv_close($conn);

  }
  else
  {
    echo("<div class='alert alert-danger text-center' role='alert'>Geen items gevonden in deze categorie</div>");
  }

}
else
{
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
