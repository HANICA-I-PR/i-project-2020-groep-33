<?php

$bankErrorMessage = "";
$creditcardErrorMessage = "";
$bank_creditcard_ErrorMessage = "";

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
}


 ?>
