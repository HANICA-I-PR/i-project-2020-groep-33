<?php
include("connect.php");
?>
<div id="navbarCollapse" class="collapse navbar-collapse">

<?php
	$sql = "SELECT * FROM tbl_Rubriek where rubriek is null";
  $query = sqlsrv_query($conn, $sql, NULL);
  if ( $query === false)
	{
		die( FormatErrors( sqlsrv_errors() ) );
	} else {

     $categoreen = '';
     for($i = 0; $i<18; $i++ ) {
      $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC);
      $sql1 = "SELECT * from tbl_Rubriek where rubriek = $row[volgnr]";
      $query1 = sqlsrv_query($conn, $sql1, NULL);
    $categoreen .= "<div class='dropdown'>";
    $categoreen .= " <a class='btn btn-secondary dropdown-toggle'href='#'role='button'id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
    $categoreen .= $row['rubrieknaam']. "</a>";
    $categoreen .= "<div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
    $categoreen .= "<ul id = 'ul_dropdown'>";
		while($row1 = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC))  {
      $categoreen .= "<li> <a class='dropdown-item' href='productlist.php?rubriek=".$row1['rubrieknummer']."'>";
        $categoreen .= $row1['rubrieknaam']." </a> </li>";
    }
    $categoreen .= " </ul>";
    $categoreen .=  "</div>";
    $categoreen .=  " </div>";

        }
        echo $categoreen;
  }
?>
  </div>


</nav>
<br>
<br>
<br>
<br>
<br>
