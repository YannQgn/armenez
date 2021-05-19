<?php
include "dbConn.php";
$id = $_GET['id'];
$qry = mysqli_query($db,"select * from clients where id='$id'");
$data = mysqli_fetch_array($qry);

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numtel = $_POST['numtel'];
    $email = $_POST['email'];
	
    $edit = mysqli_query($db,"update clients set id='$id', nom='$nom', prenom='$prenom', numtel='$numtel', email='$email' where id='$id'");
	
    if($edit)
    {
        mysqli_close($db);
        header("location:carnetclients.php");
        exit;
    }
    else
    {
        echo mysqli_error();
    }    	
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
			<h2 style="border-bottom: 1px solid #e0e0e3;">Modifier les informations du client</h2>
            <table>
            <tr>
                  <th><i class="fa fa-folder" aria-hidden="true"></i> Numéro Client (ID)</th>
                  <th><i class="fas fa-user"></i> Nom du Client</th>
                  <th><i class="fas fa-user"></i> Prénom du Client</th>
                  <th><i class="fas fa-phone"></i> Téléphone du Client</th>
                  <th><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail du Client</th>
                </tr>
                <tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['nom']; ?></td>
    <td><?php echo $data['prenom']; ?></td>
    <td><?php echo '0'. $data['numtel']; ?></td>
    <td><?php echo $data['email']; ?></td>
  </tr>
</table>

</div>

<form class="updateform" method="POST">
  <input type="text" name="id" 
         style="float: left;text-align: center; width:237px;" 
         value="<?php echo $data['id'] ?>" placeholder="Saisir le nom" readonly>
  <input type="text" name="nom" 
         style="float: left; text-align: center; width:187px;" 
         value="<?php echo $data['nom'] ?>" placeholder="Saisir le nom" Required>
  <input type="text" name="prenom" 
         style="float: left; text-align: center; width:219px;"         
         value="<?php echo $data['prenom'] ?>" placeholder="Saisir le prénom" Required>
  <input type="text" name="numtel" 
         style="float: left; text-align: center; width:248px;" 
         value="<?php echo $data['numtel'] ?>" placeholder="Saisir le N° de téléphone" Required>
  <input type="text" name="email" 
         style="float: left; text-align: center; width:208px;" 
         value="<?php echo $data['email'] ?>" placeholder="Saisir l'adresse email" Required>
  <br>
  <input type="submit" name="update" class="updatesubmit" value="Mettre à jour les informations">
</form>

	</body>
</html>