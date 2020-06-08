
<?php

// get root rubriek voor deze pagina.
	if(isset($_GET['root'])){
		$rootRubriek = $_GET['root'];
	}else{
		$rootRubriek = -1;
	}

// Selecteert de benodigde informatie van de subrubrieken uit de hoofdrubriek.
	$tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek = ? ORDER BY volgnr ASC, rubrieknaam ASC";
	$params = array($rootRubriek);
	$query = sqlsrv_query($conn, $tsql, $params);

	if ($query === false){
		die( FormatErrors( sqlsrv_errors()));
	}else{
		$categorieen = '';
		$categorieen .= '<div class="container">';
		$categorieen .= '<div class="row">';

// Bepaal titel van de rubriekpagina.
		if($rootRubriek == -1){
			$categorieen .= '<h1>'.$caption.'</h1>';
		}else{
			$titleTsql = "SELECT rubrieknaam, rubriek FROM tbl_Rubriek WHERE rubrieknummer = ?";
			$titleParams = array($rootRubriek);
			$titleQuery = sqlsrv_query($conn, $titleTsql, $titleParams);

			if ($titleQuery === false){
				die( FormatErrors( sqlsrv_errors()));
			}

			$titleRow = sqlsrv_fetch_array( $titleQuery, SQLSRV_FETCH_ASSOC);
			$rubriekName = $titleRow['rubrieknaam'].':';

			$categorieen .= '<h1>'.$rubriekName.'</h1>';

// Terug knop naar de vorige rubriek.
			$categorieen .=		'<form action="rubrieken.php" method="get">';
			$categorieen .= 		'<button class="btn btn-secondar" type="submit" name="root" value='.$titleRow['rubriek'].'>';
			$categorieen .= 			'Terug';
			$categorieen .= 		'</button>';
			$categorieen .=		'</form>';
		}


// Alle subrubrieken neerzetten met een link naar de rubriekpagina op de productlist pagina.
//gebaseerd op of ze subrubrieken hebben.
		while ($row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)) {
			$subtsql = "SELECT rubrieknaam, rubrieknummer, rubriek FROM tbl_Rubriek WHERE rubriek = ? ORDER BY volgnr ASC, rubrieknaam ASC";
			$subparams = array($row['rubrieknummer']);
			$subquery = sqlsrv_query($conn, $subtsql, $subparams);

			if ( $subquery === false){
				die( FormatErrors( sqlsrv_errors()));
			}

			$rowAmount = sqlsrv_has_rows($subquery);
			if ($rowAmount === true){

				$categorieen .= '<div class="col-sm-4">';

				$categorieen .= 	'<h5 class="mb-0">';
				$categorieen .=			'<form action='.$hoofdRubriekLink.' method="get">';
				$categorieen .= 			'<button class="btn btn-secondary btn-block" type="submit"  name="root" value='.$row['rubrieknummer'].'>';
				$categorieen .= 				$row['rubrieknaam'];
				$categorieen .= 			'</button>';
				$categorieen .=			'</form>';
				$categorieen .= 	'</h5>';

				$categorieen .= '</div>';
			}else{
				$categorieen .= '<div class="col-sm-4">';

				$categorieen .= 	'<h5 class="mb-0">';
				$categorieen .=			'<form action='.$subRubriekLink.' method="get">';
				$categorieen .= 			'<button class="btn btn-secondary btn-block" type="submit"  name="rubriek" value='.$row['rubrieknummer'].'>';
				$categorieen .= 				$row['rubrieknaam'];
				$categorieen .= 			'</button>';
				$categorieen .=			'</form>';
				$categorieen .= 	'</h5>';

				$categorieen .= '</div>';
			}
		}
		$categorieen .= '</div>';
		$categorieen .= '</div>';
	}

?>
