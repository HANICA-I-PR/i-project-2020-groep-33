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
<br> <br>
<div class="container">
            <form class="form-horizontal" role="form" action="includes/registerform.php" method="post">
                <h2>Registratie formulier</h2>
                <div class="form-group">
                    <label for="Gebruikersnaam" class="col-sm-3 control-label">Gebruikersnaam</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="15" name="userName" id="Gebruikersnaam" placeholder="Gebruikersnaam" value="<?php echo(htmlspecialchars($userName, ENT_QUOTES)) ?>" class="form-control" autofocus>
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($userNameErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Voornaam" class="col-sm-3 control-label">Voornaam</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="50"name="name" id="Voornaam" placeholder="Voornaam" value="<?php echo(htmlspecialchars($name, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Achternaam" class="col-sm-3 control-label">Achternaam</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="58" name="surname" id="Achternaam" placeholder="Achternaam" value="<?php echo(htmlspecialchars($surname, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($surnameErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Adresregel1" class="col-sm-3 control-label">Adresregel1</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="55" name="address1" id="Adresregel1" placeholder="Adresregel" value="<?php echo(htmlspecialchars($address1, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($address1ErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Adresregel2" class="col-sm-3 control-label">Adresregel2 (optioneel)</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="55" name="address2" id="Adresregel2" placeholder="Adresregel" value="<?php echo(htmlspecialchars($address2, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Postcode" class="col-sm-3 control-label">Postcode</label>
                    <div class="col-sm-6">
                        <input type="text" size="6" maxlength="6" name="postCode" id="Postcode" placeholder="Postcode" value="<?php echo(htmlspecialchars($postCode, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($postCodeErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="plaatsnaam" class="col-sm-3 control-label">Plaatsnaam</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="28" name="placeName" id="Plaatsnaam" placeholder="Plaatsnaam" value="<?php echo(htmlspecialchars($placeName, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Geboortedatum" class="col-sm-3 control-label">Geboortedatum</label>
                    <div class="col-sm-9">
                        <input type="date" name="birthDate" id="Geboortedatum" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Land" class="col-sm-3 control-label">Land</label>
                    <div class="col-sm-9">
                        <select id="country" name="country" class="form-control">
                            <option>Nederland</option>
                            <option>België</option>
                            <option>Denemarken</option>
                            <option>Duitsland</option>
                            <option>Italië</option>
                            <option>Spanje</option>
                            <option>Zweden</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <label for="Geboortedatum" class="col-sm-3 control-label">Geboortedatum</label>
                    <div class="col-sm-6">
                        <input type="date" name="birthDate" id="Geboortedatum" value="<?php echo(htmlspecialchars($birthDate, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($birthDateErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Emailadres" class="col-sm-3 control-label">Emailadres</label>
                    <div class="col-sm-6">
                        <input type="email" maxlength="50" name="mailBox" id="Emailadres" placeholder="Emailadres" value="<?php echo(htmlspecialchars($mailBox, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($mailBoxErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Wachtwoord" class="col-sm-3 control-label">Wachtwoord</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" id="Wachtwoord" placeholder="Wachtwoord" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Beveiligingsvraag" class="col-sm-3 control-label">Beveiligingsvraag</label>
                    <div class="col-sm-9">
                        <select id="Beveiligingsvraag" name="questionNumber" class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Antwoordtekst" class="col-sm-3 control-label">Antwoord Beveiligingsvraag</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="30" name="answer" id="Antwoordtekst" placeholder="Antwoordtekst" value="<?php echo(htmlspecialchars($answer, ENT_QUOTES)) ?>" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($answerErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form> <!-- /form -->
        </div> <!-- ./container -->
</body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
