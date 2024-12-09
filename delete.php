<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an 'id' is passed via GET request
if (isset($_GET['id'])) {
    // Get the ID from the URL
    $car_id = $_GET['id'];

    // Create DELETE query
    $sql = "DELETE FROM sell_youre_car WHERE id = $car_id"; // Assuming the table has a column named 'id'

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // If delete is successful
        echo "<script>alert('Car deleted successfully!'); window.location.href = 'displaydata.php';</script>";
    } else {
        // If there is an error with the deletion
        //echo "Error deleting record: " . $conn->error;
    }
} else {
    // If no 'id' is passed
    echo "No car ID provided.";
}

// Close the connection
$conn->close();
?>
