<!DOCTYPE php>
<?php
include('includes/connect.php')
?>

<html lang="en">
  <head>
      <title>EenmaalAndermaal</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <header>
    <?php include 'includes/header.php' ?>
  </header>
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
                  <p>Weet je het wachtwoord niet meer? Vul hieronder je e-mailadres in. We sturen dan binnen enkele minuten een e-mail waarmee een nieuw wachtwoord kan worden aangemaakt.</p>
                  <div class="panel-body">
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" name="emailadres" id="email" placeholder="Uw e-mailadres" class="form-control type="email"">
                        </div>
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
