<?php
include('includes/biedingen.php');
$titel = 'Product';
include('includes/header.php');
include('includes/warningMessage.php');
include('includes/mailToSeller.php');
?>
<body>
	<!-- Algemene info over product ophalen uit de database -->
	<?php
	//sql query bepalen
	$sql = "SELECT titel, beschrijving,  startprijs, looptijdEindeDag, looptijdEindeTijdstip, looptijd, verkoper
	FROM tbl_Voorwerp
	WHERE voorwerpnummer = ?";

	$query = sqlsrv_query($conn, $sql, array($_GET['product']));
	// check voor errors in de query
	if ( $query === false){
		die( FormatErrors( sqlsrv_errors()));
	}
	// data daadwerkelijk ophalen
	$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC);
	?>

	<div class="container">
		<div class="row">
			<!-- title van product weergeven -->
			<?php echo "<h1> ".$row['titel']." </h1>" ?>
			<!-- image Carousel van het product-->
			<div class="col-sm-8" >
				<div id="myCarousel" class="carousel slide" data-ride="carousel" >
					<!-- Carousel Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>

						<?php
						$image_sql = "SELECT filenaam FROM tbl_Bestand WHERE voorwerp = ?";
						$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
						$image_query = sqlsrv_query($conn, $image_sql, array($_GET['product']), $options);

						if ( $image_query === false){
							die( FormatErrors( sqlsrv_errors()));
						}

						$carousel = "";

						for ($i=1; $i < min(sqlsrv_num_rows($image_query), 3); $i++) {
							$carousel .= "<li data-target='#myCarousel' data-slide-to='".$i."'></li>";
						}
						echo $carousel;
						?>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<?php
						$images = "";

						$image_row = sqlsrv_fetch_array( $image_query, SQLSRV_FETCH_ASSOC);
						$images .= "<div class='item active'>";
						$images .= "<img class='img-fluid' src= '".$image_row['filenaam']."' style = 'height: 30em; width: auto'>";
						$images .= "</div>";


						for ($j=1; $j < min(sqlsrv_num_rows($image_query), 3); $j++) {
							$image_row = sqlsrv_fetch_array( $image_query, SQLSRV_FETCH_ASSOC);
							$images .= "<div class='item'>";
							$images .= "<img class='img-fluid' src= '".$image_row['filenaam']."' style = 'height: 30em; width: auto'>";
							$images .= "</div>";
						}
						echo $images;
						?>
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

				<br>

				<!-- Weergave Omschrijving -->
				<div class="well">
					<h4>Omschrijving: </h4>
					<?php echo "<p> ".$row['beschrijving']." </p>" ?>
				</div>
			</div>

			<div class="col-sm-4">
				<!-- Weergave StartBedrag -->
				<div class="well">
					<ul class="list-inline">
						<li><h4>Startbedrag:</h4></li>
						<li><?php echo "<p>&euro; ".sprintf('%0.2f', $row['startprijs'])."</p>" ?></li>
					</ul>

					<!-- weergave Hoogste Bod -->
					<ul class="list-inline">
						<li><h4>Hoogste Bod:</h4></li>
						<li>
							<?php
							$hoogst_sql = "SELECT max(bodbedrag) FROM tbl_Bod WHERE voorwerp = ?";
							$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
							$hoogst_query = sqlsrv_query($conn, $hoogst_sql, array($_GET['product']), $options);

							if ( $hoogst_query === false){
								die( FormatErrors( sqlsrv_errors()));
							}

							$hoogst_row = sqlsrv_fetch_array( $hoogst_query, SQLSRV_FETCH_ASSOC);

							if($hoogst_row[''] == 0) {
								echo "<p>Er zijn nog geen boden geplaatst. Wees de eerste!</p>";
							}else{
								echo "<p>&euro; ".$hoogst_row['']."</p>";
							}
							?>
						</li>
					</ul>
				</div>

				<!-- Weergave tijd tot einde veiling -->
				<div class="well">
					<h4>Stopt in:</h4>
					<?php
					$endString = date_format($row['looptijdEindeDag'], 'd-m-Y')." ".date_format($row['looptijdEindeTijdstip'], 'H:i:s');
					$endDateTime = date_create_from_format('d-m-Y H:i:s',$endString);
					$endDateTimeDiff = date_diff($endDateTime, date_create_from_format('d-m-Y H:i:s', date("d-m-Y H:i:s")));
					$looptijdDiff = $row['looptijd'] - $endDateTimeDiff->format('%d') - 1/2;
					$looptijdPercentage = $looptijdDiff / $row['looptijd'] * 100;

					$stop_time = "";

					$stop_time .= "<div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' style='width:";

					$stop_time .= $looptijdPercentage;
					$stop_time .= "%'>";

					if($looptijdPercentage >= 50) {
						$stop_time .= $endDateTimeDiff->format('%d dagen %Hh:%im:%ss');
					}

					$stop_time .= "</div> <div class='progress-bar progress-bar-warning' role='progressbar' style='width:";
					$stop_time .= 100 - $looptijdPercentage;
					$stop_time .= "%'>";
					if($looptijdPercentage < 50) {
						$stop_time .= $endDateTimeDiff->format('%d dagen %Hh:%im:%ss');
					}
					$stop_time .= "</div></div>";

					echo $stop_time;
					?>
				</div>



				<!-- Bied opties -->
				<div class="well">
					<h4>Bied hier: </h4>
					<?php
					if (isset($_SESSION['userName'])) {
						if ($row['verkoper'] == $_SESSION['userName']){
							$win_sql = "SELECT TOP 1 bodbedrag, gebruiker FROM tbl_Bod WHERE voorwerp = ? ORDER BY bodbedrag DESC";
							$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
							$win_query = sqlsrv_query($conn, $win_sql, array($_GET['product']), $options);

							if ( $win_query === false){
								die( FormatErrors( sqlsrv_errors()));
							}

							$win_row = sqlsrv_fetch_array( $win_query, SQLSRV_FETCH_ASSOC);

							if($win_row == NULL){
								echo '<p>Er is nog niet geboden.</p><br>';
							}else{
								echo '
								<form>
								<label for="nieuwBod">Wilt U '.$row['titel'].' verkopen aan '.$win_row['gebruiker'].' voor $euro;'.sprintf('%0.2f', $win_row['bodbedrag']).'? &nbsp</label>
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verkoopModal">Verkoop</button>
								</form>';

								warningMessage('verkoopModal',
								'Weet u het zeker?',
								'Wilt U '.$row['titel'].' verkopen aan '.$win_row['gebruiker'].' voor $euro;'.sprintf('%0.2f', $win_row['bodbedrag']).'?',
								'Verkoop'
							);

							//echo '<br>';
						}

						echo '
						<form>
						<label for="nieuwBod">Verwijder '.$row['titel'].'? &nbsp</label>
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#verwijderModal">Verwijder</button>
						</form>';

						warningMessage('verwijderModal',
						'Weet u het zeker?',
						'Wilt U '.$row['titel'].' Verwijderen?',
						'Verwijder'
					);
				}else{
					// Als er ingelogd is geef bied knop weer
					echo '
					<form action="product.php?product='.$_GET['product'].'" method="post">
					<label for="nieuwBod">Plaats bod: &nbsp</label>
					<input type="number step=0.01" name="nieuwBod" placeholder="€">
					<input type="hidden" name="product" value='.$_GET['product'].'>
					<button type="submit" class="btn btn-primary btn-sm" name="BiedButton">Bied!</button>
					</form>
					'.$biedErrorMessage;

					// $laatste_sql = "SELECT * FROM tbl_Bod WHERE voorwerp = ".$_GET['product']."ORDER BY bodbedrag DESC";
					// $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					// $laatste_query = sqlsrv_query($conn, $laatste_sql, NULL, $options);
					//
					// if ( $laatste_query === false){
					// 	die( FormatErrors( sqlsrv_errors()));
					// }
					//
					// $geboden = false;
					// $hoogstEigenBod = 0;
					//
					// while($laatste_row = sqlsrv_fetch_array( $laatste_query, SQLSRV_FETCH_ASSOC)){
					// 	if($laatste_row['gebruiker'] == $_SESSION['userName']){
					// 		$geboden = true;
					// 		if($laatste_row['bodbedrag'] > $hoogstEigenBod) $hoogstEigenBod = $laatste_row['bodbedrag'];
					// 	}
					// }
					//
					// if($geboden){
					// 	$laatste_row = sqlsrv_fetch_array( $laatste_query, SQLSRV_FETCH_ASSOC, SQLSRV_SCROLL_ABSOLUTE, 0);
					// 	echo '
					// 			<form action="includes/verwijderBod.php" method="post">
					// 				<label for="nieuwBod">Verwijder je laatste bod: $euro;'.$hoogstEigenBod.' &nbsp</label>
					// 				<input type="hidden" name="product" value='.$_GET['product'].'>
					// 				<input type="hidden" name="bod" value='.$hoogstEigenBod.'>
					// 				<button type="submit" class="btn btn-danger btn-sm" name="verwijderBod">Verwijder</button>
					// 			</form>
					// 	';
					// }
				}
				// Als er niet ingelogd is geef optie om te registreren
			} else {
				echo "<div class='alert alert-info' role='alert'>Om mee te kunnen bieden heeft u een account nodig. Registreer nu!<br>
				<a href='login.php' class='btn btn-primary'><span class='glyphicon glyphicon-log-in'></span> Registreer</a></div>";
			}
			?>
		</div>
	</div>
