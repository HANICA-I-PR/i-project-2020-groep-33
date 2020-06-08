<!DOCTYPE php>

<?php
	include('connect.php');

	//initialisatie variabelen
	$errors = 0;
	$voorwerp = 0;
	$nieuwBod = 0;
	$startPrice = 0;
	$gebruiker = '';
	$biedErrorMessage = '';




	if (isset($_POST["BiedButton"])){

		//Waardetoekenning variabelen
		$voorwerp = $_POST["product"];
		$nieuwBod = $_POST["nieuwBod"];
		$gebruiker = $_SESSION["userName"];


		if(empty($nieuwBod)){
			$errors++;
			$biedErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Er is geen bod ingevuld.</div>";
		}else{
			$hoogsteBod = "SELECT max(bodbedrag) FROM tbl_Bod WHERE voorwerp = ".$voorwerp;
		    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		    $result = sqlsrv_query($conn, $hoogsteBod, NULL, $options);

		    if(!$result)
		    {
				die(print_r( sqlsrv_errors(), true));
		    }

			$hoogstBodRow = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

			//Fetch startprijs
			$tsql = "SELECT startprijs
							 FROM tbl_Voorwerp
							 WHERE voorwerpnummer = ?";
			$params = array($voorwerp);
			$result = sqlsrv_query($conn, $tsql, $params);
			$startPrice = sqlsrv_fetch_array($result);

			$verhoogBedrag = 0;
			//Zet verhoogbedrag afhankelijk van hoogste bod
			if($hoogstBodRow[''] < 50 && $hoogstBodRow[''] >= 1){
				$verhoogBedrag = 0.5;
			} else if($hoogstBodRow[''] < 500  && $hoogstBodRow[''] >= 50){
				$verhoogBedrag = 1;
			} else if($hoogstBodRow[''] < 1000  && $hoogstBodRow[''] >= 500){
				$verhoogBedrag = 5;
			} else if($hoogstBodRow[''] < 5000  && $hoogstBodRow[''] >= 1000){
				$verhoogBedrag = 10;
			} else if($hoogstBodRow[''] >= 5000){
				$verhoogBedrag = 50;
			}
			//Zet verhoogbedrag afhankelijk van startprijs
			if($startPrice['startprijs'] <= 50 && $startPrice['startprijs'] >= 0){
				$verhoogBedrag = max($verhoogBedrag, 0.5);
			} else if($startPrice['startprijs'] <= 500  && $startPrice['startprijs'] > 50){
				$verhoogBedrag = max($verhoogBedrag, 1);
			} else if($startPrice['startprijs'] <= 1000  && $startPrice['startprijs'] > 500){
				$verhoogBedrag = max($verhoogBedrag, 5);
			} else if($startPrice['startprijs'] <= 5000  && $startPrice['startprijs'] > 1000){
				$verhoogBedrag = max($verhoogBedrag, 10);
			} else if($startPrice['startprijs'] > 5000){
				$verhoogBedrag = max($verhoogBedrag, 50);
			}



				//Minimum bod is gelijk aan de hoogste van hoogstebod of startprijs
				$laagstMinimaalBod = max($hoogstBodRow[''] , $startPrice['startprijs']) + $verhoogBedrag;

			if($nieuwBod < $laagstMinimaalBod){
				$errors++;
				$biedErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Bod moet minimaal boven de &euro;".$laagstMinimaalBod." zijn.</div>";
			}
		}

		if($errors == 0){
			//Database input
			$tsql="INSERT INTO tbl_Bod VALUES(?,?,?, GETDATE(), CONVERT(TIME(0),GETDATE()))";
			$params= array($voorwerp, $nieuwBod, $gebruiker);
			$result= sqlsrv_query($conn, $tsql, $params);


			if($result===false)
			{
				die(print_r( sqlsrv_errors(), true));
			}
		}


	}
?>
