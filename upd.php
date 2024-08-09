<?php

require 'db.php';

$initialStartNumber = $_POST["startNumber"] ?? '';
$initialEndNumber = $_POST["endNumber"] ?? '';
$initialBatchNumber = $_POST["batchNumber"] ?? '';

if(isset($_POST["submit"])){

    $startnumber= $_POST["startNumber"];
    $endnumber = $_POST["endNumber"];
    $batchnumber = $_POST["batchNumber"];
    $Date = $_POST["Date"];
    $Session = $_POST["Session"];
    $Code = $_POST["Code"];
    $Subject = $_POST["Subject"];

$query = "INSERT INTO batch VALUES('$startnumber','$endnumber','$batchnumber','$Date','$Session','$Code','$Subject')";
mysqli_query($conn, $query);
header("Location: upd.php?startNumber=$initialStartNumber&endNumber=$initialEndNumber&batchNumber=$initialBatchNumber");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin2.css">
</head>
<style media="screen">
    label{
        display: block;
    }
</style>
<body style="background:#f5e1ee;">
    <form class="" action="" method="post" autocomplete="off">
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="admin2.css">
</head>

<body>
    <form action="index.php" method="post">
    <header>
        <div class="logosec">
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
                class="icn menuicn" id="menuicn" alt="menu-icon">
            <div class="logo">Exam Schedule</div>
        </div>
        <div class="dp">
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                class="dpicn" alt="dp">
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer navclose">
            <nav class="nav">
                <div class="nav-upper-options">
                    <a href="admin.html" class="nav-option option1">
                        <img src="assets/dashboard.png" class="nav-img" alt="dashboard">
                        <h3>Dashboard</h3>
                    </a>
                    <div class="option2 nav-option">
                        <img src="assets/studentlist2.png" class="nav-img" alt="institution">
                        <h3> Student List</h3>
                    </div>
                    <div class="nav-option option5">
                        <img src="assets/subjects.png" class="nav-img" alt="blog">
                        <h3>Subjects</h3>
                    </div>
                    <div class="nav-option option6">
                        <img src="assets/settings.png" class="nav-img" alt="settings">
                        <h3> Settings</h3>
                    </div>
                    <a href="login.html" class="option2 nav-option"> 
						<img src="assets/logout.png" class="nav-img" alt="institution"> 
						<h3>Logout</h3> 
                    </a> 
                </div>
            </nav>
        </div>
        <div class="center-container">
            <div class="rectangle-box">
                <div class="container">
                    <div class="add-exam">
                        <h2>Add New Exam</h2>
                            <label for="startNumber">Start Number:</label>
                            <input type="text" id="startNumber" name="startNumber" readonly>
                            <label for="endNumber">End Number:</label>
                            <input type="text" id="endNumber" name="endNumber" readonly>
                            <label for="batchNumber">Batch Number:</label>
                            <input type="text" id="batchNumber" name="batchNumber" readonly>
                            <label for="">Date</label>
        <input type="date" name="Date" >
        <label for="">Session</label>
        <select class="" name="Session" >
            <option value="" selected hidden>Select Session</option>
            <option value="FN">FN</option>
            <option value="N">Noon</option>
            <option value="AF">AF</option>
        </select>
        <label for="">Subject Code</label>
        <input type="text" name="Code" >
        <label for="">Subject</label>
        <input type="text" name="Subject" >
        <br>
                        <button id="add-exam-btn" id="submit" name="submit">Add Exam</button>
                    </div>
                </div>
            </div>
         </div> 
         <div class="rectangl-box">
          <div class="containe">  
            <div class="schedule">
                <h2>Schedule</h2>
                <table id="schedule-table">
                    <thead>
                        <tr>
                        <?php include 'fetchschedule.php'; ?>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="schedule-body"></tbody>
                  </table>  
                    <tr id="clear-table-row">
                      <td colspan="5"> 
                          <button id="clear-table-btn" >Clear Table</button>
                      </td>
                      
                  </tr>
                
            </div>
        </div>
        </div>
    </div>
    <script src="admin2.js"></script>
    <script src="details.js"></script>
    </form>
</body>
</html>
