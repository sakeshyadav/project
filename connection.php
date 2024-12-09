<?php
// Database configuration
$host = "localhost"; // Database host, usually 'localhost'
$username = "root";  // Database username (default for XAMPP is usually 'root')
$password = "";      // Database password (default for XAMPP is empty)
$dbname = "user"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there's a connection error, display a message
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully"; // Uncomment this line if you want to test the connection

?>
