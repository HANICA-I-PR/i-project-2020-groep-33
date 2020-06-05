<?php
	function subRubriek($rubriekNummer, $rubriekNaam, $conn) {
		$message = '';

		$subsubtsql = "SELECT rubrieknaam, rubrieknummer, rubriek FROM tbl_Rubriek WHERE rubriek = ? ORDER BY volgnr ASC, rubrieknaam ASC";
		$subsubparams = array($rubriekNummer);
		$subsubquery = sqlsrv_query($conn, $subsubtsql, $subsubparams);

		if ( $subsubquery === false){
			die( FormatErrors( sqlsrv_errors()));
		}

		$rowAmount = sqlsrv_has_rows($subsubquery);
		if ($rowAmount === true){

			//$message .= $rubriekNaam.' Has subqueries<br>';
			$message .= '<div class="card">';
			$message .= 	'<div class="card-header" id="heading'.$rubriekNummer.'">';
			$message .= 		'<h5 class="mb-0">';
			$message .= 			'<button class="btn btn-block" data-toggle="collapse" data-target="#collapse'.$rubriekNummer.'" aria-expanded="false" aria-controls="collapse'.$rubriekNummer.'">';
			$message .= 				$rubriekNaam;
			$message .= 			'</button>';
			$message .= 		'</h5>';
			$message .= 	'</div>';

			$message .= 	'<div id="collapse'.$rubriekNummer.'" class="collapse" aria-labelledby="heading'.$rubriekNummer.'">';
			$message .= 		'<div class="card-body">';

			while($subsubrow = sqlsrv_fetch_array( $subsubquery, SQLSRV_FETCH_ASSOC)){
				$message .= subRubriek($subsubrow['rubrieknummer'], $subsubrow['rubrieknaam'], $conn);
			}
			$message .= 		'</div>';
			$message .= 	'</div>';
			$message .= '</div>';

		}else{
			$message .= '<a href="productlist.php?rubriek='.$rubriekNummer.'">'.$rubriekNaam.'</a> <br>';
		}

		return $message;
	}
?>
