<?php
include('includes/connect.php');
$titel = 'Verwijder account';
include('includes/header.php');
include('includes/deleteAccount.php');
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
                  <p>Conform de algemene verordening gegevensbescherming (AVG) moeten wij onze gebruikers de mogelijkheid geven om hun persoonsgegevens die bij ons bekend zijn uit onze database te laten verwijderen. Hierbij worden uw account, wachtwoord en beveilingsopties uit ons systeem gehaald. Daarnaast zullen de volgende persoonsgegevens verwijderd worden:
                  <ul>
                    <li>Uw voor- en achternaam</li>
                    <li>Uw adres, postcode, plaatsnaam en land</li>
                    <li>Uw geboortedatum</li>
                    <li>Uw e-mailadres</li>
                    <li>Uw telefoonnummers</li>
                    <li>Uw bank- en creditcardgegevens</li>
                  </ul>
                  <br>Het verwijderen van een account is onder de volgende situaties NIET mogelijk:
                  <ul>
                    <li>U hebt als koper op dit moment het hoogste bod op een voorwerp</li>
                    <li>U hebt als verkoper nog een veiling openstaan</li>
                  </ul>
                  </p>
                  <div class="panel-body">
                    <form role="form" action="verwijderAccount.php" class="form" method="post">
                      <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-danger btn-block" name="deleteButton">Uw account DEFINITIEF verwijderen</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php echo $openBidErrorMessage ?>
            <?php echo $openSaleErrorMessage ?>
          </div>
	</div>
</div>
  </body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
