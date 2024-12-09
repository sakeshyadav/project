<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user"; // Change this if your database has a different name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $car with default values to avoid "undefined variable" errors
$car = [
    'make' => '',
    'model' => '',
    'year' => '',
    'mileage' => '',
    'condition' => '',
    'price' => '',
    'seller_name' => '',
    'phone' => '',
    'email' => '',
    'title_status' => 'clean' // Default value for title_status
];

// Check if car_id is provided in the URL
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

    // Validate car_id (ensure it's an integer)
    if (!is_numeric($car_id)) {
        echo "Invalid car ID.";
        exit;
    }

    // Direct query to fetch car details without escaping or prepared statements
    $sql = "SELECT * FROM sell_youre_car WHERE id = $car_id";  // Raw SQL query

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc(); // Populate $car with database data
    } else {
        echo "No car found with this ID.";
        exit;
    }
}

// Handle form submission to update car details
if (isset($_POST['update'])) {
    // Directly access user inputs without sanitizing them
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = (int)$_POST['year']; // Ensure year is an integer
    $mileage = (int)$_POST['mileage']; // Ensure mileage is an integer
    $condition = $_POST['condition'];
    $price = (float)$_POST['price']; // Ensure price is a number
    $seller_name = $_POST['seller_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $title_status = $_POST['title_status'];

    // Validate fields (basic validation)
    if (!is_numeric($year) || !is_numeric($mileage) || !is_numeric($price)) {
        echo "Invalid input values.";
        exit;
    }

    // Update query using raw inputs without escaping
    $sql = "UPDATE sell_youre_car SET 
                make = '$make', 
                model = '$model', 
                year = $year, 
                mileage = $mileage, 
                condition = '$condition', 
                price = $price, 
                seller_name = '$seller_name', 
                phone = '$phone', 
                email = '$email', 
                title_status = '$title_status'
            WHERE id = $car_id"; // Directly using $car_id

    if ($conn->query($sql) === TRUE) {
        // Redirect to another page after a successful update
        header("Location: displaydata.php"); // Redirect to display page
        exit(); // Make sure to call exit() after header() to stop further script execution
    } else {
        echo "Error updating car details: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <h2 class="text-center text-primary mb-4">Edit Car Details</h2>

        <div class="card shadow-lg p-4 rounded-3">
            <form action="edit.php?car_id=<?php echo $car_id; ?>" method="POST">

                <div class="mb-3">
                    <label for="make" class="form-label">Car Make</label>
                    <input type="text" class="form-control" id="make" name="make" value="<?php echo $car['make']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Car Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="<?php echo $car['model']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control" id="year" name="year" value="<?php echo $car['year']; ?>" min="1900" max="2099" required>
                </div>

                <div class="mb-3">
                    <label for="mileage" class="form-label">Mileage</label>
                    <input type="number" class="form-control" id="mileage" name="mileage" value="<?php echo $car['mileage']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="condition" class="form-label">Condition</label>
                    <textarea class="form-control" id="condition" name="condition" rows="4" required><?php echo $car['condition']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $car['price']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="seller_name" class="form-label">Seller Name</label>
                    <input type="text" class="form-control" id="seller_name" name="seller_name" value="<?php echo $car['seller_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $car['phone']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $car['email']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="title_status" class="form-label">Title Status</label>
                    <select class="form-select" id="title_status" name="title_status" required>
                        <option value="clean" <?php echo ($car['title_status'] == 'clean') ? 'selected' : ''; ?>>Clean</option>
                        <option value="salvage" <?php echo ($car['title_status'] == 'salvage') ? 'selected' : ''; ?>>Salvage</option>
                        <option value="rebuilt" <?php echo ($car['title_status'] == 'rebuilt') ? 'selected' : ''; ?>>Rebuilt</option>
                    </select>
                </div>

                <button type="submit" name="update" class="btn btn-success w-100">Update Car</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js for responsive functionality -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
