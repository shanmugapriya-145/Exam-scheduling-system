<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Table</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="responsive.css">
    <style>
        .nav { 
min-height: 91vh; 
width: 250px; 
background-color: var(--background-color2); 
position: absolute; 
top: 0px; 
left: 0px; 
box-shadow: 1px 1px 10px rgba(189, 248, 189, 0.825); 
display: flex; 
flex-direction: column; 
justify-content: space-between; 
overflow: hidden; 
padding: 20px 0 50px 10px; 
} 
.navcontainer { 
height: calc(100vh - 70px); 
width: 250px; 
position: relative; 
overflow-y: scroll; 
overflow-x: hidden; 
transition: all 0.5s ease-in-out; 
} 
.navcontainer::-webkit-scrollbar { 
display: none; 
} 
.navclose { 
width: 60px; 
} 
.nav-option { 
width: 250px; 
height: 60px; 
display: flex; 
align-items: center; 
padding: 0 30px 0 20px; 
gap: 20px; 
transition: all 0.1s ease-in-out; 
} 
.nav-option:hover { 
border-left: 5px solid;
cursor: pointer; 
} 
.nav-img { 
height: 30px; 
} 

.nav-upper-options { 
display: flex; 
flex-direction: column; 
align-items: center; 
gap: 30px; 
} 

.icn { 
height: 30px; 
} 
.menuicn { 
cursor: center; 
} 

.content {
    
    background-color: white;
    margin: 10px auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
    margin-left: 25px; 
    margin-top:40px;
    margin-right: 100px;
    padding-left: 10px;
    width: calc(100% - 250px - 40px);
    max-width: 1500px; 
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5e1ee;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #884483;
    color: white;
}

tr {
    background-color: white; 
}

tr:nth-child(even) {
    background-color: white; 
}

    </style>
