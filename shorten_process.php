<?php
// Replace these variables with your database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'databasequiz';

// Database connection
$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $longUrl = $_POST['long_url'];
    $slug = $_POST['slug'];

    // Validate and sanitize the inputs (implement validation as needed)

    // Check if the slug already exists in the database
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE slug = ?");
    if ($stmt) {
        $stmt->bind_param("s", $slug);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            // if ($result->num_rows > 0) {
            //     echo "Slug already exists. Please choose a different one.";
            //     exit();
            // }
        } else {
            echo "Error: " . $stmt->error;
            exit();
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
        exit();
    }

    // Save the URL details to the database
    $stmt = $mysqli->prepare("INSERT INTO users (username, long_url, slug) VALUES (?, ?, ?)");
    if ($stmt) {
        $username = $_SESSION['username'];
        $stmt->bind_param("sss", $username, $longUrl, $slug);
        if ($stmt->execute()) {
            // Redirect to redirect.php after saving the URL details
            header("Location: redirect.php?slug=" . urlencode($slug));
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
