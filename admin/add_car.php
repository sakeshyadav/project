
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 


// Database connection parameters
$servername = "localhost"; // or the IP address of the MySQL server
$username = "root";
$password = "";
$dbname = "user";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

    // Validate and sanitize form inputs
    if (isset($_POST["submit"])) { 
     
        // Validate and sanitize form inputs
        $make = isset($_POST['make']) ? $_POST['make'] : '';  // Check if 'make' is set
        $model = isset($_POST['model']) ? $_POST['model'] : '';  // Check if 'model' is set
        $year = isset($_POST['year']) ? (int) $_POST['year'] : 0;  // Check if 'year' is set
        $mileage = isset($_POST['mileage']) ? (int) $_POST['mileage'] : 0;  // Check if 'mileage' is set
        $conditions = isset($_POST['conditions']) ? $_POST['conditions'] : '';  // Check if 'condition' is set
        $price = isset($_POST['price']) ? (float) $_POST['price'] : 0;  // Check if 'price' is set
        $seller_name = isset($_POST['seller_name']) ? $_POST['seller_name'] : '';  // Check if 'seller_name' is set
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';  // Check if 'phone' is set
        $email = isset($_POST['email']) ? $_POST['email'] : '';  // Check if 'email' is set
        $title_status = isset($_POST['title_status']) ? $_POST['title_status'] : ''; 
        $photos= $_FILES['photos']['name'];
        $target = getcwd() . "//uploads//" . $photos;
        move_uploaded_file($_FILES['photos']['tmp_name'], $target);
    // Insert data into database
    // Assuming you have the necessary form data from POST
    echo $photos; // Debug: See what photos are being passed
    
    $sql = "INSERT INTO sell_youre_car(make, model, year, mileage, conditions, price, seller_name, phone, email, title_status,photos)
          VALUES ('$make', '$model', '$year', '$mileage', '$conditions', '$price','$seller_name', '$phone', '$email', '$title_status','$photos')";
    
    // Debug: Output the SQL query to verify it
    echo $sql;
    
    if (mysqli_query($conn, $sql)) {
        // Success: Show alert and redirect to success page
        echo "<script>
                alert('Car details submitted successfully!');
                window.location.href = 'displaydata.php'; // Redirect after success
              </script>";
    } else {
        // Error: Show error message with SQL error
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
              </script>";
    }
}

    ?>
    




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addCar</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Container for the form -->
    <div class="container py-5">
        <h2 class="text-center text-primary mb-4">Add Youre Car</h2>

        <!-- Card with the form -->
        <div class="card shadow-lg p-4 rounded-3">
            <form action="" method="POST" enctype="multipart/form-data">

                <!-- Car Make -->
                <div class="mb-3">
                    <label for="car-make" class="form-label">Car Make</label>
                    <input type="text" class="form-control" id="car-make" name="make" required>
                </div>

                <!-- Car Model -->
                <div class="mb-3">
                    <label for="car-model" class="form-label">Car Model</label>
                    <input type="text" class="form-control" id="car-model" name="model" required>
                </div>

                <!-- Car Year -->
                <div class="mb-3">
                    <label for="car-year" class="form-label">Year</label>
                    <input type="number" class="form-control" id="car-year" name="year" min="1900" max="2099" required>
                </div>

                <!-- Mileage -->
                <div class="mb-3">
                    <label for="car-mileage" class="form-label">Mileage (in km/miles)</label>
                    <input type="number" class="form-control" id="car-mileage" name="mileage" required>
                </div>

                <!-- Condition -->
                <div class="mb-3">
                    <label for="car-condition" class="form-label">Condition</label>
                    <textarea class="form-control" id="car-condition" name="conditions" rows="4" placeholder="Describe the condition of the car (Exterior, Interior, Mechanical)" required></textarea>
                </div>

                <!-- Asking Price -->
                <div class="mb-3">
                    <label for="car-price" class="form-label">Asking Price</label>
                    <input type="number" class="form-control" id="car-price" name="price" required>
                </div>

                <!-- Car Photos -->
                <div class="mb-3">
                    <label for="car-photos" class="form-label">Car Photos</label>
                    <input type="file" class="form-control" id="car-photos" name="photos" multiple required>
                </div>

                <!-- Seller's Name -->
                <div class="mb-3">
                    <label for="seller-name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="seller-name" name="seller_name" required>
                </div>

                <!-- Seller's Phone -->
                <div class="mb-3">
                    <label for="seller-phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="seller-phone" name="phone" required>
                </div>

                <!-- Seller's Email -->
                <div class="mb-3">
                    <label for="seller-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="seller-email" name="email" required>
                </div>

                <!-- Car Title Status -->
                <div class="mb-3">
                    <label for="car-title" class="form-label">Car Title Status</label>
                    <select class="form-select" id="car-title" name="title_status" required>
                        <option value="clean">Clean</option>
                        <option value="salvage">Salvage</option>
                        <option value="rebuilt">Rebuilt</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submit" class="btn btn-primary w-100">Add Car</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (required for form functionality like dropdowns or tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>