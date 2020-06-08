<!DOCTYPE php>
<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<html lang="en">
<head>
  <title><?= $titel ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
</head>

<header>
<section id="header">
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"> <img src="Afbeeldingen/logo.png" alt="Logo" style="height:100%;"/></a>
	    </div>
	    <div id="myNavbar" class="collapse navbar-collapse">
	      <ul class="nav navbar-nav">
			<?php
				$calling_file = basename($_SERVER['REQUEST_URI']);
				if($calling_file == "index.php") {echo '<li class = "active"><a href="index.php">Home</a> </li>';} else{
					echo '<li><a href="index.php">Home</a> </li>';
				}
				if($calling_file == "productlist.php") {echo '<li class = "active"><a href="productlist.php">Producten</a></li>';} else{
					echo '<li><a href="productlist.php">Producten</a></li>';
				}
        if($calling_file == "rubrieken.php") {echo '<li class = "active"><a href="rubrieken.php">Rubrieken</a></li>';} else{
          echo '<li><a href="rubrieken.php">Rubrieken</a></li>';
        }
				if($calling_file == "contact.php") {echo '<li class = "active"><a href="contact.php">Contact</a></li>';} else{
					echo '<li><a href="contact.php">Contact</a></li>';
				}
			?>
	      </ul>
	      <form class="navbar-form navbar-left" action="productlist.php" method="post">
	        <div class="form-group">
	          <input type="text"  name= "term" class="form-control" placeholder="Waar ben je naar op zoek">
	        </div>
	        <button type="submit" name="zoeken" class="btn btn-default">Zoek</button>
	      </form>

	      <ul class="nav navbar-nav navbar-right">
	        <?php if(isset($_SESSION['userName']))
	              {
	                echo("<li><a href='account.php'><span class='glyphicon glyphicon-user'></span> Account</a></li>");
	                echo("<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Uitloggen</a></li>");
	              }
	              else
	              {
	                echo("<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>");
	              }?>
	      </ul>
	    </div>
	  </div>
  </nav>
</section>
</header>
