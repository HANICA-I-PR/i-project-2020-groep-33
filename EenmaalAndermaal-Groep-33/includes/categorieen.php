<div id="navbarCollapse" class="collapse navbar-collapse">

	<?php
	  /* Onderstaande query selecteert rubrieknummer en naam van de main categorieen en sorteert eerst
		   op volgnr daarna op rubrieknaam */
		$tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek IS NULL ORDER BY volgnr ASC, rubrieknaam ASC";
	  $query = sqlsrv_query($conn, $tsql, NULL);
	  if ( $query === false)
		{
			die( FormatErrors( sqlsrv_errors() ) );
		} else {
	     $categorieen = '';
			 /* hieronder in while loop wordt de select van $tsql query gefetcht*/
	     while ($row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)) {
			 /* hieronder worden de rubrieknamen en nummers van de subrubrieken geselecteerd en sorteert eerst
		 	   op volgnr daarna op rubrieknaam*/
	     $tsql1 = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek = $row[rubrieknummer] ORDER BY volgnr ASC, rubrieknaam ASC";
	     $query1 = sqlsrv_query($conn, $tsql1, NULL);

	    $categorieen .= "<div class='dropdown'>";
	    $categorieen .= " <a class='btn btn-secondary dropdown-toggle'href='#'role='button'id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
	    /* $row['rubrieknaam']: rubrieknaam van de main categorieen*/
		  $categorieen .= $row['rubrieknaam']. "</a>";
	    $categorieen .= "<div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
	    $categorieen .= "<ul id = 'ul_dropdown'>";
			/* hieronder in de while loop wordt de select query tsql1 van de subrubrieken gefetcht*/
			while($row1 = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC))  {
				/* $row1['rubrieknummer'] wordt in de link meegegeven om in productlist.php te zoeken*/
	      $categorieen .= "<li> <a class='dropdown-item' href='productlist.php?rubriek=".$row1['rubrieknummer']."'>";
				/* $row1['rubrieknaam']: naam van subrubriek*/
	      $categorieen .= $row1['rubrieknaam']." </a> </li>";
	    }
	    $categorieen .= " </ul>";
	    $categorieen .=  "</div>";
	    $categorieen .=  " </div>";

	        }
	        echo $categorieen;
	  }
	?>
  </div>


</nav>
<br>
<br>
<br>
<br>
<br>
