<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve marker ID from the AJAX request
    $markerId = $_POST["id"];
    
    // Connect to the database (replace with your database credentials)
    $mysqli = new mysqli("localhost", "root", "", "bataan_markers");
    
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    // Prepare and execute the SQL query to delete the marker data
    $stmt = $mysqli->prepare("DELETE FROM markers WHERE id = ?");
    $stmt->bind_param("i", $markerId);
    
    if ($stmt->execute()) {
        echo "Marker data deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
