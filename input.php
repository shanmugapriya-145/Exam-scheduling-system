<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "websitelogin";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$department = $_POST['department'];
$semester = $_POST['semester'];
$sql = "SELECT code, lab FROM cse WHERE semester = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $semester);
$stmt->execute();
$result = $stmt->get_result();
$labData = [];
$subjectNames = [];
$subjectCodes = [];

while ($row = $result->fetch_assoc()) {
    $labData[] = $row;
    $subjectNames[] = $row['lab'];
    $subjectCodes[] = $row['code'];
}
$response = [
    'total_labs' => count($labData),
    'labs' => $labData,
    'subjectNames' => $subjectNames, 
    'subjectCodes' => $subjectCodes  
];

header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conn->close();
?>

