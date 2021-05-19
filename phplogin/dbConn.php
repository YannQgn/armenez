<?php

$db = mysqli_connect("localhost","root","","leafletloc");

if(!$db)
{
    die("Connexion échouée: " . mysqli_connect_error());
}

?>