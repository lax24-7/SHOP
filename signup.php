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

// Initialize variables for user input
$username = $password = $phone = "";
$usernameErr = $passwordErr = $phoneErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and retrieve user input
    if (empty($_POST['username'])) {
        $usernameErr = "Username is required";
    } else {
        $username = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST['phone'])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = $_POST['phone'];
    }

    // Check if there are no errors before proceeding
    if (empty($usernameErr) && empty($passwordErr) && empty($phoneErr)) {
        // Perform SQL query to insert new user
        $sql = "INSERT INTO users (username, password, phone) VALUES ('$username', '$password', '$phone')";

        if ($conn->query($sql) === true) {
            // User successfully created, you can redirect to login page or handle it as needed
            echo "User registration successful. <a href='login.php'>Login</a>";
        } else {
            // Handle registration failure (e.g., display error message)
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
    <title>Sign Up - Shop Management System</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Sign Up</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
                <span class="text-danger"><?php echo $usernameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="text-danger"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
                <span class="text-danger"><?php echo $phoneErr; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <!-- Include Bootstrap JS (jQuery and Popper.js required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
