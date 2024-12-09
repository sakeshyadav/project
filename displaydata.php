<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";  // Ensure this is your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from database
$sql = "SELECT * FROM sell_youre_car";  // Make sure to change the table name to match your database
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <!-- Link to Bootstrap 5 CSS (latest version) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Carvilla</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>
                    <?php
                    session_start(); // Start the session

                    if (isset($_SESSION['email'])) {
                        // User is logged in, display personalized message and Logout link
                        echo '<li><a href="#" class="text-white pt-2">Hi, ' . $_SESSION['email'] . '</a></li>';
                        echo '<li><a href="logout.php" class="btn btn-danger mx-2 text-white" role="button">Logout</a></li>';
                    } else {
                        // User is not logged in, display Login and Register links
                        echo '<li><a href="admin_login.php" class="btn btn-success mx-2 text-white" role="button">Login</a></li>';
                        echo '<li><a href="ragister.php" class="btn btn-danger mx-2 text-white" role="button">Register</a></li>';
                    }
                    ?>               
                </ul>
            </div>
        </div>
    </nav>

    
    <!-- Container for the content -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Manage Car Listings</h2>


         <!-- Button to Add New Car -->
         <div class="d-flex justify-content-end mb-3">
            <a href="admin/add_car.php" class="btn btn-success">Add New Car</a>
        </div>

        <!-- Car Listings Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Car Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Mileage</th>
                    <th>Price</th>
                    <th>Photos</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any cars in the database
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['make'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['mileage'] . "</td>";
                        echo "<td>$" . number_format($row['price'], 2) . "</td>";
                        echo "<td><img src='uploads/" . $row['photos'] . "' alt='Car Image' style='width: 100px; height: auto;'></td>";

                        echo "<td>
                                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No cars found in the database</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js for responsive functionality -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
