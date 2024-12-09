<?php
include("connection.php"); // Include the database connection file

// Check if the form is submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are provided
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in both email and password');</script>";
        exit;
    }

    // Write SQL query to check if the email exists
    $sql = "SELECT * FROM user_data WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch user data from the database
        $user = mysqli_fetch_assoc($result);

        // Check if user exists
        if ($user) {
            // Compare the entered password with the stored password
            if ($password === $user['password']) {

                session_start();
                $_SESSION['email'] = $user['email']; // Save data in session
                $_SESSION['full_name'] = $user['full_name'];
  
                // If passwords match
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.location.href='index.php';</script>"; // Redirect to dashboard
            } else {
                // Incorrect password
                echo "<script>alert('Incorrect password');</script>";
            }
        } else {
            // User not found
            echo "<script>alert('User not found');</script>";
        }
    } else {
        // SQL query failed
        echo "<script>alert('Database query failed');</script>";
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
    <title>Login Page</title>

    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card shadow-lg p-4 rounded-3" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4 text-primary">Login</h3>

        <form action="login.php" method="POST">
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

            <!-- Login Button -->
            <div class="mb-3">
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
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