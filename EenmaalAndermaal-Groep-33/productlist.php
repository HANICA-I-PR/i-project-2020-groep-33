<?php
include('includes/categories.php');
include('includes/itemToCard.php');
$titel = 'Producten lijst';
include('includes/header.php');
?>
<body>
  <div class="container">
  <!-- Page Heading -->
  <h1 class="my-4">Producten</h1>

<?php
	include('includes/pagination.php');
	include('includes/phpProductList.php');
	$rubriek = "";
	if(isset($_GET['rubriek']))
	{
		$rubriek = "&rubriek=".$_GET['rubriek'];
	}
?>
<ul class="pagination">
    <li><a href="?pageno=1<?php echo $rubriek ?>">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1).$rubriek; } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1).$rubriek; } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages.$rubriek; ?>">Last</a></li>
</ul>

	</div>

<?php


 echo $categorieen;
?>
  <!-- <div class="row">
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" style="width: 100%" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Product</a>
          </h4>
          <p class="card-text">Korte beschrijving..</p>
        </div>
      </div>
    </div>
  </div> -->
  <!-- /.row -->

  <!-- Pagination -->



<!-- /.container -->
</body>
<footer class="container-fluid text-center">
  <?php include 'includes/footer.php' ?>
</footer>
</html>
