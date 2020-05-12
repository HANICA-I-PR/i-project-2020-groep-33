<!DOCTYPE php>

<?php
//itemToCard zet voorwerp data uit de database om in een frame gevuld met die informatie.
//Om te werken heeft itemToCard de volgende variablen nodig:
//uit tbl_Voorwerp: voorwerpnummer, titel, startprijs, looptijd, verkoper, looptijdEindeDag, looptijdEindeTijdstip
//uit tbl_Bestand: filenaam

//Functionaliteit voor bodbedrag nog niet toegevoegd.

function itemToCard($input) {

  $endString = date_format($input['looptijdEindeDag'], 'd-m-Y')." ".date_format($input['looptijdEindeTijdstip'], 'H:i:s');
  $endDateTime = date_create_from_format('d-m-Y H:i:s',$endString);
  $endDateTimeDiff = date_diff($endDateTime, date_create_from_format('d-m-Y H:i:s', date("d-m-Y H:i:s")));
  $looptijdDiff = $input['looptijd'] - $endDateTimeDiff->format('%d') - 1/2;
  $looptijdPercentage = $looptijdDiff / $input['looptijd'] * 100;

  //date_format($accountInformation['geboorteDag'], 'd-m-Y H:i:s')
  $output = "";
  $output.= "<div class='well' style='background:#FFFFFF; min-height:31em; position: relative;'><p class='text-center'>";
  $output.= $input['titel'];
  $output.= "</p><img src= ";
  $output.= $input['filenaam'];
  $output.= " style='max-width:15em; max-height:12em; display:block; margin:auto; position: absolute; top: 0; bottom: 6em; left: 0; right: 0;'>";
  $output.= "<div class='card-body ' style='position: absolute; bottom:0; right:20%; left:20%'><div class='well text-center well-sm '><h4>";
  //placeholder uw bod
  if (ISSET($_SESSION['userName']) && $_SESSION['userName'] != $input['verkoper'])
  {
    $output.= "Uw bod: ";
    $output.= "PH<br>";
  }
  //placeholder huidig bod

  if(ISSET($input['bodbedrag']))
  {
    $output.= "Huidig bod: €";
    $output.="PH";
  }
  else
  {
    $output.= "Startprijs: €";
    $output.= $input['startprijs'];
  }

  $output.= "</h4><a href='product.php?product=";
  $output.= $input['voorwerpnummer'];
  $output.= "' class='btn btn-primary'><span class='glyphicon glyphicon-piggy-bank'></span> Bekijk</a>";
  $output.= "</div><div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' style='width:";
  $output.= $looptijdPercentage;
  $output.= "%'>";
  if($looptijdPercentage >= 50)
  {
    $output.= $endDateTimeDiff->format('%d dagen %Hh:%im:%ss');
  }
  $output.= "</div><div class='progress-bar progress-bar-warning' role='progressbar' style='width:";
  $output.= 100 - $looptijdPercentage;
  $output.= "%'>";
  if($looptijdPercentage < 50)
  {
    $output.= $endDateTimeDiff->format('%d dagen %Hh:%im:%ss');
  }
  $output.= "</div></div></div></div>";

  return $output;
}

?>
