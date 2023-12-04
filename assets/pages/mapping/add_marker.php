<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve marker data from the AJAX request
    $markerName = $_POST["name"];
    $markerLat = $_POST["lat"];
    $markerLng = $_POST["lng"];
    
    // Connect to the database (replace with your database credentials)
    $mysqli = new mysqli("localhost", "username", "password", "bataan_map");
    
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    // Prepare and execute the SQL query to insert the marker data
    $stmt = $mysqli->prepare("INSERT INTO markers (name, lat, lng) VALUES (?, ?, ?)");
    $stmt->bind_param("sdd", $markerName, $markerLat, $markerLng);
    
    if ($stmt->execute()) {
        echo "Marker data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
