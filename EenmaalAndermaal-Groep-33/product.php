<!DOCTYPE php>
<?php
	Session_start();
	include('includes/connect.php');
?>

<html lang="en">
	<head>
		<title>EenmaalAndermaal</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
	</head>

	<header>
		<?php include 'includes/header.php' ?>
	</header>

	<body>
		<?php
			$sql = "SELECT titel, beschrijving,  startprijs, looptijdEindeDag, looptijdEindeTijdstip, looptijd, verkoper
					FROM tbl_Voorwerp
					WHERE voorwerpnummer = ".$_GET['product'];

			$query = sqlsrv_query($conn, $sql, NULL);

			if ( $query === false){
				die( FormatErrors( sqlsrv_errors()));
			}

			$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC);
		?>

		<div class="container">
			<div class="row">
	    		<?php echo "<h1> ".$row['titel']." </h1>" ?>
		    	<div class="col-sm-8" >
		      		<div id="myCarousel" class="carousel slide" data-ride="carousel" >
		        		<!-- Indicators -->
		        		<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>

							<?php
								$image_sql = "SELECT filenaam FROM tbl_Bestand WHERE voorwerp = ".$_GET['product'];
								$image_query = sqlsrv_query($conn, $image_sql, NULL);

								if ( $image_query === false){
									die( FormatErrors( sqlsrv_errors()));
								}

								$carousel = "";

								for ($i=1; $i < sqlsrv_num_rows($image_query); $i++) {
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


								for ($j=1; $j < sqlsrv_num_rows($image_query); $j++) {
									$image_row = sqlsrv_fetch_array( $image_query, SQLSRV_FETCH_ASSOC, SQLSRV_SCROLL_RELATIVE, $j);
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
				</div>

	    		<div class="col-sm-4">
					<div class="well">
						<h4>Startbedrag:</h4>
	    				<?php echo "<p>€ ".$row['startprijs']." </p>" ?>
	      			</div>

	      			<div class="well">
						<h4>Hoogste Bod:</h4>
	    				<?php
							$hoogst_sql = "SELECT max(bodbedrag) FROM tbl_Bod WHERE voorwerp = ".$_GET['product'];
							$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
							$hoogst_query = sqlsrv_query($conn, $hoogst_sql, NULL, $options);

							if ( $hoogst_query === false){
								die( FormatErrors( sqlsrv_errors()));
							}

							$hoogst_row = sqlsrv_fetch_array( $hoogst_query, SQLSRV_FETCH_ASSOC);

							if($hoogst_row[''] == 0) {
								echo "<p>Er zijn nog geen boden geplaatst. Wees de eerste!</p>";
							}else{
								echo "<p>€ ".$hoogst_row['']."</p>";
							}
						?>
	      			</div>

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
	    		</div>
	  		</div>

			<br>

			<div class="well">
				<?php
					if (isset($_SESSION['userName'])) {
						echo ('<h4>Plaats bod:</h4>');
					} else {
						echo ("Om mee te kunnen bieden heeft u een account nodig. Registreer nu!<br>
						<a href='register.php' class='btn btn-primary'><span class='glyphicon glyphicon-log-in'></span> Registreer</a>");
					}
				?>
			</div>

	  		<div class="well">
				<h4>Omschrijving: </h4>
	    		<?php echo "<p> ".$row['beschrijving']." </p>" ?>
	  		</div>

			<br>

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
							$bod_sql = "SELECT * FROM tbl_Bod WHERE voorwerp = ".$_GET['product']."ORDER BY bodbedrag DESC";
							$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
							$bod_query = sqlsrv_query($conn, $bod_sql, NULL, $options);

							if ( $bod_query === false){
								die( FormatErrors( sqlsrv_errors()));
							}

							$boden = "";

							$bod_amount = 5;
							if(sqlsrv_num_rows($bod_query) < 5) $bod_amount = sqlsrv_num_rows($bod_query);

							if($bod_amount == 0) {
								echo "<td colspan='5'>Er zijn nog geen boden geplaatst. Wees de eerste!</td>";
							} else {
								for($k = 0; $k < $bod_amount; $k++){
									$boden_row = sqlsrv_fetch_array( $bod_query, SQLSRV_FETCH_ASSOC);

									$bod_date = date_format($boden_row['boddag'], 'd-m-Y');
									$bod_time = date_format($boden_row['bodtijdstip'], 'H:i:s');

									$boden .= "<tr>";
										$boden .= "<th>".($k + 1)."</th>";
										$boden .= "<td>".$boden_row['gebruiker']."</td>";
										$boden .= "<td>".$boden_row['bodbedrag']."</td>";
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
							$Verkoper_sql = "SELECT * FROM tbl_Feedback WHERE voorwerp = ".$_GET['product'];
							$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
							$Verkoper_query = sqlsrv_query($conn, $Verkoper_sql, NULL, $options);

							if ( $Verkoper_query === false){
								die( FormatErrors( sqlsrv_errors()));
							}

							$Verkoper = "";

							$Verkoper_row = sqlsrv_fetch_array( $Verkoper_query, SQLSRV_FETCH_ASSOC);

							$Verkoper .= "<tr>";
								$Verkoper .= "<td>".$row['verkoper']."</td>";
								$Verkoper .= "<td>"."insert -verkoper rating- here"."</td>";
							$Verkoper .= "</tr>";
								echo $Verkoper;
						 ?>
					</tbody>
				</table>
	  		</div>
	  	</div>

	  	<div class="container text-center">
	    	<h1> Vergelijkbare producten </h1> <br>
			<?php include 'includes/vergelijkbaarproduct.php' ?>
	   	</div>
	</body>

	<footer class='container-fluid text-center'>
		<?php include 'includes/footer.php' ?>
	</footer>
</html>
