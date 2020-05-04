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
<br> <br>
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-4 text-left">
      <h1> Inloggen </h1>
      <br>
      <h4> Bestaande klanten </h4>
      <form>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Inloggen</button>
      </form>
    </div>
    <div class="col-sm-4 text-left">
      <h1>Nieuw bij EenmaalAndermaal?</h1>
      <br>
      <h4>Maak binnen 2 minuten een account aan.</h4>
      <a class="btn btn-primary" href="register.php" role="button">Maak een account aan</a>
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
