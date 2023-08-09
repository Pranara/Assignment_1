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

// Initialize variables to store login input and login message
$loginUsername = '';
$loginPassword = '';
$loginMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    // Use prepared statement to fetch user details from the database
    $stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
    if ($stmt) {
        // Bind the parameter and execute the statement
        $stmt->bind_param("s", $loginUsername);
        if ($stmt->execute()) {
            // Get the hashed password from the database
            $stmt->bind_result($hashedPassword);
            if ($stmt->fetch()) {
                // Verify the password
                if (password_verify($loginPassword, $hashedPassword)) {
                    // Password is correct, start a session
                    session_start();

                    // Store user information in the session (you can store more user data here)
                    $_SESSION['username'] = $loginUsername;

                    // Redirect to the user dashboard or any other page
                    header("Location: user_dashboard.php");
                    exit();
                } else {
                    $loginMessage = "Invalid username or password.";
                }
            } else {
                $loginMessage = "Invalid username or password.";
            }
        } else {
            $loginMessage = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $loginMessage = "Error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php echo $loginMessage; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
