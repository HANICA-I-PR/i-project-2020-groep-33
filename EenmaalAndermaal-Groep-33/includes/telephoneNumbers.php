<?php



//Ingelogd check
if (isset($_SESSION['userName']) && $conn)
{
  //Fetch telefoonnummers
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

  //set errormessages empty
  $newTelephoneNumberErrorMessage = "";
  if(isset($telephoneNumbers))
  {
    for ($i = 0; $i < count($telephoneNumbers); $i++)
    {
      $telephoneNumberErrorMessage{$i} = "";
    }
  }

  if (isset($_POST['phoneNumberButton']))
  {

    //gaat over de huidige telefoonnummers
    if(isset($telephoneNumbers))
    {
      for ($i = 0; $i < count($telephoneNumbers); $i++)
      {
        //empty check, if empty delete
        if(empty($_POST['telephoneNumber'.$i]))
        {
          $tsql = "DELETE FROM tbl_Gebruikerstelefoon
                   WHERE gebruiker = ?
                   AND   telefoon = ?";
          $params = array($_SESSION['userName'],$telephoneNumbers[$i]['telefoon']);
          $result = sqlsrv_query($conn, $tsql, $params);
        }

        //verandering check
        else if($_POST['telephoneNumber'.$i] != $telephoneNumbers[$i]['telefoon'])
        {
          $errors=0;
          //lengte check
          if (strlen($_POST['telephoneNumber'.$i]) > 15)
          {
            $errors++;
            $telephoneNumberErrorMessage{$i} = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Telefoonnummer maximaal 15 tekens</div>";
          }
          //Update telefoonnummer
          if ($errors == 0)
          {
            $tsql = "UPDATE tbl_Gebruikerstelefoon
                     SET telefoon = ?
                     WHERE gebruiker = ?
                     AND telefoon =?";
            $params = array($_POST['telephoneNumber'.$i],$_SESSION['userName'],$telephoneNumbers[$i]['telefoon']);
            $result = sqlsrv_query($conn, $tsql, $params);
          }

        }
      }
    }
    //gaat over nieuw toe te voegen telefoonnummers
    if (!empty($_POST['newTelephoneNumber']))
    {
      if (strlen($_POST['telephoneNumber'.$i]) > 15)
      {
        $errors++;
        $newTelephoneNumberErrorMessage = "<div class='alert alert-danger' role='alert' style='height:30px; line-height:30px; padding:0px 15px; margin-bottom:1px'>Telefoonnummer maximaal 15 tekens</div>";
      }
      //Voeg telefoonnummer toe
      if ($errors == 0)
      {
        $tsql = "INSERT INTO tbl_Gebruikerstelefoon
                 VALUES (?, ?)";
        $params = array($_SESSION['userName'],$_POST['newTelephoneNumber']);
        $result = sqlsrv_query($conn, $tsql, $params);
      }

    }
  }

}
?>
