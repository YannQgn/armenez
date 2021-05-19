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
		<link href="style.css?ts=?=time()?>" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" 
			  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
		  	  crossorigin=""/>
    	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  			    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin="">
		</script>
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
			<h2>Carte des clients</h2>
			<form action="ajouterclient.php" method="post" style="width:1200px; margin-left:-50px;">
			<label for="id">
			<i class="fa fa-folder" aria-hidden="true"></i>
			</label>
			<input type="number" name="id" placeholder="Numéro client" id="id" required>
			<label for="nom">
				<i class="fas fa-user"></i>
			</label>
			<input type="text" name="nom" placeholder="Nom client" id="nom" required>
			<label for="prenom">
				<i class="fas fa-user"></i>
			</label>
			<input type="text" name="prenom" placeholder="Prénom client" id="prenom" required>
			<label for="lat">
				<i class="fas fa-map-marker-alt"></i>
			</label>
			<input type="text" name="lat" placeholder="Latitude" id="lat" required readonly>
			<label for="lon">
				<i class="fas fa-map-marker-alt"></i>
			</label>
			<input type="text" name="lon" placeholder="Longitude" id="lon" required readonly>
			<input type="submit" value="Valider l'ajout du client">
		</form>
		</div>

		<div id="mapid"></div>
		
		<script type="text/javascript">
	 let mymap = L.map("mapid").setView([48.285933993343335, -3.5996624048969497], 9);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {

maxZoom: 18,
id: 'mapbox/streets-v11',
tileSize: 512,
zoomOffset: -1,
accessToken: 'pk.eyJ1IjoieWFubnFnbiIsImEiOiJja2txeTMyMzEwcjZ5MnZwODhid2V0aDl4In0.WfKxtBcx7QlQjNEyw2n6LQ'
}).addTo(mymap);




let xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = () => {

	if(xmlhttp.readyState == 4){

		if(xmlhttp.status == 200){

			let donnees = JSON.parse(xmlhttp.responseText)
			
			Object.entries(donnees.clients).forEach(clients => {

				let marker = L.marker([clients[1].lat, clients[1].lon]).addTo(mymap)
				marker.bindPopup(clients[1].nom, clients[1].prenom)
			})
		}else{
			console.log(xmlhttp.statusText);
		}
	}
}

xmlhttp.open("GET", "http://localhost/elagagesite/phplogin/liste.php");

xmlhttp.send(null);

mymap.on('click',latlonform);

  function latlonform(e){
	var latform = e.latlng.lat.toFixed(10)
	var lonform = e.latlng.lng.toFixed(10)
	document.getElementById('lat').value = latform;
	document.getElementById('lon').value = lonform;
}

	</script>
	</body>
</html>