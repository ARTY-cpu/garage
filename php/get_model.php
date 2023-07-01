<?php
// Connexion à la base de données

// Récupération de la catégorie de véhicule sélectionnée depuis la requête AJAX
$vehicleCategory = $_GET['vehicleCategory'];

// Exécution de la requête SQL pour récupérer les modèles correspondants à la catégorie de véhicule
$query = "SELECT model FROM vehicle_models WHERE category = '$vehicleCategory'";
$result = mysqli_query($connection, $query);

// Création d'un tableau pour stocker les modèles
$models = array();

// Parcours des résultats et ajout des modèles au tableau
while ($row = mysqli_fetch_assoc($result)) {
    $models[] = $row['model'];
}

// Fermeture de la connexion à la base de données

// Envoi des résultats au format JSON
echo json_encode($models);
?>
