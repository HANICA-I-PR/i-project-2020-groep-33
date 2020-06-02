
<?php include('connect.php');

/* Onderstaande query selecteert rubrieknummer en naam van de main categorieen en sorteert eerst
	 op volgnr daarna op rubrieknaam */
  $tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek IS NULL ORDER BY volgnr ASC, rubrieknaam ASC";
	$query = sqlsrv_query($conn, $tsql, NULL);
	if ( $query === false)
  	{
	  die( FormatErrors( sqlsrv_errors() ) );
  	} else {
   	$categorieen = '';
   	$categorieen .= '<section class="py-5 bg-white">';
   	$categorieen .=  '<div class="container">';
   	$categorieen .= '<h2 class="font-weight-light text-center">Rubrieken</h2><br>';
   	$categorieen .= '<div class="row" style="text-align:center">';
	   /* hieronder in while loop wordt de select van $tsql query gefetcht*/
   while ($row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)) {
	   /* hieronder worden de rubrieknamen en nummers van de subrubrieken geselecteerd en sorteert eerst
		 op volgnr daarna op rubrieknaam*/
   $tsql1 = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek = ? ORDER BY volgnr ASC, rubrieknaam ASC";
   $params = array($row['rubrieknummer']);
   $query1 = sqlsrv_query($conn, $tsql1, $params);

   $categorieen .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">';
   $categorieen .= '<ul style="list-style:none">';
	$categorieen .= '<h4><b>'.$row['rubrieknaam'].'</b></h4>';
	while($row1 = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC))  {
        $categorieen .='<li><a href="productlist.php?rubriek='.$row1['rubrieknummer'].'">'.$row1['rubrieknaam'].'</a></li>';
		}
        $categorieen .='  </ul>';
        $categorieen .=' </div>';

		}
	    $categorieen .='</div>';
	    $categorieen .='</div>';
	    $categorieen .='</section>';
	}

?>





			<?php
			// include('connect.php');
			// 	if ($conn) {
			//
			// 		/* Onderstaande query selecteert rubrieknummer en naam van de main categorieen en sorteert eerst
			// 		op volgnr daarna op rubrieknaam */
			// 		$bottom_tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek IS NULL ORDER BY volgnr ASC, rubrieknaam ASC";
			// 		$bottom_query = sqlsrv_query($conn, $bottom_tsql, NULL);
			// 		if ( $bottom_query === false) {
			// 			die( FormatErrors( sqlsrv_errors() ) );
			// 		} else {
			// 			$categorieen = '';
			// 	}
			// } else {
			// 		echo "Connection could not be established.<br />";
			// 		die( print_r( sqlsrv_errors(), true));
			// 	}

			?>
