<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Display Table</h2>
    <table>
        <tr>
            <th>Subject Name</th>
            <th>Subject Code</th>
            <th>Date</th>
            <th>Batch Number</th>
            <th>Session</th>
            <th>Total Students</th>
            <th>Start Number</th>
            <th>End Number</th>
        </tr>
        <?php
        // Establish database connection
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
        // Select data from display table
        $sql = "SELECT * FROM display ORDER BY subjectName";
        $result = $conn->query($sql);
        $currentSubject = "";
        $firstRow = true;
        while ($row = $result->fetch_assoc()) {
            if ($row["subjectName"] != $currentSubject) {
                if (!$firstRow) {
                    echo "</tbody>";
                }
            }
            echo "<tr>";
            echo "<td>" . $row["subjectName"] . "</td>";
            echo "<td>" . $row["subjectCode"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["batchNumber"] . "</td>";
            echo "<td>" . $row["Session"] . "</td>";
            echo "<td>" . $row["totalStudents"] . "</td>";
            echo "<td>" . $row["startNumber"] . "</td>";
            echo "<td>" . $row["endNumber"] . "</td>";
            echo "</tr>";
            $firstRow = false;
        }
        if (!$firstRow) {
            echo "</tbody>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>

