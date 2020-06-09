<?php
if ( $conn)
{

//zet paginanummer
if (isset($_GET['pageno']))
{
  $pageno = $_GET['pageno'];
}
else
{
  $pageno = 1;
}
  //Zet variabelen
  $no_of_records_per_page =  32;
  $max = $no_of_records_per_page * $pageno;
  $min = $max - $no_of_records_per_page;
  $temptsql = "";
  $numberSearchTerms = 0;
  $params = array();
  $keyword = "";
  $afbeeldingen = '';
  $noProductsErrorMessage = '';
//zet zoektermen vanuit POST
if(isset($_POST['zoeken']))
{
  $keyword .= " U zocht op: ".$_POST['term'];
  $searchTerms = explode( " ", $_POST['term']);
  $searchTerms = array_slice($searchTerms, 0, 5);

  for ($i = 0; $i < count($searchTerms); $i++)
  {
	if ($searchTerms[$i] != "")
	{
    $z{$i} = $searchTerms[$i];
    $numberSearchTerms ++;
	}
  }
}
//Anders zet zoektermen vanuit GET
else if(isset($_GET['z0']))
{
  $keyword .= " U zocht op:";
  for ($i = 0; $i < 5; $i++)
  {
    if(isset($_GET['z'.$i]))
    {
	 $keyword .= ' '.$_GET['z'. $i];
      $z{$i} = $_GET['z'.$i];
      $numberSearchTerms ++;
    }
  }
}

//zet rubriek
if(isset($_GET['rubriek']))
{
  $rubric = $_GET['rubriek'];

  $rubrieknaam = "SELECT rubrieknaam FROM tbl_Rubriek WHERE rubrieknummer = ?";
  $params = array($_GET['rubriek']);
  $result = sqlsrv_query($conn, $rubrieknaam, $params);
  $row = sqlsrv_fetch_array($result);
  $keyword .= ' Zoekresultaten in rubriek '.$row['rubrieknaam'].':';
}

//Als er zoektermen zijn, neem deze dan op in $temptsql
for ($i = 0; $i < $numberSearchTerms; $i++)
    {
      if($i>0)
      {
        $temptsql .= " + ";
      }
      $temptsql .= "SUM( CASE WHEN titel LIKE ? THEN 2 ELSE 0 END) + SUM( CASE WHEN beschrijving LIKE ? THEN 1 ELSE 0 END)";
      //vul params aan met zoekterm data
      $params = array_merge($params, array("%".$z{$i}."%", "%".$z{$i}."%"));
    }
    //maak params aan voor de count functie
    $countParams = $params;
    //vul params aan met zoekterm data
    for ($i = 0; $i < $numberSearchTerms; $i++)
    {
      $params = array_merge($params, array("%".$z{$i}."%", "%".$z{$i}."%"));
    }
    //vul params aan met rubriekdata
    if(isset($rubric))
    {
      $params = array_merge($params, array($rubric));
      $countParams = array_merge($countParams, array($rubric));
    }
    //vul params aan met zoekterm data
    for ($i = 0; $i < $numberSearchTerms; $i++)
    {
      $params = array_merge($params, array("%".$z{$i}."%", "%".$z{$i}."%"));
      $countParams = array_merge($countParams, array("%".$z{$i}."%", "%".$z{$i}."%"));
    }
    //vul params aan min en max
    $params = array_merge($params, array($min, $max));
    //Aantal voorwerpen query
    $total_pages_sql = "SELECT COUNT(*) FROM";
    $total_pages_sql.= "(SELECT voorwerpnummer";
    if(!empty($temptsql))
    {
      $total_pages_sql.= ", ".$temptsql." as TOTAAL";;
    }
    $total_pages_sql.= " FROM tbl_Voorwerp ";
    if(isset($rubric))
    {
      $total_pages_sql.= "INNER JOIN tbl_Voorwerp_in_rubriek ON tbl_Voorwerp.voorwerpnummer = tbl_Voorwerp_in_rubriek.voorwerp
      WHERE rubriek_op_laagste_niveau = ? ";
    }
    if(!empty($temptsql))
    {
      $total_pages_sql.= " GROUP BY voorwerpnummer HAVING ".$temptsql." >= 1";
    }
    $total_pages_sql.= ") AS AANTAL";
    //bereken totaal aantal pagina's
    $result = sqlsrv_query($conn, $total_pages_sql, $countParams);
	  $total_rows = sqlsrv_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

//Fetch voorwerpinformatie uit de database query
$tsql = "SELECT * FROM";
$tsql.= "(SELECT TOP 100 percent verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs";
if(!empty($temptsql))
{
$tsql.= ", ".$temptsql." as TOTAAL";
}
$tsql.= ", ROW_NUMBER() OVER (ORDER BY ";
$tsql.= $temptsql;
if(empty($temptsql))
{
  $tsql.= "voorwerpnummer";
}
else
{
  $tsql.= " DESC";
}
$tsql.= ") as row FROM tbl_Voorwerp ";
if(isset($rubric))
{
  $tsql.= "INNER JOIN tbl_Voorwerp_in_rubriek ON tbl_Voorwerp.voorwerpnummer = tbl_Voorwerp_in_rubriek.voorwerp
  WHERE rubriek_op_laagste_niveau = ? ";
}
if(!empty($temptsql))
{
  $tsql.= "GROUP BY verkoper, voorwerpnummer, titel, looptijdEindeDag, looptijdEindeTijdstip, looptijd, startprijs
  HAVING ";
  $tsql.= $temptsql;
  $tsql.= " >= 1";
}
$tsql.= ")
a WHERE row > ? AND row <= ?";

//voer fetch query uit
$result = sqlsrv_query($conn, $tsql, $params);
if($result === false){
  die( FormatErrors( sqlsrv_errors()));
}
if(sqlsrv_has_rows($result))
{
  $row = sqlsrv_fetch_array($result); // bovenste rij
  //voeg afbeelding informatie toe aan de rij
  $filesql = "SELECT TOP 1 filenaam
         FROM tbl_Bestand
         WHERE voorwerp = ?";
  $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
  $file = sqlsrv_fetch_array($fileresult);
  if ( sqlsrv_has_rows($fileresult))
  {
  $row = array_merge($row, $file);
  }
  else
  {
	 $row = array_merge($row, array("filenaam" => ""));
  }
  // select query voor max bod bedrag met de naam van de gebruiker die het geboden heeft.
  $bodsql = "SELECT TOP 1 bodbedrag, gebruiker
        FROM tbl_Bod
        WHERE voorwerp = ?
        order by bodbedrag DESC";
  $bodresult = sqlsrv_query($conn, $bodsql, array($row['voorwerpnummer']));
  $file = sqlsrv_fetch_array($bodresult);
  if ( sqlsrv_has_rows($bodresult))
  {
    $row = array_merge($row, $file);
  }
  //maak van de informatie een card dmv itemToCard

    $afbeeldingen .= "<div class='row'>";

    $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
    $afbeeldingen .= itemToCard($row, $conn);
    $afbeeldingen .=  "</div>";
    //Doe dit voor elke rij
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC))
    {
      $fileresult = sqlsrv_query($conn, $filesql, array($row['voorwerpnummer']));
      $file = sqlsrv_fetch_array($fileresult);
	  if ( sqlsrv_has_rows($fileresult)) {
      $row = array_merge($row, $file);
      }
	  else
	  {
		 $row = array_merge($row, array("filenaam" => ""));
	  }

	  $bodresult = sqlsrv_query($conn, $bodsql, array($row['voorwerpnummer']));
	  $file = sqlsrv_fetch_array($bodresult);
	  if ( sqlsrv_has_rows($bodresult)) {
	  $row = array_merge($row, $file);
	  }
      $afbeeldingen .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
      $afbeeldingen .= itemToCard($row, $conn);
      $afbeeldingen .=  "</div>";
    }
    //sluit af en geef weer op pagina
    $afbeeldingen .= "</div>";
    // echo $afbeeldingen;
    sqlsrv_free_stmt($fileresult);
    sqlsrv_close($conn);
}
else
{
$noProductsErrorMessage .= "<div class='alert alert-danger' role='alert'>Sorry! Er zijn geen producten gevonden</div>";

}



}


 ?>
