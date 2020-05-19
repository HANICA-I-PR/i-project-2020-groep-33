<!DOCTYPE php>

<?php
	include('connect.php');

	//initialisatie variabelen
	$voorwerp = 0;
	$bod = 0;

	//Waardetoekenning variabelen
	$voorwerp = $_POST["product"];
	$bod = $_POST["bod"];


	$tsql = "DELETE FROM tbl_Bod WHERE bodbedrag = ".$bod." AND voorwerp = ".$voorwerp;
	$stmt = sqlsrv_prepare( $conn, $tsql);

	if( !$stmt ) {
	    die( print_r( sqlsrv_errors(), true));
	}

	if( sqlsrv_execute( $stmt ) === false ) {
          die( print_r( sqlsrv_errors(), true));
    }

	Header('location: ../product.php?product='.$voorwerp);
?>