</div>

<!-- Weergave aantal boden -->
<div class="well">
	<h3>Laatst geboden: </h3>
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th scope="col">Bod Nummer:</th>
				<th scope="col">Gebruiker:</th>
				<th scope="col">Bod:</th>
				<th scope="col">Datum:</th>
				<th scope="col">Tijd:</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Haal alle boden op uit de database
			$bod_sql = "SELECT * FROM tbl_Bod WHERE voorwerp = ? ORDER BY bodbedrag DESC";
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$bod_query = sqlsrv_query($conn, $bod_sql, array($_GET['product']), $options);

			if ( $bod_query === false){
				die( FormatErrors( sqlsrv_errors()));
			}

			$boden = "";

			$bod_amount = 5;
			if(sqlsrv_num_rows($bod_query) < 5) $bod_amount = sqlsrv_num_rows($bod_query);

			// als er geen boden zijn geef bericht om te bieden
			if($bod_amount == 0) {
				echo "<td colspan='5'>Er zijn nog geen boden geplaatst. Wees de eerste!</td>";
				// als er boden zijn geef de laatste 5 boden weer
			} else {
				for($k = 0; $k < $bod_amount; $k++){
					$boden_row = sqlsrv_fetch_array( $bod_query, SQLSRV_FETCH_ASSOC);

					$bod_date = date_format($boden_row['boddag'], 'd-m-Y');
					$bod_time = date_format($boden_row['bodtijdstip'], 'H:i:s');

					$boden .= "<tr>";
					$boden .= "<th>".($k + 1)."</th>";
					$boden .= "<td>".$boden_row['gebruiker']."</td>";
					$boden .= "<td>&euro; ".sprintf('%0.2f', $boden_row['bodbedrag'])."</td>";
					$boden .= "<td>".$bod_date."</td>";
					$boden .= "<td>".$bod_time."</td>";
					$boden .= "</tr>";
				}
				echo $boden;
			}
			?>
		</tbody>
	</table>
