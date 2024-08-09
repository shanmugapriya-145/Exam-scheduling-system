<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "websitelogin";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


if (isset($_GET['registerNumber']) && !empty($_GET['registerNumber'])) {
    $registerNumber = mysqli_real_escape_string($connection, $_GET['registerNumber']);
    $sql = "SELECT * FROM display WHERE '$registerNumber' BETWEEN startNumber AND endNumber";
    $result = $connection->query($sql);

    if (!$result) {
        die("Invalid query: " . $connection->connect_error);
    }
    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr>
        <th>Subject Name</th>
        <th>Subject Code</th>
        <th>Date</th>
        <th>Session</th>
        <th>Batch Number</th>
        <th>Total Students</th>
        <th>Venue</th>
        <th>Time</th>
        <th>Start Number</th>
        <th>End Number</th>
        </tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["subjectName"] . "</td>";
            echo "<td>" . $row["subjectCode"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["Session"] . "</td>";
            echo "<td>" . $row["batchNumber"] . "</td>";
            echo "<td>" . $row["totalStudents"] . "</td>";
            echo "<td>" . $row["venue"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "<td>" . $row["startNumber"] . "</td>";
            echo "<td>" . $row["endNumber"] . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No results found for register number: $registerNumber";
    }
} else {
    echo "Register number is not provided.";
}

$connection->close();
?>