<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Connexion à MySQL échouée : ' . mysqli_connect_error());
}


if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Veuillez renseigner les deux informations !');
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if ($_POST['password'] === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: dashboard.php');
        } else {
            echo 'Identifiant ou mot de passe incorrect !';
        }
    } else {
        echo 'Identifiant ou mot de passe incorrect !';
    }

	$stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="style.css?ts=?=time()?>" />
</head>

<body>
	<div class="container">
		<div class="center">
			<a href="loginform.html">
				<button class="btn" type="button">
					<svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
						<polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
						<polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
					</svg>
					<span>Revenir au formulaire de connexion</span>
				</button>
			</a>
		</div>
	</div>
</body>
</html>