<?php

$link = mysqli_connect("localhost", "root", "", "leafletloc");
 
if($link === false){
    die("ERREUR: Impossible de se connecter. " . mysqli_connect_error());
}
 
$id = mysqli_real_escape_string($link, $_REQUEST['id']);
$nom = mysqli_real_escape_string($link, $_REQUEST['nom']);
$prenom = mysqli_real_escape_string($link, $_REQUEST['prenom']);
$lat = mysqli_real_escape_string($link, $_REQUEST['lat']);
$lon = mysqli_real_escape_string($link, $_REQUEST['lon']);
$sql = "INSERT INTO clients (id, nom, prenom, lat, lon) VALUES ('$id', '$nom', '$prenom', '$lat', '$lon')";

if(mysqli_query($link, $sql)){
	echo "<script type='text/javascript'>
	alert('Le client a été ajouté avec succès.');
	location='carnetclients.php';
	</script>";
    exit;
} else{
    echo "ERREUR: Impossible d'ajouter les coordonnées du client ; les données saisies existent déjà ou bien ne sont pas valides. $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
?>
