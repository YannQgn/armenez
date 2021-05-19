<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>AR MENEZ ELAGAGE</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>AR MENEZ ELAGAGE</h1>
				<a href="dashboard.php"><i class="fas fa-home"></i>Page d'accueil</a>
				<a href="carteclients.php"><i class="fas fa-map-marker-alt"></i>Carte des clients</a>
				<a href="carnetclients.php"><i class="fas fa-address-book"></i>Carnet de clients</a>
				<a href="../carrouselimages/uploadimage.php"><i class="fas fa-image"></i>Carrousel</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profil</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Se déconnecter</a>
			</div>
		</nav>
		<div class="content">
			<h2>Page d'accueil</h2>
			<p>Bienvenue, <?=$_SESSION['name']?> !</p>
		</div>
	</body>
</html>