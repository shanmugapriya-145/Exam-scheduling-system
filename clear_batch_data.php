<?php
// Establish database connection (replace these values with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "websitelogin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truncate batches table
$sql = "TRUNCATE TABLE batches";
if ($conn->query($sql) === TRUE) {
    echo "Batch data cleared successfully";
} else {
    echo "Error clearing batch data: " . $conn->error;
}

// Close connection
$conn->close();
?>
