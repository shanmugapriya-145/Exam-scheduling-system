<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .rectangl-box {
            padding-left: 40px;
            padding-right:40px;
        }
        .rectangle-box {
            padding-left: 40px;
            padding-right:40px; 
        }
        .table td,table th {
            padding-left: 30px;
            padding-right:30px; 
        }
    </style>
</head>
<body> 
    <h1>EXAM SCHEDULE </h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Batch</th>
                <th>Date</th>
                <th>Session</th>
                <th>Code</th>
                <th>Subject</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "websitelogin";
            $connection = new mysqli($servername, $username, $password, $database);
            if ($connection->connect_error) {
                die("Connection failed : " . $connection->connect_error);
            }

            $sql = "SELECT * FROM batch ORDER BY Date ASC";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query" . $connection->connect_error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["batchNumber"] . "</td>
                    <td>" . $row["Date"] . "</td>
                    <td>" . $row["Session"] . "</td>
                    <td>" . $row["Code"] . "</td>
                    <td>" . $row["Subject"] . "</td>
                    <td>
                        <form method='post' action='delete1.php'>
                            <input type='hidden' name='batchNum' value='" . $row['batchNumber'] . "'>
                            <input type='hidden' name='Dat' value='" . $row['Date'] . "'>
                            <input type='hidden' name='Sess' value='" . $row['Session'] . "'>
                            <input type='hidden' name='Cod' value='" . $row['Code'] . "'>
                            <input type='hidden' name='Sub' value='" . $row['Subject'] . "'>
                            <button type='submit' name='delete' id='delete' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
