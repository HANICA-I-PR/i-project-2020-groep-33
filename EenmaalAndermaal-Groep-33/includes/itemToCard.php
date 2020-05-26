<!DOCTYPE php>

<?php
//itemToCard zet voorwerp data uit de database om in een frame gevuld met die informatie.
//Om te werken heeft itemToCard de volgende variablen nodig:
//uit tbl_Voorwerp: voorwerpnummer, titel, startprijs, looptijd, verkoper, looptijdEindeDag, looptijdEindeTijdstip
//uit tbl_Bestand: filenaam

//Functionaliteit voor bodbedrag nog niet toegevoegd.

function itemToCard($input, $conn) {

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
  $output.= "<div class='card-body' style='position: absolute; bottom:0; right:5%; left:5%;'><div class='well text-center well-sm' style='padding-top:1%; min-height:7.5em;'>";
  // uw bod
  //check of er ingelogd is. if ingelogd :
  if (ISSET($_SESSION['userName']))
  {
	  	//als er een bod is:
	 	if (ISSET($input['bodbedrag'])) {
			$output .= "<p style='font-size:1.4rem;'>Huidig bod:€".sprintf('%0.2f', $input['bodbedrag'])."</p>";
		}
		//als er geen bod is:
		else {
			$output.= "<p style='font-size:1.4rem;'>Startprijs: €".sprintf('%0.2f', $input['startprijs'])."</P>";
		}

		// select de gebruiker die ingelogd is en op een voorwerp geboden heeft.
		$tsql = "SELECT gebruiker
				from tbl_Bod
				where voorwerp = ?
				and bodbedrag = (select max(bodbedrag)
								from tbl_Bod
								where voorwerp = ?
								and gebruiker = ?)
				and gebruiker = ?";
				$gebruikerResult = sqlsrv_query($conn, $tsql, array($input['voorwerpnummer'],$input['voorwerpnummer'],$_SESSION['userName'], $_SESSION['userName']));
				$file = sqlsrv_fetch_array($gebruikerResult);
		// als de persoon die ingelogd is geboden heeft:
		if (ISSET($file['gebruiker'])  && $file['gebruiker'] == $_SESSION['userName']) {
			$bodsql = "SELECT max(bodbedrag) AS bodbedrag
						FROM tbl_Bod
						WHERE gebruiker = ? AND voorwerp = ?";
			$bodresult = sqlsrv_query($conn, $bodsql, array($file['gebruiker'], $input['voorwerpnummer']));
			$file2 = sqlsrv_fetch_array($bodresult);
			$output .= "<p style='font-size:1.4rem;'>Uw bod:€".sprintf('%0.2f', $file2['bodbedrag'])."</p>";
		}

  }
  /// als niet ingelogd:
  else
  {
	  //als er een bod is uitgebracht:
	  if (ISSET($input['bodbedrag'])) {
		  $output .= "<p style='font-size:1.4rem;'>Huidig bod:€".sprintf('%0.2f', $input['bodbedrag'])."</p>";
	  }
	  // als er geen bod is uitgebracht:
	  else {
    		$output.= "<p>Startprijs: €";
    		$output.= sprintf('%0.2f', $input['startprijs'])."</p>";
		}
  }

  $output.= "</h4><a href='product.php?product=";
  $output.= $input['voorwerpnummer'];
  $output.= "'class='btn btn-primary' style='position:absolute; right:25%; left:25%; bottom:40%'><span class='glyphicon glyphicon-piggy-bank'></span> Bekijk</a>";
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
