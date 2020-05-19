<?php
include('includes/connect.php');
$titel = 'Contact';
include('includes/header.php');
?>
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
