<?php
// Connexion à la base de données (à inclure avant la logique de mise à jour)
$servername = "bf2229608-001.eu.clouddb.ovh.net:35609";
$username = "Garage_Admin";
$password = "GroupeAdmin80";
$database = "db_garage";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Vérifiez la connexion
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Récupérer les données du formulaire
$id = $_POST['id'];
$voiture = $_POST['voiture'];
$date_reservation = $_POST['date_reservation'];

// Requête pour mettre à jour les données
$sql = "UPDATE rdv SET voiture_id = ?, date_reservation = ? WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssi", $voiture, $date_reservation, $id);
$stmt->execute();
$stmt->close();


// Requête pour mettre à jour la table "voitures"
$update_sql = "UPDATE voitures SET dispo = 0 WHERE id = ?";
$update_stmt = $connection->prepare($update_sql);
$update_stmt->bind_param("i", $voiture);
$update_stmt->execute();
$update_stmt->close();

// Rediriger vers la page précédente
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>