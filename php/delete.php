<?php
// Connexion à la base de données
$servername = "bf2229608-001.eu.clouddb.ovh.net:35609";
$username = "Garage_Admin";
$password = "GroupeAdmin80";
$database = "db_garage";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Récupérer l'identifiant de la ligne à supprimer
$id = $_POST['id'];

// Requête de suppression
$sql = "DELETE FROM rdv WHERE id = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$connection->close();

// Redirection vers la page précédente
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

?>