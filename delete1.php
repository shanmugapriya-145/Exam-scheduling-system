<?php

if (isset($_POST["delete"])) {
    $batchNumber = $_POST["batchNum"];
    $date = $_POST["Dat"];
    $session = $_POST["Sess"];
    $code = $_POST["Cod"];
    $subject = $_POST["Sub"];

    // Check if any of the variables are not set or empty
    if (!isset($batchNumber, $date, $session, $code, $subject) || empty($batchNumber) || empty($date) || empty($session) || empty($code) || empty($subject)) {
        echo "<script>alert('Invalid input values'); window.location = document.referrer;</script>";
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "websitelogin";

    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // to prevent SQL injection
    $sql = "DELETE FROM batch WHERE batchNumber = ? AND Date = ? AND Session = ? AND Code = ? AND Subject = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $batchNumber, $date, $session, $code, $subject);

    if ($stmt->execute()) {
        echo "<script>alert('Row deleted successfully'); window.location = document.referrer;</script>";
    } else {
        if ($stmt->errno == 0 && $stmt->affected_rows == 0) {
            // Truncate the entire table
            $truncateSql = "TRUNCATE TABLE batch";
            if ($connection->query($truncateSql)) {
                echo "<script>alert('Table truncated successfully'); window.location = document.referrer;</script>";
            } else {
                echo "<script>alert('Error truncating table: " . $connection->error . "'); window.location = document.referrer;</script>";
            }
        } else {
            echo "<script>alert('Error deleting row: " . $stmt->error . "'); window.location = document.referrer;</script>";
        }
    }

    $stmt->close();
    $connection->close();
}
?>

