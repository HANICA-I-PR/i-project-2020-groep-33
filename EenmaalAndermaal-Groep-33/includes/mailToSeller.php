<?php
	$message = '';
	$product = 0;
	$mail = 0;

// bericht en product id ophalen uit form
	if(isset($_POST['message']) && isset($_POST['product'])){
		$message = $_POST['message'];
		$product = $_POST['product'];

		$sql = "SELECT titel, email
				FROM tbl_Voorwerp V INNER JOIN tbl_Gebruiker G ON V.verkoper = G.gebruikersnaam
				WHERE voorwerpnummer = ".$product;

		$query = sqlsrv_query($conn, $sql, NULL);

// check voor errors in de query
		if ( $query === false){
			die( FormatErrors( sqlsrv_errors()));
		}

// data daadwerkelijk ophalen
		$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC);

// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($message,70);

// send email
		$mail = mail($row['email'], 'Een heeft een bericht over: '.$row['titel'], $msg);
	}
?>
