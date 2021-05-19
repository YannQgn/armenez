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
        <style type="text/css">
           table {
               
  border-collapse: collapse;    
  width: 100%;
  color: #3274d6;
  font-family: monospace;
  font-size: 25px;
  text-align: center;
}

th {
  background-color: #3274d6;
  color:white;
  border: 1.5px solid black;
}

tr {
    border: 1px inset rgb(73, 73, 73);
}

tr:nth-child(even) {
  background: #efefef;
}
        </style>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="style.css" rel="stylesheet" type="text/css">
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
			<h2 style="border-bottom: 1px solid #e0e0e3;">Carnet de clients</h2>
            <table>
                <tr>
                  <th><i class="fa fa-folder" aria-hidden="true"></i> Numéro Client (ID)</th>
                  <th><i class="fas fa-user"></i> Nom du Client</th>
                  <th><i class="fas fa-user"></i> Prénom du Client</th>
                  <th><i class="fas fa-phone"></i> Téléphone du Client</th>
                  <th><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail du Client</th>
                  <th><i class="fa fa-pencil-square" aria-hidden="true">
                        <span class="tooltiptextmod">Modifier les informations d'un client</span>
                      </i>
                  </th>
                  <th><i class="fa fa-window-close" aria-hidden="true">
                        <span class="tooltiptextdel">Supprimer un client</span>
                      </i>
                  </th>
                </tr>
                <?php

include "dbConn.php";

$records = mysqli_query($db,"SELECT id, nom, prenom, numtel, email FROM clients");

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['nom']; ?></td>
    <td><?php echo $data['prenom']; ?></td>
    <td><?php echo '0'. $data['numtel']; ?></td>
    <td><?php echo $data['email'] ; ?></td>      
    <td><a href="modclient.php?id=<?php echo $data['id']; ?>"><i class="fa fa-pencil-square"></i></a></td>
    <td><a href="delclient.php?id=<?php echo $data['id']; ?>"><i class="fa fa-window-close"></i></a></td>
  </tr>	
<?php
}
?>
            </table>
		</div>
	</body>
</html>