</head>
<body>
    <header> 
        <div class="logosec"> 
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon"> 
            <div class="logo">Exam Schedule</div> 
        </div> 
        <div class="dp"> 
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"> 
        </div> 
    </header>
    <div class="main-container"> 
        <div class="navcontainer"> 
            <nav class="nav"> 
                <div class="nav-upper-options">  
                    <a href="./admin.html" class="nav-option"> 
						<img src="assets/dashboard.png" class="nav-img" alt="dashboard"> 
						<h3> Dashboard</h3> 
                    </a> 
					<a href="./studlist.php" class="nav-option"> 
						<img src="assets/studentlist2.png" class="nav-img" alt="institution"> 
						<h3> Student List</h3> 
					</a>
					<a href="./reg.php" class="nav-option"> 
						<img src="assets/subjects.png" class="nav-img" alt="blog"> 
						<h3>Regulation</h3> 
					</a> 
					<a href="trial3_display.php" class="nav-option"> 
						<img src="assets/batchDetails.png" class="nav-img" alt="settings"> 
						<h3>Batch Detail</h3> 
					</a> 
					<a href="login.html" class="nav-option"> 
						<img src="assets/logout.png" class="nav-img" alt="institution"> 
						<h3>Logout</h3> 
                    </a> 
                </div>
            </nav> 
        </div> 
    <div class="content">
        <h2>Display Table</h2>
        <table>
            <tr style="background-color: white;">
            <tr style="background-color: white;">
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
</tr>

            </tr>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view']))  {
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
            
            $sql_schedule_count = "SELECT COUNT(*) as count FROM schedule";
            $result_schedule_count = $conn->query($sql_schedule_count);
            $row_schedule_count = $result_schedule_count->fetch_assoc();
            $schedule_count = $row_schedule_count['count'];
            
            // SQL query to insert data from schedule and batches into display table
            $insert_sql = "INSERT INTO display (subjectName, subjectCode, date, batchNumber, Session, totalStudents, venue, time, startNumber, endNumber)
            SELECT s.subjectName, s.subjectCode, s.date, s.batchNumber, s.Session, b.totalStudents, s.venue, s.time, b.startNumber, b.endNumber
            FROM schedule s
            JOIN batches b ON s.batchNumber = b.batchNumber
            LIMIT $schedule_count
            ";
            
            if ($conn->query($insert_sql) === TRUE) {
                echo "";
            } else {
                echo "Error inserting data: " . $conn->error;
            }
                    
            $sql = "SELECT
            subjectName AS Subject,
            subjectCode AS Code,
            GROUP_CONCAT(date ORDER BY date ASC) AS Dates,
            GROUP_CONCAT(Session) AS Sessions,
            GROUP_CONCAT(batchNumber ORDER BY date ASC, batchNumber ASC) AS BatchNos,
            GROUP_CONCAT(startNumber ORDER BY date ASC) AS StartNumbers,
            GROUP_CONCAT(endNumber ORDER BY date ASC) AS EndNumbers,
            GROUP_CONCAT(totalStudents ORDER BY date ASC) AS TotalStudents,
            GROUP_CONCAT(venue ORDER BY date ASC) AS Venues,
            GROUP_CONCAT(time ORDER BY date ASC) AS Time
        FROM display
        GROUP BY subjectName, subjectCode
        ORDER BY subjectName ASC, MIN(date) ASC, BatchNos ASC";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Split the concatenated strings into arrays
        $dates = explode(",", $row["Dates"]);
        $sessions = explode(",", $row["Sessions"]);
        $batchNos = explode(",", $row["BatchNos"]);
        $startNumbers = explode(",", $row["StartNumbers"]);
        $endNumbers = explode(",", $row["EndNumbers"]);
        $totalStudents = explode(",", $row["TotalStudents"]);
        $venues = explode(",", $row["Venues"]);
        $time= explode(",", $row["Time"]);

        // Determine the maximum count among all arrays
        $rowCount = max(count($dates), count($sessions), count($batchNos), count($startNumbers), count($endNumbers), count($totalStudents), count($venues),count($time));

        // Output each value in separate rows
        for ($i = 0; $i < $rowCount; $i++) {
            echo "<tr>";
            // Output subjectName and subjectCode only for the first row
            if ($i === 0) {
                echo "<td rowspan='" . $rowCount . "'>" . $row["Subject"] . "</td>";
                echo "<td rowspan='" . $rowCount . "'>" . $row["Code"] . "</td>";
            }
            // Output the values for each row
            echo "<td>" . ($i < count($dates) ? $dates[$i] : "") . "</td>";
            echo "<td>" . ($i < count($sessions) ? $sessions[$i] : "") . "</td>";
            echo "<td>" . ($i < count($batchNos) ? $batchNos[$i] : "") . "</td>";
            // Output the totalStudents column
            echo "<td>" . ($i < count($totalStudents) ? $totalStudents[$i] : "") . "</td>";
            echo "<td>" . ($i < count($venues) ? $venues[$i] : "") . "</td>";
            echo "<td>" . ($i < count($time) ? $time[$i] : "") . "</td>"; 
            echo "<td>" . ($i < count($startNumbers) ? $startNumbers[$i] : "") . "</td>";
            echo "<td>" . ($i < count($endNumbers) ? $endNumbers[$i] : "") . "</td>";
            
            echo "</tr>";
        }
    }
} else {
    echo "0 results";
}

            // Close connection
            $conn->close();
        }
            ?>
        </table> 
        <br>
        <center>
        <form id="semesterForm" method="post">
            <button type="submit" name="view">View</button>
        </form>
        <button id="generateBatchBtn" onclick="generateNewBatch()">Generate New Schedule</button>
    <br>
    </center>
    <br>
    
</div>
        <br>
    </div>
    </div>
    <script>
                function generateNewBatch() {
                    if (confirm("Are you sure you want to generate a new batch? This will clear the existing data.")) {
                        // Perform AJAX request to trigger PHP script for truncating table
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "truncate.php", true);
                        xhr.send();
                        xhr.onload = function () {
                            if (xhr.status == 200) {
                                window.location.href = "input.html";
                            }
                        };
                    }
                }
                
document.addEventListener("DOMContentLoaded", () => {
    let menuicn = document.querySelector(".menuicn");
    let nav = document.querySelector(".navcontainer");

    menuicn.addEventListener("click", () => {
        nav.classList.toggle("navclose");
    });
    document.addEventListener("click", (event) => {
        const isNavcontainer = event.target.closest(".navcontainer");
        const isMenuicn = event.target.closest(".menuicn");

        if (!isNavcontainer && !isMenuicn) {
            nav.classList.add("navclose");
        }
    });
});
</script>

</body>
</html>
