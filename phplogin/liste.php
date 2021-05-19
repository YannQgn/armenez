<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$db_name = "leafletloc";
$username = "root";
$password = "";
try{
    $db = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $db->exec("set names utf8");
}catch(PDOException $exception){
    echo "Erreur de connexion : " . $exception->getMessage();
}

$sql = "SELECT * FROM clients";

$query = $db->prepare($sql);

$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $cli = [
        "id" => $id,
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "lat" => $lat,
        "lon" => $lon,
    ];

    $tableauClients['clients'][] = $cli;
}

echo json_encode($tableauClients);