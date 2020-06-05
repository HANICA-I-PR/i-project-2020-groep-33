<!-- Deze pagina is gemaakt om de SQL server queries die wij gebruiken te testen op SQL injections -->
<!-- Opmerkingen:  1- Deze pagina niet op de server zetten.
				   2-  SQL injections niet op de live server proberen te doen.
-->

<!--  Form met 2 invoervelden. -->
<!DOCTYPE html>
<html>
<body>
	<h2>HTML Forms</h2>

	<form action="sqlQueriesTest.php" method="post">
		<label for="fname">Input 1 :</label><br>
		<input type="text" id="fname" name="input1" value=""><br>
		<label for="lname">Input 2 :</label><br>
		<input type="text" id="lname" name="input2" value=""><br><br>
		<input type="submit" name = "submit"value="Submit">
	</form>
</body>
</html>

<?php
include('includes/connect.php');

if ( isset($_POST['submit'])) {
	/* Variabelen waarin de ingevoerde gegevens opgeslagen worden. */
	$txtUser = $_POST["input1"];
	$txtUser2 = $_POST["input2"];

    /*  Test 1:
	      Select query uit tabel tbl_Gebruiker. Echo voor de query is nodig om te kijken of de syntax
		van de query veranderd wordt wanneer iets ingevoerd wordt.
		1:  Voer  '' or ''=''   in de 2 velden in.
		2: Voer    105 OR 1=1	in de 2 velden in. 										*/

	$txtSQL = "SELECT * FROM tbl_Gebruiker WHERE gebruikersnaam = $txtUser AND voornaam = $txtUser2 ";
	echo $txtSQL."<br>Syntax van de query kan veradnerd worden waardoor sql injection gedaan kan worden";
 	$result = sqlsrv_query($conn, $txtSQL);
	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
	echo "<br>".$row['gebruikersnaam'];
	}

	/* Einde test 1.*/


   /*  Zet de code van test 1 in comments om de resultaten van deze test snel te bekijken.
   1:  Voer wat tussen haakjes staat in de 2 velden in.  1- { '' or ''='' }
														 2- { 105 OR 1=1   }		*/
	$txtSQL = "SELECT * FROM tbl_Gebruiker WHERE gebruikersnaam = ? AND voornaam = ?";
	echo $txtSQL. "<br>Syntax van de query kan niet veranderd worden. SQL injection is Onmogelijk";
	$params = array ($txtUser, $txtUser2);
	$result = sqlsrv_query($conn, $txtSQL, $params);
	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
	echo "<br>".$row['gebruikersnaam'];
	}

}

?>
