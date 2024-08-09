<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "websitelogin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
  exit;
}

$batches = array(); // Initialize the batches array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $department = $_POST["department"];
  $semester = $_POST["semester"];
  $totalStudents = (int)$_POST["totalStudents"];
  $studentsPerBatch = (int)$_POST["studentsPerBatch"];
  
  $startingNumber = 211721104125;
  $numBatches = ceil($totalStudents / $studentsPerBatch);

  for ($i = 0; $i < $numBatches; $i++) {
    $batchStart = $startingNumber + $i * $studentsPerBatch;
    $batchEnd = min($batchStart + $studentsPerBatch - 1, 211721104125 + $totalStudents);
    
    // Adjust batchEnd if it exceeds the total number of students
    if ($batchEnd > ($startingNumber + $totalStudents - 1)) {
      $batchEnd = $startingNumber + $totalStudents - 1;
    }

    // Fetch data from the database
    $sql = "SELECT 
                SUM(CASE WHEN Type = 'Day Scholar' THEN 1 ELSE 0 END) AS dayscholars,
                SUM(CASE WHEN Type = 'Hosteller' AND Gender = 'MALE' THEN 1 ELSE 0 END) AS Boys_Hostellers,
                SUM(CASE WHEN Type = 'Hosteller' AND Gender = 'FEMALE' THEN 1 ELSE 0 END) AS Girls_Hostellers,
                SUM(CASE WHEN Type = 'Day Scholar' AND Gender = 'MALE' THEN 1 ELSE 0 END) AS Boys_DayScholars,
                SUM(CASE WHEN Type = 'Day Scholar' AND Gender = 'FEMALE' THEN 1 ELSE 0 END) AS Girls_DayScholars,
                SUM(CASE WHEN Gender = 'MALE' THEN 1 ELSE 0 END) AS males,
                SUM(CASE WHEN Gender = 'FEMALE' THEN 1 ELSE 0 END) AS females
            FROM students WHERE Register_number BETWEEN $batchStart AND $batchEnd";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();

      // Store batch data in the batches array
      $batches[] = array(
        "batch_number" => $i + 1,
        "starting_number" => $batchStart,
        "ending_number" => $batchEnd,
        "total_students" => $batchEnd-$batchStart+1,
        "hostellers" => $row['Boys_Hostellers'] + $row['Girls_Hostellers'],
        "Boys_Hostellers"=>$row['Boys_Hostellers'],
        "Girls_Hostellers"=>$row['Girls_Hostellers'],
        "dayscholars" => $row['dayscholars'],
        "Boys_DayScholars"=> $row['Boys_DayScholars'],
        "Girls_DayScholars"=> $row['Girls_DayScholars'],
        "males" => $row['males'],
        "females" => $row['females']
      );

      // Insert data into the batches table
      $insertSql = "INSERT INTO batches (batchNumber, startNumber, endNumber, totalStudents, hostellers,Boys_Hostellers,Girls_Hostellers, dayscholars,Boys_DayScholars,Girls_DayScholars, males, females)
                    VALUES (" . ($i + 1) . ", $batchStart, $batchEnd, $studentsPerBatch, " . ($row['Boys_Hostellers'] + $row['Girls_Hostellers']) .", " . $row['Boys_Hostellers'] .", " . $row['Girls_Hostellers'] . ", " . $row['dayscholars'] .", " . $row['Boys_DayScholars'] .", " . $row['Girls_DayScholars'] . ", " . $row['males'] . ", " . $row['females'] . ")";
      $conn->query($insertSql);
    }
  }
}

$conn->close();

// Returning the batches array as JSON
echo json_encode($batches);
?>
