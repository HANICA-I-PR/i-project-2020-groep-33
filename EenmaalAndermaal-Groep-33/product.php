<!DOCTYPE php>
<?php
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
			$sql = "SELECT titel, beschrijving,  startprijs FROM tbl_Voorwerp WHERE voorwerpnummer = ".$_GET['product'];
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
								$image_sql = "SELECT * FROM tbl_Bestand WHERE voorwerp = ".$_GET['product'];
								$image_query = sqlsrv_query($conn, $image_sql, NULL);

								if ( $image_query === false){
									die( FormatErrors( sqlsrv_errors()));
								}

								$carousel = "";

								for ($i=1; $i < sqlsrv_num_rows($image_query); $i++) {
									//$image_row = sqlsrv_fetch_array( $image_query, SQLSRV_FETCH_ASSOC, SQLSRV_SCROLL_RELATIVE, $i);
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
									$images .= "<img class='img-fluid' src= '".$image_row['filenaam']."' style = 'height: 400px; width: auto'>";
									$images .= "<div class='carousel-caption'>";
										$images .= "<h3>SELL $</h3>";
										$images .= "<p>Money Money.</p>";
									$images .= "</div>";
								$images .= "</div>";


								for ($j=1; $j < sqlsrv_num_rows($image_query); $j++) {
									$image_row = sqlsrv_fetch_array( $image_query, SQLSRV_FETCH_ASSOC, SQLSRV_SCROLL_RELATIVE, $j);
									$images .= "<div class='item'>";
										$images .= "<img class='img-fluid' src= '".$image_row['filenaam']."' style = 'height: 400px; width: auto'>";
										$images .= "<div class='carousel-caption'>";
											$images .= "<h3>More Sell $</h3>";
											$images .= "<p>Lorem ipsum...</p>";
										$images .= "</div>";
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
	    				<?php echo "<p> ".$row['startprijs']." </p>" ?>
	      			</div>

	      			<div class="well">
						<h4>Hoogste Bod:</h4>
	    				<?php //echo "<p> ".$row['bodbedrag']." </p>" ?>
	      			</div>

	      			<div class="well">
	        			<?php
							if (isset($_SESSION['userName'])) {
	                			echo ('<h4>Plaats bod:</h4>');
	              			} else {
	                			echo ("<div class='alert alert-info' role='alert'>Om mee te kunnen bieden heeft u een account nodig. Registreer nu!<br>
	                			<a href='register.php' class='btn btn-primary'><span class='glyphicon glyphicon-log-in'></span> Registreer</a></div>");
	              			}
	              		?>
	      			</div>

	      			<div class="well">
	         			<h4>aflopende tijd:</h4>
						<?php //echo "<p> "." </p>" ?>
	      			</div>
	    		</div>
	  		</div>

			<br>

	  		<div class="well">
				<h4>Omschrijving: </h4>
	    		<?php echo "<p> ".$row['beschrijving']." </p>" ?>
	  		</div>

			<br>

	  		<div class="well">
				<table class="table table-striped table-responsive">
					<thead>
						<tr>
							<th scope="col">Bod Nummer:</th>
							<th scope="col">Gebruiker:</th>
							<th scope="col">Bod:</th>
							<th scope="col">Datum:</th>
						</tr>
					</thead>
					<tbody>
						<h3>Boden: </h3>
						<?php
							$boden = "";

							$bod_amount = 5;
							//if(sqlsrv_num_rows($bod_query) < $bod_amount) $bod_amount = sqlsrv_num_rows($bod_query);

							for($k = 0; $k < $bod_amount; $k++){
								$boden .= "<tr>";
									$boden .= "<th>".($k + 1)."</th>";
									$boden .= "<td>User</td>";
									$boden .= "<td>€€€</td>";
									$boden .= "<td>Date</td>";
								$boden .= "</tr>";
							}
							echo $boden;
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
