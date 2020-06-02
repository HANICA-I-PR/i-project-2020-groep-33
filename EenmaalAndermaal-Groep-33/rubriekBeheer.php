<?php
	include('includes/connect.php');
	include('includes/itemToCard.php');
	$titel = 'Rubriek beheer';
	include('includes/header.php');
?>
	<body>
		<div class="container">
<!-- Page Heading -->
			<h1 class="my-4">Rubrieken</h1><br>

			<div class="row">
				<?php
					$tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek IS NULL ORDER BY volgnr ASC, rubrieknaam ASC";
					$query = sqlsrv_query($conn, $tsql, NULL);

					if ( $query === false) {
						die( FormatErrors( sqlsrv_errors() ) );
					} else {
						$categorieen = '';
	//hieronder in while loop wordt de select van $tsql query gefetcht
						while ($row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)) {
	//Hieronder worden de rubrieknamen en nummers van de subrubrieken geselecteerd en sorteert eerst op volgnr daarna op rubrieknaam
							$sub_tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek = ? ORDER BY volgnr ASC, rubrieknaam ASC";
							$params = array($row['rubrieknummer']);
							$sub_query = sqlsrv_query($conn, $sub_tsql, $params);

							$categorieen .= "<div class='well well-sm'>";
								$categorieen .= "<h3>".$row['rubrieknaam']."    ";
									$categorieen .= "<button type='button' class='btn btn-link' data-toggle='collapse' data-target=#".$row['rubrieknummer'].">SubRubrieken</button>";
								$categorieen .= "</h3>";

								$categorieen .= "<div class='text-right'>";
									$categorieen .= "<div class='btn-group '>";
										$categorieen .= "<button type='button' class='btn btn-primary' action='#'>Nieuw</button>";
										$categorieen .= "<button type='button' class='btn btn-warning' action='#'>Hernoem</button>";
										$categorieen .= "<button type='button' class='btn btn-danger' action='#'>Verwijder</button>";
									$categorieen .= "</div>";
								$categorieen .= "</div>";


								$categorieen .= "<div id=".$row['rubrieknummer']." class='collapse'>";
									$categorieen .= "<ul style='list-style-type: none'>";
										while($sub_row = sqlsrv_fetch_array( $sub_query, SQLSRV_FETCH_ASSOC))  {
											$categorieen .= "<li>".$sub_row['rubrieknaam']."";

												$categorieen .= "<div class='text-right'>";
													$categorieen .= "<div class='btn-group '>";
														$categorieen .= "<button type='button' class='btn btn-warning' action='#'>Hernoem</button>";
														$categorieen .= "<button type='button' class='btn btn-danger' action='#'>Verwijder</button>";
													$categorieen .= "</div>";
												$categorieen .= "</div>";
											$categorieen .= "</li>";
										}
									$categorieen .= "</ul>";
								$categorieen .= "</div>";
							$categorieen .= "</div>";
						}

						echo $categorieen;
					}
				?>
			</div>
		</div>
	</body>
	<footer class="container-fluid text-center">
		<?php include 'includes/footer.php' ?>
	</footer>
</html>
