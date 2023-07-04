<?php
// Connexion à la base de données
$servername = "bf2229608-001.eu.clouddb.ovh.net:35609";
$username = "Garage_Admin";
$password = "GroupeAdmin80";
$database = "db_garage";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Vérification des variables POST
if (isset($_POST['rdv_id']) && isset($_POST['voiture_id'])) {
    // Récupérer l'identifiant de la ligne à supprimer
    $rdv_id = $_POST['rdv_id'];
    $voiture_id = $_POST['voiture_id'];

    // Requête de suppression
    $sql_delete = "DELETE FROM rdv WHERE id = ?";
    $stmt_delete = $connection->prepare($sql_delete);
    $stmt_delete->bind_param("i", $rdv_id);

    if ($stmt_delete->execute() === false) {
        die("Erreur lors de la suppression du rendez-vous : " . $stmt_delete->error);
    }

    $stmt_delete->close();

    // Requête de mise à jour de la disponibilité de la voiture
    $sql_update = "UPDATE voitures SET dispo = 1 WHERE id = ?";
    $stmt_update = $connection->prepare($sql_update);
    $stmt_update->bind_param("i", $voiture_id);

    if ($stmt_update->execute() === false) {
        die("Erreur lors de la mise à jour de la disponibilité de la voiture : " . $stmt_update->error);
    }

    $stmt_update->close();
}

$connection->close();

// Redirection vers la page précédente
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>