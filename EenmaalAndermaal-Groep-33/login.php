<?php
include('includes/connect.php');
include('includes/phplogin.php');
include('includes/emailvalidation.php');
?>

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

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-4 text-left">
      <h1>Nieuw bij EenmaalAndermaal?</h1>
      <br>
      <h4> Om mee te kunnen bieden of om zelf producten te kunnen verkopen heeft u een account nodig.
      <br> Maak nu binnen 2 minuten een account aan!</h4>
      <form role="form" action="login.php" method="post">
        <div class="form-group">
          <label for="Emailadres" class="control-label">Emailadres</label>
          <?php echo($mailBoxErrorMessage) ?>
          <input type="email" maxlength="50" name="mailBox" id="mailBox" placeholder="Emailadres" value="<?php echo(htmlspecialchars($mailBox, ENT_QUOTES)) ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="validationButton">Maak een account aan</button>
      </form>
      <?php
      if(isset($_SESSION['mailBox']))
      {
        echo "<div class='alert alert-info' role='alert'>";
        echo ("Er is een mail met een verificatielink gestuurd naar ".$_SESSION['mailBox'].". Wanneer u deze link volgt kunt u zich registreren. Als u de mail niet gekregen heeft, kijk dan in uw spam-folder of klik opnieuw op de bovenstaande knop om een nieuwe verificatielink te sturen.");
        echo '</div>';
      }
      ?>
    </div>
      <!-- <a class="btn btn-primary" href="register.php" role="button">Maak een account aan</a> -->
    <div class="col-sm-4 text-left">
      <h1> Inloggen </h1>
      <br>
      <h4> Bestaande klanten </h4>
      <?php echo($loginErrorMessage) ?>
      <form role="form" action="login.php" method="post">
        <div class="form-group">
          <label for="Gebruikersnaam">Gebruikersnaam</label>
          <?php echo($userNameErrorMessage) ?>
          <input type="text" maxlength="15" name="userName" id="Gebruikersnaam" placeholder="Gebruikersnaam" class="form-control">
        </div>
        <div class="form-group">
          <label for="Wachtwoord">Wachtwoord</label>
          <?php echo($passwordErrorMessage) ?>
          <input type="password" maxlength="30" name="password" id="Wachtwoord" placeholder="Wachtwoord" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="loginButton">Inloggen</button>
      </form>
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
