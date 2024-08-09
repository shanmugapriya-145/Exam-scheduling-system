<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "websitelogin"; 
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Delete the record from the database
    $delete_sql = "DELETE FROM cse WHERE id=$id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>
