<!DOCTYPE php>


<?php
Session_start();

// maakt connectie met de database
$serverName = "mssql.iproject.icasites.nl";
$connectionInfo = array( "Database"=>"iproject33",  "UID"=>"iproject33", "PWD"=>"thsPUqnU");
$conn = sqlsrv_connect( $serverName, $connectionInfo);



//localhost
// $serverName = "localhost";
// $connectionInfo = array( "Database"=>"EenmaalAndermaal",  "UID"=>"sa", "PWD"=>"test");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);
//  var_dump($conn);
?>
