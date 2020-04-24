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
  <div class="container">
  <div class="row">
    <div class="col-sm-8" >
      <div id="myCarousel" class="carousel slide" data-ride="carousel" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
            <div class="carousel-caption">
              <h3>SELL $</h3>
              <p>Money Money.</p>
            </div>
          </div>

          <div class="item">
            <img src="https://placehold.it/800x400?text=Another Image Maybe" alt="Image">
            <div class="carousel-caption">
              <h3>More Sell $</h3>
              <p>Lorem ipsum...</p>
            </div>
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="well">
        <p>Some text..</p>
      </div>
      <div class="well">
         <p>Upcoming Events..</p>
      </div>
      <div class="well">
         <p>Visit Our Blog</p>
      </div>
    </div>
  </div>
  <hr>
  </div>

  <div class="container text-center">
    <h3>What We Do</h3>
    <br>
    <div class="row">
      <div class="col-sm-3">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Current Project</p>
      </div>
      <div class="col-sm-3">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Project 2</p>
      </div>
      <div class="col-sm-3">
        <div class="well">
         <p>Some text..</p>
        </div>
        <div class="well">
         <p>Some text..</p>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="well">
         <p>Some text..</p>
        </div>
        <div class="well">
         <p>Some text..</p>
        </div>
      </div>
    </div>
    <hr>
  </div>

  <div class="container text-center">
    <h3>Our Partners</h3>
    <br>
    <div class="row">
      <div class="col-sm-2">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Partner 1</p>
      </div>
      <div class="col-sm-2">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Partner 2</p>
      </div>
      <div class="col-sm-2">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Partner 3</p>
      </div>
      <div class="col-sm-2">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Partner 4</p>
      </div>
      <div class="col-sm-2">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Partner 5</p>
      </div>
      <div class="col-sm-2">
        <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        <p>Partner 6</p>
      </div>
    </div>
  </div><br>





  </body>
  <footer class="container-fluid text-center">
    <?php include 'includes/footer.php' ?>
  </footer>
  </html>
