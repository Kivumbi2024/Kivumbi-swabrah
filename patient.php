<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ehr_system"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $patientName = $_POST['patientName'];
    $patientAge = $_POST['patientAge'];
    $gender = $_POST['gender'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO patients (name, age, gender) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $patientName, $patientAge, $gender);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New patient record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
