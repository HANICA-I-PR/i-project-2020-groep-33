<?php

$bankErrorMessage = "";
$creditcardErrorMessage = "";
$bank_creditcard_ErrorMessage = "";
$bankName = "";
$bankAccountnr = "";
$creditCardnr = "";


$title ="";
$description ="";
$startPrice ="";
$paymentInstruction ="";
$place = "";
$country ="";
$shippingCosts ="";
$shippingInstruction = "";

$titleErrorMessage = '';
$descriptionErrorMessage = '';
$startPriceErrorMessage = '';
$paymentMethodeErrorMessage = '' ;
$paymentInstructionErrorMessage = '' ;
$placeErrorMessage = '' ;
$countryErrorMessage = '' ;
$durationErrorMessage = '' ;
$shippingCostsErrorMessage = '';
$shippingInstructionErrorMessage = '';
$rubriekErrorMessage = '' ;
$fileErrorMessage = '' ;
$imageErrorMessage = '' ;

/*  				       					*/
if (isset($_SESSION['userName']) && $conn)
{
		 $username =	$_SESSION['userName'];
	/*   button van het formulier om een verkoper te worden.*/
	if (isset($_POST["verkoper_button"]))
    {

	    $bankName .= $_POST['bank'];
	    $bankAccountnr .= $_POST["bankrekening"];
	    $controleOption .= $_POST["controle_optie"];
   		  /* i.v.m. de check constraint in de database moet of een NULL waarde of een String die niet leeg is geinsert worden aan de database  */
		  if(empty($_POST["Creditcardnummer"])) {
            $creditCardnr = null;
		  } else {
			  $creditCardnr	.= $_POST["Creditcardnummer"];
		  }
	      $errors = 0;
	      //Empty check
	      if (empty($bankName) && !empty($bankAccountnr) || !empty($bankName) && empty($bankAccountnr) || strlen($bankName) > 35 || strlen($bankAccountnr) > 34 )
	      { $errors ++;
	        $bankErrorMessage = "<div class='alert alert-danger' role='alert'>Incorrect ingevoerde bankgegevens!</div>";
	      }
	      if ($controleOption == "Post" && !empty($creditCardnr))
	      { $errors ++;
	        $creditcardErrorMessage .= "<div class='alert alert-danger' role='alert'>Incorrecte controle optie!</div>";
	      }
	      if (empty($bankName) && empty($creditCardnr))
	      { $errors ++;
	        $bank_creditcard_ErrorMessage .= "<div class='alert alert-danger' role='alert'>Bank- of creditcardgegevens verplicht!</div>";
	      }
		  if ( $controleOption == "Creditcard" && empty($creditCardnr))
		  { $errors ++;
            $creditcardErrorMessage .= "<div class='alert alert-danger' role='alert'>Creditcardnummer verplicht!</div>";
		  }
		  if ( $controleOption != "Creditcard" && $controleOption != "Post" )
		  { $errors ++;
            $creditcardErrorMessage .= "<div class='alert alert-danger' role='alert'>Gegevens zijn incorrect!</div>";
		  }
		  if ( strlen($creditCardnr) > 16)
		  { $errors ++;
            $creditcardErrorMessage .= "<div class='alert alert-danger' role='alert'>Creditcardnummer is te lang!</div>";
		  }


		if ($errors == 0) {

			/* eerst moet de status van de gebruiker in tabel tbl_Gebruiker gewijzigd worden.  */
			$tsql1 = "UPDATE tbl_Gebruiker
	                 SET verkoper = 1  WHERE gebruikersnaam = ?";
	        $params1 = array($username);
	        $result1 = sqlsrv_query($conn, $tsql1, $params1);
			if($result1 === false)
			{
			  die(print_r( sqlsrv_errors(), true));
		  } else {
			/* ingevoerde data inserten aan de database */
			$tsql  = "INSERT INTO tbl_Verkoper VALUES(?,?,?,?,?)";
			$params = array($username, $bankName, $bankAccountnr, $controleOption, $creditCardnr);
			$result = sqlsrv_query($conn, $tsql, $params);
		}
		if($result === false)
		{
		  die(print_r( sqlsrv_errors(), true));
	  } else {
			header("Location:account.php");
		}

		}
	}
	/* Check of de button van newProduct.php gedrukt is */
 	if (isset($_POST["newProductButton"]))
	{
	    $title 				.= 	$_POST['titel'];
		$description 		.= 	$_POST['beschrijving'];
		$startPrice 		.= 	$_POST['startprijs'];
		$paymentMethode 	= 	$_POST['betalingswijze'];
		$paymentInstruction .= 	$_POST['betalingsinstructie'];
		$place 				.= $_POST['plaatsnaam'];
		$country			.= $_POST['land'];
		$duration			= $_POST['looptijd'];
		$shippingCosts		.= $_POST['verzendkosten'];
		$shippingInstruction .= $_POST['verzendinstructie'];
		$rubriek 			 = $_POST['rubriek'];
		$file 				 = $_FILES["fileToUpload"]["name"];
		$errors = 0;
		/* Checks voor de ingevulde waardes. */
		 if (empty($title) || strlen($title) > 255)  {
			 $errors++;
			$titleErrorMessage = "<div class='alert alert-danger' role='alert'>Titel is incorrect!</div>";
		 }
		else if (empty($description) || strlen($description) > 800) {
			$errors++;
			$descriptionErrorMessage = "<div class='alert alert-danger' role='alert'>Beschrijving is incorrect!</div>";
		}
		else if (empty($startPrice) || $startPrice <= 0 || $startPrice >= 9999999.99) {
			$errors++;
			$startPriceErrorMessage = "<div class='alert alert-danger' role='alert'>Startprijs is incorrect!</div>";
		}
		else if (empty($paymentMethode) || strlen($paymentMethode) > 10) {
			$errors++;
			$paymentMethodeErrorMessage = "<div class='alert alert-danger' role='alert'>Betalingswijze is ongeldig!</div>";
		}
		else if (strlen($paymentInstruction) > 50) {
			$errors++;
			$paymentInstructionErrorMessage = "<div class='alert alert-danger' role='alert'>Betalingsinstructie is incorrect!</div>";
		}
		else if (empty($place) || strlen($place) > 28) {
			$errors++;
			$placeErrorMessage = "<div class='alert alert-danger' role='alert'>plaatsnaam is incorrect!</div>";
		}
		else if (empty($country) || strlen($country) > 30) {
			$errors++;
			$countryErrorMessage = "<div class='alert alert-danger' role='alert'>land is incorrect!</div>";
		}
		else if (empty($duration) || ($duration != '7' && $duration != '5' & $duration != '3' && $duration != '1')) {
			$errors++;
			$durationErrorMessage = "<div class='alert alert-danger' role='alert'>looptijd is incorrect!</div>";
		}
		else if (empty($shippingCosts) || $shippingCosts > 999.99 || $shippingCosts < 0 ) {
			$errors++;
			$shippingCostsErrorMessage = "<div class='alert alert-danger' role='alert'>Verzendkosten is incorrect!</div>";
		}
		else if ( strlen($shippingInstruction) > 30) {
			$errors++;
			$shippingInstructionErrorMessage = "<div class='alert alert-danger' role='alert'>Verzendinstructie is incorrect!</div>";
		}
		else if (empty($rubriek)) {
			$errors++;
			$rubriekErrorMessage = "<div class='alert alert-danger' role='alert'>Rubriek is verplicht!</div>";
		}
		else if ($file > 0) {
			$errors++;
			$fileErrorMessage = "<div class='alert alert-danger' role='alert'>Foto is verplicht!</div>";
		}

    	if ( $errors == 0 ) {
		  include('uploadImageToServer.php');

		  // looptijd einde dag berekenen door looptijd op te tellen met looptijdbegindag.
		  $looptijdEindeDag = date('Y-m-d', strtotime(date("Y-m-d"). ' +'.$duration.'days'));
		   /* ingevoerde data inserten aan de database. eerst aan tabel voorwerp omdat hij de parent tabel is */
		  $tsql  = "INSERT INTO tbl_Voorwerp VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		  $params = array($title, $description, $startPrice, $paymentMethode, $paymentInstruction, $place, $country, $duration,
	  					  date("Y-m-d"), date("h:i:sa"), $shippingCosts, $shippingInstruction, $username, NULL, $looptijdEindeDag,
					 	  date("h:i:sa"), 0, NULL);
		  $result = sqlsrv_query($conn, $tsql, $params);

	  	if($result === false)
	  	{
			die(print_r( sqlsrv_errors(), true));
	} else
			//select om voorwerpnummer die net geinsert is op te halen.
		{ $tsql = "SELECT voorwerpnummer FROM tbl_Voorwerp WHERE titel = ? and verkoper = ? and looptijdBeginDag = ? and
								looptijdBeginTijdstip = ? ";
		  $params = array( $title, $username, date("Y-m-d"), date("h:i:sa"));
  		  $query = sqlsrv_query($conn, $tsql, $params);
		  $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC);

			// aan tabel bestand de link naar de afbeeldingen toevoegen
		  	$tsql = "INSERT INTO tbl_Bestand VALUES(?, ?)";
			$params = array($target_file, $row['voorwerpnummer']);
			$result = sqlsrv_query($conn, $tsql, $params);

			//rubriek toevoegen
			$tsql = "INSERT INTO tbl_Voorwerp_in_rubriek VALUES(?, ?)";
			$params = array($row['voorwerpnummer'], $rubriek);
			$result = sqlsrv_query($conn, $tsql, $params);
	  	}

}





	}
}


 ?>
