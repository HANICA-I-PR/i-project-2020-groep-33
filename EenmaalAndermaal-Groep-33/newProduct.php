<?php
	include('includes/connect.php');
	include('includes/verkoperInfo.php');
	$titel = 'Nieuw Product';
	include('includes/header.php');
	if(!isset($_SESSION['userName']))
	{
	  header("Location:index.php");
	}
?>
<body>
	<!-- form om een voorwerp toe te kunnen voegen.  -->
	<div class="container">
                <form class="form-horizontal" role="form" action="newProduct.php" method="post" enctype="multipart/form-data">
										<div class="col-sm-12 text-center">
											<h2>Plaats een veiling</h2>
										</div>
                    <div class="form-group">
						<?php echo $titleErrorMessage; ?>
                        <label for="Titel" class="col-sm-3 control-label">Titel *</label>
                        <div class="col-sm-6">
                            <input type="text"  value="<?php echo(htmlspecialchars($title, ENT_QUOTES)) ?>" maxlength="255" name="titel" id="titel" placeholder="Titel van het product" class="form-control" rows="3" required>
                        </div>
                    </div>
					<div class="form-group">
						<?php echo $descriptionErrorMessage; ?>
						<label for="Beschrijving" class="col-sm-3 control-label">Beschrijving *</label>
						<div class="col-sm-6">
							<textarea type="text" maxlength="800" name="beschrijving" id="beschrijving" placeholder="Beschrijving van het product" class="form-control" rows="5" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<?php echo $startPriceErrorMessage;  ?>
						<label for="Startprijs" class="col-sm-3 control-label">Startprijs *</label>
						<div class="col-sm-6">
							<input type="number" maxlength="9" step='0.01' value='0.00' placeholder='0.00' name="startprijs" id="Startprijs" class="form-control" min="0" max="9999999.99" required>
						</div>
					</div>
					<div class="form-group">
						<?php  echo $paymentMethodeErrorMessage; ?>
                        <label for="Betalingswijze" class="col-sm-3 control-label">Betalingswijze *</label>
                        <div class="col-sm-6">
							<select id="betalingswijze" name="betalingswijze" class="form-control" required>
								<option>Bank/Giro</option>
								<option>iDeal</option>
								<option>PayPal</option>
								<option>Creditcard</option>
							</select>
                        </div>
                    </div>
					<div class="form-group">
						<?php  echo $paymentInstructionErrorMessage; ?>
						<label for="Betalingsinstructie" class="col-sm-3 control-label">Betalingsinstructie</label>
						<div class="col-sm-6">
							<input type="text" maxlength="50" name="betalingsinstructie" id="betalingsinstructie" placeholder="betalingsinstructie" class="form-control" value="<?php echo(htmlspecialchars($paymentInstruction, ENT_QUOTES)) ?>">
						</div>
					</div>
					<div class="form-group">
						<?php echo $placeErrorMessage; ?>
						<label for="Plaatsnaam" class="col-sm-3 control-label">Plaatsnaam *</label>
						<div class="col-sm-6">
							<input type="text" maxlength="28" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" class="form-control" value="<?php echo(htmlspecialchars($place, ENT_QUOTES)) ?>" required>
						</div>
					</div>
					<div class="form-group">
						<?php  echo $countryErrorMessage;  ?>
						<label for="Land" class="col-sm-3 control-label">Land *</label>
						<div class="col-sm-6">
							<input type="text" maxlength="30" name="land" id="Land" placeholder="Land" class="form-control" value="<?php echo(htmlspecialchars($country, ENT_QUOTES)) ?>" required>
						</div>
					</div>
					<div class="form-group">
						<?php  echo $durationErrorMessage; ?>
						<label for="Looptijd" class="col-sm-3 control-label">Looptijd *</label>
						<div class="col-sm-6">
							<select id="looptijd" name="looptijd" class="form-control" required>
		                        <option value="7">7</option>
		                        <option value="5">5</option>
								<option value="3">3</option>
							    <option value="1">1</option>
		                    </select>
						</div>
					</div>
					<div class="form-group">
						<?php echo $rubriekErrorMessage;  ?>
						<label for="Rubriek" class="col-sm-3 control-label">Rubriek *</label>
						<div class="col-sm-6">
							<select id="rubriek" name="rubriek" class="form-control" required>
								<option selected="selected">Kies een rubriek.....</option>

<?php
/* Onderstaande query selecteert rubrieknummer en naam van de main categorieen en sorteert eerst
	 op volgnr daarna op rubrieknaam */
	 	$tsql = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek IS NULL ORDER BY volgnr ASC, rubrieknaam ASC";
  		$query = sqlsrv_query($conn, $tsql, NULL);
  		if ( $query === false)
  		{
			die( FormatErrors( sqlsrv_errors() ) );
  		} else {
	  				$rubriek = '';
	  				while ($row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC)) {
		  				/* hieronder worden de rubrieknamen en nummers van de subrubrieken geselecteerd en sorteert eerst
   		 				op volgnr daarna op rubrieknaam*/
      					$tsql1 = "SELECT rubrieknaam, rubrieknummer FROM tbl_Rubriek WHERE rubriek = $row[rubrieknummer] ORDER BY volgnr ASC, rubrieknaam ASC";
      					$query1 = sqlsrv_query($conn, $tsql1, NULL);
	   					$rubriek .= "<optgroup label=".$row['rubrieknaam'].">";
	   					while($row1 = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC))  {
							$rubriek .= "<option value=".$row1['rubrieknummer'].">". $row1['rubrieknaam']."</option>";
						}
	 				$rubriek .=" </optgroup>";
  					}

  			echo $rubriek;

}
?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<?php  echo $shippingCostsErrorMessage;  ?>
						<label for="Verzendkosten" class="col-sm-3 control-label">Verzendkosten</label>
						<div class="col-sm-6">
							<input type="number" min="0" max="999.99" maxlength="5" step='0.01' value='0.00' placeholder='0.00' name="verzendkosten" id="verzendkosten" class="form-control" value="<?php echo(htmlspecialchars($shippingCosts, ENT_QUOTES)) ?>">
						</div>
					</div>
					<div class="form-group">
						<?php  echo $shippingInstructionErrorMessage;  	?>
						<label for="Verzendinstructie" class="col-sm-3 control-label">Verzendinstructie</label>
						<div class="col-sm-6">
							<input type="text" maxlength="30" name="verzendinstructie" id="verzendinstructie" placeholder="verzendinstructie" class="form-control" value="<?php echo(htmlspecialchars($shippingInstruction, ENT_QUOTES)) ?>">
						</div>
					</div>
					<div class="form-group">
						<?php echo $fileErrorMessage; echo $imageErrorMessage; ?>
						 <label for="Kies foto's" class="col-sm-3 control-label">Upload maximaal 5 foto's *</label>
						 <div class="col-sm-1">
						 </div>
					   <div class="col-sm-6">
						 	<input type="file" name="fileToUpload[]" class="form-control-file" id="fileToUpload" value="<?php echo(htmlspecialchars($file, ENT_QUOTES))?>" required multiple>
					   </div>
					</div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary btn-block" name="newProductButton">Plaats veiling</button>
						</div>
                    </div>
                </form> <!-- /form -->
            </div>    <!-- container-->
</body>
<footer class="container-fluid text-center">
<?php include 'includes/footer.php' ?>
</footer>
</html>
