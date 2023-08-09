<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'databasequiz';

// Database connection
$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}
echo "Connected successfully";

// Initialize variables to store user input and registration message
$username = '';
$password = '';
$registrationMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to insert user details into the database
    $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    if ($stmt) {
        // Bind the parameters and execute the statement
        $stmt->bind_param("ss", $username, $hashedPassword);
        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <?php echo $registrationMessage; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>



