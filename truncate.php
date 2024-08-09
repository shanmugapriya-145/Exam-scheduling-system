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

// Truncate operation
$sql = "TRUNCATE TABLE display";
if ($conn->query($sql) === TRUE) {
    echo "Table truncated successfully";
} else {
    echo "Error truncating table: " . $conn->error;
}
$sql_schedule = "TRUNCATE TABLE schedule";
if ($conn->query($sql_schedule) === TRUE) {
    echo "Schedule table truncated successfully";
} else {
    echo "Error truncating schedule table: " . $conn->error;
}

// Close connection
$conn->close();
?>
