<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
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
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profil</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Se déconnecter</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profil</h2>
			<div>
				<p>Les informations de votre compte sont ci-dessous :</p>
				<table>
					<tr>
						<td>Identifiant :</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Mot de passe :</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email :</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>