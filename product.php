<?php
// Replace with your database connection details
$servername = "localhost"; // Server name or IP address
$username = "root"; // Your MySQL username
$password = ""; // No password is set
$dbname = "shop"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for product input
$productName = $productDescription = $productPrice = $productQuantity = "";
$productNameErr = $productPriceErr = $productQuantityErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and retrieve product input
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];

    // Validate product name
    if (empty($productName)) {
        $productNameErr = "Product name is required";
    }

    // Validate product price
    if (!is_numeric($productPrice) || $productPrice <= 0) {
        $productPriceErr = "Valid product price is required";
    }

    // Validate product quantity
    if (!is_numeric($productQuantity) || $productQuantity <= 0) {
        $productQuantityErr = "Valid product quantity is required";
    }

    // Check if there are no errors before proceeding
    if (empty($productNameErr) && empty($productPriceErr) && empty($productQuantityErr)) {
        // Insert the product data into the "products" table
        $sql = "INSERT INTO products (name, description, price, quantity) VALUES ('$productName', '$productDescription', $productPrice, $productQuantity)";

        if ($conn->query($sql) === true) {
            echo "Product registration successful.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Registration - Shop Management System</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Product Registration</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
                <span class="text-danger"><?php echo $productNameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description:</label>
                <textarea class="form-control" id="productDescription" name="productDescription"></textarea>
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price:</label>
                <input type="text" class="form-control" id="productPrice" name="productPrice" required>
                <span class="text-danger"><?php echo $productPriceErr; ?></span>
            </div>
            <div class="form-group">
                <label for="productQuantity">Product Quantity:</label>
                <input type="text" class="form-control" id="productQuantity" name="productQuantity" required>
                <span class="text-danger"><?php echo $productQuantityErr; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Register Product</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (jQuery and Popper.js required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
