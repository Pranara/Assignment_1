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

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch the user's shortened URLs from the database
$loggedInUsername = $_SESSION['username'];
$shortenedUrls = array();

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $loggedInUsername);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $shortenedUrls[] = $row;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error: " . $mysqli->error;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    
    <h3>Shorten URL</h3>
    <form method="post" action="shorten_process.php">
        <label for="long_url">Long URL:</label>
        <input type="text" name="long_url" id="long_url" required><br><br>
        
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug"><br><br>
        
        <input type="submit" value="Shorten">
    </form>
    
    <h3>Your Shortened URLs</h3>
    <ul>
        <?php foreach ($shortenedUrls as $url): ?>
            <li>
                <a href="http://your_web_domain/<?php echo $url['slug']; ?>">
                    http://your_web_domain/<?php echo $url['slug']; ?>
                </a>
                (Visits: <?php echo $url['visit_count']; ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
