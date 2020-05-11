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
    <div class="navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
		<?php
			$calling_file = basename($_SERVER['REQUEST_URI']);
			if($calling_file == "index.php") {echo '<li class = "active"><a href="index.php">Home</a> </li>';} else{
				echo '<li><a href="index.php">Home</a> </li>';
			}
			if($calling_file == "productlist.php") {echo '<li class = "active"><a href="productlist.php">Producten</a></li>';} else{
				echo '<li><a href="productlist.php">Producten</a></li>';
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
                echo("<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>");
              }
              else
              {
                echo("<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>");
              }?>
      </ul>
    </div>
  </div>
<?php include "categorieen.php"; ?>
