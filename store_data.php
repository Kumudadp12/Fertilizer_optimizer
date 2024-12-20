<?php
// Database connection details
$host = 'localhost';      // Your database host
$dbname = 'teju';  // Your database name
$username = 'root';     // Your database username
$password = '';     // Your database password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the JSON data from the request
    $data = json_decode(file_get_contents("php://input"), true);

    // Prepare the SQL query to insert the data
    $query = "INSERT INTO soil_data (time, moisture, ph) VALUES (:time, :moisture, :ph)";
    $stmt = $pdo->prepare($query);

    // Bind the values from the request to the query
    $stmt->bindParam(':time', implode(',', $data['time']));
    $stmt->bindParam(':moisture', implode(',', $data['moisture']));
    $stmt->bindParam(':ph', implode(',', $data['ph']));

    // Execute the query
    $stmt->execute();

    // Return a success response
    echo json_encode(['message' => 'Data stored successfully']);
} catch (PDOException $e) {
    // Return an error response if there's a problem with the database
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>