<?php

include ('dompdf/autoload.inc.php');

$servername = "localhost";
$username = "root";
$password = "";
$database = "websitelogin";
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT
            Subject,
            Code,
            GROUP_CONCAT(Date ORDER BY Date ASC) AS Dates,
            GROUP_CONCAT(Session ORDER BY Date ASC) AS Sessions,
            GROUP_CONCAT(batchNumber ORDER BY Date ASC, batchNumber ASC) AS BatchNos,
            GROUP_CONCAT(startNumber ORDER BY Date ASC) AS StartNumbers,
            GROUP_CONCAT(endNumber ORDER BY Date ASC) AS EndNumbers
        FROM batch
        GROUP BY Subject, Code
        ORDER BY Subject ASC, MIN(Date) ASC, BatchNos ASC";

$result = $connection->query($sql);

if (!$result) {
    die("Invalid query" . $connection->connect_error);
}

if (isset($_POST['download_pdf'])) {
    // Generate PDF
    $dompdf = new Dompdf\Dompdf();
    $html = '<h1>EXAM SCHEDULE</h1>';
    $html .= '<table>';
    $html .= '<thead>
            <tr>
                <th>Subject</th>
                <th>Code</th>
                <th>Date</th>
                <th>Session</th>
                <th>Batch No</th>
                <th>Start Number</th>
                <th>End Number</th>
            </tr>
        </thead>';
$html .= '<tbody>';

while ($row = $result->fetch_assoc()) {
    $dates = explode(',', $row['Dates']);
    $sessions = explode(',', $row['Sessions']);
    $batchNos = explode(',', $row['BatchNos']);
    $startNumbers = explode(',', $row['StartNumbers']);
    $endNumbers = explode(',', $row['EndNumbers']);

    $rowCount = count($dates);

    for ($i = 0; $i < $rowCount; $i++) {
        $html .= '<tr>';
        if ($i === 0) {
            $html .= '<td rowspan="' . $rowCount . '">' . $row['Subject'] . '</td>';
            $html .= '<td rowspan="' . $rowCount . '">' . $row['Code'] . '</td>';
        }
        $html .= '<td>' . $dates[$i] . '</td>';
        $html .= '<td>' . $sessions[$i] . '</td>';
        $html .= '<td>' . $batchNos[$i] . '</td>';
        $html .= '<td>' . $startNumbers[$i] . '</td>';
        $html .= '<td>' . $endNumbers[$i] . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</tbody>';
    $html .= '</table>';
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Set paper size and orientation

    // Render the HTML as PDF
    $dompdf->render();

    // Output PDF
    $pdf_content = $dompdf->output();

    // Download PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="exam_schedule.pdf"');
    echo $pdf_content;
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 50px;
        }

        h1 {
            color: black;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            border: 1px solid #884483;
            background-color: #884483;
            color: #fff;
        }

        th, td {
            border: 1px solid #884483;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #884483;
        }
        td {
            background-color: white;
            color:black;
            font-size:18px;
        }

        body{
            background-color: #f5e1ee;
        }

        .back-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>EXAM SCHEDULE</h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Code</th>
                <th>Date</th>
                <th>Session</th>
                <th>Batch No</th>
                <th>Start Number</th>
                <th>End Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                $dates = explode(',', $row['Dates']);
                $sessions = explode(',', $row['Sessions']);
                $batchNos = explode(',', $row['BatchNos']);
                $startNumbers = explode(',', $row['StartNumbers']);
                $endNumbers = explode(',', $row['EndNumbers']);

                $rowCount = count($dates);

                for ($i = 0; $i < $rowCount; $i++) {
            ?>
                    <tr>
                        <?php if ($i === 0) { ?>
                            <td rowspan="<?php echo $rowCount; ?>"><?php echo $row['Subject']; ?></td>
                            <td rowspan="<?php echo $rowCount; ?>"><?php echo $row['Code']; ?></td>
                        <?php } ?>
                        <td><?php echo $dates[$i]; ?></td>
                        <td><?php echo $sessions[$i]; ?></td>
                        <td><?php echo $batchNos[$i]; ?></td>
                        <td><?php echo $startNumbers[$i]; ?></td>
                        <td><?php echo $endNumbers[$i]; ?></td>
                    </tr>
                    <?php
                }
            }
            ?> 
        </tbody>
    </table>
    <br>
    <center>
    <div class="btn-container">
        <form method="post">
            <button type="submit" name="download_pdf" class="btn btn-primary">Download PDF</button>
        </form>
    </div>
    <div class="btn-container">
        <a href="admin.html" class="btn btn-primary back-btn">Back</a>
    </div>
    </center>

</body>
</html>