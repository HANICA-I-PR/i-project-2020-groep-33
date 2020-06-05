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
			//$subsubrow = sqlsrv_fetch_array( $subsubquery, SQLSRV_FETCH_ASSOC)
			$message .= $rubriekNaam.' Has subqueries<br>';
		}else{
			//$message .= $rubriekNaam.'<br>';
			$message .= '<a href="productlist.php?rubriek='.$rubriekNummer.'">'.$rubriekNaam.'</a> <br>';
		}

		return $message;
	}
?>
