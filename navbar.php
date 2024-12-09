<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <!-- Brand or Logo Section -->
      <a class="navbar-brand" href="#">Carvilla</a>
      
      <!-- Navbar Toggle Button (for smaller screens) -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Navbar Links -->
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

          if (isset($_SESSION['email']) && isset($_SESSION['full_name'])) {
              // User is logged in, display personalized message and Logout link
              echo '<li text-danger"><a href="#" class="text-white">Hi, ' . $_SESSION['full_name'] . '</a></li>';
              echo '<li><a href="logout.php" class="btn btn-danger mx-2 text-white" role="button">Logout</a></li>';
              echo '<li class="nav-item">
              <a class="btn btn-warning mx-2 text-white" href="sell youre car.php">Sell Your Car</a>
            </li>';
            } else {
              // User is not logged in, display Login and Register links
              echo '<li><a href="login.php" class="btn btn-success mx-2 text-white" role="button">Login</a></li>';
              echo '<li><a href="register.php" class="btn btn-danger mx-2 text-white" role="button">Register</a></li>';
          }
          ?>
          </ul>
      </div>
    </div>
  </nav>
