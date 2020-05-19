<?php
include('includes/connect.php');
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
                  <p>Weet u uw wachtwoord niet meer? Vul hieronder uw e-mailadres in. We sturen dan binnen enkele minuten een e-mail waarmee een nieuw wachtwoord kan worden ingesteld.</p>
                  <div class="panel-body">
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                      <div class="form-group">
                          <input type="text" name="emailadres" id="email" placeholder="Uw e-mailadres" class="form-control type="email"">
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Verzenden" type="submit">
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
