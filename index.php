<?php
session_start(); // Start the session to check if the user is logged in

// Database connection
$servername = "localhost"; // or your server's address
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for session check
$is_logged_in = isset($_SESSION['email']) && isset($_SESSION['full_name']);
$cars = [];

// Check if connection is successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Write the SQL query
$sql = "SELECT id, model, price, photos FROM sell_youre_car";

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query was successful and if there are any results
if ($result === false) {
  // If query fails, output the error
  error_log("SQL Error: " . $conn->error, 3, "error_log.txt");
  die("No results found or an error occurred while fetching data.");
} else {
  // If the query is successful, check if any rows are returned
  if ($result->num_rows > 0) {
    // If there are cars in the database, fetch them
    while ($row = $result->fetch_assoc()) {
      $cars[] = $row;
    }
  } else {
    // No cars found
    echo '<p>No cars found in the database.</p>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index</title>
  <!-- Link to Bootstrap 5 CSS (latest version) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Carvilla</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="contect.php">Contact</a>
          </li>
          <?php
          if ($is_logged_in) {
            // User is logged in, display personalized message and Logout link
            echo '<li><a href="#" class="text-white">Hi, ' . $_SESSION['full_name'] . '</a></li>';
            echo '<li><a href="logout.php" class="btn btn-danger mx-2 text-white" role="button">Logout</a></li>';
            echo '<li class="nav-item">
              <a class="btn btn-warning mx-2 text-white" href="sellcar.php">Sell Your Car</a>
            </li>';
          } else {
            // User is not logged in, display Login and Register links
            echo '<li><a href="login.php" class="btn btn-success mx-2 text-white" role="button">Login</a></li>';
            echo '<li><a href="ragister.php" class="btn btn-danger mx-2 text-white" role="button">Register</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Car Display Section -->
  <div class="container py-5">
    <h2 class="text-center mb-4 text-primary" style="font-weight: bold;">Our Cars</h2>

    <!-- Display Cars -->
    <div class="row g-4 mb-4">
      <?php
      // Loop through the cars array and display each car
      if (!empty($cars)) {
        foreach ($cars as $car) {
          $imagePath = 'uploads/' . $car['photos'];
          if (!file_exists($imagePath)) {
            $imagePath = 'path/to/default-image.jpg'; // Use default image if not found
          }
          echo '<div class="col-md-3">';
          echo '  <div class="card">';
          echo '    <img src="' . $imagePath . '" class="card-img-top img-fluid" alt="Car" style="height: 200px; object-fit: cover;">';
          echo '    <div class="card-body text-center">';
          echo '      <h5 class="card-title">' . $car['model'] . '</h5>';
          echo '      <p class="card-text text-muted">$' . number_format($car['price'], 2) . '</p>';
          echo '      <a href="car_details.php?id=' . $car['id'] . '" class="btn btn-primary btn-sm">View Details</a>';
          echo '    </div>';
          echo '  </div>';
          echo '</div>';
        }
      } else {
        echo '<p>No cars available to display.</p>';
      }
      ?>
    </div>

    <!-- If not logged in, show a message -->
    <?php if (!$is_logged_in): ?>
      <p class="text-center">Please log in to sell a car.</p>
    <?php endif; ?>
  </div>

  <footer class="bg-dark text-white py-3">
    <div class="container text-center">
      <p class="mb-0">&copy; 2024 Car Showroom. All Rights Reserved.</p>
      <p>
        <a href="#" class="text-white">Privacy Policy</a> |
        <a href="#" class="text-white">Terms of Service</a>
      </p>
    </div>
  </footer>

  <!-- Bootstrap JS and Popper.js for responsive functionality -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>