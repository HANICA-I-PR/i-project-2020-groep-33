<?php
include('includes/connect.php');
include('includes/registerform.php');
$titel = 'Registerform';
include('includes/header.php');
if(!isset($_SESSION['validationCode']))
{
  header("Location:login.php");
}

?>
<body>
<div class="container">
            <form class="form-horizontal" role="form" action="register.php?validationCode=<?php echo(htmlspecialchars($validationCode, ENT_QUOTES)) ?>" method="post">
              <div class="col-sm-12 text-center">
                <h2>Registratie formulier</h2>
                <h4>Vul in, registreer, log in en bied mee!</h4>
              </div>
                <div class="form-group">
                    <label for="Emailadres" class="col-sm-3 control-label">Emailadres</label>
                    <div class="col-sm-6">
                        <input type="email" maxlength="50" name="mailBox" id="Emailadres" placeholder="Emailadres" value="<?php echo(htmlspecialchars($mailBox, ENT_QUOTES)) ?>" class="form-control" disabled>
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($mailBoxErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Validatiecode" class="col-sm-3 control-label">Validatiecode</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="6" name="validationCode" id="validationCode" placeholder="Validatiecode" value="<?php echo(htmlspecialchars($validationCode, ENT_QUOTES)) ?>" class="form-control" disabled>
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($validationCodeErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Gebruikersnaam" class="col-sm-3 control-label">Gebruikersnaam</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="15" name="userName" id="Gebruikersnaam" placeholder="Gebruikersnaam" value="<?php echo(htmlspecialchars($userName, ENT_QUOTES)) ?>" class="form-control">
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
                    <span class="col-sm-3"><?php echo($nameErrorMessage) ?></span>
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
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($placeNameErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Land" class="col-sm-3 control-label">Land</label>
                    <div class="col-sm-6">
                        <select id="country" name="country" class="form-control">
                            <option value="Nederland">Nederland</option>
                            <option value="België">België</option>
                            <option value="Denemarken">Denemarken</option>
                            <option value="Duitsland">Duitsland</option>
                            <option value="Italië">Italië</option>
                            <option value="Spanje">Spanje</option>
                            <option value="Zweden">Zweden</option>
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
                    <label for="Wachtwoord" class="col-sm-3 control-label">Wachtwoord</label>
                    <div class="col-sm-6">
                        <input type="password" maxlength="30" name="password" id="Wachtwoord" placeholder="Wachtwoord" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <span class="error"> <?php echo($passwordErrorMessage) ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Beveiligingsvraag" class="col-sm-3 control-label">Beveiligingsvraag</label>
                    <div class="col-sm-6">
                        <select id="Beveiligingsvraag" name="questionNumber" class="form-control">
                            <option value="1">Wat is de naam van uw eerste huisdier?</option>
                            <option value="2">In welke plaats was uw eerste baantje?</option>
                            <option value="3">Wat is uw favoriete film?</option>
                            <option value="4">Wat is de naam van uw basisschool?</option>
                            <option value="5">Wat is uw lievelingsgerecht?</option>
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
                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block" name="registrationButton">Registreer</button>
                    </div>
                </div>
            </form> <!-- /form -->
        </div> <!-- ./container -->
</body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
