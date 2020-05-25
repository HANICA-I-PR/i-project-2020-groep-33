<?php
include('includes/connect.php');
include('includes/emailvalidation.php');
$titel = 'nieuw wachtwoord';
include('includes/header.php');
?>
  <body>
    <div class="container">
      <h1 class="text-center text-uppercase"> Wachtwoord vergeten? </h1>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Wachtwoord vergeten</h2>
                  <p>Weet u uw wachtwoord niet meer? Vul hieronder je e-mailadres in. We sturen dan binnen enkele minuten een e-mail waarmee een nieuw wachtwoord kan worden aangemaakt.</p>
                  <div class="panel-body">
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                      <div class="form-group">
                        <label for="Emailadres" class="control-label">Emailadres</label>
                        <?php echo($mailBoxErrorMessage) ?>
                        <input type="email" maxlength="50" name="mailBox" id="mailBox" placeholder="Emailadres" value="<?php echo(htmlspecialchars($mailBox, ENT_QUOTES)) ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block" name="recoveryButton">Verzenden</button>
                      </div>
                      <input type="hidden" class="hide" name="token" id="token" value="">
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
