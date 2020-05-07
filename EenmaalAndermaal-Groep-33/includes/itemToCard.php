<!DOCTYPE php>

<?php

function itemToCard($input) {
  $output = "";
  $output.= "<div class='well' style='background:#FFFFFF'><p class='text-center'>";
  $output.= $input['titel'];
  $output.= "</p><img src= ";
  $output.= $input['filenaam'];
  $output.= " style='max-width:100%; max-height:200px; display:block; margin:auto'>";
  $output.= "<div class='card-body'><div class='well well-sm text-center'><h3>";
  //placeholder uw bod
  $output.= "Uw bod: ";
  $output.= "PH<br>";
  //placeholder huidig bod
  $output.= "Huidig bod: ";
  $output.="PH";
  //placeholder link
  $output.= "</h3><a href='product.php?product=";
  $output.= $input['voorwerpnummer'];
  $output.= "' class='btn btn-primary'><span class='glyphicon glyphicon-piggy-bank'></span> Bieden</a>";
  $output.= "</div><div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' style='width:";
  //placeholder progressbar1 %
  $output.= "25%";
  $output.= "'>";
  //placeholder progressbar1 tekst
  $output.= "";
  $output.= "</div><div class='progress-bar progress-bar-warning' role='progressbar' style='width:";
  //placeholder progressbar2 %
  $output.= "75%";
  $output.= "'>";
  //placeholder progressbar2 tekst
  $output.= "75 dagen resterend";
  $output.= "</div></div></div></div>";

  return $output;
}

?>
