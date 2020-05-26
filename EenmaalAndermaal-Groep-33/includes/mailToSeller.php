<?php
	$message = '';
	$product = 0;

	$message = $_POST['message'];
	$product = $_POST['product'];

	echo'<p>'.$message.' over dit product: '.$product.'.</p>';
?>
