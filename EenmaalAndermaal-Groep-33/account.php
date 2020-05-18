<?php
include('includes/connect.php');
include('includes/accountInformation.php');
include('includes/verkoperInfo.php');
include('includes/telephoneNumbers.php');

//niet ingelogd check
if(!isset($_SESSION['userName']))
{
  header("Location:index.php");
} ?>


<!DOCTYPE php>
<html lang="en">
<head>
  <title>EenmaalAndermaal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">

</head>
<header>
	<?php include 'includes/header.php' ?>
</header>
<body>
  <?php echo($alteredAccountInformationNotification); ?>
  <div class="container-fluid text-left">
    <div class="row content">
      <div class="col-sm-2">
      </div>

      <div class="col-sm-4 col-lg-2">
        <h1> Account informatie </h1>
        <h2> <?php echo $_SESSION['userName'] ?> </h2>
        <?php echo($alteredAccountErrorMessage) ?>
        <form class="form-horizontal" role="form" action="account.php" method="post">
            <div class="form-group">
                <label for="Emailadres" class="control-label">Emailadres</label>
                <input type="email" maxlength="50" name="mailBox" id="Emailadres" placeholder="Emailadres" value="<?php echo(htmlspecialchars($accountInformation['email'], ENT_QUOTES)) ?>" class="form-control">
                <?php echo($mailBoxErrorMessage) ?>
            </div>
            <div class="form-group">
                <label for="Voornaam" class="control-label">Voornaam</label>
                <input type="text" maxlength="50"name="name" id="Voornaam" placeholder="Voornaam" value="<?php echo(htmlspecialchars($accountInformation['voornaam'], ENT_QUOTES)) ?>" class="form-control">
                <?php echo($nameErrorMessage) ?>
            </div>
            <div class="form-group">
                <label for="Achternaam" class="control-label">Achternaam</label>
                <input type="text" maxlength="58" name="surname" id="Achternaam" placeholder="Achternaam" value="<?php echo(htmlspecialchars($accountInformation['achternaam'], ENT_QUOTES)) ?>" class="form-control">
                <?php echo($surnameErrorMessage) ?>
            </div>
            <div class="form-group">
                <label for="Adresregel1" class="control-label">Adresregel1</label>
                <input type="text" maxlength="55" name="address1" id="Adresregel1" placeholder="Adresregel" value="<?php echo(htmlspecialchars($accountInformation['adresregel1'], ENT_QUOTES)) ?>" class="form-control">
                <?php echo($address1ErrorMessage) ?>
            </div>
            <div class="form-group">
                <label for="Adresregel2" class="control-label">Adresregel2 (optioneel)</label>
                <input type="text" maxlength="55" name="address2" id="Adresregel2" placeholder="Adresregel" value="<?php echo(htmlspecialchars($accountInformation['adresregel2'], ENT_QUOTES)) ?>" class="form-control">
                <?php echo($address2ErrorMessage) ?>
            </div>
            <div class="form-group">
                <label for="Postcode" class="control-label">Postcode</label>
                <input type="text" size="6" maxlength="6" name="postCode" id="Postcode" placeholder="Postcode" value="<?php echo(htmlspecialchars($accountInformation['postcode'], ENT_QUOTES)) ?>" class="form-control">
                <?php echo($postCodeErrorMessage) ?>
            </div>
            <div class="form-group">
                <label for="plaatsnaam" class="control-label">Plaatsnaam</label>
                <input type="text" maxlength="28" name="placeName" id="Plaatsnaam" placeholder="Plaatsnaam" value="<?php echo(htmlspecialchars($accountInformation['plaatsnaam'], ENT_QUOTES)) ?>" class="form-control">
                <?php echo($placeNameErrorMessage) ?>
            </div>
            <div class="form-group">
                <label for="Land" class="control-label">Land</label>
                    <select id="country" name="country" value="<?php echo(htmlspecialchars($accountInformation['land'], ENT_QUOTES)) ?>" class="form-control">
                        <option value="Nederland">Nederland</option>
                        <option value="België">België</option>
                        <option value="Denemarken">Denemarken</option>
                        <option value="Duitsland">Duitsland</option>
                        <option value="Italië">Italië</option>
                        <option value="Spanje">Spanje</option>
                        <option value="Zweden">Zweden</option>
                    </select>
            </div> <!-- /.form-group -->
            <div class="form-group">
                <label for="Geboortedatum" class="control-label">Geboortedatum</label>
                <input type="date" name="birthDate" id="Geboortedatum" value="<?php echo date_format($accountInformation['geboorteDag'], 'Y-m-d') ?>" class="form-control">
                <?php echo($birthDateErrorMessage) ?>
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="accountInformationButton">Wijzig account informatie</button>
            </div>
        </form> <!-- /form -->
        <form class="form-horizontal" role="form" action="account.php" method="post">

        <?php if(isset($telephoneNumbers)){
                for ($i = 0; $i < count($telephoneNumbers); $i++){?>
          <div class="form-group">
              <label for="Telefoonnummer" class="control-label">Telefoonnummer <?php echo $i+1 ?></label>
              <input type="text" maxlength="15" name="telephoneNumber<?php echo $i ?>" value="<?php echo sprintf('%010d', $telephoneNumbers[$i]['telefoon']); ?>" placeholder="Telefoonnummer" class="form-control">
              <?php echo($nameErrorMessage) ?>
          </div>
        <?php }} ?>


          <div class="form-group">
              <label for="Telefoonnummer" class="control-label">Nieuw Telefoonnummer</label>
              <input type="text" maxlength="15"name="telephoneNumber" id="Telefoonnummer" placeholder="Telefoonnummer" class="form-control">
              <?php echo($nameErrorMessage) ?>
          </div>
          <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" name="phoneNumberButton">Wijzig telefoonnummers</button>
          </div>

      </div>

      <div class="col-sm-4 col-lg-3">
        <h1> Uw biedingen </h1>
        <?php echo $test ?>
      </div>


      <div class="col-sm-4 col-lg-3">
        <h1> Uw veilingen </h1>
		<!-- knop die linkt naar newProduct.php page om een product toe te kunnen voegen.  -->
		<a class="btn btn-primary" Style="margin-bottom:1em" href="newProduct.php" role="button">Bied een nieuw product</a>
        <?php
              echo $auctionInformation;

		// form om een niet verkoper zich als verkoper aan te melden.
	 	if($accountInformation['verkoper'] == 0) {        ?>
			<div class="text-left">
		      <form role="form" action="account.php" method="post">
		        <div class="form-group">
		          <label for="Bank">Bank</label>
		          <input type="text" maxlength="35" name="bank" id="bank" placeholder="banknaam" value="<?php echo(htmlspecialchars($bankNaam, ENT_QUOTES)) ?>" class="form-control" >
				   <?php echo $bankErrorMessage; ?>
		        </div>
		        <div class="form-group">
		          <label for="bankrekening">Bankrekeningnummer</label>
		          <input type="text" maxlength="34" name="bankrekening" id="bankrekening" placeholder="bankrekeningnummer" value="<?php echo(htmlspecialchars($bankRekeningnr, ENT_QUOTES)) ?>" class="form-control">
		        </div>
				<div class="form-group">
	                <label for="controle optie" class="control-label">Controle optie</label>
	                    <select id="controle optie" name="controle_optie" class="form-control">
	                        <option>Post</option>
	                        <option>Creditcard</option>
	                    </select>
						<?php echo $creditcardErrorMessage;  ?>
	            </div>
				<div class="form-group">
		          <label for="Creditcardnummer">Creditcardnummer</label>
		          <input type="text" maxlength="16" name="Creditcardnummer" id="Creditcardnummer" placeholder="Creditcardnummer" value="<?php echo(htmlspecialchars($creditCardnr, ENT_QUOTES)) ?>" class="form-control">
				</div>
		        <button type="submit" class="btn btn-primary" name="verkoper_button">Aanmelden</button>
				<?php echo $bank_creditcard_ErrorMessage; ?>
		      </form>
		    </div>


		<?php 	}  ?>




      </div>

      <div class="col-sm-2">
      </div>
    </div>
  </div>

</body>

<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
