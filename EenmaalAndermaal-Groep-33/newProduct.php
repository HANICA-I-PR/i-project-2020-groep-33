<?php
include('includes/connect.php');
include('includes/verkoperInfo.php');
$titel = 'Nieuw Product';
include('includes/header.php');
?>
<body>
	<!-- form om een voorwerp toe te kunnen voegen.  -->
	<div class="container">
                <form class="form-horizontal" role="form" action="newProduct.php" method="post">
                    <h2>Plaats een veiling</h2>
					<?php echo $newProductErrorMessage;?>
                    <div class="form-group">
                        <label for="Titel" class="col-sm-3 control-label">Titel</label>
                        <div class="col-sm-4">
                            <textarea type="text" maxlength="255" name="titel" id="titel" placeholder="Titel van het product" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
					<div class="form-group">
						<label for="Beschrijving" class="col-sm-3 control-label">Beschrijving</label>
						<div class="col-sm-4">
							<textarea type="text" maxlength="800" name="beschrijving" id="beschrijving" placeholder="Beschrijving van het product" class="form-control" rows="5"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="Startprijs" class="col-sm-3 control-label">Startprijs</label>
						<div class="col-sm-4">
							<input type="number" maxlength="9" step='0.01' value='0.00' placeholder='0.00' name="startprijs" id="Startprijs" class="form-control" min="0" max="9999999.99">
						</div>
					</div>
					<div class="form-group">
                        <label for="Betalingswijze" class="col-sm-3 control-label">Betalingswijze</label>
                        <div class="col-sm-4">
							<select id="betalingswijze" name="betalingswijze" class="form-control">
								<option>Bank/Giro</option>
								<option>iDeal</option>
								<option>PayPal</option>
								<option>Creditcard</option>
							</select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="Betalingsinstructie" class="col-sm-3 control-label">Betalingsinstructie</label>
						<div class="col-sm-4">
							<input type="text" maxlength="50" name="betalingsinstructie" id="betalingsinstructie" placeholder="betalingsinstructie" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="Plaatsnaam" class="col-sm-3 control-label">Plaatsnaam</label>
						<div class="col-sm-4">
							<input type="text" maxlength="28" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="Land" class="col-sm-3 control-label">Land</label>
						<div class="col-sm-4">
							<input type="text" maxlength="30" name="land" id="Land" placeholder="Land" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="Looptijd" class="col-sm-3 control-label">Looptijd</label>
						<div class="col-sm-4">
							<select id="looptijd" name="looptijd" class="form-control">
		                        <option value="7">7</option>
		                        <option value="5">5</option>
								<option value="3">3</option>
							    <option value="1">1</option>
		                    </select>
						</div>
					</div>
					<div class="form-group">
						<label for="Rubriek" class="col-sm-3 control-label">Rubriek</label>
						<div class="col-sm-4">
							<select id="rubriek" name="rubriek" class="form-control">
								<option>Rubriek1</option>
								<option>Rubriek2</option>
								<option>Rubriek3</option>
								<option>Rubriek4</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="Verzendkosten" class="col-sm-3 control-label">Verzendkosten</label>
						<div class="col-sm-4">
							<input type="number" min="0" max="999.99" maxlength="5" step='0.01' value='0.00' placeholder='0.00' name="verzendkosten" id="verzendkosten" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="Verzendinstructie" class="col-sm-3 control-label">Verzendinstructie</label>
						<div class="col-sm-4">
							<input type="text" maxlength="30" name="verzendinstructie" id="verzendinstructie" placeholder="verzendinstructie" class="form-control">
						</div>
					</div>
					<div class="form-group">
						 <label for="Kies foto's" class="col-sm-3 control-label">Kies foto's</label>
					   <div class="col-sm-4">
						 	<input type="file" name="file" class="form-control-file" id="Kies foto's">
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
