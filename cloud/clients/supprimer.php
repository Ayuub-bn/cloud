<?php

include ("../db/db.php");

$id=$_GET['id'];

$sql="DELETE from client where id=$id";

if(sqlsrv_query($conn, $sql)){
    $_SESSION['messageClass']="success";
    $_SESSION['message']="Supprimé avec succes";

    echo "<script type='text/javascript'>
    window.location.href = './list.php';
  </script>";
}
?>
