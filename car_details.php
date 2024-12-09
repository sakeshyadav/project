<?php
session_start(); // Start the session to check if the user is logged in

// Database connection
include('connection.php');

// Initialize car details array
$car_details = [];

// Check if the car id is provided in the URL
if (isset($_GET['id'])) {
    $car_id = $_GET['id']; // Get car ID from URL

    // Ensure car_id is a number (simple validation)
    if (is_numeric($car_id)) {
        // Fetch the car details from the database using the car_id
        $sql = "SELECT id, make, model, year, mileage, conditions, price, photos, seller_name, phone, email, title_status 
                FROM sell_youre_car WHERE id = $car_id";

        $result = $conn->query($sql);

        if ($result) {
            // If the query is successful
            if ($result->num_rows > 0) {
                $car_details = $result->fetch_assoc(); // Fetch the car details
            } else {
                echo "No car found with this ID."; // If no car found
                exit;
            }
        } else {
            // If the query fails
            echo "Error executing query: " . $conn->error;
            exit;
        }
    } else {
        echo "Invalid car ID.";
        exit;
    }
} else {
    echo "Car ID is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Details</title>
  <!-- Link to Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .chat-buttons {
      display: flex;
      justify-content: center;
      gap: 10px;
    }
  </style>
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
            <a class="nav-link text-white" href="#">Contact</a>
          </li>
          <?php
          if (isset($_SESSION['email']) && isset($_SESSION['full_name'])) {
              // User is logged in
              echo '<li><a href="#" class="text-white">Hi, ' . $_SESSION['full_name'] . '</a></li>';
              echo '<li><a href="logout.php" class="btn btn-danger mx-2 text-white" role="button">Logout</a></li>';
              echo '<li class="nav-item"><a class="btn btn-warning mx-2 text-white" href="sellcar.php">Sell Your Car</a></li>';
          } else {
              // User is not logged in
              echo '<li><a href="login.php" class="btn btn-success mx-2 text-white" role="button">Login</a></li>';
              echo '<li><a href="register.php" class="btn btn-danger mx-2 text-white" role="button">Register</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Car Details Section -->
  <div class="container py-5">
    <h2 class="text-center mb-4 text-primary"><?php echo $car_details['make'] . ' ' . $car_details['model']; ?></h2>

    <!-- Car Details Card -->
    <div class="card mx-auto" style="max-width: 800px;">
      <div class="row g-0">
        <div class="col-md-6">
          <img src="uploads/<?php echo $car_details['photos']; ?>" class="img-fluid rounded-start" alt="Car Image">
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title">Details</h5>
            <p><strong>Year:</strong> <?php echo $car_details['year']; ?></p>
            <p><strong>Mileage:</strong> <?php echo $car_details['mileage']; ?> miles</p>
            <p><strong>Condition:</strong> <?php echo $car_details['conditions']; ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($car_details['price'], 2); ?></p>
            <p><strong>Seller Name:</strong> <?php echo $car_details['seller_name']; ?></p>
            <p><strong>Phone:</strong> <?php echo $car_details['phone']; ?></p>
            <p><strong>Email:</strong> <?php echo $car_details['email']; ?></p>
            <p><strong>Title Status:</strong> <?php echo $car_details['title_status']; ?></p>

            <!-- WhatsApp and Chat Buttons -->
            <div class="chat-buttons">
              <!-- WhatsApp Button -->
              <a href="https://wa.me/<?php echo $car_details['phone']; ?>" target="_blank" class="btn btn-success">
                <i class="fab fa-whatsapp"></i> Chat on WhatsApp
              </a>

              <!-- Chat Button -->
              <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#chatModal">
                <i class="fas fa-comment-dots"></i> Chat with Seller
              </button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Chat Modal -->
  <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="chatModalLabel">Chat with Seller</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Seller's Phone:</strong> <?php echo $car_details['phone']; ?></p>
          <p>You can directly chat with the seller using WhatsApp or any other messaging platform.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
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

  <!-- Font Awesome for WhatsApp icon -->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
