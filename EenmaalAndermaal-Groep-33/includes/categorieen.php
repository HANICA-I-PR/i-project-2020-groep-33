<?php
include("connect.php");
?>
<div id="navbarCollapse" class="collapse navbar-collapse">

<?php
	$sql = "SELECT rubrieknaam FROM tbl_Rubriek";
  $query = sqlsrv_query($conn, $sql, NULL);
  

  <div class="dropdown">
     <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      main_categorie1
    </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <ul id = "ul_dropdown">
            <li> <a class="dropdown-item" href="#">Action</a> </li>
            <li> <a class="dropdown-item" href="#">Another action</a> </li>
            <li> <a class="dropdown-item" href="#">Something else here</a> </li>
            <li> <a class="dropdown-item" href="#">Action</a> </li>
            <li> <a class="dropdown-item" href="#">Another action</a> </li>
            <li> <a class="dropdown-item" href="#">Something else here</a> </li>
          </ul>
          </div>
        </div>



?>
  </div>

</nav>

        <!-- <div class="dropdown">
       <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      main_categorie2
      </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <ul id = "ul_dropdown">
              <li> <a class="dropdown-item" href="#">Action</a> </li>
              <li> <a class="dropdown-item" href="#">Another action</a> </li>
              <li> <a class="dropdown-item" href="#">Something else here</a> </li>
              <li> <a class="dropdown-item" href="#">Action</a> </li>
              <li> <a class="dropdown-item" href="#">Another action</a> </li>
              <li> <a class="dropdown-item" href="#">Something else here</a> </li>
            </ul>
            </div>
          </div> -->

          <!-- <div class="dropdown">
         <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        main_categorie3
        </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <ul id = "ul_dropdown">
                <li> <a class="dropdown-item" href="#">Action</a> </li>
                <li> <a class="dropdown-item" href="#">Another action</a> </li>
                <li> <a class="dropdown-item" href="#">Something else here</a> </li>
                <li> <a class="dropdown-item" href="#">Action</a> </li>
                <li> <a class="dropdown-item" href="#">Another action</a> </li>
                <li> <a class="dropdown-item" href="#">Something else here</a> </li>
              </ul>
              </div>
            </div> -->

            <!-- <div class="dropdown">
           <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          main_categorie4
          </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <ul id = "ul_dropdown">
                  <li> <a class="dropdown-item" href="#">Action</a> </li>
                  <li> <a class="dropdown-item" href="#">Another action</a> </li>
                  <li> <a class="dropdown-item" href="#">Something else here</a> </li>
                  <li> <a class="dropdown-item" href="#">Action</a> </li>
                  <li> <a class="dropdown-item" href="#">Another action</a> </li>
                  <li> <a class="dropdown-item" href="#">Something else here</a> </li>
                </ul>
                </div>
              </div> -->




<!--
<div class="collapse navbar-collapse" id="main_nav">
<ul class="navbar-nav">
<li class="nav-item dropdown">
  <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> More items </a>
   <ul class="dropdown-menu">
     <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
     <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
   </ul>
</li>
<li class="nav-item dropdown">
  <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> More items </a>
   <ul class="dropdown-menu">
     <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
     <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
   </ul>
</li>
<li class="nav-item dropdown">
  <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> More items </a>
   <ul class="dropdown-menu">
     <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
     <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
   </ul>
</li>
</ul>
</div>

</nav> -->
