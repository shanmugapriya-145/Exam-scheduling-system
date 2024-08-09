<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Table</title>
    <link rel="stylesheet" href="admin.css"> 
    <link rel="stylesheet" href="responsive.css"> 
    <style>
        :root {
            --primary-color: #884483;
            --secondary-color: #f5e1ee;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5e1ee;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: var(--primary-color);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .dp img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .main-container {
            display: flex;
            min-height: calc(100vh - 40px);
        }
        .nav {
    min-height: 91vh; 
    width: 250px; 
    background-color: var(--background-color2); 
    position: absolute; 
    top: 0px; 
    left: 0; 
    box-shadow: 1px 1px 10px rgba(189, 248, 189, 0.825); 
    display: flex; 
    flex-direction: column; 
    justify-content: space-between; 
    overflow: hidden; 
    padding: 20px 0 170px 10px; 
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
            width: 80px; 
            } 
            .nav-option {
    width: 250px; 
    height: 60px; 
    display: flex; 
    align-items: center; 
    padding: 0 30px 0 20px; 
    gap: 10px; 
    transition: all 0.1s ease-in-out;
    margin-bottom: 20px; 
}
 
        .nav-option:hover{
            color: #3b1f39;
        }
        .nav-option img {
            margin-right: 10px;
        }
        .container {
            flex: 1;
            padding: 20px;
        }
        table {
            background-color: white;
            border-collapse: collapse;
            width: 100%;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: var(--primary-color);
            color: white;
        }
        tr:nth-child(even) {
            background-color: white;
        }
        button {
            padding: 8px 16px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #a834a1;
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
                <a href="trial3_display.php" class="nav-option option6"> 
						<img src="assets/batchDetails.png" class="nav-img" alt="settings"> 
						<h3>Batch Detail</h3> 
					</a> 
                <a href="login.html" class="nav-option"> 
                    <img src="assets/logout.png" class="nav-img" alt="institution"> 
                    <h3>Logout</h3> 
                </a> 
            </nav> 
        </div> 
        <div class="container">
            <center>
            <br>
            <h2>Batches</h2>
            <br>
            </center>
            
            <table>
                <thead>
                    <tr>
                        <th>Batch Number</th>
                        <th>Start Number</th>
                        <th>End Number</th>
                        <th>Total Students</th>
                        <th>Hostellers</th>
                        <th>  Boys<br>Hostellers</th>
                        <th>  Girls<br>Hostellers</th>
                        <th>DayScholars</th>
                        <th>  Boys<br>DayScholars</th>
                        <th>  Girls<br>DayScholars</th>
                        <th>Males</th>
                        <th>Females</th>
                    </tr>
                </thead>
                
                <tbody>
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
                    $sql = "SELECT * FROM batches";
                    $result = $conn->query($sql);

                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["batchNumber"] . "</td>";
                        echo "<td>" . $row["startNumber"] . "</td>";
                        echo "<td>" . $row["endNumber"] . "</td>";
                        echo "<td>" . $row["totalStudents"] . "</td>";
                        echo "<td>" . $row["hostellers"] . "</td>";
                        echo "<td>" . $row["Boys_Hostellers"] . "</td>";
                        echo "<td>" . $row["Girls_Hostellers"] . "</td>";
                        echo "<td>" . $row["dayscholars"] . "</td>";
                        echo "<td>" . $row["Boys_DayScholars"] . "</td>";
                        echo "<td>" . $row["Girls_DayScholars"] . "</td>";
                        echo "<td>" . $row["males"] . "</td>";
                        echo "<td>" . $row["females"] . "</td>";
                        echo "</tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <center>
            <br>
            <button onclick="generateNewBatch()">Generate New Batch</button>
            </center>
            <script>
                function generateNewBatch() {
                    if (confirm("Are you sure you want to generate a new batch? This will clear the existing data.")) {
                        
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "clear_batch_data.php", true);
                        xhr.send();
                        
                        xhr.onload = function () {
                            if (xhr.status == 200) {
                                window.location.href = "trial3.html";
                            }
                        };
                    }
                }
            </script>
        </div> 
    </div> 
</body>
</html>

