<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "websitelogin";
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // DELETE operation
    $sql_delete = "DELETE FROM students WHERE Register_number = '$id'";
    if ($connection->query($sql_delete) === TRUE) {
        $deleteStatus = "Record deleted successfully";
        header("Location: studlist.php");
        exit(); 
    } else {
        $deleteStatus = "Error deleting record: " . $connection->error;
    }
}

// Close the connection
$connection->close();
?>
