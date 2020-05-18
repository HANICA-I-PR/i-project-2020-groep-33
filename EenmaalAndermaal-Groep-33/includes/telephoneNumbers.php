<?php

//Fetch telefoonnummers

//Ingelogd check
if (isset($_SESSION['userName']) && $conn)
{
    
  $tsql = "SELECT telefoon
           FROM tbl_Gebruikerstelefoon
           WHERE gebruiker = ?";
  $params = array($_SESSION['userName']);
  $result = sqlsrv_query($conn, $tsql, $params);
  if(sqlsrv_has_rows($result))
  {
    $row = sqlsrv_fetch_array($result);
    $telephoneNumbers = array($row);

    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
    {
      $telephoneNumbers = array_merge($telephoneNumbers, array($row));
    }
  }

}
?>
