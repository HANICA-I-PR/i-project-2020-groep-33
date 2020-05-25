<?php
include('includes/connect.php');
include('includes/passwordResetValidation.php');
$titel = 'nieuw wachtwoord';
include('includes/header.php');
?>
  <body>
    <div class="container">
      <h1 class="text-center text-uppercase"> Wachtwoord opnieuw instellen </h1>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Wachtwoord instellen</h2>
                  <p>Om uw wachtwoord opnieuw in te stellen dient u hieronder uw e-mailadres, uw validatiecode OF uw antwoord op uw beveiligingsvraag, en uw nieuwe wachtwoord in te vullen. Deze validatiecode kunt u vinden in uw mailbox. Heeft u geen validatiecode ontvangen? Ga dan terug naar de 'wachtwoord vergeten' pagina.</p>
                  <div class="panel-body">
                    <form role="form" action="wachtwoordReset.php?validationCode=<?php echo(htmlspecialchars($validationCode, ENT_QUOTES))?>" method="post">
                      <div class="form-group">
                          <label for="Emailadres" class="col-sm-3 control-label">Emailadres</label>
                              <input type="email" maxlength="50" name="mailBox" id="Emailadres" placeholder="Emailadres" value="<?php echo(htmlspecialchars($mailBox, ENT_QUOTES)) ?>" class="form-control" disabled>
                              <span class="error"> <?php echo($mailBoxErrorMessage) ?> </span>
                      </div>
                      <div class="form-group">
                          <label for="Validatiecode" class="col-sm-3 control-label">Validatiecode</label>
                              <input type="text" maxlength="6" name="validationCode" id="validationCode" placeholder="Validatiecode" value="<?php echo(htmlspecialchars($validationCode, ENT_QUOTES)) ?>" class="form-control">
                              <span class="error"> <?php echo($validationCodeErrorMessage) ?> </span>
                      </div>
                      <div class="form-group">
                          <label for="Antwoordtekst" class="col-sm-3 control-label">Antwoord Beveiligingsvraag</label>
                              <input type="text" maxlength="30" name="answer" id="Antwoordtekst" placeholder="Antwoordtekst" value="<?php echo(htmlspecialchars($answer, ENT_QUOTES)) ?>" class="form-control">
                              <span class="error"> <?php echo($answerErrorMessage) ?> </span>
                      </div>
                      <div class="form-group">
                          <label for="Wachtwoord" class="col-sm-3 control-label">Wachtwoord</label>
                              <input type="password" maxlength="30" name="password" id="Wachtwoord" placeholder="Wachtwoord" class="form-control">
                              <span class="error"> <?php echo($passwordErrorMessage) ?> </span>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block" name="validationButton">Wachtwoord </button>
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