</div>

<!-- Weergave verkoper info -->
<div class="well">
	<h3>Verkoper Info: </h3>
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th scope="col">Gebruiker:</th>
				<th scope="col">Ervaringen:</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$Verkoper_sql = "SELECT * FROM tbl_Feedback WHERE voorwerp = ?";
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$Verkoper_query = sqlsrv_query($conn, $Verkoper_sql, array($_GET['product']), $options);

			if ( $Verkoper_query === false){
				die( FormatErrors( sqlsrv_errors()));
			}

			$Verkoper = "";

			$Verkoper_row = sqlsrv_fetch_array( $Verkoper_query, SQLSRV_FETCH_ASSOC);

			$Verkoper .= "<tr>";
			$Verkoper .= "<td>".$row['verkoper']."</td>";
			$Verkoper .= "<td>"."insert -verkoper rating- here"."</td>"; // Overleg doen over de functie van de tabel feedback
			$Verkoper .= "</tr>";
			echo $Verkoper;
			?>
		</tbody>
	</table><br>

	<?php
	if (isset($_SESSION['userName']) && $_SESSION['userName'] != $row['verkoper']) {
		echo'
		<h3>Stuur je vraag in een bericht:</h3>

		<form action="product.php?product='.$_GET['product'].'" method="post">
		<div class="form-group">
		<input type="hidden" name="product" value='.$_GET['product'].'>
		<textarea name="message" class="form-control" rows="5" id="message" placeholder="Vergeet niet uw contact gegevens achter te laten zodat de verkoper uw kan benaderen!"></textarea>
		</div>
		<button type="submit" class="btn btn-primary" name="Stuur">Stuur</button>
		</form>
		';
	}
	?>
</div>
</div>

<!-- weergave van vergelijkbare producten -->
<div class="container text-center">
	<h1> Vergelijkbare producten </h1> <br>
	<?php include 'includes/vergelijkbaarproduct.php' ?>
</div>
</body>

<!-- Footer -->
<footer class='container-fluid text-center'>
	<?php include 'includes/footer.php' ?>
</footer>
</html>
