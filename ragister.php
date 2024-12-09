<?php
include("connection.php"); // Ensure the connection is correct

// Check if the form is submitted
if (isset($_POST["ragister"])) { // Fixed the typo "ragister" to "register"
    // Get the form data
    $full_name = $_POST['full_name'];    
    $email = $_POST['email'];  
    $password = $_POST['password']; 
    $confirm_password = $_POST['confirm_password']; 

    // Check if the passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
        echo "<script>window.location.href='ragister.php';</script>";
        exit;
    }

    // Check if the email already exists in the database
    $sql = "SELECT * FROM user_data WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // If email already exists
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email is already ragistered');</script>";
    } else {
        // Insert user data into the database (both password and confirm_password are inserted)
        // Make sure you insert the `confirm_password` into the database as well.
        $sql = "INSERT INTO user_data (full_name, email, password, confirm_password) 
                VALUES ('$full_name', '$email', '$password', '$confirm_password')";

        // Execute the insert query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful');</script>";
            echo "<script>window.location.href='login.php';</script>";  // Redirect to login page after successful registration
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>







<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  
  <!-- Link to Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Link to Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">

  <div class="card shadow-lg p-4 rounded-3" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4 text-primary">Register</h3>

    <form action="ragister.php" method="POST">
      <!-- Full Name Input -->
      <div class="mb-3">
        <label for="full-name" class="form-label">Full Name</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input type="text" class="form-control" id="full-name" name="full_name" placeholder="Enter your full name" required>
        </div>
      </div>

      <!-- Email Input -->
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
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

      <!-- Confirm Password Input -->
      <div class="mb-3">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="mb-3">
        <button type="submit" name="ragister" class="btn btn-primary w-100">Register</button>
      </div>

      <!-- Already Have an Account Link -->
      <div class="text-center">
        <p class="text-muted">Already have an account? <a href="/login" class="text-primary">Login here</a></p>
      </div>
    </form>
  </div>

  <!-- Bootstrap 5 JavaScript (required for form functionality) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
