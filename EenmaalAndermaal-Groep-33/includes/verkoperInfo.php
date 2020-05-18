<?php

$bankErrorMessage = "";
$creditcardErrorMessage = "";
$bank_creditcard_ErrorMessage = "";
$bankNaam = "";
$bankRekeningnr = "";
$creditCardnr = "";

$newProductErrorMessage = '';

/*  				       					*/
if (isset($_SESSION['userName']) && $conn)
{
	/*   button van het formulier om een verkoper te worden.*/
	if (isset($_POST["verkoper_button"]))
    {
		  $username =	$_SESSION['userName'];
	    $bankNaam = $_POST['bank'];
	    $bankRekeningnr = $_POST["bankrekening"];
	    $controleOptie = $_POST["controle_optie"];
   		  /* i.v.m. de check constraint in de database moet of een NULL waarde of een String die niet leeg is geinsert worden aan de database  */
		  if(empty($_POST["Creditcardnummer"])) {
            $creditCardnr = null;
		  } else {
			  $creditCardnr	 	= 		$_POST["Creditcardnummer"];
		  }
	      $errors = 0;
	      //Empty check
	      if (empty($bankNaam) && !empty($bankRekeningnr) || !empty($bankNaam) && empty($bankRekeningnr))
	      { $errors ++;
	        $bankErrorMessage = "<div class='alert alert-danger' role='alert'>Incorrect ingevoerde bankgegevens!</div>";
	      }
	      if ($controleOptie == "Post" && !empty($creditCardnr))
	      { $errors ++;
	        $creditcardErrorMessage .= "<div class='alert alert-danger' role='alert'>Incorrecte controle optie!</div>";
	      }
	      if (empty($bankNaam) && empty($creditCardnr))
	      { $errors ++;
	        $bank_creditcard_ErrorMessage .= "<div class='alert alert-danger' role='alert'>Bank- of creditcardgegevens verplicht!</div>";
	      }
		  if ( $controleOptie == "Creditcard" && empty($creditCardnr))
		  { $errors ++;
            $creditcardErrorMessage .= "<div class='alert alert-danger' role='alert'>Creditcardnummer verplicht!</div>";
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
			$params = array($username, $bankNaam, $bankRekeningnr, $controleOptie, $creditCardnr);
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
	    $titel 				= 	$_POST['titel'];
		$description 		= 	$_POST['beschrijving'];
		$startPrice 		= 	$_POST['startprijs'];
		$paymentMethode 	= 	$_POST['betalingswijze'];
		$paymentInstruction = 	$_POST['betalingsinstructie'];
		$place 				= $_POST['plaatsnaam'];
		$country			= $_POST['land'];
		$duration			= $_POST['looptijd'];
		$shippingCosts		= $_POST['verzendkosten'];
		$shippingInstruction = $_POST['verzendinstructie'];
		$rubriek 			 = $_POST['rubriek'];
		$foto 				 = $_POST['file'];
		$errors = 0;
		/* Checks voor de ingevulde waardes. */
		 if (empty($titel) || strlen($titel) > 255)  {
			 $errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:2em'>Titel is incorrect!</div>";
		 }
		else if (empty($description) || strlen($description) > 800) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Beschrijving is incorrect!</div>";
		}
		else if (empty($startPrice) || $startPrice <= 0 || $startPrice >= 9999999.99) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Startprijs is incorrect!</div>";
		}
		else if (empty($paymentMethode) || strlen($paymentMethode) > 10) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Betalingswijze is ongeldig!</div>";
		}
		else if (strlen($paymentInstruction) > 50) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Betalingsinstructie is incorrect!</div>";
		}
		else if (empty($place) || strlen($place) > 28) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>plaatsnaam is incorrect!</div>";
		}
		else if (empty($country) || strlen($country) > 30) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>land is incorrect!</div>";
		}
		else if (empty($duration) || ($duration != '7' && $duration != '5' & $duration != '3' && $duration != '1')) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>looptijd is incorrect!</div>";
		}
		else if (empty($shippingCosts) || $shippingCosts > 999.99 || $shippingCosts < 0 ) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Verzendkosten is incorrect!</div>";
		}
		else if ( strlen($shippingInstruction) > 30) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Verzendinstructie is incorrect!</div>";
		}
		else if (empty($rubriek)) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Rubriek is verplicht!</div>";
		}
		else if (empty($file)) {
			$errors++;
			$newProductErrorMessage .= "<div class='alert alert-danger' role='alert' style='height:30px; text-align:CENTER; line-height:30px; padding:0px 15px; margin-bottom:1px'>Foto is verplicht!</div>";
		}






	}
}


 ?>
