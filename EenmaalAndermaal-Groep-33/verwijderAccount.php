<?php
include('includes/connect.php');
$titel = 'Verwijder account';
include('includes/header.php');
?>
  <body>
    <div class="container">
      <br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger" role="alert">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-close fa-4x"></i></h3>
                  <h2 class="text-center">Account verwijderen</h2>
                  <p>Conform de algemene verordening gegevensbescherming (AVG) moeten wij onze gebruikers de mogelijkheid geven om hun persoonsgegevens die bij ons bekend zijn uit onze database te laten verwijderen. Hierbij zullen de volgende gegevens verwijderd worden:
                  <ul>
                    <li>Uw voor- en achternaam</li>
                    <li>Uw adres, postcode en plaatsnaam</li>
                    <li>Uw geboortedatum</li>
                    <li>Uw e-mailadres</li>
                    <li>Uw telefoonnummers</li>
                  </ul>
                  Daarnaast worden uw account, wachtwoord en beveilingsopties uit ons systeem gehaald. Alle voorwerpen die u als verkoper op het moment van verwijderen aanbied worden van de site gehaald, en alle biedingen die u gedaan hebt worden ook geanuleerd.
                  </p>
                  <div class="panel-body">
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                      <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-danger btn-block" name="recoveryButton">Uw account DEFINITIEF verwijderen</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
  </body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
