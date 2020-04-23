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

<div class="container">
            <form class="form-horizontal" role="form">
                <h2>Registratie formulier</h2>
                <div class="form-group">
                    <label for="Gebruikersnaam" class="col-sm-3 control-label">Gebruikersnaam</label>
                    <div class="col-sm-9">
                        <input type="text" id="Gebruikersnaam" placeholder="Gebruikersnaam" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Voornaam" class="col-sm-3 control-label">Voornaam</label>
                    <div class="col-sm-9">
                        <input type="text" id="Voornaam" placeholder="Voornaam" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Achternaam" class="col-sm-3 control-label">Achternaam</label>
                    <div class="col-sm-9">
                        <input type="text" id="Achternaam" placeholder="Achternaam" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Adresregel1" class="col-sm-3 control-label">Adresregel1</label>
                    <div class="col-sm-9">
                        <input type="text" id="Adresregel1" placeholder="Adresregel" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Adresregel2" class="col-sm-3 control-label">Adresregel2 (optioneel)</label>
                    <div class="col-sm-9">
                        <input type="text" id="Adresregel2" placeholder="Adresregel" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Postcode" class="col-sm-3 control-label">Postcode</label>
                    <div class="col-sm-9">
                        <input type="text" id="Postcode" placeholder="Postcode" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="plaatsnaam" class="col-sm-3 control-label">Plaatsnaam</label>
                    <div class="col-sm-9">
                        <input type="text" id="Plaatsnaam" placeholder="Plaatsnaam" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Geboortedatum" class="col-sm-3 control-label">Geboortedatum</label>
                    <div class="col-sm-9">
                        <input type="date" id="Geboortedatum" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label">Land</label>
                    <div class="col-sm-9">
                        <select id="country" class="form-control">
                            <option>Netherlands</option>
                            <option>Belgium</option>
                            <option>Denmark</option>
                            <option>Spain</option>
                            <option>Deutschland</option>
                            <option>Italy</option>
                            <option>Sweden</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <label for="Emailadres" class="col-sm-3 control-label">Emailadres</label>
                    <div class="col-sm-9">
                        <input type="text" id="Emailadres" placeholder="Emailadres" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Wachtwoord" class="col-sm-3 control-label">Wachtwoord</label>
                    <div class="col-sm-9">
                        <input type="password" id="Wachtwoord" placeholder="Wachtwoord" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Beveiligingsvraag" class="col-sm-3 control-label">Beveiligingsvraag</label>
                    <div class="col-sm-9">
                        <select id="Beveiligingsvraag" class="form-control">
                            <option>Wat is de naam van je eerste huisdier?</option>
                            <option>Waar ben je geboren?</option>
                            <option>Wie is je beste vriend/vriendin?</option>
                            <option>Wat is je favoriete eten?</option>
                            <option>Wat is je favoriete film?</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <label for="Antwoordtekst" class="col-sm-3 control-label">Antwoord Beveiligingsvraag</label>
                    <div class="col-sm-9">
                        <input type="text" id="Antwoordtekst" placeholder="Antwoordtekst" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form> <!-- /form -->
        </div> <!-- ./container -->


<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
