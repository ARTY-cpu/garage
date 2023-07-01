<?php
// Database configuration
$servername = "bf2229608-001.eu.clouddb.ovh.net:35609";
$username = "Garage_Admin";
$password = "GroupeAdmin80";
$database = "db_garage";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$appointmentDate = $_POST['appointment-date'];
$vehicleCategory = $_POST['vehicle-category'];
$vehicleId = $_POST['vehicle-id'];

// Start a transaction
$conn->begin_transaction();

try {
    // Insert data into 'clients' table
    $stmt = $conn->prepare("INSERT INTO clients (nom, email, telephone, adresse) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $address);
    $stmt->execute();

    // Check if the insert was successful
    if ($stmt->affected_rows > 0) {
        // Get the client ID
        $clientId = $stmt->insert_id;

        // Insert data into 'rdv' table
        $stmt = $conn->prepare("INSERT INTO rdv (client_id, voiture_id, date_reservation) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $clientId, $vehicleId, $appointmentDate);
        $stmt->execute();

        // Check if the insert was successful
        if ($stmt->affected_rows > 0) {
            // Update 'voitures' table
            $stmt = $conn->prepare("UPDATE voitures SET dispo = 0 WHERE id = ?");
            $stmt->bind_param("i", $vehicleId);
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                // Commit the transaction
                $conn->commit();
                echo "Data inserted successfully!";
            } else {
                throw new Exception("Error updating 'voitures' table.");
            }
        } else {
            throw new Exception("Error inserting data into 'rdv' table.");
        }
    } else {
        throw new Exception("Error inserting data into 'clients' table.");
    }
} catch (Exception $e) {
    // Rollback the transaction
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
