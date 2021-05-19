<?php

include "dbConn.php";

$id = $_GET['id'];

$del = mysqli_query($db,"delete from clients where id = '$id'");

if($del)
{
    mysqli_close($db);
    header("location:carnetclients.php");
    exit;	
}
else
{
    echo "Impossible de supprimer le client.";
}
?>