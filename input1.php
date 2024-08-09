<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['department'], $_POST['semester'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "websitelogin";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $department = $_POST['department'];
        $semester = $_POST['semester'];
        $sql = "SELECT code, lab, type FROM cse WHERE semester = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $semester);
        $stmt->execute();
        $result = $stmt->get_result();

        $subjectNames = array();
        $subjectCodes = array();
       $type=array();
        while ($row = $result->fetch_assoc()) {
            $subjectNames[] = $row['lab'];
            $subjectCodes[] = $row['code'];
            $type[]=$row['type'];
        }
        $stmt->close();
        $response = array(
            'subjectNames' => $subjectNames,
            'subjectCodes' => $subjectCodes,
            'type'=>$type
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $batchesPerDay = $_POST['batchesPerDay'];
    $totalBatch = 6;
    $checkSql = "SELECT COUNT(*) as count FROM schedule WHERE date = ? AND batchNumber = ?";
    $checkStmt = $conn->prepare($checkSql);
    $insertSql = "INSERT INTO schedule (date, batchNumber, subjectName, subjectCode, Session,venue,time) VALUES (?, ?, ?, ?, ?,?,?)";
    $insertStmt = $conn->prepare($insertSql);

    // Bind parameters
    $checkStmt->bind_param("si", $checkDate, $checkBatch);
    $insertStmt->bind_param("sisssss", $formattedDate, $batchNumber, $subjectName, $subjectCode, $session,$venue,$time);

    foreach ($subjectNames as $key => $subjectName) {
        $subjectCode = $subjectCodes[$key];
        $Type = $type[$key];
        $currentDate = $startDate;
        $batchNumber = 1;
        $totalDays = round((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)) + 1;
        for ($i = 0; $i < $totalDays; $i++) {
            $formattedDate = date('Y-m-d', strtotime("$currentDate + $i days")); 
            for ($j = 0; $j < $batchesPerDay; $j++) {
                $checkDate = $formattedDate;
                $checkBatch = $batchNumber;
        if ($batchesPerDay == 2) {
            if ($j % 2 == 0) {
                $session = 'FN';
                $time='12:35-3:05';
            } else {
                $session = 'AN';
                $time='9:00-12:00';
            }
        } elseif ($batchesPerDay == 3) {
            if ($j == 0) {
                $session = 'FN';
                $time='9:00-11:00';
            } elseif ($j == 1) {
                $session = 'N';
                $time='11:00-1:00';
            } elseif ($j == 2) {
                $time='1:00-3:00';
                $session = 'AN';
            }
        } elseif ($batchesPerDay == 4) {
            if ($j == 1) {
                $session = 'FN';
            } elseif ($j == 2) {
                $session = 'AN';
            } elseif ($j == 3) {
                $session = 'FN';
            } elseif ($j == 4) {
                $session = 'AN';
            }
        } elseif ($batchesPerDay == 6) {
            if ($j == 1) {
                $session = 'FN';
            } elseif ($j == 2) {
                $session = 'N';
            } elseif ($j == 3) {
                $session = 'AN';
            } elseif ($j == 4) {
                $session = 'FN';
            } elseif ($j == 5) {
                $session = 'N';
            } elseif ($j == 6) {
                $session = 'AN';
            }
        }
    if ($Type == 'E') {
        $venue = 'MB216';
    } elseif ($Type == 'CS') {
        $venue = 'NB301';
    } elseif ($Type == 'EC') {
        $venue = 'NB115';
    } elseif ($Type == 'EP') {
        $venue = 'MB006';
    } else {
        $venue = 'Unknown Venue';
    }
                // Bind the session parameter
                $insertStmt->bind_param("sisssss", $formattedDate, $batchNumber, $subjectName, $subjectCode, $session,$venue,$time);

                // Execute the check statement
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();
                $row = $checkResult->fetch_assoc();

                if ($row['count'] > 0) {
                    continue;
                }
                $insertStmt->execute();
                $batchNumber++;
                if ($batchNumber > $totalBatch) {
                    break 2; 
                }
            }
        }
$dateCheckSql = "SELECT DISTINCT date FROM schedule WHERE subjectName = ?";
$dateCheckStmt = $conn->prepare($dateCheckSql);
$dateCheckStmt->bind_param("s", $subjectName);
$dateCheckStmt->execute();
$dateCheckResult = $dateCheckStmt->get_result();

$existingDates = [];
while ($row = $dateCheckResult->fetch_assoc()) {
    $existingDates[] = $row['date'];
}
$dateCheckStmt->close();

$allDates = [];
for ($i = 0; $i < $totalDays; $i++) {
    $allDates[] = date('Y-m-d', strtotime("$startDate + $i days"));
}

$missingDates = array_diff($allDates, $existingDates);
foreach ($missingDates as $missingDate) {
    for ($j = 0; $j < $batchesPerDay; $j++) {
        if ($batchNumber > $totalBatch) {
            break 2;
        }
        $formattedDate = $missingDate; 
        $insertStmt->execute();
        $batchNumber++;
    } 
    if ($batchesPerDay == 2) {
        if ($j % 2 == 0) {
            $session = 'FN';
            $time='12:35-3:05';
        } else {
            $session = 'AN';
            $time='9:00-12:00';
        }
    } elseif ($batchesPerDay == 3) {
        if ($j == 0) {
            $session = 'FN';
            $time='9:00-11:00';
        } elseif ($j == 1) {
            $session = 'N';
            $time='11:00-1:00';
        } elseif ($j == 2) {
            $time='1:00-3:00';
            $session = 'AN';
        }
    }
   elseif ($batchesPerDay == 4) {
        if ($j == 0) {
            $session = 'FN';
        } elseif ($j == 1) {
            $session = 'AN';
        } elseif ($j == 2) {
            $session = 'FN';
        } elseif ($j == 3) {
            $session = 'AN';
        }
    } elseif ($batchesPerDay == 6) {
        if ($j == 1) {
            $session = 'FN';
        } elseif ($j == 2) {
            $session = 'N';
        } elseif ($j == 3) {
            $session = 'AN';
        } elseif ($j == 4) {
            $session = 'FN';
        } elseif ($j == 5) {
            $session = 'N';
        } elseif ($j == 6) {
            $session = 'AN';
        }
    }  
    if ($batchNumber > $totalBatch) {
        break; 
    }
}
    }

    $checkStmt->close();
    $insertStmt->close();
    $conn->close();
    header("Location: input.html");
    exit(); 
}
}
?>