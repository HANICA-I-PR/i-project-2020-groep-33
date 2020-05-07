<?php Session_start(); ?>
<?php include('includes/connect.php') ?>
<?php include('includes/accountInformation.php') ?>

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
  <div class="container-fluid text-left">
    <div class="row content">
      <div class="col-sm-2">
      </div>

      <div class="col-sm-2">
        <h1> Account informatie </h1>
        <h2> <?php echo $_SESSION['userName'] ?> </h2>
        <p> <?php echo $informationHTML ?> </p>
        <a href="#" class="btn btn-primary">Wijzig account informatie</a>
      </div>

      <div class="col-sm-3">
        <h1> Uw biedingen </h1>
        <?php echo $test ?>
      </div>


      <div class="col-sm-3">
        <h1> Uw veilingen </h1>
        <?php echo $auctionInformation ?>
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
