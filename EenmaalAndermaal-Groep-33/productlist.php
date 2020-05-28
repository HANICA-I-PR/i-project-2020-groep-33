<?php
include('includes/categories.php');
include('includes/itemToCard.php');
$titel = 'Producten lijst';
include('includes/header.php');
?>
<body>
  <div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">Producten
  </h1>

<?php
include('includes/phpProductList.php')
?>
 <ul class="pagination justify-content-center">
   <li class="page-item">
	 <a class="page-link" href="#" aria-label="Previous">
		   <span aria-hidden="true">&laquo;</span>
		   <span class="sr-only">Previous</span>
		 </a>
   </li>
   <li class="page-item">
	 <a class="page-link" href="#">1</a>
   </li>
   <li class="page-item">
	 <a class="page-link" href="#">2</a>
   </li>
   <li class="page-item">
	 <a class="page-link" href="#">3</a>
   </li>
   <li class="page-item">
	 <a class="page-link" href="#" aria-label="Next">
		   <span aria-hidden="true">&raquo;</span>
		   <span class="sr-only">Next</span>
		 </a>
   </li>
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
