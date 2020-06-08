<?php
include('includes/connect.php');
include('includes/itemToCard.php');
$titel = 'EenmaalAndermaal';
include('includes/header.php');
$subRubriekLink = "productlist.php";
$hoofdRubriekLink = "rubrieken.php";
$caption = 'Hoofdrubrieken:';
include('includes/categories.php');
?>
<body>
	<?php
		echo $categorieen;
	?>
</body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
