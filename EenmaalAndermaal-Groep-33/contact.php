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
    <section id="contact">
       <div class="container">
           <h3 class="text-center text-uppercase">Neem contact met ons op</h3>
           <p class="text-center w-75 m-auto">Hebt u een vraag over de werking van de website? In het Call Center hebben we alle handleidingen voor u klaargezet. Komen we er alsnog niet uit? Dan kunt u in de mail een vraag aan ons stellen. Uw vraag komt direct bij de juiste medewerker zodat u snel antwoord hebt op uw vraag</p>
           <div class="row">
             <div class="col-sm-2"></div>
             <div class="col-sm-3">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-phone fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">Bel ons</h4>
                    <p>telefoon/whatsapp +33 024-3530500 <br> Bereikbaar op werkdagen van 09:00 tot 16:30 uur</p>
                  </div>
                </div>
             </div>
             <div class="col-sm-2">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-map-marker fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">Kantoor locatie</h4>
                   <address>Heyendaalseweg 98, 6525EE Nijmegen, Postbus 31193 <br> Bereikbaar op werkdagen van 09:00 tot 16:30 uur </address>
                  </div>
                </div>
             </div>
             <div class="col-sm-3">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-globe fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">email</h4>
                    <p>info@han.com</p>
                  </div>
                </div>
             </div>
           </div>
           </div>
       </div>
    </section>
  </body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
