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

// Prepare and execute the insert statement
$stmt = $conn->prepare("INSERT INTO clients (nom, email, telephone, adresse) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $address);
$stmt->execute();


// Check if the insert was successful
if ($stmt->affected_rows > 0) {
    echo "Data inserted successfully!";
} else {
    echo "Error inserting data.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
