
<?php
include("connection.php"); // Include the database connection file
// Check if the form is submitted

// Check if the form is submitteds
// Include your database connection (assuming $conn is your database connection)
if (isset($_POST['submit'])) {
    // Get the user inputs directly from the form (no sanitization)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Write SQL query to check if the email and password match
    $sql = "SELECT * FROM admin_login WHERE email = '$email' AND password = '$password'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            // Fetch user data
            $user = mysqli_fetch_assoc($result);

            // Start session and save email in session
            session_start();
            $_SESSION['email'] = $user['email']; // Save the email in the session

            // Redirect to another page (e.g., dashboard)
            header("Location: displaydata.php");
            exit();
        } else {
            // If no matching user is found
            echo "<script>alert('Invalid email or password');</script>";
        }
    } else {
        // If SQL query failed
        echo "<script>alert('Database query failed');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  
  <!-- Link to Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Link to Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">

  <div class="card shadow-lg p-4 rounded-3" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4 text-danger">Admin Login</h3>

    <form action="admin_login.php" method="POST">
      <!-- Username Input -->
      <div class="mb-3">
        <label for="username" class="form-label">Email</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
          <input type="text" class="form-control" id="username" name="email" placeholder="Enter your username" required>
        </div>
      </div>

      <!-- Password Input -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
      </div>

      <!-- Login Button -->
      <div class="mb-3">
        <button type="submit"  name="submit"class="btn btn-danger w-100">Login</button>
      </div>

      <!-- Forgot Password Link -->
      <div class="text-center">
        <a href="#" class="text-muted">Forgot password?</a>
      </div>
    </form>
  </div>

  <!-- Bootstrap 5 JavaScript (required for form functionality) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
