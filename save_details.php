<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password
$database = "bhoomi"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farmId = $_POST['farmId'];
    $farmerName = $_POST['farmerName'];
    $landSize = $_POST['landSize'];
    $soilType = $_POST['soilType'];
    $phValue = $_POST['phValue'];
    $comments = $_POST['comments'];

    // Insert data into the database
    $sql = "INSERT INTO farm_details (farm_id, farmer_name, land_size, soil_type, ph_value, comments)
            VALUES ('$farmId', '$farmerName', '$landSize', '$soilType', '$phValue', '$comments')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>