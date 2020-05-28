<?php
include('includes/categories.php');
include('includes/itemToCard.php');
$titel = 'Producten lijst';
include('includes/header.php');
?>
<body>
  <div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">Producten
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
    $tsql = "SELECT tbl_Voorwerp.verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
              FROM tbl_Voorwerp
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

<?php


 echo $categorieen;
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



<!-- /.container -->
</body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
