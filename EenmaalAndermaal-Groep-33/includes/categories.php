
<?php
	include('connect.php');
	include('subRubriek.php');

	$rootRubriek = -1;

	$tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek = ? ORDER BY volgnr ASC, rubrieknaam ASC";
	$Params = array($rootRubriek);
	$query = sqlsrv_query($conn, $tsql, $Params);

	if ( $query === false){
		die( FormatErrors( sqlsrv_errors()));
	}else{

		$categorieen = '';
		$categorieen .= '<div class="container">';
		$categorieen .= '<div class="row">';

		while ($row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)) {

			$categorieen .= '<div class="col-sm-4">';
			$categorieen .= 	'<div class="card">';

			$categorieen .= 		'<div class="card-header" id="headingOne">';
			$categorieen .= 			'<h5 class="mb-0">';
			$categorieen .= 				'<button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse'.$row['rubrieknummer'].'" aria-expanded="false" aria-controls="collapseOne">';
			$categorieen .= 					$row['rubrieknaam'];
			$categorieen .= 				'</button>';
			$categorieen .= 			'</h5>';
			$categorieen .= 		'</div>';

			$categorieen .= 		'<div id="collapse'.$row['rubrieknummer'].'" class="collapse" aria-labelledby="headingOne">';
			$categorieen .= 			'<div class="card-body">';


			$subtsql = "SELECT rubrieknaam, rubrieknummer, rubriek FROM tbl_Rubriek WHERE rubriek = ? ORDER BY volgnr ASC, rubrieknaam ASC";
			$subparams = array($row['rubrieknummer']);
			$subquery = sqlsrv_query($conn, $subtsql, $subparams);

			if ( $subquery === false){
				die( FormatErrors( sqlsrv_errors()));
			}

			while($subrow = sqlsrv_fetch_array( $subquery, SQLSRV_FETCH_ASSOC))  {
				$categorieen .= subRubriek($subrow['rubrieknummer'], $subrow['rubrieknaam'], $conn);
			}

			$categorieen .= 			'</div>';
			$categorieen .= 		'</div>';

			$categorieen .= 	'</div>';
			$categorieen .= '</div>';
		}
		$categorieen .= '</div>';
		$categorieen .= '</div>';
	}

	// start call functie met invoer rubrieknummer van rootParams
	// in functie een whileloop waarin alle subrubrieken van de gegeven rubriek worden opgehaald
	// voor elke subrubriek van de gegeven rubriek word gekeken of die rubriek subrubrieken heeft
	// als dat zo is word diezelfde functie uitgevoerd met als invoer die rubriek
?>
