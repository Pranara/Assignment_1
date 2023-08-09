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

// Check if the slug parameter is provided in the URL
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];

    // Retrieve the long URL associated with the provided slug
    $stmt = $mysqli->prepare("SELECT long_url FROM users WHERE slug = ?");
    if ($stmt) {
        $stmt->bind_param("s", $slug);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $longUrl = $row['long_url'];

                // Increment the visit count for the URL
                $updateStmt = $mysqli->prepare("UPDATE users SET visit_count = visit_count + 1 WHERE slug = ?");
                if ($updateStmt) {
                    $updateStmt->bind_param("s", $slug);
                    $updateStmt->execute();
                    $updateStmt->close();
                }

                // Redirect to the long URL
                header("Location: " . $longUrl);
                exit();
            } else {
                echo "URL not found.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Slug parameter not provided.";
}
?>
