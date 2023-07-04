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

// get email client
$email = $_POST['Filtre']; // Corrected to match the input field name

// Query to retrieve data
$sql = "SELECT rdv.id, clients.nom, clients.adresse, rdv.date_reservation, CONCAT(voitures.marque, ' ', voitures.modele) AS voiture
        FROM rdv 
        JOIN clients ON clients.id = rdv.client_id
        JOIN voitures ON voitures.id = rdv.voiture_id
        WHERE clients.email = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data as a table
    echo '<table>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Date de réservation</th>
                <th>Voiture</th>
                <th>Actions</th>
            </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["nom"] . '</td>';
        echo '<td>' . $row["adresse"] . '</td>';
        echo '<td>' . $row["date_reservation"] . '</td>';
        echo '<td>' . $row["voiture"] . '</td>';
        echo '<td>
                <button onclick="modifyRow(' . $row["id"] . ')">Modifier</button>
                <button onclick="deleteRow(' . $row["id"] . ')">Supprimer</button>
              </td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No results found.";
}

$stmt->close();
$connection->close();
?>