<?php
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page =  4;

$max = $no_of_records_per_page * $pageno;
$min = $max - $no_of_records_per_page;

if(isset($_GET['rubriek'])) {
	$total_pages_sql = "SELECT COUNT(*) FROM tbl_Voorwerp INNER JOIN tbl_Voorwerp_in_rubriek
	ON tbl_Voorwerp.voorwerpnummer = tbl_Voorwerp_in_rubriek.voorwerp where rubriek_op_laagste_niveau = ?";
	$params = array($_GET['rubriek']);
 }
else {
	$total_pages_sql = "SELECT COUNT(*) FROM tbl_Voorwerp";
	$params = array();
}
    $result = sqlsrv_query($conn, $total_pages_sql, $params);
	$total_rows = sqlsrv_fetch_array($result)[0];

$total_pages = ceil($total_rows / $no_of_records_per_page);
?>
