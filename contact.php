<?php
// Initialize variables for error and success messages
$error_message = '';
$success_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate form data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = 'Please fill in all fields.';
    } else {
        // Send the email to the site administrator
        $to = 'sakeshyadav580@gmail.com';  // Replace with your email address
        $headers = 'From: ' . $email . "\r\n" . 'Reply-To: ' . $email . "\r\n" . 'Content-Type: text/html; charset=UTF-8';
        $body = '<p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>';
        $body .= '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
        $body .= '<p><strong>Subject:</strong> ' . htmlspecialchars($subject) . '</p>';
        $body .= '<p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($message)) . '</p>';

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            $success_message = 'Your message has been sent successfully. We will get back to you shortly.';
        } else {
            $error_message = 'Sorry, there was an error sending your message. Please try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
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
            <a class="nav-link text-white" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contact Form Section -->
  <div class="container py-5">
    <h2 class="text-center mb-4 text-primary">Contact Us</h2>

    <?php if ($error_message): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error_message; ?>
      </div>
    <?php elseif ($success_message): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $success_message; ?>
      </div> 
    <?php endif; ?>

    <form method="POST" action="contact.php">
      <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
      </div>
      
      <div class="mb-3">
        <label for="email" class="form-label">Your Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
      </div>
      
      <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo isset($subject) ? htmlspecialchars($subject) : ''; ?>" required>
      </div>
      
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
      </div>
      
      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
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
