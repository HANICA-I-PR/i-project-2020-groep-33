<?php
include('includes/connect.php');
include('includes/accountInformation.php');
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
<br>
  <?php echo($alteredAccountInformationNotification) ?>
  <div class="container-fluid text-left">
    <div class="row content">
      <div class="col-sm-2">
      </div>

      <div class="col-sm-2">
        <h1> Account informatie </h1>
        <h2> <?php echo $_SESSION['userName'] ?> </h2>
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

            <!-- PLACEHOLDER VOOR BESTAANDE TELEFOONNUMMERS -->

            <div class="form-group">
                <label for="Telefoonnummer" class="control-label">Nieuw Telefoonnummer</label>
                <input type="text" maxlength="15"name="telephoneNumber" id="Telefoonnummer" placeholder="Telefoonnummer" class="form-control">
                <?php echo($nameErrorMessage) ?>
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="accountInformationButton">Wijzig account informatie</button>
            </div>
        </form> <!-- /form -->
      </div>

      <div class="col-sm-3">
        <h1> Uw biedingen </h1>
        <?php echo $test ?>
      </div>


      <div class="col-sm-3">
        <h1> Uw veilingen </h1>
        <?php echo $auctionInformation ?>
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
